<?php

/*
 * cette class vas gere les affichage des parametre dans l'admins
 */

class Wh_parametre {

    function __construct() {
        //ajout des menu de creation de posts
        add_action('admin_menu', array($this, 'wh_add_admin_menu'));
    }

// creation de page menu
    public function wh_add_admin_menu() {
        
        add_menu_page('creation de custom post', 'custom post', 'manage_options', 'wh_custom_post', array($this, 'wh_view_menu'));

    }

    public function wh_view_menu() {

        include plugin_dir_path(__FILE__) . 'wh_menu_admin.php';
    }

}
