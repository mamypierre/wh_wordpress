<?php if (isset($taxo)) { ?>
    <form method="post" action="<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=editeAdd">
    <?php } else { ?>
        <form method="post" action="">
        <?php } ?>
        <div class="wh_creat_taxo">
            <?php for ($i = 0; $i < $nunbre_taxo; $i++) { ?>

                <?php
                if (isset($taxo)) {
                    formulaire_taxo($i, $taxo);
                } else {
                    formulaire_taxo($i);
                }
                ?>

            <?php } ?>

            <input type="hidden" name="ajout_taxo" value="<?= $nunbre_taxo ?>"/>
            <input type="hidden" name="id_post" value="<?= $post_type ?>"/>
            <?php if (isset($taxo)) { ?>
            <input type="hidden" name="id_post_taxo" value="<?= $taxo->getId_post() ?>"/>
            <input type="hidden" name="id_taxo" value="<?= $taxo->getId_taxo() ?>"/>
            <?php } ?>
            <?php submit_button('Ajouter la taxonomie'); ?>
        </div>
    </form>



    <?php

    function formulaire_taxo($i, $taxo = '') { ?>

        <div class="wh_tittle_taxo">
            <h3>Détail de la taxonomie <?= $i + 1; ?> </h3> </div>
        <div class="wh_parameter_taxo" >
            <div class="wh_label_nom_taxo" >
                <label for="nom_taxo" >Nom :</label> </div>
            <div class="wh_nom_taxo" >
                <input required="" id="nom_taxo" type="text" name="wh_nom_taxo[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo() ?>"  <?php } ?> placeholder="Nom au singulier" /> </div>
            <div class="wh_label_noms_taxo" >
                <label for="noms_taxo" >Nom au pluriel :</label> </div>
            <div class="wh_noms_taxo" >
                <input required="" id="noms_taxo" type="text" name="wh_noms_taxo[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_noms_taxo() ?>"  <?php } ?> placeholder="Nom au pluriel"/> </div>
            <div class="wh_label_nom_recherche" >
                <label for="nom_taxo_research" >Nom de la recherche :</label> </div>
            <div class="wh_nom_taxo_recherche" >
                <input  required="" id="nom_taxo_recherche" type="text" name="wh_nom_taxo_recherche[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo_recherche() ?>"  <?php } ?>/> </div>
            <div class="wh_label_nom_recherche" >
                <label for="nom_taxo_research" >Intitulé du menu :</label> </div>
            <div class="wh_nom_taxo_recherche" >
                <input  required="" id="nom_taxo_recherche" type="text" name="wh_nom_taxo_menu[<?= $i; ?>]" <?php if ($taxo) { ?> value="<?= $taxo->getWh_nom_taxo_menu() ?>"  <?php } ?>/> </div>
        </div>

        <?php
    }
