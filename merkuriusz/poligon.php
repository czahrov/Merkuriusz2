<?php
/* template name: poligon */

// print_r( $_SERVER );
// print_r( ini_get_all() );

// $XML = simplexml_load_file( __DIR__ . "/php/EASYGIFTS/DND/offer.xml" );
// print_r( $XML->children()[0] );
$xml_read = file_get_contents( __DIR__ . "/php/EASYGIFTS/DND/offer.xml" );
$xml_read = str_replace( "&", "&amp;", $xml_read );
$XML = simplexml_load_string( $xml_read );
foreach( $XML->children() as $item ){
	if( 
		(int)$item->baseinfo->price == 0 and 
		(int)$item->baseinfo->price_sellout == 0 and
		(int)$item->additional_offer = 1
	){
		print_r( $item );
		break;
	}
	
}

