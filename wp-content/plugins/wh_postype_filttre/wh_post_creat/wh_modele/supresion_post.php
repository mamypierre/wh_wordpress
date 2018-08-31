<?php

if (getPostypes()) {

    $postTypes = getPostypes();

    if (isPostype_keys($id_post_comf, $postTypes)) {

        $keys = isPostype_keys($id_post_comf, $postTypes) - 1;
        
        $id_post = $postTypes[$keys]->getId();
        //supression des taxo lier
        delete_option($id_post);
        //supression de postType
        unset($postTypes[$keys]);

        $postTypes = array_values($postTypes);

        $postTypes_objet = new wh_PosteTypes();
        // mise a jour du poste
        foreach ($postTypes as $postType) {

            $postTypes_objet->addPost($postType);
           
        }
        // mise  ajour dans base de donner
        update_option(nom_option_post(), $postTypes_objet);
    }
}

