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
				<a href="<?php echo home_url("kategoria/?nazwa=VIP Elektronika"); ?>">
					<div id="womanimage" class="h-100" style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/vip-electronika.png);'></div>
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
						<div class="product-each-block <?php if( $num > 0 ) echo "d-none d-md-block"; ?>">
							<div class="row">
								<div class="col-md-4 avialable-product-img text-center">
									<?php $imgs = json_decode( $item['photos'] ); ?>
									<img class="img-responsive img-center" src="<?php echo $imgs[0]; ?>" alt=""/></div>
								<div class="col-md-4 product-tittle">
									<?php echo $item['title']; ?>
								</div>
								<div class="col-md-4 product-price">
									<?php
										if( $item['netto'] > 0 ){
											printf( '%.2f %s netto', $item['netto'], $item['currency'] );
										}
										else{
											echo "Wycena indywidualna";
										}
									?>
								</div>
								<button type="submit">
									<a href='<?php echo home_url("produkt/?kod={$item['code']}"); ?>'>
										zobacz
									</a>
								</button>
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
