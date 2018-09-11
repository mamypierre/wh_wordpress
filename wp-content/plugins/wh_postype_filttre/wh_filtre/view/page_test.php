
<?php $gps = array( array('lg'=>6.492763,'la'=>46.06711),
                    array('lg'=>6.392763,'la'=>46.04711),
                    array('lg'=>6.612763,'la'=>46.02711)
                    );
?>

<div class="wh_container" >
    <div class="columns" >
        <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="item js-markeur" data-lat="<?= $gps[$i]['la'] ; ?>" data-log="<?= $gps[$i]['lg'] ; ?>" > 
                <img src="https://via.placeholder.com/120x70" alt=""> 
                <p>test</p>
            </div>
        <?php } ?>
    </div>
    <div class="wh_map" id="wh_map" ></div>
</div>