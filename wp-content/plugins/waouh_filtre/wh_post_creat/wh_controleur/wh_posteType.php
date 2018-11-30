<?php

/*
 * class de poste type
 */

class PosteType {

  private $noms_post;
  private $nom_post;
  private $nom_menu;
  private $description_post;
  private $nom_unique;
  private $id;
  private $icon ;

  function __construct( $noms_post, $nom_post, $nom_menue, $description, $id, $icon='' ) {
    $this->noms_post        = $noms_post;
    $this->nom_post         = $nom_post;
    $this->nom_menu         = $nom_menue;
    $this->description_post = $description;
    $this->id               = $id;
    $this->icon               = $icon;
  }

  function getId() {
    return $this->id;
  }

  function getNom_unique() {
    return $this->nom_unique;
  }
  function setIcon( $icon ) {
    $this->icon = $icon;
  }
  function setNom_unique( $nom_unique ) {
    $this->nom_unique = $nom_unique;
  }

  function setNom_menue( $nom_menue ) {
    $this->nom_menu = $nom_menue;
  }

  function setDescription( $description ) {
    $this->description_post = $description;
  }

  function getNoms_post() {
    return $this->noms_post;
  }

  function setNoms_post( $noms_post ) {
    $this->noms_post = $noms_post;
  }

  function getNom_post() {
    return $this->nom_post;
  }

  function setNom_post( $nom_post ) {
    $this->nom_post = $nom_post;
  }

  function getNom_menue() {
    return $this->nom_menu;
  }

  function getDescription() {
    return $this->description_post;
  }
  function getIcon() {
    return $this->icon;
  }

}
