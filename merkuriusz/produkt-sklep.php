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
			<div class="top-brands-block SecondContainer all-gap" id="top-brands-block">
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
				<a class="zoom-banner mt-3 mt-sm-0" href="<?php echo $meta['odnośnik'][0]; ?>">
					<div class="top-brands-img col-md-4">
						<div class='img' style="background-image: url(<?php echo wp_get_attachment_image_url( $meta['grafika'][0], 'full' ); ?>);" ></div>
						<div class="watchtext1">
							<?php echo $meta['tytuł'][0]; ?>
						</div>
						<div class="watchtext2">
							<?php echo $meta['podtytuł'][0]; ?>
						</div>
						<div class="arrow-circle1">
							<img src="http://merkuriusz.scepter.pl/wp-content/themes/merkuriusz/media/banner-whiterightarrow.png">
						</div>
					</div>
				</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
			
		</div>
		<h1 id="thirdContainerText1" class='text-uppercase'>
			Wszystkie
			<span id="thirdContainerText2">
				kategorie
			</span>
		</h1>
		<div class= "container fourth-container">
			<div id="fourth-container-content" class="row">
				<?php
					$grid = array();
					
					foreach( $fetch_grid as $line ){
						$c = $line['cat_name'];
						if( !array_key_exists( $c, $grid ) ) $grid[ $c ] = array();
					}
					
					foreach( $grid as $cat => $subcats ):
				?>
				<div class='category'>
					<a class='title col-12 d-flex justify-content-between align-items-center' href='<?php echo home_url("kategoria/?dostawca={$shop}&nazwa={$cat}"); ?>'>
						<?php echo ucfirst( $cat ); ?>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>