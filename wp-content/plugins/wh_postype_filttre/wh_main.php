<?php

/*

Plugin Name: creation creation de post et de filtre
Description: Un plugin de creation de poste type les filtre
Version: 0.1
Author: Dona
*/

include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/configuration.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_modele/wh_posteTypes.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_modele/wh_posteType.php';
include plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_modele/wh_taxonomie.php';

include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_modele/wh_creation_post_option.php';
include_once plugin_dir_path( __FILE__ ) . 'wh_post_creat/wh_main_post.php';
include_once plugin_dir_path( __FILE__ ) . 'wh_filtre/wh_filtre.php';

class Wh_main {

  function __construct() {

    //intitiation de plugins creation de post
    new Wh_main_post();
    new Main_filtre();
  }

}

new Wh_main();
