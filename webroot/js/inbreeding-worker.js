function computeInbreeding(tree, index, coefs)
{
  // find candidate coancestors (duplicates in tree)
  // count occurrences of each (returns an object {id1: count1, id2: count2})
  var candidates = Object.values(tree).reduce(function(acc,e){acc[e] = (e in acc ? acc[e]+1 : 1); return acc}, {});
  // filter out ids appearing only once and cast keys to integers
  candidates = Object.keys(candidates).filter(function(c) {return candidates[c] > 1}).map(c => parseInt(c));

  // loop on candidates
  for (let candidate of candidates) {
    // find all paths to candidate in tree, separating maternal and paternal
    fpaths = Object.keys(tree).filter(function(c) {return tree[c] === candidate && c.slice(0,1) === 'F'});
    mpaths = Object.keys(tree).filter(function(c) {return tree[c] === candidate && c.slice(0,1) === 'M'});

    if (fpaths.length != 0 && mpaths.length != 0) {
      // remove leaf markers (it would bias path length)
      fpaths = fpaths.map(p => p.slice(-1) === 'X' ? p.slice(0,-1) : p);
      mpaths = mpaths.map(p => p.slice(-1) === 'X' ? p.slice(0,-1) : p);
      refpath = index[candidate];
      refpathLength = refpath.length;

      // loop on maternal paths
      for (let fp of fpaths) {

        // take path from mother to candidate
        fpLabels = [];
        fpLength = fp.length;
        for (let i=1; i <= fpLength - 1; i++) {
          fpLabels.push(tree[fp.slice(0, i)]);
        }

        // loop on paternal paths
        for (let mp of mpaths) {
          mpLength = mp.length;
          // check if paths are not overlapping
          let overlap = false;
          for (let j=1; j <= mpLength - 1; j++) {
            if (fpLabels.includes(tree[mp.slice(0,j)])) {
              overlap = true;
              break;
            }
          }
          // paths do not overlap : a contribution has to be added
          if (! overlap) {
            // check if the candidate already has a COI, compute it if not
            // let contrib = coefs[candidate];
            let contrib = 0; // debug, neglect coancestor COI
            if (coefs[candidate] == undefined) {
              // get candidate subtree and subindex
              subTree = {};
              subIndex = {};
              for (let key in tree) {
                if (key.slice(0,refpathLength) === refpath) {
                  subTree[key.slice(refpathLength)] = tree[key];
                  subIndex[tree[key]] = key.slice(refpathLength);
                }
              }
              contrib = computeInbreeding(subTree, subIndex, coefs);
            } else {
              contrib = coefs[candidate];
            }
            // add contribution of the ancestor
            coefs[candidate] += 1/2**((fpLength + mpLength - 1)*(1 + contrib));

            // send message to update ancestor's contribution
          }
        }
      }
      // send message to update common ancestors number and main COI
    }
  }

  return Object.values(coefs).reduce((a, b) => a + b, 0);
}

function expandTreeStep(tree, index)
{
  let newTree = {};

  for (let path in tree) {
    let id = tree[path];
    if (path.slice(-1) == 'Y') { // this guy has copies and needs to be expanded
      newTree[path.slice(0,-1)] = id; // write the guy
      let original_path = index[id]; // find the original it is the copy of
      if (original_path.slice(-1) == 'X') { // if the original is a leaf
        newTree[path.slice(0,-1) + 'X'] = id; // write the guy with an X instead of its Y
      } else {
        let path_to_ancestors = Object.keys(tree).filter(key => key.slice(0, original_path.length) == original_path && key != original_path);
        for (let ancestor_index in path_to_ancestors) {
          let ancestor_path = path_to_ancestors[ancestor_index];
          newTree[path.slice(0,-1) + ancestor_path.slice(original_path.length)] = tree[ancestor_path];
        }
      }
    } else { // the guy has no copy, just write it
      newTree[path] = id;
    }
  }
  return newTree;
}

function truncateTree(tree, level) {
  let t = {};
  let path;
  for (let p in tree) {
    if (p.slice(-1) == 'X' || p.slice(-1) == 'Y') {
      path = p.slice(0, -1);
    } else {
      path = p;
    }
    if (path.length <= level) {
      t[path] = tree[p];
    }
  }
  return t;
}

function computeAvk(tree, level) {
  var approxTree = truncateTree(tree,level);
  var approxKnown = Object.keys(approxTree).length;
  // var approxUnknown = (2**(level+1) - 2) - approxKnown;
  var approxDistinct = [...new Set(Object.values(approxTree))].length;
  // return Math.round(100*(approxDistinct + approxUnknown)/(approxKnown + approxUnknown));
  return Math.round(100*approxDistinct/approxKnown);
}

function findMaxDepth(tree)
{
  let maxDepth = 0;
  for (let path in tree) {
    if (path.length > maxDepth && path.slice(-1) == 'X') {
      maxDepth = path.length - 1;
    }
  }
  return maxDepth;
}

function findMinDepth(tree)
{
  let minDepth = Infinity;
  for (let path in tree) {
    if (path.length < minDepth && path.slice(-1) == 'X') {
      minDepth = path.length - 1;
    }
  }
  return minDepth;
}

function countFounding(tree)
{
  var f = [];
  for (let path in tree) {
    if (path.slice(-1) == 'X') {
      f.push(tree[path]);
    }
  }
  return [...new Set(f)].length;
}

function initCommon(tree)
{
  var c = [];
  for (let path in tree) {
    if (path.slice(-1) == 'Y') {
      c.push(tree[path]);
    }
  }
  return [...new Set(c)].length;
}

onmessage = function(evt) {

  var startTime = performance.now();
  var endTime, cost;

  var max_depth, new_max_depth,
      min_depth, new_min_depth,
      known, new_known,
      distinct, new_distinct,
      founding, new_founding,
      common, new_common;

  var avk5, avk10;
  var done_avk5 = false;
  var done_avk10 = false;

  var cakeData = JSON.parse(evt.data);
  var partialTree = cakeData.partialTree;
  var ancestorIndex = cakeData.ancestorIndex;

  // init values on partial tree and send messages to show them
  var fullTree = partialTree;
  max_depth = findMaxDepth(partialTree);
  min_depth = findMinDepth(partialTree);
  known = Object.keys(fullTree).length;
  distinct = Object.keys(ancestorIndex).length;
  founding = countFounding(fullTree);
  common = initCommon(fullTree);

  postMessage({
    min_depth: min_depth,
    max_depth: max_depth,
    known: known,
    distinct: distinct,
    founding: founding,
    common: common
  });

  // expand tree iteratively and update values everytime they changed
  while(Object.keys(fullTree).find(path => path.slice(-1) == 'Y') != undefined) {

    // perform one expansion step
    fullTree = this.expandTreeStep(fullTree, ancestorIndex);

    // sent messages to refresh display if necessary
    new_max_depth = findMaxDepth(fullTree);
    if (new_max_depth != max_depth) {
      max_depth = new_max_depth;
      postMessage({max_depth: max_depth});
    }

    new_min_depth = findMinDepth(fullTree);
    if (new_min_depth != min_depth) {
      min_depth = new_min_depth;
      postMessage({min_depth: min_depth});
    }

    if (done_avk5 == false && min_depth >= 5) {
      avk5 = computeAvk(fullTree, 5);
      postMessage({avk5: avk5});
      done_avk5 = true;
    }

    if (done_avk10 == false && min_depth >= 10) {
      avk10 = computeAvk(fullTree, 10);
      postMessage({avk10: avk10});
      done_avk10 = true;
    }

    new_known = Object.keys(fullTree).length;
    if (new_known != known) {
      postMessage({known: new_known});
    }
  }

  // first evaluation of common ancestors before entering actual coi computation
  postMessage({common: common});

  // if avks are still uncomputed, it is time to approximate them from uncomplete tree
  if (done_avk5 == false) {
    avk5 = computeAvk(fullTree, 5);
    postMessage({avk5: avk5});
    done_avk5 = true;
  }

  if (done_avk10 == false) {
    avk10 = computeAvk(fullTree, 10);
    postMessage({avk10: avk10});
    done_avk10 = true;
  }

  // start coi computations -- messages will be sent from there
  let coefs = {}; // init coefs object that will be filled with coancestors coi's
  coi = computeInbreeding(fullTree, ancestorIndex, coefs);
  postMessage({coi: coi});

  endTime = performance.now();
  cost = Math.trunc(endTime - startTime);
  setTimeout(postMessage({cost: cost}), 1000);
}
