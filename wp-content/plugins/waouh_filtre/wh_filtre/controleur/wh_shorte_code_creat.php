<?php
// recuperation des slug de poste type
$tab_slug_post_type = tab_slug_post_type();

if ($tab_slug_post_type) {



    foreach ($tab_slug_post_type as $slug_post_type) {

            $wh_filtre = '';
            $tabFiltre = array();
        
        if (get_object_taxonomies($slug_post_type)) {

            $tabTaxos = get_object_taxonomies($slug_post_type);

            if ($tabTaxos) {

                foreach ($tabTaxos as $slugtaxo) {

                    if (get_option($slugtaxo)) {

                       // $wh_filtre .= $slugtaxo . '=' . get_option($slugtaxo) .', ' ;
                        $tabFiltre[] = $slugtaxo . '=' . get_option($slugtaxo);
                    }
                }
            }
            $wh_filtre = implode(', ', $tabFiltre);
        }

        include plugin_dir_path(__FILE__) . '../view/list_short_code.php';
    }
}
