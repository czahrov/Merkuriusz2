<?php
class ASGARD extends XMLAbstract{

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		if( $cat_name === 'biuro i praca' ){
			
			if( in_array( $subcat_name, array( 'akcesoria', 'artykuły biurowe', 'komplety upominkowe', 'komputerowe', 'notesy', 'produkty z papierem kamiennym', 'teczki konferencyjne', 'telefoniczne', 'wizytowniki i etui na wizytówki' ) ) ){
				$cat_name = 'Biuro i biznes';
				
			}
			
		}
		elseif( $cat_name === 'elektronika' ){
			
			if( in_array( $subcat_name, array( 'akcesoria biurowe', 'notesy' ) ) ){
				$cat_name = 'Biuro i biznes';
				
			}
			elseif( in_array( $subcat_name, array( 'stacja pogody', 'zegary', 'stacje pogody' ) ) ){
				$cat_name = 'Czas i pogoda';
				
			}
			
		}
		elseif( $cat_name === 'jedzenie i picie' ){
			
			if( in_array( $subcat_name, array( 'bidony', 'kubki metalowe', 'kubki plastikowe', 'kubki termiczne', 'piersiówki', 'termosy' ) ) ){
				$cat_name = 'Do picia';
				
			}
			elseif( in_array( $subcat_name, array( 'akcesoria do alkoholi', 'kuchenne', 'na grill i piknik' ) ) ){
				$cat_name = 'Dom i ogród';
				
			}
			
		}
		elseif( $cat_name === 'breloki i smycze' ){
			
			if( in_array( $subcat_name, array( 'smycze' ) ) ){
				$cat_name = 'Smycze';
			}
			elseif( in_array( $subcat_name, array( 'akcesoria', 'breloki' ) ) ){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			}
			
		}
		elseif( $cat_name === 'sport i wypoczynek' ){
			
			if( in_array( $subcat_name, array( 'fidget spinner', 'gry' ) ) ){
				$cat_name = 'Dzieci, zabawa, szkoła';
				
			}
			
		}
		elseif( $cat_name === 'do pisania' ){
			$cat_name = 'Materiały piśmiennicze';
			
		}
		elseif( $cat_name === 'narzędzia i odblaski' ){
			
			if( in_array( $subcat_name, array( 'akcesoria', 'breloki', 'latarki', 'miary', 'skrobaczki', 'zestawy narzędzi', 'wyprzedaż' ) ) ){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
				
			}
			elseif( in_array( $subcat_name, array( 'odblaskowe' ) ) ){
				$cat_name = 'Odblaski';
				
			}
			
		}
		elseif( $cat_name === 'torby i parasole' ){
			
			if( in_array( $subcat_name, array( 'parasole' ) ) ){
				$cat_name = 'parasole i peleryny';
				
			}
			elseif( in_array( $subcat_name, array( 'na zakupy', 'plecaki', 'sportowe', 'torby na dokumenty', 'torby na laptopa' ) ) ){
				$cat_name = 'Torby i plecaki';
				
			}
			
		}
		elseif( $cat_name === 'sport i wypoczynek' ){
			
			if( in_array( $subcat_name, array( 'koce', 'sportowe' ) ) ){
				$cat_name = 'Wakacje, sport i rekreacja';
				
			}
			
		}
		
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
				$code = (string)$item->indeks;
				$category = $this->_stdName( (string)$item->kategoria );
				$subcategory = $this->_stdName( (string)$item->Akcesoria );

				$this->_categoryFilter( $category, $subcategory, $item );
				$this->_addCategory( $category, $subcategory );

				if( empty( $subcategory ) ){
					$cat_id = $this->getCategory( 'name', $category, 'ID' );

				}
				else{
					$cat_id = $this->getCategory( 'name', $subcategory, 'ID' );

				}
				
				$sql = "UPDATE `XML_product` SET cat_id = '{$cat_id}', data = '{$dt}' WHERE code = '{$code}'";
				if( mysqli_query( $this->_dbConnect(), $sql ) === false )
				{
					$this->_log[] = $sql;
					$this->_log[] = mysqli_error( $this->_dbConnect() );
				}

			}

		}
		else{
			// parsowanie danych z XML
			foreach( $XML->produkt as $item ){
				$code = (string)$item->indeks;
				
				preg_match( '/^[^\-]+/', $code, $match );
				$short = $match[0];
				
				$price = (string)$item->cena_netto_katalogowa;
				$netto = (float)str_replace( ",", ".", $price );
				$brutto = $netto * ( 1 + $this->_vat );
				// $catalog = addslashes( (string)$item-> );
				$cat = addslashes( (string)$item->kategoria );
				$category = $this->_stdName( $cat );
				$subcat = addslashes( (string)$item->podkategoria );
				$subcategory = $this->_stdName( $subcat );
				$name = addslashes( (string)$item->nazwa );
				$dscr = addslashes( (string)$item->opis_produktu );
				$material = addslashes( (string)$item->material );
				$dims = addslashes( (string)$item->wymiary_produktu );
				// $country = addslashes( (string)$item-> );
				$weight = (float)str_replace( ",", ".", $item->waga_jednostkowa_netto_w_kg ) * 1000;
				$color = addslashes( (string)$item->kolor );
				$photo_base = "https://asgard.pl/png/product/";
				$photo = json_encode( array(
					$photo_base . (string)$item->obraz,
					$photo_base . (string)$item->obraz_1,
					
				) );
				$instock = (int)$item->in_stock;
				$new = (string)$item->status == 'Nowość'?( 1 ):( 0 );
				$promotion = 0;
				$sale = 0;
				$marking = (string)$item->znakowanie_produktu;
				
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
			echo "<!--ASGARD ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
