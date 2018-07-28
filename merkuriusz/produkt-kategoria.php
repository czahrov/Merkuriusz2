<?php
	/* template name: Produkt - kategoria */
	if( empty( $_GET ) ){
		header("Location:" . home_url() );
		exit;
	}
	
	get_header();
	$cat = $_GET['nazwa'];
	$subcat = $_GET['podkategoria'];
	$orderby = $_GET['według'];
	$order = $_GET['sortuj'];
	$strona = max( 1, (int)$_GET['strona'] );
	$perpage = 16;
	$pages = array_chunk( getCategory( $cat, $subcat, $orderby, $order ), $perpage );
	$items = $pages[ $strona - 1 ];
	$nav_end = 1;
	$nav_range = 3;
	
	echo "<!--";
	// var_dump( $cat );
	// var_dump( $subcat );
	// var_dump( $orderby );
	// var_dump( $order );
	// var_dump( $strona );
	// print_r( $items );
	echo "-->";
?>
	<body class="home-page">
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
		<div class="container category-text-container">
			<h1 id="categoryContainerText1">WYBIERZ KATEGORIE SPOŚRÓD:
				<span id="categoryContainerText2">
					<?php
						if( empty( $subcat ) ){
							echo mb_strtoupper( $cat );
						}
						else{
							echo mb_strtoupper( $cat );
						}
							
					?>
				</span>
			</h1>
		</div>
		<div class="container category-electronics-container" id="large-electronic-btn">
			<a id="electronicstext" href="<?php echo home_url("kategoria/?nazwa={$cat}"); ?>">
				Wszystkie
			</a>
			<?php
				$subcats = getSubcatsList( $_GET['nazwa'] );
				echo "<!--";
				print_r( $subcats );
				echo "-->";
				foreach( $subcats as $subcat ):
			?>
			<a id="electronicstext" href='<?php echo home_url("kategoria/?nazwa={$cat}&podkategoria={$subcat['name']}"); ?>'>
				<?php echo ucfirst( $subcat['name'] ); ?>
			</a>
			<?php endforeach; ?>
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
		<div class="container category-dropdown-container" id="dropdown-category-button">
			<div class="dropdown">
				<button class="btn dropdown-toggle " type="button" data-toggle="dropdown" id="sortbutton" > Sortuj według ceny &nbsp
				<span class="caret"> <img src="<?php echo get_template_directory_uri(); ?>/media/caret.png" > </span></button>
				<ul class="dropdown-menu" id="sort-dropdown">
					
					<li>
						<a href="?<?php echo http_build_query( array_merge( $_GET, array( 'według' => 'netto', 'sortuj' => 'ASC' ) ) ); ?>">
							Rosnąco
						</a>
					</li>
					<li>
						<a href="?<?php echo http_build_query( array_merge( $_GET, array( 'według' => 'netto', 'sortuj' => 'DESC' ) ) ); ?>">
							Malejąco
						</a>
					</li>
					
				</ul>
			</div>
		</div>
		<div class= "container fourth-container">
			<div class="row" id="fourth-container-content">
				<?php if( !empty( $items ) ): ?>
				<?php foreach( $items as $item ): ?>
				<div class=" col-md-4 col-lg-3 col-sm-6 col-12 mb-2 single-item">
					<div class="card h-100 d-flex">
						<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>">
							<div class="card-img" style="background-image: url( <?php $imgs = json_decode( $item['photos'] ); echo $imgs[0]; ?> );">
							</div>
							<div class="card-body d-flex flex-column">
								<div class="hover-element-shop">
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
												printf( '%.2f %s', $item['netto'], $item['currency'] );
											}
											else{
												echo "Wycena indywidualna";
											}
									?>
									</h5>  
								</div>
								<a href="<?php echo home_url("produkt/?kod={$item['code']}"); ?>" class="button-show-item">Zobacz</a>
							</div>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<div class=''>
					Ta kategoria nie posiada produktów
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="d-flex justify-content-center pagination-products fifth-container">
		<?php
			if( count( $pages ) > 1 ){
				$nav_links = array();
				foreach( $pages  as $num => $page ){
					$http_query = http_build_query( array_merge(
						$_GET,
						array(
							'strona' => $num + 1,
						)
					) );
					
					$nav_links[] = sprintf(
						'<a class="%s" href="%s">%u</a>',
						$num+1 == $strona?(' active '):(''),
						// home_url("kategoria/?nazwa={$cat}&podkategoria={$subcat}&strona=" . ( $num + 1 ) ),
						"?" . $http_query,
						$num + 1
					);
					
				}
				
				/* [1] ... [x-2] [x-1] [x] [x+1] [x+2] ... [n] */
				
				$current = $strona - 1;
				
				if( $current + $nav_range < count( $pages ) - 2 ){
					array_splice( $nav_links, $current + $nav_range + 1, -1, array( "<span>...</span>" ) );
				}
				
				if( $current > $nav_range + 1 ){
					array_splice( $nav_links, 1, 0 - $nav_range * 3, array( "<span>...</span>" ) );
				}
				
				echo implode( "", $nav_links );
				
			}
			
		?>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>