<?php

class wh_PosteTypes {

    private $posteTyps = array();

    function __construct() {
        
    }

    public function addPost($post) {

        if (count($this->posteTyps) < 5) {

            $this->posteTyps[] = $post;
        }
    }

    function getPosteTyps() {
        return $this->posteTyps;
    }

}
