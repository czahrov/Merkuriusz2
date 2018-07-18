<?php
	$items = doSQL("SELECT subcat.name
	FROM XML_category as cat
	JOIN XML_category as subcat
	ON subcat.parent = cat.ID
	WHERE cat.name = 'vip elektronika'
	ORDER BY subcat.name ASC");
	
	
?>
<div class="container">
	<div class="products-block">
		<div class="row">
			<div class="col-md-6 col-lg-3 col-sm-12 menu-section mb-3 mb-md-0">
				<ul class="list-unstyled">
					<li class="active"><span class="green-bar"><span style="font-weight:600;">VIP</span> ELEKTRONIKA</span></li>
					<?php
						foreach( $items as $item ){
							printf(
								'<li>
									<a class="green-bar" href="%s">
										%s
									</a>
								</li>',
								home_url("kategoria/?nazwa=VIP Elektronika&podkategoria={$item['name']}"),
								ucfirst( $item['name'] )
								
							);
							
						}
					?>
					<li>
						<a class="green-bar" href="<?php echo home_url("kategoria/?nazwa=VIP Elektronika"); ?>">
							Wszystkie kategorie
						</a>
					</li>
				</ul>
			</div>
			<div  class="col-md-6 col-lg-3 col-sm-12 banner-section" >
				<div id="womanimage" class="h-100" style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/vip-electronika.png);'></div>
				<a href="<?php echo home_url("kategoria/?nazwa=VIP Elektronika"); ?>">
					<div class="womantext1"> Elektronika </div>
					<div class="womantext2"> - Dla każdego </div>
					<div class="arrow-circle1">
						<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png"> 
					</div>
				</a>
			</div>
			<div class="col-md-12 col-lg-6 col-sm-12 avialable-product-section">
				<div class="avialable-product-slider">
					<?php
						$items = doSQL("SELECT prod.*
						FROM XML_category as cat
						JOIN XML_category as subcat
						ON subcat.parent = cat.ID
						JOIN XML_product as prod
						ON prod.cat_id = subcat.ID
						WHERE cat.name = 'VIP Elektronika'");
						
						shuffle( $items );
						$sub = array_slice( $items, 0, 6 );
						$chunks = array_chunk( $sub, 2 );
						
						foreach( $chunks as $chunk ):
					?>
					<div class="available-each">
						<?php foreach( $chunk as $num => $item ): ?>
						<div class="owl-item" style="width: 356px;">
							<div class="single-item item">
								<div class="card h-100 d-flex">
									<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
										<div class="card-img" style="background-image: url(<?php echo json_decode( $item['photos'] )[0]; ?>);"></div>
									</a>
									<div class="card-body d-flex flex-column">
										<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>"></a>
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
														printf( '%.2f %s netto', $item['netto'], $item['currency'] );
													}
													else{
														echo "Wycena indywidualna";
													}
												?>
											</h5>
										</div>
										<a class="button-show-item" href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
											Zobacz
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="controls col-md-12 arrows-product-section">
					<div class="arrow-circle right">
						<a>
							<img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png">
						</a>
					</div>
					<div class="arrow-circle left">
						<a>
							<img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ======================end of the product block container ==================-->
