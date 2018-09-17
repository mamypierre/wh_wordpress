<?php

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
    return $tab_slug_post_type ;
}


/*
 * nom shorte code
 */

function wh_short_code(){
    
    return 'wh_short';
    
}

/*
 * nom post short_code
 */

function wh_post_short_code(){
    
    return 'wh_post_short';
    
}


// fonction de recuperation des poste

function wh_get_posts($postetype, $tax_query = '') {

    return get_posts(array(
        'post_type' => $postetype,
        'numberposts' => -1,
        'tax_query' => $tax_query,
    ));
}