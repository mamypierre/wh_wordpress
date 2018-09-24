<?php

/*

  Name: creation dse post type
  Description: Un plugin de creation de poste type
  Version: 0.1
  Author: Dona
 */

include_once plugin_dir_path(__FILE__) . 'wh_modele/parametre_admin.php';

class Wh_main_post {

    function __construct() {
        //creation de l'afichage des parametre dans la page admin
        new Wh_parametre();

        /*
         * ajout du templet css admin
         */
        add_action('admin_init', array($this, 'wh_post_adnim'));

        // ajout de google place
        add_action('edit_form_top', array($this, 'wh_place'));
    }

    function wh_post_adnim() {

        wp_enqueue_style('wh_style', get_template_directory_uri() . '/../../plugins/wh_postype_filttre/wh_post_creat/public/css/style_creat_post_admin.css');
    }

    /*
     * google place
     */
    function wh_place() {
        
        wp_enqueue_script ('wh_place', plugin_dir_url( __FILE__ ).'public/javascript/wh_place.js');
    }

}
