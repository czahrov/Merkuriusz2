<?php
	$slides = get_pages( array(
		'parent' => get_page_by_path('specjalne/slider-glowny')->ID,
	) );
?>
<div class="carousel slide" id="demo" data-ride="carousel">
	<div class="carousel-inner all-gap">
		<?php foreach( $slides as $num => $slide): ?>
		<div class="carousel-item <?php echo $num == 0?(' active '):(''); ?>" style='background-image:url(<?php echo wp_get_attachment_image_url( get_post_meta( $slide->ID, 'grafika', true ), 'full' ); ?>);'>
			<div class="carousel-caption">
				<h1 class="carousel-head1">
					<?php echo get_post_meta( $slide->ID, 'tekst1', true ); ?>
				</h1>
				<h1 class="carousel-head2">
					<?php echo get_post_meta( $slide->ID, 'tekst2', true ); ?>
				</h1>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<a class="carousel-control-prev" href="#demo" data-slide="prev">
		<div class="arrow-circle">
			<img src="<?php echo get_template_directory_uri(); ?>/media/arrow-left.png">
		</div>
	</a>
	<a class="carousel-control-next" href="#demo" data-slide="next">
		<div class="arrow-circle">
			<img src="<?php echo get_template_directory_uri(); ?>/media/arrow-right.png">
		</div>
	</a>
</div>
