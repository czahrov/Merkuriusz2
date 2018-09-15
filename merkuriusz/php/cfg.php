<?php

if( $_SERVER['SERVER_NAME'] === 'localhost' ){
	define( 'DBHOST', 'localhost' );
	define( 'DBNAME', 'baza23171_merkuriusz2' );
	define( 'DBUSER', 'root' );
	define( 'DBPASS', '' );
}
else{
	define( 'DBHOST', '23171.m.tld.pl' );
	define( 'DBNAME', 'baza23171_merkuriusz2' );
	define( 'DBUSER', 'admin23171_merkuriusz2' );
	define( 'DBPASS', '7Cp^8HHd7N' );
}
