<?php
/*
	Template Name: Newsletter_ajax
*/
	if( isAjax() ){
		// print_r( $_GET );
		
		if( isset( $_GET[ 'add' ] ) ){
			$safe = filter_var( $_GET[ 'add' ], FILTER_VALIDATE_EMAIL );
			if( $safe !== false ){
				$test = newsletter()->zarejestruj( $safe );
				switch( $test ){
					case true:
						echo json_encode( array(
							'status' => 'pass',
							'msg' => 'Email został zarejestrowany.<br>Wkrótce otrzymasz email z informacją.'
							
						) );
						
					break;
					case false:
						echo json_encode( array(
							'status' => 'info',
							'msg' => 'Ten email został już zarejestrowany.<br>Wyślij ponownie aby otrzymać maila z linkiem wyrejestrowywującym.'
							
						) );
						
					break;
					default:
						echo json_encode( array(
							'status' => 'fail',
							'msg' => "Adres został zarejestrowany jednak nie udało się nam wysłać maila z informacją.<br>Powód: $test"
							
						) );
				}
				
			}
			else{
				echo json_encode( array(
					'status' => 'fail',
					'msg' => "Podany adres e-mail ma nieprawidłowy format.<br>Sprawdź pisownię i spróbuj raz jeszcze"
					
				) );
				
			}
			
		}
		elseif( !empty( $_GET[ 'unreglink' ] ) ){
			// print_r( $_GET );
			$test = newsletter()->linkDeaktywacyjny( $_GET[ 'unreglink' ] );
			switch( $test ){
				case true:
					echo json_encode( array(
						'status' => 'pass',
						'msg' => 'Za chwilę otrzymasz mail z linkiem deaktywującym usługę.'
						
					) );
					
				break;
				case false:
					echo json_encode( array(
						'status' => 'fail',
						'msg' => 'Podany email nie istnieje w naszej bazie'
						
					) );
					
				break;
				default:
					echo json_encode( array(
						'status' => 'fail',
						'msg' => "Nie udało się wysłać wiadomości email.<br>Powód: $test"
						
					) );
			}
			
		}
		
	}
	else{
		// get_header();
		get_template_part( "template/newsletter", 'ajax' );
		// get_footer();
		
	}
	
?>