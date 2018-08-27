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
			$id = (string)$item->itemNumber;
			$pos_a = array();
			foreach( $item->positions->position as $pos ){
				$pos_name = (string)$pos->posName;
				$tech_a = array();
				foreach( $pos->technologies->technology as $tech ){
					$tech_code = (string)$tech->Code;
					$tech_name = (string)$tech->Name;
					$tech_colors = (string)$tech->maxColor;
					$tech_maxW = (string)$tech->maxWmm;
					$tech_maxH = (string)$tech->maxHmm;
					$tech_maxD = (string)$tech->maxDmm;
					$tech_a[] = sprintf(
						'%s: %s (%s) kolory:%s, %s mm',
						$pos_name,
						$tech_name,
						$tech_code,
						$tech_colors,
						implode(
							'x', 
							array_filter(
								array( $tech_maxW, $tech_maxH, $tech_maxD ), 
								function( $arg ){
									return !empty( $arg );
								}
							)
						)
					);
				}
				$pos_a[] = implode( '<br>', $tech_a );
			}
			$mark_a[ $id ] = implode( '<br>', $pos_a );
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
					$catalog_a[] = addslashes( (string)$col->name );
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
					'title' => addslashes( (string)$item->name ),
					'description' => addslashes( (string)$item->descriptions ),
					'catalog' => implode( ", ", $catalog_a ),
					'brand' => addslashes( (string)$item->designName ),
					'marking' => $mark_a[ (string)$item->itemNumber ],
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
				
				if( count( array_filter( $catalog_a, function( $arg ){
					return stripos( $arg, 'be creative' ) !== false;
					
				} ) ) ){
					$subcategory = $category;
					$category = 'Be Creative';
				}
				
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
