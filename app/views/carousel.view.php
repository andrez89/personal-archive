<?php require('partials/head.php'); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Groups generator
    </h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="form-group">
            <label id="groupsLabel">Group Numbers</label>
            <input class="form-control" id="groupsSlider" type="range" name="groups" min="2" max="30" value="6">
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="form-group">
            <label id="ofSizeLabel">Group Size</label>
            <input class="form-control" id="ofSizeSlider" type="range" name="members" min="2" max="30" value="5">
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="form-group">
            <label id="forRoundsLabel">Rounds</label>
            <input class="form-control" id="forRoundsSlider" type="range" name="rounds" min="2" max="20" value="4">
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="form-group">
            <label>Total Paritcipants</label>
            <input class="form-control" type="number" id="total" name="total" disabled>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 row">
        <div class="col-xl-4 col-md-8">
            <div class="form-group">
                <label>Advanced Parameters</label>
                <input type="checkbox" id="advanced">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-8 adv" style="display: none">
            <div class="form-group">
                <label>Participant names (separate with comma or new line)</label>
                <textarea class="form-control" id="playerNames" rows="3"></textarea>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 adv" style="display: none">
            <div class="form-group">
                <label>Forbidden Pairs</label>
                <textarea class="form-control" id="forbiddenPairs" rows="3"></textarea>
            </div>
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


<?php require('partials/footer.php'); ?>