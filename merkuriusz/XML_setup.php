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


$SHOP['falkross'] = new FALKROSS( array(
	'products' => 'http://download.falk-ross.eu/download/article/falkross-articles.xml',
),
array(
	'shop' => 'FALKROSS',
) );


$XM = new XMLMan();
foreach( $SHOP as $item ){
	$XM->addSupport( $item );
	
}

