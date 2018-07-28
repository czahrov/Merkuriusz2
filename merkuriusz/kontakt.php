
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
				<div class="col-md-12 col-lg-3" id="Nav-container">
					<div class="dropdown open show">
						<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
						<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp <span>NASZE PRODUKTY </span>
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