<?php get_header(); ?>
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
		<!-- end of the main-menu-section--> 
		<div class="main-content-section mt-4 mt-lg-0 home-page-sub-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-3" id="Nav-container">
						<div class="dropdown open show">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
							<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png"> &nbsp <span>NASZE PRODUKTY </span>
							</button>
							<?php genMenu(); ?>
						</div>
					</div>
					<div class="col-md-12 col-lg-9 content-block">
						<div class="carousel slide" id="demo" data-ride="carousel">
							<div class="carousel-inner all-gap">
								<div class="carousel-item active">
									<img src="<?php echo get_template_directory_uri(); ?>/media/slider1.jpg" alt="slider1" >
									<div class="carousel-caption">
										<h1 class="carousel-head1"> GADZETY SKÓRZANE </h1>
										<h1 class="carousel-head2"> Z TWOIM LOGO </h1>
									</div>
								</div>
								<div class="carousel-item">
									<img src="<?php echo get_template_directory_uri(); ?>/media/slider1.jpg" alt="slider1">
								</div>
								<div class="carousel-item">
									<img src="<?php echo get_template_directory_uri(); ?>/media/slider1.jpg" alt="slider1">
								</div>
							</div>
							<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<div class="arrow-circle">
									<img src="<?php echo get_template_directory_uri(); ?>/media/arrow-left.png">
								</div>
							</a>
							<a class="carousel-control-next" href="#demo" data-slide="next">
								<div class="arrow-circle">
									<img src="<?php echo get_template_directory_uri(); ?>/media/arrow-right.png">
								</div>
							</a>
						</div>
						<!-- end of the carousel-->
						<div class="top-brands-block SecondContainer all-gap" id="top-brands-block">
							<a href="#" class="zoom-banner mt-3 mt-sm-0">
								<div class="col-md-4 top-brands-img">
									<img src="<?php echo get_template_directory_uri(); ?>/media/vip-banner1.png" alt=""/>
									<div class="circletext1"> Be Creative</div>
									<div class="circletext2"> - stwórz swój gadżet </div>
									<div class="arrow-circle">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-rightarrow.png">
									</div>
								</div>
							</a>
							<a href="#" class="zoom-banner mt-3 mt-sm-0" >
								<div class="col-md-4 top-brands-img">
									<img src="<?php echo get_template_directory_uri(); ?>/media/vip-banner2.png" alt=""/>
									<div class="watchtext1"> Vip Collection </div>
									<div class="watchtext2">- ekskluzywne gadżety </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">
									</div>
								</div>
							</a>
							<a href="#" class="zoom-banner mt-3 mt-sm-3 mt-md-0">
								<div class="col-md-4 top-brands-img">
									<img src="<?php echo get_template_directory_uri(); ?>/media/vip-banner3.png" alt=""/>
									<div class="odzieztext1"> Odzież reklamowa </div>
									<div class="odzieztext2"> - dla każdego </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">
									</div>
								</div>
							</a>
						</div>
						<!-- end of the second continer-->
						<div class="col-lg-12 third-container all-gap">
							<h1 id="thirdContainerText1">NAJNOWSZE <span id="thirdContainerText2"> 360 stopni dla Twojej firmy </span></h1>
						</div>
						<div class="fourth-container">
							<div class="row" id="fourth-container-content">
								<div class="product-slider" id="product-slider">
									<div class="single-item item">
										<div class="card h-100 d-flex">
											<a href="produkt-single.html">
												<div class="card-img" style="background-image: url( <?php echo get_template_directory_uri(); ?>/media/umbrella.png );"></div>
												<div class="card-body d-flex flex-column">
													<div class="hover-element-shop">
												<a href="">wyślij zapytanie</a>
											</div>
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
									<div class="single-item item">
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
													<a href="#">Latarka kieszonkowa17 LED, pasek na</a>
												</h4>
												<div class="price">
													<h5>31 zł</h5>
												</div>
												<a href="" class="button-show-item">Zobacz</a>
											</div>
										</div>
									</div>
									<!-- /.single item -->
									<div class="single-item item">
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
									<!-- /.single item -->
									<div class="single-item item">
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
									<div class="single-item item">
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
									<div class="single-item item">
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
								<div class="fifth-container">
									<div class="arrow-circle prev"><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png"></div>
									<div class="arrow-circle next"><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png"></div>
								</div>
							</div>
						</div>
						<!-- ======================end of the fifth container ==================-->
					</div>
				</div>
			</div>
		</div>
		<div class=" container col-lg-12 sixth-container all-gap">
			<div class="row">
				<div class="col-md-3 col-sm-12 mb-3 mb-md-0 sixth-container-text">
					<div class="small-container">
						<p>Strefa dla najbardziej </p>
						<a href="#"> wymagających</a>
					</div>
				</div>
				<div class="col-md-9 col-sm-12">
					<div class="row">
						<div class="col-md-4 col-sm-12 mb-3 mb-md-0">
							<img src="<?php echo get_template_directory_uri(); ?>/media/boss.png" alt="boss" id="bossImage">
						</div>
						<div class="col-md-4 col-sm-12 mb-3 mb-md-0">
							<img src="<?php echo get_template_directory_uri(); ?>/media/cerruti.png" alt="Cerruti" id="bossImage">
						</div>
						<div class="col-md-4 col-sm-12 mb-3 mb-md-0">
							<img src="<?php echo get_template_directory_uri(); ?>/media/victorinox.png" alt="Victorinox" id="bossImage">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--===================================- /sixth container --=============================================== -->
		<div class="container">
			<div class="products-block">
				<div class="row">
					<div class="col-md-6 col-lg-3 col-sm-12 menu-section mb-3 mb-md-0">
						<ul class="list-unstyled">
							<li class="active"><span class="green-bar"><span style="font-weight:600;">VIP</span> ELEKTRONIKA</span></li>
							<li><span class="green-bar">Balaupunkt</span></li>
							<li><span class="green-bar">Creative</span></li>
							<li><span class="green-bar">Huawei</span></li>
							<li><span class="green-bar">JBL</span></li>
							<li><span class="green-bar">Xiaomi</span></li>
							<li><span class="green-bar">Samsung</span></li>
							<li><span class="green-bar">Inne</span></li>
							<li><span class="green-bar">Wszystkie kategorie</span></li>
						</ul>
					</div>
					<div  class="col-md-6 col-lg-3 col-sm-12 banner-section" >
						<a href="#">
							<div id="womanimage" class="h-100"> <img class="h-100" src="<?php echo get_template_directory_uri(); ?>/media/vip-electronika.png" alt="woman"/></div>
							<div class="womantext1"> Elektronika </div>
							<div class="womantext2"> - Dla każdego </div>
							<div class="arrow-circle1">
								<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png"> 
						</a>
						</div>
					</div>
					<div class="col-md-12 col-lg-6 col-sm-12 avialable-product-section">
						<div class="avialable-product-slider">
							<div class="available-each">
								<div class="product-each-block">
									<div class="row">
										<div class="col-md-4 avialable-product-img text-center"><img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/product1.png" alt=""/></div>
										<div class="col-md-4 product-tittle">Okulary VR 360&#730;</div>
										<div class="col-md-4 product-price">64.30 Zl</div>
										<button type="submit">zobacz</button>
									</div>
								</div>
								<div class=" product-each-block">
									<div class="row">
										<div class="col-md-4 avialable-product-img text-center"><img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/product.png" alt=""/></div>
										<div class="col-md-4 product-tittle">Okulary VR B01 ACME</div>
										<div class="col-md-4 product-price">53.43 Zl</div>
										<button type="submit">zobacz</button>
									</div>
								</div>
							</div>
							<div class="available-each">
								<div class="product-each-block">
									<div class="row">
										<div class="col-md-4 avialable-product-img text-center"><img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/product1.png" alt=""/></div>
										<div class="col-md-4 product-tittle">Okulary VR 360&#730;</div>
										<div class="col-md-4 product-price">64.30 Zl</div>
										<button type="submit">zobacz</button>
									</div>
								</div>
								<div class=" product-each-block">
									<div class="row">
										<div class="col-md-4 avialable-product-img text-center"><img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/product.png" alt=""/></div>
										<div class="col-md-4 product-tittle">Okulary VR B01 ACME</div>
										<div class="col-md-4 product-price">53.43 Zl</div>
										<button type="submit">zobacz</button>
									</div>
								</div>
							</div>
						</div>
						<div class="controls col-md-12 arrows-product-section">
							<div class="arrow-circle right"> <a  ><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png"> </a></div>
							<div class="arrow-circle left"> <a ><img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png"> </a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ======================end of the product block container ==================-->
		<div class="container category-blocks">
			<div class="row">
				<div id="category-item-slider">
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="category-inner-content">
							<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
							<div id="absoluteborder">
								<div class="watchtext1"> Dtugopisy </div>
								<div class="watchtext2"> metalowe  </div>
								<div class="arrow-circle1">
									<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="category-inner-content">
							<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
							<div id="absoluteborder">
								<div class="watchtext1"> Dtugopisy </div>
								<div class="watchtext2"> metalowe  </div>
								<div class="arrow-circle1">
									<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
						<div class="item each-category-blocks mb-sm-3 mb-3 mb-md-0 h-100">
							<div class="category-inner-content">
								<div class="category-blocks-img">   <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/media/metalowe.png" alt=""/> </div>
								<div id="absoluteborder">
									<div class="watchtext1"> Dtugopisy </div>
									<div class="watchtext2"> metalowe  </div>
									<div class="arrow-circle1">
										<img src="<?php echo get_template_directory_uri(); ?>/media/banner-whiterightarrow.png">  
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 fifth-container text-center" style="margin-top:40px;">
				<div class="arrow-circle prev"> <img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png"></div>
				<div class="arrow-circle next"> <img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png"></div>
			</div>
		</div>
		<!-- ======================end of the category block container ==================-->
		<div class="container reklama-container">
			<div class="col-lg-12 footer-container" style="margin-top:40px;">
				<h1 id="thirdContainerText1">REKLAMA <span id="thirdContainerText2"> 360 stopni dla Twojej firmy </span></h1>
			</div>
		</div>
		<div class="banners-block container" id="banners-block" style="margin-top:40px;">
			<div class="row" id="banners-row" >
				<div class="zoom-banner even">
					<div class="col-lg-6 col-sm-12 col-12 each-banner-section item">
						<div id="relativeimage" >
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner1.png" alt=""/> 
						</div>
						<div id="absolutetext">Identyfikacja wizualna</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner odd">
					<div class="col-lg-6 col-sm-12 each-banner-section item">
						<div id="relativeimage" > 
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner2.png" alt=""/>
						</div>
						<div id="absolutetext">Reklama wizualna</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner even">
					<div class="col-lg-6 col-sm-12 each-banner-section item">
						<div id="relativeimage" >   
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner3.png" alt=""/>
						</div>
						<div id="absolutetext">Techniki nadrkow</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner odd">
					<div class="col-lg-6 col-sm-12 each-banner-section item">
						<div id="relativeimage" > 
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner4.png" alt=""/>
						</div>
						<div id="absolutetext">Gadzety reklamowe</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- ======================end of the reklama-container  ==================-->
		<div class="container subscribe-container">
			<div class="col-lg-12 footer-container" style="margin-top:40px;">
				<h1 id="thirdContainerText1">OTRZYMUJ<span id="thirdContainerText2"> Najświeższe informacje </span></h1>
			</div>
			<div class=" col-lg-12 subscribe-section text-center">
				<p>Zapisz sie do naszego newslettera</p>
				<input type="text" placeholder="Wpisz swoj adres e-mail">
				<button type="submit" >Zapisz sie</button>
			</div>
		</div>
		<!--======================= subscribe-container closed =========================-->
		<!-- =================================footer begins================================================================-->
<?php get_footer(); ?>