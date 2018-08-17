<?php
class FALKROSS extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		$cat_name = $subcat_name;
		$subcat_name = 'pozostałe';
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		// echo PHP_EOL . "> ładowanie XML";
		
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
			foreach( $XML->style as $item ){
				
				$name = (string)$item->style_name->language->pl;
				
				$photo_a = array();
				if( $item->style_picture_list->count() ) foreach( $item->style_picture_list->style_picture as $img ){
					$photo_a[] = (string)$img->url;
				}
				
				$price = 0;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				
				$color_a = array();
				$size_a = array();
				
				if( $item->sku_list->count() ) foreach( $item->sku_list->sku as $variant ){
					$c = (string)$variant->sku_color_name;
					if( array_search( $c, $color_a ) === false ){
						$color_a[] = $c;
						$photo_a[] = (string)$variant->sku_color_picture_url;
					}
					
					$s = (string)$variant->sku_size_name;
					if( array_search( $s, $size_a ) === false ){
						$size_a[] = $s;
					}
				}
				
				preg_match( '/^(.+)(.{2})$/', (string)$item->style_nr, $match );
				
				$product = array(
					'code' => "{$match[1]}.{$match[2]}",
					'short' => "{$match[1]}.{$match[2]}",
					'shop' => $this->_atts['shop'],
					'title' => $name,
					'description' => addslashes( (string)$item->style_description->language->pl ),
					'catalog' => '',
					'brand' => '',
					'marking' => '',
					'materials' => '',
					'dimension' => implode( ", ", $size_a ),
					'colors' => addslashes( implode( ", ", $color_a ) ),
					'weight' => (float)$item->sku_list->sku[0]->sku_weight * 1000,
					'country' => (string)$item->sku_list->sku[0]->sku_coo,
					'photos' => json_encode( $photo_a ),
					'currency' => '',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => '',
					'new' => (int)$item->sku_list->sku[0]->sku_new > 0?( 1 ):( 0 ),
					'promotion' => 0,
					'sale' => (int)$item->sku_list->sku[0]->sku_closeout > 0?( 1 ):( 0 ),
					'data' => $dt,
				);
				
				if( ( $t = $this->_addItem( $product ) ) !== true ){
					echo "\r\naddItem ERROR:" . $product['code'] . "\r\n";
				}
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ){
					echo "\r\nMyclearHash ERROR:" . mysqli_error( $this->_dbConnect() ) . "\r\n";	
				}
				
				$category = $this->_stdName( (string)$item->style_category_list->style_category_main[0] );
				$subcategory = $this->_stdName( (string)$item->style_category_list->style_category_main[0]->style_category_sub[0]->language->pl );
				$this->_categoryFilter( $category, $subcategory, $item );
				
				$this->_addCategory( $category, $subcategory );
				if( $this->_bindProduct( $product, $category, $subcategory ) !== true ){
					echo "\r\naddCategory ERROR:" . mysqli_error( $this->_dbConnect() ) . "\r\n";
					
				}
				
				
			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--FALKROSS ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
