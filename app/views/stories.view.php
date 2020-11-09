<?php require('partials/head.php'); ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Links</th>
                        <th>Inserted</th>
                        <th>Counter</th>
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
        return '<ul class="nav nav-tabs">' +
            ' <li class="nav-item"><a class="nav-link active" href="#en' + d.id +
            '" id="en' + d.id + '-tab" data-toggle="tab" role="tab" aria-controls="en' + d.id + '" aria-selected="true">English</a></li>' +
            ' <li class="nav-item"><a class="nav-link" href="#it' + d.id +
            '" id="it' + d.id + '-tab" data-toggle="tab" role="tab" aria-controls="it' + d.id + '" aria-selected="false">Italian</a></li></ul>' +

            '<div class="tab-content" id="myTabContent">' +
            ' <div class="tab-pane fade show active" id="en' + d.id +
            '" role="tabpanel" aria-labelledby="en-tab"><pre>' + d.story + '</pre></div>' +
            ' <div class="tab-pane" id="it' + d.id +
            '" role="tabpanel" aria-labelledby="it-tab">' + d.story_it + '</div>'
        '</div>';
    }

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "ajax": "/api/stories",
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "category"
                },
                {
                    "data": "links"
                },
                {
                    "data": "counter"
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