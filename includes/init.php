<?php
function job_manager_custom_init(){
	$labels = array(
		'name'               => __( 'Curriculums', 'job-manager-custom' ),
		'singular_name'      => __( 'Curriculum', 'job-manager-custom' ),
		'menu_name'          => __( 'Job Manager Custom','job-manager-custom' ),
		'name_admin_bar'     => __( 'Curriculum', 'job-manager-custom' ),		
		'add_new'            => __( 'Add New', 'job-manager-custom' ),
		'add_new_item'       => __( 'Add New Curriculum', 'job-manager-custom' ),
		'new_item'           => __( 'New Curriculum', 'job-manager-custom' ),
		'edit_item'          => __( 'Edit Curriculum', 'job-manager-custom' ),
		'view_item'          => __( 'View Curriculum', 'job-manager-custom' ),
		'all_items'          => __( 'All Curriculums', 'job-manager-custom' ),
		'search_items'       => __( 'Search Curriculums', 'job-manager-custom' ),
		'parent_item_colon'  => __( 'Parent Curriculums:', 'job-manager-custom' ),
		'not_found'          => __( 'No Curriculums found.', 'job-manager-custom' ),
		'not_found_in_trash' => __( 'No Curriculums found in Trash.', 'job-manager-custom' )
	);

	$capabilities = array(
		// meta caps (don't assign these to roles)
		//'manage_posts'           => 'manage_jmcs',

		'edit_post'              => 'edit_jmc',
		'read_post'              => 'read_jmc',
		'delete_post'            => 'delete_jmc',

		// primitive/meta caps
		'create_posts'           => 'create_jmcs',
//		'create_posts'           => false,

		// primitive caps used outside of map_meta_cap()
		'edit_posts'             => 'edit_jmcs',
		'edit_others_posts'      => 'edit_others_jmcs',
		'publish_posts'          => 'pubish_jmcs',
		'read_private_posts'     => 'read_private_jmcs',

		// primitive caps used inside of map_meta_cap()
		'read'                   => 'read',
		'delete_posts'           => 'delete_jmcs',
		'delete_private_posts'   => 'delete_private_jmcs',
		'delete_published_posts' => 'delete_published_jmcs',
		'delete_others_posts'    => 'delete_others_jmcs',
		'edit_private_posts'     => 'edit_private_jmcs',
		'edit_published_posts'   => 'edit_published_jmcs'
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'job-manager-custom' ),
		'exclude_from_search' => false,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'can_export' 		=> true,
		'rewrite'            => array( 'slug' => 'jmc' ), // Job Manager Custom
		//'rewrite'            => array( 'slug' => '' ), // Job Manager Custom
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 2,
//		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		'supports'           => array('fullname', 'jmc-fullname', 'author'),
//		'taxonomies' 		 => array('category', 'post_tag'),

		'map_meta_cap' => true, // or false?
		//'capability_type'    => 'post',
		'capability_type' => array('jmc', 'jmcs'),
//		'capability_type' => 'jmc',
		'capabilities' => $capabilities,

	);

	register_post_type( 'jmc', $args );
	
//	flush_rewrite_rules(false);
	
}
?>