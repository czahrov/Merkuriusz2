<?php
	/* Template Name: Oferta */
	get_header();
	$post = get_post();
	$oferty = genOfertyData();
	
	if( DEV ){
		echo "<!--";
		print_r( $oferty );
		echo "-->";
		
	}
	
?>
<body class="oferta-page">
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
			<div class='banner col-12 d-flex align-items-center justify-content-center' style='background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID ); ?>);'>
				<div class='title'>
					<?php //echo mb_strtoupper( $post->post_title ); ?>
				</div>
			</div>
			<div id='oferta' class='content col-12'>
				<?php //echo apply_filters( 'the_content', $post->post_content ); ?>
				<div class='box'>
					<div class='head flex flex-wrap'>
						<div class='title uppercase bold base1'>
							Realizacje - 
							<span class='small'>
								Druk, Znakowanie, Kalkomania, Haft, Promocja marki
							</span>
						</div>
						<div class='filters flex flex-items-center flex-wrap'>
							<?php
								foreach( $oferty as $name => $oferta ):
								?>
							<div class='item uppercase bold pointer <?php if( $name === 'Wszystkie' ) echo " active " ?>' cat='<?php echo $name ?>'>
								<?php echo $name; ?>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class='kafelki flex flex-wrap'>
						<?php
							foreach( $oferty[ 'Wszystkie' ] as $oferta ):
							$thumb = empty( $oferta[ 'thumb' ] )?( $oferta[ 'img_alt' ] ):( $oferta[ 'thumb' ] );
							$img = empty( $oferta[ 'img' ] )?( $oferta[ 'img_alt' ] ):( $oferta[ 'img' ] );
							?>
						<div class='item pointer base5' cats='<?php echo implode( " ", $oferta[ 'cats' ] ); ?>'>
							<div class='box'>
								<div class='img bg-cover bg-center' style='background-image:url(<?php echo $thumb; ?>);' img='<?php echo $img; ?>'></div>
								<div class='title flex flex-items-center semibold'>
									<?php echo $oferta[ 'title' ]; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class='popup_oferta flex flex-items-center flex-justify-center'>
					<div class='box grid bg-contain bg-norepeat bg-center bg-top'>
						<div class='top flex flex-justify-end'>
							<div class='title font-light flex flex-items-center'>
								Temporary title
							</div>
							<div class='btn-close pointer bg-blue2 font-light fa fa-times flex flex-items-center flex-justify-center'></div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- =================================footer begins================================================================-->
	<?php get_footer(); ?>