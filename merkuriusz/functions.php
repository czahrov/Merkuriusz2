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
		if( $orderby === null ) $orderby = 'ID';
		if( $order === null ) $orderby = 'DESC';
		
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
		
		// $sql .= " ORDER BY {$orderby} {$order}";
		
		// return $sql;
		return doSQL( $sql );
		
	}
	else{
		return false;
		
	}
	
}

