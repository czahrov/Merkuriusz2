<?php
class AXPOL extends XMLAbstract{

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
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$code = (string)$item->CodeERP;
				// $pattern = "~^([^\.\-]+)~";
				$pattern = "~(.+?)(?:[SMLXF]+)?(?:[\.\-\/])?\w$~";
				preg_match_all( $pattern, $code, $match );
				// $short = $match[1];
				$short = $match[1][0];
				$netto = (float)str_replace( ",", ".", $item->CatalogPricePLN );
				$brutto = $netto * ( 1 + $this->_vat );
				$catalog = addslashes( (string)$item->Catalog );
				$cat = addslashes( (string)$item->MainCategoryPL );
				$subcat = addslashes( (string)$item->SubCategoryPL );
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
				$category = $this->_stdName( (string)$item->MainCategoryPL );
				$subcategory = $this->_stdName( (string)$item->SubCategoryPL );
				$new = (int)$item->New;
				$promotion = (int)$item->Promotion;
				$sale = (int)$item->Sale;

				if( in_array( $category, array( 'voyager wine club', 'wyprzedaż voyager wine club' ) ) or stripos( $dscr, 'wytrawne' ) !== false ) continue;

				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					$cat_id = $this->getCategory( 'name', $category, 'ID' );

				}
				else{
					$cat_id = $this->getCategory( 'name', $subcategory, 'ID' );

				}

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

			// wyciąganie stanu magazynowego z XML
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'stock' ] ) );
			foreach( $XML->items->children() as $item ){
				$kod = $item->Kod;
				$num = (int)$item->{'na_magazynie_dostepne_teraz'} + (int)$item->{'na_zamowienie_w_ciagu_7-10_dni'};

				$sql = "UPDATE `XML_product` SET  `instock` = {$num}, data = '{$dt}' WHERE `code` = '{$kod}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				}

			}

			// wyciąganie znakowania z XML
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'marking' ] ) );
			foreach( $XML->children() as $item ){
				$kod = $item->CodeERP;
				$marking_a = array();

				for( $position = 1; $position <= 6; $position++ ){
					$print_position = (string)$item->{"Position_{$position}_PrintPosition"};
					if( empty( $print_position ) ) continue;
					$print_size = (string)$item->{"Position_{$position}_PrintSize"};
					if( empty( $print_size ) ) continue;

					for( $tech = 1; $tech <= 5; $tech++ ){
						$print_tech = (string)$item->{"Position_{$position}_PrintTech_{$tech}"};
						if( empty( $print_tech ) ) continue;

						$marking_a = array_merge_recursive(
							$marking_a,
							array(
								"$print_position" => array(
									"$print_size" => $print_tech,

								),
							)

						);

					}

					$marking = json_encode( $marking_a );

				}

				$mark_s = "";
				foreach( $marking_a as $place => $sizes ){
					$mark_s .= "{$place}<br>";
					foreach( $sizes as $size => $technics ){
						$mark_s .= ">{$size} mm<br>>>";

						if( is_array( $technics ) ){
							$mark_s .=  implode( ", ", $technics );

						}
						else{
							$mark_s .= $technics;

						}

						$mark_s .= "<br>";

					}

				}

				$sql = "UPDATE `XML_product` SET  `marking` = '{$mark_s}', data = '{$dt}' WHERE `code` = '{$kod}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				}

				/* array(1) {
					["item barrel"]=>
					array(1) {
					["6x25"]=>
						string(2) "T1"
					}
				} */


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
