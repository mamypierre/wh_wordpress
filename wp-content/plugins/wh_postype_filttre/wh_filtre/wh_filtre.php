<?php

class Main_filtre {

  public function __construct() {
    add_action('init', function() {});
    add_action( 'wp_enqueue_scripts', array( &$this, 'wh_enqueue_script' ) );
  }

  public function wh_enqueue_script() {
    // register angular scripts

    wp_enqueue_style( 'wh_bulma', plugin_dir_url( __FILE__ ) . '/public/css/test.css' );
    wp_enqueue_script( 'wh_vendor', plugin_dir_url( __FILE__ ) . '/public/javascript/wh_vandor.js', [], '0.1', true );
    wp_enqueue_script( 'wh_maps', plugin_dir_url( __FILE__ ) . '/public/javascript/wh_maps.js', [], '0.1', true );

  }


}
