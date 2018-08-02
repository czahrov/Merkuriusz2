<?php
class FALKROSS extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
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
			// echo PHP_EOL . "> parsowanie XML";
			$counter = 0;
			
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$price = 0;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				
				foreach( $item->sku_list->sku as $variant ){
					$name = sprintf(
						'%s %s',
						addslashes( (string)$item->style_name->language->pl ),
						addslashes( (string)$variant->sku_size_name )
					);
					
					$photo_a = array();
					if( basename( $c = (string)$variant->sku_color_picture_url ) !== 'picture' ) $photo_a[] = $c;
					foreach( $item->style_picture_list->style_picture as $img ){
						$photo_a[] = (string)$img->url;
					}
					
					preg_match( '/^(.+).{4}$/', (string)$variant->sku_artnum, $match );
					
					$product = array(
						'code' => (string)$variant->sku_artnum,
						'short' => $match[1],
						'shop' => $this->_atts['shop'],
						'title' => $name,
						'description' => addslashes( (string)$item->style_description->language->pl ),
						'catalog' => '',
						'brand' => '',
						'marking' => '',
						'materials' => '',
						'dimension' => '',
						'colors' => addslashes( (string)$variant->sku_color_name ),
						'weight' => (float)$variant->sku_weight * 1000,
						'country' => (string)$variant->sku_coo,
						'photos' => json_encode( $photo_a ),
						'currency' => '',
						'netto' => $netto,
						'brutto' => $brutto,
						'price_alt' => '',
						'price_before' => '',
						'instock' => '',
						'new' => (int)$variant->sku_new > 0?( 1 ):( 0 ),
						'promotion' => 0,
						'sale' => (int)$variant->sku_closeout > 0?( 1 ):( 0 ),
						'data' => $dt,
					);
					
					if( ( $t = $this->_addItem( $product ) ) !== true ){
						// $this->_log[] = $t;
						echo "\r\nMySQL ERROR:" . mysqli_error( $this->_dbConnect() ) . "\r\n";
						
					}
					
					// czyszczenie hash'u produktu przed wiązaniem
					$sql = "DELETE FROM XML_hash
					WHERE PID = '{$product['code']}'";
					$query = mysqli_query( $this->_dbConnect(), $sql );
					if( $query === false ){
						// $this->_log[] = mysqli_error( $this->_dbConnect() );
						echo "\r\nMySQL ERROR:" . mysqli_error( $this->_dbConnect() ) . "\r\n";
						
					}
					
					// $this->_categoryFilter( $category, $subcategory, $item );
					$category = $this->_stdName( (string)$item->style_category_list->style_category_main[0] );
					$subcategory = $this->_stdName( (string)$item->style_category_list->style_category_main[0]->style_category_sub[0]->language->pl );
					
					$this->_addCategory( $category, $subcategory );
					if( $this->_bindProduct( $product, $category, $subcategory ) !== true ){
						// $this->_log[] = mysqli_error( $this->_dbConnect() );
						echo "\r\nMySQL ERROR:" . mysqli_error( $this->_dbConnect() ) . "\r\n";
						
					}
					
					$counter++;
					if( fmod( $counter, 10000 ) == 0 ){
						echo "@";
					}
					if( fmod( $counter, 1000 ) == 0 ){
						echo "#";
					}
					elseif( fmod( $counter, 100 ) == 0 ){
						echo ".";
					}
					
					/* print_r( array(
						'product' => $product,
						'category' => $category,
						'subcategory' => $subcategory,
						
					) );
					return; */
					// echo "\r\n $sql \r\n";

					/* if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
						$this->_log[] = $sql;
						$this->_log[] = mysqli_error( $this->_dbConnect() );
					} */

					// echo "\r\n{$category} | {$subcategory}";
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
