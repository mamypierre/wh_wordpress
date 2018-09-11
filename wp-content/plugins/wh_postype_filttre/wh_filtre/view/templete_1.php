<?php

add_action('wp_ajax_mon_action', 'mon_action');
add_action('wp_ajax_nopriv_mon_action', 'mon_action');

function mon_action() {

   // $param = $_POST['param'];

   // echo $param;
    include plugin_dir_path(__FILE__) . 'temp.php';
    die();
}
