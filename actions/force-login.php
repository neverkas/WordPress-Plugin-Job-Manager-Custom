<?php
function force_login()
{

global $pagenow;

  if ( 'edit.php' === $GLOBALS['pagenow'] && current_user_can('jmc_student') && !($_GET)) {

          
          //wp_redirect(admin_url('edit.php?post_type=jmc'));
          //exit();

  }

  if ('wp-login.php' != $pagenow  && !is_user_logged_in()){ 
          wp_die(
          '
          <center>
          <img src="'.get_bloginfo("template_url").'/images/logo.jpg" height=120><br /><br/>

        
            <a href="'.site_url('wp-login.php?action=register').'">New User</a>
            <br />
            <br />
            <a href="'.site_url('wp-login.php').'">Current User</a>

          </center>
          ',
          'Global '
          );
  }

}

?>