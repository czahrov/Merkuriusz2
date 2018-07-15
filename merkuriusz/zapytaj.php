<?php
	/* Template name: Zapytaj o produkt */
	get_header();
	
	if( DEV ){
		echo "<!--";
		print_r( $_POST );
		echo "-->";
	}
	
	$fetch = doSQL("SELECT * FROM XML_product WHERE code = '{$_GET['kod']}'");
	$item = $fetch[0];
	$imgs = json_decode( $item['photos'] );
	
	if( !empty( $_POST ) ){
		add_action( 'phpmailer_init', function( PHPMailer $mailer ){
			$mailer->Encoding = 'Base64';
			
		} );
		
		$to = DEV?( "sprytne@scepter.pl" ):( $_POST['email'] );
		$subject = sprintf(
			'%s przesyła zapytanie o produkt %s',
			$_POST['imię'],
			$item['code']
		);
		$message = sprintf(
			'%s
e-mail: %s
telefon: %s
firma: %s
---
Wiadomość:
%s


Wyrażam zgodę na RODO
---
Wiadomość wygenerowana automatycznie na %s',
			$_POST['imię'],
			$_POST['email'],
			$_POST['telefon'],
			$_POST['firma'],
			$_POST['wiadomość'],
			
			home_url()
			
		);
		$headers = array();
		$headers[] = "From: Formularz <noreply@{$_SERVER['HTTP_HOST']}>";
		$headers[] = "Reply-To: {$_POST['imię']} <{$_POST['email']}>";
		$attachments = array();
		
		if( DEV ){
			$res_mail = false;
			// $res_mail = wp_mail( $to, $subject, $message, $headers, $attachments );
		}
		else{
			$res_mail = wp_mail( $to, $subject, $message, $headers, $attachments );
		}
		
	}
	
?>
<body class="ask-page">
	<?php get_template_part('segment/top'); ?>
	<div class="container flex-wrap main-content-section mt-4 mt-lg-0 product-page-dropdown">
		<div class="row">
			<div class="col-md-12 col-lg-3" id="Nav-container">
				<div class="dropdown open show">
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
					<img src="<?php echo get_template_directory_uri(); ?>/media/menubar.png">&nbsp
					<span>NASZE PRODUKTY </span>
					</button>
					<?php genMenu(); ?>
				</div>
			</div>
			<div class="col content-block">
				<div class="category-third-container">
					<?php get_template_part('segment/breadcrumb'); ?>
				</div>
				<?php if( isset( $res_mail ) ): ?>
				<div class='mail <?php echo $res_mail === true?("ok"):("fail"); ?>'>
					<?php echo $res_mail === true?( "mail wysłany pomyślnie" ):( "wysyłka maila nie powiodła się" ); ?>
				</div>
				<?php endif; ?>
				<!-- product info -->
				<div class='details d-flex align-items-start flex-wrap'>
					<?php
						if( DEV ){
							echo "<!--";
							print_r( $item );
							echo "-->";
						}
					?>
					<div class='img col-12 col-md-6' style='background-image:url(<?php echo $imgs[0]; ?>);'></div>
					<div class='infos col flex-column'>
						<div class='info d-flex'>
							<div class='col'>
								Kod produktu
							</div>
							<div class='col'>
								<?php echo $item['code']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Cena netto
							</div>
							<div class='col'>
								<?php printf( '%.2f %s', $item['netto'], $item['currency'] ); ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Stan magazynowy
							</div>
							<div class='col'>
								<?php echo $item['instock'] . " szt"; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Materiał
							</div>
							<div class='col'>
								<?php echo $item['materials']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Kolor(y)
							</div>
							<div class='col'>
								<?php echo $item['colors']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Wymiary
							</div>
							<div class='col'>
								<?php echo $item['dimension']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Waga [g]
							</div>
							<div class='col'>
								<?php echo $item['weight']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Znakowanie
							</div>
							<div class='col'>
								<?php echo $item['marking']; ?>
							</div>
						</div>
						<div class='info d-flex'>
							<div class='col'>
								Kraj pochodzenia
							</div>
							<div class='col'>
								<?php echo $item['country']; ?>
							</div>
						</div>
						
					</div>
				</div>
				<!-- product form -->
				<form id='ask-form' class='d-flex flex-wrap' method='post'>
					<div class='cell col-12 col-md-6'>
						<input class='' type='text' name='imię' placeholder='Imię, Nazwisko' title='Imię, Nazwisko' required>
					</div>
					<div class='cell col-12 col-md-6'>
						<input class='' type='email' name='email' placeholder='Email' pattern='^[^@]+@[^\.]+\..+$' title='Adres e-mail w formacie: [użytkownik]@[domena] np: jan@kowalski.pl' required>
					</div>
					<div class='cell col-12 col-md-6'>
						<input class='' type='tel' name='telefon' placeholder='Numer telefonu' pattern='^\+?(\d+[ \-]*)+$' title='Numer telefonu: cyfry, myślniki i spacje'>
					</div>
					<div class='cell col-12 col-md-6'>
						<input class='' type='text' name='firma' placeholder='Nazwa firmy' title='Nazwa firmy'>
					</div>
					<div class='cell col-12'>
						<textarea class='col-12' name='wiadomość' placeholder='Wiadomość' required></textarea>
					</div>
					<div class='col-12'>
						<input id='rodo' type='checkbox' name='RODO' required>
						<label for='rodo'>
							Zgoda na RODO
						</label>
					</div>
					<div class='col'>
						<input class='send' type='submit' value='Wyślij wiadomość'>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	<!--===================================end of the main-content-section===========================================================--> 
	<!-- =================================footer begins================================================================-->
	
<?php get_footer(); ?>