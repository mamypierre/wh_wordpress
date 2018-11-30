<?php

$taxos = get_option( $getId_post )->getTabTaxonomie();
//print_r(get_option($getId_post));
$key_taxo = false;
//recuperation du keys
foreach ( $taxos as $key => $taxo ) {
  if ( $taxo->getId_taxo() == $getId_taxo ) {

    $key_taxo = $key;
  }
}

unset( $taxos[ $key_taxo ] );

$taxos     = array_values( $taxos );
$taxoObjet = new Taxonomies();

foreach ( $taxos as $value ) {

  $taxoObjet->setTabTaxonomie( $value );
}

//print_r($taxoObjet);
//mise a jour du taxo
//echo $getId_post;
update_option( $getId_post, $taxoObjet );

//print_r(get_option($getId_post));