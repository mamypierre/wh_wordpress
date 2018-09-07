<?php

class Wh_shortcode {

  function __construct() {

    add_shortcode( 'test', array( $this, 'my_short' ) );
  }

  public function my_short() {

    include plugin_dir_path( __FILE__ ) . '../view/page_test.php';

  }

}
