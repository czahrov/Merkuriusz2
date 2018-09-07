
<?php
/*
	Template Name: O nas
*/

	?>
<?php
	get_header();
	$post = get_post();
?>
	<body class="single-page">
		<?php get_template_part('segment/top'); ?>
		<div class="container flex-wrap main-content-section mt-4 mt-lg-0">
			<div class="row">
				<?php get_template_part('segment/shop-menu'); ?>
			</div>
		</div>
		<!-- end of the menu-section--> 
		<div class="container category-third-container">
			<?php get_template_part('segment/breadcrumb'); ?>
		</div>
		<div class= "container fourth-container">
			<div class="content-styles" id="fourth-container-content">
				<div class='banner col-12 d-flex align-items-center justify-content-center' style='background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID ); ?>);'>
					<div class='title'>
						<!-- <?php echo mb_strtoupper( $post->post_title ); ?> -->
					</div>
				</div>
				<div class='content col-12'>
					<?php echo apply_filters( 'the_content', $post->post_content ); ?>



				</div>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>