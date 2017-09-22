<?php
function job_manager_custom_admin_init(){
	include('create-metaboxes.php');
	include('jmc-options.php');
	include('queue.php');

	add_action('add_meta_boxes', 'r_create_metaboxes');
//	add_action('wp_enqueue_scripts', 'r_admin_enqueue');
	add_action('admin_enqueue_scripts', 'r_admin_enqueue');
}
?>