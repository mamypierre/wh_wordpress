<?php
/*

Name: creation dse post type
Description: Un plugin de creation de poste type 
Version: 0.1
Author: Dona
*/

include_once plugin_dir_path( __FILE__ ) . 'wh_modele/parametre_admin.php';

class Wh_main_post {

  function __construct() {

    //creation de l'afichage des parametre dans la page admin
    new Wh_parametre();

  }

}


