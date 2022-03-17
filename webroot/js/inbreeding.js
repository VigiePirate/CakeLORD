function showFeedback(cost) {
  document.getElementById('waiting-message').style.display = 'none';
  document.getElementById('cost').innerHTML = Math.trunc(cost)/1000;
  if (cost > 3000) {
    document.getElementById('cost-comment').innerHTML += "That was pretty intense. A tough one!";
  } else {
    document.getElementById('cost-comment').innerHTML += "OK, that was a pretty easy one.";
  }
  document.getElementById('success-message').style.display = 'revert';
}

function init(partialTree, ancestorIndex) {
  worker.postMessage(JSON.stringify({partialTree: partialTree, ancestorIndex: ancestorIndex}));
}

/* MAIN */

// launch worker
var worker = new Worker('/js/inbreeding-worker.js');

// create listeners
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
    document.getElementById('avk5').innerHTML = '<span class="pulse">AVK<sub>5</sub> = ' + evt.data.avk5 + ' %';
  }

  if (evt.data.avk10 != undefined) {
    document.getElementById('avk10').innerHTML = '<span class="pulse">AVK<sub>10</sub> = ' + evt.data.avk10 + ' %';
  }

  if (evt.data.coi != undefined) {
    document.getElementById('coi').innerHTML = evt.data.coi;
  }

  if (evt.data.cost != undefined) {
     showFeedback(evt.data.cost);
  }
}
