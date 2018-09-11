<?php

include plugin_dir_path(__FILE__) . 'controleur/wh_shorteCode.php';
include plugin_dir_path(__FILE__) . 'view/templete_1.php';
include plugin_dir_path(__FILE__) . 'controleur/wh_filter_admin.php';
include plugin_dir_path(__FILE__) . 'controleur/fonction_global.php';

class Main_filtre {

    function __construct() {
        /*
         * creation des shorte code et filtre
         */
        new Wh_filtre_admin();
        /*
         * ajout de shortcode
         */
        new Wh_shortcode();
        /*
         * ajout du templet css bulma
         */

        add_action('wp_footer', array($this, 'wh_scriptJs'));
        /*
         * ajout de maps
         */
        add_action('wp_enqueue_scripts', array($this, 'wh_script'));
        /*
         * ajout de ajx et du jquery
         */
        add_action('wp_enqueue_scripts', array($this, 'add_js_scripts'));
    }

    /*
     * ajout de ajx et du jquery
     */

    function add_js_scripts() {

        wp_enqueue_script('script', plugin_dir_url(__FILE__) . '/public/javascript/wh_ajax.js', array('jquery'), '1.5', true);

        // pass Ajax Url to script.js
        wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
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
