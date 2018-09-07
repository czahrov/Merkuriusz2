
<?php
/*
	Template Name: Kontakt
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
				<iframe src="https://snazzymaps.com/embed/84792" width="100%" height="300px" style="border:none;"></iframe>
				<div class='content col-12'>
					<?php echo apply_filters( 'the_content', $post->post_content ); ?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBxVNTb4QJSrSuBpEe_3NpRgl_bwlt8kdk&extension=.js"></script>







				</div>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>