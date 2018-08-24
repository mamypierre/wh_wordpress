
<form method="post" action="">
    <div class="wh_creat_taxo"> 

        <?php
        for ($i = 0; $i < $nunbre_taxo; $i++) { ?>
        
           <?php  formulaire_taxo($i); ?>
        
      <?php  } ?>

        <input type="hidden" name="ajout_taxo" value="<?= $nunbre_taxo ?>"/>
        <input type="hidden" name="post_name" value="<?= $postes_choix ?>"/>
        <?php submit_button('ajouter un taxonomie'); ?>
    </div>
</form>



<?php

function formulaire_taxo($i) { ?>

    <div class="wh_tittle_taxo"> 
        <h3> parametre taxonomie <?= $i+1; ?> </h3> </div>
    <div class="wh_parameter_taxo" >
        <div class="wh_label_nom_taxo" > 
            <label for="nom_taxo" >nom du taxonomie :</label> </div>
        <div class="wh_nom_taxo" > 
            <input required="" id="nom_taxo" type="text" name="wh_nom_taxo<?= $i; ?>" value="" placeholder="nom aux singuliers" /> </div>
        <div class="wh_label_noms_taxo" > 
            <label for="noms_taxo" >noms du taxonomie :</label> </div>
        <div class="wh_noms_taxo" > 
            <input required="" id="noms_taxo" type="text" name="wh_noms_taxo<?= $i; ?>" value="" placeholder="nom aux pluriel"/> </div>
        <div class="wh_label_nom_recherche" > 
            <label for="nom_taxo_research" >nom du recherche :</label> </div>
        <div class="wh_nom_taxo_recherche" > 
            <input  required="" id="nom_taxo_recherche" type="text" name="wh_nom_taxo_recherche<?= $i; ?>" value=""/> </div>
        <div class="wh_label_nom_recherche" > 
            <label for="nom_taxo_research" >nom du menu :</label> </div>
        <div class="wh_nom_taxo_recherche" > 
            <input  required="" id="nom_taxo_recherche" type="text" name="wh_nom_taxo_menu<?= $i; ?>" value=""/> </div>
    </div>

    <?php
}
