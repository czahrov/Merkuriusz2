<?php
class AXPOL extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		if( mb_stripos( $cat_name, 'wine club' ) !== false ){
			$cat_name = 'Vine Club';
		}
		elseif( mb_stripos( $cat_name, 'voyager xd' ) !== false ){
			$cat_name = 'Voyager XD';
		}
		elseif( mb_stripos( $cat_name, 'wyprzedaż' ) !== false ){
			$cat_name = 'Inne';
		}
		
		if( empty( $cat_name ) ) $cat_name = 'Inne';
		if( empty( $subcat_name ) ) $subcat_name = 'Pozostałe';
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		
		// wczytywanie pliku XML z produktami
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
			foreach( $XML->items->Produkt as $item ){
				$stock_a[ (string)$item->Kod ] = (int)$item->na_magazynie_dostepne_teraz;	
			}
			
			/* generowanie tablicy z dostępnymi znakowaniami */
			$print_a = array();
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'print' ] ) );
			foreach( $XML->Row as $item ){
				$out = array();
				
				for( $pos = 1; $pos <= 6; $pos++){
					if( empty( (string)$item->{"Position_{$pos}_PrintPosition"} ) ) continue;
					$t = array();
					
					for( $tech = 1; $tech <= 5; $tech++ ){
						if( !empty( $c = (string)$item->{"Position_{$pos}_PrintTech_{$tech}"} ) ) $t[] = $c;
					}
					
					$out[] = sprintf(
						'%s [%s mm] (%s)',
						(string)$item->{"Position_{$pos}_PrintPosition"},
						(string)$item->{"Position_{$pos}_PrintSize"},
						implode( ", ", $t )
					);
					
				}
				
				$print_a[ (string)$item->CodeERP ] = implode( "<br>", $out );
			}
			
			// parsowanie danych z XML
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'products' ] ) );
			
			foreach( $XML->Row as $item ){
				preg_match( '/^[^\-]+/', (string)$item->CodeERP, $short );
				
				$netto = (float)str_replace( ",", ".", (string)$item->CatalogPricePLN );
				$brutto = $netto * ( 1 + $this->_vat );
				
				$dscr = addslashes( (string)$item->DescriptionPL );
				if( strlen( (string)$item->ExtraTextPL ) > 0 ) $dscr .= addslashes( "<br><br>" . htmlentities( (string)$item->ExtraTextPL ) );
				
				$photo_a = array();
				for( $i=1; $i<=20; $i++ ){
					$t = (string)$item->{sprintf( "Foto%'02u", $i )};
					if( !empty( $t ) ){
						$photo_a[] = sprintf( "https://axpol.com.pl/files/%s/%s",
							$i == 1?( 'fotob' ):( 'foto_add_big' ),
							$t
						);
					}
				}
				
				$product = array(
					'code' => (string)$item->CodeERP,
					'short' => $short[0],
					'shop' => $this->_atts['shop'],
					'title' => addslashes( (string)$item->TitlePL ),
					'description' => $dscr,
					'catalog' => addslashes( (string)$item->Catalog ),
					'brand' => '',
					'marking' => $print_a[ (string)$item->CodeERP ],
					'materials' => addslashes( (string)$item->MaterialPL ),
					'dimension' => addslashes( (string)$item->Dimensions ),
					'colors' => addslashes( (string)$item->ColorPL ),
					'weight' => (integer)$item->ItemWeightG,
					'country' => addslashes( (string)$item->CountryOfOrigin ),
					'photos' => json_encode( $photo_a ),
					'currency' => 'PLN',
					'netto' => $netto,
					'brutto' => $brutto,
					'price_alt' => '',
					'price_before' => '',
					'instock' => array_key_exists( $k = (string)$item->CodeERP, $stock_a )?( $stock_a[ $k ] ):( 0 ),
					'new' => (int)$item->New,
					'promotion' => (int)$item->Promotion,
					'sale' => (int)$item->Sale,
					'data' => $dt,
				);
				
				if( ( $t = $this->_addItem( $product ) ) !== true ) echo "\r\n{$t}";
				
				// czyszczenie hash'u produktu przed wiązaniem
				$sql = "DELETE FROM XML_hash
				WHERE PID = '{$product['code']}'";
				// echo "\r\n{$sql}\r\n";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				if( $query === false ) echo "\r\n" . mysqli_error( $this->_dbConnect() );
				
				$category = $this->_stdName( (string)$item->MainCategoryPL );
				$subcategory = $this->_stdName( (string)$item->SubCategoryPL );
				$this->_categoryFilter( $category, $subcategory, $item );
				
				$this->_addCategory( $category, $subcategory );
				if( $this->_bindProduct( $product, $category, $subcategory ) !== true ) 
					echo "\r\n" . mysqli_error( $this->_dbConnect() );
				
			}
			
		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--AXPOL ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
