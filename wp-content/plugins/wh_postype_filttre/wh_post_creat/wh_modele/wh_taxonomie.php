<?php

class Taxonomie {

    private $wh_nom_taxo;
    private $wh_noms_taxo;
    private $wh_nom_taxo_recherche;
    private $wh_nom_taxo_menu;

    function __construct($wh_nom_taxo, $wh_noms_taxo, $wh_nom_taxo_recherche, $wh_nom_taxo_menu) {
        $this->wh_nom_taxo = $wh_nom_taxo;
        $this->wh_noms_taxo = $wh_noms_taxo;
        $this->wh_nom_taxo_recherche = $wh_nom_taxo_recherche;
        $this->wh_nom_taxo_menu = $wh_nom_taxo_menu;
    }

    function getWh_nom_taxo() {
        return $this->wh_nom_taxo;
    }

    function getWh_noms_taxo() {
        return $this->wh_noms_taxo;
    }

    function getWh_nom_taxo_recherche() {
        return $this->wh_nom_taxo_recherche;
    }

    function getWh_nom_taxo_menu() {
        return $this->wh_nom_taxo_menu;
    }

    function setWh_nom_taxo($wh_nom_taxo) {
        $this->wh_nom_taxo = $wh_nom_taxo;
    }

    function setWh_noms_taxo($wh_noms_taxo) {
        $this->wh_noms_taxo = $wh_noms_taxo;
    }

    function setWh_nom_taxo_recherche($wh_nom_taxo_recherche) {
        $this->wh_nom_taxo_recherche = $wh_nom_taxo_recherche;
    }

    function setWh_nom_taxo_menu($wh_nom_taxo_menu) {
        $this->wh_nom_taxo_menu = $wh_nom_taxo_menu;
    }

}

class Taxonomies {

    private $tabTaxonomie = array();

    function __construct() {
        
    }

    function getTabTaxonomie() {
        return $this->tabTaxonomie;
    }

    function setTabTaxonomie($tabTaxonomie) {
        $this->tabTaxonomie[] = $tabTaxonomie;
    }

    public function remove() {
        
    }

    public function edit() {
        
    }

}
