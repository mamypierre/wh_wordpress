<?php

class Wh_shortcode {

    function __construct() {
        add_shortcode( wh_short_code(), array($this, 'wh_short'));
    }


    public function wh_short($atts, $content) {
        include plugin_dir_path(__FILE__) . 'contenu_page.php';

    }

}
