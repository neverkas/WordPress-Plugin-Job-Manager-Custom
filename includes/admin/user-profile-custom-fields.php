<?php 
function crf_show_extra_profile_fields( $user ) {

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
?>
	<h3><?php esc_html_e( '(*) Personal Information (Required)', 'crf' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="employer_name"><?php esc_html_e( "Employer's name", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="employer_name" name="employer_name" value="<?php echo esc_attr( $employer_name ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="person_to_contact"><?php esc_html_e( "Person to contact", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="person_to_contact" name="person_to_contact" value="<?php echo esc_attr( $person_to_contact ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="email_address"><?php esc_html_e( "Email Address", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="email_address" name="email_address" value="<?php echo esc_attr( $email_address ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="phisical_address"><?php esc_html_e( "Phisical Address", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="phisical_address" name="phisical_address" value="<?php echo esc_attr( $phisical_address ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="ein"><?php esc_html_e( "Ein", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="ein" name="ein" value="<?php echo esc_attr( $ein ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="ph_number"><?php esc_html_e( "Ph Number", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="ph_number" name="ph_number" value="<?php echo esc_attr( $ph_number ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="cell_phone"><?php esc_html_e( "Cell phone", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="cell_phone" name="cell_phone" value="<?php echo esc_attr( $cell_phone ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="website"><?php esc_html_e( "Web Site", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="website" name="website" value="<?php echo esc_attr( $website ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="date"><?php esc_html_e( "Date", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="date" name="date" value="<?php echo esc_attr( $date ); ?>" class="regular-text"
				/>
			</td>
		</tr>

		<tr>
			<th><label for="company_name"><?php esc_html_e( "Company name", 'crf' ); ?></label></th>
			<td>
				<input type="text" id="company_name" name="company_name" value="<?php echo esc_attr( $company_name ); ?>" class="regular-text"
				/>
			</td>
		</tr>
	</table>
<?php } ?>