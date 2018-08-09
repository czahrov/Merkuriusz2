<div id="top-brands-block" class="top-brands-block SecondContainer all-gap d-flex flex-wrap no-gutters">
	<?php
		$pages = get_pages( array(
			'parent' => get_page_by_title('kafelki VIP')->ID,
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order, post_name',
			
		) );
		
		foreach( $pages as $page ):
		$meta = get_post_meta( $page->ID );
	?>
	<a href="<?php echo $meta['odnośnik'][0]; ?>" class="zoom-banner mt-3 mt-sm-0 col-12 col-md-6 col-lg-4 col-xl-3">
		<div class="top-brands-img">
			<div class='img' style="background-image:url(<?php echo wp_get_attachment_image_url( $meta['grafika'][0], 'full' ); ?>);"></div>
			<div class="<?php echo $meta['tło'][0] === 'light'?( 'circle' ):( 'watch' ) ?>text1">
				<?php echo $meta['tytuł'][0]; ?>
			</div>
			<div class="<?php echo $meta['tło'][0] === 'light'?( 'circle' ):( 'watch' ) ?>text2">
				<?php echo $meta['podtytuł'][0]; ?>
			</div>
			<div class="arrow-circle<?php echo $meta['tło'][0] === 'light'?( '' ):( '1' ) ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/media/banner-<?php echo $meta['tło'][0] === 'light'?( '' ):( 'white' ) ?>rightarrow.png">
			</div>
		</div>
	</a>
	<?php endforeach; ?>
	
</div>