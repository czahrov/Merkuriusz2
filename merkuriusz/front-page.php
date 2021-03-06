<?php get_header(); ?>
	<body class="home-page">
		<?php get_template_part('segment/top'); ?>
		<div class="main-content-section mt-4 mt-lg-0 home-page-sub-menu">
			<div class="container">
				<div class="row">
					<?php get_template_part('segment/shop-menu'); ?>
					<div class="col-12 content-block">
						<?php get_template_part('segment/top-slider'); ?>
						<!-- end of the carousel-->
						<?php get_template_part('segment/top-brands'); ?>
						<!-- end of the second continer-->
						<?php get_template_part('segment/najnowsze'); ?>
					</div>
				</div>
			</div>
		</div>
		<!--===================================- /sixth container --=============================================== -->
		<?php //get_template_part('segment/vip-elektronika'); ?>
		<?php get_template_part('segment/pdf-slider'); ?>
		<div class="container reklama-container">
			<div class="col-lg-12 footer-container" style="margin-top:40px;">
				<h1 id="thirdContainerText1">REKLAMA <span id="thirdContainerText2"> 360 stopni dla Twojej firmy </span></h1>
			</div>
		</div>
		<div class="banners-block container" id="banners-block" style="margin-top:40px;">
			<div class="row" id="banners-row" >
				<div class="zoom-banner even">
					<a class='hitbox' href='<?php echo home_url('oferta'); ?>'></a>
					<div class="col-lg-6 col-sm-12 col-12 each-banner-section item">
						<div id="relativeimage" >
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner1.png" alt=""/> 
						</div>
						<div id="absolutetext">Identyfikacja wizualna</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner odd">
					<a class='hitbox' href='<?php echo home_url('oferta'); ?>'></a>
					<div class="col-lg-6 col-sm-12 each-banner-section item">
						<div id="relativeimage" > 
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner2.png" alt=""/>
						</div>
						<div id="absolutetext">Reklama wizualna</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner even">
					<a class='hitbox' href='<?php echo home_url('oferta'); ?>'></a>
					<div class="col-lg-6 col-sm-12 each-banner-section item">
						<div id="relativeimage" >   
							<img class="img-responsive img-center" src="<?php echo get_template_directory_uri(); ?>/media/sub-banner3.png" alt=""/>
						</div>
						<div id="absolutetext">Techniki nadrkow</div>
						<div class="item-overlay top"></div>
					</div>
				</div>
				<div class="zoom-banner odd">
					<a class='hitbox' href='<?php echo home_url('oferta'); ?>'></a>
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
		<div id='newsletter' class="container subscribe-container">
			<div class="col-lg-12 footer-container" style="margin-top:40px;">
				<h1 id="thirdContainerText1">OTRZYMUJ<span id="thirdContainerText2"> Najświeższe informacje </span></h1>
			</div>
			<form class="subscribe-section col-lg-12 text-center">
				<p>Zapisz sie do naszego newslettera</p>
				<input class='mail' name='mail' type="mail" placeholder="Wpisz swoj adres e-mail" required>
				<div class='zgoda d-flex align-items-center justify-content-start'>
					<input type="checkbox" id="rodo" required>
					<label for="rodo">
						Wyrażam zgodę na przesyłanie informacji handlowych za pomocą środków komunikacji elektronicznej w rozumieniu ustawy z dnia 18 lipca 2002 roku o świadczenie usług drogą elektroniczną (Dz.U.2017.1219 t.j.) na podany adres e-mail na temat usług oferowanych przez Merkuriusz - Techiniki nadruków Tarnów przy ul. Szpitalna 25B, 33-100 Tarnów z siedzibą w Tarnowie. Zgoda jest dobrowolna i może być w każdej chwili wycofana, z formularza rejestracyjnego na stronie internetowej. Wycofanie zgody nie wpływa na zgodność z prawem przetwarzania, którego dokonano na podstawie zgody przez jej wycofaniem.
					</label>
				</div>
				<button type="submit" class='send' >Zapisz sie</button>
				<div class='status pointer base1 flex flex-items-center flex-wrap flex-justify-center'>
					<div class='icons flex'>
						<div class='icon pass font-green-light fa fa-check-circle'></div>
						<div class='icon info font-light fa fa-info-circle'></div>
						<div class='icon fail font-pink fa fa-times-circle'></div>
						
					</div>
					<div class='msg font-light'></div>
					
				</div>
				
			</form>
		</div>
		<!--======================= subscribe-container closed =========================-->
		<!-- ================================= footer begins ================================================================-->
<?php get_footer(); ?>