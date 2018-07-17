<?php get_header(); ?>
	<body class="home-page">
		<?php get_template_part('segment/top'); ?>
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
						<?php get_template_part('segment/najnowsze'); ?>
					</div>
				</div>
			</div>
		</div>
		<!--===================================- /sixth container --=============================================== -->
		<?php get_template_part('segment/vip-elektronika'); ?>
		<?php get_template_part('segment/pdf-slider'); ?>
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
			<form class="subscribe-section col-lg-12 text-center">
				<p>Zapisz sie do naszego newslettera</p>
				<input type="mail" placeholder="Wpisz swoj adres e-mail" required>
				<div class='zgoda d-flex align-items-center justify-content-start'>
					<input type="checkbox" id="rodo" required>
					<label for="rodo">
						Akceptacja RODO
					</label>
				</div>
				<button type="submit" >Zapisz sie</button>
				
			</form>
		</div>
		<!--======================= subscribe-container closed =========================-->
		<!-- =================================footer begins================================================================-->
<?php get_footer(); ?>