<?php

function acme_login_redirect( $redirect_to, $request, $user  ) {
//    return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : site_url();
    if( is_array( $user->roles ) ) {
        if( in_array( 'administrator', $user->roles ) || in_array( 'jmc_student', $user->roles ) ) {
               $url = admin_url('edit.php?post_type=jmc');
           // $url = admin_url();
        } else {
            if( in_array( 'jmc_empleador', $user->roles ) ) {
                $url = site_url();
               // edit.php?post_type=jmc
                /*
               $url = admin_url('edit.php?post_type=jmc');
                $current_user   = wp_get_current_user();
                $author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
                $author_posts = new WP_Query($author_query);
                $author_post_id = $author_posts->posts[0]->ID;

                if($author_posts->posts){ // Si tiene posts && Rediccionar al ultimo
                    $url = admin_url("post.php?post=".$author_post_id."&action=edit");
                }else{
                    $url = admin_url("post-new.php?post_type=jmc");
                }
                */

            } 
            /*
                $current_user   = wp_get_current_user();
                $role_name      = $current_user->roles[0]   ;
                $author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
                $author_posts = new WP_Query($author_query);
                $author_post_id = $author_posts->posts[0]->ID;

                if($author_posts->posts){ // Si tiene posts && Rediccionar al ultimo
                    $url = admin_url("post.php?post=".$author_post_id."&action=edit");
                }else{
                    $url = admin_url("post-new.php?post_type=jmc");
                }
            */
        }
    }

    return $url;
}
?>