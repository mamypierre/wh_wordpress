<div class="section">

    <div class="columns is-gapless" >
        <div class="column"> 

            <div class="wh_containers columns is-multiline is-gapless " >

                <div class="column is-12 has-background-white-ter" style="height: 60px;" >
                    <div class="title is-6 ">
                        <p class="wh_titre">titre</p>
                    </div>
                </div>

                <p hidden class="postetype_slug"><?= $postetype ?></p>

                <div id="wh_filtres" class="column" > 
                    <div class="columns is-multiline" >

                        <?php if ($tabFiltre_taxo) : ?>
                            <?php foreach ($tabFiltre_taxo as $filtre_taxo_objet): ?>

                                <div class="wh_filtre column is-12"> 
                                    <div class="has-background-white">
                                        <div class="taxo_title title is-6">
                                            <h5>
                                                <?= $filtre_taxo_objet->getSlug_taxo() ?>
                                            </h5>
                                        </div> 
                                        <?php
                                        switch ($filtre_taxo_objet->getType_display()) {
                                            case 'checkbox':
                                                include plugin_dir_path(__FILE__) . 'checkbox.php';

                                                break;
                                            case 'select':
                                                include plugin_dir_path(__FILE__) . 'selection.php';

                                                break;
                                        }
                                        ?>
                                    </div> 
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>   
                        <?php if ($tab_post_fields) : ?>
                            <?php foreach ($tab_post_fields as $tab_post_field): ?>
                                <div class="wh_filtre_range column is-12" slug="<?= $tab_post_field->getSlug(); ?>">
                                    <p>
                                        <label for="amount"><?= $tab_post_field->getLabel(); ?>:</label>
                                        <input type="text" class="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                        <input hidden="" class="wh_value_min" readonly value="" >
                                        <input hidden="" class="wh_value_max" readonly value="" >
                                    </p>
                                    <div class="slider-range"  min="<?= $tab_post_field->getMin(); ?>" max="<?= $tab_post_field->getMax(); ?>"></div>
                                </div>  
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="wh_filtre column is-12">
                            <div class="button" id="wh_reinit" >
                                <p>réinitialiser</p>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="wh_postes_content column is-9" style="height: 100vh;" > 
                    <div class="wh_postes active columns is-multiline is-centered "  >
                        <?php include plugin_dir_path(__FILE__) . '../controleur/filtre_poste.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-4 wh_map ">
            <div style="height: 100vh; width: 100%;" id="wh_map_sticky">
                <div id="wh_map"  style="height: 100%; width: 100%; " > </div>
            </div>
        </div>
    </div>
</div>