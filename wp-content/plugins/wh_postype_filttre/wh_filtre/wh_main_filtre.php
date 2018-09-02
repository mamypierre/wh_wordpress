<?php

include plugin_dir_path(__FILE__) . 'controleur/wh_shorteCode.php';

class Main_filtre {

    function __construct() {
        /*
         * ajout de shortcode
         */
        new Wh_shortcode();
        /*
         * ajout du templet css bulma
         */
        add_action('wp_enqueue_scripts', array($this, 'wh_script'));
        add_action('wp_footer', array($this,'wh_scriptJs'));
    }

    function wh_script() {
        wp_enqueue_style('wh_bulma', get_template_directory_uri() . '/../../plugins/wh_postype_filttre/wh_filtre/public/css/test.css');



        // wp_register_style('custom', "https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css");
        // wp_enqueue_style('custom');
    }

    function wh_scriptJs() {
        
        wp_enqueue_script('wh_vendor', plugin_dir_url(__FILE__) . '/public/javascript/wh_vandor.js');
        wp_enqueue_script('wh_maps', plugin_dir_url(__FILE__) . '/public/javascript/wh_maps.js');
    }

}
