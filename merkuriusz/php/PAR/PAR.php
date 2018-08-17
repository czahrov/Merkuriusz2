<?php
class PAR extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		/* generowanie tablicy ze stanem magazynowym */
		$stock_a = array();
		$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources['stock'] ) );
		foreach( $XML->produkt as $item ){
			$stock_a[ (string)$item->kod ] = (int)$item->stan_magazynowy;

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
			if( $XML !== false ) foreach( $XML->children() as $item ){
				$price = (string)$item->cena_pln;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				
				$photo_a = array();
				/* https://www.par.com.pl/shared/zdjecia_katalog/full/R91744_02_c.jpg */
				foreach( $item->zdjecia->children() as $img ){
					$photo_a[] = "https://www.par.com.pl/shared/zdjecia_katalog/full/" . basename( (string)$img );
				}
				
				$marking_a = array();
				foreach( $item->techniki_zdobienia->technika as $arg ){
					$marking_a[] = sprintf(
						'%s<br>
>%s
>>%s',
						(string)$arg->miejsce_zdobienia,
						(string)$arg->technika_zdobienia,
						(string)$arg->maksymalny_rozmiar_logo
					);

				}
				
				preg_match( '/^([^\.]+)/', (string)$item->kod, $short );
				
				$product = array(
					'code' => (string)$item->kod,
					'short' => $short[0],
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->nazwa ),
					'description' => addslashes( (string)$item->opis ),
					'catalog' => '',
					'brand' => '',
					'marking' => implode( '<br>', $marking_a ),
					'materials' => addslashes( (string)$item->material_wykonania ),
					'dimension' => addslashes( (string)$item->wymiary ),
					'colors' => addslashes( (string)$item->kolor_podstawowy ),
					'weight' => (float)$item->opakowania->opakowanie_jednostkowe->waga_brutto,
					'country' => '',
					'photos' => json_encode( $photo_a ),
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => '',
					'new' => (string)$item->towar_nowosc === "false"?( 0 ):( 1 ),
					'promotion' => (string)$item->promocja === "0"?( 0 ):( 1 ),
					'sale' => (string)$item->wyprzedaz === "false"?( 0 ):( 1 ),
					'data' => $dt,
				);
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) $this->_log[] = $t;
				
				foreach( $item->kategorie->kategoria as $cat ){
					$cat = addslashes( (string)$item->kategorie->kategoria[0] );
					$category = $this->_stdName( $cat );
					$subcat = "pozostałe";
					$subcategory = $this->_stdName( $subcat );
					
					// $this->_categoryFilter( $category, $subcategory, $item );
					$this->_addCategory( $category, $subcategory );
					
					// czyszczenie hash'u produktu przed wiązaniem
					$sql = "DELETE FROM XML_hash
					WHERE PID = '{$product['code']}'";
					// echo "\r\n{$sql}\r\n";
					$query = mysqli_query( $this->_dbConnect(), $sql );
					if( $query === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );
					
					// $this->_categoryFilter( $category, $subcategory, $item );
					$this->_addCategory( $category, $subcategory );
					if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) $this->_log[] = mysqli_error( $this->_dbConnect() );
					
				}
				
			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--PAR ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
