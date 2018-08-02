<?php
require_once __DIR__ . "/php/cfg.php";

$SHOP  = array();

/* ~40s */
$SHOP['easygifts'] = new EASYGIFTS( array(
	'products' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/offer.xml',
	'stock' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/stocks.xml',
),
array(
	'shop' => 'EASYGIFTS',
) );

/* ~30s */
$SHOP['jaguargift'] = new JAGUARGIFT( array(
 	'products' => '',
),
array(
	'shop' => 'JAGUARGIFT',
) );

/* ~260s */
/* $SHOP['falkross'] = new FALKROSS( array(
	'products' => 'http://download.falk-ross.eu/download/article/falkross-articles.xml',
),
array(
	'shop' => 'FALKROSS',
) ); */


/* $SHOP['anda'] = new ANDA( array(
	'products' =>  'http://andapresent.hu/admin/system/anda_xml_export2.php?&orszag_id=6&nyelv_id=7&password=92ba3632c8c22ebd65fbce872b317875',
),
array(
	'shop' => 'ANDA',
) ); */

// Problem z kategoriami w XML
/* $SHOP['axpol'] = new AXPOL( array(
	'products' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_product_data_PL.xml',
	'stock' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_stocklist_pl.xml',
	'print' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_print_data_PL.xml',
),
array(
	'shop' => 'AXPOL',
) ); */

/* $SHOP['asgard'] = new ASGARD( array(
	'products' => 'http://www.asgard.pl/www/xml/oferta.xml',
),
array(
	'shop' => 'ASGARD',
) ); */


$XM = new XMLMan();
foreach( $SHOP as $item ){
	$XM->addSupport( $item );
	
}

