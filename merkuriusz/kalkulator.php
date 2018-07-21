<?php
	/* template name: Kalkulator */	
	// if( $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest" ){
	if( 1 == 1 ){
		$types = array(
			'TT1' => array(
				'name' => 'Termotransfer1',
				'dscr' => 'Mały nadruk na tekstyliach, nadruk od 1 sztuki. Maksymalny dopuszczalny rozmiar wynosi  do 150 cm2 - np. koszulki, czapeczki, torby, kamizelki, parasole itp.',
			),
			'TT2' => array(
				'name' => 'Termotransfer2',
				'dscr' => 'Duży nadruk na tekstyliach, nadruk od 1 sztuki. Maksymalny dopuszczalny rozmiar wynosi  od 150 cm2 - np. koszulki, czapeczki, torby, kamizelki, parasole itp.',
			),
			'S1' => array(
				'name' => 'Sitodruk1',
				'dscr' => 'Mały nadruk na tekstyliach. Maksymalny dopuszczalny rozmiar wynosi do 150 cm2 - np. koszulki, czapeczki, torby, kamizelki, parasole itp.',
			),
			'S2' => array(
				'name' => 'Sitodruk2',
				'dscr' => 'Duży nadruk na tekstyliach. Maksymalny dopuszczalny rozmiar wynosi od  150 cm2 - np. koszulki, czapeczki, torby, kamizelki, parasole itp.',
			),
			'S3' => array(
				'name' => 'Sitodruk3',
				'dscr' => 'Nadruk na reklamówkach, torbach papierowych i bawełnianych',
			),
			'T1' => array(
				'name' => 'Tampodruk1',
				'dscr' => 'Nadruk na małych gadżetach poręcznych (plastikowe: długopisy, zapalniczki, breloki itp.)',
			),
			'T2' => array(
				'name' => 'Tampodruk2',
				'dscr' => 'Nadruk na małych gadżetach nieporęcznych (plastikowe: np. latarki, klipsy, miarki itp.)',
			),
			'T3' => array(
				'name' => 'Tampodruk3',
				'dscr' => 'Nadruk na dużych gadżetach poręcznych (plastikowe: np. kalkulatory, stojaki na biurko) + metalowe małe (np. długopisy, breloki)',
			),
			'T4' => array(
				'name' => 'Tampodruk4',
				'dscr' => 'Nadruk na dużych gadżetach nieporęcznych (plastikowe: np. zegary, skrzynki itp.)',
			),
			'L1' => array(
				'name' => 'Grawer laserowy1',
				'dscr' => 'Usługi grawerowania na długopisach metalowych',
			),
			'L2' => array(
				'name' => 'Grawer laserowy2',
				'dscr' => 'Usługi grawerowania na produktach małych (np. breloki,latarki,scyzoryki itp.)',
			),
			'L3' => array(
				'name' => 'Grawer laserowy3',
				'dscr' => 'Usługi grawerowania na produktach dużych (np. kalkulatory, kubki termiczne, notesy itp.)',
			),
			'CO2' => array(
				'name' => 'Grawer CO2',
				'dscr' => 'Grawer do 20 cm2 na produktach wykonanych z drewna, plastiku, skórzanych, tworzywach, porcelanie, szkle itp.',
			),
			'UV10' => array(
				'name' => 'Nadruk cmyk na przedmiotach białych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) drobne przedmioty o wymiarach do 25cm2',
			),
			'UV10+P' => array(
				'name' => 'Nadruk cmyk + poddruk biały na przedmiotach kolorowych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) drobne przedmioty o wymiarach do 25cm2',
			),
			'UV25' => array(
				'name' => 'Nadruk cmyk na przedmiotach białych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) średnie przedmioty o wymiarach do 70m2',
			),
			'UV25+P' => array(
				'name' => 'Nadruk cmyk + poddruk biały na przedmiotach kolorowych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) średnie przedmioty o wymiarach do 70m2',
			),
			'UV25D' => array(
				'name' => 'Nadruk cmyk na przedmiotach białych',
				'dscr' => '(druk cyfrowy bezpośredni) duże przedmioty o wymiarach do 600m2',
			),
			'UV25D+P' => array(
				'name' => 'Nadruk cmyk + poddruk biały na przedmiotach kolorowych',
				'dscr' => '(druk cyfrowy bezpośredni) duże przedmioty o wymiarach do 600m2',
			),
			'UVA3' => array(
				'name' => 'Nadruk cmyk na przedmiotach białych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) wydruki arkuszowe a3 - bez kosztów materiału',
			),
			'UVA3+P' => array(
				'name' => 'Nadruk cmyk + poddruk biały na przedmiotach kolorowych',
				'dscr' => 'Nadruki UV FULL COLOR (druk cyfrowy bezpośredni) wydruki arkuszowe a3 - bez kosztów materiału',
			),
			'K1' => array(
				'name' => 'Kalendarze1',
				'dscr' => 'Nadruki na kalendarzach (oferta sezonowa) dotyczy nadruku na kalendarzach firmowych z wyznaczonym polem pod nadruk',
			),
			'K2' => array(
				'name' => 'Kalendarze2',
				'dscr' => 'Nadruki na kalendarzach (oferta sezonowa) dotyczy nadruku na karnetach świątecznych ',
			),
			
		);
		
		if( !empty( $type = $_POST['typ'] ) and ( $num = (int)$_POST['num'] ) > 0 ){
			$colors = (int)$_POST['colors'];
			$matrice = (int)$_POST['matrice'];
			$prepare = (int)$_POST['prepare'];
			
			$out = array(
				array(
					'name' => 'Wybrany typ znakowania',
					'value' => sprintf(
						'(%s) %s',
						$type,
						$types[ $type ][ 'name' ]
					),
				),
				
			);
			
			if( $type === 'TT1' ){
				$price_a = array(
					array(
						'max' => 49,
						array(
							2.80, 3.50, 4.50, 5.50, 6.50, 7.50
						),
					),
					array(
						'max' => 99,
						array(
							1.90, 2.60, 3.30, 4.00, 4.70, 5.50
						),
					),
					array(
						'max' => 249,
						array(
							1.50, 2.10, 2.70, 3.20, 4.00, 4.60
						),
					),
					array(
						'max' => 499,
						array(
							1.30, 1.80, 2.30, 2.75, 3.20, 3.85
						),
					),
					array(
						'max' => 999,
						array(
							1.10, 1.60, 2.10, 2.55, 3.00, 3.50
						),
					),
					array(
						'max' => 1999,
						array(
							0.90, 1.40, 1.90, 2.15, 2.60, 3.10
						),
					),
					array(
						'max' => 4999,
						array(
							0.70, 1.10, 1.50, 1.90, 2.30, 2.50
						),
					),
					
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num <= $single['max'] or $pos == count( $price_a ) - 1 ){
						$found = $single;
						break;
						
					}
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][ $colors - 1 ] ),
				);
				$total += $found[0][ $colors - 1 ] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'TT2' ){
				$price_a = array(
					array(
						'max' => 49,
						array(
							3.50, 4.30, 5.30, 6.30, 7.30, 8.50
						),
					),
					array(
						'max' => 99,
						array(
							2.80, 3.50, 4.30, 5.00, 5.70, 6.30
						),
					),
					array(
						'max' => 249,
						array(
							2.00, 2.60, 3.50, 4.10, 4.70, 5.30
						),
					),
					array(
						'max' => 499,
						array(
							1.80, 2.40, 3.00, 3.60, 4.20, 4.80
						),
					),
					array(
						'max' => 999,
						array(
							1.50, 2.10, 2.70, 3.30, 3.90, 4.50
						),
					),
					array(
						'max' => 1999,
						array(
							1.30, 1.80, 2.40, 3.00, 3.60, 4.20
						),
					),
					array(
						'max' => 4999,
						array(
							1.10, 1.60, 2.10, 2.60, 3.10, 3.60
						),
					),
					
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num <= $single['max'] or $pos == count( $price_a ) - 1 ){
						$found = $single;
						break;
						
					}
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][ $colors - 1 ] ),
				);
				$total += $found[0][ $colors - 1 ] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'S1' ){
				$ryczałt_a = array(
					120, 150, 180, 220, 260, 300
				);
				
				$price_a = array(
					array(
						'max' => 99,
						array(
							1.80, 2.50, 3.20, 3.70, 4.20, 4.80
						),
					),
					array(
						'max' => 249,
						array(
							1.50, 2.20, 2.90, 3.60, 4.20, 4.70
						),
					),
					array(
						'max' => 499,
						array(
							1.20, 1.70, 2.20, 2.70, 3.20, 3.70
						),
					),
					array(
						'max' => 999,
						array(
							1.00, 1.50, 2.00, 2.50, 3.00, 3.50
						),
					),
					array(
						'max' => 1999,
						array(
							0.80, 1.30, 1.80, 2.30, 2.80, 3.20
						),
					),
					array(
						'max' => 4999,
						array(
							0.70, 1.00, 1.30, 1.50, 1.80, 2.10
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num <= $single['max'] or $pos == count( $price_a ) - 1 ){
						$found = $single;
						break;
						
					}
					
				}
				
				$total = 0;
				
				if( $num < 50 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[ $colors - 1 ] ),
					);
					$total += $ryczałt_a[ $colors - 1 ];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][ $colors - 1 ] ),
					);
					$total += $found[0][ $colors - 1 ] * $num;
				}
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'S2' ){
				$ryczałt_a = array(
					140, 180, 220, 290, 340, 400
				);
				
				$price_a = array(
					array(
						'max' => 99,
						array(
							2.80, 3.80, 4.80, 5.80, 6.80, 7.80
						),
					),
					array(
						'max' => 249,
						array(
							2.00, 3.00, 4.00, 5.00, 6.00, 7.00
						),
					),
					array(
						'max' => 499,
						array(
							1.80, 2.50, 3.20, 3.90, 4.60, 5.10
						),
					),
					array(
						'max' => 999,
						array(
							1.50, 2.10, 2.70, 3.30, 3.90, 4.50
						),
					),
					array(
						'max' => 1999,
						array(
							1.30, 1.80, 2.30, 2.80, 3.30, 3.85
						),
					),
					array(
						'max' => 4999,
						array(
							1.10, 1.55, 1.95, 2.35, 2.75, 3.10
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num <= $single['max'] or $pos == count( $price_a ) - 1 ){
						$found = $single;
						break;
						
					}
					
				}
				
				$total = 0;
				
				if( $num < 50 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[ $colors - 1 ] ),
					);
					$total += $ryczałt_a[ $colors - 1 ];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][ $colors - 1 ] ),
					);
					$total += $found[0][ $colors - 1 ] * $num;
				}
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'S3' ){
				$ryczałt_a = array(
					60, 100, 140, 180, 220, 260
				);
				
				$price_a = array(
					array(
						'max' => 249,
						array(
							0.60, 1.00, 1.40, 1.80, 2.20, 2.60
						),
					),
					array(
						'max' => 499,
						array(
							0.55, 0.90, 1.25, 1.60, 1.95, 2.30
						),
					),
					array(
						'max' => 999,
						array(
							0.50, 0.80, 1.10, 1.40, 1.70, 2.00
						),
					),
					array(
						'max' => 1999,
						array(
							0.45, 0.70, 0.95, 1.20, 1.45, 1.70
						),
					),
					array(
						'max' => 4999,
						array(
							0.40, 0.65, 0.90, 1.15, 1.40, 1.65
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num <= $single['max'] or $pos == count( $price_a ) - 1 ){
						$found = $single;
						break;
						
					}
					
				}
				
				$total = 0;
				
				if( $num < 250 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[ $colors - 1 ] ),
					);
					$total += $ryczałt_a[ $colors - 1 ];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][ $colors - 1 ] ),
					);
					$total += $found[0][ $colors - 1 ] * $num;
				}
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			
			// print_r( $out );
			
			foreach( $out as $line ){
				printf(
					'<div class="line d-flex align-items-center justify-content-between">
						<div class="name">
							%s
						</div>
						<div class="value">
							%s
						</div>
						
					</div>',
					$line['name'],
					$line['value']
					
				);
			}
			
			exit;
			
		}
		
	}
	else header("Location: " . home_url() );
	
	get_header();
	
	if( DEV ){
		echo "<!--POST" . PHP_EOL;
		print_r( $_POST );
		echo PHP_EOL . "-->";
	}
	
?>
	<body class="kalkulator-page">
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
		<div class= "container fourth-container">
			<div class="row" id="fourth-container-content">
				<form class='kalkulator col d-flex flex-column align-items-center' method='post'>
					<div class='segment type'>
						<div class='title'>
							Typ znakowania
						</div>
						<div class='body d-flex flex-column'>
							<div class='line d-flex align-items-center'>
								<select id='typ' name='typ' required>
									<?php
										foreach( $types as $code => $type ){
											printf(
												'<option value="%s" title="%s">(%s) %s</option>',
												$code,
												$type['dscr'],
												$code,
												$type['name']
											);
											
										}
									?>
								</select>
							</div>
							
						</div>
						
					</div>
					<div class='segment matrice'>
						<div class='title'>
							Matryca do tłoczenia
						</div>
						<div class='body d-flex flex-column'>
							<div class='line d-flex align-items-center'>
								<input id='matrice01' type='radio' name='matrice' value='1' required>
								<label for='matrice01'>
									Posiadam matrycę
								</label>
							</div>
							<div class='line d-flex align-items-center'>
								<input id='matrice02' type='radio' name='matrice' value='0' required checked>
								<label for='matrice02'>
									Nie posiadam matrycy
								</label>
							</div>
							
						</div>
						
					</div>
					<div class='segment prepare'>
						<div class='title'>
							Przygotowanie / Powtórzenie
						</div>
						<div class='body d-flex flex-column'>
							<div class='line d-flex align-items-center'>
								<input id='prepare01' type='radio' name='prepare' value='1' required checked>
								<label for='prepare01'>
									Przygotowanie
								</label>
							</div>
							<div class='line d-flex align-items-center'>
								<input id='prepare02' type='radio' name='prepare' value='0' required>
								<label for='prepare02'>
									Powtórzenie
								</label>
							</div>
							
						</div>
						
					</div>
					<div class='segment colors'>
						<div class='title'>
							Ilość kolorów
						</div>
						<div class='body d-flex flex-column'>
							<div class='line d-flex align-items-center'>
								<select name='colors' required>
									<?php
										for( $i = 1; $i <= 6; $i++ ) printf( '<option>%u</option>', $i );
									?>
								</select>
								
							</div>
							
						</div>
						
					</div>
					<div class='segment num'>
						<div class='title'>
							Ilość produktów
						</div>
						<div class='body d-flex flex-column'>
							<div class='line d-flex align-items-center'>
								<input id='num01' type='number' min=1 step=1 name='num' value='1' required>
								
							</div>
							
						</div>
						
					</div>
					<div class='segment summary'>
						<div class='title'>
							Podsumowanie zamówienia
						</div>
						<div class='body d-flex flex-column'>
							
						</div>
						
					</div>
					
				</form>
			</div>
		</div>
		<!-- =================================footer begins================================================================-->
		
<?php get_footer(); ?>