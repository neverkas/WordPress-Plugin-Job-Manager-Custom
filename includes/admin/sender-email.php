<?php
/*
* Probar nueva funcionalidad - (No se pudo probar array_unique(array))
*/
function wpb_sender_email( $original_email_address ) {
    return 'no-reply-resume@globalwat.org';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Globalwat - Resume-noreply';
}

?>