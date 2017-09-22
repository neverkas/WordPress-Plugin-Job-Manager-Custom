<?php
function job_manager_custom_save($post_id, $post, $update){

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset( $_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'metabox_jmc_nonce')) return;
	if(!current_user_can('edit_post')) return;

	$fields = $_POST;

	$data1 = array();
	$data1["empleadores"] = $fields["empleadores"];

	foreach($fields as $index => $item){
		if(strstr($index, "jmc-")){
			$data1[$index] = $item;			
		}
	}
	$blocks = array("courses", "experiencies", "skills");

	foreach($blocks as $itemName){
		$data1["jmc-{$itemName}"] = $fields[$itemName];
	}

/**
*	TEST FILE UPLOAD
**/
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

$data2 = array();

echo "<h1>FILES 1</h1>";
echo "<pre>";
print_r($_FILES);
echo "</pre>";

echo "<h1>FILES 2</h1>";
foreach ($_FILES as $key1 => $value1) {

	if(in_array($key1, $blocks)){

		if(!empty($value1['name'])){ //New upload

			foreach ($value1 as $key2 => $value2) {
				foreach ($value2 as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						//if(!empty($value4) && $key2 != 'error'){
						if(!empty($value4)){
							$data1["jmc-{$key1}"][$key3][$key4][$key2] = $value4;
							$data2["jmc-{$key1}"][$key3][$key4][$key2] = $value4;

							$field_data1 = $data1["jmc-{$key1}"][$key3][$key4];
	//						$data1["jmc-".$key1][$key3][$key4][$key2] = $value4;
	
							if($field_data1['name'] && $field_data1['url'] && $field_data1['type']){
								$data2["jmc-{$key1}"][$key3][$key4]['name'] = $field_data1['name'];								
								$data2["jmc-{$key1}"][$key3][$key4]['url'] = $field_data1['url'];								
								$data2["jmc-{$key1}"][$key3][$key4]['type'] = $field_data1['type'];								

								$data1["jmc-{$key1}"][$key3][$key4]['name'] = $field_data1['name'];								
								$data1["jmc-{$key1}"][$key3][$key4]['url'] = $field_data1['url'];								
								$data1["jmc-{$key1}"][$key3][$key4]['type'] = $field_data1['type'];								

								echo "<h1>EXISTE</h1>";
								echo "<p>Form Data [name]: {$field_data1['name']}</p>";
								echo "<p>Form Data [type]: {$field_data1['type']}</p>";
								echo "<p>Form Data [url]: {$field_data1['url']}</p>";

								echo "<p> jmc-{$key1}][$key3][$key4][$key2] = $value4 </p>";
								echo "<p> [$key1][$key3][$key4]['url'] </p>";
							}
							else{
								$data1["jmc-{$key1}"][$key3][$key4][$key2] = $value4;
								$data2["jmc-{$key1}"][$key3][$key4][$key2] = $value4;

								echo "<h1>NO EXISTE</h1>";
								echo "<p>Form Data [name]: {$field_data1['name']}</p>";
								echo "<p>Form Data [type]: {$field_data1['type']}</p>";
								echo "<p>Form Data [url]: {$field_data1['url']}</p>";

								echo "<p> jmc-{$key1}][$key3][$key4][$key2] = $value4 </p>";
							}


//							echo "data1: ".$field_data1['url'];
							
						}

						// 	key1 - experiencie
						// 	key3- id
						//	key4 - name input
						//	key2 - field name
						//	value4 - field data
						
					}
				}

			}
		}
	}
}


echo "<h1>DATA2</h1>";
echo "<pre>";
print_r($data2);
echo "</pre>";


foreach ($data2 as $key1 => $value1) {
	foreach ($value1 as $key2 => $value2) {
		foreach ($value2 as $input_name => $file_data) {

			echo "<pre>";
			print_r($file_data);
			echo "</pre>";

			echo "input_name: $input_name <br />";

			# code...
			$override['action'] = 'editpost';

			$uploaded_file = wp_handle_upload($file_data, $override);
			//$attachment['post_title'] = $_FILES[$file_input_name]['name'];

			$attachment = array(
				'post_title' => $file_data['name'],
				'post_content' => '',
				'post_type' => 'attachment',
				'post_parent' => $post_id,
				'post_mime_type' => $file_data['type'],
				'guid' => $uploaded_file['url']
			);

			// Save the data
			$id = wp_insert_attachment( $attachment,$file_data[ 'file' ], $post_id );
			wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file_data['file'] ) );

			echo "<p><b>uploaded_file['url']:</b> {$uploaded_file['url']}</p>";

			if($file_data['url']){
				echo "[$key1][$key2][$input_name]['url']";
				echo "<br />";	
				echo $data1[$key1][$key2][$input_name]['url'];
				//$data1[$key1][$key2][$input_name]['url'] = $file_data['url'];
			}else{			
				if(empty($file_data['url'])){
					$data1[$key1][$key2][$input_name]['url'] = $uploaded_file['url'];
				}
			}


		}

		
		# code...
	}
}


echo "<h1>DATA1</h1>";
echo "<pre>";
print_r($data1);
echo "</pre>";

update_post_meta($post_id, 'jmc', $data1);

die();
}
?>