<?php
	/* template name: Produkt - sklep */
	get_header();
	$shop = $_GET['nazwa'];
	if( empty( $shop ) ){
		header( "Location:" . home_url() );
		exit;
	}
	
	$sql = "SELECT cat.name AS cat_name, subcat.name AS subcat_name
FROM XML_product AS prod
JOIN XML_hash AS hash
ON prod.code = hash.PID
JOIN XML_category AS subcat
ON hash.CID = subcat.ID
JOIN XML_category AS cat
ON subcat.parent = cat.ID
WHERE prod.shop = '{$shop}'
ORDER BY cat_name, subcat_name ASC";
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
		<div class="container category-text-container">
			<h1 id="categoryContainerText1">WYBIERZ KATEGORIE SPOŚRÓD:
				<span id="categoryContainerText2"></span>
			</h1>
		</div>
		<div class="container electronics-dropdown-container"  id="electronic-dropdown-button">
			<div class="dropdown">
				<div class="dropdown open show">
					<button class="btn btn-default dropdown-toggle" type="button" id="electronic-dropdown" data-toggle="dropdown">
					<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp WYBIERZ KATEGORIE SPOŚRÓD
					</button>
					<ul class="dropdown-menu list-unstyled">
						<li role="presentation" id="electronic-dropdown-unorderlist" >
							<a href="<?php echo home_url("kategoria/?nazwa={$cat}"); ?>">
								Wszystkie
							</a>
						</li>
						<?php foreach( $subcats as $subcat ): ?>
						<li role="presentation" id="electronic-dropdown-unorderlist">
							<a class="list-group-item" href="<?php echo home_url("kategoria/?nazwa={$subcat['name']}"); ?>" role="menuitem" tabindex="-1">
								<?php echo $subcat['name']; ?>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class= "container fourth-container">
			<div id="fourth-container-content" class="row align-items-start">
				<?php
					$grid = array();
					
					foreach( $fetch_grid as $line ){
						$c = $line['cat_name'];
						$s = $line['subcat_name'];
						if( !array_key_exists( $c, $grid ) ) $grid[ $c ] = array();
						if( !in_array( $s, $grid[ $c ] ) ) $grid[ $c ][] = $s;
						
					}
					
					foreach( $grid as $cat => $subcats ):
				?>
				<div class='category row col-12 col-md-6 col-lg-4 col-xl-3 align-items-start'>
					<a class='title col-12 text-center' href='<?php echo home_url("kategoria/?dostawca={$shop}&nazwa={$cat}"); ?>'>
						<?php echo ucfirst( $cat ); ?>
					</a>
					<?php foreach( $subcats as $subcat ): ?>
					<?php if( $subcat !== 'pozostałe' ): ?>
					<a class='item col-12 col-lg-6' href='<?php echo home_url("kategoria/?dostawca={$shop}&nazwa={$cat}&podkategoria={$subcat}"); ?>'>
						<?php echo ucfirst( $subcat ); ?>
					</a>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>