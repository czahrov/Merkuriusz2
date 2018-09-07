<?php
class MACMA extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		if( $cat_name == 'polaroid' ){
			$subcat_name = $cat_name;
			$cat_name = 'elektronika markowa';
		}
		
		if( $subcat_name == null ) $subcat_name = 'pozostałe';
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		/* generowanie tablicy z cenami */
		$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources['prices'] ) );
		$price_a = array();
		foreach( $XML->children() as $product ){
			$price_a[ (string)$product->code_full ] = (float)str_replace( ",", ".", (string)$product->price );

		}

		/* generowanie tablicy ze stanem magazynowym */
		$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources['stock'] ) );
		$stock_a = array();
		foreach( $XML->children() as $product ){
			$stock_a[ (string)$product->code_full ] = (int)$product->quantity_24h + (int)$product->quantity_37days;

		}

		// wczytywanie pliku XML z produktami
		$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'products' ] ) );
		$dt = date( 'Y-m-d H:i:s' );
		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				
			}

		}
		else{
			// parsowanie danych z XML
			foreach( $XML->product as $num => $item ){
				$netto = $price_a[ (string)$item->baseinfo->code_full ];
				$brutto = $netto * ( 1 + $this->_vat );
				
				/* pobieranie zdjęć */
				$photo_a = array();
				if( $item->images->count() ) foreach( $item->images->children() as $img ){
					$id = (string)$item->baseinfo->code_full;
					$remote = (string)$img;
					$local = __DIR__ . "/IMG/{$id}/" . basename( $remote );

					if( !file_exists( dirname( $local ) ) ) mkdir( dirname( $local ), 0755, true );
					if( !file_exists( $local ) and !copy( $remote, $local ) ){
						$photo_a[] = $remote;

					}
					else{
						$photo_a[] = sprintf(
							'%s/wp-content/themes/merkuriusz/php/MACMA/IMG/%s/%s',
							$_SERVER['SERVER_NAME'] === 'localhost'?( '/merkuriusz2' ):( '' ),
							$id,
							basename( $remote )
						);
						
					}
					
				}
				
				$marking_a = array();
				foreach( $item->markgroups->children() as $mark ){
					$marking_a[] = (string)$mark->name;

				}
				$marking = "[" . (string)$item->marking_size . "]<br>" . implode( ", ", $marking_a );
				
				$product = array(
					'code' => (string)$item->baseinfo->code_full,
					'short' => (string)$item->baseinfo->code_short,
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->baseinfo->name ),
					'description' => addslashes( (string)$item->baseinfo->intro ),
					'catalog' => '',
					'brand' => '',
					'marking' => $marking,
					'materials' => addslashes( (string)$item->materials->material[0]->name ),
					'dimension' => addslashes( (string)$item->attributes->size ),
					'colors' => addslashes( (string)$item->color->name ),
					'weight' => (integer)$item->attributes->weight,
					'country' => addslashes( (string)$item->origincountry->name ),
					'photos' => json_encode( $photo_a ),
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => $stock_a[ (string)$item->baseinfo->code_full ],
					'new' => (int)$item->attributes->new,
					'promotion' => 0,
					'sale' => 0,
					'data' => $dt,
				);
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				// echo "\r\n{$sql}\r\n";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				if( $product['new'] ){
					$this->_addCategory( 'nowość', 'pozostałe' );
					$this->_bindProduct( $product, 'nowość', 'pozostałe' );
				}
				
				if( $item->categories->count() ) foreach( $item->categories->category as $cat ){
					$category = $this->_stdName( (string)$cat->name );
					$subcategory = null;
					
					if( $cat->subcategories->count() ) foreach( $cat->subcategories->subcategory as $sub ){
						$subcategory = $this->_stdName( (string)$sub->name );
						$this->_categoryFilter( $category, $subcategory, $item );
						$this->_addCategory( $category, $subcategory );
						if( $category == ( $s  = 'schwarzwolf' ) ){
							$this->_addCategory( $c = 'kolekcja vip', $s );
							if( $this->_bindProduct( $product, $c, $s ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						}
						if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
					}
					
					if( $subcategory === null ){
						$this->_categoryFilter( $category, $subcategory, $item );
						$this->_addCategory( $category, $subcategory );
						if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
						
					}
					
				}
				
			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--MACMA ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
