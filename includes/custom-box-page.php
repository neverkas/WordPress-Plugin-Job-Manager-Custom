<?php
//Initializing variable
$action = ""; //Initialization value; Examples
$action = isset($_GET['action']) ? $_GET['action'] : '';

if(
	($pagenow == 'post-new.php' && $_GET['post_type'] == 'page') ||
	($pagenow == 'post.php' && $action == 'edit')
){
	wp_enqueue_style( 'my-plugin-css', plugins_url( 'assets/css/materialize.css', JMC_PLUGIN_URL ) );
	wp_enqueue_script( 'my-plugin-js', plugins_url( 'assets/js/materialize.js', JMC_PLUGIN_URL ) );

	wp_enqueue_script( 'jquery-ui', plugins_url( 'assets/js/jquery-ui.js', JMC_PLUGIN_URL ) );
	wp_enqueue_style( 'jquery-ui', plugins_url( 'assets/css/jquery-ui.css', JMC_PLUGIN_URL ) );
	wp_enqueue_script( 'my-custom-plugin-js', plugins_url( 'assets/js/custom-plugin.js', JMC_PLUGIN_URL ) );
}

function link_page_download()
{
	global $post;
	$data =  get_post_meta($post->ID, "link-page-download", true);
	$data_file =  get_post_meta($post->ID, "file-page-download", true);

	 wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	echo "
	<div style='display:none;'>
		<p>
			<span style='color:red;'>
				<b>Write your url link here:</b>
			</span>

			<input placeholder='http://example.com' name='link-page-download' type='text' value='{$data}'>
		</p>
		<p>
			<i>(Ex.: http://example.com)</i>
		</p>

		<p>
			<span style='color:red;'>
				<b>Select your file here:</b>
			</span>
		</p>
	</div>

	<div class='row'>
	    <div class='file-field input-field'>
	      <div class='btn'>
	        <span>File</span>

			<input type='file' name='file-page-download' file='{$data_file}' size=0 />
			<input type='hidden' name='file' value='{$data_file}' />
	      </div>

	      <div class='file-path-wrapper'>
	        <input class='file-path validate' type='text' value='{$data_file}'>
	      </div>
	    </div>
	</div>
	";
    
}

function add_link_page_download()
{
    add_meta_box("link-page-download", "Link Page Download", "link_page_download", "page", "side", "high", null);
}

add_action("add_meta_boxes", "add_link_page_download");

function save_link_page_download($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("administrator", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "page";
    if($slug != $post->post_type)
        return $post_id;
	
	if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
	$data_files = array();
	$supported_types = array('application/pdf', 'image/jpeg', 'image/png');
	
/*
echo "<pre>";
print_r($_FILES);
print_r($_FILES);
echo "</pre>";

die();
*/	
	$file = $_FILES['file-page-download'];
	$data_file = null;

	if(!empty($file['name'])){ //New upload
		$arr_file_type = wp_check_filetype(basename($file['name']));
        $uploaded_type = $arr_file_type['type'];

        if(in_array($uploaded_type, $supported_types)) {
			$override['action'] = 'editpost';
			$uploaded_file 		= wp_handle_upload($file, $override);
			$attachment 		= array(
				 'post_title' => $file['name'],
				 'post_content' => '',
				 'post_type' => 'attachment',
				 'post_parent' => $post_id,
				 'post_mime_type' => $file['type'],
				 'guid' => $uploaded_file['url']
			);
			// Save the data
			$id = wp_insert_attachment( $attachment,$file[ 'file' ], $post_id );

			if($id){
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file['file'] ) );
				$data_file =$uploaded_file['url'];
			}
        }

	}

    $link_page_download = "";

    if(isset($_POST["link-page-download"]))
    {
        $link_page_download = $_POST["link-page-download"];
    }   

	if(!empty($file['name'])){ //New upload
		$file_page_download = $data_file;		
	}
	else{
	    if(isset($_POST["file-page-download"]))
	    {
	        $file_page_download = $_POST["file-page-download"];
		}
	}

    update_post_meta($post_id, "link-page-download", $link_page_download);
    update_post_meta($post_id, "file-page-download", $file_page_download);
}

add_action("save_post", "save_link_page_download", 10, 3);

?>