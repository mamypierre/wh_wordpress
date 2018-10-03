<?php

class ContentShortcode {

    private $label;
    private $slug;
    private $min;
    private $max;

    function __construct($label, $slug, $min, $max) {
        $this->label = $label;
        $this->slug = $slug;
        $this->min = $min;
        $this->max = $max;
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
