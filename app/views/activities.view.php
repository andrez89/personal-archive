<?php require('partials/head.php'); ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Min. Duration</th>
                        <th>Max. Duration</th>
                        <th>Min. Participants</th>
                        <th>Max. Participants</th>
                        <th>Type</th>
                        <th>Objective</th>
                        <th>Inserted</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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
        return d.description + "<hr>Tags: " + d.tag +
            "<br>Place: " + d.place + "<br>Music: " + d.music;
    }

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "/api/activities",
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
                    "data": "duration_min"
                },
                {
                    "data": "duration_max"
                },
                {
                    "data": "participant_min"
                },
                {
                    "data": "participant_max"
                },
                {
                    "data": "type"
                },
                {
                    "data": "objective"
                },
                {
                    "data": "inserted"
                }
            ],
            "order": [
                [1, 'asc']
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