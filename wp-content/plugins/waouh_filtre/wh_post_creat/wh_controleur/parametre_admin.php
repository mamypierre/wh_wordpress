<?php

/*
 * cette class vas gere les affichage des parametre dans l'admins
 */

class Wh_parametre {

  function __construct() {
    //ajout des menu de creation de posts
    add_action( 'admin_menu', array( $this, 'wh_add_admin_menu' ) );

  }

// creation de page menu
  public function wh_add_admin_menu() {

    add_menu_page( 'Création de Custom Post Type', 'CPT', 'manage_options', 'wh_custom_post', array(
      $this,
      'wh_view_menu'
    ) );

    add_submenu_page( 'wh_custom_post', 'Création de Custom Post Type', 'Liste des CPT', 'manage_options', 'wh_custom_post', array(
      $this,
      'wh_view_menu'
    ) );
    add_submenu_page( 'wh_custom_post', 'Création de Custom Post Type', 'Ajouter CPT', 'manage_options', 'wh_ajout_post', array(
      $this,
      'wh_ajout_post'
    ) );
    add_submenu_page( 'wh_custom_post', 'Création de taxonomies', 'Liste des taxonomies', 'manage_options', 'wh_taxonomie', array(
      $this,
      'wh_view_taxo'
    ) );
  }

  public function wh_view_menu() {

    include plugin_dir_path( __FILE__ ) . 'wh_menuAdminPost.php';
  }

  public function wh_view_taxo() {

    include plugin_dir_path( __FILE__ ) . 'wh_menuAdminTaxo.php';
  }

  public function wh_ajout_post() {
    
    include plugin_dir_path( __FILE__ ) .'../view/wh_form_creation_post.php';
  }

}
