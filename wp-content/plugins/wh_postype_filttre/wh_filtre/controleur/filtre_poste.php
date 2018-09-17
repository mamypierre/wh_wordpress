<?php

if (!isset($posts)) {

    if (isset($_POST['tabTaxos']) && isset($_POST['slugPost'])) {

        $tax_query = $_POST['tabTaxos']; 

            $relation = array('relation' => 'OR');

            $tax_query = array_merge($relation, $tax_query);

        $posts = wh_get_posts($_POST['slugPost'], $tax_query);
        
    } else {

        $posts = wh_get_posts($_POST['slugPost']);
    }
}

if (!empty($posts) && is_array($posts)) {

    include plugin_dir_path(__FILE__) . '../view/display_poste.php';
}


