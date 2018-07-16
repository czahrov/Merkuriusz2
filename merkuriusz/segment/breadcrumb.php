<?php
	$path = array(
		array(
			'name' => 'Strona główna',
			'url' => home_url(),
		),
		
	);
	
	/* strona kategorii */
	if( !empty( $_GET['nazwa'] ) ){
		array_push( $path, array(
			'name' => "{$_GET['nazwa']}",
			'url' => home_url("kategoria/?nazwa={$_GET['nazwa']}"),
			
		) );
		
		if( !empty( $_GET['podkategoria'] ) ){
			array_push( $path, array(
				'name' => "{$_GET['podkategoria']}",
				'url' => home_url("kategoria/?nazwa={$_GET['nazwa']}&podkategoria={$_GET['podkategoria']}"),
				
			) );
			
		}
	
	}
	/* strona produktu */
	elseif( !empty( $_GET['kod'] ) ){
		$data = doSQL("SELECT cat.name as cat_name, subcat.name as subcat_name, prod.title, prod.code
		FROM XML_category as cat
		JOIN XML_category as subcat
		ON cat.ID = subcat.parent
		JOIN XML_product as prod
		ON prod.cat_id = subcat.ID
		WHERE prod.code = '{$_GET['kod']}'");
		
		$item = $data[0];
		
		array_push( $path, array(
			'name' => "{$item['cat_name']}",
			'url' => home_url("kategoria/?nazwa={$item['cat_name']}"),
		) );
		
		array_push( $path, array(
			'name' => "{$item['subcat_name']}",
			'url' => home_url("kategoria/?nazwa={$item['cat_name']}&podkategoria={$item['subcat_name']}"),
		) );
		
		array_push( $path, array(
			'name' => "{$item['title']}",
			'url' => home_url("produkt/?kod={$item['code']}"),
		) );
		
	}
	/* strona wyszukiwania */
	elseif( is_search() ){
		array_push(
			$path,
			array(
				'name' => "Fraza: {$_GET['s']}",
				'url' => home_url("/?s={$_GET['s']}"),
			)
		);
		
	}
	/* standardowa strona */
	else{
		$temp = array();
		$current = get_post();
		do{
			$temp[] = array(
				'name' => $current->post_title,
				'url' => get_the_permalink( $current->ID ),
			);
			
			$current = get_post( $current->post_parent );
		}
		while( $current->post_parent > 0 );
		array_reverse( $temp );
		foreach( $temp as $t ){
			$path[] = $t;
			
		}
		
	}
	
	if( DEV ){
		echo "<!--";
		print_r( $item );
		print_r( $path );
		echo "-->";
		
	}
?>
<ul class="breadcrumb">
	<?php foreach( $path as $num => $segment ): ?>
	<li class="<?php if( $num == count( $path ) - 1 ) echo " active "; ?>">
		<a href="<?php echo $segment['url']; ?>">
			<?php echo ucfirst( $segment['name'] ); ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>