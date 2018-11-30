<?php

/*

Plugin Name: Filtres Post Type
Description: Création de CPT et filtrage de tous les Post Types
Version: 1.0
Author: MAMY chez Waouh
*/

include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/configuration.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_controleur/wh_posteTypes.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_controleur/wh_posteType.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_controleur/wh_taxonomie.php';

include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_controleur/wh_creation_post_option.php';
include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_main_post.php';
include_once plugin_dir_path( __FILE__ ).'wh_filtre/wh_main_filtre.php';

class Wh_main {

  function __construct() {

    //intitiation de plugins creation de post
    new Wh_main_post();
    new Main_filtre();
  }

}

new Wh_main();
