<?php
	get_header();
	$word = $_GET['s'];
	$orderby = empty($s = $_GET['według'])?( 'ID' ):( $s );
	$order = empty( $s = $_GET['sortuj'] )?( 'DESC' ):( $s );
	$fetch = doSQL("SELECT * FROM XML_product WHERE
	code LIKE '%{$word}%'
	OR title LIKE '%{$word}%'
	ORDER BY {$orderby} {$order}
	");
	$strona = max( 1, (int)$_GET['strona'] );
	$perpage = 16;
	$pages = array_chunk( $fetch, $perpage );
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
										printf(
											'%.2f %s',
											$item['netto'],
											$item['currency']
										);
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