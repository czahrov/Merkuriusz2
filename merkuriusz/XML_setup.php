<?php
require_once __DIR__ . "/php/cfg.php";

$SHOP  = array();

$SHOP['easygifts'] = new EASYGIFTS( array(
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
) );


/* $SHOP['asgard'] = new ASGARD( array(
	'products' => 'http://www.asgard.pl/www/xml/oferta.xml',
),
array(
	'shop' => 'ASGARD',
) ); */


/* $SHOP['macma'] = new MACMA( array(
	'products' => 'http://www.macma.pl/data/webapi/pl/xml/offer.xml',
	'stock' => 'http://www.macma.pl/data/webapi/pl/xml/stocks.xml',
	'prices' => 'http://www.macma.pl/data/webapi/pl/xml/prices.xml',
	
),
array(
	'shop' => 'MACMA',
	
) ); */

/* $SHOP['inspirion'] = new INSPIRION( array(
	'products' => 'https://inspirion.pl/sites/default/files/exports/products.xml',
),
array(
	'shop' => 'INSPIRION',
) ); */

/* $SHOP['anda'] = new ANDA( array(),
array(
	'shop' => 'ANDA',
) ); */

/* $SHOP['axpol'] = new AXPOL( array(
	'products' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_product_data_PL.xml',
	'stock' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_stocklist_pl.xml',
	'marking' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_print_data_PL.xml',
),
array(
	'shop' => 'AXPOL',
) ); */

/* $SHOP['par'] = new PAR( array(
	'products' => 'http://biuro@bagsport.pl:24816vvv@www.par.com.pl/api/products',
	'stock' => 'http://biuro@bagsport.pl:24816vvv@www.par.com.pl/api/stocks',
),
array(
	'shop' => 'PAR',
) ); */


$XM = new XMLMan();
foreach( $SHOP as $item ){
	$XM->addSupport( $item );
	
}

