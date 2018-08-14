<?php
	if( !empty( $_GET[ 'verifi' ] ) ){
			$test = newsletter()->aktywuj( $_GET[ 'verifi' ] );
			switch( $test ){
				case true:
					echo "<div>Usługa została pomyślnie aktywowana.<br>Wkrótce otrzymasz powiadomienie email.</div>";
					
				break;
				case false:
					echo '<div>Podany email nie istnieje w naszej bazie</div>';
					
				break;
				default:
					echo "<div>Usługa została aktywowana pomyślnie, jednak nie udało się nam wysłać maila z informacją.<br>Powód: $test</div>";
			}
			
		}
	elseif( !empty( $_GET[ 'unreg' ] ) ){
		// print_r( $_GET );
		$test = newsletter()->wyrejestruj( $_GET[ 'unreg' ] );
		switch( $test ){
			case true:
				echo '<div>Adres został pomyślnie wyrejestrowany.<br>Wkrótce otrzymasz powiadomienie email.</div>';
				
			break;
			case false:
				echo '<div>Podany email nie istnieje w naszej bazie</div>';
				
			break;
			default:
				echo "<div>Adres został wyrejestrowny pomyślnie, jednak nie udało się nam wysłać maila z informacją.<br>Powód: $test</div>";
		}
		
	}
	
?>