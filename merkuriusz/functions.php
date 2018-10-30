<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'widgets' );

function printTitle(){
	printf(
		'%s | %s',
		get_post()->post_title,
		get_bloginfo('name')
	);
	
}

function getConnect(){
	$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	return mysqli_errno( $con )?( false ):( $con );
	
}

function doSQL( $sql = "", $out = MYSQLI_ASSOC ){
	$con = getConnect();
	$query = mysqli_query( $con, $sql );
	if( !is_bool( $query ) ){
		$fetch = mysqli_fetch_all( $query, $out );
		mysqli_free_result( $query );
		
	}
	else $fetch = $query;
	
	mysqli_close( $con );
	return $fetch;
}

function getCategory( $cat_name = null, $subcat_name = null, $orderby = null, $order = null ){
	
	if( $cat_name !== null ){
		if( in_array( $orderby, array( null, '' ) ) ) $orderby = 'ID';
		if( $order === null ) $order = 'DESC';
		
		if( $subcat_name !== null ){
			$sql = "SELECT prod.*
			FROM XML_category as cat
			JOIN XML_category as subcat
			ON cat.ID = subcat.parent
			JOIN XML_product as prod
			ON subcat.ID = prod.cat_id
			WHERE cat.name = '{$cat_name}' AND subcat.name = '{$subcat_name}'";
			
		}
		else{
			$sql = "SELECT prod.*
			FROM XML_category as cat
			JOIN XML_category as subcat
			ON cat.ID = subcat.parent
			JOIN XML_product as prod
			ON subcat.ID = prod.cat_id
			WHERE cat.name = '{$cat_name}'";
			
		}
		
		$sql .= " ORDER BY prod.{$orderby} {$order}";
		
		return doSQL( $sql );
		
	}
	else{
		return false;
		
	}
	
}

function getSubcatsList( $cat_name = null ){
	$con = getConnect();
	$sql = "SELECT subcat.name
	FROM XML_category as cat
	JOIN XML_category as subcat
	ON cat.ID = subcat.parent
	WHERE cat.name = '{$cat_name}'
	ORDER BY subcat.name ASC";
	
	return doSQL( $sql );
	
}

function getProduct( $code = null ){
	$sql = "SELECT * FROM XML_product WHERE code = '{$code}'";
	return doSQL( $sql );
	
}

function genMenu(){
	$menu = array(
		'Anda' => array(
			'url' => home_url("sklep/?nazwa=anda"),
			'class' => 'shop_anda',
		),
		'Asgard' => array(
			'url' => home_url("sklep/?nazwa=asgard"),
			'class' => 'shop_asg',
		),
		'Axpol' => array(
			'url' => home_url("sklep/?nazwa=axpol"),
			'class' => 'shop_axp',
		),
		'Axpol Fofcio Promo Toys' => array(
			'url' => home_url("kategoria/?dostawca=axpol&nazwa=fofcio promo toys"),
			'class' => 'shop_axp_fofcio',
		),
		'Axpol Vine Club' => array(
			'url' => home_url("kategoria/?dostawca=axpol&nazwa=vine club"),
			'class' => 'shop_axp_vine',
		),
		'Axpol XD Prestiż' => array(
			'url' => home_url("kategoria/?dostawca=axpol&nazwa=voyager xd"),
			'class' => 'shop_axp_xd',
		),
		'Axpol plus' => array(
			'url' => home_url("kategoria/?dostawca=axpol&nazwa=voyager plus"),
			'class' => 'shop_axp_plus',
		),
		'Easy Gifts' => array(
			'url' => home_url("sklep/?nazwa=easygifts"),
			'class' => 'shop_eg',
		),
		'Falk&Ross' => array(
			'url' => home_url("sklep/?nazwa=falkross"),
			'class' => 'shop_fr',
		),
		'Inspirion' => array(
			'url' => home_url("sklep/?nazwa=inspirion"),
			'class' => 'shop_ins',
		),
		'Jaguar Gift' => array(
			'url' => home_url("sklep/?nazwa=jaguargift"),
			'class' => 'shop_jg',
		),
		'Macma' => array(
			'url' => home_url("sklep/?nazwa=macma"),
			'class' => 'shop_mcm',
		),
		'PAR' => array(
			'url' => home_url("sklep/?nazwa=par"),
			'class' => 'shop_par',
		),
		
	);
	
	// ksort( $menu );
	
	// $menu[] = 'Inne produkty';
	
	echo '<ul class="dropdown-menu list-unstyled">';
	foreach( $menu as $name => $item ){
		printf(
			'<li class="%s" role="presentation">
				<a href="%s" role="menuitem" tabindex="-1" class="list-group-item">
					%s
				</a>
			</li>',
			$item['class'],
			$item['url'],
			$name
			
		);
		
	}
	echo '</ul>';
	
}

function genOfertyData(){
	$ret = array();
	
	/* Wyciąganie listy podkategorii kategorii tworzących filtry */
	$categories = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => false,
		'parent' => get_category_by_slug( 'oferty' )->cat_ID,
		
	) );
	
	/* Tworzenie tablicy z wspisami dla kategorii głównej */
	$ret[ 'Wszystkie' ] = array();
	
	$posts = get_posts( array(
		'category_name' => 'oferty',
		'numberposts' => -1,
			
	) );
	
	foreach( $posts as $post ){
		$ret[ 'Wszystkie' ][ $post->post_name ] = array(
			'title' => $post->post_title,
			'thumb' => get_the_post_thumbnail_url( $post->ID, 'medium' ),
			'img' => get_the_post_thumbnail_url( $post->ID, 'full' ),
			'img_alt' => 'https://placeimg.com/100/100/tech',
			'cats' => array( 'Wszystkie' ),
			
		);
		
	}
	
	/* Przechodzenie po wszystkich znaleizonych podkategoriach, dodawanie nazwy znalezionej podkategorii, dopisywanie nazw kategorii dla wpisów */
	foreach( $categories as $cat ){
		$ret[ $cat->name ] = array();
		
		$posts = get_posts( array(
			'category' => $cat->term_id,
			'numberposts' => -1,
			
		) );
		
		foreach( $posts as $post ){
			$ret[ 'Wszystkie' ][ $post->post_name ][ 'cats' ][] = $cat->name;
			
		}
		
	}
	
	
	// return $categories;
	return $ret;
}

function register_my_menus() {
  register_nav_menus(
    array(
      'menu-znakowanie' => __( 'menu-znakowanie' ),
      'menu-kalendarze' => __( 'menu-kalendarze' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active-menu';
    }
    return $classes;
}

/* funkcja generująca og tagi do social mediów */
function OGTags( $obj = null ){
	/* generowanie tagów dla standardowej strony */
	if( $obj === null ){
		$post = get_post();
		
		$img = get_the_post_thumbnail_url( $post->ID, 'full' );
		if( $img === false ) $img = get_template_directory_uri() . "/media/logo1.jpg";
		
		
		printf(
		'<meta property="og:title" content="%s" />
		<meta property="og:type" content="%s" />
		<meta property="og:url" content="%s" />
		<meta property="og:site_name" content="%s" />
		<meta property="og:image" content="%s" />
		<meta property="og:description" content="%s" />',
		$post->post_title,
		'article',
		get_the_permalink( $post->ID ),
		get_bloginfo('name'),
		$img,
		strip_tags( $post->post_content )
		
		);
		
		
	}
	/* generowanie tagów dla strony produktu */
	else{
		$item = $obj[0];
		$imgs = json_decode( $item['photos'] );
		
		printf(
		'<meta property="og:title" content="%s" />
		<meta property="og:type" content="%s" />
		<meta property="og:url" content="%s" />
		<meta property="og:site_name" content="%s" />
		<meta property="og:image" content="%s" />
		<meta property="og:description" content="%s" />',
		$item['title'],
		'product',
		home_url( "produkt/?kod={$item['code']}" ),
		get_bloginfo( 'name' ),
		$imgs[0],
		implode( " ", array_slice( explode( " ", strip_tags( trim( $item['description'] ) ) ) , 0, 50 ) )
		
		);
		
	}
}

// sprawdza czy strona została otworzona poprzez AJAXa
function isAjax(){
	return $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
}

// Newsleeter
class NewsLetter{
	private $_path = nulll;
	private $_mailer = nulll;
	/* _data = array(
		'registered' => array(
			[@timestamp] => mail,
		),
		'verified' => array(
			[@timestamp] => mail,
		),
		
	) */
	private $_data = array(
		'registered' => array(),
		'verified' => array(),
		
	);
	
	public function __construct( PHPMailer $mailer, $file =  null ){
		$file = $file === null?( __DIR__ . "/lista_mailingowa.php" ):( $file );
		$this->_path = $file;
		$this->_mailer = $mailer;
		$this->setMailer();
		$this->load();
		
	}
	
	/* wczytuje z pliku tablicę z mailami */
	private function load(){
		$content = @file_get_contents( $this->_path );
		if( $content !== false ){
			$json = json_decode( $content, true );
			if( $json !== null ){
				$this->_data = $json;
				return true;
				
			}
			
		}
		
		return false;
	}
	
	/* zapisuję tablicę z mailami do pliku */
	private function save(){
		$json = json_encode( $this->_data );
		if( $json !== false ){
			return file_put_contents( $this->_path, $json ) !== false;
			
		}
		
		return false;
	}
	
	/* zwraca tablicę z mailami */
	public function getData( $verified = false ){
		if( $verified === false ){
			return $this->_data;
			
		}
		else{
			return $this->_data[ 'verified' ];
			
		}
		
	}
	
	/* sprawdza i zwraca stan ( false / registered / verified ) rejestracji adresu mailowego */
	private function checkMail( $mail = null ){
		if( in_array( $mail, $this->_data[ 'registered' ] ) !== false ){
			return 'registered';
			
		}
		elseif( in_array( $mail, $this->_data[ 'verified' ] ) !== false ){
			return 'verified';
			
		}
		else{
			return false;
			
		}
		
	}
	
	/* rejestruje mail, dopisuje do listy niezweryfikowanych maili, zwraca true/false/error_info */
	private function registerMail( $mail = null ){
		if( $this->checkMail( $mail ) === false ){
			// $id = "@" . microtime( true );
			$id = "@" . time();
			$this->_data[ 'registered' ][ $id ] = $mail;
			if( $this->save() ){
				return $this->veryfiMail( $mail );
				
			}
			
		}
		
		return false;
	}
	
	/* wyrejestrowywuje mail ze wszystkich list, zwraca true/false/error_info */
	private function unregisterMail( $id = null ){
		$mail = empty( $this->_data[ 'registered' ][ $id ] )?( $this->_data[ 'verified' ][ $id ] ):( $this->_data[ 'registered' ][ $id ] );
		unset( $this->_data[ 'registered' ][ $id ] );
		unset( $this->_data[ 'verified' ][ $id ] );
		
		if( !empty( $mail ) && $this->save() ){
			$this->_mailer->addAddress( $mail );
			$this->_mailer->Subject = "Potwierdzenie wyrejestrowania adresu";
			$this->_mailer->Body = implode( "\r\n", array(
				"Witaj ponownie!",
				"",
				"Otrzymujesz tą wiadomość ponieważ ten adres został pomyślnie wyrejestrowany",
				"Od tej pory nie będziesz już otrzymywać od nas żadnych nowych ofert handlowych.",
				"",
				"Dziękujemy za wspólnie spędzony czas i zapraszamy ponownie.",
				"",
				"---",
				"Wiadomość została wygenerowana automatycznie na stronie: " . home_url(),
				
			) );
			if( $this->_mailer->send() ){
				return true;
				
			}
			else{
				return $this->_mailer->ErrorInfo;
				
			}
			
		}
		else{
			return false;
			
		}
		
	}
	
	/* wstępna konfiguracja mailera */
	private function setMailer( $from_name = "NewsLetter - Merkuriusz" ){
		$this->_mailer->CharSet = "utf8";
		$this->_mailer->Encoding = "base64";
		$this->_mailer->setLanguage( 'pl' );
		$this->_mailer->setFrom( "noreply@{$_SERVER[ 'HTTP_HOST' ]}", $from_name );
		
	}
	
	/* weryfikacja adresu poprzez wysłanie maila z linkiem aktywującym, zwraca true/false/error_info */
	private function veryfiMail( $mail = null ){
		$regID = array_search( $mail, $this->_data[ 'registered' ] );
		if( $regID !== false ){
			$this->_mailer->addAddress( $mail );
			$this->_mailer->Subject = "Weryfikacja adresu e-mail";
			$this->_mailer->Body = implode( "\r\n", array(
				"Witaj!",
				"",
				"Otrzymujesz ten email ponieważ ktoś, mamy nadzieję że to Ty, dodał go do naszego newslettera.",
				"Jeśli to nie Ty, zignoruj tę wiadomość. W przeciwnym wypadku kliknij poniższy link aby zakończyć proces weryfikacji.",
				"Od momentu zakończenia weryfikacji będziesz otrzymywać od nas najnowsze oferty handlowe. Otrzymasz również email potwierdzający aktywację usługi.",
				"Dziękujemy za korzystanie z naszych usług.",
				"",
				"Link aktywujący: " . home_url( "newsletter?verifi={$regID}" ),
				"Otwórz powyższy adres w swojej przeglądarce www.",
				"",
				"---",
				"Wiadomość została wygenerowana automatycznie na stronie: " . home_url(),
				
			) );
			if( $this->_mailer->send() ){
				return true;
				
			}
			else{
				return $this->_mailer->ErrorInfo;
				
			}
			
		}
		else{
			return false;
			
		}
		
	}
	
	/* potwierdzenie dodania adresu poprzez link aktywacyjny, przenosi mail z listy zarejestrowanych do listy zweryfikowanych, zwraca true/false/error_info */
	private function confirmMail( $id = null ){
		$mail = $this->_data[ 'registered' ][ $id ];
		if( !empty( $mail ) ){
			unset( $this->_data[ 'registered' ][ $id] );
			$this->_data[ 'verified' ][ $id ] = $mail;
			if( $this->save() ){
				$this->_mailer->addAddress( $mail );
				$this->_mailer->Subject = "Potwierdzenie aktywacji usługi";
				$this->_mailer->Body = implode( "\r\n", array(
					"Witaj ponownie!",
					"",
					"Otrzymujesz ten email ponieważ aktywacja Twojego adresu przebiegła pomyślnie.",
					"Od teraz będziesz otrzymywać bieżące informacje o wszelkich promocjach, wyprzedażach i wszelkich innych ofertach.",
					"Poniżej znajduje się link wyłączający usługę. Pamiętaj, że usługą można również wyłączyć bezpośrednio na naszej stronie.",
					"",
					"Link dezaktywujący: " . home_url( "newsletter?unreg={$id}" ),
					"Otwórz powyższy adres w swojej przeglądarce www.",
					"",
					"Dziękujemy za skorzystanie z naszych usług",
					"",
					"---",
					"Wiadomość została wygenerowana automatycznie na stronie: " . home_url(),
					
				) );
				
				if( $this->_mailer->send() ){
					return true;
					
				}
				else{
					return $this->_mailer->ErrorInfo;
					
				}
				
			}
			
		}
		return false;
		
	}
	
	/* wysyła email z linkiem deaktywacyjnym, zwraca true/false/error_info */
	private function getUnregLink( $mail = null ){
		$safe = filter_var( $mail, FILTER_VALIDATE_EMAIL );
		if( $safe !== false ){
			$verID = array_search( $safe, $this->_data[ 'verified' ] );
			
			if( $verID !== false ){
				$this->_mailer->addAddress( $mail );
				$this->_mailer->Subject = "Link deaktywacyjny";
				$this->_mailer->Body = implode( "\r\n", array(
					"Witaj ponownie!",
					"",
					"Otrzymujesz ten email ponieważ otrzymaliśmy żądanie wysłania linku dezaktywującego usługi newslettera dla tego adresu email.",
					"Jeśli to nie Ty jesteś autorem tego żądania, proszę zignorować tę wiadomość/",
					"",
					"Link dezaktywujący: " . home_url( "newsletter?unreg={$verID}" ),
					"Otwórz powyższy adres w swojej przeglądarce www.",
					"",
					"Dziękujemy za skorzystanie z naszych usług",
					"",
					"---",
					"Wiadomość została wygenerowana automatycznie na stronie: " . home_url(),
					
				) );
				
				if( $this->_mailer->send() ){
					return true;
					
				}
				else{
					return $this->_mailer->ErrorInfo;
					
				}
				
			}
			else return false;
			
		}
		else return false;
		
	}
	
	/* funkcja wysyłająca przygotowany mail do wszystkich zweryfikowanych adresów, zwraca true/false/error_info */
	private function sendOffer( $subject = null, $content = null ){
		if( $subject !== null && $content !== null ){
			if( count( $this->_data[ 'verified' ] ) > 0 ) foreach( $this->_data[ 'verified' ] as $address ){
				$this->_mailer->addBCC( $address );
				
			}
			
			$this->_mailer->Subject = $subject;
			$this->_mailer->Body = $content;
			
			if( $this->_mailer->send() ){
				return true;
				
			}
			else{
				return $this->_mailer->ErrorInfo;
				
			}
			
		}
		else{
			return false;
			
		}
		
	}
	
	public function zarejestruj( $mail = null ){
		return $this->registerMail( $mail );
		
	}
	
	public function aktywuj( $id = null ){
		return $this->confirmMail( $id );
		
	}
	
	public function wyrejestruj( $id = null ){
		return $this->unregisterMail( $id );
		
	}
	
	public function linkDeaktywacyjny( $mail = null ){
		return $this->getUnregLink( $mail );
		
	}
	
	public function wyslij( $tytul = "", $wiadomosc = "" ){
		return $this->sendOffer( $tytul, $wiadomosc );
		
	}
	
}

/* zwraca obiekt NewsLetter */
function newsletter(){
	static $mailer = null;
	static $news = null;
	
	if( $mailer === null ){
		require_once __DIR__  . "/php/PHPMailer/PHPMailerAutoload.php";
		$mailer = new PHPMailer();
		
	}
	
	if( $news === null ){
		$news = new NewsLetter( $mailer );
		
	}
	
	return $news;
}

function slug( $name ){
	$find = array( '/\s/', '/&|!|\/|\+|\.|,/' );
	$replace = array( '_', '' );
	return preg_replace( $find, $replace, $name );
}

