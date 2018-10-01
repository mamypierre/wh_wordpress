<div class="section">

    <div class="columns is-gapless" >
        <div class="column"> 

            <div class="wh_containers columns is-multiline is-gapless " >

                <div class="column is-12 has-background-info" style="height: 60px;" >
                    <div class="title is-6 ">
                        <p class="wh_titre ">titre</p>
                    </div>
                </div>

                <p hidden class="postetype_slug"><?= $postetype ?></p>
                <p hidden id="wh_apiGoogle"><?= get_option(WH_GOOGLE) ?></p>

                <div id="wh_filtres" class="column" > 
                    <div class="columns is-multiline" >

                        <?php
                        if ($tabFiltre_taxo) : ?>
                            <?php foreach ($tabFiltre_taxo as $filtre_taxo_objet): ?>

                                <div class="wh_filtre column is-12"> 
                                    <div class="has-background-white">
                                        <div class="taxo_title title is-6 has-text-centered" >
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