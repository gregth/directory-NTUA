<?php
  header( "Content-Type: text/html; charset=iso-8859-7" );

  $file = fopen( "list.php", w );
  fwrite( $file, "<table>" );

  $id = 14001;
  $base = "http://www.ntua.gr/directory.html?group=ALL&dept=ALL&q=el";
  $entries = 0;

  while ( $id < 15000 ) {
    $url = $base . $id;
    $page = file_get_contents( $url );
    $matches;
    preg_match_all( '/<b>([^A-Za-z]*)<\/b>/si', $page, $matches );
    $name = $matches[ 1 ][ 2 ];
    $counter = count( $matches[ 0 ] );
    if ( $counter == 3 ) {
      //Found name, student exists.
      $row = "<tr><td>031$id</td><td>$name</td></tr>\n";
      fwrite( $file, $row );
      $entries++;
    }
    $id++;
  }

  fwrite( $file, "</table><h2>Found $entries entries.</h2>" );
  fclose( $file );
  print "Ready.";

?>
