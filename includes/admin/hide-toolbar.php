<?php
function admin_hide_toolbar($column) {
	if(!current_user_can('administrator') || !current_user_can('jmc_empleador')){
		//add_filter('show_admin_bar', '__return_false');
		add_filter('show_admin_bar', 'hide_admin_bar');
	}
}
?>