<?php require('partials/head.php'); ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th>Uke Lv</th>
                        <th>Git Lv</th>
                        <th>Added</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <hr>
        <div>
            <label class="h4">Sources</label>
            <ul>
                <li>
                    <a href="#img" id="img-toggle">Ukulele Basic Chords</a> and complete
                    <a target="_blank" href="https://ukuchords.com/files/UkuChords_Complete180ChordChartsPDF_Standard.pdf">Chords Sheet</a>
                    <script>
                        var show_img = 0;
                        $("#img-toggle").click(function() {
                            if (show_img == 0) {
                                $(".img-chords").show();
                                show_img = 1;
                            } else {
                                $(".img-chords").hide();
                                show_img = 0;
                            }
                        });
                    </script>
                    <img class="img-chords" style="max-width: 100%; display: none" src="https://i.pinimg.com/originals/ef/6b/d0/ef6bd073cf346985ff7b2d53dcb4bd66.jpg">
                </li>
                <li>
                    <a href="#img2" id="img-toggle2">Guitar Basic Chords</a> and complete
                    <a target="_blank" href="https://lessons.com/guitar-lessons/guitar-chords/guitar-chords-chart">Chords chart</a>
                    <script>
                        var show_img2 = 0;
                        $("#img-toggle2").click(function() {
                            if (show_img2 == 0) {
                                $(".img-chords2").show();
                                show_img2 = 1;
                            } else {
                                $(".img-chords2").hide();
                                show_img2 = 0;
                            }
                        });
                    </script>
                    <img class="img-chords2" style="max-width: 100%; display: none" src="https://sites.google.com/site/guitarworkshopwales/_/rsrc/1333908334458/chords-diagrams/major-guitar-chords.jpg">
                </li>
                <li><a href="https://ukutabs.com/" target="_blank">
                        UkeTabs</a></li>
                <li><a href="https://ukulele-tabs.com/" target="_blank">
                        Ukulele Tabs</a></li>
                <li><a href="#" target="_blank">
                        Beginner Course</a></li>
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
        return '<ul class="nav nav-tabs">' +
            ' <li class="nav-item"><a class="nav-link active" href="#lyrics' + d.id +
            '" id="lyrics' + d.id + '-tab" data-toggle="tab" role="tab" aria-controls="lyrics' + d.id + '" aria-selected="true">Lyrics</a></li>' +
            ' <li class="nav-item"><a class="nav-link" href="#video' + d.id +
            '" id="video' + d.id + '-tab" data-toggle="tab" role="tab" aria-controls="video' + d.id + '" aria-selected="false">Video</a></li></ul>' +

            '<div class="tab-content" id="myTabContent">' +
            ' <div class="tab-pane fade show active" id="lyrics' + d.id +
            '" role="tabpanel" aria-labelledby="lyrics-tab"><pre>' + d.lyrics + '</pre></div>' +
            ' <div class="tab-pane" id="video' + d.id +
            '" role="tabpanel" aria-labelledby="video-tab">' + d.embed + '</div>'
        '</div>';
    }

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "/api/ukulele-songs<?= $secret ?>",
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "title",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html(oData.title + " &nbsp; " + (oData.link1 != "" ?
                                " <a target='_blank' href='" + oData.linkUke + "'><i class=\"fas fa-external-link-alt\"></i></a> &nbsp; " : " ") +
                            (oData.link2 != "" ?
                                " <a target='_blank' href='" + oData.linkGuitar + "'><i class=\"fas fa-external-link-alt\"></i></a>" : " "));
                    }
                },
                {
                    "data": "artist"
                },
                {
                    "data": "genre"
                },
                {
                    "data": "difficultyUke"
                },
                {
                    "data": "difficultyGit"
                },
                {
                    "data": "inserted"
                }
            ],
            "order": [
                [6, 'desc']
            ],
            "lengthMenu": [
                [10, 25, -1],
                [10, 25, "All"]
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