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
    if (get_option(nom_option_post())) {
        return get_option(nom_option_post())->getPosteTyps();
    }
    return FALSE;
}

function getPostypesObjet() {

    if (get_option(nom_option_post())) {
        return get_option(nom_option_post());
    }
    return FALSE;
}

function getTabTaxos() {

    $taxonomies = FALSE;

    if (getPostypes()) {

        $postetypes = getPostypes();

        foreach ($postetypes as $postetype) {

            //taxonomies ajouter
            if (get_option($postetype->getId())) {

                //delete_option($postetype->getNom_post());

                $taxonomies[] = get_option($postetype->getId())->getTabTaxonomie();
            }
        }
    }

    return $taxonomies;
}

function getTaxo($id) {

    $resul = FALSE;

    if (getTabTaxos()) {

        // print_r(getTabTaxos());

        foreach (getTabTaxos() as $tabTaxo) {

            foreach ($tabTaxo as $taxo) {

                if ($taxo->getId_taxo() == $id) {

                    return $taxo;
                }
            }
        }
    }
    return $resul;
}

/*
 * pour savoir si c'est un post type
 */

function isPostype($id, $postTypes) {

    foreach ($postTypes as $getPostype) {


        if ($getPostype->getId() == $id) {

            return $getPostype;
        }
    }
    return FALSE;
}

function isPostype_keys($id, $postTypes) {

    $key_tab_postYpes = 1;

    foreach ($postTypes as $getPostype) {


        if ($getPostype->getId() == $id) {

            return $key_tab_postYpes;
        }
        $key_tab_postYpes ++;
    }
    return FALSE;
}
