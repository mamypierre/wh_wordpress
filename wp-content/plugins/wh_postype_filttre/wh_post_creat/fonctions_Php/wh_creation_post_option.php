<?php

add_action('init', 'wh_post_creats', 0);

function wh_post_creat($nom_post, $descrition) {

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name' => _x($nom_post . 's', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x($nom_post, 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name' => __($nom_post . ''),
        // Les différents libellés de l'administration
        'all_items' => __('Toutes les' . $nom_post . 's'),
        'view_item' => __('Voir les ' . $nom_post . 's'),
        'add_new_item' => __('Ajouter une nouvelle ' . $nom_post),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Editer le ' . $nom_post),
        'update_item' => __('Modifier le ' . $nom_post),
        'search_items' => __('Rechercher un ' . $nom_post . 's'),
        'not_found' => __('Non trouvée'),
        'not_found_in_trash' => __('Non trouvée dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label' => __($nom_post . 's'),
        'description' => __($descrition),
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
    register_post_type($nom_post . 's', $args);
}

function wh_post_creats() {

    $post = get_option('wh_post_type');
    if ($post) {
        foreach ($post as $postType) {
            if ($postType['nom_post'] && $postType['description_post']) {
                wh_post_creat($postType['nom_post'], $postType['description_post']);
            }
        }
    }
}
