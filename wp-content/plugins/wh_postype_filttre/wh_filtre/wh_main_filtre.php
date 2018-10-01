<?php

include plugin_dir_path(__FILE__) . 'controleur/wh_shorteCode.php';
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
         * ajout de maps
         */
        add_action('wp_enqueue_scripts', array($this, 'wh_script'));
        /*
         * ajout de ajx et du jquery
         */
        add_action('wp_footer', array($this, 'add_js_scripts'));

        /*
         * ajout de page a aplle par ajax
         */
        add_action('wp_ajax_filtre_post', array($this, 'filtre_post'));
        add_action('wp_ajax_nopriv_filtre_post', array($this, 'filtre_post'));
    }

    /*
     * ajout de ajx et du jquery
     */

    function add_js_scripts() {
        // ajout de tout les libreri
        wp_enqueue_script('wh_vendor', plugin_dir_url(__FILE__) . '/public/javascript/wh_vandor.js');
        // chosen
        wp_enqueue_script('chosen', plugin_dir_url(__FILE__) . '/public/javascript/chosen.js', array('jquery'), '1.4', true);
        // filtre
        wp_enqueue_script('script', plugin_dir_url(__FILE__) . '/public/javascript/wh_ajax_filtre.js', array('jquery'), '1.4', true);
        // pass Ajax Url to script.js
        wp_localize_script('script', 'wh_ajaxurl', admin_url('admin-ajax.php'));
    }

    function wh_script() {

        wp_enqueue_style('wh_style', get_template_directory_uri() . '/../../plugins/wh_postype_filttre/wh_filtre/public/css/wh_style.css');
        wp_enqueue_style('chosen', get_template_directory_uri() . '/../../plugins/wh_postype_filttre/wh_filtre/public/css/chosen.css');
        // integration de bulma
         wp_register_style('bulma', "https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css");
         wp_enqueue_style('bulma');
    }


    /*
     * page a charger par ajax
     */

    function filtre_post() {

        include plugin_dir_path(__FILE__) . 'controleur/filtre_poste.php';

        die();
    }

}
