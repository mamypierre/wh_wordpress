<?php include plugin_dir_path(__FILE__) . 'wh_register_post.php'; 
      // delete_option('wh_post_type') ?> 


<h1> <?= get_admin_page_title() ?></h1>

<form method="post" action="">
    <?php
    if (isset($_POST['creation'])) {

        $post_creat = $_POST['creation'];

        switch ($post_creat) {

            case 'button':
                //button creation post
                include plugin_dir_path(__FILE__) . '../view/wh_form_creation_post.php';
                break;

            case 'post':
                //enregistrement das la base de donner
                verificatin_post();

                if (isset($_POST['wh_taxo']) || isset($_POST['wh_meta'])) {


                    if (isset($_POST['wh_taxo'])) {

                        //creation de taxonomie
                        include plugin_dir_path(__FILE__) . '../view/wh_form_taxonomie.php';
                    }
                    if (isset($_POST['wh_meta'])) {

                        //creation de taxonomie
                        include plugin_dir_path(__FILE__) . '../view/wh_form_metabox.php';
                    }
                    submit_button('valider');

                    break;
                }



            default:
                ////button creation post
                include plugin_dir_path(__FILE__) . '../view/wh_bouton_creation.php';
                break;
        }
    } else {
        include plugin_dir_path(__FILE__) . '../view/wh_bouton_creation.php';
    }
    ?>

</form>

<?php

function verificatin_post() {

    $wh_post = new Wh_register_post();

    //verification du donner poster
    if (!empty(trim($_POST['nom_post']))) {
        $nom_post = trim($_POST['nom_post']);
        $description_post = '';

        if (!empty(trim($_POST['description_post']))) {

            $description_post = trim($_POST['description_post']);
        }
        $wh_post->wh_registerpost($nom_post, $description_post);
    }
}

//insertion des option

if (!empty($_POST['wh_nom_meta']) || !empty($_POST['wh_nom_taxo'])) {

    $meta = '';
    $taxo = '';

    if (!empty($_POST['wh_nom_meta'])) {
        $meta = trim($_POST['wh_nom_meta']);
    }
    if (!empty($_POST['wh_nom_taxo'])) {

        $taxo = trim($_POST['wh_nom_taxo']);
    }
    
    $wh_post = new Wh_register_post();
    $wh_post->wh_registreOption($taxo, $meta);
}






//print_r(get_option('wh_post_type'));

