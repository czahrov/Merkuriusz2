<?php

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
		'Biuro i biznes',
		'Czas i pogoda',
		'Do picia',
		'Dom i ogród',
		'Dzieci i zabawa',
		'Elektronika',
		'Materiały piśmiennicze',
		'Narzędzia, latarki, breloki',
		'Odblaski',
		'Parasole i peleryny',
		'Torby i plecaki',
		'VIP',
		'Wakacje, sport i rekreacja',
		'Zakreślacze',
		'Zdrowie i uroda',
		'Święta i okazje specjalne',
		'Odzież reklamowa',
		'Nagrody i trofea',
		'Opakowania',
		'Pinsy, plakietki i odznaki',
		'Inne produkty',
		
	);
	
	echo '<ul class="dropdown-menu list-unstyled">';
	foreach( $menu as $item ){
		printf(
			'<li role="presentation">
				<a href="%s" role="menuitem" tabindex="-1" class="list-group-item">
					%s
				</a>
			</li>',
			home_url("kategoria/?nazwa={$item}"),
			$item
			
		);
		
	}
	echo '</ul>';
	
}
