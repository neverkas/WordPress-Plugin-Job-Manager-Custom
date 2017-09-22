<?php
function list_posts_by_author( $query ) {

  // solo para la administración y el query principal
  
  // sino tiene el role de administrador entonces...
  if(!current_user_can('administrator') && is_admin() && $query->is_main_query() ) {

    // Obtenemos la inforamción sobre la pantalla actual
    // y el post type solicitado
    $current_screen = get_current_screen();
    $post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

    // Comprobamos que la pantalla sea la de edición de posts
    // y si el usuario actual puede editar los posts de otros autores
    // Nota: get_current_screen() y get_post_type_object() pueden devolver null
//      $query->set( 'author', get_current_user_id() );

    if(
        ( ! is_null( $current_screen ) && $current_screen->base == 'edit' )
        && 
        ( ! is_null( $post_type_object ) && !current_user_can( $post_type_object->cap->edit_others_posts ) )
//        ( ! is_null( $post_type_object ) && ! current_user_can( $post_type_object->cap->edit_others_posts ) )
//        ( ! is_null( $post_type_object ) )
    ) {

      // Establecer el parámetro "author" igual al usuario actual
      echo "
      <script>
//      alert('".$post_type_object->cap->edit_others_posts."');
      </script>
      ";

      $query->set( 'author', get_current_user_id() );

    }

  }
}

?>