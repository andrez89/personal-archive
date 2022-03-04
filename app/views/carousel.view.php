<?php require('partials/head.php'); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Groups generator
    </h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 col">
        <div class="form-group">
            <label id="groupsLabel">Group Numbers</label>
            <input class="form-control" id="groupsSlider" type="range" name="groups" min="2" max="30" value="6">
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col">
        <div class="form-group">
            <label id="ofSizeLabel">Group Size</label>
            <input class="form-control" id="ofSizeSlider" type="range" name="members" min="2" max="30" value="4">
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col">
        <div class="form-group">
            <label id="forRoundsLabel">Rounds</label>
            <input class="form-control" id="forRoundsSlider" type="range" name="rounds" min="2" max="20" value="4">
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col">
        <div class="form-group">
            <label>Total Paritcipants</label>
            <input class="form-control" type="number" id="total" name="total" disabled>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1 col">
        <div class="form-group">
            <input type="checkbox" id="advanced" checked>
            <label>Advanced Parameters</label>
        </div>
    </div>
    <div class="col-md-4 col adv">
        <div class="form-group">
            <label>Participant names <small>(separated by comma or new line)</small></label>
            <textarea class="form-control" id="playerNames" rows="3"></textarea>
        </div>
    </div>
    <div class="col-md-4 col adv">
        <div class="form-group">
            <label>Forbidden Groups <small>(list of names per line, spearated by comma)</small></label>
            <textarea class="form-control" id="forbiddenGroups" onchange="makePairs()" rows="3"></textarea>
        </div>
    </div>
    <div class="col-md-3 col adv">
        <div class="form-group">
            <label>Forbidden Pairs</label>
            <textarea class="form-control" id="forbiddenPairs" rows="3" readonly></textarea>
        </div>
    </div>
</div>
<div class="row">
    <button class="btn btn-primary" id="recomputeButton">Generate</button>
</div>

<hr>
<div class="row" id="results">
</div>

<script src="/<?= BASE_PATH ?>public/js/immutable.min.js"></script>
<script src="/<?= BASE_PATH ?>public/js/socialGolfer/index.js" type="text/javascript"></script>
<script>
    function makePairs(){
        var groups = $("#forbiddenGroups").val(),
            pairText = $("#forbiddenPairs");
        
        gps = groups.split(',');
        groups = "";
        gps.forEach( function(g1) { gps.forEach( function(g2) { groups += g1.trim() + ',' + g2.trim() + "\n" }) });
        // 
        pairText.val(groups);
    }
</script>
<?php require('partials/footer.php'); ?>