<?php

class Filtre_taxo {

    private $slug_taxo;
    private $type_display;
    private $tab_taxos;

    function __construct($slug_taxo, $type_display, $tab_taxos) {
        $this->slug_taxo = $slug_taxo;
        $this->type_display = $type_display;
        $this->tab_taxos = $tab_taxos;
    }

    function getSlug_taxo() {
        return $this->slug_taxo;
    }

    function getType_display() {
        return $this->type_display;
    }

    function getTab_taxos() {
        return $this->tab_taxos;
    }


}
