<?php
function admin_column_edit_head( $columns ) {


	$columns =  array();
	
	if(current_user_can('administrator')){
		$columns['cb'] = "<input type='checkbox' />";
	}

	if(current_user_can('jmc_empleador')){
		$columns['profile-picture'] = "Profile Picture";
	}

	$columns['fullname'] = "Full Name";
	$columns['author'] = "Author";
	$columns['date'] = "Date";

	return $columns;
}

function admin_column_edit_content($column) {
	global $post;

	$data = get_post_meta($post->ID, 'jmc', true);
	$files = $data['files'];
	$data2 = get_post_meta($post->ID);
	
	if($column == 'profile-picture' && current_user_can('jmc_empleador')){
		$profile_picture = $files['file-profile-picture'];

		if($profile_picture){
			echo "<img src='$profile_picture' width='30%'>";
		}

	}

/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/
//print_r($data["jmc-fullname"]);

	$fullname = $data["jmc-fullname"];

	if($column == 'fullname'){
		echo "<a href='".get_edit_post_link($post->ID, true)."'>";
		echo "Curriculum Vitae - {$fullname}";
		echo "</a>";
	}
}
/*
add_filter( 'parse_query', 'prefix_parse_filter' );
function  prefix_parse_filter($query) {
   global $pagenow;
   $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

   if ( is_admin() && 
//     'readline_completion_function(function)' == $current_page &&
//     'edit.php' == $pagenow && 
      isset( $_GET['fullname'] ) && 
      $_GET['fullname'] != '') {

    $fullname = $_GET['fullname'];
    $query->query_vars['meta_key'] = 'fullname';
    $query->query_vars['meta_value'] = $fullname;
    $query->query_vars['meta_compare'] = '=';
  }
}
*/

/*
function my_column_register_sortable( $columns )
{
	$columns['fullname'] = 'fullname';
	return $columns;
}

add_filter("manage_edit-page_sortable_columns", "my_column_register_sortable" );
*/
/*
add_filter( 'manage_edit-movie_sortable_columns', 'movie_column_register_sortable' );
 
function movie_column_register_sortable( $post_columns ) {
    $post_columns = array(
        'fullname' => 'fullname',
        );
 
    return $post_columns;
}


add_filter( 'parse_query', 'sort_posts_by_meta_value' );
 
function sort_posts_by_meta_value($query) {
    global $pagenow;
    if (is_admin() && $pagenow=='edit.php' &&
        isset($_GET['post_type']) && $_GET['post_type']=='jmc' &&
        isset($_GET['orderby'])  && $_GET['orderby'] !='None')  {
        $query->query_vars['orderby'] = 'meta_value';
        $query->query_vars['meta_key'] = $_GET['orderby'];
    }
}

add_action('manage_posts_custom_column', 'manage_movie_custom_column',10,2);
 
function manage_movie_custom_column($column_key,$post_id) {
    global $pagenow;
    $post = get_post($post_id);
    if ($post->post_type=='movie' && is_admin() && $pagenow=='edit.php')  {
        echo ( get_post_meta($post_id,$column_key,true) ) ? get_post_meta($post_id,$column_key,true) : "Undefined";
    }
}
*/
/*
 add_filter( 'manage_edit-jmc_sortable_columns', 'my_website_manage_sortable_columns' );
function my_website_manage_sortable_columns( $sortable_columns ) {
   $sortable_columns[ 'fullname' ] = 'fullname';
}


function extend_admin_search( $query ) {

	// Extend search for document post type
	$post_type = 'jmc';
	// Custom fields to search for
	$custom_fields = array(
        "_fullname",
    );

    if( ! is_admin() )
    	return;
    
  	if ( $query->query['post_type'] != $post_type )
  		return;

    $search_term = $query->query_vars['s'];

    // Set to empty, otherwise it won't find anything
    $query->query_vars['s'] = '';

    if ( $search_term != '' ) {
        $meta_query = array( 'relation' => 'OR' );

        foreach( $custom_fields as $custom_field ) {
            array_push( $meta_query, array(
                'key' => $custom_field,
                'value' => $search_term,
                'compare' => 'LIKE'
            ));
        }

        $query->set( 'meta_query', $meta_query );
    };
}

add_action( 'pre_get_posts', 'extend_admin_search' );
*/
?>