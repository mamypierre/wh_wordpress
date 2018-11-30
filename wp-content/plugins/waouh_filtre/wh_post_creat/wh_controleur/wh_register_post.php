<?php

/*
 * cet class permer d'enregister les post type aves les option
 */


if (isset($_POST['nom_post']) && isset($_POST['noms_post']) && isset($_POST['nom_menu']) && isset($_POST['description_post'])) {

    $post_single_name = trim($_POST['nom_post']);
    $post_plural_name = trim($_POST['noms_post']);
    $nom_menu = trim($_POST['nom_menu']);
    $description_post = trim($_POST['description_post']);
    $wh_icon = trim($_POST['wh_icon_post']);

    if ($post_single_name && $post_plural_name && $nom_menu && $description_post) {
        if (getPostypesObjet()) {
            $post_types = getPostypesObjet();
            if (false === $post_types) {
                return;
            }
            $post_typesTab = $post_types->getPosteTyps();
            $count = count($post_typesTab);

            if (isset($_POST['postype_Slug'])) {
                
                $id = $_POST['postype_Slug'];

                if (isPostype($id, $post_typesTab)) {
                    
                    // test si c'est un post type existan
                    $post_type = isPostype($id, $post_typesTab);

                    $post_type->setNoms_post($post_plural_name);
                    $post_type->setNom_post($post_single_name);
                    $post_type->setNom_menue($nom_menu);
                    $post_type->setDescription($description_post);
                    $post_type->setIcon($wh_icon);
                }
            }
        } else {
            $post_types = new wh_PosteTypes();
        }

        if (!isset($post_type)) {
            $post_type = new PosteType($post_single_name, $post_plural_name, $nom_menu, $description_post, sanitize_title($post_single_name), sanitize_title($wh_icon));
            // ajout des post
            $post_types->addPost($post_type);
        }
        // ajouter un champ adress
        if ($post_type->getId()) {

            $nom_meta = wh_get_nom_meta($post_type->getId());

            if (isset($_POST['ajout_meta']) && $_POST['ajout_meta']) {
                update_option($nom_meta, AJOUT_META);
            } else {

                $nom_meta = wh_get_nom_meta($post_type->getId());
                delete_option($nom_meta);
            }
        }

        // ajout dans base de donneer
        update_option(POST_OPTION, $post_types); ?>

        <div id="message" class="updated notice is-dismissible">
          <p>Bien enregisté</p>
          <button type="button" class="notice-dismiss">
              <span class="screen-reader-text">Ne pas tenir compte de ce message.</span>
          </button>
        </div>
        
  <?php  }
}
