

<div> <p>Le shortcode du <?= $slug_post_type ?>  est :
        <?php if(isset($wh_filtre) && $wh_filtre) : ?>
        [<?= wh_short_code().' '.wh_post_short_code().'='. $slug_post_type.'] [type=filtre, '.$wh_filtre ?>] [/<?=  wh_short_code()?>] </p> </div>
        <?php else :?>
        [<?= wh_short_code().' '.wh_post_short_code().'='. $slug_post_type.' '?>] </p> </div>
        <?php endif; ?>