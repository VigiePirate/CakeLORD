
/**
 * For the sake of the examples, I want the setup code to be at the top.
 * However, since it uses a class (Tree) which is defined later, I wrap
 * the setup code in a function at call it at the end of the example.
 * Normally you would extract the entire Tree class defintion into a
 * separate file and include it before this script tag.
 */

var labels = []
var labelsF = [];
var labelsM = [];
var colorScaleF = d3.scale.ordinal()
  .range(['#fff2e6', '#ffe6e6', '#ffffe5', '#ffe7fb', '#ffebe4', '#ffe4ff', '#fcf9ed']);
var strokeScaleF = d3.scale.ordinal()
  .range(['#ffb366', '#ff6666', '#fafa64', '#d900b5', '#ff794d', '#ff66ff', '#c4ab89']);
var colorScaleM = d3.scale.ordinal()
  .range(['#e6e6ff', '#edffe7', '#f2e6ff', '#e3fcec', '#e6fff9', '#ecffd9', '#e6f9ff']);
var strokeScaleM = d3.scale.ordinal()
  .range(['#6666ff', '#78d956', '#af66ff', '#56d88d', '#52ccb8', '#9aff33', '#0f7799']);

function setup() {

  // local dimensions variables - could be computed from box/node width/height
  w = 1000;
  h = 1200*window.screen.height/window.screen.width;
  factor = json._children.length == 0 ? 5 : 3;

  // Setup zoom and pan
  var zoom = d3.behavior.zoom()
    .scaleExtent([.05,4])
    .on('zoom', function(){
      svg.attr("transform", "translate(" + d3.event.translate + ") scale(" + d3.event.scale + ")");
    })
    // Offset so that first pan and zoom does not jump back to the origin
    .translate([w/factor+42, h/2]);

  var svg = d3.select("#familytree").append("svg")
    .attr("id", "mysvg")
    .attr("viewBox", "0 0 " + w + ' ' + h )
    .attr("preserveAspectRatio", "xMidYMid meet")
    .call(zoom)
    .append('g')
    // Left padding of tree so that the whole root node is on the screen.
    .attr("transform", "translate(" + (w/factor+42) + "," + (h/2) + ")");

  // Buttons to unfold a whole generation at once
  var button1 = d3.select("#familytree").append("ellipse")
    .text("▶▶")
    .attr("class", "pedigree-button1")
    .on('click', function(){
        d3.selectAll("g.person").each(function (d, i) {
          var onClickFunc = d3.select(this).on("click");
          if (d.collapsed && d.hasOwnProperty('_parents') && d.more_parents == 1) {
            onClickFunc.apply(this, [d, i]);
          }
        })
    });

  var button2 = d3.select("#familytree").append("ellipse")
    .text("◀◀")
    .attr("class", "pedigree-button2")
    .on('click', function(){
        d3.selectAll("g.person").each(function (d, i) {
          var onClickFunc = d3.select(this).on("click");
          if (d.collapsed && d.hasOwnProperty('_children') && d.more_children == 1) {
            onClickFunc.apply(this, [d, i]);
          }
        })
    });

    // ChatGPT suggestion to avoid double scrolling
    // .on("touchmove", function() {
    //   d3.event.preventDefault();
    // });

  // One tree to display the ancestors
  var ancestorTree = new Tree(svg, 'ancestor', 1);
  ancestorTree.children(function(person){
    // If the person is collapsed then tell d3
    // that they don't have any ancestors.
    if(person.collapsed){
      return;
    } else {
      return person._parents;
    }
  });

  // Use a separate tree to display the descendants
  var descendantsTree = new Tree(svg, 'descendant', -1);
  descendantsTree.children(function(person){
    if(person.collapsed){
      return;
    } else {
      return person._children;
    }
  });

  // loading data when they are written in a json file
  // d3.json(file, function(error, json){
  //  if(error) {
  //    return console.error(error);
  //  }

  // D3 modifies the objects by setting properties such as
  // coordinates, parent, and children. Thus the same node
  // node can't exist in two trees. But we need the root to
  // be in both so we create proxy nodes for the root only.
  var ancestorRoot = rootProxy(json);
  var descendantRoot = rootProxy(json);

  // Start with only the first few generations of ancestors showing
  // ancestorRoot._parents.forEach(function(parents){
  //   parents._parents.forEach(collapse);
  // });
  // Start with only one generation of descendants showing
  // descendantRoot._children.forEach(collapse);

  // Set the root nodes
  ancestorTree.data(ancestorRoot);
  descendantsTree.data(descendantRoot);

  // Draw the tree
  ancestorTree.draw(ancestorRoot);
  descendantsTree.draw(descendantRoot);

  // Simulate click on parents to make grandparents appear on load
  d3.selectAll("g.ancestor")
    .each(function(d, i) {
      var onClickFunc = d3.select(this).on("click");
      onClickFunc.apply(this, [d, i]);
    });

  // Init children as collapsed for mass unfolding button
  descendantRoot._children.forEach(collapse);
}

function rootProxy(root){
  return {
    name: root.name,
    link: root.link,
    dates:root.dates,
    description: root.description,
    death: root.death,
    id: root.id,
    sex: root.sex,
    more_parents: root.more_parents,
    more_children: root.more_children,
    x0: 0,
    y0: 0,
    _children: root._children,
    _parents: root._parents,
    collapsed: false
  };
}

/**
 * Shared code for drawing ancestors or descendants.
 * `selector` is a class that will be applied to links
 * and nodes so that they can be queried later when
 * the tree is redrawn.
 * `direction` is either 1 (forward) or -1 (backward).
 */
var Tree = function(svg, selector, direction){
  this.svg = svg;
  this.selector = selector;
  this.direction = direction;

  this.tree = d3.layout.tree()

      // Using nodeSize we are able to control
      // the separation between nodes. If we used
      // the size parameter instead then d3 would
      // calculate the separation dynamically to fill
      // the available space.
      .nodeSize([nodeWidth, nodeHeight])
      .separation(function(a,b){
        return a.parent === b.parent ? sibling_separation : cousin_separation;
      });
};

/**
 * Set the `children` function for the tree
 */
Tree.prototype.children = function(fn){
  this.tree.children(fn);
  return this;
};

/**
 * Set the root of the tree
 */
Tree.prototype.data = function(data){
  this.root = data;
  return this;
};

/**
 * Draw/redraw the tree
 */
Tree.prototype.draw = function(source){
  if(this.root){
    var nodes = this.tree.nodes(this.root),
        links = this.tree.links(nodes);
    this.drawLinks(links, source);
    this.drawNodes(nodes, source);
  } else {
    throw new Error('Missing root');
  }
  return this;
};

/**
 * Draw/redraw the connecting lines
 */
Tree.prototype.drawLinks = function(links, source){

  var self = this;

  // Update links
  var link = self.svg.selectAll("path.link." + self.selector)
      // The function we are passing provides d3 with an id
      // so that it can track when data is being added and removed.
      // This is not necessary if the tree will only be drawn once
      // as in the basic example.
      .data(links, function(d){ return d.target.id; });

  // Add new links
  // Transition new links from the source's
  // old position to the links final position
  link.enter().append("path")
      .attr("class", "link " + self.selector)
      .attr("d", function(d) {
        var o = {x: source.x0, y: self.direction * (source.y0 + boxWidth/2)};
        return transitionElbow({source: o, target: o});
      });

  // Update the old links positions
  link.transition()
      .duration(duration)
      .attr("d", function(d){
        return elbow(d, self.direction);
      });

  // Remove any links we don't need anymore
  // if part of the tree was collapsed
  // Transition exit links from their current position
  // to the source's new position
  link.exit()
      .transition()
      .duration(duration)
      .attr("d", function(d) {
        var o = {x: source.x, y: self.direction * (source.y + boxWidth/2)};
        return transitionElbow({source: o, target: o});
      })
      .remove();
};

/**
 * Draw/redraw the person boxes.
 */
Tree.prototype.drawNodes = function(nodes, source){

  var self = this;

  // Update nodes
  var node = self.svg.selectAll("g.person." + self.selector)

      // The function we are passing provides d3 with an id
      // so that it can track when data is being added and removed.
      // This is not necessary if the tree will only be drawn once
      // as in the basic example.
      .data(nodes, function(person){
        return person.id;
      });

  // Add any new nodes
  var nodeEnter = node.enter().append("g")
      .attr("class", "person " + self.selector)
      // Add new nodes at the right side of their child's box.
      // They will be transitioned into their proper position.
      .attr('transform', function(person){
        return 'translate(' + (self.direction * (source.y0 + boxWidth/2)) + ',' + source.x0 + ')';
      })
      .on('click', function(person){
        if(Array.isArray(person._parents) && ! person._parents.length) {
          $.ajax({
            url: '/rats/parents-tree.json',
            dataType: 'json',
            data: {
                'id': person.true_id,
            },
            success: function(data) {
                person._parents = data._parents;
                person._parents.forEach(updateColorScale);
		            collapse(person);
                self.togglePerson(person);
            },
          });
        }
        if(Array.isArray(person._children) && ! person._children.length) {
          $.ajax({
            url: '/rats/children-tree.json',
            dataType: 'json',
            data: {
                'id': person.true_id,
            },
            success: function(data) {
                person._children = data._children;
		            collapse(person);
		            self.togglePerson(person);
            },
          });
        }
        self.togglePerson(person);
      });

  // Draw the rectangle person boxes.
  // Start new boxes with 0 size so that
  // we can transition them to their proper size.
  nodeEnter.append("rect")
      .attr({
        x: 0,
        y: 0,
        width: 0,
        height: 0,
      });

  // Draw the person's name and position it inside the box
  nodeEnter.append("text")
      .attr("dx", 0)
      .attr("dy", 0)
      .attr("text-anchor", "start")
      .attr('class', 'name')
      .text(function(d) {
        return d.name;
      })
      .call(truncate, (boxWidth-16))
      .style('fill-opacity', 0)
      .style('fill',"#343b40")
      .on('click', function(person){
        window.open(person.link, "_blank");
      })
      .style("cursor", "zoom-in");

  // Draw the person's description and position it inside the box
  nodeEnter.append("text")
      .attr("dx", 0)
      .attr("dy", 0)
      .attr("text-anchor", "start")
      .attr('class', 'description')
      .text(function(d) {
        return d.description;
      })
      .call(truncate, (boxWidth-16))
      .style('fill-opacity', 0) // should be zero once fixed
      .style('fill', "#606c76");

  // Draw the person's death info and position it inside the box
  nodeEnter.append("text")
      .attr("dx", 0)
      .attr("dy", 0)
      .attr("text-anchor", "start")
      .attr('class', 'death')
      .text(function(d) {
        return d.death;
      })
      .style('fill-opacity', 0)
      .style('fill', "#606c76");

  // Draw a sign to indicate if parents are available
  nodeEnter.append("text")
      .attr("dx", 0)
      .attr("dy", 0)
      .style("fill", "#ccc")
      .attr("text-anchor", "start")
      .attr('class', 'more_parents')
      .text(function(d) {
        // return (d.more_parents ? "⏵": null);
        return (d.more_parents ? "▶": null);
      });

  // Draw a sign to indicate if children are available
  nodeEnter.append("text")
      .attr("dx", 0)
      .attr("dy", 0)
      .style("fill", "#ccc")
      .attr("text-anchor", "start")
      .attr('class', 'more_children')
      .text(function(d) {
        // return (d.more_children ? "⏴": null);
        return (d.more_children ? "◀": null);
      });

  // Update the position of both old and new nodes
  var nodeUpdate = node.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + (self.direction * d.y) + "," + d.x + ")"; });

  // Grow boxes to their proper size
  nodeUpdate.select('rect')
      .attr({
        x: -(boxWidth/2),
        y: -(boxHeight/2),
        width: boxWidth,
        height: boxHeight
      })
      .style({
        fill: function(d){return smartColour(d);},
        stroke: function(d){return sexStroke(d);}
      });

  // Truncate name and move it
  nodeUpdate.select('text.name')
      .attr("dx", -(boxWidth/2) + 8) ////
      .attr("dy", -11)
      //.call(truncate, (boxWidth-20));

  nodeUpdate.select('text.name > tspan')
       .attr("dx", -(boxWidth/2) + 8) ////
       .attr("dy", -11)
       .style('fill-opacity', 1);

  nodeUpdate.select('text.description')
      .attr("dx", -(boxWidth/2) + 8)
      .attr("dy", 8) //.attr("dy", 22)
      .style('fill-opacity', 1);

  nodeUpdate.select('text.description > tspan')
       .attr("dx", -(boxWidth/2) + 8) ////
       .attr("dy", 8)
       .style('fill-opacity', 1);

  nodeUpdate.select('text.death')
      .attr("dx", -(boxWidth/2) + 8)
      .attr("dy", 21) //.attr("dy", 39)
      .style('fill-opacity', 1);

  nodeUpdate.select('text.more_parents')
      .attr("dx", boxWidth/2 + 3.25)
      .attr("dy", 2.25)
      .style('fill-opacity', function(d) {
        if (d.hasOwnProperty('_parents') && d._parents.length > 0) {
           return d.collapsed ? 1 : 0;
        } else {
           return 1;
        }
      });

  nodeUpdate.select('text.more_children')
      .attr("dx", -(boxWidth/2) - 11.75)
      .attr("dy", 2.25)
      .style('fill-opacity', function(d) {
        if (d.hasOwnProperty('_children') && d._children.length > 0) {
           return d.collapsed ? 1 : 0;
        } else {
           return 1;
        }
      });

  // Remove nodes we aren't showing anymore
  var nodeExit = node.exit()
      .transition()
      .duration(duration)

      // Transition exit nodes to the source's position
      .attr("transform", function(d) { return "translate(" + (self.direction * (source.y + boxWidth/2)) + "," + source.x + ")"; })
      .remove();

  // Shrink boxes as we remove them
  nodeExit.select('rect')
      .attr({
        x: 0,
        y: 0,
        width: 0,
        height: 0
      });

  // Fade out the text as we remove it
  nodeExit.select('text')
      .style('fill-opacity', 0)
      .attr('dx', 0);

  // Stash the old positions for transition.
  nodes.forEach(function(person) {
    person.x0 = person.x;
    person.y0 = person.y;
  });

};

/**
 * Update a person's state when they are clicked.
 */
Tree.prototype.togglePerson = function(person){

  // Don't allow the root to be collapsed because that's
  // silly (it also makes our life easier)
  if(person === this.root){
    return;
  }

  // Non-root nodes
  else {
    if(person.collapsed){
      person.collapsed = false;
    } else {
      collapse(person);
    }

    this.draw(person);
  }
};

/**
 * Collapse person (hide their ancestors). We recursively
 * collapse the ancestors so that when the person is
 * expanded it will only reveal one generation. If we don't
 * recursively collapse the ancestors then when
 * the person is clicked on again to expand, all ancestors
 * that were previously showing will be shown again.
 * If you want that behavior then just remove the recursion
 * by removing the if block.
 */
function collapse(person){
  person.collapsed = true;
  if(person._parents){
    person._parents.forEach(collapse);
  }
  if(person._children){
    person._children.forEach(collapse);
  }
}

/**
 * Custom path function that creates straight connecting
 * lines. Calculate start and end position of links.
 * Instead of drawing to the center of the node,
 * draw to the border of the person profile box.
 * That way drawing order doesn't matter. In other
 * words, if we draw to the center of the node
 * then we have to draw the links first and the
 * draw the boxes on top of them.
 */
function elbow(d, direction) {
  var sourceX = d.source.x,
      sourceY = d.source.y + (boxWidth / 2),
      targetX = d.target.x,
      targetY = d.target.y - (boxWidth / 2);

  return "M" + (direction * sourceY) + "," + sourceX
    + "H" + (direction * (sourceY + (targetY-sourceY)/2))
    + "V" + targetX
    + "H" + (direction * targetY);
}

/**
 * Use a different elbow function for enter
 * and exit nodes. This is necessary because
 * the function above assumes that the nodes
 * are stationary along the x axis.
 */
function transitionElbow(d){
  return "M" + d.source.y + "," + d.source.x
    + "H" + d.source.y
    + "V" + d.source.x
    + "H" + d.source.y;
}

/**
 * Custom function for colors
 */

function smartColour(d) {
    if(d.sex == "M") {
      if (labelsM.includes(d.true_id)) {
        return colorScaleM(d.true_id);
      } else {
        return "#e6f3ff"; // "#f5faff";
      }
    }
    if(d.sex == "F") {
      if (labelsF.includes(d.true_id)) {
        return colorScaleF(d.true_id);
      } else {
        return "#ffe6f2"; // "#fff5fa";
      }
    }
    return '#f5f7fa';
}

function updateColorScale(d) {
  if (labels.includes(d.true_id)) {
    if (d.sex == "M" && ! labelsM.includes(d.true_id)) {
      labelsM.push(d.true_id);
      colorScaleM.domain(labelsM);
      strokeScaleM.domain(labelsM);
    }
    if (d.sex == "F" && ! labelsF.includes(d.true_id)) {
      labelsF.push(d.true_id);
      colorScaleF.domain(labelsF);
      strokeScaleF.domain(labelsF); // darker: ffcce6
    }
  } else {
    labels.push(d.true_id);
  }
}


function sexStroke(d){
  if(d.sex == "M") {
    if (labelsM.includes(d.true_id)) {
      return strokeScaleM(d.true_id);
    } else {
      return "#e6f3ff"; // "#66b3ff";
    }
  }
  if(d.sex == "F") {
    if (labelsF.includes(d.true_id)) {
      return strokeScaleF(d.true_id);
    } else {
      return "#ffe6f2"; // "#ff66b3";
    }
  }
  return '#9bafbf';
}

/**
* Mike Bostock wrap text function
*/

function wrap(text, width) {
  text.each(function() {
    var text = d3.select(this),
        words = text.text().split(/\s+/).reverse(),
        word,
        line = [],
        lineNumber = 0,
        lineHeight = 1.2, // ems
        y = text.attr("y"),
        dy = parseFloat(text.attr("dy")),
        tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
    while (word = words.pop()) {
      line.push(word);
      tspan.text(line.join(" "));
      if (tspan.node().getComputedTextLength() > width) {
        line.pop();
        tspan.text(line.join(" "));
        line = [word];
        tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
      }
    }
  });
}

/**
* Horribly complicated function to optimally truncate texts
* Inspired from the previous
*/

function truncate(text, width) {
  text.each(function() {
    var text = d3.select(this),
        words = text.text().split(/\s+/).reverse(),
        word,
        line = [],
        y = text.attr("y"),
        dy = parseFloat(text.attr("dy")),
        tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
    while (word = words.pop()) {
      line.push(word);
      tspan.text(line.join(" "));
      if (tspan.node().getComputedTextLength() > width) {
        line.pop();
        line.push("...")
        tspan.text(line.join(" "));
        break;
      }
    }
  });
}
/*
* Some unused code snippet to adapt font size of long texts
*/
// .style("font-size", function(d) {
//  if (this.getComputedTextLength() > boxWidth) {
//    return Math.min(2 * boxWidth/2, (2 * boxWidth/2 - 8) / this.getComputedTextLength() * 14) + "px";
//  } else {
//    return "14px";
//  }
// })
