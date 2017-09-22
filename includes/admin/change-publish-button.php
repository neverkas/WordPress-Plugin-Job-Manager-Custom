<?php
function change_publish_button( $translation, $text ) {
    if ( 'jmc' == get_post_type()){
        if ( $text == 'Submit for Review' ){
            return 'SAVE AND REVIEW';
        }

    }
        return $translation;
}

?>