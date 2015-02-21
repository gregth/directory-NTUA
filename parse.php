<?php
  header('Content-type: text/plain; charset=utf-8');
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  $base = "http://www.ntua.gr/directory.html?group=ALL&dept=ALL&q=";
  $school = $_POST[ "school" ];
  $file = fopen( "$school.json", "w" );
  $entries = 0;
  $lists;

  for ( $year = 12; $year <= 14; $year++ ) {
    $id = $year * 1000 + 1;
    //TODO
    while ( $id <= ( $year + 1 ) * 1000 ) {
      $url = $base . $school . $id;
      $page = file_get_contents( $url );
      preg_match_all( '/<b>([^A-Za-z]*)<\/b>/si', $page, $matches );
      $matches;
      $counter = count( $matches[ 0 ] );
      if ( $counter == 3 ) {
        //Found name, student exists.
        $name = iconv( "ISO-8859-7", "UTF-8", $matches[ 1 ][ 2 ] );
        $student = [ "id" => $id, "name" => $name ];
        $lists[ $year ][ ] = $student;
        $entries++;
      }
      $id++;
    }
  }
  print_r( $lists );
  fwrite( $file, json_encode( $lists ) );
  fclose( $file );
  echo "Ready.";
?>
