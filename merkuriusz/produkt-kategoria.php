<?php
	/* template name: Produkt - kategoria */
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
		<div class="topHeader">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<p id="topHeaderPara1">Merkuriusz - Techiniki nadruków Tarnów</p>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<p id="topHeaderPara2">siedziba firmy: Szpitalna 25B, 33-100 Tarnów</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container" id="top-container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-12 col-12  mb-sm-3 mb-3 mt-2 mt-sm-0">
					<a  href="index.html" title="Merkuriusz" class="logo-block">
					<img src="<?php echo get_template_directory_uri(); ?>/media/logo1.jpg" alt="Merkuriusz logo" id="logo" />
					</a>
				</div>
				<div class="col-lg-9 col-md-6 col-sm-12" id="top-container-search">
					<div class="row">
						<div class="col-lg-7 col-md-12 col-sm-12 mb-sm-3 mb-3">
							<form class="form-inline" method="get" id="search-small-outline">
								<div class="input-group justify-content-md-end justify-content-sm-center">
									<input type="text" class="query-small" placeholder="Wpisz nazwę lub kod produktu">
									<button type="submit" id="searchsubmit-small"> SKUKAJ &nbsp <img src="<?php echo get_template_directory_uri(); ?>/media/search.png" id="Searchimage"> </button> 
								</div>
							</form>
						</div>
						<div class="col-lg-5 col-md-12 col-sm-12 mt-md-2 mt-lg-0">
							<div class=" contact-outline justify-content-sm-center" >
								<div id="contact-img"> 
									<img src="<?php echo get_template_directory_uri(); ?>/media/smartphone.png"> 
								</div>
								<div id="contact-content"> 
									<a href="" id="contact-number"> +48 14 622 33 64 </a> 
									<a href="" id="contact-email"> biuro@merkuriusz.pl</a> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--top header closed--> 
		<div class="main-menu-section main-menu-block">
			<div class="container" >
				<div class="row">
					<div class="col-md-3 visible-xl">
					</div>
					<div class="col-md-12 col-lg-9 col-xl-9">
						<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top" id="navbar-container">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
							</button>                                 
							<span  id="menuglowne"> Menu główne</span>
							<div class="collapse navbar-collapse" id="navbarResponsive">
								<ul class="navbar-nav mr-auto">
									<li class="nav-item active">
										<a class="nav-link" href="#">STRONA GŁÓWNA
										<span class="sr-only">(current)</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">O NAS</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">OFERTA</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">ZNAKOWANIE</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">KALULATOR</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">DRUKARNIA</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">KALENDARZE</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">KONTAKT</a>
									</li>
								</ul>
								<a class="ml-auto search- d-flex">
								<i class=" ion-ios-search-strong"></i>
								</a>
							</div>
						</nav>
						<!-- end of the NAV-->  
					</div>
				</div>
			</div>
		</div>
		<!--===================================end of the main-menu-section===========================================================--> 
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
				<li class="active"><a href="#">Strona Główna</a></li>
				<li><a href="#"> Elektronika </a></li>
				<li><a href="#">Pamięć USB </a></li>
			</ul>
		</div>
		<div class="container category-text-container">
			<h1 id="categoryContainerText1">WYBIERZ KATEGORIE SPOŚRÓD:
				<span id="categoryContainerText2">
					<?php
						if( empty( $subcat ) ){
							echo strtoupper( $cat );
						}
						else{
							printf(
								'%s > %s',
								strtoupper( $cat ),
								strtoupper( $subcat )
							);
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
					<ul class="dropdown-menu list-unstyled" >
						<li role="presentation" id="electronic-dropdown-unorderlist" > <a href="index2.html">Adaptery i huby USB</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Akcesoria do smartfonów i tabletów </a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Dyski twarde</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Głośniki i słuchawki</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1"class="list-group-item">Opakowania USB </a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Pamięć USB</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Pendrive’y Silicon Power</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Pendrive’y VIP</a></li>
						<li role="presentation" id="electronic-dropdown-unorderlist"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Powerbanki</a></li>
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