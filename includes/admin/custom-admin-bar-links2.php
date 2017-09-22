<?php
// update toolbar
function update_adminbar($wp_adminbar) {

  // remove unnecessary items
  $wp_adminbar->remove_node('wp-logo');
  $wp_adminbar->remove_node('customize');
  $wp_adminbar->remove_node('comments');

//    if ( 'administrator' != $role_name ) {
    if ( !current_user_can('administrator') ) {
      $wp_adminbar->remove_node('edit');
    }

    //print_r($wp_adminbar);

}

// admin_bar_menu hook

?>