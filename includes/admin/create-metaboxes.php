<?php
function r_create_metaboxes(){
	add_meta_box(
		'r_job_manager_custom_options',
		'Job Manager Custom',
//		__('JMC Options', 'job-manager-custom'),
		'r_job_manager_custom_options',
		'jmc', // Job Manager Custom
		'normal',
		'high'
	);
}
?>