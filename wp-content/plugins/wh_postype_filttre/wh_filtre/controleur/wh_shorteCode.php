<?php

class Wh_shortcode {

    function __construct() {

        add_shortcode('test', array($this, 'my_short'));
        
        add_shortcode( wh_short_code(), array($this, 'wh_short'));
    }

    public function my_short() {
        
        include plugin_dir_path(__FILE__) . '../view/page_test.php';
        
    }
    
    public function wh_short() {
        
        print_r(get_post_types());
        
    }

}
