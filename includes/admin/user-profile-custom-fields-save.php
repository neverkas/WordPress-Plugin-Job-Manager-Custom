<?php
$employer_name = get_the_author_meta( 'employer_name', $user->ID );
$person_to_contact = get_the_author_meta( 'person_to_contact', $user->ID );
$email_address = get_the_author_meta( 'email_address', $user->ID );
$phisical_address = get_the_author_meta( 'phisical_address', $user->ID );
$ein = get_the_author_meta( 'ein', $user->ID );
$ph_number = get_the_author_meta( 'ph_number', $user->ID );
$cell_phone = get_the_author_meta( 'cell_phone', $user->ID );
$website = get_the_author_meta( 'website', $user->ID );
$date = get_the_author_meta( 'date', $user->ID );
$company_name = get_the_author_meta( 'company_name', $user->ID );

function crf_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( ! empty( $_POST['employer_name'] ) ) {
		update_user_meta( $user_id, 'employer_name', $_POST['employer_name'] );
	}

	if ( ! empty( $_POST['person_to_contact'] ) ) {
		update_user_meta( $user_id, 'person_to_contact', $_POST['person_to_contact'] );
	}

	if ( ! empty( $_POST['email_address'] ) ) {
		update_user_meta( $user_id, 'email_address', $_POST['email_address'] );
	}

	if ( ! empty( $_POST['phisical_address'] ) ) {
		update_user_meta( $user_id, 'phisical_address', $_POST['phisical_address'] );
	}

	if ( ! empty( $_POST['ein'] ) ) {
		update_user_meta( $user_id, 'ein', $_POST['ein'] );
	}

	if ( ! empty( $_POST['ph_number'] ) ) {
		update_user_meta( $user_id, 'ph_number', $_POST['ph_number'] );
	}

	if ( ! empty( $_POST['cell_phone'] ) ) {
		update_user_meta( $user_id, 'cell_phone', $_POST['cell_phone'] );
	}

	if ( ! empty( $_POST['website'] ) ) {
		update_user_meta( $user_id, 'website', $_POST['website'] );
	}

	if ( ! empty( $_POST['date'] ) ) {
		update_user_meta( $user_id, 'date', $_POST['date'] );
	}

	if ( ! empty( $_POST['company_name'] ) ) {
		update_user_meta( $user_id, 'company_name', $_POST['company_name'] );
	}


}
?>