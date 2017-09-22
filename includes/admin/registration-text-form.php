<?php
function wpse_161709( $errors, $redirect_to )
{
   if( isset( $errors->errors['registered'] ) )
   {
     // Use the magic __get method to retrieve the errors array:
     $tmp = $errors->errors;   

     // What text to modify:
     $old = 'Registration complete. Please check your email.';
     $new = 'Por favor revisa tu mail y SPAM antes de completar los campos de abajo (el mail puede tardar unos minutos)';

     // Loop through the errors messages and modify the corresponding message:
     foreach( $tmp['registered'] as $index => $msg )
     {
       if( $msg === $old )
           $tmp['registered'][$index] = $new;        
     }
     // Use the magic __set method to override the errors property:
     $errors->errors = $tmp;

     // Cleanup:
     unset( $tmp );
   }  
   return $errors;
}
?>