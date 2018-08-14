<?php
/*
	Template Name: Strona mailingowa
*/

get_header();

get_template_part( "template/page", "top" );

get_template_part( "template/menu", "top" );

?>

<div id='mailing' class='grid'>
	<?php
		$nl = newsletter();
		$lista = $nl->getData( true );
		if( count( $lista ) > 0 ){
			include __DIR__ . "/template/mailing-lista.php";
			
		}
		else{
			include __DIR__ . "/template/mailing-empty.php";
			
		}
		
	?>
	
</div>

<?php

get_footer();

?>