<?php
class ANDA extends XMLAbstract{
	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		$sources = array(
			'products' => 'https://xml.andapresent.com/export/products/pl/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
			'prices' => 'https://xml.andapresent.com/export/prices/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
			'instock' => 'https://xml.andapresent.com/export/labeling/en/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
			'marking' => 'https://xml.andapresent.com/export/inventories/KKS4H3KL7CNWXP3B98ZY7SLQ8MCFNIPX37WMPAT9PCYWL458TRUCV6IG6NUDKWLP',
		);
		
		/* sprawdzanie źródeł */
		foreach( $sources as $name => $uri ){
			if( file_exists( __DIR__ . "/DND/{$name}" ) ){
				echo "\r\n plik [{$name}] istnieje";
			}
			else{
				echo "\r\n plik [{$name}] nie istnieje, pobieram";
				$content = file_get_contents( $uri );
				if( $content !== false and strlen( $content ) > 200 ){
					if( file_put_contents( __DIR__ . "/DND/{$name}", $content ) !== false ){
						echo "\r\n plik [{$name}] zapisany pomyślnie";
					}
					else{
						echo "\r\n nie udało się zapisać pliku [{$name}]";
					}
					
				}
				
			}
			
		}
		
		echo "\r\n";
		
		/* generowanie tablicy stanu magazynowego */
		$stock_a = array();
		$XML = simplexml_load_file( __DIR__ . "/DND/instock" );
		foreach( $XML->record as $item ){
			$stock_a[ (string)$item->itemNumber ] = (int)$item->amount;
		}
		
		/* generowanie tablicy z cenami */
		$price_a = array();
		$XML = simplexml_load_file( __DIR__ . "/DND/prices" );
		foreach( $XML->price as $item ){
			$price_a[ (string)$item->itemNumber ][ (string)$item->type ] = (float)$item->amount;
		}
		
		/* generowanie tablicy ze znakowaniem */
		$mark_a = array();
		$XML = simplexml_load_file( __DIR__ . "/DND/marking" );
		foreach( $XML->labeling as $item ){
			foreach( $item->positions->position as $pos ){
				foreach( $pos->technologies->technology[0] as $tech ){
					$mark_a[ (string)$item->itemNumber ][] = sprintf(
						'%s (%s) %s (kolory: %s)',
						(string)$tech->Name,
						(string)$tech->Code,
						implode( 'x', array_filter( array( (int)$tech->maxWmm, (int)$tech->maxHmm, (int)$tech->maxDmm ), function( $arg ){
							return !empty( $arg );
						} ) ),
						(int)$item->maxColor
						
					);
					
				}
				
			}
			
		}
		
		/* wczytywanie produktów z XML */
		$XML = simplexml_load_file( __DIR__ . "/DND/products" );
		
		$dt = date( 'Y-m-d H:i:s' );
		
		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				
			}

		}
		else{
			foreach( $XML->product as $item ){
				
				$catalog_a = array();
				foreach( $item->collections->collections->collection as $col ){
					$catalog_a[] = (string)$col->name;
				}
				
				$prop_a = array(
					'materials' => array(),
					'dim' => array(),
				);
				foreach( $item->specification->property as $prop ){
					if( strpos( (string)$prop->name, 'Mater' ) !== false ){
						$prop_a['materials'][] = (string)$prop->values->value[0];
						
					}
					elseif( strpos( (string)$prop->name, 'Rozm' ) !== false or strpos( (string)$prop->name, 'Pojem' ) !== false ){
						$prop_a['dim'][] = (string)$prop->values->value[0];
						
					}
					
				}
				
				$photos_a = array();
				foreach( $item->images->image as $img ){
					$photos_a[] = (string)$img;
				}
				
				$netto =  array_key_exists( $k = (string)$item->itemNumber, $price_a )?( $price_a[ $k ][ 'listPrice' ] ):( 0 );
				$brutto = $netto * ( 1 + $this->_vat );
				
				preg_match( '/^[^\-]+/', (string)$item->itemNumber, $short );
				
				$product = array(
					'code' => (string)$item->itemNumber,
					'short' => $short[0],
					'shop' => $this->_atts['shop'],
					'title' => (string)$item->name,
					'description' => (string)$item->descriptions,
					'catalog' => implode( ", ", $catalog_a ),
					'brand' => (string)$item->designName,
					'marking' => '',
					'materials' => implode( ' / ', $prop_a['materials'] ),
					'dimension' => implode( ' / ', $prop_a['dim'] ),
					'colors' => implode( ', ', array_filter( array( (string)$item->primaryColor, (string)$item->secondaryColor ), function( $arg ){ return !empty( $arg ); } ) ),
					'weight' => (int)$item->individualProductWeightGram,
					'country' => (string)$item->countryOfOrigin,
					'photos' => json_encode( $photos_a ),
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => array_key_exists( $k = (string)$item->itemNumber, $stock_a )?( $stock_a[ $k ] ):( 0 ),
					'new' => 0,
					'promotion' => 0,
					'sale' => 0,
					'data' => $dt,
				);
				
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) echo "\r\naddItem ERROR: {$product['code']}";
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				// echo "\r\n{$sql}\r\n";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) echo "\r\nclearHash Error: " . mysqli_error( $this->_dbConnect() );
				
				$category = $this->_stdName( (string)$item->categories->category[0]->name );
				$subcategory = $this->_stdName( (string)$item->categories->category[1]->name );
				
				if( empty( $category ) ) $category = 'Inne';
				if( empty( $subcategory ) ) $subcategory = 'Pozostałe';
				
				$this->_addCategory( $category, $subcategory );
				if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) echo "\r\nbindProduct Error: " . mysqli_error( $this->_dbConnect() );
				
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
