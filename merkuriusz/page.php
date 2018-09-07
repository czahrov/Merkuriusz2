<?php
	get_header();
	$post = get_post();
?>
	<body class="single-page">
		<?php get_template_part('segment/top'); ?>
		<div class="container flex-wrap main-content-section mt-4 mt-lg-0">
			<div class="row">
				<div class="col-md-12 col-lg-3" id="Nav-container">
					<div class="dropdown open show">
						<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
						<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp <span>Gadżety reklamowe</span>
						</button>
						<?php genMenu(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- end of the menu-section--> 
		<div class="container category-third-container">
			<?php get_template_part('segment/breadcrumb'); ?>
		</div>
		<div class= "container fourth-container">
			<div class="row" id="fourth-container-content">
				<?php
					$img = get_the_post_thumbnail_url( $post->ID );
				?>
				<div class='banner col-12 d-flex align-items-center justify-content-center' style='background-image:url(<?php echo $img; ?>);'>
					<?php if( $img == false ): ?>
					<div class='title'>
						<?php echo mb_strtoupper( $post->post_title ); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class='content col-12'>
					<?php echo apply_filters( 'the_content', $post->post_content ); ?>
				</div>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>