<?php

add_action('init', 'wh_post_creats', 0);

function wh_post_creats() {

    $posts = get_option(nom_option_post());
    
     //print_r($posts);

    if ($posts) {

        $posts = $posts->getPosteTyps();

        foreach ($posts as $postType) {
            
          //  print_r($postType);
            
            //creation de posteType
            wh_post_creat($postType->getNom_post(), $postType->getNoms_post(), $postType->getNom_menue(), $postType->getDescription(), $postType->getId());

           
        }
    }
}

function wh_post_creat($nom_post, $noms_post, $nom_menu, $description_post, $id) {

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name' => _x($noms_post, 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x($nom_post, 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name' => __($nom_menu),
        // Les différents libellés de l'administration
        'all_items' => __('Toutes les' . $nom_post . 's'),
        'view_item' => __('Voir les ' . $noms_post),
        'add_new_item' => __('Ajouter une nouvelle ' . $nom_post),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Editer le ' . $nom_post),
        'update_item' => __('Modifier le ' . $nom_post),
        'search_items' => __('Rechercher un ' . $noms_post),
        'not_found' => __('Non trouvée'),
        'not_found_in_trash' => __('Non trouvée dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label' => __($noms_post),
        'description' => __($description_post),
        'labels' => $labels,
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        /*
         * Différentes options supplémentaires
         */
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => $nom_post . 's'),
    );

    // On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
    
    register_post_type($id, $args);
}

add_action('init', 'wh_taxo_creats', 0);

function wh_taxo_creats() {

    $posts = getPostypes();

    if ($posts) {

        foreach ($posts as $postType) {

            $id_post = $postType->getId() ;
            // creation de taxonomie lier aux poste type
            if (get_option($id_post)) {

                $Taxonomies = get_option($postType->getId())->getTabTaxonomie();

                foreach ($Taxonomies as $Taxonomie) {

                    wh_add_taxonomies($Taxonomie, $id_post);
                }
            }
        }
    }
}

function wh_add_taxonomies($Taxonomie, $id_post) {


    
    
    $labels = array(
        'name' => _x($Taxonomie->getWh_noms_taxo(), 'taxonomy general name'),
        'singular_name' => _x($Taxonomie->getWh_nom_taxo(), 'taxonomy singular name'),
        'search_items' => __($Taxonomie->getWh_nom_taxo_recherche()),
        'popular_items' => __($Taxonomie->getWh_nom_taxo() . ' populaires'),
        'all_items' => __('Toutes les ' . $Taxonomie->getWh_noms_taxo()),
        'edit_item' => __('Editer une ' . $Taxonomie->getWh_nom_taxo()),
        'update_item' => __('Mettre à jour une ' . $Taxonomie->getWh_nom_taxo()),
        'add_new_item' => __('Ajouter une nouvelle ' . $Taxonomie->getWh_nom_taxo()),
        'new_item_name' => __('Nom de la nouvelle ' . $Taxonomie->getWh_nom_taxo()),
        'add_or_remove_items' => __('Ajouter ou supprimer une ' . $Taxonomie->getWh_nom_taxo()),
        'choose_from_most_used' => __('Choisir parmi les ' . $Taxonomie->getWh_noms_taxo() . ' les plus utilisées'),
        'not_found' => __('Pas de ' . $Taxonomie->getWh_noms_taxo() . ' trouvées'),
        'menu_name' => __($Taxonomie->getWh_nom_taxo_menu()),
    );

    $args = array(
        // Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $Taxonomie->getWh_nom_taxo() . '-' . $id_post),
    );

    
    register_taxonomy($Taxonomie->getId_taxo(), $id_post, $args);

     //print_r($args);
    // wp_die($nomPosts);
}


//include_once plugin_dir_path(__FILE__) . 'test.php';