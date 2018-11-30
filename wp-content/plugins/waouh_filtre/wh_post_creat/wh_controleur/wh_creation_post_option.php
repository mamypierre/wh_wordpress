<?php
add_action('init', 'wh_post_creats', 0);

function wh_post_creats() {
    $posts = get_option(POST_OPTION);
    if ($posts) {
        $posts = $posts->getPosteTyps();
        foreach ($posts as $postType) {
            wh_post_creat($postType->getNom_post(), $postType->getNoms_post(), $postType->getNom_menue(), $postType->getDescription(), $postType->getId(), $postType->getIcon());
        }
    }
}

function wh_post_creat($nom_post, $noms_post, $nom_menu, $slug_url, $id,$icon='') {

  if(!trim($icon)){
    $icon='' ;
  }
  $slug_url = sanitize_title($slug_url);
    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name' => _x($noms_post, 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x($nom_post, 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name' => __($nom_menu),
        // Les différents libellés de l'administration
        'all_items' => __('Toutes les ' . $noms_post ),
        'view_item' => __('Voir les ' . $noms_post),
        'add_new_item' => __('Ajouter une nouvelle ' . $nom_post),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Editer le ' . $nom_post),
        'update_item' => __('Modifier le ' . $nom_post),
        'search_items' => __('Rechercher un ' . $noms_post),
        'not_found' => __('Non trouvée'),
        'not_found_in_trash' => __('Non trouvée dans la corbeille'), );
    // On peut définir ici d'autres options pour notre custom post type
    $args = array(
        'label' => __($noms_post),
        'description' => __('description_post'),
        'labels' => $labels,
        'menu_icon'      	  => $icon,
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'revisions',
            'custom-fields',
        ),
        /*
         * Différentes options supplémentaires
         */
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => $slug_url),
    );

    // On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
    register_post_type($id, $args);
}

add_action('init', 'wh_taxo_creats', 0);

function wh_taxo_creats() {
    // return array of posteType (object)
    $posts = getPostypes();
    if ($posts) {
        foreach ($posts as $postType) {
            $id_post = $postType->getId();
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
    if (!$Taxonomie instanceof Taxonomie)
        return;
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
}
/*
 * ajout de metabox
 */
add_action('add_meta_boxes', 'init_metabox');

function init_metabox() {

    $posts = get_option(POST_OPTION);
    if ($posts) {
        $posts = $posts->getPosteTyps();
        foreach ($posts as $postType) {
            if (get_option(wh_get_nom_meta($postType->getId())) == AJOUT_META) {
                add_meta_box('url_crea', 'Coordonées', 'ville', $postType->getId());
            }
        }
    }
}

function ville($post) {
    $ville = get_post_meta($post->ID, '_ville', true);
    $adresse = get_post_meta($post->ID, '_adresse', true);
    $wh_lng = get_post_meta($post->ID, '_wh_lng', true);
    $wh_lat = get_post_meta($post->ID, '_wh_lat', true);
    ?>
    <label for="wh_ville" >Ville</label>
    <input id="wh_ville" type="text" name="ville" value="<?php echo $ville; ?>" />
    <label for="wh_adresse" >Adresse</label>
    <input id="wh_adresse" type="text" name="adresse" value="<?php echo $adresse; ?>" />
    <input id="wh_lng" type="text" name="wh_lng" placeholder="lng" value="<?php echo $wh_lng; ?>" />
    <input id="wh_lat" type="text" name="wh_lat" placeholder="lat" value="<?php echo $wh_lat; ?>" />
    <br>
    <?php
}

add_action('save_post', 'save_metabox');

function save_metabox($post_id) {

    if (isset($_POST['ville'])) {
        update_post_meta($post_id, '_ville', sanitize_text_field($_POST['ville']));
    }
    if (isset($_POST['adresse'])) {
        update_post_meta($post_id, '_adresse', sanitize_text_field($_POST['adresse']));
    }
    if (isset($_POST['wh_lng'])) {
        update_post_meta($post_id, '_wh_lng', sanitize_text_field($_POST['wh_lng']));
    }
    if (isset($_POST['wh_lat'])) {
        update_post_meta($post_id, '_wh_lat', sanitize_text_field($_POST['wh_lat']));
    }
    /*if (isset($_POST['wh_prix'])) {
        update_post_meta($post_id, 'wh_prix', sanitize_text_field($_POST['wh_prix']));
    } */
}
