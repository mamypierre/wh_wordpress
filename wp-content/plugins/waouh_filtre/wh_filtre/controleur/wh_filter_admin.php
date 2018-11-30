<?php

class Wh_filtre_admin {

    function __construct() {
        //ajout des menu de creation de posts
        add_action('admin_menu', array($this, 'wh_add_admin_menu'));
    }

// creation de page menu
    public function wh_add_admin_menu() {
        // ajout de menu pour api google
        add_menu_page('Renseignez votre API Google', 'API Google', 'manage_options', 'wh_api_google', array($this, 'ajout_api'));
        // ajout de page admin de creation de filtre
        add_menu_page('Configuration des filtres pour les Custom Post Types', 'Filtres', 'manage_options', 'wh_short_filtre', array($this, 'wh_view_menu'));

        add_submenu_page('wh_short_filtre', 'Configuration de filtres pour les Custom Post Types', 'Tous les filtres', 'manage_options', 'wh_short_filtre', array($this, 'wh_view_menu'));

        add_submenu_page('wh_short_filtre', 'Liste des shortcodes', 'Shortcodes', 'manage_options', 'shorte_code', array($this, 'wh_view_short'));
    }

    /*
     * page admin
     */

    public function wh_view_menu() {

        include plugin_dir_path(__FILE__) . 'wh_hom_filtre.php';
    }

    public function wh_view_short() {

        include plugin_dir_path(__FILE__) . 'wh_shorte_code_creat.php';
    }

    public function ajout_api() {
        include plugin_dir_path(__FILE__) . 'wh_api_google.php';
    }

}
