<?php
class ASGARD extends XMLAbstract{

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
			foreach( $XML->produkt as $item ){
				preg_match( '/^[^\-]+/', (string)$item->indeks, $short );
				
				$price = (string)$item->cena_netto_katalogowa;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				
				$photo_base = "https://asgard.pl/png/product/";
				$photo = json_encode( array(
					$photo_base . (string)$item->obraz,
					$photo_base . (string)$item->obraz_1,
					
				) );
				
				$product = array(
					'code' => (string)$item->indeks,
					'short' => $short[0],
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->nazwa ),
					'description' => addslashes( (string)$item->opis_produktu ),
					'catalog' => '',
					'brand' => '',
					'marking' => (string)$item->znakowanie_produktu,
					'materials' => addslashes( (string)$item->material ),
					'dimension' => addslashes( (string)$item->wymiary_produktu ),
					'colors' => addslashes( (string)$item->kolor ),
					'weight' => (float)str_replace( ",", ".", $item->waga_jednostkowa_netto_w_kg ) * 1000,
					'country' => '',
					'photos' => $photo,
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => (int)$item->in_stock,
					'new' => (string)$item->status == 'Nowość'?( 1 ):( 0 ),
					'promotion' => 0,
					'sale' => 0,
					'data' => $dt,
				);
				
				$cat = addslashes( (string)$item->kategoria );
				$category = $this->_stdName( $cat );
				$subcat = addslashes( (string)$item->podkategoria );
				$subcategory = $this->_stdName( $subcat );
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				// $this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );
				if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
				
				// echo "\r\n{$category} | {$subcategory}";

			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();
		
		if( !empty( $this->_log ) ){
			echo "<!--ASGARD ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
