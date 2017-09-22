<?php
function disable_random_password( $password ) {
    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';
    if ( 'wp-login.php' === $GLOBALS['pagenow'] && ( 'rp' == $action  || 'resetpass' == $action ) ) {
        return '';
    }
    return $password;
}

?>