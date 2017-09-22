<?php
function custom_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/images/logo.jpg') no-repeat scroll center  bottom / 245px auto;
		height: 273px;
		width: 337px;
	}
	</style>
	";
}
?>