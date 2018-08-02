<?php
class INSPIRION extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
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
			foreach( $XML->children() as $item ){
				
				$price = (string)$item->catalog_price;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				
				/* https://inspirion.pl/sites/default/files/imagecache/product_full/56-1103282.jpg */
				$photo = json_encode( array_map( function( $arg ){
					return "https://inspirion.pl/sites/default/files/imagecache/product_full/" . basename( $arg );

				}, explode( ", ", (string)$item->product_images ) ) );
				
				$product = array(
					'code' => (string)$item->sku,
					'short' => (string)$item->sku,
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->product_name ),
					'description' => addslashes( (string)$item->body ),
					'catalog' => '',
					'brand' => '',
					'marking' => (string)$item->Imprint-size,
					'materials' => addslashes( (string)$item->material ),
					'dimension' => addslashes( (string)$item->wymiary ),
					'colors' => addslashes( (string)$item->kolor ),
					'weight' => (float)$item->weight_gross,
					'country' => '',
					'photos' => $photo,
					'currency' => '',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => '',
					'new' => 0,
					'promotion' => 0,
					'sale' => 0,
					'data' => $dt,
				);
				
				$cat = addslashes( (string)$item->catalog );
				$category = $this->_stdName( $cat );
				$subcat = addslashes( (string)$item->catalog_special );
				$subcategory = $this->_stdName( $subcat );
				if( empty( $subcategory ) ) $subcategory = 'pozostałe';
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				// echo "\r\n{$sql}\r\n";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				// $this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );
				if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				/* print_r( array(
					'category' => $category,
					'subcategory' => $subcategory,
					'product' => $product,
					
				) );
				return; */
				
				/* printf(
					'%s%s > %s',
					PHP_EOL,
					$category,
					$subcategory
				); */

				/* if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				} */

				// echo "\r\n{$category} | {$subcategory}";

			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--INSPIRION ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
