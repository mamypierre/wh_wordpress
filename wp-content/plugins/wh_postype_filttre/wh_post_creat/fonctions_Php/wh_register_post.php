<?php

/*
 * cet class permer d'enregister les post type aves les option
 */

class Wh_register_post {

    private $nom_option = 'wh_post_type';
    private $nom_post;
    private $label_non_post = 'nom_post';
    private $label_non_descript = 'description_post';
    private $description_post = 'description du ';
    private $label_taxo = 'taxo';
    private $label_meta = 'meta';

    function __construct($nom_post = "") {

        $this->nom_post = $nom_post;
    }

    /*
     * enregistrement du poste type
     */

    public function wh_registerpost($nom_post, $description_post = "") {

        if (!empty(trim($nom_post))) {

            $this->nom_post = trim($nom_post);
            $this->description_post = $this->description_post . $this->nom_post;


            if (!empty(trim($description_post))) {

                $this->description_post = trim($description_post);
            }
        }

        update_option($this->nom_option, array(
            array($this->label_non_post => $this->nom_post,
                $this->label_non_descript => $this->description_post,
                $this->label_meta => '',
                $this->label_taxo => '')
                )
        );
    }

    public function wh_registreOption($taxo, $meta, $nom_post="") {
        
        $postypes = get_option($this->nom_option);
        $postype  = $postypes[0];
        
        $postype[$this->label_meta]= $meta ;
        
        $postype[$this->label_taxo]= $taxo ;
        
        update_option($this->nom_option, array($postype)) ;
    }

    /*
     * retur une valeur si exist si non faux 
     * verifie si le poste existe
     */

    public function isPost($nom_post) {

        $result = FALSE;

        $post = get_option($this->nom_option);

        foreach ($post as $postype) {

            if ($postype[$this->label_non_post] == trim($nom_post)) {

                $result = $postype;
            }
        }
        
        return $result ;
    }

}
