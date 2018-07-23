<?php
	/* template name: Kalkulator */	
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
		'TŁ' => array(
			'name' => 'Tłoczenie',
			'dscr' => '',
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
	
	if( $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest" ){
	// if( 1 == 1 ){
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
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'TŁ' ){
				$ryczałt_a = array(
					130, 100
				);
				
				$price_a = array(
					/* cennik dla tłoczenia + wykonanie matrycy */
					array(
						array(
							'min' => 20,
							array(
								1.70
							),
						),
						array(
							'min' => 100,
							array(
								1.20
							),
						),
						array(
							'min' => 200,
							array(
								1.00
							),
						),
						array(
							'min' => 300,
							array(
								0.90
							),
						),
						array(
							'min' => 500,
							array(
								0.80
							),
						),
						array(
							'min' => 1000,
							array(
								-1
							),
						),
					),
					/* cennik dla tłoczenia */
					array(
						array(
						'min' => 20,
							array(
								1.70
							),
						),
						array(
							'min' => 100,
							array(
								1.20
							),
						),
						array(
							'min' => 200,
							array(
								1.00
							),
						),
						array(
							'min' => 300,
							array(
								0.90
							),
						),
						array(
							'min' => 500,
							array(
								0.80
							),
						),
						array(
							'min' => 1000,
							array(
								-1
							),
						),
					)
				);
				
				$prepare_a = array(
					
				);
				
				$matrice_a = array(
					100, 20
				);
				
				foreach( $price_a[ $matrice ] as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Koszt matrycy',
					'value' => sprintf( '%.2f PLN', $matrice_a[ $matrice ] ),
				);
				$total += $matrice_a[ $matrice ];
				
				if( $num < 20 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[ $matrice ] ),
					);
					$total += $ryczałt_a[ $colors - 1 ];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => $found[0][0] < 0?(
							'Cena do negocjacji'
						):(
							sprintf( '%u x %.2f PLN', $num, $found[0][0] )
						),
					);
					$total += $found[0][0] * $num;
				}
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => $num >= 1000?(
						'Cena do negocjacji'
					):(
						sprintf( '%.2f PLN', $total )
					),
					
				);
				
			}
			elseif( $type === 'T1' ){
				$ryczałt_a = array(
					50, 100, 150, 200, 250, 300
				);
				
				$price_a = array(
					array(
						'min' => 100,
						array(
							0.16, 0.32, 0.48, 0.64, 0.80, 0.96
						),
					),
					array(
						'min' => 250,
						array(
							0.14, 0.28, 0.42, 0.56, 0.70, 0.84
						),
					),
					array(
						'min' => 500,
						array(
							0.12, 0.24, 0.36, 0.48, 0.60, 0.72
						),
					),
					array(
						'min' => 1000,
						array(
							0.10, 0.20, 0.30, 0.40, 0.50, 0.60
						),
					),
					array(
						'min' => 2000,
						array(
							0.08, 0.16, 0.24, 0.32, 0.40, 0.48
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'T2' ){
				$ryczałt_a = array(
					75, 150, 225, 300, 375, 450
				);
				
				$price_a = array(
					array(
						'min' => 100,
						array(
							0.24, 0.48, 0.72, 0.96, 1.20, 1.44
						),
					),
					array(
						'min' => 250,
						array(
							0.21, 0.42, 0.63, 0.84, 1.05, 1.26
						),
					),
					array(
						'min' => 500,
						array(
							0.18, 0.36, 0.54, 0.72, 0.90, 1.08
						),
					),
					array(
						'min' => 1000,
						array(
							0.15, 0.30, 0.45, 0.60, 0.75, 0.90
						),
					),
					array(
						'min' => 2000,
						array(
							0.12, 0.24, 0.36, 0.48, 0.60, 0.72
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'T3' ){
				$ryczałt_a = array(
					90, 180, 270, 360, 450, 540
				);
				
				$price_a = array(
					array(
						'min' => 100,
						array(
							0.32, 0.64, 0.96, 1.28, 1.60, 1.92
						),
					),
					array(
						'min' => 250,
						array(
							0.28, 0.56, 0.84, 1.12, 1.40, 1.68
						),
					),
					array(
						'min' => 500,
						array(
							0.24, 0.48, 0.72, 0.96, 1.20, 1.44
						),
					),
					array(
						'min' => 1000,
						array(
							0.20, 0.40, 0.60, 0.80, 1.00, 1.20
						),
					),
					array(
						'min' => 2000,
						array(
							0.16, 0.32, 0.48, 0.64, 0.80, 0.96
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'T4' ){
				$ryczałt_a = array(
					100, 200, 300, 400, 500, 600
				);
				
				$price_a = array(
					array(
						'min' => 100,
						array(
							0.48, 0.96, 1.44, 1.92, 2.40, 2.88
						),
					),
					array(
						'min' => 250,
						array(
							0.42, 0.84, 1.26, 1.68, 2.10, 2.52
						),
					),
					array(
						'min' => 500,
						array(
							0.36, 0.72, 1.08, 1.44, 1.80, 2.16
						),
					),
					array(
						'min' => 1000,
						array(
							0.30, 0.60, 0.90, 1.20, 1.50, 1.80
						),
					),
					array(
						'min' => 2000,
						array(
							0.24, 0.48, 0.72, 0.96, 1.20, 1.44
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'L1' ){
				$ryczałt_a = array(
					
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							0.60
						),
					),
					array(
						'min' => 50,
						array(
							0.55
						),
					),
					array(
						'min' => 100,
						array(
							0.45
						),
					),
					array(
						'min' => 250,
						array(
							0.40
						),
					),
					array(
						'min' => 500,
						array(
							0.30
						),
					),
					array(
						'min' => 1000,
						array(
							0.20
						),
					),
					array(
						'min' => 2000,
						array(
							0.17
						),
					),
					
				);
				
				$prepare_a = array(
					10
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				if( $num < 250 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[0] ),
					);
					$total += $ryczałt_a[0];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
					);
					$total += $found[0][0] * $num;
				}
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'L2' ){
				$ryczałt_a = array(
					
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							0.90
						),
					),
					array(
						'min' => 50,
						array(
							0.80
						),
					),
					array(
						'min' => 100,
						array(
							0.70
						),
					),
					array(
						'min' => 250,
						array(
							0.60
						),
					),
					array(
						'min' => 500,
						array(
							0.50
						),
					),
					array(
						'min' => 1000,
						array(
							0.40
						),
					),
					array(
						'min' => 2000,
						array(
							0.32
						),
					),
					
				);
				
				$prepare_a = array(
					10
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				if( $num < 250 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[0] ),
					);
					$total += $ryczałt_a[0];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
					);
					$total += $found[0][0] * $num;
				}
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'L3' ){
				$ryczałt_a = array(
					
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							0.90
						),
					),
					array(
						'min' => 50,
						array(
							0.80
						),
					),
					array(
						'min' => 100,
						array(
							0.70
						),
					),
					array(
						'min' => 250,
						array(
							0.60
						),
					),
					array(
						'min' => 500,
						array(
							0.50
						),
					),
					array(
						'min' => 1000,
						array(
							0.40
						),
					),
					array(
						'min' => 2000,
						array(
							0.32
						),
					),
					
				);
				
				$prepare_a = array(
					10
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				if( $num < 250 ){
					$out[] = array(
						'name' => 'Koszt znakowania produktów (cena zryczałtowana)',
						'value' => sprintf( '%.2f PLN', $ryczałt_a[0] ),
					);
					$total += $ryczałt_a[0];
				}
				else{
					$out[] = array(
						'name' => 'Koszt znakowania produktów',
						'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
					);
					$total += $found[0][0] * $num;
				}
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'CO2' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							1.60
						),
					),
					array(
						'min' => 50,
						array(
							1.40
						),
					),
					array(
						'min' => 100,
						array(
							1.20
						),
					),
					array(
						'min' => 250,
						array(
							1.00
						),
					),
					array(
						'min' => 500,
						array(
							0.95
						),
					),
					array(
						'min' => 1000,
						array(
							0.90
						),
					),
					array(
						'min' => 2000,
						array(
							-1
						),
					),
					
				);
				
				$prepare_a = array(
					10
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => $num >= 2000?(
						'Cena do negocjacji'
					):(
						sprintf( '%u x %.2f PLN', $num, $found[0][0]
					) ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => $num >= 2000?(
						'Cena do negocjacji'
					):(
						sprintf( '%.2f PLN', $total )
					),
					
				);
				
			}
			elseif( $type === 'UV10' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							1.40
						),
					),
					array(
						'min' => 50,
						array(
							1.13
						),
					),
					array(
						'min' => 100,
						array(
							1.03
						),
					),
					array(
						'min' => 250,
						array(
							0.75
						),
					),
					array(
						'min' => 500,
						array(
							0.65
						),
					),
					array(
						'min' => 1000,
						array(
							0.54
						),
					),
					array(
						'min' => 2000,
						array(
							0.46
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UV10+P' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							1.47
						),
					),
					array(
						'min' => 50,
						array(
							1.20
						),
					),
					array(
						'min' => 100,
						array(
							1.09
						),
					),
					array(
						'min' => 250,
						array(
							0.82
						),
					),
					array(
						'min' => 500,
						array(
							0.71
						),
					),
					array(
						'min' => 1000,
						array(
							0.60
						),
					),
					array(
						'min' => 2000,
						array(
							0.52
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UV25' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							2.83
						),
					),
					array(
						'min' => 50,
						array(
							2.29
						),
					),
					array(
						'min' => 100,
						array(
							2.08
						),
					),
					array(
						'min' => 250,
						array(
							1.53
						),
					),
					array(
						'min' => 500,
						array(
							1.32
						),
					),
					array(
						'min' => 1000,
						array(
							1.10
						),
					),
					array(
						'min' => 2000,
						array(
							0.94
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UV25+P' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							2.99
						),
					),
					array(
						'min' => 50,
						array(
							2.45
						),
					),
					array(
						'min' => 100,
						array(
							2.23
						),
					),
					array(
						'min' => 250,
						array(
							1.69
						),
					),
					array(
						'min' => 500,
						array(
							1.47
						),
					),
					array(
						'min' => 1000,
						array(
							1.26
						),
					),
					array(
						'min' => 2000,
						array(
							1.09
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UV25D' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							5.69
						),
					),
					array(
						'min' => 50,
						array(
							4.57
						),
					),
					array(
						'min' => 100,
						array(
							4.12
						),
					),
					array(
						'min' => 250,
						array(
							2.99
						),
					),
					array(
						'min' => 500,
						array(
							2.54
						),
					),
					array(
						'min' => 1000,
						array(
							2.09
						),
					),
					array(
						'min' => 2000,
						array(
							1.76
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UV25D+P' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							5.76
						),
					),
					array(
						'min' => 50,
						array(
							4.64
						),
					),
					array(
						'min' => 100,
						array(
							4.19
						),
					),
					array(
						'min' => 250,
						array(
							3.06
						),
					),
					array(
						'min' => 500,
						array(
							2.61
						),
					),
					array(
						'min' => 1000,
						array(
							2.16
						),
					),
					array(
						'min' => 2000,
						array(
							1.83
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UVA3' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							13.28
						),
					),
					array(
						'min' => 50,
						array(
							12.33
						),
					),
					array(
						'min' => 100,
						array(
							11.38
						),
					),
					array(
						'min' => 250,
						array(
							10.43
						),
					),
					array(
						'min' => 500,
						array(
							9.48
						),
					),
					array(
						'min' => 1000,
						array(
							9.00
						),
					),
					array(
						'min' => 2000,
						array(
							8.36
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'UVA3+P' ){
				$ryczałt_a = array(
					0
				);
				
				$price_a = array(
					array(
						'min' => 1,
						array(
							19.18
						),
					),
					array(
						'min' => 50,
						array(
							18.23
						),
					),
					array(
						'min' => 100,
						array(
							17.28
						),
					),
					array(
						'min' => 250,
						array(
							16.33
						),
					),
					array(
						'min' => 500,
						array(
							15.38
						),
					),
					array(
						'min' => 1000,
						array(
							14.91
						),
					),
					array(
						'min' => 2000,
						array(
							14.27
						),
					),
					
				);
				
				$prepare_a = array(
					30
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => 'Ustawienie maszyny (opłata jednorazowa)',
					'value' => sprintf( '%.2f PLN', $prepare_a[0] ),
				);
				$total += $prepare_a[0];
				
				$out[] = array(
					'name' => 'Koszt znakowania produktów',
					'value' => sprintf( '%u x %.2f PLN', $num, $found[0][0] ),
				);
				$total += $found[0][0] * $num;
				
				$out[] = array(
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'K1' ){
				$ryczałt_a = array(
					130, 160, 210, 250, 300, 350
				);
				
				$price_a = array(
					array(
						'min' => 50,
						array(
							2.00, 3.00, 4.00, 5.00, 6.00, 7.00
						),
					),
					array(
						'min' => 100,
						array(
							1.80, 2.80, 3.80, 4.80, 5.50, 6.80
						),
					),
					array(
						'min' => 250,
						array(
							1.50, 2.50, 3.50, 4.50, 5.50, 6.50
						),
					),
					array(
						'min' => 500,
						array(
							1.20, 2.20, 3.20, 4.20, 5.20, 6.20
						),
					),
					array(
						'min' => 1000,
						array(
							1.00, 2.00, 3.00, 4.00, 5.00, 6.00
						),
					),
					array(
						'min' => 2000,
						array(
							0.80, 1.65, 2.40, 2.90, 3.10, 3.50
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			elseif( $type === 'K2' ){
				$ryczałt_a = array(
					80, 120, 150, 200, 250, 300
				);
				
				$price_a = array(
					array(
						'min' => 50,
						array(
							1.00, 2.00, 3.00, 4.00, 5.00, 6.00
						),
					),
					array(
						'min' => 100,
						array(
							0.60, 1.20, 1.80, 2.40, 3.00, 3.60
						),
					),
					array(
						'min' => 250,
						array(
							0.55, 1.10, 1.65, 2.20, 2.75, 3.30
						),
					),
					array(
						'min' => 500,
						array(
							0.50, 1.00, 1.50, 2.00, 2.50, 3.00
						),
					),
					array(
						'min' => 1000,
						array(
							0.45, 0.90, 1.35, 1.80, 2.25, 2.70
						),
					),
					array(
						'min' => 2000,
						array(
							0.40, 0.85, 1.30, 1.75, 2.20, 2.65
						),
					),
					
				);
				
				$prepare_a = array(
					40, 80, 120, 160, 200, 240
				);
				
				foreach( $price_a as $pos => $single ){
					if( $num >= $single['min'] ){
						$found = $single;
						
					}
					else break;
					
				}
				
				$total = 0;
				
				$out[] = array(
					'name' => sprintf( 'Koszt %s', $prepare > 0?( 'przygotowa' ):( 'powtórzenia' ) ),
					'value' => sprintf( '%.2f PLN', $prepare_a[ $colors - 1 ] ),
				);
				$total += $prepare_a[ $colors - 1 ];
				
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
					'name' => 'Koszt całkowity',
					'value' => sprintf( '%.2f PLN', $total ),
					
				);
				
			}
			
			// print_r( $out );
			
			foreach( $out as $line ){
				printf(
					'<div class="line d-flex flex-wrap align-items-center justify-content-between">
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
			
			
		}
		
		exit;
	}
	// else header("Location: " . home_url() );
	
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
								<input id='matrice01' type='radio' name='matrice' value='0' required checked>
								<label for='matrice01'>
									Nie posiadam matrycy
								</label>
							</div>
							
							<div class='line d-flex align-items-center'>
								<input id='matrice02' type='radio' name='matrice' value='1' required>
								<label for='matrice02'>
									Posiadam matrycę
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