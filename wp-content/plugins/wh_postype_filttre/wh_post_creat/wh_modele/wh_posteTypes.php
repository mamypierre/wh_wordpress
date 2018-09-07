<?php

class wh_PosteTypes {

  private $posteTyps = array();

  function __construct() {

  }

  // Ajouter tous les objets 'posteTyps' dans un tableau
  // 5 Maximum
  public function addPost( $post ) {
    if ( count( $this->posteTyps ) < 5 ) {
      $this->posteTyps[] = $post;
    }
  }

  function getPosteTyps() {
    return $this->posteTyps;
  }

}
