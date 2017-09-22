<?php
function capabilities_by_roles() {
/*
	// comentado porque sino tira error de permisos
	// habilitar cuando sea necesario 

	remove_role('jmc_student');
	remove_role('jmc_empleador');
	add_role('jmc_student', 'JMC Estudiante');
	add_role('jmc_empleador', 'JMC Empleador');

	update_option('default_role','jmc_student');
*/
// ISN'T WORK
	/*
	 add_role('jmc_student', 'JMC Estudiante', array (
	'read' => true,
	 'edit_jmcs' => true,
	 'edit_others_jmcs' => true,
	 'edit_jmc' => true,
	 'read_jmc' => true,
	 'manage_jmcs' => true,
	 'publish_jmcs' => false,
	 'delete_jmcs' => false,
	 'delete_others_jmcs' => false,
	 'read_private_jmcs' => false,
	 'delete_jmc' => false,
	 'edit_others_jmcs' => false,
	 // more standard capabilities here
//	'upload_files'=>true,
	));

	 add_role('jmc_empleador', 'JMC Empleador', array (
	 'publish_jmcs' => false,
	 'edit_jmcs' => true,
	 'edit_others_jmcs' => true,
	 'delete_jmcs' => false,
	 'delete_others_jmcs' => false,
	 'read_private_jmcs' => false,
	 'edit_jmc' => true,
	 'delete_jmc' => false,
	 'read_jmc' => true,
	 'manage_jmcs' => true,
	 'edit_others_jmcs' => true,
	 // more standard capabilities here
	'read' => true,
//	'upload_files'=>true,
	));
	*/
	
	

	global $wp_roles;

	if ( isset($wp_roles) ) {
//		$administrator = get_role( 'administrator' );
	    $caps_admin = array(
	    	'read',	'edit_jmc', 'read_jmc', 'delete_jmc',
	    	'manage_jmcs', 'create_jmcs', 'edit_jmcs', 'delete_jmcs',
	    	'edit_others_jmcs','delete_others_jmcs',
	    	'publish_jmcs',	    	
	    	'edit_published_jmcs', 'delete_published_jmcs',
	    	'read_private_jmcs','edit_private_jmcs', 'delete_private_jmcs',
	    );

 		foreach ( $caps_admin as $cap ) {
 			//$wp_roles->add_cap('administrator', $cap);
   		}

	    $roles_admin = array(
	    	'read' => true,	'edit_jmc' => true, 'read_jmc' => true, 'delete_jmc' => true,
	    	'manage_jmcs' => true, 'create_jmcs' => true, 'edit_jmcs' => true, 'delete_jmcs' => true,
	    	'edit_others_jmcs' => true,'delete_others_jmcs' => true,
	    	'publish_jmcs' => true,	    	
	    	'edit_published_jmcs' => true, 'delete_published_jmcs' => true,
	    	'read_private_jmcs' => true,'edit_private_jmcs' => true, 'delete_private_jmcs' => true,
	    );
		
		add_role('administrator', 'administrator', $roles_admin);
/*
		// comentado porque sino tira error de permisos
		// habilitar cuando sea necesario 
 		foreach ( $caps_admin as $cap ) {
 			$wp_roles->add_cap('administrator', $cap);
 			$wp_roles->remove_cap('jmc_student', $cap);
 			$wp_roles->remove_cap('jmc_empleador', $cap);
 			//$wp_roles->remove_cap('administrator', $cap);	        
   		}
*/
	    $roles_student = array(
	    	'read' => true, 'edit_jmc' => true, 'read_jmc' => true,
	    	'manage_jmcs' => true, 'create_jmcs' => true, 'edit_jmcs' => true,
	    	'publish_jmcs' => true, // se agregó por el error 'You don't have enough permissions'
	    );
		
		add_role('jmc_student', 'JMC Estudiante', $roles_student);

	    $caps_student = array(
	    	'read', 'edit_jmc', 'read_jmc',
	    	'manage_jmcs', 'create_jmcs', 'edit_jmcs',
	    	'publish_jmcs', // se agregó por el error 'You don't hav Role Editore enough permissions'
	    );
 		
 		foreach ( $caps_student as $cap ) {
			$wp_roles->add_cap('jmc_student', $cap);
   		}

	    $roles_empleador = array(
	    	'read' => true,'edit_jmc' => false, 'read_jmc' => true, 'create_jmcs' => false,
	    	'manage_jmcs' => true, 'edit_jmcs' => false,
	    	'edit_others_jmcs' => false
	    );
		
		add_role('jmc_empleador', 'JMC Empleador', $roles_empleador);

	    $caps_empleador = array(
	    	'read', 'edit_jmc', 'read_jmc',
	    	'create_jmcs',
	    	//'manage_jmcs',
	    	'edit_jmcs',
	    	'edit_others_jmcs'
	    );
 		
 //		foreach ( $caps_admin as $cap ) {
// 		$wp_roles->remove_cap('jmc_empleador', $cap);
		foreach ( $caps_empleador as $cap ) {
	 		//$wp_roles->remove_cap('jmc_empleador', $cap);
 			$wp_roles->add_cap('jmc_empleador', $cap);
   		}
	}
}
?>