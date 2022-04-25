<?php require('partials/head.php'); ?>

<!-- Page Heading -->
<cite>
    <p>Embrace the fact you cannot do math, and just use this! <br>
        <span> - Love, Andre -</span>
    </p>
</cite>

<div class="row">
    <div class="col-xl-2 col-md-3 col-6">
        <div class="form-group">
            <label>Rounds</label>
            <input class="form-control" id="rounds" type="number" name="number" min="1" max="5" value="2">
        </div>
    </div>
    <div class="col-xl-2 col-md-3 col-6">
        <div class="form-group">
            <label>Couples</label>
            <input class="form-control" type="number" id="couples" name="couples" value="2" min="2" max="5">
        </div>
    </div>
</div>
<div class="row" id="timings_0">

</div>
<div class="row" id="timings_1">

</div>
<div class="row" id="timings_2">

</div>
<div class="row" id="timings_3">

</div>
<div class="row" id="timings_4">

</div>

<hr>
<div class="row">
    <div class="col-xl-2 col-md-3 col-6">
        <div class="form-group">
            <label>Start Time</label>
            <input class="form-control" id="start" type="time" name="start" value="12:00">
        </div>
    </div>
    <div class="col-xl-2 col-md-3 col-6">
        <div class="form-group">
            <label>End Time</label>
            <input class="form-control" type="number" id="end" name="end" disabled>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 text-center">
        <button class="btn btn-primary col-6 m-auto" id="recomputeButton">Generate Schema</button>
    </div>
</div>

<hr>
<div class="row" id="results">
</div>

<script>
    var rTimes = [10, 20, 10, 10, 10], // round time
        sTimes = [0, 0, 0, 0, 0, 0], // sharing time
        bTimes = [5, 10, 0, 0, 0], // break time
        gTimes = [30, 0, 0, 0, 30], // group reflection
        pTimes = [5, 0, 0, 0, 30]; // preparation

    function prepareInput(rounds) {
        $('#timings_0').empty();
        $('#timings_1').empty();
        $('#timings_2').empty();
        $('#timings_3').empty();
        $('#timings_4').empty();
        for (var i = 0; i < rounds; i++) {
            var j = i + 1;
            $('#timings_' + i).append("<hr class='col-12'>");
            $('#timings_' + i).append(
                $('<div>', {
                    class: 'col-xl-2 col-md-3 col-6 form-group',
                    id: 'divR_' + i
                })
            );
            $('#timings_' + i).append(
                $('<div>', {
                    class: 'col-xl-2 col-md-3 col-6 form-group',
                    id: 'divS_' + i
                })
            );
            $('#timings_' + i).append(
                $('<div>', {
                    class: 'col-xl-2 col-md-3 col-6 form-group',
                    id: 'divB_' + i
                })
            );
            $('#timings_' + i).append(
                $('<div>', {
                    class: 'col-xl-2 col-md-3 col-6 form-group',
                    id: 'divG_' + i
                })
            );
            $('#timings_' + i).append(
                $('<div>', {
                    class: 'col-xl-2 col-md-3 col-6 form-group',
                    id: 'divP_' + i
                })
            );

            $('#divR_' + i).append('<label>Round ' + j + ' time</label>');
            $('#divR_' + i).append(
                $('<input>', {
                    type: 'number',
                    val: rTimes[i],
                    id: 'r_' + i,
                    min: 0,
                    class: "form-control times"
                })
            );

            $('#divS_' + i).append('<label>Sharing ' + j + ' time</label>');
            $('#divS_' + i).append(
                $('<input>', {
                    type: 'number',
                    val: sTimes[i],
                    id: 's_' + i,
                    min: 0,
                    class: "form-control times"
                })
            );

            $('#divB_' + i).append('<label>Break ' + j + ' time</label>');
            $('#divB_' + i).append(
                $('<input>', {
                    type: 'number',
                    val: bTimes[i],
                    id: 'b_' + i,
                    min: 0,
                    class: "form-control times"
                })
            );

            $('#divG_' + i).append('<label>Group Ref. ' + j + ' time</label>');
            $('#divG_' + i).append(
                $('<input>', {
                    type: 'number',
                    val: gTimes[i],
                    id: 'g_' + i,
                    min: 0,
                    class: "form-control times"
                })
            );

            $('#divP_' + i).append('<label>Preparation ' + j + ' time</label>');
            $('#divP_' + i).append(
                $('<input>', {
                    type: 'number',
                    val: pTimes[i],
                    id: 'p_' + i,
                    min: 0,
                    class: "form-control times"
                })
            );
        }
         $('.times').on('change', updateValues);
    }

    function createResult(rounds, couples, start) {
        var timer = timeToMinutes(start);
        $('#results').empty();
        $('#results').append('<h2 class="col-12">Start time: ' + start + '</h2>');
        for (var i = 0; i < rounds; i++) {
            $('#results').append($('<div>', {
                id: 'card_' + i,
                class: "card bg-white rounded m-2 col-md-4 col-12"
            }));
            $('#card_' + i).append($('<div>', {
                id: 'results_' + i,
                class: "card-body row"
            }));
            $('#results_' + i).append('<h2 class="col-12">Round ' + (i + 1) + '</h2>');
            for (var j = 0; j < couples; j++) {
                $('#results_' + i).append('<h3 class="col-12 mt-2">Couple ' + String.fromCharCode(97 + j).toUpperCase() + '</h3>');
                if (rTimes[i] > 0) {
                    $('#results_' + i).append(
                        '<h4 class="col-6">Session: </h4><h4 class="col-6">' + minsToTime(timer) + ' - ' + minsToTime(timer + rTimes[i]) + '</h4>');
                    timer += rTimes[i];
                }
                if (sTimes[i] > 0) {
                    $('#results_' + i).append(
                        '<h4 class="col-6">Sharing: </h4><h4 class="col-6">' + minsToTime(timer) + ' - ' + minsToTime(timer + sTimes[i]) + '</h4>');
                    timer += sTimes[i];
                }
                if (bTimes[i] > 0) {
                    $('#results_' + i).append(
                        '<h4 class="col-6">Break: </h4><h4 class="col-6">' + minsToTime(timer) + ' - ' + minsToTime(timer + bTimes[i]) + '</h4>');
                    timer += bTimes[i];
                }
                if (gTimes[i] > 0) {
                    $('#results_' + i).append(
                        '<h4 class="col-6">Group Refl.: </h4><h4 class="col-6">' + minsToTime(timer) + ' - ' + minsToTime(timer + gTimes[i]) + '</h4>');
                    timer += gTimes[i];
                }
                if (pTimes[i] > 0) {
                    $('#results_' + i).append(
                        '<h4 class="col-6">Preparation: </h4><h4 class="col-6">' + minsToTime(timer) + ' - ' + minsToTime(timer + pTimes[i]) + '</h4>');
                    timer += pTimes[i];
                }
            }
        }
    }

    function generateSchema() {
        var couples = $('#couples').val(),
            rounds = $('#rounds').val(),
            start = $('#start').val();

        prepareInput(rounds);
        createResult(rounds, couples, start);
    }

    function timeToMinutes(time) {
        arrTime = time.split(':');
        return parseInt(arrTime[0]) * 60 + parseInt(arrTime[1]);
    }

    function minsToTime(minutes) {
        hours = Math.round(minutes / 60) % 24;
        minutes = minutes % 60;
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes;
    }

    function updateValues() {
        var rounds = $('#rounds').val();
        for (var i = 0; i < rounds; i++) {
            rTimes[i] = parseInt($('#r_' + i).val());
            sTimes[i] = parseInt($('#s_' + i).val());
            bTimes[i] = parseInt($('#b_' + i).val());
            gTimes[i] = parseInt($('#g_' + i).val());
            pTimes[i] = parseInt($('#p_' + i).val());
        }
        generateSchema();
    }

    $('#couples').on('change', generateSchema);
    $('#rounds').on('change', generateSchema);
    $('#start').on('change', generateSchema);
    $('#recomputeButton').on('click', generateSchema);

    generateSchema();
</script>
<?php require('partials/footer.php'); ?>