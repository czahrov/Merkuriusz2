<?php
	define( 'DEV', isset( $_COOKIE['sprytne'] ) );
	$ver = time();
	
	// wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
	wp_enqueue_style( "bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css", array() );
	wp_enqueue_style( "bxslider", get_template_directory_uri() . "/css/jquery.bxslider.css", array(), $ver );
	wp_enqueue_style( "owl", get_template_directory_uri() . "/css/owl.css", array(), $ver );
	wp_enqueue_style( "owl-theme", get_template_directory_uri() . "/css/owl-theme.css", array(), $ver );
	wp_enqueue_style( "stylesheet", get_template_directory_uri() . "/css/stylesheet.css", array(), $ver );
	
	// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
	wp_enqueue_script( "jQ", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", array(), false, true );
	wp_enqueue_script( "popper", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js", array(), false, true );
	wp_enqueue_script( "bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js", array(), false, true );
	wp_enqueue_script( "bxslider", get_template_directory_uri() . "/js/jquery.bxslider.js", array(), $ver, true );
	wp_enqueue_script( "owl", get_template_directory_uri() . "/js/owl.js", array(), $ver, true );
	wp_enqueue_script( "custom", get_template_directory_uri() . "/js/custom.js", array(), $ver, true );
	
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>Merkuriusz</title>
		<?php wp_head(); ?>
	</head>