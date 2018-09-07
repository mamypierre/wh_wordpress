<?php

//print_r(get_option('1'));
if ( isset( $_GET['action'] ) ) {
  switch ( $_GET['action'] ) {
    case 'edit':

      if ( $_GET['id'] ) {

        if ( getTaxo( $_GET['id'] ) ) {

          $taxo        = getTaxo( $_GET['id'] );
          $nunbre_taxo = 1;
          include plugin_dir_path( __FILE__ ) . '../view/wh_form_ajout_taxo.php';
        }
      }
      break;
    case 'editeAdd':
      if ( isset( $_POST['wh_nom_taxo'][0] ) && isset( $_POST['wh_noms_taxo'][0] ) &&
           isset( $_POST['wh_nom_taxo_recherche'][0] ) && isset( $_POST['wh_nom_taxo_menu'][0] ) &&
           isset( $_POST['id_post_taxo'] ) && isset( $_POST['id_taxo'] ) ) {

        $taxosObje = get_option( $_POST['id_post_taxo'] );
        $taxostab  = $taxosObje->getTabTaxonomie();
        $taxo      = false;
        foreach ( $taxostab as $taxoobjet ) {

          if ( $taxoobjet->getId_taxo() == $_POST['id_taxo'] ) {

            $taxo = $taxoobjet;
          }
        }

        if ( $taxo ) {

          $taxo->setWh_nom_taxo( $_POST['wh_nom_taxo0'] );
          $taxo->setWh_nom_taxo_menu( $_POST['wh_nom_taxo_menu0'] );
          $taxo->setWh_nom_taxo_recherche( $_POST['wh_nom_taxo_recherche0'] );
          $taxo->setWh_noms_taxo( $_POST['wh_noms_taxo0'] );


          update_option( $taxo->getId_post(), $taxosObje );
          echo 'bien modifier';
        } else {
          echo 'pas fait';
        }
      }
      include plugin_dir_path( __FILE__ ) . '../view/home_taxo.php';
      break;

    case 'pre_delete':
      $getId_taxo = $_GET['id_taxo'];
      $getId_post = $_GET['id_post_taxo'];
      include plugin_dir_path( __FILE__ ) . '../view/esitation_delet_taxo.php';
      break;

    case 'delete':
      $getId_taxo = $_GET['id_taxo'];
      $getId_post = $_GET['id_post_taxo'];
      include plugin_dir_path( __FILE__ ) . 'supression_taxo.php';
      include plugin_dir_path( __FILE__ ) . '../view/home_taxo.php';

      break;
    default:
      include plugin_dir_path( __FILE__ ) . '../view/home_taxo.php';
      break;
  }
  // Ajouter une taxonomie
} elseif ( isset( $_POST['ajout_taxo'] ) && isset( $_POST['id_post'] ) ) {
  $postId = $_POST['id_post'];
  if ( ! isset( $postId ) ) {
    exit( "Erreur sur le post type" );
  }
  if ( get_option( $postId ) ) {
    $taxos = get_option( $postId );
    $count = count( $taxos->getTabTaxonomie() );
  } else {
    $taxos = new Taxonomies();
  }

  for ( $i = 0; $i < (int) $_POST['ajout_taxo']; $i ++ ) {
    $wh_nom_taxo           = $_POST['wh_nom_taxo'][ $i ];
    $wh_noms_taxo          = $_POST['wh_noms_taxo'][ $i ];
    $wh_nom_taxo_recherche = $_POST['wh_nom_taxo_recherche'][ $i ];
    $wh_nom_taxo_menu      = $_POST['wh_nom_taxo_menu'][ $i ];
    $taxo                  = new Taxonomie( $wh_nom_taxo, $wh_noms_taxo, $wh_nom_taxo_recherche, $wh_nom_taxo_menu, sanitize_title( $wh_noms_taxo ), $postId );
    $taxos->setTabTaxonomie( $taxo );
  }
  update_option( $postId, $taxos );
  echo 'taxonomie bien enregistre';
} // La premiere étape pour ajouter une taxonomy
elseif ( isset( $_POST['postes_choix'] ) && isset( $_POST['numbre_taxo'] ) ) {
  $nunbre_taxo = $_POST['numbre_taxo'];
  $post_type   = trim( $_POST['postes_choix'] );
  if ( getPostypes() ) {
    $postetypes = getPostypes();
    foreach ( $postetypes as $postetype ) {
      if ( $postetype->getId() == $post_type && is_numeric( $nunbre_taxo ) && intval( $nunbre_taxo ) <= 3 && intval( $nunbre_taxo ) > 0 ) {
        include plugin_dir_path( __FILE__ ) . '../view/wh_form_ajout_taxo.php';
        break;
      }
    }
  }

} elseif ( getPostypes() ) {
  $postetypes = getPostypes();
  if ( getTabTaxos() ) {
    //afiche des taxo cree
    foreach ( getTabTaxos() as $taxonomies ) {
      //taxonomies ajouter
      foreach ( $taxonomies as $taxonomie ) {
        include plugin_dir_path( __FILE__ ) . '../view/list_taxo.php';
      }
    }
  }


  // choix de nombre de taxo ajouter
  include plugin_dir_path( __FILE__ ) . '../view/wh_form_choix_taxo.php';
}

