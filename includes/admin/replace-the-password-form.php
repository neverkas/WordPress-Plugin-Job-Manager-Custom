<?php
function replace_the_password_form($content) {
  global $post;
  // if there's a password and it doesn't match the cookie
  if ( !empty($post->post_password) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH])!=$post->post_password ) {
    $output = '

    <form action="'.get_option('siteurl').'/wp-pass.php" method="post">
      '.__("This post is password protected. To view it please enter your password below:").'

        <label for="post_password">Password:</label>
        <input name="post_password" class="input" type="password" size="20" />
        <input type="submit" name="Submit" class="button" value="'.__("Submit").'" />

    </form>

    ';
    return $output;
  }
  else return $content;
}

?>