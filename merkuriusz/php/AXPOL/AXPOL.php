<?php
class AXPOL extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		if( stripos( (string)$item->DescriptionPL, 'moleskine' ) !== false ){
			if(
				stripos( (string)$item->DescriptionPL, $c = 'notatnik' ) !== false or
				stripos( (string)$item->DescriptionPL, $c = 'kalendarz' ) !== false
			){
				$cat_name = 'Biuro i biznes';
				$subcat_name = $c;
			}
			
		}
		elseif( $cat_name === 'biuro' ){
			$cat_name = 'Biuro i biznes';
			
		}
		elseif( $cat_name === 'voyager plus' ){
			
			if( $subcat_name === 'biuro' ){
				$cat_name = 'Biuro i biznes';
				$subcat_name = 'Voyager plus';
				
			}
			
		}
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		// wczytywanie pliku XML z produktami
		$dt = date( 'Y-m-d H:i:s' );

		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$code = (string)$item->CodeERP;
				$category = $this->_stdName( (string)$item->MainCategoryPL );
				$subcategory = $this->_stdName( (string)$item->SubCategoryPL );

				if( $this->_categoryFilter( $category, $subcategory, $item ) === false ) continue;
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					$cat_id = $this->getCategory( 'name', $category, 'ID' );

				}
				else{
					$cat_id = $this->getCategory( 'name', $subcategory, 'ID' );

				}

				$sql = "UPDATE `XML_product` SET cat_id = '{$cat_id}', data = '{$dt}' WHERE code = '{$code}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );

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
				$code = (string)$item->CodeERP;
				preg_match( '/^[^\-]+/', $code, $match );
				$short = $match[0];
				$netto = (float)str_replace( ",", ".", (string)$item->CatalogPricePLN );
				$brutto = $netto * ( 1 + $this->_vat );
				$catalog = addslashes( (string)$item->Catalog );
				$category = $this->_stdName( (string)$item->MainCategoryPL );
				$subcategory = $this->_stdName( (string)$item->SubCategoryPL );
				$name = addslashes( (string)$item->TitlePL );
				$dscr = addslashes( (string)$item->DescriptionPL );
				if( strlen( (string)$item->ExtraTextPL ) > 0 ) $dscr .= addslashes( "<br><br>" . htmlentities( (string)$item->ExtraTextPL ) );
				$material = addslashes( (string)$item->MaterialPL );
				$dims = addslashes( (string)$item->Dimensions );
				$country = addslashes( (string)$item->CountryOfOrigin );
				$weight = (integer)$item->ItemWeightG;
				$color = addslashes( (string)$item->ColorPL );
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
				$photo = json_encode( $photo_a );
				$new = (int)$item->New;
				$promotion = (int)$item->Promotion;
				$sale = (int)$item->Sale;
				
				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					// $cat_id = $this->getCategory( 'name', $category, 'ID' );
					$sql = "SELECT ID FROM XML_category WHERE parent IS NULL AND name = '{$category}'";
				}
				else{
					// $cat_id = $this->getCategory( 'name', $subcategory, 'ID' );
					$sql = "SELECT sub.ID
					FROM XML_category as cat
					JOIN XML_category as sub
					ON cat.ID = sub.parent
					WHERE cat.name = '{$category}' AND sub.name = '{$subcategory}'";
				}
				
				$query = mysqli_query( $this->_dbConnect(), $sql );
				$fetch = mysqli_fetch_assoc( $query );
				$cat_id = $fetch['ID'];
				
				/* aktualizacja czy wstawianie? */
				$sql = "SELECT COUNT(*) as num FROM `XML_product` WHERE code = '{$code}'";
				$query = mysqli_query( $this->_dbConnect(), $sql );
				$fetch = mysqli_fetch_assoc( $query );
				$num = $fetch['num'];
				mysqli_free_result( $query );

				$insert = array(
					'shop' => $this->_atts['shop'],
					'code' => $code,
					'short' => $short,
					'cat_id' => $cat_id,
					'brutto' => $brutto,
					'netto' => $netto,
					'catalog' => $catalog,
					'title' => $name,
					'description' => $dscr,
					'materials' => $material,
					'dimension' => $dims,
					'country' => $country,
					'weight' => $weight,
					'colors' => $color,
					'photos' => $photo,
					'new' => $new,
					'promotion' => $promotions,
					'sale' => $sale,
					'data' => $dt,
					'instock' => $stock_a[$code],
					'marking' => $print_a[$code],
					
				);

				$t_fields = array();
				$t_values = array();

				/* aktualizacja */
				if( $num > 0 ){
					$t_sql = array();

					unset( $insert['code'] );
					$sql = "UPDATE XML_product SET ";

					foreach( $insert as $field => $value ){
						$t_sql[] = "`{$field}` = '{$value}'";
					}

					$sql .= implode( ", ", $t_sql );

					$sql .= " WHERE `code` = '{$code}'";

				}
				/* wstawianie */
				else{

					foreach( $insert as $field => $value ){
						$t_fields[] = "`{$field}`";
						$t_values[] = "'{$value}'";

					}

					$sql = sprintf(
						'INSERT INTO XML_product ( %s ) VALUES ( %s )',
						implode( ", ", $t_fields ),
						implode( ", ", $t_values )

					);


				}

				// echo "\r\n $sql \r\n";

				if( mysqli_query( $this->_dbConnect(), $sql ) === false ) $this->_log[] = mysqli_error( $this->_dbConnect() );

				// echo "\r\n{$category} | {$subcategory}";

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
