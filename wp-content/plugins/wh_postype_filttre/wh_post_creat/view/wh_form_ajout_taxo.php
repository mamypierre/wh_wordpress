<?php if (isset($taxo)) { ?> 
    <form method="post" action="<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=editeAdd">
    <?php 
  } else { ?>
        <form method="post" action="">
        <?php 
      } ?>
        <div class="wh_creat_taxo">
            <?php for ($i = 0; $i < $nunbre_taxo; $i++) { ?>

                <?php
                if (isset($taxo)) {
                  formulaire_taxo($i, $taxo);
                } else {
                  formulaire_taxo($i);
                }
                ?>

            <?php 
          } ?>

            <input type="hidden" name="ajout_taxo" value="<?= $nunbre_taxo ?>"/>
            <input type="hidden" name="id_post" value="<?= $post_type ?>"/>
            <?php if (isset($taxo)) { ?> 
            <input type="hidden" name="id_post_taxo" value="<?= $taxo->getId_taxo() ?>"/>
            <input type="hidden" name="id_taxo" value="<?= $taxo->getId_post() ?>"/>
            <?php 
          } ?>
            <?php submit_button('ajouter un taxonomie'); ?>
        </div>
    </form>



    <?php
      function formulaire_taxo($i, $taxo = '')
      { 
        /**
         * Listes des filtres disponible dans le filtre
         * text : Texte (input)
         * select : Sélection
         * checkbox : Case à crocher
         * radio : Bouton radio
         */
        $filters = [
          [
            'slug' => 'text',
            'label' => 'Texte (input)'
          ],
          [
            'slug' => 'select',
            'label' => 'Sélection'
          ],
          [
            'slug' => 'checkbox',
            'label' => 'Case à crocher'
          ]
        ];

      ?>

        <div class="wh_tittle_taxo"> 
            <h3> parametre taxonomie <?= $i + 1; ?> </h3> </div>
        <div class="wh_parameter_taxo" >
            <div class="wh_label_nom_taxo" > 
                <label for="nom_taxo" >nom du taxonomie :</label> </div>
            <div class="wh_nom_taxo" > 
                <input required="" id="nom_taxo" type="text" name="wh_nom_taxo[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo() ?>"  <?php 
                                                                                                                                                        } ?> placeholder="nom aux singuliers" /> </div>
            <div class="wh_label_noms_taxo" > 
                <label for="noms_taxo" >noms du taxonomie :</label> </div>
            <div class="wh_noms_taxo" > 
                <input required="" id="noms_taxo" type="text" name="wh_noms_taxo[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_noms_taxo() ?>"  <?php 
                                                                                                                                                          } ?> placeholder="nom aux pluriel"/> </div>
            <div class="wh_label_nom_recherche" > 
                <label for="nom_taxo_research" >nom du recherche :</label> </div>
            <div class="wh_nom_taxo_recherche" > 
                <input  required="" id="nom_taxo_recherche" type="text" name="wh_nom_taxo_recherche[<?= $i; ?>]" 
                <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo_recherche() ?>"  <?php } ?>/> 
            </div>
            
            <div class="wh_label_nom_recherche" > 
              <label for="wh_nom_taxo_menu" >nom du menu :</label> 
            </div>
            <div class="wh_nom_taxo_menu" > 
              <input  required="" id="wh_nom_taxo_menu" type="text" name="wh_nom_taxo_menu[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo_menu() ?>"  <?php 
                                                                                                                                                                        } ?>/> 
            </div>
          
            <div class="wh_label_nom_recherche" > 
              <label for="wh_nom_taxo_menu" >Filtre type :</label> 
            </div>
            <div class="wh_filter_type" > 
              <select id="wh_filter_type" placeholder="Filtre de la recherche" name="wh_filter_type[<?= $i; ?>]" <?= $taxo ? 'disabled' : '' ?>>
                <option value=""></option>
              <?php 
              foreach ($filters as $filter): 
                $selected = $taxo ? $taxo->filter_field : '';
                ?>
                <option value="<?= $filter['slug'] ?>" <?= $selected === $filter['slug'] ? 'selected' : '' ?>><?= $filter['label'] ?></option>
                <?php 
              endforeach; 
              ?>
              </select>
            </div>
        </div>

        <?php

      }
    