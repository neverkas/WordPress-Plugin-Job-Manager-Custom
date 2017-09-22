<?php
function my_redirect_user_by_role($user_login, $user)
{	
/*	
	global $current_user;

    $current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];
    
    wp_redirect(admin_url());
    exit;
    */

 	/*
    if ( 'jmc_empleador' === $role_name  || current_user_can('jmc_empleador')) {
        //$url =  'http://globalwat.org/app';
        wp_redirect( 'http://globalwat.org/app' );
        exit;
    } 
    else{    
        if ( 'jmc_student' === $role_name  || current_user_can('jmc_student')) {
            $current_user = wp_get_current_user();
            $author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
            $author_posts = new WP_Query($author_query);
            $author_post_id = $author_posts->posts[0]->ID;

            if($author_posts->posts){ // Si tiene posts && Rediccionar al ultimo
                $student_url = "post.php?post={$author_post_id}&action=edit";
            }else{
                $student_url = "post-new.php?post_type=jmc";
            }
        
            //$url = admin_url($student_url);
            wp_redirect(admin_url($url));
            exit;
        } 
        if ( 'administrator' === $role_name  || current_user_can('administrator')) {
            //$url = admin_url();
            wp_redirect(admin_url());
            exit;
        } 

    }
    */


	$role_name      = $user->roles[0];	


	if ( 'jmc_student' === $role_name || current_user_can('jmc_student')) {
			$current_user = wp_get_current_user();
			$author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
			$author_posts = new WP_Query($author_query);
			$author_post_id = $author_posts->posts[0]->ID;

			if($author_posts->posts){
				$url = "post.php?post={$author_post_id}&action=edit";
			}else{
				$url = "post-new.php?post_type=jmc";
			}
		
			wp_redirect(admin_url($url));
			exit;
	} 

	if ( 'jmc_empleador' === $role_name || current_user_can('jmc_empleador')) {
        wp_redirect( 'http://globalwat.org/app' );
			exit;
	} 

	if ( 'administrator' === $role_name  || current_user_can('administrator')) {
		wp_redirect(admin_url());
			exit;
	} 

	//wp_redirect(home_url());
	exit;

}

?>