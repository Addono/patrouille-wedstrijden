<?php
/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 7-3-2017
 */

function displayScore($score) {
    if ($score === 'unknown') {
        return '-';
    } else {
        return $score;
    }
}

$totalScores = [
        'total' => 0,
        'herten' => 0,
        'eksters' => 0,
        'kemphanen' => 0,
        'uilen' => 0,
];
foreach ($data as $d) {
    $factor = $d[Rating::FIELD_FACTOR];
    $score = [
            'total' => 1,
            'herten' => $d[Rating::FIELD_HERTEN],
            'eksters' => $d[Rating::FIELD_EKSTERS],
            'kemphanen' => $d[Rating::FIELD_KEMPHANEN],
            'uilen' => $d[Rating::FIELD_UILEN],
    ];

    foreach ($score as $key => $e) {
        if ($e!=='unknown') {
            $totalScores[$key] += $factor * $e;
        }
    }
}
?>
<div class="col-md-12 vmargin col-md-offset-0">
    <div class="container">
        <div class="card card-signup">
            <div class="header header-primary text-center">
                <h4>Scores week <?=$week?></h4>
            </div>
            <p class="text-divider"></p>
            <div class="content">
                <div class="input-group form-group label-floating center-block">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Spelgebied</th>
                            <th>Onderwerp</th>
                            <th>Factor</th>
                            <th>H</th>
                            <th>E</th>
                            <th>K</th>
                            <th>U</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $count => $d) { ?>
                            <tr>
                                <td><?=$d[Rating::FIELD_AREA]?></td>
                                <td>
                                    <?=$d[Rating::FIELD_SUBJECT]?>
                                    <button class="btn btn-xs btn-simple" data-toggle="modal" data-target="#<?=$count?>">
                                        <i class="fa fa-question"></i>
                                    </button>
                                    <!-- Sart Modal -->
                                    <div class="modal fade" id="<?=$count?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?=$d[Rating::FIELD_SUBJECT]?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?=$d[Rating::FIELD_DESCRIPTION]?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Sluiten</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Modal -->
                                </td>
                                <td><?=displayScore($d[Rating::FIELD_FACTOR])?></td>
                                <td><?=displayScore($d[Rating::FIELD_HERTEN])?></td>
                                <td><?=displayScore($d[Rating::FIELD_EKSTERS])?></td>
                                <td><?=displayScore($d[Rating::FIELD_KEMPHANEN])?></td>
                                <td><?=displayScore($d[Rating::FIELD_UILEN])?></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?=$totalScores['total']?></td>
                                <td><?=$totalScores['herten']?></td>
                                <td><?=$totalScores['eksters']?></td>
                                <td><?=$totalScores['kemphanen']?></td>
                                <td><?=$totalScores['uilen']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>