<?php

class Json {
  private $jsonFile = '../api.json';

  public function getRows() {
    if ( file_exists( $this -> $jsonFile ) ) {
      $jsonData = file_get_contents( $this -> $jsonFile );
      $data     = json_decode( $jsonData, true );

      if ( !empty( $data ) ) {
        usort( $data, function( $a, $b ) {
          return strtotime( $b['id'] ) - strtotime( $a['id'] );
        });
      }

      return !empty( $data ) ? $data : false;
    }
    return false;
  }

  public function getSinle( $letter ) {
    $jsonData = file_get_contents( $this -> jsonFile );
    $data     = json_decode( $jsonData, true );

    @$singleData = $data [$letter];

    return !empty( $singleData ) ? $singleData : false;
  }

  public function update( $letter, $frontArr, $backArr ) {
      $jsonData = file_get_contents( '../api.json' );
      $data = json_decode( $jsonData, true );

      $data [$letter] ['front'] = $frontArr;
      $data [$letter] ['back']  = $backArr;
      
      $encoded_data = json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
      file_put_contents( '../api.json', $encoded_data );
  }
}