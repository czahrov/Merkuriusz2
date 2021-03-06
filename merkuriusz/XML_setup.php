<?php
require_once __DIR__ . "/php/cfg.php";

$SHOP  = array();

/* ~10s */
$SHOP['asgard'] = new ASGARD( array(
	'products' => 'http://www.asgard.pl/www/xml/oferta.xml',
),
array(
	'shop' => 'ASGARD',
) );

/* ~20s */
$SHOP['inspirion'] = new INSPIRION( array(
	'products' => 'http://inspirion.pl/sites/default/files/exports/products.xml',
),
array(
	'shop' => 'INSPIRION',
) );

/* ~30s */
$SHOP['macma'] = new MACMA( array(
	'products' => 'http://www.macma.pl/data/webapi/pl/xml/offer.xml',
	'stock' => 'http://www.macma.pl/data/webapi/pl/xml/stocks.xml',
	'prices' => 'http://www.macma.pl/data/webapi/pl/xml/prices.xml',
),
array(
	'shop' => 'MACMA',
) );

/* ~40s */
$SHOP['jaguargift'] = new JAGUARGIFT( array(
 	'products' => '',
),
array(
	'shop' => 'JAGUARGIFT',
) );

/* ~80s */
$SHOP['easygifts'] = new EASYGIFTS( array(
	'products' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/offer.xml',
	'stock' => 'http://www.easygifts.com.pl/data/webapi/pl/xml/stocks.xml',
),
array(
	'shop' => 'EASYGIFTS',
) );

/* ~20-100s */
$SHOP['par'] = new PAR( array(
	'products' => 'http://biuro@merkuriusz.pl@merkuriusz345@www.par.com.pl/api/products',
	'stock' => 'http://biuro@merkuriusz.pl@merkuriusz345@www.par.com.pl/api/stocks',
),
array(
	'shop' => 'PAR',
) );

/* ~80s */
$SHOP['axpol'] = new AXPOL( array(
	'products' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_product_data_PL.xml',
	'stock' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_stocklist_pl.xml',
	'print' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_print_data_PL.xml',
),
array(
	'shop' => 'AXPOL',
) );

/* ~40s */
$SHOP['anda'] = new ANDA( array(
	/* 'products' => 'https://xml.andapresent.com/export/products/pl/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'stock' => 'https://xml.andapresent.com/export/inventories/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'marking' => 'https://xml.andapresent.com/export/labeling/en/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'price' => 'https://xml.andapresent.com/export/prices/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP', */
),
array(
	'shop' => 'ANDA',
) );

/* ~260s */
$SHOP['falkross'] = new FALKROSS( array(
	'products' => 'http://download.falk-ross.eu/download/article/falkross-articles.xml',
	'stock' => 'https://stockinfo_germany:RK89F3S77@ws.falk-ross.eu/webservice/R01_000/stockinfo/falkross_de.csv',
),
array(
	'shop' => 'FALKROSS',
) );

$XM = new XMLMan();
foreach( $SHOP as $item ){
	$XM->addSupport( $item );
	
}

