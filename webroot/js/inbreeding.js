function showFeedback(cost, jsMessages) {
  document.getElementById('waiting-message').style.display = 'none';
  document.getElementById('cost').innerHTML = Math.trunc(cost)/1000;
  var costComment;

  if (cost <= 2500) {
    costComment = jsMessages[0];
  } else if (cost <= 10000) {
    costComment = jsMessages[1];
  } else if (cost <= 40000) {
    costComment = jsMessages[2];
  } else if (cost <= 160000) {
    costComment = jsMessages[3];
  } else {
    costComment = jsMessages[4];
  }

  document.getElementById('cost-comment').innerHTML += costComment;
  document.getElementById('success-message').style.display = 'revert !important';
  document.getElementById('success-message').classList.remove("hide-everywhere");
  document.getElementById('success-message').onclick = function() {
    this.style.display= 'none';
  };
}

function insertPosition(ranks, coi) {
  var i = 1;
  while (ranks[i] > coi) {
    i++;
  }
  ranks.splice(i, 0, coi);
  return i;
}

function init(partialTree, ancestorIndex, jsMessages) {
  worker.postMessage(JSON.stringify({partialTree: partialTree, ancestorIndex: ancestorIndex, jsMessages: jsMessages}));
}

/* MAIN */

// launch worker
var worker = new Worker('/js/inbreeding-worker.js');
var ranks = [];
var op;

// treat messages
worker.onmessage = function(evt) {

  if (evt.data.max_depth != undefined) {
    document.getElementById('max_depth').innerHTML = '<span class="pulse">' + evt.data.max_depth + '</span> generations';
  }

  if (evt.data.min_depth != undefined) {
    document.getElementById('min_depth').innerHTML = '<span class="pulse">' + evt.data.min_depth + '</span> generations';
  }

  if (evt.data.known != undefined) {
    document.getElementById('known').innerHTML = '<span class="pulse">' + evt.data.known + '</span> rats';
  }

  if (evt.data.distinct != undefined) {
    document.getElementById('distinct').innerHTML = '<span class="pulse">' + evt.data.distinct + '</span> rats';
  }

  if (evt.data.founding != undefined) {
    document.getElementById('founding').innerHTML = '<span class="pulse">' + evt.data.founding + '</span> rats';
  }

  if (evt.data.common != undefined) {
    document.getElementById('common').innerHTML = '<span class="pulse">' + evt.data.common + '</span> rats';
  }

  if (evt.data.avk5 != undefined) {
    op = evt.data.approx ? ' ≃ ' : ' = ';
    document.getElementById('avk5').innerHTML = '<span class="pulse">AVK<sub>5</sub>' + op + evt.data.avk5 + ' %';
  }

  if (evt.data.avk10 != undefined) {
    op = evt.data.approx ? ' ≃ ' : ' = ';
    document.getElementById('avk10').innerHTML = '<span class="pulse">AVK<sub>10</sub>' + op + evt.data.avk10 + ' %';
  }

  if (evt.data.coi != undefined) {
    ranks[0] = evt.data.coi;
    document.getElementById('coi').innerHTML = '<span class="pulse">COI = ' + (100*evt.data.coi).toPrecision(4) + ' %';
    if (evt.data.coi > 0) {
      document.getElementById('coancestry').classList.remove("hide-everywhere");
      document.getElementById('coancestry').style.display = 'revert !important';
    } else {
      document.getElementById('common').innerHTML = '<span class="pulse"> None </span>';
    }
  }

  if (evt.data.coancestor != undefined) {
    document.getElementById('coancestry-global').innerHTML = ((100*evt.data.coi).toPrecision(3) ? (100*evt.data.coi).toPrecision(3) : '< 0.01') + ' %';

    var table = document.getElementById("coancestry-table");
    var id = evt.data.coancestor.id;
    var name = evt.data.coancestor.name;
    var row = document.getElementById("id-" + id);
    var contrast;

    ranks[0] = evt.data.coi;

    if (row === null) { // first time we see this guy: add row
      var position = insertPosition(ranks, evt.data.coancestor.contribution);
      row = table.insertRow(position); // create <tr> element; position will have to be calculated
      row.setAttribute('id', 'id-' + evt.data.coancestor.id);
      var headerCell = row.insertCell(0);
      var dataCell = row.insertCell(1);
      headerCell.classList.add("th");
      var rectangle = document.createElement("div");
      rectangle.setAttribute('id', "rect-" + id);
      headerCell.appendChild(rectangle);
      contrast = Math.log2(1+evt.data.coancestor.contribution/evt.data.coi);
      rectangle.style.width = (15+100*contrast) + '%';
      rectangle.style.opacity = 0.25+0.75*contrast;
      rectangle.innerHTML = ((100*evt.data.coancestor.contribution).toFixed(3) >= 0.01 ? (100*evt.data.coancestor.contribution).toFixed(2) : '< 0.01') + ' %';
      dataCell.innerHTML = '<span class="pulse">+ <a href=/rats/view/' + id + '>' + name + '</span></a>';
    } else { // already seen: just update
      var rectangle = document.getElementById("rect-" + id);
      contrast = Math.log2(1+evt.data.coancestor.contribution/evt.data.coi);
      rectangle.style.width = (15+100*contrast) + '%';
      rectangle.style.opacity = 0.25+0.75*contrast;
      rectangle.innerHTML = ((100*evt.data.coancestor.contribution).toFixed(3) >= 0.01 ? (100*evt.data.coancestor.contribution).toFixed(2) : '< 0.01') + ' %';
    }
  }

  if (evt.data.cost != undefined) {
      showFeedback(evt.data.cost, evt.data.jsMessages);
  }
}
