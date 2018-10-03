<?php

include plugin_dir_path(__FILE__) . 'Filtre_taxo.php';
include plugin_dir_path(__FILE__) . 'ContentShortcode.php';

$posts = array();
$tabFiltre_taxo = array();
$postetype = '';

if (isset($atts) && !empty($atts)) {

    $tab_fitre = array();
    extract($atts);

    foreach ($atts as $key => $att) {
        // recuperation custom corespondent 
        if ($key == wh_post_short_code()) {

            $postetype = $att;
        } else {// recuperation des filfre
            $tab_fitre[$key] = $att;
        }
    }


    if ($postetype) {
        // recuperation des poste
        $posts = wh_get_posts($postetype);
    }
    // recuperation des information du filtre
    if ($tab_fitre) {

        foreach ($tab_fitre as $slug_taxo => $taxo_display) {

            $terms = get_terms(array('taxonomy' => $slug_taxo));
            if ($terms) {

                $fitre_taxo = new Filtre_taxo($slug_taxo, $taxo_display, $terms);

                $tabFiltre_taxo[] = $fitre_taxo;
            }
        }
    }
}
// recuperation du content si existe
if ($content) {

    preg_match_all('#\[[^\]]*\]#', $content, $post_fields);
    //initialisation du tableau du post fields
    $tab_post_fields = array();
    //les key meta
    foreach ($post_fields[0] as $post_field) {
        //initialisation des valeur
        $label = '';
        $slug = '';
        $min = '';
        $max = '';
        // suppression des crochet
        $post_field = str_replace('[', '', $post_field);
        $post_field = str_replace(']', '', $post_field);
        // recuperation des attribue
        $options = explode(',', $post_field);

        foreach ($options as $option) {
            // recuperation des valeur
            $tabOption = explode('=', $option);

            if (strcasecmp(trim($tabOption[0]), 'label') == 0) {

                $label = trim($tabOption[1]);
            }
            if (strcasecmp(trim($tabOption[0]), 'slug') == 0) {

                $slug = trim($tabOption[1]);
            }
            if (strcasecmp(trim($tabOption[0]), 'min') == 0) {

                $min = trim($tabOption[1]);
            }
            if (strcasecmp(trim($tabOption[0]), 'max') == 0) {

                $max = trim($tabOption[1]);
            }
        }
        if ($label && $slug && $min && $max && $posts) {
            if (wh_isMetabox($posts, $slug)) {
                $ContentCrocher = new ContentShortcode($label, $slug, $min, $max);
                $tab_post_fields[] = $ContentCrocher;
            }
        }
    }
}
/*
 * savoir si c'est un slug metabox
 */

function wh_isMetabox($posts, $slugMetabox) {

    foreach ($posts as $post) {
        if (get_post_meta($post->ID, $slugMetabox, true)) {
            return TRUE;
        }
    }
    return FALSE;
}

// apell du template
include plugin_dir_path(__FILE__) . '../view/postesTemplate.php';
