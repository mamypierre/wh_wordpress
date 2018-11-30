<?php

include plugin_dir_path(__FILE__) . 'Filtre_taxo.php';
include plugin_dir_path(__FILE__) . 'ContentShortcode.php';
// initialisation
$posts = array();
$tabFiltre_taxo = array();
$postetype = '';
$tab_tax_query = array();
if (isset($atts) && !empty($atts)) {

    $tab_fitre = array();
    extract($atts);

    foreach ($atts as $key => $att) {
        // recuperation custom corespondent
        if ($key == wh_post_short_code()) {

            $postetype = $att;
        }
    }

    $posts = wh_get_posts($postetype);
}
// recuperation du content si existe
if ($content) {
    // var_dump($content);
    preg_match_all('#\[[^\]]*\]#', $content, $post_fields);
    //initialisation du tableau du post fields
    $tab_post_fields = array();
    //les key meta
    // print_r($post_fields);
    foreach ($post_fields[0] as $post_field) {
        //initialisation des valeur
        $label = '';
        $slug = '';
        $min = '';
        $max = '';
        $type = '';
        // suppression des crochet
        $post_field = str_replace('[', '', $post_field);
        $post_field = str_replace(']', '', $post_field);

        // recuperation des attribue
        $options = explode(',', $post_field);

        // print_r($options);
        wp_spaces_regexp();
        foreach ($options as $option) {

            // recuperation des valeur
            $tabOption = explode('=', $option);

            $w_var = remove_empty_p($tabOption[0]);
            $wh_val = remove_empty_p($tabOption[1]);

            //echo 'test='.trim($var);
            //print_r($tabOption);

            if (strcasecmp(trim($w_var), 'type') == 0) {

                $type = trim($tabOption[1]);
            }

            if (strcasecmp(trim($w_var), 'label') == 0) {

                $label = trim($tabOption[1]);
            }
            if (strcasecmp(trim($w_var), 'slug') == 0) {

                $slug = trim($tabOption[1]);
            }
            if (strcasecmp(trim($w_var), 'min') == 0) {

                $min = trim($tabOption[1]);
            }
            if (strcasecmp(trim($w_var), 'max') == 0) {

                $max = trim($tabOption[1]);
            }
            if (strcasecmp(trim($w_var), 'symbole') == 0) {

                $symbole = trim($tabOption[1]);
            }
        }

        if ($type) {
            switch ($type) {
                case 'range':

                    if ($label && $slug && $min && $max && $posts && $symbole) {

                        if (wh_isMetabox($posts, $slug)) {

                            $ContentCrocher = new ContentShortcode($type, $label, $slug, $min, $max, $metas = '', $symbole);
                            $tab_post_fields[] = $ContentCrocher;
                        }
                    }

                    break;
                case 'select':
                    if ($label && $slug && $posts && $postetype) {
                        if (wh_isMetabox($posts, $slug)) {

                            $wh_meta = wh_get_metas_post($slug, $postetype);
                            
                            if ($wh_meta && !is_a($wh_meta, 'WP_Error')) {

                                $ContentCrocher = new ContentShortcode($type, $label, $slug, '', '', $wh_meta);
                                $tab_post_fields[] = $ContentCrocher;
                            }
                        }
                    }
                    break;
                case 'checkbox':
                    if ($label && $slug && $posts && $postetype) {
                        if (wh_isMetabox($posts, $slug)) {

                            $wh_meta = wh_get_metas_post($slug, $postetype);

                            if ($wh_meta && !is_a($wh_meta, 'WP_Error')) {

                                $ContentCrocher = new ContentShortcode($type, $label, $slug, '', '', $wh_meta);
                                $tab_post_fields[] = $ContentCrocher;
                            }
                        }
                    }
                    break;
                case 'radio':
                    if ($label && $slug && $posts && $postetype) {
                        if (wh_isMetabox($posts, $slug)) {

                            $wh_meta = wh_get_metas_post($slug, $postetype);

                            if ($wh_meta && !is_a($wh_meta, 'WP_Error')) {

                                $ContentCrocher = new ContentShortcode($type, $label, $slug, '', '', $wh_meta);
                                $tab_post_fields[] = $ContentCrocher;
                            }
                        }
                    }
                    break;
                case 'filtre':
                    if (type_taxo($options)) {
                        $tab_fitre = type_taxo($options);
                        // recuperation des information du filtre
                        if ($tab_fitre) {
                            // print_r(get_taxonomies());
                            foreach ($tab_fitre as $slug_taxo => $taxo_display) {

                                $terms = get_terms(array('taxonomy' => $slug_taxo));
                                //print_r($terms);
                                if ($terms && !is_a($terms, 'WP_Error')) {

                                    $fitre_taxo = new Filtre_taxo($slug_taxo, $taxo_display, $terms);
                                    //print_r($fitre_taxo);
                                    $tabFiltre_taxo[] = $fitre_taxo;
                                }
                            }
                        }
                    }

                    break;
                case 'taxos':
                    if (type_taxo($options)) {

                        $tabtest = array();


                        $tab_tax_query['relation'] = 'AND';
                        $tab_taxo_ex_init = type_taxo($options);
                        $tab_taxo_ex = array();

                        foreach ($tab_taxo_ex_init as $slug_taxo => $term) {
                            $tab_term_ex = array();
                            if (strcasecmp(trim($slug_taxo), 'display') != 0) {
                                $terms = get_terms(array('taxonomy' => $slug_taxo));

                                if ($terms && !is_a($terms, 'WP_Error')) {
                                    // pour la requete en base de donner
                                    $tab_taxo_ex['field'] = 'slug';
                                    $tab_taxo_ex['operator'] = 'IN';
                                    $tab_taxo_ex['taxonomy'] = $slug_taxo;
                                    $tab_term_ex[] = $term;
                                    $tab_taxo_ex['terms'] = $tab_term_ex;

                                    //affichage de filtre
                                }
                            }
                            if (strcasecmp(trim($slug_taxo), 'display') == 0 && $tab_taxo_ex) {

                                $fil_term = $tab_taxo_ex['terms'][0];
                                $slug_taxo_filtre = $tab_taxo_ex['taxonomy'];

                                $wh_display = $term;

                                $termFiltre = get_terms(array('slug' => $fil_term, 'taxonomy' => $slug_taxo_filtre));

                                if (count($termFiltre) == 1 && $termFiltre[0] && is_a($termFiltre[0], 'WP_Term')) {

                                    $wh_taxos = get_terms(array('parent' => $termFiltre[0]->term_id, 'taxonomy' => $termFiltre[0]->taxonomy));

                                    if ($wh_taxos && !is_a($wh_taxos, 'WP_Error')) {

                                        //$wh_taxos[] = $termFiltre[0];

                                        $fitre_taxo = new Filtre_taxo($slug_taxo_filtre, $wh_display, $wh_taxos);

                                        $tabFiltre_taxo[] = $fitre_taxo;
                                    }
                                }
                            }
                        }
                        if ($tab_taxo_ex) {
                            $tab_tax_query[] = $tab_taxo_ex;
                        }
                    }

                    break;
            }
        }
    }
}

/*
 * recuperation des taxonomy
 */

function type_taxo($options) {
    $result = array();
    foreach ($options as $option) {
        // recuperation des valeur
        $tabOption = explode('=', $option);

        if (strcasecmp(trim($tabOption[0]), 'type') != 0) {
            $result[trim($tabOption[0])] = trim($tabOption[1]);
        }
    }

    return $result;
}

/*
 * recuper tout les meta lier a une posteType
 */

function wh_get_metas_post($meta_key, $post_type) {
    global $wpdb;
    $querystr = "
      SELECT $wpdb->postmeta.*
      FROM $wpdb->posts, $wpdb->postmeta
      WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
      AND $wpdb->postmeta.meta_key = '" . $meta_key . "'
      AND $wpdb->posts.post_status = 'publish'
      AND $wpdb->posts.post_type = '" . $post_type . "'
      AND $wpdb->posts.post_date < NOW()
      ORDER BY $wpdb->posts.post_date DESC
                                     ";

    $pageposts = $wpdb->get_results($querystr, OBJECT);

    return $pageposts;
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

//print_r($tab_tax_query);
if ($postetype && !empty($tab_tax_query) && !empty($tab_tax_query[0])) {
    // recuperation des poste
    $posts = wh_get_posts($postetype, $tab_tax_query);
}
//print_r($tab_post_fields);
// apell du template
include plugin_dir_path(__FILE__) . '../view/postesTemplate.php';

/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p($content) {
    $content = force_balance_tags($content);
    $content = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
    $content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);
    $content = preg_replace('/\s+/', '', $content);
    return $content;
}
