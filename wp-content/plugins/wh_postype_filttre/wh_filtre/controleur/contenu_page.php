<?php

include plugin_dir_path(__FILE__) . 'Filtre_taxo.php';

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

// apell du template
include plugin_dir_path(__FILE__) . '../view/postesTemplate.php';

 