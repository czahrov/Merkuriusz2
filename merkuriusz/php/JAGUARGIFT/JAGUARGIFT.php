<?php
class JAGUARGIFT extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		$subcat_name = $cat_name;
		$cat_name = 'VIP Skóra';
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		/* Ładowanie pliku XML z produktami */
		$opts = array(
			'http' => array(
			'method' => "GET",
			'header' => "Accept-language: pl\r\n" .
				"Authorization: Token b877f60a12c850f74a169fa036265f852b38be79\r\n"
			)
		);
		$context = stream_context_create( $opts );
		$url = "http://www.jaguargift.com/pl/jaguargift.xml";
		$file = file_get_contents( $url, false, $context );
		if( $file === false ){
			if( file_exists( $c = __DIR__ . "/DND/" . basename( $url ) ) ){
				$XML = simplexml_load_string( $file );
				
			}
			else{
				return false;
			}
			
		}
		else{
			file_put_contents( __DIR__ . "/DND/" . basename( $url ) );
			$XML = simplexml_load_string( $file );
		}
		
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
				$price = (string)$item->price;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				// $catalog = addslashes( (string)$item-> );
				$cat = addslashes( (string)$item->category->{'list-item'}[0]->name );
				$category = $this->_stdName( $cat );
				$subcat = "";
				$subcategory = $this->_stdName( $subcat );
				$dscr = (string)$item->features->{'list-item'}[0]->value;
				$material = addslashes( (string)$item->materials->{'list-item'}->value );
				$dims = addslashes( (string)$item->size );
				// $country = addslashes( (string)$item-> );
				$weight = (float)$item->weight * 1000;
				$new = (string)$item->is_new === "False"?( 0 ):( 1 );
				$sale = 0;
				$promotion = 0;
				$marking_a = array();
				foreach( $item->marking->{'list-item'} as $arg ){
					if( (string)$item->availability !== "Niedostępne" ) $marking_a[] = (string)$arg->name;

				}
				$marking = implode( "<br>", $marking_a );
				
				foreach( $item->available_colors->{'list-item'} as $variant ){
					$code = (string)$variant->id;
					$short = $code;
					$color = addslashes( (string)$variant->color->name );
					$photo_a = array();
					$i = (string)$variant->main_image->image;
					if( $i !== "" ) $photo_a[] = $i;
					foreach( $item->images->{'list-item'} as $img ){
						$photo_a[] = (string)$img->image;
					}
					$photo = json_encode( $photo_a );
					$instock = (int)$variant->availability_count;
					$name = addslashes( (string)$variant->name );
					
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
						// 'catalog' => $catalog,
						'title' => $name,
						'description' => $dscr,
						'materials' => $material,
						'dimension' => $dims,
						// 'country' => $country,
						'weight' => $weight,
						'colors' => $color,
						'photos' => $photo,
						'new' => $new,
						'promotion' => $promotion,
						'sale' => $sale,
						'data' => $dt,
						'marking' => $marking,
						'instock' => $instock,
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
					
				}
				
				// echo "\r\n $sql \r\n";

				if( mysqli_query( $this->_dbConnect(), $sql ) === false ){
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );

				}

				// echo "\r\n{$category} | {$subcategory}";

			}

		}
		
		// czyszczenie nieaktualnych produktów
		// $this->_clear();

		if( !empty( $this->_log ) ){
			echo "<!--JAGUARGIFT ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
