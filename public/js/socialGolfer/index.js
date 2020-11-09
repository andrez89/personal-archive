let controlsDiv, resultsDiv
let controls = {}

let groups = 0
let ofSize = 0
let forRounds = 0
let playerNames = []
let forbiddenPairs = Immutable.Set()

let startTime;
let lastResults
const myWorker = new Worker('public/js/socialGolfer/worker.js');

function init() {
  myWorker.addEventListener('message', onResults, false);

  resultsDiv = $('#results')

  controls.recomputeButton = $('#recomputeButton')
  controls.recomputeButton2 = $('#recomputeButton')
  controls.groupsLabel = $('#groupsLabel')
  controls.groupsSlider = $('#groupsSlider')
  controls.ofSizeLabel = $('#ofSizeLabel')
  controls.ofSizeSlider = $('#ofSizeSlider')
  controls.forRoundsLabel = $('#forRoundsLabel')
  controls.forRoundsSlider = $('#forRoundsSlider')
  controls.playerNames = $('#playerNames')
  controls.forbiddenPairs = $('#forbiddenPairs')
  controls.total = $('#total')
  controls.advanced = $('#advanced')

  // User input controls
  controls.recomputeButton.click(recomputeResults)
  controls.groupsSlider.click(onSliderMoved)
  controls.ofSizeSlider.click(onSliderMoved)
  controls.forRoundsSlider.click(onSliderMoved)
  controls.playerNames.keyup(onPlayerNamesKeyUp)
  controls.playerNames.change(onPlayerNamesChanged)
  controls.forbiddenPairs.change(onForbiddenPairsChanged)
  controls.advanced.change(displayAdvanced)

  playerNames = readPlayerNames()
  forbiddenPairs = readForbiddenPairs(playerNames)
  onSliderMoved()
  recomputeResults()
}

function displayAdvanced(){
  if (controls.advanced[0].checked) {
    $(".adv").show()
  } else {
    $(".adv").hide()
  }
}

function onResults(e) {
  lastResults = e.data
  renderResults()
  if (lastResults.done) {
    enableControls()
  }
}

function recomputeResults() {
  startTime = Date.now();
  lastResults = null;
  renderResults()
  disableControls()
  myWorker.postMessage({groups, ofSize, forRounds, forbiddenPairs: forbiddenPairs.toJS()})
}

function onSliderMoved() {
  groups = parseInt(controls.groupsSlider.val(), 10)
  ofSize = parseInt(controls.ofSizeSlider.val(), 10)
  forRounds = parseInt(controls.forRoundsSlider.val(), 10)

  // Update labels
  controls.groupsLabel.html("Group number: " + groups)
  controls.ofSizeLabel.html("Group size: " + ofSize)
  controls.forRoundsLabel.html("Round number: " + forRounds)
  controls.total.val(groups * ofSize)
}

function disableControls() {
  controls.recomputeButton.disabled = true
  controls.groupsSlider.disabled = true
  controls.ofSizeSlider.disabled = true
  controls.forRoundsSlider.disabled = true
  controls.playerNames.disabled = true
  controls.forbiddenPairs.disabled = true
  
  // Show spinner
  //ontrols.recomputeButton.html('&nbsp;<span class="spinner"></span>')
  controls.recomputeButton.hide()
}

function enableControls() {
  controls.recomputeButton.disabled = false
  controls.groupsSlider.disabled = false
  controls.ofSizeSlider.disabled = false
  controls.forRoundsSlider.disabled = false
  controls.playerNames.disabled = false
  controls.forbiddenPairs.disabled = false
  
  // Hide spinner
  //controls.recomputeButton.html('<span>Generate</span>')
  controls.recomputeButton.show()
}

function readPlayerNames() {
  return controls.playerNames.val()
    .replace(/,/g, '\n')
    .split('\n')
    .map(name => name.trim())
}

function onPlayerNamesKeyUp() {
  playerNames = readPlayerNames()
  renderResults()
}

function onPlayerNamesChanged() {
  playerNames = readPlayerNames()
  renderResults()
}

function onForbiddenPairsChanged() {
  forbiddenPairs = readForbiddenPairs(playerNames)
}

/**
 * Given the current playerNames and the value of the forbiddenPairs input field,
 * recomputes the cached set of forbiddenPairs by index.
 * @param {Array<string>} playerNames
 * @return {Immutable.Set<Immutable.Set<number>>}
 */
function readForbiddenPairs(playerNames) {
  return controls.forbiddenPairs.val()
    .split('\n')
    .map(stringPair =>
      stringPair
        .split(',')
        .map(name =>name.trim())
    )
    .filter(pair => pair.length === 2) // Drop lines that aren't pairs
    .reduce((memo, [leftName, rightName]) => {
      const leftIndices = indicesOf(leftName, playerNames)
      const rightIndices = indicesOf(rightName, playerNames)
      for (const leftIndex of leftIndices) {
        for (const rightIndex of rightIndices) {
          if (leftIndex !== rightIndex) {
            memo = memo.add(Immutable.Set([leftIndex, rightIndex]))
          }
        }
      }
      return memo
    }, Immutable.Set())
}

function indicesOf(needle, haystack) {
  const indices = []
  let nextIndex = -1
  do {
    nextIndex = haystack.indexOf(needle, nextIndex + 1)
    if (nextIndex > -1) indices.push(nextIndex)
  } while (nextIndex > -1)
  return indices
}

function playerName(i) {
  return playerNames[i] ? playerNames[i] : `${i+1}`
}

function renderResults() {
  resultsDiv.html('')
  if (lastResults) {
    lastResults.rounds.forEach((round, roundIndex) => {
      const roundDiv = document.createElement('div')
      roundDiv.classList.add('round')
      roundDiv.classList.add('col-xl-3')
      roundDiv.classList.add('col-md-6')
  
      const header = document.createElement('h3')
      header.textContent = `Round ${roundIndex+1} - CS [${lastResults.roundScores[roundIndex]}]`
  
      const groups = document.createElement('div')
      groups.classList.add('groups')
  
      round.forEach((group, groupIndex) => {
        const groupDiv = document.createElement('div')
        groupDiv.classList.add('group')
        const members = document.createElement('p')
        members.innerHTML = `<b>Group ${groupIndex + 1}</b>: `
  
        group.sort((a, b) => parseInt(a) < parseInt(b) ? -1 : 1).forEach(personNumber => {
          var red = 220 - (personNumber**2) % 200
          var green = 240 - (personNumber*6) % 155
          var blue = 255 - (personNumber*10) % 55
          var back = red + ", " + green +", " + blue
          members.innerHTML += `<span class="member-nr" style="background: rgb(${back})">` + playerName(personNumber) + "</span> "
        })
        groupDiv.appendChild(members)
  
        groups.appendChild(groupDiv)
      })
  
      roundDiv.appendChild(header)
      roundDiv.appendChild(groups)
      resultsDiv.append(roundDiv)
    })
    
    if (lastResults.done) {
      // Summary div - total time and CSV download
      const summaryDiv = document.createElement('div')
      summaryDiv.classList.add('col-12')
      summaryDiv.style.borderTop = 'solid #aaaaaa thin'
      summaryDiv.style.padding = '7px 0'
      summaryDiv.style.marginTop = '1em'
      const elapsedSecs = Math.round((Date.now() - startTime) / 100) / 10
      const elapsedTime = document.createElement('span')
      elapsedTime.style.margin = '0 1em'
      elapsedTime.style.fontStyle = 'italic'
      elapsedTime.style.fontSize = 'smaller'
      elapsedTime.textContent = `Computed in ${elapsedSecs} seconds.`
      summaryDiv.appendChild(elapsedTime)
      resultsDiv.append(summaryDiv)
    } else {
      resultsDiv.html('<h3>Thinking...</h3>');
    }
  }
}

document.addEventListener('DOMContentLoaded', init)

/**
// * Comment block due to local issues in file update
// * ----------------------------------------------- */
// * -----------------------------------------------
// * -----------------------------------------------
// * -----------------------------------------------
// * -----------------------------------------------
// * -----------------------------------------------
// * -----------------------------------------------

