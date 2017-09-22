<?php
function r_admin_enqueue(){

	global $typenow;

	if( $typenow !== 'jmc'){ // Job Manager Custom
		return;
	}

//	wp_register_style('jmc-css', plugins_url( 'job-manager-custom/assets/css/materialize.css' ));
//	wp_register_style('jmc-materialize', plugins_url('/assets/css/materialize.css', JMC_PLUGIN_URL));
//	wp_enqueue_style('jmc-css');
// 
//	wp_register_style( 'my-plugin', plugins_url( 'job-manager-custom/assets/css/materialize.css' ) );

//	if ((isset($_GET['post_type']) && $_GET['post_type'] == 'jmc') || (isset($_GET['post']) && isset($_GET['action']) && $_GET['action'] == 'edit')) {

// materialize css rompe el listado
//	if(isset($_GET['post']) && ($_GET['action'] && $_GET['action'] == 'edit')){

	global $pagenow;
// $pagenow == 'post.php'
//$pagenow == 'users.php' 	
//$pagenow == 'profile.php' 	

	$screen = get_current_screen();
/*
	WP_Screen Object (
	    [action] => 
	    [base] => post
	    [id] => post
	    [is_network] => 
	    [is_user] => 
	    [parent_base] => edit
	    [parent_file] => edit.php
	    [post_type] => post
	    [taxonomy] => 
	)
*/	
	if(
		($pagenow == 'post-new.php' && $_GET['post_type'] == 'jmc') ||
		($pagenow == 'post.php' && $_GET['action'] == 'edit')
//		(isset($_GET['post_type']) && ($_GET['post_type'] == 'jmc' && $screen->parent_base == 'edit')) ||
//		($_GET['action'] && $_GET['action'] == 'edit')
	){
		wp_enqueue_style( 'my-plugin-css', plugins_url( 'assets/css/materialize.css', JMC_PLUGIN_URL ) );
		wp_enqueue_style( 'custom', plugins_url( 'assets/css/custom.css', JMC_PLUGIN_URL ) );
//		wp_enqueue_script( 'jquery', plugins_url( 'assets/js/jquery.js', JMC_PLUGIN_URL ) );
		wp_enqueue_style( 'jquery-ui', plugins_url( 'assets/css/jquery-ui.css', JMC_PLUGIN_URL ) );
	//	wp_enqueue_style( 'fonts-face', plugins_url( 'assets/css/font-face.css', JMC_PLUGIN_URL ) );
		wp_enqueue_style( 'fonts-face', 'https://fonts.googleapis.com/icon?family=Material+Icons' );

		wp_enqueue_script( 'jquery-ui', plugins_url( 'assets/js/jquery-ui.js', JMC_PLUGIN_URL ) );
		wp_enqueue_script( 'my-plugin-js', plugins_url( 'assets/js/materialize.js', JMC_PLUGIN_URL ) );
		wp_enqueue_script( 'undersore-js', plugins_url( 'assets/js/underscore.js', JMC_PLUGIN_URL ) );

		wp_enqueue_script( 'my-custom-plugin-js', plugins_url( 'assets/js/custom-plugin.js', JMC_PLUGIN_URL ) );

		wp_enqueue_script( 'parsley', plugins_url( 'assets/js/parsley.js', JMC_PLUGIN_URL ) );
	}

//	wp_enqueue_style( 'my-plugin' );

	/*
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_PLUGIN_URL.'/my-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');

	wp_enqueue_style('thickbox');
	*/
}
?>