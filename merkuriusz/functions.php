<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'widgets' );

function printTitle(){
	printf(
		'%s | %s',
		get_post()->post_title,
		get_bloginfo('name')
	);
	
}

function getConnect(){
	$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	return mysqli_errno( $con )?( false ):( $con );
	
}

function doSQL( $sql = "", $out = MYSQLI_ASSOC ){
	$con = getConnect();
	$query = mysqli_query( $con, $sql );
	if( !is_bool( $query ) ){
		$fetch = mysqli_fetch_all( $query, $out );
		mysqli_free_result( $query );
		
	}
	else $fetch = $query;
	
	mysqli_close( $con );
	return $fetch;
}

function getCategory( $cat_name = null, $subcat_name = null, $orderby = null, $order = null ){
	
	if( $cat_name !== null ){
		if( in_array( $orderby, array( null, '' ) ) ) $orderby = 'ID';
		if( $order === null ) $order = 'DESC';
		
		if( $subcat_name !== null ){
			$sql = "SELECT prod.*
			FROM XML_category as cat
			JOIN XML_category as subcat
			ON cat.ID = subcat.parent
			JOIN XML_product as prod
			ON subcat.ID = prod.cat_id
			WHERE cat.name = '{$cat_name}' AND subcat.name = '{$subcat_name}'";
			
		}
		else{
			$sql = "SELECT prod.*
			FROM XML_category as cat
			JOIN XML_category as subcat
			ON cat.ID = subcat.parent
			JOIN XML_product as prod
			ON subcat.ID = prod.cat_id
			WHERE cat.name = '{$cat_name}'";
			
		}
		
		$sql .= " ORDER BY prod.{$orderby} {$order}";
		
		return doSQL( $sql );
		
	}
	else{
		return false;
		
	}
	
}

function getSubcatsList( $cat_name = null ){
	$con = getConnect();
	$sql = "SELECT subcat.name
	FROM XML_category as cat
	JOIN XML_category as subcat
	ON cat.ID = subcat.parent
	WHERE cat.name = '{$cat_name}'
	ORDER BY subcat.name ASC";
	
	return doSQL( $sql );
	
}

function getProduct( $code = null ){
	$sql = "SELECT * FROM XML_product WHERE code = '{$code}'";
	return doSQL( $sql );
	
}

function genMenu(){
	$menu = array(
		/* 'Biuro i biznes',
		'Czas i pogoda',
		'Do picia',
		'Dom i ogród',
		'Smycze',
		'Dzieci, zabawa, szkoła',
		'Pluszaki',
		'Elektronika',
		'Materiały piśmiennicze',
		'Narzędzia, latarki, breloki, antystresy',
		'Odblaski',
		'Parasole i peleryny',
		'Torby i plecaki',
		'VIP Collection',
		'Wakacje, sport i rekreacja',
		'Zdrowie i uroda',
		'Święta i okazje specjalne',
		'Tekstylia i odzież',
		'Nagrody i trofea',
		'Opakowania',
		'Etui i portfele',
		'Pinsy, plakietki, odznaki',
		'Sublimacja - drukuj na kolorowo',
		'VIP Skóra',
		'Sety', */
		'Easy Gifts' => 'easygifts',
		'Jaguar Gift' => 'jaguargift',
		// 'Falk&Ross' => 'falkross',
		'Asgard' => 'asgard',
		'Inspirion' => 'inspirion',
		'PAR' => 'par',
		'Macma' => 'macma',
		'Axpol' => 'axpol',
		'Anda' => 'anda',
	);
	
	// sort( $menu );
	
	// $menu[] = 'Inne produkty';
	
	echo '<ul class="dropdown-menu list-unstyled">';
	foreach( $menu as $name => $item ){
		printf(
			'<li role="presentation">
				<a href="%s" role="menuitem" tabindex="-1" class="list-group-item">
					%s
				</a>
			</li>',
			home_url("sklep/?nazwa={$item}"),
			$name
			
		);
		
	}
	echo '</ul>';
	
}

function genOfertyData(){
	$ret = array();
	
	/* Wyciąganie listy podkategorii kategorii tworzących filtry */
	$categories = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => false,
		'parent' => get_category_by_slug( 'oferty' )->cat_ID,
		
	) );
	
	/* Tworzenie tablicy z wspisami dla kategorii głównej */
	$ret[ 'Wszystkie' ] = array();
	
	$posts = get_posts( array(
		'category_name' => 'oferty',
		'numberposts' => -1,
			
	) );
	
	foreach( $posts as $post ){
		$ret[ 'Wszystkie' ][ $post->post_name ] = array(
			'title' => $post->post_title,
			'thumb' => get_the_post_thumbnail_url( $post->ID, 'medium' ),
			'img' => get_the_post_thumbnail_url( $post->ID, 'full' ),
			'img_alt' => 'https://placeimg.com/100/100/tech',
			'cats' => array( 'Wszystkie' ),
			
		);
		
	}
	
	/* Przechodzenie po wszystkich znaleizonych podkategoriach, dodawanie nazwy znalezionej podkategorii, dopisywanie nazw kategorii dla wpisów */
	foreach( $categories as $cat ){
		$ret[ $cat->name ] = array();
		
		$posts = get_posts( array(
			'category' => $cat->term_id,
			'numberposts' => -1,
			
		) );
		
		foreach( $posts as $post ){
			$ret[ 'Wszystkie' ][ $post->post_name ][ 'cats' ][] = $cat->name;
			
		}
		
	}
	
	
	// return $categories;
	return $ret;
}

function register_my_menus() {
  register_nav_menus(
    array(
      'menu-znakowanie' => __( 'menu-znakowanie' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active-menu';
    }
    return $classes;
}

/* funkcja generująca og tagi do social mediów */
function OGTags( $obj = null ){
	/* generowanie tagów dla standardowej strony */
	if( $obj === null ){
		$post = get_post();
		
		$img = get_the_post_thumbnail_url( $post->ID, 'full' );
		if( $img === false ) $img = get_template_directory_uri() . "/media/logo1.jpg";
		
		
		printf(
		'<meta property="og:title" content="%s" />
		<meta property="og:type" content="%s" />
		<meta property="og:url" content="%s" />
		<meta property="og:site_name" content="%s" />
		<meta property="og:image" content="%s" />
		<meta property="og:description" content="%s" />',
		$post->post_title,
		'article',
		get_the_permalink( $post->ID ),
		get_bloginfo('name'),
		$img,
		strip_tags( $post->post_content )
		
		);
		
		
	}
	/* generowanie tagów dla strony produktu */
	else{
		$item = $obj[0];
		$imgs = json_decode( $item['photos'] );
		
		printf(
		'<meta property="og:title" content="%s" />
		<meta property="og:type" content="%s" />
		<meta property="og:url" content="%s" />
		<meta property="og:site_name" content="%s" />
		<meta property="og:image" content="%s" />
		<meta property="og:description" content="%s" />',
		$item['title'],
		'product',
		home_url( "produkt/?kod={$item['code']}" ),
		get_bloginfo( 'name' ),
		$imgs[0],
		implode( " ", array_slice( explode( " ", strip_tags( trim( $item['description'] ) ) ) , 0, 50 ) )
		
		);
		
	}
}

