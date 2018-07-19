<?php
require_once __DIR__ . "/php/cfg.php";

$SHOP  = array();

/* $SHOP['easygifts'] = new EASYGIFTS( array(
	'products' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/offer.xml',
	'stock' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/stocks.xml',
),
array(
	'shop' => 'EASYGIFTS',
) );


$SHOP['jaguargift'] = new JAGUARGIFT( array(
	'products' => '',
),
array(
	'shop' => 'JAGUARGIFT',
) ); */


/* $SHOP['falkross'] = new FALKROSS( array(
	'products' => 'http://download.falk-ross.eu/download/article/falkross-articles.xml',
),
array(
	'shop' => 'FALKROSS',
) ); */


$SHOP['anda'] = new ANDA( array(
	'products' =>  'http://andapresent.hu/admin/system/anda_xml_export2.php?&orszag_id=6&nyelv_id=7&password=92ba3632c8c22ebd65fbce872b317875',
),
array(
	'shop' => 'ANDA',
) );


$XM = new XMLMan();
foreach( $SHOP as $item ){
	$XM->addSupport( $item );
	
}

