<?php

/*
 * cet class permer d'enregister les post type aves les option
 */



if (isset($_POST['nom_post']) && isset($_POST['noms_post']) && isset($_POST['nom_menu']) && isset($_POST['description_post']) && isset($_POST['nom_post_unique'])) {

    $nom_post = trim($_POST['nom_post']);
    $noms_post = trim($_POST['noms_post']);
    $nom_menu = trim($_POST['nom_menu']);
    $description_post = trim($_POST['description_post']);
    $nom_post_unique = trim($_POST['nom_post_unique']);

    if ($nom_post && $noms_post && $nom_menu && $description_post) {

        $post_type = new PosteType($nom_post, $noms_post, $nom_menu, $description_post, $nom_post_unique);
    }

    if (isset($post_type)) {

        if (get_option(nom_option_post())) {

            $post_types = get_option(nom_option_post());
        } else {

            $post_types = new wh_PosteTypes();
        }
        // ajout des post 

        $post_types->addPost($post_type);



        // ajout dans base de donneer

        update_option(nom_option_post(), $post_types);
    }
}


