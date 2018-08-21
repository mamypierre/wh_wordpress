<?php


class PosteTypes {

    private $posteTyps = array();
    

    public function addPost(PosteTypes $post) {
        
        $this->posteTyps[] = $post;
        
    }
    
    function getPosteTyps() {
        return $this->posteTyps;
    }


}
