<?php
//delete_option('wh_post_types');


if (get_option(nom_option_post())) {
    
    foreach (get_option(nom_option_post())->getPosteTyps() as $postetype) {
        
        include plugin_dir_path(__FILE__) . '../view/lien.php';
        
    }
    
}

if (isset($_POST['creation'])) {

    switch ($_POST['creation']) {
        
        case 'post':
            
            include plugin_dir_path(__FILE__) . 'wh_register_post.php';
            include plugin_dir_path(__FILE__) . '../view/wh_bouton_creation.php';
            break;

        case 'button':

            include plugin_dir_path(__FILE__) . '../view/wh_form_creation_post.php';
            break;
    }
    
} else {
    include plugin_dir_path(__FILE__) . '../view/wh_bouton_creation.php';
}

