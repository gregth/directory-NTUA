<?php
  header('Content-Type: text/html; charset=utf-8');
  if ( empty( $_POST[ "school" ] ) ) {
   print "Error. Try again.";
  }
  else {
    $school = $_POST[ "school" ];
    $file = file_get_contents( "data/$school.json" );
    $list = json_decode( $file, true );
    print '<h1>Results for school with id: ' . $school . '</h1>';
    foreach( $list as $year => $sublist ) {
      $counter = 0;
      print "<h2>Year:". ( 2000 + $year ) . "</h2>";
      print "<table><tbody>";
      foreach( $sublist as $student ) {
        print "<tr><td>". $student[ "id" ].'</td><td>' . $student[ "name"] . '</td></tr>';
        $counter++;
      }
      print "</tbody></table>";
      print "Entries: $counter";
    }
  }
?>
