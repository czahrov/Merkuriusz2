<?php
class ANDA extends XMLAbstract{
	private $_collections = array();

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		if( array_key_exists( $c = 'be creative', $this->_collections ) ){
			$subcat_name = $this->_collections[ $c ][0];
			$cat_name = 'Be creative';
		}
		elseif(
			array_key_exists( $c = 'office  business', $this->_collections ) or
			array_key_exists( $c = 'keys  tools', $this->_collections ) or
			array_key_exists( $c = 'vitality  wellness', $this->_collections )
		){
			
			if(
				array_search( $s = 'notatniki i spinacze', $this->_collections[$c] ) !== false or
				array_search( $s = 'teczki i podkładki', $this->_collections[$c] ) !== false or
				array_search( $s = 'wizytowniki', $this->_collections[$c] ) !== false or
				array_search( $s = 'szmatki do czyszczenia okularów', $this->_collections[$c] ) !== false or
				array_search( $s = 'linijki i zakładki', $this->_collections[$c] ) !== false or
				array_search( $s = 'materiały biurowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'uchwyty na długopisy', $this->_collections[$c] ) !== false or
				array_search( $s = 'kalkulatory', $this->_collections[$c] ) !== false or
				array_search( $s = 'prodkty szklane pod 3d', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Biuro i biznes';
				$subcat_name = $s;
				
			}
			elseif(
				array_search( $s = 'smycze', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Smycze';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'wieszaki na teczki', $this->_collections[$c] ) !== false or
				array_search( $s = 'monety do wózków zakupowych', $this->_collections[$c] ) !== false or
				array_search( $s = 'breloki', $this->_collections[$c] ) !== false or
				array_search( $s = 'latarki', $this->_collections[$c] ) !== false or
				array_search( $s = 'kieszonkowe noże, narzędzia i latarki', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria samochodowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria antystresowe', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'produkty fluoroscencyjne', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Odblaski';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'kosmetyczki', $this->_collections[$c] ) !== false or
				array_search( $s = 'lusterka oraz zestawy make-up oraz manicure', $this->_collections[$c] ) !== false or
				array_search( $s = 'ręczniki, szlafroki', $this->_collections[$c] ) !== false or
				array_search( $s = 'pudełeczka na tabletki oraz akcessoria medyczne', $this->_collections[$c] ) !== false or
				array_search( $s = 'lusterko ze szczotką', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Zdrowie i uroda';
				$subcat_name = $s;
			}
			
		}
		elseif(
			array_key_exists( $c = 'technology  mobile', $this->_collections ) or
			array_key_exists( $c = 'writing', $this->_collections )
		){
			
			if(
				array_search( $s = 'zegarki na rękę', $this->_collections[$c] ) !== false or
				array_search( $s = 'stacje pogodowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'zegary ścienne oraz na biurko', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Czas i pogoda';
				$subcat_name = $s;
				
			}
			elseif(
				array_search( $s = 'akcesoria do telefonów i tabletów', $this->_collections[$c] ) !== false or
				array_search( $s = 'power banki i ładowarki do telefonów', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria komputerowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'pendrive-y a hub-y usb i czytniki kart pamięci', $this->_collections[$c] ) !== false or
				array_search( $s = 'głośniki słuchawki', $this->_collections[$c] ) !== false or
				array_search( $s = 'rękawiczki do smartphonów', $this->_collections[$c] ) !== false or
				array_search( $s = 'rysiki do ekranów dotykowych', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Elektronika';
				$subcat_name = $s;
				
			}
			elseif(
				array_search( $s = 'długopisy plastikowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'długopisy ekologiczne', $this->_collections[$c] ) !== false or
				array_search( $s = 'długopisy metal-alu i drewniane', $this->_collections[$c] ) !== false or
				array_search( $s = 'długopisy ekskluzywne', $this->_collections[$c] ) !== false or
				array_search( $s = 'zestawy piśmiennicze', $this->_collections[$c] ) !== false or
				array_search( $s = 'zakreślacze', $this->_collections[$c] ) !== false or
				array_search( $s = 'ołówki', $this->_collections[$c] ) !== false or
				array_search( $s = 'gumki i ostrzynki', $this->_collections[$c] ) !== false or
				array_search( $s = 'pudełka na długopisy', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Materiały piśmiennicze';
				$subcat_name = $s;
				
			}
			
		}
		elseif(
			array_key_exists( $c = 'home  kitchen', $this->_collections ) or
			array_key_exists( $c = 'leisure  sport', $this->_collections ) or
			array_key_exists( $c = 'kids  toys', $this->_collections ) or
			array_key_exists( $c = 'bags  travel', $this->_collections )
		){
			
			if(
				array_search( $s = 'kubki i szklanki', $this->_collections[$c] ) !== false or
				array_search( $s = 'termosy i kubki', $this->_collections[$c] ) !== false or
				array_search( $s = 'butelki sportowe', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Do picia';
				$subcat_name = $s;
				
			}
			elseif(
				array_search( $s = 'akcesoria kuchenne', $this->_collections[$c] ) !== false or
				array_search( $s = 'fartuchy i akcesoria do pieczenia', $this->_collections[$c] ) !== false or
				array_search( $s = 'świece i kadzidła', $this->_collections[$c] ) !== false or
				array_search( $s = 'dekoracje domowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'otwieracze do win i otwieracze do butelek', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria do koktajli i palenia', $this->_collections[$c] ) !== false or
				array_search( $s = 'magnesy na lodówkę', $this->_collections[$c] ) !== false or
				array_search( $s = 'skarbonki', $this->_collections[$c] ) !== false or
				array_search( $s = 'zestawy do bbq', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Dom i ogród';
				$subcat_name = $s;
				
			}
			elseif(
				array_search( $s = 'jo-jo i magiczne puzzle', $this->_collections[$c] ) !== false or
				array_search( $s = 'zabawki i gry', $this->_collections[$c] ) !== false or
				array_search( $s = 'linijki i ostrzynki', $this->_collections[$c] ) !== false or
				array_search( $s = 'rysowanie i kolorowanie', $this->_collections[$c] ) !== false
				
			){
				$cat_name = 'Dzieci, zabawa, szkoła';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'parasole', $this->_collections[$c] ) !== false
				
			){
				$cat_name = 'Parasole i peleryny';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'torby papierowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'torby na zakupy', $this->_collections[$c] ) !== false or
				array_search( $s = 'torby na plażę', $this->_collections[$c] ) !== false or
				array_search( $s = 'torby podróżne, na kółkach i sportowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'torby na dokumenty, na ramię i na laptopa', $this->_collections[$c] ) !== false or
				array_search( $s = 'plecaki', $this->_collections[$c] ) !== false
				
			){
				$cat_name = 'Torby i plecaki';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'zestawy piknikowe, torby termoizolacyjne', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria podróżne', $this->_collections[$c] ) !== false or
				array_search( $s = 'japonki', $this->_collections[$c] ) !== false or
				array_search( $s = 'okulary słoneczne', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria i gry plażowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'lornetki i kompasy', $this->_collections[$c] ) !== false or
				array_search( $s = 'koce polarowe', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria sportowe i na zabawę', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria dla rowerzystó', $this->_collections[$c] ) !== false or
				array_search( $s = 'akcesoria dla psów', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Wakacje, sport i rekreacja';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'kapelusze na lato', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Tekstylia i odzież';
				$subcat_name = $s;
			}
			elseif(
				array_search( $s = 'portfele i etui na karty', $this->_collections[$c] ) !== false
			){
				$cat_name = 'Etui i portfele';
				$subcat_name = $s;
			}
			
		}
		elseif(
			array_key_exists( $c = 'textile  fashion', $this->_collections )
		){
			$cat_name = 'Tekstylia i odzież';
			$subcat_name = $this->_collections[ $c ][0];
			
		}
		elseif(
			array_key_exists( $c = 'cool 2018', $this->_collections ) or
			array_search( $c = 'cool 2018 nowości', $this->_collections['cool 2018'] ) !== false or
			array_key_exists( $c = 'cool brands', $this->_collections )
		){
			$cat_name = 'Cool 2018';
			$subcat_name = $c;
			
		}
		else{
			print_r( $this->_collections );
			
		}
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		/* wczytywanie produktów z XML */
		$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'products' ] ) );
		$dt = date( 'Y-m-d H:i:s' );

		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$code = (string)$item->itemNumber;
				$cat = addslashes( (string)$item->categories->category[0]->name );
				$category = $this->_stdName( $cat );
				$subcat = "";
				$subcategory = $this->_stdName( $subcat );

				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					$cat_id = $this->getCategory( 'name', $category, 'ID' );
				}
				else{
					$cat_id = $this->getCategory( 'name', $subcategory, 'ID' );
				}


				$sql = "UPDATE `XML_product` SET cat_id = '{$cat_id}', data = '{$dt}' WHERE code = '{$code}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );
				}

			}

		}
		else{
			foreach( $XML->product as $item ){
				/* tablica właściwości produktu */
				$prop_a = array();
				foreach( $item->properties->property as $prop ){
					$prop_a[ (string)$prop['name'] ] = (string)$prop['value'];
					
				}
				
				$code = (string)$item['no'];
				preg_match( '/^[^\-]+/', $code, $match );
				$short = $match[0];
				$name = addslashes( (string)$item['name'] );
				$price = $item['price'];
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				// $catalog = addslashes( (string)$item-> );
				$cat = "";
				$category = $this->_stdName( $cat );
				$subcat = "";
				$subcategory = $this->_stdName( $subcat );
				$dscr = addslashes( (string)$item->description );
				$dims = $prop_a['ROZMIAR PRODUKTU'];
				$material = "";
				$country = "";
				$weight = ( (float)str_replace( ",", ".", $prop_a['BRUTTO/KARTON'] ) / (float)str_replace( ",", ".", $prop_a['SZTUK/KARTON'] ) ) * 1000;
				$color = "";
				$photo_a = array();
				foreach( $item->images->image as $img ){
					$photo_a[] = (string)$img['src'];
				}
				$photo = json_encode( $photo_a );
				$new = 0;
				$sale = 0;
				$promotion = 0;
				$marking = $prop_a['METODA DRUKU'];
				
				$this->_collections = array();
				/* tablica kolekcji */
				foreach( $item->folders->folder as $col ){
					$this->_collections[ $this->_stdName( (string)$col['category'] ) ][] = $this->_stdName( (string)$col['subcategory'] );
					
				}
				
				// print_r( $this->_collections );
				
				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					// $cat_id = $this->getCategory( 'name', $category, 'ID' );
					$sql = "SELECT ID FROM XML_category WHERE parent IS NULL AND name = '{$category}'";
				}
				else{
					// $cat_id = $this->getCategory( 'name', $subcategory, 'ID' );
					$sql = "SELECT sub.ID
					FROM XML_category as cat
					JOIN XML_category as sub
					ON cat.ID = sub.parent
					WHERE cat.name = '{$category}' AND sub.name = '{$subcategory}'";
				}
				
				$query = mysqli_query( $this->_dbConnect(), $sql );
				$fetch = mysqli_fetch_assoc( $query );
				$cat_id = $fetch['ID'];
				
				/* aktualizacja czy wstawianie? */
				$sql = "SELECT COUNT(*) as num FROM `XML_product` WHERE code = '{$code}'";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				$fetch = mysqli_fetch_assoc( $query );
				$num = $fetch['num'];
				mysqli_free_result( $query );

				$insert = array(
					'shop' => $this->_atts['shop'],
					'code' => $code,
					'short' => $short,
					'cat_id' => $cat_id,
					'brutto' => $brutto,
					'netto' => $netto,
					// 'catalog' => $catalog,
					'title' => $name,
					'description' => $dscr,
					'materials' => $material,
					'dimension' => $dims,
					'country' => $country,
					'weight' => $weight,
					'colors' => $color,
					'photos' => $photo,
					'new' => $new,
					'promotion' => $promotion,
					'sale' => $sale,
					'data' => $dt,
					'marking' => $marking,
					'instock' => $stock_a[ $code ],
				);

				$t_fields = array();
				$t_values = array();

				/* aktualizacja */
				if( $num > 0 ){
					$t_sql = array();

					unset( $insert['code'] );
					$sql = "UPDATE XML_product SET ";

					foreach( $insert as $field => $value ){
						$t_sql[] = "`{$field}` = '{$value}'";
					}

					$sql .= implode( ", ", $t_sql );

					$sql .= " WHERE `code` = '{$code}'";

				}
				/* wstawianie */
				else{

					foreach( $insert as $field => $value ){
						$t_fields[] = "`{$field}`";
						$t_values[] = "'{$value}'";

					}

					$sql = sprintf(
						'INSERT INTO XML_product ( %s ) VALUES ( %s )',
						implode( ", ", $t_fields ),
						implode( ", ", $t_values )

					);


				}

				// echo "\r\n $sql \r\n";

				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				}
				
			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();
		

		if( !empty( $this->_log ) ){
			echo "<!--ANDA ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}
	
}
