<?php
/**
*	Plugin Name: Job Manager Custom
*	Description: The people can upload their curriculums vitae, and the companies choose their if they want.
* 	Version: 1.0
* 	Author: Neverkas
* 	License: GPL2
* 	Text Domain: job-manager-custom
*/


if(!function_exists('add_action')){
	echo "Not allowed!";
	exit();
}
// Setup
define('JMC_PLUGIN_URL', __FILE__);

// Includes
include('includes/admin/redirect-myplugin.php');
include('includes/admin/login-redirect.php');

include('includes/admin/registration-text-form.php');
include('includes/admin/sender-email.php');
include('includes/admin/admin-column-edit.php');
include('includes/admin/list-remove-views-filter.php');
include('includes/admin/list-posts-by-author.php');
include('includes/admin/capabilities-by-roles.php');
include('includes/admin/user-profile-custom-fields.php');
include('includes/admin/user-profile-custom-fields-save.php');

include('includes/admin/remove-button-save-draft.php');
include('includes/admin/login-custom-css.php');
include('includes/admin/replace-the-password-form.php');
include('includes/admin/change-publish-button.php');
include('includes/admin/disable-random-password.php');
include('includes/admin/remove-menus.php');
include('includes/admin/remove-dashboard-widgets.php');
include('includes/admin/modify-footer-admin.php');
include('includes/admin/custom-admin-bar-links.php');
include('includes/admin/custom-admin-bar-links2.php');
include('includes/admin/hide-toolbar.php');

include('includes/admin/fields.php');

include('includes/activate.php');
include('includes/init.php');
include('includes/admin/init.php');

include('actions/force-login.php');
include('actions/save.php');

// template
include('actions/filter-content.php');
include('actions/redirect-user-by-role.php');

//include('includes/custom-login-head.php');

include('includes/custom-box-page.php');
//include('actions/jmc-template.php');

// Hooks
register_activation_hook(__FILE__, 'r_activate_plugin');

//add_action('load-index.php', 'dashboard_Redirect'); // Solo funciona cuando ingresa al /wp-admin
add_action('admin_init', 'dashboard_Redirect'); // genera un loop y tira error
add_filter( 'login_redirect', 'acme_login_redirect', 10, 3 );

//add_action('wp_login', 'dashboard_Redirect');  // no esta redireccionando
//add_action('admin_init', 'dashboard_Redirect'); // genera un loop y tira error
//add_action('wp_login','my_redirect_user_by_role', 10, 3);
//add_action( 'admin_init', 'cm_redirect_users_by_role' );

add_filter( 'wp_login_errors', 'wpse_161709', 10, 2 );


add_action( 'login_enqueue_scripts', 'my_login_custom' );


add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

add_filter('the_content','replace_the_password_form');

add_filter( 'random_password', 'disable_random_password', 10, 2 );

add_filter( 'gettext', 'change_publish_button', 10, 2 );

add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'personal_options_update', 'crf_update_profile_fields' );
add_action( 'edit_user_profile_update', 'crf_update_profile_fields' );

add_action('init', 'capabilities_by_roles');
add_action( 'pre_get_posts', 'list_posts_by_author' );
add_filter('views_edit-jmc', 'list_remove_views_filter' );

add_action('admin_print_styles', 'remove_this_stuff');
add_action('admin_menu', 'remove_menus');
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
add_filter('admin_footer_text', 'modify_footer_admin');
add_action('wp_before_admin_bar_render', 'custom_admin_bar_links' );

add_action('admin_bar_menu', 'update_adminbar', 999);

add_action('init', 'job_manager_custom_fields');
add_action('init', 'job_manager_custom_init');
add_action('admin_init', 'job_manager_custom_admin_init');
add_action('save_post', 'job_manager_custom_save');

// template 
add_filter('the_content', 'filter_jmc_content');
//add_filter('single_template', 'filter_jmc_content');

// Shortcodes

add_filter( 'manage_edit-jmc_columns', 'admin_column_edit_head' ) ;
add_action( 'manage_jmc_posts_custom_column', 'admin_column_edit_content', 10, 2);

add_action('init','force_login');

add_action("login_head", "custom_login_head");
/*
function extend_admin_search( $query ) {
 
    if ( is_search() && $query->is_main_query() && $query->get( 's' ) ) {
    
        $query->set(
        
            'post_type', array('post', 'page', 'jmc'),
            'meta_query', array(
                array(
                'key' => 'jmc',
                'value' => '%s',
                'compare' => 'LIKE',
                ),
            )
        );
        
        return $query;
    }
}
add_action( 'pre_get_posts', 'extend_admin_search' );
*/
function disable_new_posts() {
    // Hide sidebar link
    global $submenu;

    if ( current_user_can('jmc_student')) {
        unset($submenu['edit.php?post_type=jmc'][10][1]);

        // Hide link on listing page
        //if ($_GET['post_type'] == 'jmc') {
            echo '<style type="text/css">
            #favorite-actions, .add-new-h2, .tablenav, .wrap h1 a{ display:none; }
            </style>';
        //}
    }

}

//add_action('admin_menu', 'disable_new_pdisable_new_postsosts');

?>

