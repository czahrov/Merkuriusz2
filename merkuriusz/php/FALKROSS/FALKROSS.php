<?php
class FALKROSS extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		$subcat_name = $cat_name;
		$cat_name = 'Odzież reklamowa';
		
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
				$code = (string)$item->kod;
				$category = $this->_stdName( (string)$item->kategorie->kategoria[0] );
				$subcategory = "";

				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					$cat_id = $this->getCategory( 'name', $category, 'ID' );
				}
				else{
					$cat_id = $this->getCategory( 'name', $subcategory, 'ID' );
				}

				$sql = "UPDATE `XML_product` SET cat_id = '{$cat_id}', data = '{$dt}' WHERE code = '{$code}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );
				}

			}

		}
		else{
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$price = 0;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				// $catalog = addslashes( (string)$item-> );
				$cat = addslashes( (string)$item->style_category_list->style_category_main->style_category_sub[0]->language->pl );
				$category = $this->_stdName( $cat );
				$subcat = addslashes( (string)$item->style_category_list->style_category_main->style_category_sub[1]->language->pl );
				$subcategory = $this->_stdName( $subcat );
				$dscr = addslashes( (string)$item->style_description->language->pl );
				$material = "";
				$dims = "";
				$marking = "";
				
				foreach( $item->sku_list->sku as $variant ){
					$code = (string)$variant->sku_artnum;
					$short = $code;
					$name = sprintf(
						'%s %s',
						addslashes( (string)$item->style_name->language->pl ),
						addslashes( (string)$variant->sku_size_name )
					);
					$new = (int)$variant->sku_new > 0?( 1 ):( 0 );
					$sale = (int)$variant->sku_closeout > 0?( 1 ):( 0 );
					$promotion = 0;
					$weight = (float)$variant->sku_weight * 1000;
					$country = (string)$variant->sku_coo;
					$color = addslashes( (string)$variant->sku_color_name );
					$photo_a = array();
					$photo_a[] = (string)$variant->sku_color_picture_url;
					foreach( $item->style_picture_list->style_picture as $img ){
						$photo_a[] = (string)$img->url;
					}
					$photo = json_encode( $photo_a );
					
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
					$num = mysqli_fetch_assoc( $query )['num'];
					mysqli_free_result( $query );

					$insert = array(
						'shop' => $this->_atts['shop'],
						'code' => $code,
						'short' => $short,
						'cat_id' => $cat_id,
						'brutto' => $brutto,
						'netto' => $netto,
						// 'catalog' => $catalog,
						'title' => $name,
						'description' => $dscr,
						'materials' => $material,
						'dimension' => $dims,
						'country' => $country,
						'weight' => $weight,
						'colors' => $color,
						'photos' => $photo,
						'new' => $new,
						'promotion' => $promotion,
						'sale' => $sale,
						'data' => $dt,
						'marking' => $marking,
						'instock' => $stock_a[ $code ],
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

					if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
						$this->_log[] = $sql;
						$this->_log[] = mysqli_error( $this->_dbConnect() );

					}

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
