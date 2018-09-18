

<div class="wh_containers" >
    <p hidden class="postetype_slug"><?= $postetype ?></p>
    <div id="wh_filtres" > 
        <?php if ($tabFiltre_taxo) : $indiceCheck = 0; $indiceSelects =0 ;?>
            <?php foreach ($tabFiltre_taxo as $filtre_taxo_objet): ?>
                <div class="wh_filtre"> 
                    <div class="taxo_title" >
                        <h5>
                            <?= $filtre_taxo_objet->getSlug_taxo() ?>
                        </h5>
                    </div> 
                    <?php
                    switch ($filtre_taxo_objet->getType_display()) {
                        case 'checkbox':
                            $indiceCheck++ ;
                            include plugin_dir_path(__FILE__) . 'checkbox.php';
                            
                            break;
                        case 'select':
                            $indiceSelects++ ;
                            include plugin_dir_path(__FILE__) . 'selection.php';

                            break;
                        
                    }
                    ?>
                </div> 
            <?php endforeach; ?>
        <p hidden="" id="indiceCheck"><?= $indiceCheck ; ?></p>
        <p hidden="" id="indiceSelects"><?= $indiceSelects ; ?></p>
        <?php endif; ?>   

    </div>
    <div class="wh_postes_content"> 
        <div class="wh_postes active"  >
            <?php include plugin_dir_path(__FILE__) . '../controleur/filtre_poste.php'; ?>
        </div>
    </div>

    <div class="wh_carte" > carte </div>
</div>