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
  // w = 1000*(depth+2)/depth;
  // h = 900*(depth+2)/depth;
  // f = 4/3;
  // h = f * nodeWidth*(2**(depth - 1))*2;

  w = 1320;
  h = 1320;

  var svg = d3.select("#simpletree").append("svg")
    .attr("viewBox", "0 0 " + w + ' ' + h )
    .attr("preserveAspectRatio", "xMidYMid meet")
    .append('g')
    // Left padding of tree so that the whole root node is on the screen.
    .attr("transform", "translate(" + 2*boxWidth/3 + "," + (h/2) + ")");

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

  var ancestorRoot = rootProxy(json);
  ancestorTree.data(ancestorRoot);
  ancestorTree.draw(ancestorRoot);
  window.onafterprint = window.close;
  window.print();
}

function rootProxy(root){
  return {
    name: root.name,
    dates:root.dates,
    description: root.description,
    death: root.death,
    id: root.id,
    sex: root.sex,
    more_parents: root.more_parents,
    x0: 0,
    y0: 0,
    _parents: root._parents,
    collapsed: false
  };
}

var Tree = function(svg, selector, direction){
  this.svg = svg;
  this.selector = selector;
  this.direction = direction;

  this.tree = d3.layout.tree()
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
      .style('cursor', 'default');

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
      .style("cursor", "default");

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
