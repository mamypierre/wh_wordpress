<form method="post" action="<?= admin_url(); ?>?page=wh_custom_post">

  <div class="wh_creat_post">

    <div class="wh_tittle_post">
      <h3>Détails du nouveau Custom Post Type</h3>
    </div>
    <div class="wh_parameter_post">

      <div class="wh_label_nom_post">
        <label for="nom_post">Nom :</label></div>
      <div class="wh_nom_post">
        <input id="nom_post" type="text" name="nom_post"
               value="<?php
               if ( isset( $postType ) && is_object( $postType ) ) {
                 echo $postType->getNom_post();
               }
               ?>" required="" class="regular-text"/>
      </div>

      <div class="wh_label_noms_post">
        <label for="noms_post">Nom au pluriel :</label></div>
      <div class="wh_noms_post">
        <input  class="regular-text" id="noms_post" type="text" name="noms_post"
               required="" value="<?php
        if ( isset( $postType ) && is_object( $postType ) ) {
          echo $postType->getNoms_post();
        }
        ?>"/></div>

      <div class="wh_label_nom_menu">
        <label for="nom_menu">Intitulé du menu Wordpress :</label></div>
      <div class="wh_nom_menu">
        <input  class="regular-text" id="nom_menu" type="text" name="nom_menu"
               value="<?php
               if ( isset( $postType ) && is_object( $postType ) ) {
                 echo $postType->getNom_menue();
               }
               ?>" required=""/></div>

      <div class="wh_description_post">
        <label for="description_post">slug url :</label></div>
      <div class="wh_label_description_post">
        <input  class="regular-text" type="text" name="description_post"
               value="<?php
               if ( isset( $postType ) && is_object( $postType ) ) {
                 echo $postType->getDescription();
               }
               ?>" required=""/></div>

         <div class="wh_icon_label">
           <label for="wh_icon">icon :</label></div>
         <div class="wh_icon">
           <input class="regular-text" type="text" name="wh_icon_post"
              value="<?php
              if ( isset( $postType ) && is_object( $postType ) ) {
                  echo $postType->getIcon();
                }
              ?>" required=""/></div>


    </div>

  </div>
  <input  type="hidden" name="creation" value="post"/>
  <?php if ( isset( $postType ) && is_object( $postType ) ) { ?>
    <input type="hidden" name="postype_Slug" value="<?= $postType->getId(); ?>">

  <?php } ?>

        <div id="ajout_meta" >
          <label for="wh_ajout" >Utiliser une map pour ce CPT ?</label>
          <div>  <input type="checkbox" id="wh_ajout" name="ajout_meta"
            <?php
            if (isset( $postType ) && get_option(wh_get_nom_meta($postType->getId())) == AJOUT_META) : ?>
            checked
          <?php  endif
             ?>
            > </div>
        </div>
  <div class="wh_button_valid"> <?php submit_button( 'Valider' ); ?>  </div>
</form>
