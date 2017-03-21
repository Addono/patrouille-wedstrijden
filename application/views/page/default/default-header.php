<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 29-1-2017
 */
?>
<div class="col-md-12 col-md-offset-0 vmargin">
    <h1><?=lang('application_name')?></h1>
    <h4>Hier vind je hoe de punten verdeeld worden en de huidige tussenstand.</h4>
    <ol>
        <?php foreach($sum as $group => $points) { ?>
            <li><?=ucfirst($group)?>: <?=$points?></li>
        <?php } ?>
    </ol>
    <a class="btn btn-warning" href="<?=site_url('Week').'/1'?>">Week 1</a>
    <a class="btn btn-warning" href="<?=site_url('Week').'/2'?>">Week 2</a>
    <a class="btn btn-warning" href="<?=site_url('Week').'/3'?>">Week 3</a>
    <a class="btn btn-warning" href="<?=site_url('Week').'/4'?>">Week 4</a>
</div>