<?php

if (isset($_POST['ajout_taxo']) && isset($_POST['post_name'])) {

    $nom_post = $_POST['post_name'];

    if (get_option($nom_post)) {

        $taxos = get_option($nom_post);
    } else {

        $taxos = new Taxonomies();
    }


    for ($i = 0; $i < $_POST['ajout_taxo']; $i++) {

        $wh_nom_taxo = $_POST['wh_nom_taxo' . $i];
        $wh_noms_taxo = $_POST['wh_noms_taxo' . $i];
        $wh_nom_taxo_recherche = $_POST['wh_nom_taxo_recherche' . $i];
        $wh_nom_taxo_menu = $_POST['wh_nom_taxo_menu' . $i];

        $taxo = new Taxonomie($wh_nom_taxo, $wh_noms_taxo, $wh_nom_taxo_recherche, $wh_nom_taxo_menu);

        $taxos->setTabTaxonomie($taxo);
        
        echo 'taxonomie bien enregistre';
    }

    update_option($nom_post, $taxos);
} elseif (isset($_POST['postes_choix']) && isset($_POST['numbre_taxo'])) {

    $nunbre_taxo = $_POST['numbre_taxo'];
    $postes_choix = $_POST['postes_choix'];

    if (get_option(nom_option_post())->getPosteTyps()) {

        $postetypes = postetypes();

        foreach ($postetypes as $postetype) {

            if ($postetype->getNom_post() == $postes_choix && is_numeric($nunbre_taxo) && intval($nunbre_taxo) <= 3 && intval($nunbre_taxo) > 0) {

                include plugin_dir_path(__FILE__) . '../view/wh_form_ajout_taxo.php';
            }
        }
    }
} elseif (get_option(nom_option_post())) {


    $postetypes = get_option(nom_option_post())->getPosteTyps();
    
    if (getTabTaxos()) {

        //afiche des taxo cree
        foreach (getTabTaxos() as $taxonomies) {
            //taxonomies ajouter

            foreach ($taxonomies as $taxonomie) {
                echo $taxonomie->getWh_nom_taxo();
            }
        }
    }



    // choix de nombre de taxo ajouter
    include plugin_dir_path(__FILE__) . '../view/wh_form_choix_taxo.php';
}

function postetypes() {
    return get_option(nom_option_post())->getPosteTyps();
}
