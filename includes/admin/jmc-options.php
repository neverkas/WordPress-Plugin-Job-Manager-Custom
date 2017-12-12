<?php
function r_job_manager_custom_options($post){
//	$post_data_file = get_post_meta($post->ID, 'jmc-files', true);
	$post_data = get_post_meta($post->ID, 'jmc', true);
	$post_data_file = $post_data['files'];

	$data1 = "";

	$data1 = array();

	$data1['empleadores'] = $post_data['empleadores'];

	if($post_data){	
		foreach($post_data as $index => $item){
	//		if(strstr($index, "jmc-")){
				$name = str_replace("jmc-", "", strtolower($index));

				if($item){
					$data1[$name] = isset($item) ? $item : '';			
				}
	//		}
		}
	}
	wp_nonce_field('metabox_jmc_nonce', 'meta_box_nonce');
//	wp_nonce_field('metabox_jmc_nonce', 'meta_box_nonce');
//	wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

	$fields = job_manager_custom_fields();


$test = array("administrator", "jmc_empleador", "jmc_student");
?>
<div class="row">
	<div id="form-invalid" style="border: solid 4px red; margin: 5px; border-radius: 5px; display:none;">
		<h1 class="center-align" style="color:red;">YOUR RESUME HAS BEEN SAVED BUT IT'S INCOMPLETE.<BR /> PLEASE COMPLETE!</h1>
	</div>

	<div class="col s10 center-align">	

		<img src="<?php echo bloginfo('template_directory'); ?>/images/logo.jpg" height="120">
<?php
            $current_user = wp_get_current_user();
        $author_query = array('post_type' => 'jmc','posts_per_page'=>1, 'author' => $current_user->ID);
        $author_posts = new WP_Query($author_query);
        $author_post_id = $author_posts->posts[0]->ID;

        //echo count($author_posts->posts);

    if ( current_user_can('jmc_student')) {
        if(($author_posts->posts)){
            // Si tiene posts
            // Rediccionar al ultimo
            $url = "post.php?post={$author_post_id}&action=edit";
        }else{
            $url = "post-new.php?post_type=jmc";
        }
    }
?>
	</div>
</div>
<?php if(current_user_can('administrator')){ ?>
<div class="row">
	<div class="col s10">

		<ul class="collapsible" data-collapsible="accordion">	
		<!-- ADJUNTAR ARCHIVOS # START -->
			<li>
			  <div class="collapsible-header active">
				<h4>
					<i class="material-icons">supervisor_account</i>
					Elegir empleadores
				</h4>
			  </div>
			  <div class="collapsible-body">
				<div class="row">
					<?php $blogusers = get_users( 'role=jmc_empleador' ); ?>
			      <ul class="collection">
					<?php foreach ( $blogusers as $user_data ) { ?>
						<?php $user = $user_data->user_login; ?>
				    	<?php
				    	//$checked = (in_array($user, $data1['empleadores'])) ? 'checked' : '';
				    	$checked = '';

				    	if($data1['empleadores'] && in_array($user, $data1['empleadores'])){
				    		$checked = 'checked';
				    	}
				    	?>
			        	<li class="collection-item">
					      <input name="empleadores[]" type="checkbox" id="<?=$user?>" value="<?=$user?>" <?=$checked?> />
					      <label for="<?=$user?>"><?=ucwords($user)?></label>
					    </li>
					<?php } ?>
			      </ul>

				</div>
			</div>	
			</li>
		</ul>	
	</div>	
</div>	
<?php }else{ ?>
	<?php foreach($data1['empleadores'] as $empleador){ ?>
	<input name="empleadores[]" type="hidden" value="<?=$empleador?>">
	<? } ?>
<? } ?>

<?php $files = array("profile-picture"); ?>
<div class="row">
	<div class="col s10">
	
	<h1 class="center-align">Complete the Resume</h1>

		<ul class="collapsible" data-collapsible="accordion">	
		<!-- ADJUNTAR ARCHIVOS # START -->
			<li>
			  <div class="collapsible-header">
				<h4>
					<i class="material-icons">note_add</i>
					Attach Files
				</h4>
			  </div>
			  <div class="collapsible-body">
				<div class="row">
					<div class="col s12">
						<?php if(current_user_can('administrator') || current_user_can('jmc_student')){ ?>
						<?php foreach ($files as $key => $value) { ?>
						<?php
						$placeholder = "Archivos Permitidos: PDF, DOCX, JPG";

						if($value == "profile-picture"){
							$placeholder = "Archivos Permitidos: JPG";
						}
						?>
						    <div class="file-field input-field <?=$value?>">
						      <div class="btn">
						        <span><?=$value?></span>
						      	<?php if($post_data_file["file-{$value}"] || ($value != "profile-picture" && $value != "first-reference-letter") ){ ?>	
									<input type="file" name="file-<?=$value?>" value="<?=$post_data_file["file-{$value}"]?>" size="0" />
								<?php }else{ ?>
									<input type="file" name="file-<?=$value?>" value="<?=$post_data_file["file-{$value}"]?>" size="0" data-parsley-required="true" data-parsley-error-message="*Debes completar este campo" />
								<?php } ?>

									<input type="hidden" name="file-<?=$value?>" value="<?=$post_data_file["file-{$value}"]?>" />
						      </div>
						      
						      <div class="file-path-wrapper">
						      	<?php if($post_data_file["file-{$value}"]){ ?>	
							        <input class="file-path validate" type="text" value="<?=$post_data_file["file-{$value}"]?>" placeholder="<?=$placeholder?>">
						        <?php }else{ ?>
							        <input class="file-path validate" type="text" placeholder="<?=$placeholder?>">
						        <?php } ?>
						      </div>
						    </div>
						<? } ?>
						<? } ?>

						<div class="col s12">
						<?php if($data1 && $data1['files']){ ?>
							<?php foreach ($files as $key => $input_name) { ?>
							<?php
							$image_src = "";
							
							if($data1['files'] && $data1['files']["file-{$input_name}"]){
								$image_src = $data1['files']["file-{$input_name}"];
							}
							?>
							<?php
							$ext 			= pathinfo($image_src, PATHINFO_EXTENSION);
							$file_is_pdf 	= false;
							$file_is_word 	= false;
							$image_default 	= "";

							if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx'){
								
								if($ext == 'pdf'){								
									$file_is_pdf = true;
									$image_default = plugins_url(). "/job-manager-custom/assets/img/pdf.jpg";
								}
								if($ext == 'doc' || $ext == 'docx'){								
									$file_is_word = true;
									$image_default = plugins_url(). "/job-manager-custom/assets/img/word.png";
								}									
							}
							?>
							<?php if($image_src){ ?>
							<?php $name_format = str_replace("-", " ", $input_name); ?>
								  <!-- Modal Trigger -->
								  <div class="col s5">
									  <div class="card small" style="padding:5px !important; height: 250px !important;">
									  	<div class="card-image">
											<? if($file_is_pdf == true || $file_is_word == true){	?>											
											<img src="<?=$image_default?>" />
											<? }else{ ?>
											<img src="<?=$image_src?>" />
											<? } ?>
									  	</div>

									  	<div class="card-content" style="padding:10px !important; margin:0px !important;">
									  		<p style="margin:0px !important; padding:0px !important; font-weight: 600;">
												<?=ucwords($name_format)?>
									  		</p>
									  	</div>

									  	<div class="card-action">
											<?php //if(current_user_can('administrator')){ ?>
											<input name="remove-file" type="hidden" name="file" value="<?=$input_name?>">
											<a download class="btn btn-sm green" href="<?=$image_src?>"><i class="material-icons left">play_for_work</i> Download</a>
											<span class="btn red btn-sm removeAttachFile"> <i class="material-icons left">delete</i>Remove</span>
											<?php //}else{ ?>
												<? if($file_is_pdf == false){	?>
										  		<a class="modal-trigger btn btn-primary btn-sm" data-target="<?=$input_name?>"><i class="material-icons left">zoom_in</i>Preview</a>
												<?php } ?>
											<?php //} ?>

									  	</div>
									  </div>
								  </div>
								  <!-- Modal Structure -->
								  <div id="<?=$input_name?>" class="modal">
								    <div class="modal-content">
								      <h4><?=ucwords($name_format)?></h4>
								      <p>
									      <img src="<?=$image_src?>" />
								      </p>
								    </div>
								    <div class="modal-footer">
								      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</a>
								    </div>
								  </div>
							<?php }?>
							<?php }?>
						<?php } ?>
						</div>
					</div>
				</div>
			  </div>
			</li>

		<!-- ADJUNTAR ARCHIVOS # END -->

		<? foreach($fields as $index => $value){ ?>
				<?
				$block_class = ($value['show']===false) ? "" : 'jmc-block';
				$block_style = ($value['show']===false) ? "style='display:none;'" : '';
				?>
				<li id="<?=$value['title']?>" class="row <?=$value['title']?> <?=$block_class?>" <?=$block_style?>>
					<div class="collapsible-header">
						<h4>
							<i class="material-icons">mode_edit</i>

							<?=$value['title']?>
						</h4>
					</div>
					
					<div class="collapsible-body">
						<?
						foreach($value['fields'] as $field_index => $field_value){
							$post_data_name = "";
							$text 		= "";

							if($field_value && $field_value['text']){							
								$text 		= $field_value['text'];
							}

							$name 		= str_replace(" ", "", strtolower($text));
							//$nameInput 	= "jmc-" . $name;
							$nameInput 	= "jmc-{$name}";

							if($post_data[$nameInput]){
								$post_data_name = $post_data[$nameInput];
							}

							if($text == "Courses" || $text == "Experiences"){
							//if($text == "Courses" || $text == "Experiences" || $text == "Skills"){
								jmcAddBlock(strtolower($text), $nameInput, $post_data);
							}

							jmcForm($field_value, $post_data);
						}
						?>					
					</div>
				</li>
		<? } ?>
		</ul>
	</div>
</div>
<?php
}
?>