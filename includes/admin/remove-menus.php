
<?php
function remove_menus () {
//function remove_menus ($role, $menus) {
/*
    // Get the role object.
    $author = get_role( 'author' );

	// A list of capabilities to remove from editors.
    $caps = array(
    	'publish_posts',
    	'edit_posts',
        'moderate_comments',
        'manage_categories',
        'manage_links',
        'edit_others_posts',
        'edit_others_pages',
        'delete_posts',
    );

    foreach ( $caps as $cap ) {
    
        // Remove the capability.
        $author->remove_cap( $cap );
    }
*/    
/*
  remove_menu_page( 'index.php' );                  //Dashboard  
  remove_menu_page( 'edit.php' );                   //Posts  
  remove_menu_page( 'upload.php' );                 //Media  
  remove_menu_page( 'edit.php?post_type=page' );    //Pages  
  remove_menu_page( 'edit-comments.php' );          //Comments  
  remove_menu_page( 'themes.php' );                 //Appearance  
  remove_menu_page( 'plugins.php' );                //Plugins  
*/

  if(!current_user_can('administrator')){
//    remove_submenu_page( 'edit.php?post_type=jmc', 'edit.php?post_type=jmc' );
  }

  global $menu;
  
  $restricted = array(__('Dashboard'), __('Posts'), __('Pages'), __('Media'), __('Comments'), __('Appearance'), __('Plugins'), __('Tools'), __('Settings'), __('Users'));

  if(current_user_can('administrator')){
//    $restricted = array(__('Dashboard'), __('Posts'), __('Pages'), __('Media'), __('Comments'), __('Appearance'), __('Plugins'), __('Tools'), __('Settings'));
//    $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Comments'), __('Appearance'), __('Plugins'), __('Settings'));
    $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Comments'), __('Plugins'));
  }

  if(current_user_can('jmc_empleador')){
//    remove_menu_page( 'edit.php?post_type=jmc' );                // Custom Plugin  
    $restricted = array(__('Dashboard'), __('Curriculums'), __('Posts'), __('Pages'), __('Media'), __('Comments'), __('Appearance'), __('Plugins'), __('Tools'), __('Settings'), __('Users'));
  }

	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}

}

//add_action('admin_menu', 'remove_menus');
?>