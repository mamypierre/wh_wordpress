<?php

/*
 * cette class vas gere les affichage des parametre dans l'admins
 */
include plugin_dir_path(__FILE__) . 'wh_PosteType.php';
include plugin_dir_path(__FILE__) . 'wh_PosteTypes.php';

class Wh_parametre {

    function __construct() {
        /*$post1 = new PosteType('noms_post', 'nom_post', 'nom_menue', 'description');
        $post = new PosteType('noms_post2', 'nom_post2', 'nom_menue2', 'description2');
        $posts = new PosteTypes();
        $posts->addPost($post);
        $posts->addPost($post1);*/
        
        //update_option('nom_option',$posts);
        
        $posts = get_option('nom_option') ;
        
        $post = $posts->getPosteTyps()[0];
        
        $post->setNoms_post('test') ;
        
        print_r($posts);
        
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
