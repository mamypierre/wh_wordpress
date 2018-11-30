<?php


/*
 * recuperation des post_type lier a des  taxo
 */



if (isset($_GET['action'])) {
    switch ($_GET['action']) {

        case 'register':

            if(isset($_POST['taxoNames']) && $_POST['taxoNames']){

                include plugin_dir_path(__FILE__) . 'registre_display_taxo.php';

            }

            include plugin_dir_path(__FILE__) . '../view/wh_home_crea_short.php';

            break;
        case 'taxo':

            //affichage de tous le taxo
            if (isset($_GET['postSlug']) && get_object_taxonomies($_GET['postSlug'])) {

                $taxos = get_object_taxonomies($_GET['postSlug']);
                $postName = $_GET['postSlug'] ;
                if ($taxos) {

                    $name_taxo = implode(',', $taxos) ;

                    //  formulaire pour choisir les type d'affichage
                    include plugin_dir_path(__FILE__) . '../view/list_taxonomie.php';

                }
            } else {
                include plugin_dir_path(__FILE__) . '../view/wh_home_crea_short.php';
            }

            break;

        default:
            break;
    }
} else { // achiffage des liste poste
    
        include plugin_dir_path(__FILE__) . '../view/listPost_type.php';
    
}
