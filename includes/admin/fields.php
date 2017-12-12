<?php
function jmcArray($blockName, $post_data){
	$arr = array();
	$num = 0;

	if($blockName){
		foreach (jmcBlock($blockName) as $blockKey => $blockValue) {
			
			$type 			= "";
			$text 			= "";
			$name 			= "";
			$attr 			= "";
			$class 			= "";
			$input_class 	= "";
			$parent_class 	= "";
			$data 			= "";
			$label 			= "";
			$tooltip 		= "";
			$fields 		= "";
			$show		 	= "";
			$hide_show		= "";
			$hide_show_item	= "";
			$title 			= "";
			$require 		= "";
			$highlight_text = "";
			
			// isset()
			$type 			= isset($blockValue['type']) ? $blockValue['type'] : '';
			$text 			= isset($blockValue['text']) ? $blockValue['text'] : '';
			$attr 			= isset($blockValue['attr']) ? $blockValue['attr'] : '';
			$class 			= isset($blockValue['class']) ? $blockValue['class'] : '';
			$input_class 	= isset($blockValue['input_class']) ? $blockValue['input_class'] : '';
			$parent_class 	= isset($blockValue['parent_class']) ? $blockValue['parent_class'] : '';
			$data 			= isset($blockValue['data']) ? $blockValue['data'] : '';
			$label 			= isset($blockValue['label']) ? $blockValue['label'] : '';
			$tooltip 		= isset($blockValue['tooltip']) ? $blockValue['tooltip'] : '';
			$fields 		= isset($blockValue['fields']) ? $blockValue['fields'] : '';
			$show 			= isset($blockValue['show']) ? $blockValue['show'] : '';
			$hide_show 		= isset($blockValue['hide_show']) ? $blockValue['hide_show'] : '';
			$hide_show_item = isset($blockValue['hide_show_item']) ? $blockValue['hide_show_item'] : '';
			$title 			= isset($blockValue['title']) ? $blockValue['title'] : '';
			$require 		= isset($blockValue['require']) ? $blockValue['require'] : '';
			$highlight_text 		= isset($blockValue['highlight_text']) ? $blockValue['highlight_text'] : '';

			$name 			= str_replace(" ", "", strtolower($text));

			if($post_data && $post_data["jmc-{$blockName}"]){
				foreach ($post_data["jmc-{$blockName}"] as $key => $value) {
					$num++;

					$nameInput 		= "{$blockName}[{$key}][{$name}]";
					$post_data_name = isset($value[$name]) ? $value[$name] : '';

					$arr[$key][$num] = array(
						'arr' => array(
							'blockName' => $blockName,
							'key' 		=> $key,
							'name'		=> $name,
						),

						'type' 			=> $type,
						'nameInput' 	=> $nameInput,
						'post_data_name' => $post_data_name,
						'text' 			=> $text,
						
						'attr' 			=> $attr,
						'class' 		=> $class,
						'input_class' 	=> $input_class,
						'parent_class' 	=> $parent_class,
						'data' 			=> $data,
						'label' 		=> $label,
						'show' 			=> $show,
						'hide_show' 	=> $hide_show,
						'hide_show_item' => $hide_show_item,
						'tooltip' 		=> $tooltip,

						'fields' 		=> $fields,

						'title' 		=> $title,
						'require' 		=> $require,
						'highlight_text'=> $highlight_text
					);
					//echo "$nameInput <br />";
				}
			}
			

		}
	}

	return $arr;
}
?>
<?php
//function jmcAddBlock($blockName, $nameInput, $post_data, $test){
function jmcAddBlock($blockName, $nameInput, $post_data){
	$parseBlockName = ucwords($blockName);
?>
	<?php if(current_user_can('administrator') || current_user_can('jmc_student')){ ?>
	<div class='col s12'>
		<a class='add<?=$parseBlockName?> waves-effect waves-light btn'><i class='material-icons left'>add</i>Add <?=$parseBlockName?></a>
	</div>
	<?php } ?>
		<?php
		if($nameInput == "jmc-{$blockName}"){
			$arr = jmcArray($blockName, $post_data);
		?>
		<div class="col s12">
				<ul class="collapsible2" data-collapsible="accordion">
					<? foreach ($arr as $parent_key => $get_fields){ ?>
					<li class="<?=$parseBlockName?> jmc-list-item">
						<div class="collapsible-header">
							<i class="material-icons">send</i>
				
							<strong>
								<?//=ucwords($blockName)." ($parent_key)"?>
								<?=ucwords($blockName)?> (Por favor completar todos los campos)
							</strong>
						</div>
						<div class="collapsible-body" style="display: inline-block !important;">
						<?				
						foreach ($get_fields as $field_key => $value) {	
							jmcForm($value, $post_data);
						}
						?>
						</div>
					</li>
					<? } ?>
				</ul>
		</div>
		<?
	}
}	

function jmcForm($item_value, $post_data){	
	$arr 		= "";

	$text 		= "";
	$type_input = "";
	$class 		= "";
	$input_class = "";
	$attr 		= "";
	$label 		= "";
	$data 		= "";
	$tooltip 	= "";
	$fields 	= "";
	$show 		= "";
	$hide_show 		= "";
	$hide_show_item 		= "";

	$nameInput 	= "";
	$parent_title = "";
	$parent_key = "";
	$parent_name = "";
	$parent_class = "";
	$require = "";
	$highlight_text = "";


////////
	$arr 			= isset($item_value['arr']) ? $item_value['arr'] : '';
	$text 			= isset($item_value['text']) ? $item_value['text'] : '';
	$type_input 	= isset($item_value['type']) ? $item_value['type'] : '';
	$class 			= isset($item_value['class']) ? $item_value['class'] : '';
	$input_class 	= isset($item_value['input_class']) ? $item_value['input_class'] : '';
	$attr 			= isset($item_value['attr']) ? $item_value['attr'] : '';
	$label 			= isset($item_value['label']) ? $item_value['label'] : '';
	$data 			= isset($item_value['data']) ? $item_value['data'] : '';
	$tooltip 		= isset($item_value['tooltip']) ? $item_value['tooltip'] : '';
	$fields 		= isset($item_value['fields']) ? $item_value['fields'] : '';
	$show 			= isset($item_value['show']) ? $item_value['show'] : '';
	$hide_show 		= isset($item_value['hide_show']) ? $item_value['hide_show'] : '';
	$hide_show_item = isset($item_value['hide_show_item']) ? $item_value['hide_show_item'] : '';
	$nameInput 		= isset($item_value['nameInput']) ? $item_value['nameInput'] : '';
	$parent_title 	= isset($item_value['parent_title']) ? $item_value['parent_title'] : '';
	$parent_key 	= isset($item_value['parent_key']) ? $item_value['parent_key'] : '';
	$parent_name 	= isset($item_value['parent_name']) ? $item_value['parent_name'] : '';
	$parent_class 	= isset($item_value['parent_class']) ? $item_value['parent_class'] : '';
	$require 		= isset($item_value['require']) ? $item_value['require'] : '';
	$highlight_text 		= isset($item_value['highlight_text']) ? $item_value['highlight_text'] : '';


	$parse_name = str_replace(" ", "", strtolower($text));

	if($nameInput){
		$name = $nameInput;
	}else{
		if($parent_key && $parent_name && $parent_title){
			$name 	= "jmc-{$parent_name}[{$parent_key}]['{$parent_title}']['{$parse_name}']";
		}
		else{
			$name 	= "jmc-" . $parse_name;
		}
	}
?>
		<? if($type_input == "title"){ ?>
			<div class="col s12">
				<h5><?=$text?></h5>
			</div>
		<?php } ?>
		<?php
		$post_data_name = "";
		$post_data_name = isset($post_data[$name]) ? $post_data[$name] : '';

		if(current_user_can('jmc_empleador')){
			$name 	= '';
			$tooltip = '';
		}

		if($nameInput){
			//$name 	= "jmc-" . $nameInput;
			$post_data_name = $post_data['jmc-'.$arr['blockName']][$arr['key']][$arr['name']];
		}

//		$label = "$name"; // temporalmente para ver los nombres de los fields

		if($type_input == "file-upload"){
			jmcUploadFile($show, $hide_show_item, $name, $class, $parent_class, $post_data_name, $text, $label, $tooltip);
		}

		if($type_input == "input-text"){
			jmcInputText($show, $hide_show_item, $name, $class, $input_class, $parent_class, $post_data_name, $text, $label, $tooltip, $require, $highlight_text);
		}

		if($type_input == "textarea"){
			jmcInputText($show, $hide_show_item, $name, $class, $parent_class, $post_data_name, $text, $label, $tooltip);
		}

		if($type_input == "select"){
			jmcSelect($show, $hide_show_item, $name, $attr, $class, $parent_class, $post_data_name, $text, $label, $tooltip, $data, $require);
		}

		if($type_input == "checkbox"){
			jmcCheckbox($show, $hide_show, $hide_show_item, $name, $class, $parent_class, $post_data_name, $text, $label, $tooltip, $require);
		}
	?>
<?php } ?>


<?php function jmcCheckbox($show, $hide_show, $hide_show_item, $name, $class, $parent_class, $value, $text, $label, $tooltip, $require){ ?>
<?php $label = ($label) ? $label : $text; ?>
<?php
$show = ($show === false) ? 'display:none;' : '';
$style = "{$show}";
$checked = ($value=='on') ? "checked" : "";

$class = "$class $hide_show_item";

$is_require = (!$require) ? '' : 'data-parsley-required="true" data-parsley-error-message="*Debes completar este campo"';

?>
	<div class="col s12 <?=$class?>" style="<?=$style?>">
		<strong><?php echo $label; ?>:</strong>
		
		<div class="switch" style="margin-bottom:20px;">
	
			<label>
				No
				<?php if($hide_show){ ?>
				<input name="<?php echo $name;?>" type="checkbox" class="hide_show" id="<?=$hide_show?>" <?=$checked?> <?=$is_require?>>
				<?php }else{ ?>
				<input name="<?php echo $name;?>" type="checkbox" <?=$checked?>>
				<?php } ?>
				<span class="lever"></span>
				Yes
			</label>
		</div>
	</div>
<?php } ?>

<?php function jmcUploadFile($name, $hide_show_item, $class, $parent_class, $value, $text, $label, $tooltip){ ?>
<?php $label = ($label) ? $label : $text; ?>
<?php $image_url = ($value['url']) ? $value['url'] : ''; ?>
<?php
$show = ($show === false) ? 'display:none;' : '';
$style = "{$show}";
?>
	    <div class="file-field input-field col s10 <?=$class?>" style="<?=$style?>">
	      <div class="btn">
	        <span>[FILE] <?php echo $label; ?></span>
			<input type="file" id="wp_custom_attachment" name="<?php echo $name;?>" size="0" />
			
			<input type="hidden" name="<?php echo $name;?>[url]" value="<?=$value['url']?>" />
			<input type="hidden" name="<?php echo $name;?>[type]" value="<?=$value['type']?>" />
			<input type="hidden" name="<?php echo $name;?>[name]" value="<?=$value['name']?>" />

	      </div>
	      <div class="file-path-wrapper">
	        <input class="file-path validate" type="text" value="<?=$image_url?>">
	      </div>
	      <?php if($image_url){ ?>
	      <div>
			<?php //print_r($value); 	?>
	      	<img src="<?=$image_url?>" width="150" height="150" />
	      </div>
	      <? } ?>
	    </div>
<?php } ?>
<?php
// jmcInputText($show, $name, $class, $input_class, $parent_class, $post_data_name, $text, $label, $tooltip);

?>
<?php function jmcInputText($show, $hide_show_item, $name, $class, $input_class, $parent_class, $value, $text, $label, $tooltip, $require, $highlight_text){ ?>
<?php $label = ($label) ? $label : $text; ?>
<?php $input_class = ($tooltip) ? "{$class} tooltipped" : $input_class; ?>
<?php $print_tooltip = ($tooltip) ? "data-position='bottom' data-delay=50 data-tooltip='{$label}: $tooltip'" : ''; ?>
<?php
$show = ($show === false) ? 'display:none;' : '';
$style = "{$show}";
$class = "$class $hide_show_item";

$is_highlight_text = (!$highlight_text) ? '' : 'color:#000; font-weight: bold; font-size: 14px;'; // change the background 
$is_highlight_text_div = (!$highlight_text) ? '' : 'border:solid 1px #FF5721;'; // change the background 
$is_highlight_text_background = (!$highlight_text) ? '' : 'background-color:#ff5722; padding:0 10px;'; // change the background 

$is_require = (!$require) ? '' : 'data-parsley-required="true" data-parsley-error-message="*Debes completar este campo"';
?>
	<div class="input-field col s6 <?=$class?>" style="<?=$is_highlight_text_div.$style?>">
	<?php if(current_user_can('jmc_empleador')){ ?>
		<input style="color:#000 !important;" type="text" class="<?=$input_class?> " value="<?php echo $value; ?>" readonly="readonly">
	<?php }else{ ?>
		<input title="<?="$label : $tooltip"?>" <?=$print_tooltip?> name="<?php echo $name;?>" placeholder="" id="" type="text" class="<?=$input_class?> " value="<?php echo $value; ?>" <?=$is_require?>>
	<?php } ?>
	<?php
		if($input_class == 'datepicker'){
		 echo "<span style='color:darkorchid;'><b>Formato:</b> mes/día/año (Ej. 04/12/1994) </span>";	
		}
	?>
		<label style="<?=$is_highlight_text_background?>" for="">
			<span style="<?=$is_highlight_text?>"><?php echo $label; ?></span>
		</label>
	</div>

<?php } ?>

<?php function jmcTextarea($show, $hide_show_item, $name, $class, $parent_class, $value, $text, $label, $tooltip){ ?>
<?php $label = ($label) ? $label : $text; ?>
<?php
$show = ($show === false) ? 'display:none;' : '';
$style = "{$show}";
?>
	<div class="input-field col s12 <?=$class?>" style="<?=$style?>">
		<textarea name="<?php echo $name;?>" id="textarea1" class="materialize-textarea"><?php echo $value; ?></textarea>
		<label for=""><?php echo $label; ?></label>
	</div>
<?php } ?>

<?php function jmcSelect($show, $hide_show_item, $name, $attr, $class, $parent_class, $value, $text, $label, $tooltip, $data, $require){ ?>
<?php $label = ($label) ? $label : $text; ?>
<?php
$name = ($attr == 'multiple') ? "{$name}[]" : $name;

$selected = "";
?>
<?php
$show = ($show === false) ? 'display:none;' : '';
$style = "{$show}";
$class = "$class $hide_show_item";
/*
echo "<pre>";
print_r($value);
echo "</pre>";
*/
$is_require = (!$require) ? '' : 'data-parsley-required="true" data-parsley-error-message="*Debes completar este campo"';
?>
	<div class="input-field col s6 <?=$class?>" style="<?=$style?>">
		<label style="top: -1em !important;"><?php echo $label; ?></label>

		<select name="<?php echo $name; ?>" class="jmc-select" <?=$attr?> <?=$is_require?>>
		<?php if(!$value){ ?>
			<option value="" disabled selected>Choose your option</option>
		<?php }else{ ?>
			<option value="" disabled>Choose your option</option>
		<?php } ?>
			<? foreach($data as $option){ ?>
				<?php //$selected = (!$value && $option == $value) ? "selected" : ""; ?>
				<?php
				if($attr == 'multiple' && is_array($value)){
					$selected = (in_array($option, $value)) ? "selected" : "";
				}
				else{
					$selected = ($option == $value) ? "selected" : "";
				}

				$option_value = $option;
				?>			
				<option value="<?php echo $option_value; ?>" <?=$selected?>><?php echo ucwords($option); ?></option>
			<? } ?>
		</select>
	</div>
<?php } ?>

<?php
//$list_countries = array("Argentina", "Uruguay", "Chile");

function job_manager_select($option){
	$select_list['country'] = array("Argentina", "Uruguay", "Chile", "USA", "Other");
	$select_list['travel_country'] = array("SOUTH AMERICA", "USA", "OCEANIA", "EUROPE", "ASIA", "AFRICA");
	$select_list['country_visited'] = array("SOUTH AMERICA", "USA", "OCEANIA", "EUROPE", "ASIA", "AFRICA");
	$select_list['countries_ski'] = array("Argentina", "Chile", "USA", "France", "Switzerland", "Australia", "Japan", "New Zealand", "Spain", "Canada", "Other");

	$select_list['university'] = array("Belgrano", "Austral", "UCES", "UADE", "PALERMO", "SAN ANDRES", "COMAHUE", "UBA", "FUC", "ITBA", "TORCUATO DI TELLA", "INSTITUTO DE LA MUJER", "DEL SALVADOR", "MARIN", "IAG", "OTT COLLEGE","UNIVERSIDAD NACIONAL DE CORDOBA "," UNIVERSIDAD NACIONAL DE CUYO"," UNIVERSIDAD DE MENDOZA"," UNIVERSDAD BLAS PASCAL"," UNIVERSIDAD CATOLICA DE SALTA","universidad del norte santo tomas de aquino"," Universidad IPS Florentino Ameghino"," UNIVERSIDAD CATOLICA DE CORDOBA"," Universidad del Aconcagua"," Universidad de los Andes Chile"," Universidad del Desarrollo Chile"," Universidad ORT de Uruguay"," Universidad Empresarial Siglo XXI"," Universidad del Centro Educativo Latinoamericana"," Universidad Nacional de Rosario"," Universidad Nacional de Mar del Plata"," Universidad Nacional del Nordeste "," Universidad Nacional del Sur"," Universidad Interamericana", "ISEF N1 Dr Romero Brest", "Universidad Nacional de La Plata" , "UCA", "Other" );

	$select_list['fields_of_study'] = array("Advertising", "Graphic design", "Industrial design", "Architecture", "Medicine", "Law", "Engineering", "Professor", "Culinary",  "Hotel managament",  "Bussiness administration",  "Communication",  "Accountant", "Economics", "Biology", "Arts", "Teacher", "Tourism", "Acting", "Musician", "Agriculture", "Translator", "Public Relations", "Economy", "Human Resources", "Finance", "Journalism", "IT", "Marketing", "Geography", "Nutrition", "Film Director", "Pharmacy", "Dentistry", "Phycology", "Chemistry", "Gym Coach", "Event Organizer", "Other");

	$select_list['company_field'] = array("Restaurant", "Hotel", "Accountant Office", "Administrative Office", "Law Office", "Design Studio", "Merchant Store", "Clothing Store", "School", "Kindergarten", "Computing/Technology", "Fashion", "Education", "Art", "Hospital/Medicine", "Bank", "Volunteer Job", "Freelance Job", "Internship Job", "Tourism", "Other");
	$select_list['position'] = array("Sales Person", "Assistant/Secretary", "Front Desk Agent", "Teacher/Professor", "Cook/Chef", "Administrative Clerk", "Waiter/Waitress", "Photographer", "Host/Hostess", "Customer Service Rep", "Designer", "D.J.", "Nanny/Babysitting", "Artist", "Delivery person", "Multitasking position", "Cashier", "Busser", "Barista", "Cashier", "Sports Trainer", "Private Tutor",  "VOLUNTEER"," CAMP COUNSELOR"," NURSERY"," SKI INSTRUCTOR"," SNOWBOARD INSTRUCTOR"," INTERN"," CUSTOMER SERVICE REP"," SKI INSTRUCTOR'S ASSISTANT"," RENTAL TECH"," LIFT"," PREP COOK"," MASCOT", "Other");
	$select_list['contact_person_position'] = array("Manager", "Supervisor", "Assessor", "Owner", "Co-worker", "Team Leader");
	
	$select_list['languages'] = array("Spanish", "English", "French", "German", "Italian", "Portuguese", "Japanese", "Chinese");
	$select_list['languages_levels'] = array("Beginner", "Intermediate", "Upper Intermediate", "Advanced", "Native");
	$select_list['programs'] = array("Microsoft Office", "Mac", "Design Software", "Engineering Software", "Architecture Software", "Internet/Emailing/Skype");

	$select_list['snow_levels'] = array("Beginner", "Intermediate", "Advanced", "Racer");
	$select_list['quantity_of_seasons_skied'] = array(0, 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
	$select_list['other_sports'] = array("Tennis", "Basketball", "Football", "Rugby", "Golf", "Paragliding", "Ice Skating", "Running", "Swimming", "Biking", "Hockey", "Hourse Riding", "Polo", "Gym");

	$select_list['international_exams'] = array("IGCSE (International General Certificate of Secondary Education in English)", "PET (Preliminary English Test)", "CAE (Certificate of Advanced English", "TOEFL", "DELF (French Examination)", "FCE (First Certificate in English)", "IB (International Baccalaureate)");

	$select_list['activities_and_interests'] = array("watch movies", "practise sports", "sing", "play instruments", "traveling", "reading", "hanging out with friends", "dancing", "drawing", "listening to music", "writing", "indoor activities");

	return $select_list[$option];
}

function jmcBlock($name){

	$arr = "";

	$arr['courses'] = array(
				array(	
					"label" => "Name",
					"text" => "Course name",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
				array(
					"label" => "City",
					"text" => "Course City",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
				array(
					"label" => "Province/Country",
					"text" => "Course Province",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
				array(
					"label" => "Start Date",
					"text" => "Course Start Date ",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>false,
				),
				array(
					"label" => "End Date",
					"text" => "Course End Date ",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>false,
				),
				array(
					"label" => "Website",
					"text" => "Course Website",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
				array(
					"label" => "Course Comments",
					"text" => "Course Comments",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
			);

	$arr['experiences'] = array(
				array(
					"label" => "Company Name",
					"text" => "Company Name",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Company Field",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['company_field'],
					"data" => job_manager_select("company_field"),
					//"require"=>true,
					"require"=>false,
				),
				array(
					"label" => "Other Company Field",
					"text" => "Other Company Field",
					"type" => "input-text",
					"class"=> "validate",
					"tooltip" => "Sino figura el rubro de tu empresa, por favor agregar aca.",
					"require"=>false,
				),
				array(
					"label" => "Position",
					"text" => "Position",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['position'],
					"data" => job_manager_select('position'),
					"tooltip" => "Sino figura el puesto de trabajo, por favor agregar aca.",
					"require"=>true,
				),
				array(
					"label" => "Other Position",
					"text" => "Other Position",
					"type" => "input-text",
					"class"=> "validate",
					"tooltip" => "Si tu puesto de trabajo no esta en el listado de la derecha, por favor agregarla aca.",
					"require"=>false,
				),				
				array(
					"text" => "Location",
					"type" => "title",
				),
				array(
					"text" => "Street and number",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "City",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Country",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['country'],
					"data" => job_manager_select('country'),
					"require"=>true,
				),
				array(
					"label" => "Phone number/email address",
					"text" => "phone email",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Website",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
				array(
					"text" => "Duration from",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
				),
				array(
					"text" => "Duration to",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
				),
				array(
					"text" => "Reference Contact Person",
					"type" => "title",
				),
				array(
					"text" => "Reference Full Name",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Reference Contact person position",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['contact_person_position'],
					"data" => job_manager_select('contact_person_position'),
					"require"=>true,
				),
				array(
					"label" => "Reference contact phone number/email address",
					"text" => "Reference contact email",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Comments",
					"label"=> "Jobs Comments",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>false,
				),
			);
		
		$results = "";

		if($arr[$name]){
			$results = $arr[$name];
		}

		return $results;
}

function job_manager_custom_fields(){
	$options = array(
		array(
			"title" => "Courses",
			"show" => false,
			"fields" => jmcBlock("courses")
		),
		array(
			"title" => "Experiences",
			"show" => false,
			"fields" => jmcBlock("experiences")
		),
		array(
			"title" => "Skills",
			"show" => false,
			"fields" => jmcBlock("skills")
		),

		array(
			"title" => "Profile",
			"fields" => array(
				array(
					"text" => "Full name",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
					"tooltip"=>"Requiere solo letras de A-Z"
				),
				array(
					"text" => "Street and number",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
					"tooltip"=>"Requiere solo letras de A-Z"
				),
				array(
					"text" => "City",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
					"tooltip"=>"Requiere solo letras de A-Z"
				),
				array(
					"text" => "Country",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['country'],
					"require"=>true,
					"data" => job_manager_select('country'),
				),
				array(
					"label" => "Other Country",
					"text" => "Other Country",
					"type" => "input-text",
					"class"=> "validate",
					"tooltip" => "Sino figura tu país, por favor agregar aca.",
					"require"=>false,
				),
				array(
					"text" => "Zip Code",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				/*
				array(
					"text" => "House Phone Number",
					"type" => "input-text",
					"class"=> "validate",
				),
				array(
					"text" => "Cell Phone Number",
					"type" => "input-text",
					"class"=> "validate",
				),
				*/
				array(
					"text" => "Birth date",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
				),
				array(
					"text" => "Country of Citizenship",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"text" => "Country of Residence",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				/*
				array(
					"text" => "Passport Number",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				*/
				array(
					"text" => "Available Date to Start work in USA",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
					"highlight_text"=>true,
				),

				array(
					"text" => "Available Date to Finish work in USA",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
					"highlight_text"=>true,
				),

				)
		),

		array(
			"title" => "Education",
			"fields"=> array(
				array(
					"text" => "University",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['university'],
					"data" => job_manager_select('university'),
					//"require"=>true,
					"require"=>false,
				),
				array(
					"label" => "Other",
					"text" => "Other University",
					"type" => "input-text",
					"class"=> "validate",
					"tooltip" => "Si tu universidad no esta en el listado de la izquierda, por favor agregarla aca.",
					"require"=>false,
				),
				array(
					"label" => "Province",
					"text" => "Institution Province",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"label" => "Country",
					"text" => "Institution Country",
					"type" => "select",
					"class"=> "validate",
//					"data" => $select_list['country'],
					"data" => job_manager_select('country'),
					"require"=>true,
				),
				array(
					"label" => "Website",
					"text" => "Institution Website",
					"type" => "input-text",
					"class"=> "validate",
					"require"=>true,
				),
				array(
					"label" => "Start Date (Date you started your first year of career)",
					"text" => "Institution Start Date",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
				),
				array(
					"label" => "Graduation Expected Date",
					"text" => "Institution Graduation Expected Date",
					"type" => "input-text",
					"class"=> "validate",
					"input_class" => "datepicker",
					"require"=>true,
				),
				array(
					"label" => "Field of study",
					"text" => "Institution Field of Study",
					"type" => "select",
					"class"=> "validate",
//					"data"=> $select_list["fields_of_study"],
					"data" => job_manager_select('fields_of_study'),
					"tooltip" => "Si tu carrera no esta en el listado de la izquierda, por favor agregarla aca.",
					//"require"=>true,
					"require"=>false,
				),
				array(
					"label" => "Other Field of Study",
					"text" => "Institution Other Field Of Study",
					"type" => "input-text",
					"class"=> "validate",
					"tooltip" => "Sino figura tu campo de estudio, por favor agregar aca.",
					"require"=>false,
				),
				array(
					"label" => "Courses/Seminars/Exchange Programs",
					"text" => "Courses",
					"type" => "addCourse",
					"class"=> "validate",
				),
			),
		),

		array(
			"title" => "Experience",
			"fields"=> array(
				array(
					"label" => "Experiences",
					"text" => "Experiences",
					"type" => "addExperience",
					"class"=> "validate",
				),
			)
		),
		/*
		array(
			"title" => "Skills and Languages",
			"fields"=> array(
				array(
					"label" => "Skills",
					"text" => "Skills",
					"type" => "addSkill",
					"class"=> "validate",
				),
			)
		),
		*/
		array(
			"title" => "Skills and Languages",
			"fields"=> array(
				array(
					"label" => "Languages",
					"text" => "skills Languages",
					"type" => "select",
					"attr"=> "multiple",
					"class"=> "validate",
					//"data" => $select_list['languages'],
					"data" => job_manager_select('languages'),
					"require"=>true,
					//"require"=>false,
				),
				array(
					"label" => "Choose your English Level",
					"text" => "skills Languages levels",
					"type" => "select",
					"class"=> "validate",
					//"data" => $select_list['languages'],
					"data" => job_manager_select('languages_levels'),
					"require"=>true,
					//"require"=>false,
				),
				array(
					"label" => "Computer",
					"text" => "skills Computer",
					"type" => "select",
					"class"=> "validate",
					"attr"=> "multiple",
					"data" => job_manager_select('programs'),
					"require"=>true,
				),
				/*
				array(
					"label" => "Computerx",
					"text" => "skills Computerx",
					"type" => "select",
					"class"=> "validate",
					"attr"=> "multiple",
					"data" => job_manager_select('programs'),
					"require"=>true,
				),
				*/
				array(
					"text" => "Snow Sports",
					"type" => "checkbox",
					"class"=> "validate",
					"hide_show" =>"skiing",
					"require"=>false,
				),
					array(
						"text" => "Ski Level",
						"type" => "select",
						"class"=> "validate",
						"hide_show_item" =>"skiing",
						"show" => false,					
						"data" => job_manager_select('snow_levels'),
					),
					array(
						"text" => "ski certified",
						"label" => "Are you Certified?",
						"type" => "checkbox",
						"class"=> "validate",
						"hide_show_item" =>"skiing",
						"show" => false,					
					),
					array(
						"text" => "ski competed",
						"label" => "Have you ever competed?",
						"type" => "checkbox",
						"class"=> "validate",
						//"class"=> "hide_show_item_snow validate",
						"hide_show_item" =>"skiing",
						"show" => false,					
					),
					array(
						"text" => "ski quantity of seasons skied",
						"label" => "Quantity of seasons",
						"type" => "select",
						"class"=> "validate",
						"hide_show_item" =>"skiing",
						"show" => false,					
						"data" => job_manager_select('quantity_of_seasons_skied'),
					),
					array(
						"text" => "ski countries skied",
						"label" => "Countries where you have skied",
						"type" => "select",
						"attr"=> "multiple",
						"class"=> "validate",
						"hide_show_item" =>"skiing",
						"show" => false,					
						"data" => job_manager_select('countries_ski'),
					),
					array(
						"text" => "ski otros country",
						"label" => "Other Country",
						"type" => "input-text",
						"class"=> "validate",
						"hide_show_item" =>"skiing",
						"tooltip" => "Sino figura el país, por favor agregar aca.",
						"require"=>false,
					),
					
				array(
					"text" => "Snowboarding",
					"type" => "checkbox",
					"class"=> "validate",
					"hide_show" =>"hide_show_item_snow",
				),
					array(
						"text" => "Snowboarding Level",
						"label" => "Level",
						"type" => "select",
						"class"=> "hide_show_item_snow validate",
						"data" => job_manager_select('snow_levels'),
						"show" => false,					
					),
					array(
						"text" => "snow certified",
						"label" => "Are you Certified?",
						"type" => "checkbox",
						"class"=> "hide_show_item_snow validate",
						"show" => false,					
					),
					array(
						"text" => "snow competed",
						"label" => "Have you ever competed?",
						"type" => "checkbox",
						"class"=> "hide_show_item_snow validate",
						//"hide_show_item" =>"skiing",
						"show" => false,					
					),
					array(
						"text" => "snow quantity of seasons skied",
						"label" => "Quantity of seasons",
						"type" => "select",
						"class"=> "hide_show_item_snow validate",
						"data" => job_manager_select('quantity_of_seasons_skied'),
						"show" => false,					
					),
					array(
						"text" => "snow countries snowboarded",
						"label" => "Countries where you have snowboarded",
						"type" => "select",
						"class"=> "hide_show_item_snow validate",
						"attr"=> "multiple",
						"data" => job_manager_select('countries_ski'),
						"show" => false,					
					),

					array(
						"text" => "Other Sports",
						"label" => "MENTION OTHER SPORTS YOU PRACTISE",
						"type" => "select",
						"class"=> "validate",
						"attr"=> "multiple",
						//"data" => $select_list['country'],
						"data" => job_manager_select('other_sports'),
					),
		
			)
		),
		/*
		array(
			"title" => "Special Awards/Honors/Certifications",
			"fields"=> array(
				array(
					"text" => "sports awards",
					"label" => "Do you have any sports awards?",
					"type" => "checkbox",
					"class"=> "validate",
				),
				array(
					"text" => "specify sport",
					"label" => "specify sport",
					"type" => "input-text",
					"class"=> "validate",
				),
				array(
					"text" => "specify date",
					"label" => "specify date",
					"type" => "input-text",
					"class"=> "validate date",
				),
			)
		),
		*/
		array(
			"title" => "International Language Exams",
			"fields"=> array(
				array(
					"text" => "language-certification",
					"label" => "Do you have any Language Certifications?:",
					"type" => "checkbox",
					"class"=> "validate",
					"hide_show" => "exams",
				),
					array(
						"label" => "International Exams",
						"text" => "International Exams",
						"type" => "select",
						"attr" => "multiple",
						"class"=> "validate select_international_exams",
						"hide_show_item" => "exams",
						"show"=> false,
						"data" => job_manager_select('international_exams'),
					),
					array(
						"label" => "Other International Exam",
						"text" => "Other International Exam",
						"type" => "input-text",
						"class"=> "validate",
						"tooltip" => "Sino figura tu examen, por favor agregar aca.",
						"hide_show_item" => "exams",
						"show"=> false,
					),


			)
		),

		array(
			"title" => "Travel",
			"fields"=> array(
				array(
					"label" => "Places you have visited",
					"text" => "countries visited",
					"type" => "select",
					"attr" => "multiple",
					"class"=> "validate",
					"data" => job_manager_select('travel_country'),
				),

			)
		),

		array(
			"title" => "Activities and Interests",
			"fields"=> array(
				array(
					"label" => "Activities and Interests",
					"text" => "Activities and Interests",
					"type" => "select",
					"class"=> "validate",
					"attr"=>"multiple",
					"data" => job_manager_select('activities_and_interests'),
				),

			)
		)
);

	return $options;

}
?>
