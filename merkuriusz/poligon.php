<?php
/* template name: poligon */

// print_r( $_SERVER );
// print_r( ini_get_all() );

$XML = simplexml_load_file( __DIR__ . "/php/JAGUARGIFT/DND/jaguargift.xml" );
print_r( $XML->children()[0] );

