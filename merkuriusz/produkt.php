<?php
	/* template name: Produkt - pojedynczy */
	if( empty( $_GET ) ){
		header("Location:" . home_url() );
		exit;
	}
	
	get_header();
	$items = getProduct( $_GET['kod'] );
	$item = $items[0];
	if( DEV ){
		echo "<!--";
		print_r( $item );
		echo "-->";
	}
		
?>

<body class="product-page">
	<?php get_template_part('segment/top'); ?>
	<div class="container flex-wrap main-content-section mt-4 mt-lg-0 product-page-dropdown">
		<div class="row">
			<div class="col-md-12 col-lg-3" id="Nav-container">
				<div class="dropdown open show">
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
					<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp <span>NASZE PRODUKTY </span>
					</button>
					<?php genMenu(); ?>
				</div>
			</div>
			<div class="col-md-12 col-lg-9 content-block">
				<div class="category-third-container">
					<?php get_template_part('segment/breadcrumb'); ?>
				</div>
				<div class="category-product-title" >
					<p>
						<?php echo $item['title']; ?>
					</p>
				</div>
				<div class="container category-single-product">
					<div class="row">
					<?php
						$imgs = json_decode( $item['photos'] );
					?>
						<div class="col-md-6 single-product-info">
							<div class="product-page-main-banner-desktop">
								<div class="single-product-image" style='background-image:url(<?php echo $imgs[0]; ?>);'>
									<div class="single-product-arrows"> 
										<a  id="single-productarrow-back"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-back.png" alt=""/> </a>
										<a id="single-productarrow-forward"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-forward.png" alt=""/> </a>
									</div>
								</div>
							</div>
							<div class="single-product-gallery">
								<div class="row">
									<?php foreach( $imgs as $img ): ?>
									<div class="col-md-4">
										<div class="single-product-img1" style='background-image:url(<?php echo $img; ?>);'> </div>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="col-md-6 category-single-product-description">
							<div class="product-price-details">
								<h3> Cena już od:
									<span>
										<?php
											if( $item['netto'] > 0 ){
												printf( '%.2f %s netto', $item['netto'], $item['currency'] );
											}
											else{
												echo "Wycena indywidualna";
											}
										?>
									</span>
								</h3>
							</div>
							<div class="product-size-details">
								<p>Kod: <?php echo $item['code']; ?></p>
								<p>Kolory: <?php echo $item['colors']; ?></p>
								<p>Rozmiar: <?php echo $item['dimension']; ?></p>
								<p>Grupa znakowania: <?php echo $item['marking']; ?></p>
							</div>
							<div class="product-enquiry-details">
								<button type="submit">
									<a href='<?php echo home_url("zapytaj/?kod={$_GET['kod']}"); ?>'>
										wyślij zapytanie
									</a>
								</button>
							</div>
							<div class="flex-wrap product-contact-details">
								<div id="product-contact-img"> 
									<img src="<?php echo get_template_directory_uri(); ?>/media/smartphone.png"> 
								</div>
								<div id="product-contact-content"> 
									<a href="tel:48146223364" id="contact-number"> +48 14 622 33 64 </a> 
									<a href="mailto:biuro@merkuriusz.pl" id="contact-email"> biuro@merkuriusz.pl</a> 
								</div>
								<div class="product-social-contacts col-12 d-flex align-items-center">
									<p> Udostępnij znajomemu </p>
									<a href="https://www.facebook.com/sharer.php?u=<?php printf( '%s?kod=%s', the_permalink( get_post()->ID ), $item['code'] ); ?>" target='_blank'>
										<div class='fa fa-facebook'></div>
									</a>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="category-product-text">
					<p>
					<?php echo $item['description']; ?>
					</p>
				</div>
				<div class="category-availability">
					<a href="#">
						<h3>
							Dostępność w magazynie:
								<span>
								<?php
									printf(
										'%u szt.',
										$item['instock']
									);
									
								?>
								</span>
						</h3>
					</a>
				</div>
				<?php
					$sql = "SELECT * FROM XML_product WHERE code LIKE '{$item['short']}%' AND NOT code = '{$item['code']}'";
					$siblings = doSQL( $sql );
				?>
				<div class="similar-products-title">
					<h3><span>PODOBNE</span> PRODUKTY</h3>
				</div>
				<div class="fourth-container similar-products-container">
					<div class="row" id="fourth-container-content">
						<?php
							if( !empty( $siblings ) ) foreach( $siblings as $item ):
							$photos = json_decode( $item['photos'] );
						?>
						<div class="single-item col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
							<div class="card h-100 d-flex">
								<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
									<div class="card-img" style="background-image: url( <?php echo $photos[0]; ?> );"></div>
								</a>
								<div class="card-body d-flex flex-column">
									<a href="produkt-single.html"></a>
									<div class="hover-element-shop">
										<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>"></a>
										<a href="<?php echo home_url("zapytaj/?kod={$item['code']}"); ?>">
											wyślij zapytanie
										</a>
									</div>
									<h4 class="card-title grow ">
										<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
											<?php echo $item['title']; ?>
										</a>
									</h4>
									<div class="price">
										<h5>
										<?php
											if( $item['netto'] > 0 ){
												printf( '%.2f %s', $item['netto'], $item['currency'] );
											}
											else{
												echo "Wycena indywidualna";
											}
										?>
										</h5>  
									</div>
									<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>" class="button-show-item">
										Zobacz
									</a>
								</div>
							</div>
						</div>
						<!-- /.single item -->
						<?php endforeach; ?>
					</div>
				</div>
				<!-- /.single item -->
			</div>
		</div>
	</div>
	<!--===================================end of the main-content-section===========================================================--> 
	<!-- =================================footer begins================================================================-->
	
<?php get_footer(); ?>
