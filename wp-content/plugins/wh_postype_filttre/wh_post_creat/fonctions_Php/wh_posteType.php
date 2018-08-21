<?php

/*
 * class de poste type 
 */

class PosteType {

    private $noms_post;
    private $nom_post;
    private $nom_menue;
    private $description;

    function __construct($noms_post, $nom_post, $nom_menue, $description) {
        $this->noms_post = $noms_post;
        $this->nom_post = $nom_post;
        $this->nom_menue = $nom_menue;
        $this->description = $description;
    }

    function setNoms_post($noms_post) {
        $this->noms_post = $noms_post;
    }

    function setNom_post($nom_post) {
        $this->nom_post = $nom_post;
    }

    function setNom_menue($nom_menue) {
        $this->nom_menue = $nom_menue;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getNoms_post() {
        return $this->noms_post;
    }

    function getNom_post() {
        return $this->nom_post;
    }

    function getNom_menue() {
        return $this->nom_menue;
    }

    function getDescription() {
        return $this->description;
    }

}
