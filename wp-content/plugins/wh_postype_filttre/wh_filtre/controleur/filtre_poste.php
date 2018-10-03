<?php

if (!isset($posts)) {

    if (isset($_POST['slugPost']) && $_POST['slugPost']) {

        // initialisation des variable
        $postetype = $_POST['slugPost'];
        $tax_query = '';
        $lat = '';
        $lng = '';
        $distance = '';
        $nbrPage = '';
        $tabSlide2 = '';

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
        if (isset($_POST['tabSlide2']) && !empty($_POST['tabSlide2'])) {

            $tabSlide2 = $_POST['tabSlide2'];
            $relation = array('relation' => 'AND');
            $tabSlide2 = array_merge($relation, $tabSlide2);
        }


        $posts = wh_get_posts($postetype, $tax_query, $nbrPage, $lat, $lng, $distance,$tabSlide2);
    }
}

if (!empty($posts) && is_array($posts)) {

    include plugin_dir_path(__FILE__) . '../view/display_poste.php';
}


