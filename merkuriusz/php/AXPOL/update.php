<?php
$name = 'AXPOL';

set_time_limit( 1800 );
require_once __DIR__ . "/../../php/cfg.php";
require_once __DIR__ . "/../XMLAbstract.php";
require_once __DIR__ . "/{$name}.php";

$dt = date('Y-m-d H:i:s');

printf(
	'%1$s--- UPDATE %3$s [%2$s] ---%1$s',
	PHP_EOL,
	$dt,
	$name
);

$shop = new AXPOL( array(
	'products' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_product_data_PL.xml',
	'stock' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_stocklist_pl.xml',
	'print' => 'ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_print_data_PL.xml',
),
array(
	'shop' => $name,
) );

$start = microtime( true );
$shop->update();
$shop->renew();

$stop = microtime( true );
printf(
	'%.2fs%s',
	$stop - $start,
	PHP_EOL
	
);

printf(
	'%1$s--- [%2$s] czyszczenie starych produktów ---%1$s',
	PHP_EOL,
	date("Y-m-d H:i:s")
);
$shop->clear( $dt, $name );

printf(
	'%1$s--- [%2$s] ---%1$s',
	PHP_EOL,
	date("Y-m-d H:i:s")
);

