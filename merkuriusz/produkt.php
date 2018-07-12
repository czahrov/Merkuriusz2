<?php
	/* template name: Produkt - pojedynczy */
	get_header();
?>

<body class="product-page">
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
	<div class="container flex-wrap main-content-section mt-4 mt-lg-0 product-page-dropdown">
		<div class="row">
			<div class="col-md-12 col-lg-3" id="Nav-container">
				<div class="dropdown open show">
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
					<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp <span>NASZE PRODUKTY </span>
					</button>
					<ul class="dropdown-menu list-unstyled" >
						<li role="presentation"> <a href="index2.html" role="menuitem" tabindex="-1" class="list-group-item">Biuro i biznes</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Czas i pogoda</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Do picia</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Dom i Ogród</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1"class="list-group-item">Dzieci i zabawa</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Elektronika</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Materiały piśmiennicze</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Narzędzia, latarki, breloki</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Odblaski</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Parasole i peleryny</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1"class="list-group-item">Torby i plecaki</a></li>
						<li role="presentation" class="vip-menu-block">
							<a role="menuitem" tabindex="-1" class="list-group-item"> VIP Collections</a>
							<ul class="vip-menu d-flex" >
								<ul class="d-flex flex-column">
									<li id="vip-elements">Balaupunkt</li>
									<li id="vip-elements">Creative</li>
									<li id="vip-elements">Huawei</li>
								</ul>
								<ul class="d-flex flex-column">
									<li id="vip-elements">JBL</li>
									<li id="vip-elements">Xiaomi</li>
									<li id="vip-elements">Samsung</li>
								</ul>
								<ul class="d-flex flex-column">
									<li id="vip-elements">Inne</li>
									<li id="vip-elements">Wszystkie kategorie</li>
								</ul>
							</ul>
						</li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Wakacje, sport i rekreacja</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Zakreślacze</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Zdrowie i uroda</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Święta i okazje specjalne</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Odzież reklamowa</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1"  class="list-group-item">Nagrody i trofea</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Opakowania</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Pinsy, plakietki, odznaki</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Breloki akrylowe</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Sublimacja - drukuj na kolorowo</a></li>
						<li role="presentation"><a href="#" role="menuitem" tabindex="-1" class="list-group-item">Inne produkty</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-12 col-lg-9 content-block">
				<div class="category-third-container">
					<ul class="breadcrumb">
						<li class="active"><a href="#">Elektronika</a></li>
						<li><a href="#"> Power Bank</a></li>
						<li><a href="#">Power bank 2200mAh, wskaźnik laserowy </a></li>
					</ul>
				</div>
				<div class="category-product-title" >
					<p>Power bank 2200mAh, wskaźnik laserowy </p>
				</div>
				<div class="container category-single-product">
					<div class="row">
						<div class="col-md-6 single-product-info">
							<div class="product-page-main-banner-desktop">
								<div class="single-product-image">
									<div class="single-product-arrows"> 
										<a  id="single-productarrow-back"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-back.png" alt=""/> </a>
										<a id="single-productarrow-forward"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-forward.png" alt=""/> </a>
									</div>
								</div>
							</div>
							<div class="product-page-main-banner-mobile">
								<div class="product-page-main-banner-mobile-slider">
									<div class="item single-product-image">
									</div>
									<div class="item single-product-image">
									</div>
									<div class="item single-product-image">
									</div>
									<div class="item single-product-image">
									</div>
								</div>
								<div class="single-product-arrows"> 
									<a id="single-productarrow-back"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-back.png" alt=""/> </a>
									<a id="single-productarrow-forward"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-forward.png" alt=""/> </a>
								</div>
							</div>
							<div class="single-product-gallery">
								<div class="row">
									<div class="col-md-4">
										<div id="single-product-img1"> </div>
									</div>
									<div class="col-md-4">
										<div id="single-product-img1"> </div>
									</div>
									<div class="col-md-4" >
										<div id="single-product-img1"> </div>
									</div>
								</div>
							</div>
							<div class="product-small-imge-slider-arrows">
								<div class="product-small-images-slider">
									<div class="item">
										<div id="single-product-img1"> </div>
									</div>
									<div class="item">
										<div id="single-product-img1"> </div>
									</div>
									<div class="item" >
										<div id="single-product-img1"> </div>
									</div>
								</div>
								<a  id="single-productarrow-back" class="single-productarrow"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-back.png" alt=""/> </a>
								<a id="single-productarrow-forward" class="single-productarrow"> <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/productarrow-forward.png" alt=""/> </a>
							</div>
						</div>
						<div class="col-md-6 category-single-product-description">
							<div class="product-price-details">
								<p> Cena katalogowa: 42 zł </p>
								<h3> Cena już od <span>31.20 zł netto </span></h3>
							</div>
							<div class="product-size-details">
								<p>Kod: T311105</p>
								<p>Kolory:	Biały, niebieski</p>
								<p>Rozmiar: 37,5 x 22 x 10 cm</p>
								<p>Grupa znakowania:	TT2 (Termotransfer)</p>
							</div>
							<div class="product-enquiry-details">
								<button type="submit">wyślij zapytanie</button>
							</div>
							<div class="flex-wrap product-contact-details">
								<div id="product-contact-img"> 
									<img src="<?php echo get_template_directory_uri(); ?>/media/smartphone.png"> 
								</div>
								<div id="product-contact-content"> 
									<a href="" id="contact-number"> +48 14 622 33 64 </a> 
									<a href="" id="contact-email"> biuro@merkuriusz.pl</a> 
								</div>
								<div class="product-social-contacts ">
									<p> Udostępnij znajomemu </p>
									<a href="#"> <img src="<?php echo get_template_directory_uri(); ?>/media/social-contact-image.png"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="category-product-text">
					<p>  Lorem ipsum dolor sit amet, an munere tibique consequat mel, congue albucius no qui, at everti meliore erroribus sea. Vero graeco cotidieque ea duo, in eirmod insolens interpretaris nam. Pro at nostrud percipit definitiones, eu tale porro cum. Sea ne accusata voluptatibus. Ne cum falli dolor voluptua, duo ei sonet choro facilisis, labores officiis torquatos cum ei. </p>
				</div>
				<div class="category-availability">
					<a href="#">
						<h3> Dostępność w magazynie: <span> 3120 szt.</span> </h3>
					</a>
				</div>
				<div class="similar-products-title">
					<h3><span>PODOBNE</span> PRODUKTY</h3>
				</div>
				<div class="fourth-container similar-products-container">
					<div class="row" id="fourth-container-content">
						<div class="single-item col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
							<div class="card h-100 d-flex">
								<a href="produkt-single.html">
									<div class="card-img" style="background-image: url( <?php echo get_template_directory_uri(); ?>/media/umbrella.png );">
									</div>
									<div class="card-body d-flex flex-column">
										<div class="hover-element-shop">
								<a href="">wyślij zapytanie</a></div>
								<h4 class="card-title grow ">
								<a href="#">Parasol manualny Hurricane, 23’’</a>
								</h4>
								<div class="price">
								<h5>123 zł</h5>  
								</div>
								<a href="" class="button-show-item">Zobacz</a>
								</div>
							</div>
						</div>
						<!-- /.single item -->
						<div class="single-item col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
							<div class="card h-100 d-flex">
								<a href="#">
									<div class="card-img" style="background-image: url( <?php echo get_template_directory_uri(); ?>/media/torchlite.png );">
								</a>
								<div class="icon">
								<span class="fa fa-search-plus"></span>
								</div>
								</div>
								<div class="card-body d-flex flex-column">
									<div class="hover-element-shop"><a href="">wyślij zapytanie</a></div>
									<h4 class="card-title grow ">
										<a href="#">Latarka kieszonkowa17 LED, pasek na rękę</a>
									</h4>
									<div class="price">
										<h5>31 zł</h5>
									</div>
									<a href="" class="button-show-item">Zobacz</a>
								</div>
							</div>
						</div>
						<!-- /.single item -->
						<div class="single-item col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
							<div class="card h-100 d-flex">
								<a href="#">
									<div class="card-img" style="background-image: url( <?php echo get_template_directory_uri(); ?>/media/pen.png );">
										<div class="icon">
											<span class="fa fa-search-plus"></span>
										</div>
									</div>
									<div class="card-body d-flex flex-column">
										<div class="hover-element-shop">
								<a href="">wyślij zapytanie</a></div>
								<h4 class="card-title grow ">
								<a href="#">Bambusowy długopis w Etui</a>
								</h4>
								<div class="price">
								<h5>42 zł</h5>  
								</div>
								<a href="" class="button-show-item">Zobacz</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.single item -->
			</div>
		</div>
	</div>
	<!--===================================end of the main-content-section===========================================================--> 
	<!-- =================================footer begins================================================================-->
	
<?php get_footer(); ?>