<?php

/*
 * nom du option du post type
 */

function nom_option_post() {

    $nom_option_post = 'wh_post_types';

    return $nom_option_post;
}

/*
 * posteType
 */

function getPostypes() {

    return get_option(nom_option_post())->getPosteTyps();
}

function getTabTaxos() {

    $taxonomies = FALSE;

    if (getPostypes()) {

        $postetypes = getPostypes();

        foreach ($postetypes as $postetype) {
            
            //taxonomies ajouter
            if (get_option($postetype->getNom_post())) {

                //delete_option($postetype->getNom_post());
                
                $taxonomies[] = get_option($postetype->getNom_post())->getTabTaxonomie();
            }
        }
    }

    return $taxonomies;
}
