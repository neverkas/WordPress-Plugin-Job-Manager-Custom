<?php
function filter_jmc_content($content){
	if(!is_singular('jmc')){
		return $content;
	}

	//$html = wp_remote_fopen("jmc-template.php");
	//$result = file_get_contents('http://example.com/submit.php', false, $context);
	//$html = file_get_contents('jmc-template.php', true, $context);

	return $content . $html;

}
?>