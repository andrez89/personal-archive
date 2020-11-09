<?php require('partials/head.php'); ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($songs as $s) { ?>
                        <tr>
                            <td>
                                <a href="?id=<?= $s["id"] ?>">
                                    <i class="h2 far fa-eye"></i></a>
                            </td>
                            <td><?= $s["title"] ?>
                                <a href="<?= $s["link"] ?>">
                                    <i class="fas fa-external-link-alt"></i></a>
                            </td>
                            <td><?= $s["counter"] ?></td>
                            <td><?= $s["embed"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div>
            <label class="h4">Sources</label>
            <ul>
                <li><a href="https://capoeiramandingamilano.com/musica/" target="_blank">
                        Mandinga Milan</a></li>
                <li><a href="http://capoeirashanghai.com/songbook" target="_blank">
                        Mandinga Shangai</a></li>
                <li><a href="http://www.capoeira-music.net/all-capoeira-songs/" target="_blank">
                        CapoeiraMusic.net</a></li>
                <li><a href="https://capoeiralyrics.info/" target="_blank">
                        CapoeiraLyrics.info</a></li>
                <li><a href="https://en.wikipedia.org/wiki/List_of_capoeira_techniques" target="_blank">
                        Capoeira Techniques</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    td.details-control {
        background: url('/public/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('/public/images/details_close.png') no-repeat center center;
    }
</style>
<script>
    function format(d) {
        // `d` is the original data object for the row
        return '<div class="row">' +
            '<div class="col-xl-4 col-md-6"><pre>' + d.lyrics + '</pre></div>' +
            '<div class="col-xl-8 col-md-6">Video:<br>' + d.embed +
            (d.embed2 == "" ? "" : '<hr>Additional Video:<br>' + d.embed2 + '</div>') +
            '</div>';
    }

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "/api/capoeira-songs",
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "title"
                },
                {
                    "data": "counter"
                }
            ],
            "order": [
                [1, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]
        });

        // Add event listener for opening and closing details
        $('#dataTable tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>

<?php require('partials/footer.php'); ?>