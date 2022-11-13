<?php
if ( isset( $_POST ['submit'] ) && isset( $_POST ['letter'] ) ) {
  require_once 'Json.class.php';
  $json = new Json();
  $front = [];
  $back = [];

  foreach ( $_POST as $key => $input ) {
    if ( $key != 'submit' && $key != 'letter' ) {
      $prefix = '';

      preg_match( '/\.jpg|\.png|\.jpeg|\.gif|\.pjp/', $input ) 
      && !preg_match( '/img\//', $input ) 
        ? $prefix = 'img/'
        : $prefix = '';

      explode( '-', $key ) [0] === 'front' 
        ? array_push( $front, $prefix . $input ) 
        : array_push( $back, $prefix . $input );}
  }

  $json -> update ( $_POST ['letter'], $front, $back );

  header("Location: http://localhost/Arabic-Alphabet/php/main.php");
}