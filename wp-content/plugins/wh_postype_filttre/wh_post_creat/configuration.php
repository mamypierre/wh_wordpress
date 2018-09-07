<?php

/*
 * nom du option du post type
 */
define( 'POST_OPTION', 'wh_post_types' );

/*
 * posteType
 */

function getPostypes() {
  if ( get_option( POST_OPTION ) ) {
    return get_option( POST_OPTION )->getPosteTyps();
  }
  return false;
}

function getPostypesObjet() {

  if ( get_option( POST_OPTION ) ) {
    return get_option( POST_OPTION );
  }

  return false;
}

function getTabTaxos() {

  $taxonomies = false;

  if ( getPostypes() ) {

    $postetypes = getPostypes();

    foreach ( $postetypes as $postetype ) {

      //taxonomies ajouter
      if ( get_option( $postetype->getId() ) ) {

        //delete_option($postetype->getNom_post());

        $taxonomies[] = get_option( $postetype->getId() )->getTabTaxonomie();
      }
    }
  }

  return $taxonomies;
}

function getTaxo( $id ) {
  $resul = false;
  if ( getTabTaxos() ) {
    // print_r(getTabTaxos());
    foreach ( getTabTaxos() as $tabTaxo ) {
      foreach ( $tabTaxo as $taxo ) {
        if ( $taxo->getId_taxo() == $id ) {
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

function isPostype( $id, $postTypes ) {

  foreach ( $postTypes as $getPostype ) {
    if ( $getPostype->getId() == $id ) {
      return $getPostype;
    }
  }

  return false;
}

function isPostype_keys( $id, $postTypes ) {
  $key_tab_postYpes = 1;
  foreach ( $postTypes as $getPostype ) {
    if ( $getPostype->getId() == $id ) {
      return $key_tab_postYpes;
    }
    $key_tab_postYpes ++;
  }

  return false;
}
