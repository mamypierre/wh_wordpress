<?php

/*

  Name: creation dse post type
  Description: Un plugin de creation de poste type
  Version: 0.1
  Author: Dona
 */

include_once plugin_dir_path(__FILE__) . 'wh_controleur/parametre_admin.php';

class Wh_main_post {

    function __construct() {
        //creation de l'afichage des parametre dans la page admin
        new Wh_parametre();


        // ajout de google place
        add_action('edit_form_top', array($this, 'wh_place'));
        //api google
        add_action('wp_ajax_back_api_google', array($this, 'back_api_google'));
        add_action('wp_ajax_nopriv_back_api_google', array($this, 'back_api_google'));
    }


    /*
     * google place
     */
    function wh_place() {
        
        wp_enqueue_script ('wh_place', plugin_dir_url( __FILE__ ).'public/javascript/wh_place.js', array('jquery'), '1.4', true);
        // pass Ajax Url to script.js
        wp_localize_script('wh_place', 'wh_ajax_place', admin_url('admin-ajax.php'));
    }
    
    function back_api_google() {

        echo get_option(WH_GOOGLE);

        die();
    }

}
