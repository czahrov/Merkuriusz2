<?php
	/* template name: Produkt - sklep */
	get_header();
	$shop = $_GET['nazwa'];
	if( empty( $shop ) ){
		header( "Location:" . home_url() );
		exit;
	}
	
	$sql = "SELECT cat.name AS cat_name
FROM XML_product AS prod
JOIN XML_hash AS hash
ON prod.code = hash.PID
JOIN XML_category AS subcat
ON hash.CID = subcat.ID
JOIN XML_category AS cat
ON subcat.parent = cat.ID
WHERE prod.shop = '{$shop}'
ORDER BY cat_name ASC";
	$fetch_grid = doSQL( $sql );
	
?>
	<body class="shop-page">
		<?php get_template_part('segment/top'); ?>
		<div class="container flex-wrap main-content-section mt-4 mt-lg-0">
			<div class="row">
				<?php get_template_part('segment/shop-menu'); ?>
			</div>
		</div>
		<!-- end of the menu-section--> 
		<div class="container category-third-container">
			<ul class="breadcrumb">
				<?php
					$path = array(
						array(
							'name' => 'Strona główna',
							'url' => home_url(),
						),
						array(
							'name' => $shop,
							'url' => home_url("sklep/?nazwa={$shop}"),
						),
						
					);
					
					foreach( $path as $num => $segment ):
				?>
				<li class="<?php if( $num == count( $path ) - 1 ) echo " active "; ?>">
					<a href="<?php echo $segment['url']; ?>">
						<?php echo ucfirst( $segment['name'] ); ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id='kafelki' class='container'>
			<div id="top-brands-block" class="top-brands-block SecondContainer all-gap d-flex flex-wrap no-gutters">
				<?php
				/* generowanie kafelków promocyjnych, wiązanie na podstawie nazwy sklepu */
				$items = get_pages( array(
					'parent' => 982,	/* kafelki promocyjne */
					'sort_column' => 'menu_order, post_title',
					'sort_order' => 'ASC',
					'meta_key' => 'sklep',
				) );
				foreach( $items as $item ):
				$meta = get_post_meta( $item->ID );
				if( stripos( $meta['sklep'][0], $shop ) !== false ):
				?>
				<a class="zoom-banner mt-3 mt-sm-0 col-12 col-md-6 col-lg-4" href="<?php echo home_url(); ?>">
					<div class="top-brands-img">
						<div class='img' style="background-image:url(<?php echo wp_get_attachment_image_url( $meta['grafika'][0], 'full' ); ?>);"></div>
						<div class="watchtext1">
							<?php echo $meta['tytuł'][0]; ?>
						</div>
						<div class="watchtext2">
							<?php echo $meta['podtytuł'][0]; ?>
						</div>
						<div class="arrow-circle1">
							<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">
						</div>
					</div>
				</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
			
		</div>
		<div class= "container fourth-container">
			<h1 id="thirdContainerText1" class='text-uppercase'>
				Wszystkie
				<span id="thirdContainerText2">
					kategorie
				</span>
			</h1>
			<div id="fourth-container-content" class="row <?php echo slug( $shop ); ?>">
				<?php
					$grid = array();
					
					foreach( $fetch_grid as $line ){
						$c = $line['cat_name'];
						if( !array_key_exists( $c, $grid ) ) $grid[ $c ] = array();
					}
					
					foreach( $grid as $cat => $subcats ):
					/* ukrywane kategorie */
					if( in_array( $cat, array( 'cacharel', 'cerruti 1881', 'christian lacroix', 'jean-louis scherrer', 'nina ricci', 'ungaro', 'Power of brands - oferta specjalna 24h', 'power of brands – oferta specjalna 24h', 'wenger - bagaże biznesowe i akcesoria podróżne', 'wenger - bestsellery', 'voyager plus', 'Voyager XD' ) ) ) continue;
					
					/* dodawanie klas do kategorii */
					/* $class = "";
					$keys = array( 'victorinox', 'wenger', 'markowa', 'vip', 'bank', 'pendrive', 'smartwatch', 'silicon', 'aladdin', 'cofee', 'tucano', 'schwarzwolf', 'vine', 'moleskine', 'fofcio' );
					foreach( $keys as $key ){
						if( stripos( $cat, $key ) !== false ){
							$class = $key;
							break;
						}
					} */
					
					$cat = preg_replace( '/([^&])amp;/', '$1&', $cat );
				?>
				<div class='category <?php echo slug( $cat ); ?>'>
					<a class='title col-12 d-flex align-items-center' href='<?php echo home_url("kategoria/?dostawca={$shop}&nazwa={$cat}"); ?>'>
						<?php
							echo mb_convert_case( $cat, MB_CASE_TITLE );
						?>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>