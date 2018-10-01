<?php

if (!isset($posts)) {

    if (isset($_POST['slugPost']) && $_POST['slugPost'] ) {
       
        // initialisation des variable
        $postetype = $_POST['slugPost'];
        $tax_query = '';
        $lat = '';
        $lng = '';
        $distance = '';
        $nbrPage = '';
        
        if (isset($_POST['tabTaxos']) && $_POST['tabTaxos']) {
            
            $tax_query = $_POST['tabTaxos'];

            $relation = array('relation' => 'AND');

            $tax_query = array_merge($relation, $tax_query);
        }

        if (isset($_POST['lnt']) && isset($_POST['lng']) && isset($_POST['distance']) && $_POST['lnt'] && $_POST['lng'] && $_POST['distance']) {

            $lat = $_POST['lnt'];
            $lng = $_POST['lng'];
            $distance = $_POST['distance'];
        }

        
        $posts = wh_get_posts($postetype, $tax_query, $nbrPage, $lat, $lng, $distance);
    }
}

if (!empty($posts) && is_array($posts)) {

    include plugin_dir_path(__FILE__) . '../view/display_poste.php';
}


