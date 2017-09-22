<?php
function dashboard_Redirect(){
	global $current_user;
	
	//wp_redirect(admin_url('admin.php?page=my-plugin-page'));

	if(current_user_can('administrator') && current_user_can('jmc_student')){
		wp_redirect(admin_url('edit.php?post_type=jmc'));
	}
	else{
		if(current_user_can('jmc_empleador')){
//	    if ( current_user_can('jmc_student')) {
	    	/*
			$current_user = wp_get_current_user();
			$author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
			$author_posts = new WP_Query($author_query);
			$author_post_id = $author_posts->posts[0]->ID;

			if($author_posts->posts){
				// Si tiene posts
				// Rediccionar al ultimo
				//$url = "post.php?post={$author_post_id}&action=edit";
				$url = "post-new.php?post_type=jmc";
			}else{
				$url = "post-new.php?post_type=jmc";
			}
			wp_redirect(admin_url($url));
			*/
		
			//wp_redirect(admin_url('post-new.php?post_type=jmc'));
			wp_redirect(get_home_url());
		}
	}
}

?>