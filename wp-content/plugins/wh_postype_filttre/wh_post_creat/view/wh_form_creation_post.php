<form method="post" action="<?= admin_url(); ?>?page=wh_custom_post">

  <div class="wh_creat_post">

    <div class="wh_tittle_post">
      <h3> entre les information du spost type </h3>
    </div>
    <div class="wh_parameter_post">

      <div class="wh_label_nom_post">
        <label for="nom_post">nom du post :</label></div>
      <div class="wh_nom_post">
        <input id="nom_post" type="text" name="nom_post"
               value="<?php
				       if ( isset( $postType ) && is_object( $postType ) ) {
					       echo $postType->getNom_post();
				       }
				       ?>" required=""/>
      </div>

      <div class="wh_label_noms_post">
        <label for="noms_post">noms en pluriel du post :</label></div>
      <div class="wh_noms_post">
        <input id="noms_post" type="text" name="noms_post"
               required="" value="<?php
				if ( isset( $postType ) && is_object( $postType ) ) {
					echo $postType->getNoms_post();
				}
				?>"/></div>

      <div class="wh_label_nom_menu">
        <label for="nom_menu">nom du menu :</label></div>
      <div class="wh_nom_menu">
        <input id="nom_menu" type="text" name="nom_menu"
               value="<?php
				       if ( isset( $postType ) && is_object( $postType ) ) {
					       echo $postType->getNom_menue();
				       }
				       ?>" required=""/></div>

      <div class="wh_description_post">
        <label for="description_post">description :</label></div>
      <div class="wh_label_description_post">
        <input type="text" name="description_post"
               value="<?php
				       if ( isset( $postType ) && is_object( $postType ) ) {
					       echo $postType->getDescription();
				       }
				       ?>" required=""/></div>

    </div>

  </div>
  <input type="hidden" name="creation" value="post"/>
	<?php if ( isset( $postType ) && is_object( $postType ) ) { ?>
    <input type="hidden" name="postype_Slug" value="<?= $postType->getId(); ?>">

	<?php } ?>
  <div class="wh_button_valid"> <?php submit_button( 'valider' ); ?> </div>
</form>
