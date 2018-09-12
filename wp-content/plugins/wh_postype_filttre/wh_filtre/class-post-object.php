<?php

class whPostObject {
  public $ID;
  public $title;
  public $content;
  public $date_publication;
  public $post_link;

  public function __construct($post) {
    if ( ! $post instanceof WP_Post) return;

    $this->ID = $post->ID;
    $this->title = $post->post_title;
    $this->content = $post->post_content;
    $this->date_publication = get_the_date('j F, Y', $post->ID);
    $this->post_link = get_the_permalink($post->ID);
  }

}