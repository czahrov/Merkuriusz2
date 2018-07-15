<?php
class EASYGIFTS extends XMLAbstract{
	private $_cats = array();

	// filtrowanie kategorii
	protected function _categoryFilter( &$cat_name, &$subcat_name, $item ){
		
		if( !empty( $c = $this->_cats['easy siesta'] ) ){
			
			if( array_search( 'notesy', $c ) !== false ){
				$cat_name = 'Biuro i biznes';
				$subcat_name = 'Notesy';
			}
			elseif( array_search( 'dom', $c ) !== false ){
				$cat_name = 'Dom i ogród';
				$subcat_name = 'Dom';
			}
			elseif( array_search( 'smycze', $c ) !== false ){
				$cat_name = 'Smycze';
			}
			elseif( array_search( 'materiały piśmiennicze', $c ) !== false ){
				$cat_name = 'Materiały piśmiennicze';
			}
			elseif( array_search( 'breloki', $c ) !== false ){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			}
			elseif( array_search( 'torby i plecaki', $c ) !== false ){
				$cat_name = 'Torby plecaki';
			}
			elseif( array_search( 'czapki i kapelusze', $c ) !== false ){
				$cat_name = 'Tekstylia i odziez';
			}
			elseif( 
				array_search( $k = 'inne', $c ) !== false or
				array_search( $k = 'artykuły barmańskie', $c ) !== false or
				array_search( $k = 'odpoczynek', $c ) !== false
			){
				$cat_name = 'Inne produkty';
				$subcat_name = $k;
			}
			
		}
		elseif( !empty( $this->_cats['biuro i akcesoria biurowe'] ) ){
			$cat_name = 'Biuro i biznes';
			
		}
		elseif( 
			!empty( $this->_cats['icewatch'] ) or
			!empty( $this->_cats['czas i elektronika'] )
		){
			$cat_name = 'Czas i pogoda';
			
		}
		elseif( !empty( $c = $this->_cats['aladdin & stanley'] ) ){
			
			if( 
				stripos( (string)$item->baseinfo->name, 'kub' ) !== false or
				stripos( (string)$item->baseinfo->name, 'butel' ) !== false or
				stripos( (string)$item->baseinfo->name, 'termos' ) !== false
			){
				$cat_name = 'Do picia';	
			}
			elseif( 
				stripos( (string)$item->baseinfo->name, 'pojemnik' ) !== false or
				stripos( (string)$item->baseinfo->name, 'pudełko' ) !== false
			){
				$cat_name = 'Opakowania';
				$subcat_name = 'pojemniki na żywność';
			}
			
		}
		elseif( !empty( $c = $this->_cats['dom'] ) ){
			
			if( array_search( 'kubki i opakowania do kubków', $c ) !== false ){
				$cat_name = 'Do picia';
				$subcat_name = 'Kubki i opakowania do kubków';	
			}
			elseif( 
				array_search( 'akcesoria do wina', $c ) !== false or
				array_search( 'akcesoria kuchenne', $c ) !== false or
				array_search( 'ceramika', $c ) !== false or
				array_search( 'pojemniki i młynki do przypraw', $c ) !== false
			){
				$cat_name = 'Dom i ogród';
			}
			elseif( 
				array_search( 'pojemniki na żywność', $c ) !== false
			){
				$cat_name = 'Opakowania';
				$subcat_name = 'pojemniki na żywność';
			}
			
		}
		elseif( !empty( $c = $this->_cats['dodatki'] ) ){
			
			if( 
				array_search( 'skarbonki', $c ) !== false or
				array_search( 'zapalniczki', $c ) !== false
			){
				$cat_name = 'Dom i ogród';
			}
			elseif( 
				array_search( 'breloki metalowe', $c ) !== false or
				array_search( 'breloki wielofunkcyjne', $c ) !== false or
				array_search( 'skrobaczki', $c ) !== false
			){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			}
			elseif( array_search( 'lupy', $c ) !== false ){
				$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			}
			elseif( 
				array_search( $k = 'etui', $c ) !== false or
				array_search( $k = 'portfele', $c ) !== false
			){
				$cat_name = 'Etui i portfele';
				$subcat_name = $k;
			}
			elseif( 
				array_search( $k = 'inne', $c ) !== false 
			){
				$cat_name = 'Inne produkty';
				$subcat_name = $k;
			}
			
		}
		elseif( !empty( $c = $this->_cats['podróże'] ) ){
			if( array_search( 'pielęgnacja obuwia', $c ) !== false ){
				$cat_name = 'Dom i ogród';
			}
			elseif( 
				array_search( 'parasole i parasolki', $c ) !== false or
				array_search( 'płaszcze przeciwdeszczowe', $c ) !== false
			){
				$cat_name = 'Parasole i peleryny';
			}
			elseif( array_search( 'akcesoria podróżne' ) !== false ){
				$cat_name = 'Wakacje, sport i rekreacja';
			}
			elseif( array_search( 'kosmetyczki' ) !== false ){
				$cat_name = 'Zdrowie i uroda';
			}
			elseif( array_search( 'inne' ) !== false ){
				$cat_name = 'Inne produkty';
				$subcat_name = 'inne';
			}
			
		}
		elseif( !empty( $c = $this->_cats['mobile'] ) ){
			
			if( 
				array_search( 'power banki', $c ) !== false or
				array_search( 'głośniki', $c ) !== false
			){
				$cat_name = 'Elektronika';
			}
			elseif( 
				array_search( $k = 'inne', $c ) !== false
			){
				$cat_name = 'Inne produkty';
				$subcat_name = $k;
			}
			
		}
		elseif( !empty( $c = $this->_cats['dyski'] ) ){
			$cat_name = 'Elektronika';
			
		}
		elseif( !empty( $c = $this->_cats['pendrive\'y'] ) ){
			$cat_name = 'Elektronika';
			
		}
		elseif( !empty( $c = $this->_cats['smartwatche'] ) ){
			$cat_name = 'Elektronika';
			$subcat_name = 'smartwatche';	
		}
		elseif( array_key_exists( 'selfie sticki', $this->_cats ) ){
			$cat_name = 'Elektronika';
			$subcat_name = 'selfie sticki';
		}
		elseif( !empty( $c = $this->_cats['silicon power'] ) ){
			$cat_name = 'Elektronika';
			
		}
		elseif( !empty( $c = $this->_cats['materiały piśmiennicze'] ) ){
			$cat_name = 'Materiały piśmiennicze';
			
		}
		elseif( !empty( $c = $this->_cats['breloki akrylowe'] ) ){
			$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			
		}
		elseif( !empty( $c = $this->_cats['narzędzia'] ) ){
			$cat_name = 'Narzędzia, latarki, breloki, antystresy';
			
		}
		elseif( 
			array_key_exists( $c = 'torby by jassz', $this->_cats ) or
			array_key_exists( $c = 'tucano', $this->_cats ) or
			array_key_exists( $c = 'torby', $this->_cats )
		){
			$cat_name = 'Torby i plecaki';
			$subcat_name = $c;
			
		}
		elseif( array_key_exists( 'wenger - bagaże biznesowe i akcesoria podróżne', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Wenger';
			
		}
		elseif( array_key_exists( 'schwarzwolf', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Schwarzwolf';
			
		}
		elseif( array_key_exists( 'victorinox', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Victorinox';
			
		}
		elseif( array_key_exists( 'nina ricci', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Nina Ricci';
			
		}
		elseif( array_key_exists( 'jean-louis scherrer', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Jean-Louis Scherrer';
			
		}
		elseif( array_key_exists( 'christian lacroix', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Christian Lacroix';
			
		}
		elseif( array_key_exists( 'ungaro', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Ungaro';	
		}
		elseif( array_key_exists( 'cacharel', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Cacharel';
		}
		elseif( array_key_exists( 'cerruti 1881', $this->_cats ) ){
			$cat_name = 'VIP Collection';
			$subcat_name = 'Cerruti 1881';
		}
		elseif( array_key_exists( 'odpoczynek', $this->_cats ) ){
			$cat_name = 'Wakacje, sport i rekreacja';
			
		}
		elseif( array_key_exists( 'uroda', $this->_cats ) ){
			$cat_name = 'Zdrowie i uroda';
			
		}
		elseif( array_key_exists( 'czapki cofee', $this->_cats ) ){
			$cat_name = 'Tekstylia i odziez';
			
		}
		elseif( array_key_exists( 'opakowania', $this->_cats ) ){
			$cat_name = 'Opakowania';
			$subcat_name = 'opakowania';
			
		}
		elseif( array_key_exists( 'pinsy', $this->_cats ) ){
			$cat_name = 'Pinsy, plakietki, odznaki';
			$subcat_name = 'pinsy';
			
		}
		elseif( array_key_exists( 'różne', $this->_cats ) ){
			$cat_name = 'Inne produkty';
			$subcat_name = 'różne';
			
		}
		elseif( array_key_exists( $k = 'elektronika markowa', $this->_cats ) ){
			$cat_name = 'VIP Elektronika';
			// $subcat_name = $k;
		}
		elseif( array_key_exists( $k = 'nowości 2018', $this->_cats ) ){
			$cat_name = 'Najnowsze produkty';
			$subcat_name = $k;
		}
		
	}

	// wczytywanie XML, parsowanie danych XML, zapis do bazy danych
	// rehash - określa czy wykonać jedynie przypisanie kategorii dla produktów
	protected function _import( $rehash = false ){
		$dt = date( 'Y-m-d H:i:s' );

		if( $rehash === true ){
			// parsowanie danych z XML
			foreach( $XML->children() as $item ){
				$code = (string)$item->baseinfo->code_full;
				$category = $this->_stdName( (string)$item->categories->category[0]->name );
				$subcategory = '';

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
			/* generowanie tablicy ze stanem magazynowym */
			$stock_a = array();
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'stock' ] ) );
			foreach( $XML->children() as $item ){
				$stock_a[ (string)$item->code_full ] = (int)$item->quantity_24h;
			}
			
			// parsowanie danych z XML
			$XML = simplexml_load_file( __DIR__ . "/DND/" . basename( $this->_sources[ 'products' ] ) );
			foreach( $XML->children() as $item ){
				/* tablica kategorii i podkategorii do jakich przydzielony jest produkt */
				$this->_cats = array();
				foreach( $item->categories->category as $single_cat ){
					$this->_cats[ mb_strtolower( (string)$single_cat->name ) ] = array();
					
					if( !empty( $s = $single_cat->subcategories->subcategory ) ){
						foreach( $s as $single_subcat ){
							$this->_cats[ mb_strtolower( (string)$single_cat->name ) ][] = mb_strtolower( (string)$single_subcat->name );
						}
						
					}
					
				}
				
				$code = (string)$item->baseinfo->code_full;
				$short = (string)$item->baseinfo->code_short;
				$price = $item->baseinfo->price;
				$price_promo = $item->baseinfo->price_promotion;
				$price_sellout = $item->baseinfo->price_sellout;
				$netto = (float)str_replace( ",", ".", empty( $price_sellout )?( empty( $price_promo )?( $price ):( $price_promo ) ):( $price_sellout ) );
				$brutto = $netto * ( 1 + $this->_vat );
				// $catalog = addslashes( (string)$item-> );
				$cat = addslashes( (string)$item->categories->category[0]->name );
				// $subcat = addslashes( (string)$item->SubCategoryPL );
				$name = addslashes( (string)$item->baseinfo->name );
				$dscr = addslashes( (string)$item->baseinfo->intro );
				
				// $material = addslashes( (string)$item->materials->material[0]->name );
				$materials_a = array();
				foreach( $item->materials->material as $material ){
					$materials_a[] = (string)$material->name;
				}
				
				$dims = addslashes( (string)$item->attributes->size );
				$country = addslashes( (string)$item->origincountry->name );
				$weight = (float)$item->attributes->weight;
				$color = addslashes( (string)$item->color->name );
				$photo_a = array();
				foreach( $item->images->children() as $img ){
					$photo_a[] = (string)$img;

				}
				$photo = json_encode( $photo_a );
				$category = $this->_stdName( (string)$item->categories->category[0]->name );
				$subcategory = $this->_stdName( (string)$item->categories->category[0]->subcategories->subcategory[0]->name );
				$new = (int)$item->attributes->new;
				$sale = (float)$item->baseinfo->price_sellout > 0?( 1 ):( 0 );
				$promotion = (float)$item->baseinfo->price_promotion > 0?( 1 ):( 0 );
				$marking = "";
				$marking_a = array();
				foreach( $item->markgroups->markgroup as $child ){
					$marking_a[] = (string)$child->name;

				}
				$marking .= implode( "<br>", $marking_a );
				$brand = (string)$item->brand->name;
				
				/* if( $code == 'T26013203' ){
					print_r( $this->_cats );
				} else continue; */
				
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
					'price_before' => !empty( $price_promo ) ?( (float)str_replace( ",", ".", $price ) ):( 0 ),
					// 'catalog' => $catalog,
					'title' => $name,
					'description' => $dscr,
					'materials' => implode( " / ", $materials_a ),
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
					'brand' => $brand,
					
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
			echo "<!--EASYGIFTS ERROR:" . PHP_EOL;
			print_r( $this->_log ) . PHP_EOL;
			echo "-->";

		}

	}


}
