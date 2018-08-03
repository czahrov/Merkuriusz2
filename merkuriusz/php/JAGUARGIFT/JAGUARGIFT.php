<?php
class JAGUARGIFT extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		/* Ładowanie pliku XML z produktami */
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Accept-language: pl\r\n" .
				"Authorization: Token b877f60a12c850f74a169fa036265f852b38be79\r\n"
			)
		);
		$context = stream_context_create( $opts );
		$url = "http://www.jaguargift.com/pl/jaguargift.xml";
		$local = __DIR__ . "/DND/" . basename( $url );
		mkdir( dirname( $local ), 0755, true );
		$exist = file_exists( $local );
		$actual = ( time() - filemtime( $local ) ) < $this->_atts['lifetime'];
		
		/* plik lokalny istnieje */
		if( $exist ){
			echo "\r\n> Plik lokalny istnieje";
			
			/* plik lokalny jest aktualny */
			if( $actual ){
				echo "\r\n> Czas ostatniej aktualizacji: " . date( "Y-m-d H:i:s", filemtime( $local ) );
				echo "\r\n> Plik lokalny jest aktualny, ładuję dane z dysku\r\n";
				$XML = simplexml_load_file( $local );
			}
			/* aktualizaja pliku lokalnego */
			else{
				echo "\r\n> Plik lokalny jest nieaktualny, aktualizacja";
				$file = file_get_contents( $url, false, $context );
				/* pobieranie udane, zapisywanie do pliku */
				if( $file !== false ){
					echo "\r\n> Aktualizacja udana";
					file_put_contents( $local, $file );
				}
				else{
					echo "\r\n> Aktualizacja nieudana";
					
				}
				
				echo "\r\n> Wczytywanie danych z pliku\r\n";
				$XML = simplexml_load_file( $local );
			}
			
		}
		else{
			/* nie udało się pobrać pliku, anulowanie */
			echo "\r\n> Plik lokalny nie istnieje, pobieram";
			$file = file_get_contents( $url, false, $context );
			/* pobieranie udane, zapisywanie do pliku */
			if( $file !== false ){
				echo "\r\n> Pobieranie udane";
				file_put_contents( $local, $file );
				echo "\r\n> Wczytywanie danych z pliku\r\n";
				$XML = simplexml_load_file( $local );
				
			}
			else{
				echo "\r\n> Pobieranie nieudane, przerywam!";
				return false;
			}
			
		}
		
		
		$dt = date( 'Y-m-d H:i:s' );

		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				
			}

		}
		else{
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$marking_a = array();
				foreach( $item->marking->{'list-item'} as $arg ){
					if( (string)$item->availability !== "Niedostępne" ) $marking_a[] = (string)$arg->name;

				}
				$price = (string)$item->price_eur;
				$netto = (float)str_replace( ",", ".", $price ) / $this->_eur;
				$brutto = $netto * ( 1 + $this->_vat );
				
				foreach( $item->available_colors->{'list-item'} as $variant ){
					$photo_a = array();
					$i = (string)$variant->main_image->image;
					if( $i !== "" ) $photo_a[] = $i;
					foreach( $item->images->{'list-item'} as $img ){
						$photo_a[] = (string)$img->image;
					}
					
					$product = array(
						'code' => (string)$variant->id,
						'short' => (string)$variant->id,
						'shop' => $this->_atts['shop'],
						'title' => addslashes( (string)$variant->name ),
						'description' => (string)$item->features->{'list-item'}[0]->value,
						'catalog' => '',
						'brand' => '',
						'marking' => implode( "<br>", $marking_a ),
						'materials' => addslashes( (string)$item->materials->{'list-item'}->value ),
						'dimension' => addslashes( (string)$item->size ),
						'colors' => addslashes( (string)$variant->color->name ),
						'weight' => (float)$item->weight * 1000,
						'country' => '',
						'photos' => json_encode( $photo_a ),
						'currency' => 'PLN',
						'netto' => $netto,
						'brutto' => $brutto,
						'price_alt' => '',
						'price_before' => '',
						'instock' => (int)$variant->availability_count,
						'new' => (string)$item->is_new === "False"?( 0 ):( 1 ),
						'promotion' => 0,
						'sale' => 0,
						'data' => $dt,
					);
					
					if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
					
					// czyszczenie hash'u produktu przed wiązaniem
					$sql = "DELETE FROM XML_hash
					WHERE PID = '{$product['code']}'";
					$query = mysqli_query( $this->_dbConnect(), $sql );
					if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
					
					// $this->_categoryFilter( $category, $subcategory, $item );
					
					foreach( $item->category->{'list-item'} as $cat ){
						$category = $this->_stdName( (string)$cat->name );
						$subcategory = 'pozostałe';
						$this->_addCategory( $category, $subcategory );
						if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
					}
					
				}
				
				// echo "\r\n $sql \r\n";

				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				}

				// echo "\r\n{$category} | {$subcategory}";

			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--JAGUARGIFT ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
