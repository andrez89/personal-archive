<?php require('partials/head.php'); ?>

<div class="row">
    <div class="col-xl-3 col-md-6 m-1">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <a class="btn" href="/<?= BASE_PATH ?>carousel">
                <div class="card-body h2 text-bold">
                    Carousel
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 m-1">
        <div class="card border-bottom-secondary shadow h-100 py-2">
            <a class="btn" href="/<?= BASE_PATH ?>schema">
                <div class="card-body h2 text-bold">
                    Schema
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 m-1">
        <div class="card border-bottom-danger shadow h-100 py-2">
            <a class="btn" href="/<?= BASE_PATH ?>stories">
                <div class="card-body h2 text-bold">
                    Stories
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 m-1">
        <div class="card border-bottom-warning shadow h-100 py-2">
            <a class="btn" href="/<?= BASE_PATH ?>ukulele-songs">
                <div class="card-body h2 text-bold">
                    Ukulele Songs
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 m-1">
        <div class="card border-bottom-success shadow h-100 py-2">
            <a class="btn" href="/<?= BASE_PATH ?>capoeira-songs">
                <div class="card-body h2 text-bold">
                    Capoeira Songs
                </div>
            </a>
        </div>
    </div>
</div>

<?php require('partials/footer.php'); ?>