<?php

//delete_option(POST_OPTION);
//print_r(getPostypesObjet());

if ( isset( $_GET['action'] ) ) {

  switch ( $_GET['action'] ) {
    case 'edit':
      if ( $_GET['id'] && getPostypes() ) {
        $postTypes = getPostypes();
        if ( isPostype( $_GET['id'], $postTypes ) ) {
          $postType = isPostype( $_GET['id'], $postTypes );
          include plugin_dir_path( __FILE__ ) . '../view/wh_form_creation_post.php';
        }
      }
      break;

    case 'pre_delete':
      if ( $_GET['id'] ) {
        $id_post_delete = $_GET['id'];
        include plugin_dir_path( __FILE__ ) . '../view/esitation.php';
      }
      break;

    case 'delete':
      if ( $_GET['id_post_comf'] ) {

        $id_post_comf = $_GET['id_post_comf'];
        include plugin_dir_path( __FILE__ ) . 'supresion_post.php';
        echo 'Bien supprimé';
      }
      include plugin_dir_path( __FILE__ ) . '../view/wh_home_post.php';
      break;

    default:
      echo 'Désolé, vous n’avez pas l’autorisation d’accéder à cette page';
      include plugin_dir_path( __FILE__ ) . '../view/wh_home_post.php';
      break;
  }
} else {

  if ( isset( $_POST['creation'] ) ) {
    switch ( $_POST['creation'] ) {
      case 'post':
        include plugin_dir_path( __FILE__ ) . 'wh_register_post.php';
        include plugin_dir_path( __FILE__ ) . '../view/wh_bouton_creation.php';
        break;

      case 'button':
        include plugin_dir_path( __FILE__ ) . '../view/wh_form_creation_post.php';
        break;
    }
  } else {
    
      include plugin_dir_path( __FILE__ ) . '../view/wh_bouton_creation.php';

  }
}
