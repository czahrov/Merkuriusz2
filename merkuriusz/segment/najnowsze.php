<div class="col-lg-12 third-container all-gap">
	<h1 id="thirdContainerText1">NAJNOWSZE <span id="thirdContainerText2"> produkty</span></h1>
</div>
<div class="fourth-container">
	<div class="row" id="fourth-container-content">
		<div class="product-slider" id="product-slider">
			<?php
				$new = doSQL("SELECT * FROM XML_product WHERE new = 1 ORDER BY ID DESC LIMIT 6");
				if( DEV ){
					echo "<!--";
					print_r( $new );
					echo "-->";
				}
					
				foreach( $new as $item ):
			?>
			<div class="single-item item">
				<div class="card h-100 d-flex">
					<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
						<?php $imgs = json_decode( $item['photos'] ); ?>
						<div class="card-img" style="background-image: url(<?php echo $imgs[0]; ?>);"></div>
					</a>
					<div class="card-body d-flex flex-column">
						<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>"></a>
						<div class="hover-element-shop">
							<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>"></a>
							<a href="<?php echo home_url("zapytaj/?kod={$item['code']}"); ?>">wyślij zapytanie</a>
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
						<a class='button-show-item' href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
							Zobacz
						</a>
					</div>
				</div>
			</div>
			<!-- /.single item -->
			<?php endforeach; ?>
		</div>
		<div class="fifth-container">
			<div class="arrow-circle prev"><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png"></div>
			<div class="arrow-circle next"><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png"></div>
		</div>
	</div>
</div>
<!-- ======================end of the fifth container ==================-->
