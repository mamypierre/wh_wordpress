<?php

class ContentShortcode {

    private $label;
    private $slug;
    private $min;
    private $max;
    private $type;
    private $metas;
    private $symbole;

    function __construct($type, $label, $slug, $min = '', $max = '', $metas = '', $symbole = '') {
        $this->label = $label;
        $this->slug = $slug;
        $this->min = $min;
        $this->max = $max;
        $this->type = $type;
        $this->metas = $metas;
        $this->symbole = $symbole ;
    }
    function getSymbole() {
        return $this->symbole;
    }

        function getMetas() {
        return $this->metas;
    }

    function getType() {
        return $this->type;
    }

    function getLabel() {
        return $this->label;
    }

    function getSlug() {
        return $this->slug;
    }

    function getMin() {
        return $this->min;
    }

    function getMax() {
        return $this->max;
    }

}
