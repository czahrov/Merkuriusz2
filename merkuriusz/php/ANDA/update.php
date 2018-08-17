<?php
$name = 'ANDA';

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

$shop = new ANDA( array(
	/* 'products' => 'https://xml.andapresent.com/export/products/pl/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'stock' => 'https://xml.andapresent.com/export/inventories/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'marking' => 'https://xml.andapresent.com/export/labeling/en/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
	'price' => 'https://xml.andapresent.com/export/prices/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP', */
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

