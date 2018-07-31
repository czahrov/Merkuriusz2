<?php
	$path = array(
		array(
			'name' => 'Strona główna',
			'url' => home_url(),
		),
		
	);
	
	/* standardowa strona */
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