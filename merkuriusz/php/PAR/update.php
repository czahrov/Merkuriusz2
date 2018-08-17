<?php
$name = 'PAR';

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

$shop = new PAR( array(
	'products' => 'http://biuro@merkuriusz.pl@merkuriusz345@www.par.com.pl/api/products',
	'stock' => 'http://biuro@merkuriusz.pl@merkuriusz345@www.par.com.pl/api/stocks',
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

