<?php

/*

Plugin Name: creation creation de post et de filtre
Description: Un plugin de creation de poste type les filtre
Version: 0.1
Author: Dona
*/
//include plugin_dir_path(__FILE__) . 'wh_post_creat/fonctions_php/wh_creation_post_option.php';

include_once plugin_dir_path( __FILE__ ).'wh_post_creat/Wh_main_post.php';

class Wh_main {
    
    function __construct() {
   
        //intitiation de plugins creation de post
        new Wh_main_post();
        
    }
    
}

new Wh_main();