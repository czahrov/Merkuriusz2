<?php
class EASYGIFTS extends XMLAbstract{
	
	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		$dt = date( 'Y-m-d H:i:s' );

		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				
			}

		}
		else{
			/* generowanie tablicy ze stanem magazynowym */
			$stock_a = array();
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'stock' ] ) );
			foreach( $XML->children() as $item ){
				$stock_a[ (string)$item->code_full ] = array(
					'num' => (int)$item->quantity_24h + (int)$item->quantity_37days,
					'24h' => (int)$item->quantity_24h > 0,
				);
			}
			
			// parsowanie danych z XML
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'products' ] ) );
			foreach( $XML->children() as $num => $item ){
				$marking_a = array();
				if( $item->markgroups->count() ) foreach( $item->markgroups->markgroup as $child ){
					$marking_a[] = (string)$child->name;
				}
				$marking = implode( "<br>", $marking_a );
				
				$materials_a = array();
				if( $item->materials->count() ) foreach( $item->materials->material as $material ){
					$materials_a[] = (string)$material->name;
				}
				$materials = implode( ", ", $materials_a );
				
				$photo_a = array();
				if( $item->images->count() ) foreach( $item->images->children() as $img ){
					$photo_a[] = (string)$img;
				}
				$photos = json_encode( $photo_a );
				
				$price = $item->baseinfo->price;
				$price_promo = $item->baseinfo->price_promotion;
				$price_sellout = $item->baseinfo->price_sellout;
				if( (int)$item->additional_offer === 1 ){
					$netto = 0;
				}
				else{
					$netto = (float)str_replace( ",", ".", empty( $s = $price_sellout )?( empty( $p = $price_promo )?( $price ):( $p ) ):( $s ) );
				}
				$brutto = $netto * ( 1 + $this->_vat );
				
				$product = array(
					'code' => (string)$item->baseinfo->code_full,
					'short' => (string)$item->baseinfo->code_short,
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->baseinfo->name ),
					'description' => addslashes( (string)$item->baseinfo->intro ),
					'catalog' => '',
					'brand' => addslashes( (string)$item->brand->name ),
					'marking' => $marking,
					'materials' => $materials,
					'dimension' => addslashes( (string)$item->attributes->size ),
					'colors' => addslashes( (string)$item->color->name ),
					'weight' => (float)$item->attributes->weight,
					'country' => addslashes( (string)$item->origincountry->name ),
					'photos' => $photos,
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => !empty( $price_promo )?( (float)str_replace( ",", ".", $price ) ):( 0 ),
					'instock' => $stock_a[ (string)$item->baseinfo->code_full ]['num'],
					'new' => (int)$item->attributes->new,
					'promotion' => (float)$item->baseinfo->price_promotion > 0?( 1 ):( 0 ),
					'sale' => (float)$item->baseinfo->price_sellout > 0?( 1 ):( 0 ),
					'data' => $dt,
				);
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				if( $item->categories->count() ) foreach( $item->categories->category as $cat ){
					$category = $this->_stdName( (string)$cat->name );
					$subcategory = 'pozostałe';
					
					if( in_array( $category, array( 'inne', 'katalog świąteczny 2015' ) ) ){
						continue;
					}
					
					if( in_array( $category, array( 'cerruti 1881', 'cacharel', 'ungaro', 'nina ricci', 'jean-louis scherrer', 'christian lacroix' ) ) ){
						$this->_addCategory( $c = 'Power of brands - oferta specjalna 24h', $category );
						if( $this->_bindProduct( $product, $c, $category ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
						$this->_addCategory( $s = 'Kolekcja VIP', $c );
						if( $this->_bindProduct( $product, $s, $c ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
					}
					
					if( in_array( $category, array( 'elektronika markowa', 'cerruti 1881', 'power of brands', 'cacharel', 'ungaro', 'nina ricci', 'jean-louis scherrer', 'christian lacroix', 'wenger - bagaże biznesowe i akcesoria podróżne', 'wenger - bestsellery', 'victorinox', 'victorinox delemont collection', 'victorinox lifestyle - akcesoria podróżne', 'victorinox altmont - plecaki i torby' ) )
					){
						$this->_addCategory( $c = 'Kolekcja VIP', $category );
						if( $this->_bindProduct( $product, $c, $category ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
					}
					
					if( $cat->subcategories->count() ){
						foreach( $cat->subcategories->subcategory as $subcat ){
							$subcategory = $this->_stdName( $subcat->name );
							$this->_addCategory( $category, $subcategory );
							if( $this->_bindProduct( $product, $category, $subcategory ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						}
						
					}
					else{
						$this->_addCategory( $category, $subcategory );
						if( $this->_bindProduct( $product, $category, $subcategory ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
					}
					
					if( $stock_a[ (string)$item->baseinfo->code_full ]['24h'] ){
						
						if( $category == 'import' ){
							$subcategory = 'produkty importowe dostępne 24h';
						}
						elseif( in_array( $category, array( 'pendrivey', 'power banki' ) ) ){
							$subcategory = "{$category} dostępne 24h";
							
						}
						
						$this->_addCategory( $category, $subcategory );
						if( $this->_bindProduct( $product, $category, $subcategory ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
					}
					
					
				}
				
			}
			
		}
		
		if( !empty( $this->_log ) ){
			echo "<!--EASYGIFTS ERROR:" . PHP_EOL;
			print_r( array_slice( $this->_log, -10 ) ) . PHP_EOL;
			echo "-->";

		}

	}


}
