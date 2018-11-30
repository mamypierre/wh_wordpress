<?php

include plugin_dir_path(__FILE__) . 'wh_geo_query.php';


/*
 * recuperer les slug de tous les post_type
 */

function tab_slug_post_type() {

    $tab = get_post_types();
    $tab_slug_post_type = FALSE;

    if ($tab) {
        foreach ($tab as $key => $value) {

            if ($key != 'post' && $key != 'page' && $key != 'attachment' && $key != 'revision' && $key != 'nav_menu_item' && $key != 'custom_css' && $key != 'customize_changeset' && $key != 'oembed_cache' && $key != 'user_request') {

                $tab_slug_post_type[] = $value;
            }
        }
    }
    return $tab_slug_post_type;
}

/*
 * nom shorte code
 */

function wh_short_code() {

    return 'waouh_filtres';
}

/*
 * nom post short_code
 */

function wh_post_short_code() {

    return 'wh_post_filtres';
}

// fonction de recuperation des poste

function wh_get_posts($postetype, $tax_query = '', $nbrPage = '', $lat = '', $lng = '', $distance = '', $tabSlide2='') {

  

    
    if (!$nbrPage) {
        $nbrPage = 15;
    }

    $locations = new WP_Query_Geo([
        'post_status' => 'publish',
        'post_type' => $postetype, // cpt with locations stored
        'posts_per_page' => -1,
        'tax_query' => $tax_query,
        'meta_query' => $tabSlide2,// filtrage par meta donner
        'posts_per_page' => $nbrPage, // nbre de page
        'lat' => $lat, // pass in latitude
        'lng' => $lng, // pass in longitude
        'distance' => $distance, // distance to find properties in
    ]);

    return $locations->posts;
}
