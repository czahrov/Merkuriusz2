		<div class="container">
			<div class="col-lg-12 footer-container">
				<h1 id="thirdContainerText1">MASZ PYTANIA?<span id="thirdContainerText2"> Skontaktuj się z nami </span></h1>
			</div>
			<div class="container  footer-contact-details">
				<div class="row">
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="arrow-circle2">
							<img src="<?php echo get_template_directory_uri(); ?>/media/phonecall.png">
						</div>
						<p id="footer-contact">
							<span id="Contact-details">Tel / Fax:</span> +48 14 622 33 64
						</p>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="arrow-circle2">
							<img src="<?php echo get_template_directory_uri(); ?>/media/mail.png">
						</div>
						<p id="footer-contact">
							<span id="Contact-details"> E-mail:</span> biuro@merkuriusz.pl 
						</p>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="arrow-circle2">
							<img src="<?php echo get_template_directory_uri(); ?>/media/location.png" style="padding:8px 12px;">
						</div>
						<p id="footer-contact">
							<span id="Contact-details">Adres:</span> Szpitalna 25B, 33-100 Tarnów 
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-12 footer-container">
				<h1 id="thirdContainerText1">WSPOŁPRACUJEMY<span id="thirdContainerText2"> z najlepszymi markami </span></h1>
			</div>
		</div>
		<!--=======================end of the footer-contact-details container=========================-->
		<div class="container footer-slider-block">
			<div class="row footer-slider-width">
				<div id="owl-demo" class="owl-carousel owl-theme">
					<?php
						$slides = get_pages( array(
							'parent' => get_page_by_path('specjalne/slider-w-stopce')->ID,
							
						) );
						
						if( DEV ){
							echo "<!--";
							print_r( $slides );
							echo "-->";
						}
						
						foreach( $slides as $slide ):
					?>
					<div class="item">
						<img src="<?php echo wp_get_attachment_image_url( get_post_meta( $slide->ID, 'grafika', true ), 'medium' ); ?>">
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="arrow-circle left prev">
				<img src="<?php echo get_template_directory_uri(); ?>/media/blackarrowleft.png">
			</div>
			<div class="arrow-circle right next">
				<img src="<?php echo get_template_directory_uri(); ?>/media/blackarrow-right.png">
			</div>
		</div>
		<!--=======================end of the footer-slider-block container=========================-->
		<div class="footer-details">
			<div class="container">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<p class="footer-info">
								Jesteśmy pasjonatami projektowania unikalnych rozwiązań i mozemy zaoferować specjalistyczną wiedzę i doświadczenie. Jesteśmy pewni, że znejdziesz to, czego szukasz. Praktyczne, eleganckie i trwałe artykuły promocyjne, mogą kreować 
								wizerunek marki oraz przekazywać czytelne komunikaty lud wiadomości do 
								wszystkich Twoich odbiorców.
							</p>
							<a class="logo" href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/media/footerlogo.png">
							</a>
						</div>
						<div class=" col-md-3 footer-shortcuts">
							<span id="shortcuts">NA SKRÓTY </span>
							<?php
								$menu = wp_get_nav_menu_items('na-skroty');
								foreach( $menu as $item ){
									printf(
										'<div class="footer-elements">
											<a href="%s">
												%s
											</a>
										</div>',
										$item->url,
										$item->title
									);
									
								}
								
							?>
							
						</div>
						<div class=" col-md-3  footer-INFORMACJE">
							<span id="INFORMACJE">
								INFORMACJE
							</span>
							<?php
								$menu = wp_get_nav_menu_items('informacje');
								foreach( $menu as $item ){
									printf(
										'<div class="footer-elements">
											<a href="%s">
												%s
											</a>
										</div>',
										$item->url,
										$item->title
									);
									
								}
								
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--=======================end of the footer-details container=========================-->
		<div class="container copyright-details">
			<div class="row">
				<div class="col-md-6" >
					<p id="copyright1">Copyright Merkuriusz 2018 </p>
				</div>
				<div class="col-md-6">
					<p id="copyright2"> Project i wykonanie : 
						<a href='http://www.scepter.pl'>
							Scepter Agencja interaktywna
						</a>
					</p>
				</div>
			</div>
		</div>
		<!--=======================end of the copyright-details container=========================-->
		<?php wp_footer(); ?>
	</body>
</html>