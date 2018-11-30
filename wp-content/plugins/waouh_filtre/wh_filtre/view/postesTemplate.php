<div class="section">

    <div class="columns " >
        <div class="column wh_cont">

            <div class="wh_containers columns is-multiline " >

                <!-- <div class="column is-12 has-background-white-ter" style="height: 60px;" >
                    <div class="title is-6 ">
                        <p class="wh_titre">titre</p>
                    </div>
                </div> -->

                <p hidden class="postetype_slug"><?= $postetype ?></p>

                <div id="wh_filtres" class="column" >
                    <div class="columns is-multiline" >

                        <?php if ($tabFiltre_taxo) : ?>
                            <?php foreach ($tabFiltre_taxo as $filtre_taxo_objet): ?>

                                <div class="wh_filtre column is-12" id="wh_filtres">
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
                                        <?php if ($tab_tax_query && $tab_tax_query[0]):
                                           include plugin_dir_path(__FILE__) . 'filtre_ex.php';
                                          endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (isset($tab_post_fields) && $tab_post_fields) : ?>
                            <?php foreach ($tab_post_fields as $tab_post_field): ?>
                              <?php
                                switch ($tab_post_field->getType()) {
                                    case 'range':
                                        ?>

                                        <div class="wh_filtre_range column is-12" slug="<?= $tab_post_field->getSlug(); ?>" >
                                            <p>
                                                <label for="amount"><?= $tab_post_field->getLabel(); ?>:</label>
                                                <input type="text" class="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                                <input hidden="" class="wh_value_min" min="<?= $tab_post_field->getMin(); ?>" readonly value="<?= $tab_post_field->getMax(); ?>" >
                                                <input hidden="" class="wh_value_max" max="" readonly value="" >
                                            </p>
                                            <div class="slider-range"  min="<?= $tab_post_field->getMin(); ?>" max="<?= $tab_post_field->getMax(); ?>" symbole="<?= $tab_post_field->getSymbole(); ?>"></div>
                                        </div>

                                        <?php
                                        break;
                                    case 'select':
                                        ?>

                                        <div class="wh_meta_range column is-12" >
                                            <div class="has-background-white">
                                                <div class="meta_title title is-6">
                                                    <h5>
                                                        <?= $tab_post_field->getLabel() ?>
                                                    </h5>
                                                </div>
                                                <div class="wh_metas_select" wh_key_meta="<?= $tab_post_field->getSlug() ?>" >
                                                    <select class="wh_meta" name="wh_meta" multiple  style="width:100% " >


                                                        <?php foreach ($tab_post_field->getMetas() as $meta) : ?>

                                                            <option value="<?= $meta->meta_value ?>" > <?= $meta->meta_value ?> </option>

                                                        <?php endforeach; ?>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;

                                    case 'checkbox':
                                        ?>

                                        <div class="wh_meta_range column is-12" >
                                            <div class="has-background-white">
                                                <div class="meta_title title is-6">
                                                    <h5>
                                                        <?= $tab_post_field->getLabel() ?>
                                                    </h5>
                                                </div>
                                                <div class="wh_metas_checkbox columns is-multiline" wh_key_meta="<?= $tab_post_field->getSlug() ?>" >

                                                    <?php foreach ($tab_post_field->getMetas() as $meta) : ?>

                                                        <div class="wh_meta_checkbox column is-6" >
                                                            <label class="meta_checkbox">
                                                                <input type="checkbox" name="meta_check" value="<?= $meta->meta_value ?>" class="wh_check" ><?= $meta->meta_value ?>
                                                            </label>
                                                        </div>

                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;

                                    case 'radio':
                                        ?>

                                        <div class="wh_meta_range column is-12" >
                                            <div class="has-background-white">
                                                <div class="meta_title title is-6">
                                                    <h5>
                                                        <?= $tab_post_field->getLabel() ?>
                                                    </h5>
                                                </div>
                                                <div class="wh_metas_radio columns is-multiline" wh_key_meta="<?= $tab_post_field->getSlug() ?>" >

                                                    <?php foreach ($tab_post_field->getMetas() as $meta) : ?>

                                                        <div class="wh_meta_radio column is-6" >
                                                            <label class="meta_radio">
                                                                <input type="radio" name="meta_radio" value="<?= $meta->meta_value ?>" class="wh_check" ><?= $meta->meta_value ?>
                                                            </label>
                                                        </div>

                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                }
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="wh_silde_content">
                            <input type="range" min="0" max="700" value="0" class="wh_silder" id="wh_Range">
                            <p>Rayon:<span id="wh_distance">0km</span></p>
                        </div>
                        <div class="wh_filtre column is-12">
                            <div class="button" id="wh_reinit" >
                                <p>Réinitialiser</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wh_postes_content column is-12-tablet is-9-widescreen"  >
                    <div class="wh_postes active columns is-multiline is-left "  >
                        <?php if(!empty($posts) && is_array($posts)): ?>
                        <?php include plugin_dir_path(__FILE__) . '../controleur/filtre_poste.php'; ?>
                        <?php else : ?>                                                       
                        <p> Désolé, aucun résultat n'a été trouvé </p> 
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-4 wh_map" >
            <div style="height: 100%; width: 100%;" id="wh_map_sticky">
                <div id="wh_map"  style=" width: 100%; " > </div>
            </div>
        </div>
    </div>
</div>
