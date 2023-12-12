<?php
#WT_NEONCART_TEMPLATE_BASE#

function get_wt_neoncart_template_data() {
	global $db;
	$res_ar = array();
	$rs = $db->Execute("SHOW TABLES LIKE '" . TABLE_WT_NEONCART_TEMPLATE . "'" );
	if ( $rs->RecordCount() > 0 ) {
		$res = $db->Execute( "SELECT * FROM " . TABLE_WT_NEONCART_TEMPLATE );
		while ( !$res->EOF ) {
			$res_ar[$res->fields['opt_name'] . '_' . $res->fields['lang_id']] = $res->fields['opt_value'];
			$res->MoveNext();
		}
		return $res_ar;
	}
	return;
}

function get_wt_neoncart_options( $name, $default = '', $lang_id = 0 ) {
	return ( isset( $GLOBALS['wtTempData'][ $name . '_' . $lang_id ] ) ? $GLOBALS['wtTempData'][$name . '_' . $lang_id] : $default );
}

function wt_neoncart_menu( $menu_type = 'simple' ) {

	if ( !isset( $GLOBALS['wtCatAr'] ) ) $GLOBALS['wtCatAr'] = array();
	require_once (DIR_WS_CLASSES . 'wt_neoncart_categories_ul_generator.php');
	$zen_CategoriesUL = new wt_neoncart_categories_ul_generator( $GLOBALS['wtCatAr'] );
	$GLOBALS['wtCatAr'] = $zen_CategoriesUL->data;
	if ( $menu_type == 'megamenu' ) {
		return wt_neoncart_megamenu_blocks( $zen_CategoriesUL->buildTreeMegamenu(true), $GLOBALS['wtCatAr'], 'hor' );
	} else if( $menu_type == 'ver_megamenu' ) {
		return wt_neoncart_megamenu_blocks( $zen_CategoriesUL->buildTreeVerMegamenu(true), $GLOBALS['wtCatAr'], 'ver' );
	} else if( $menu_type == 'mmenu' ) {
		return $zen_CategoriesUL->buildTreeMmenu(true);
	} else {
		return $zen_CategoriesUL->buildTreeSimpleMenu(true);
	}
}

/**================================================================
** Mega Menu
**================================================================*/
function wt_neoncart_megamenu_blocks( $menulist, $wt_cat_ar, $mtype = 'hor' ) {
	
	if ( !empty( $wt_cat_ar ) ) {
		global $lazyClass;

		foreach( $wt_cat_ar[0] as $k0 => $v0 ) {
			/* ---------------------------- Menuitem Marked -------------------------------------------------- */
			$subcat_marked = $badge_type = get_wt_neoncart_options( 'subcat_marked_' . $k0 );
			if ( $subcat_marked == 1 ){
				$menulist = str_replace( '[MEGAMENU__SUBMENU--MARKED]','megamenu__submenu--marked', $menulist);
			} else {
				$menulist = str_replace( '[MG-MARKED ID="' . $k0 . '"]','', $menulist );
			}
			
			/* ---------------------------- Main Category Badge -------------------------------------------------- */
			$badge_type = get_wt_neoncart_options( 'badge_type_' . $k0, 'none' );
			if ( $badge_type == 'new' ) {
				$menulist = str_replace( '[BADGE ID="' . $k0 . '"]', '<span class="tt-badge tt-new">' . WT_BADGE_NEW . '</span>',$menulist);
			} else if ( $badge_type == 'sale' ){
				$menulist = str_replace( '[BADGE ID="' . $k0 . '"]', '<span class="tt-badge tt-sale">' . WT_BADGE_SALE . '</span>',$menulist);
			} else {
				$menulist = str_replace( '[BADGE ID="' . $k0 . '"]', '', $menulist);
			}
			
			if ( get_wt_neoncart_options( 'menu_type_' . $k0, 1 ) == 1 ) {
				
				/* ---------------------------- Add Megamenu Sideblock Content -------------------------------------------------- */
				$sideblock_type = get_wt_neoncart_options( 'megamenu_btype_' . $k0, 'none' );
				if ( $sideblock_type == 'special' ) {
					$sideblock = wt_neoncart_generate_specialspro_block( $k0 , $mtype );
					$menulist = str_replace( '[MEGAMENU--SIDE-BLOCK ID="' . $k0 . '"]', $sideblock, $menulist );
				} else if( $sideblock_type == 'featured' ) {
					$sideblock = wt_neoncart_generate_featuredpro_block( $k0, $mtype );
					$menulist = str_replace('[MEGAMENU--SIDE-BLOCK ID="' . $k0 . '"]', $sideblock, $menulist);
				} else if( $sideblock_type == 'banner' ) {
					global $uploads_path;
					$sideblock_ban_img = get_wt_neoncart_options( 'mg_side_block_ban_' . $k0.'_img' ); ;
					$sideblock = '';
					if ( !empty( $sideblock_ban_img ) ) {
						$sideblock_ban_link = get_wt_neoncart_options( 'mg_side_block_ban_' . $k0.'_link' );
						$sideblock = '<div class="col-sm-3 tt-offset-7">
										<a href="' . ( !empty( $sideblock_ban_link ) ? $sideblock_ban_link : 'javascript:void(0);' ) . '" class="tt-promo-02">
											' . wt_image( $uploads_path . $sideblock_ban_img , '', 'auto', 'auto','class="' . $lazyClass . '"', 'banner') . '
										</a>
									</div>
						';
					}
					$menulist = str_replace('[MEGAMENU--SIDE-BLOCK ID="' . $k0 . '"]', $sideblock, $menulist);
				} else {
					$menulist = str_replace( '[MEGAMENU--SIDE-BLOCK ID="' . $k0 . '"]', '', $menulist );
				}
			
				/* ---------------------------- Add Megamenu Bottom Content -------------------------------------------------- */
				$bottomblock = get_wt_neoncart_options( 'megamenu_bottom_block_' . $k0 );
				$bottomblock_cont = wt_neoncart_generate_banners( $k0 );
				if ( $bottomblock == 1 ) { 
					$menulist = str_replace('[MEGAMENU-BOTTOM-BLOCK ID="' . $k0 . '"]', $bottomblock_cont, $menulist);
				} else { 
					$menulist = str_replace('[MEGAMENU-BOTTOM-BLOCK ID="' . $k0 . '"]','',$menulist);
				}
			} else {
				$menulist = str_replace('[MEGAMENU-BOTTOM-BLOCK ID="' . $k0 . '"]','',$menulist);
				$menulist = str_replace('[MEGAMENU--SIDE-BLOCK ID="' . $k0 . '"]','',$menulist);
			}
		}
	}
	$menulist = str_replace("</li>\n</ul>\n</li>\n</ul>\n","</li>\n</ul>\n",$menulist);
	return $menulist;
}

function wt_neoncart_generate_featuredpro_block($id, $mtype){
	
	global $db, $wt_pimgldr;
	$productsInCategory = zen_get_categories_products_list($id);
	$list_of_products='';
	if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
		// build products-list string to insert into SQL query
		foreach($productsInCategory as $key => $value) {
		  $list_of_products .= $key . ', ';
		}
		$list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
		$featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.product_is_call, p.products_type, p.master_categories_id
									from (" . TABLE_PRODUCTS . " p
									left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
									left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id)
									where p.products_id = f.products_id
									and p.products_id = pd.products_id
									and p.products_status = 1 and f.status = 1
									and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
									and p.products_id in (" . $list_of_products . ")";
	}
	$sideblock_type_view = get_wt_neoncart_options("megamenu_btype_view_".$id);
	$max_products = ( $mtype == 'hor' ) ? 2 : 2;
	if ($featured_products_query != '') $featured_products = $db->ExecuteRandomMulti($featured_products_query, $max_products);
	$num_products_count = ($featured_products_query == '') ? 0 : $featured_products->RecordCount();
	if( $num_products_count > 0 ){
	
		$products_obj = $featured_products;
		$product_data = array( 'block_title' => '<a href="' . zen_href_link( FILENAME_FEATURED, '', 'SSL') . '" class="tt-title-submenu">' . MEGAMENU_FEATURED_TITLE . '</a>', 'productsInCategory' => $productsInCategory, 'products_obj' => $products_obj );
		$html = wt_neoncart_drop_menu_sidebar( $id, $product_data, $mtype );
		
		return $html;
	}
}
	
function wt_neoncart_generate_specialspro_block( $id, $mtype ) {
	
	global $db, $wt_pimgldr;
	$productsInCategory = zen_get_categories_products_list($id);
	$list_of_products = '';
	if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
		// build products-list string to insert into SQL query
		foreach($productsInCategory as $key => $value) {
		  $list_of_products .= $key . ', ';
		}
		$list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
		$specials_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.product_is_call, p.products_type, p.master_categories_id
						 from (" . TABLE_PRODUCTS . " p
						 left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
						 left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
						 where p.products_id = s.products_id
						 and p.products_id = pd.products_id
						 and p.products_status = '1' and s.status = '1'
						 and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
						 and p.products_id in (" . $list_of_products . ")";
	}
	
	$sideblock_type_view = get_wt_neoncart_options( 'megamenu_btype_view_' . $id, 2 );
	$max_products = ( $mtype == 'hor' ) ? 2 : 2;
	if ( $specials_index_query != '') $specials_products = $db->ExecuteRandomMulti($specials_index_query, $max_products);
	$num_products_count = ($specials_index_query == '') ? 0 : $specials_products->RecordCount();
	if ( $num_products_count > 0 ) {
		$products_obj = $specials_products;
		$product_data = array( 'block_title' => '<a href="' . zen_href_link( FILENAME_SPECIALS, '', 'SSL') . '" class="tt-title-submenu mb-2"><h5>' . MEGAMENU_SPECIAL_TITLE . '</h5></a>', 'productsInCategory' => $productsInCategory, 'products_obj' => $products_obj);
		$html = wt_neoncart_drop_menu_sidebar( $id, $product_data, $mtype );

		return $html;
	}
}

function wt_neoncart_drop_menu_sidebar( $id, $product_data, $mtype ) {
	global $wt_pimgldr;
	
	$html ='';
	extract($product_data);
	
	// lazyload Class
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	
	$html .= '<div class="col-sm-4">
				' . ( !empty( $block_title ) ? $block_title : '' ) . '
				<div class="' . ( ( $mtype == 'hor' ) ? 'tt-menu-slider arrow-location-03 slick-slider' : 'tt-col-list' )  . ' header-menu-product row">';		
			while (!$products_obj->EOF) {
				/*BOF changed by WT Tech. -------------------*/
	
				//set cPath
				$cPath = $productsInCategory[$products_obj->fields['products_id']];
				
				//set Infopagelink
				$zen_get_info_page = wt_get_info_page( $products_obj );
				
				/*EOF changed by WT Tech. -------------------*/
				
				$products_price = zen_get_products_display_price($products_obj->fields['products_id']);
				$html.='<div class="' . ( ( $mtype == 'hor' ) ? 'col-12' : 'col-sm-6' )  . ' tt-item">
							<div class="supermarket_product_small">
								<div class="item_image">
									<a class="prd-img" href="' . zen_href_link( $zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL' ) . '">
										' . wt_image(DIR_WS_IMAGES . $products_obj->fields['products_image'], $products_obj->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="' . $lazyClass . '"', 'product') . '
									</a>
								</div>
								<div class="item_content">
									<h5 class="item_title"><a class="prd-img" href="' . zen_href_link( $zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL' ) . '">' . $products_obj->fields['products_name'] . '</a></h5>
									<div class="item_price">' . $products_price . '</div>
									'.(wt_neoncart_product_reviews($products_obj->fields['products_id'], $zen_get_info_page)).'
								</div>
							</div>
						</div>';
				$products_obj->MoveNextRandom();
			}
			$html.='
					</div>
			</div>';
		
	return $html;
}

function wt_neoncart_generate_banners( $id ){
	global $uploads_path, $wt_pimgldr;
	
	//lazyload Class
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	
	$mbc0 = get_wt_neoncart_options( 'mg_botban_cont_0_' . $id . '_img' );
	$mbc1 = get_wt_neoncart_options( 'mg_botban_cont_1_' . $id . '_img' );

	$html = '';
	if ( !empty( $mbc0 ) && !empty( $mbc1 ) ) {
	$html.='<div class="bottom-block hidden-xs">
				<div class="container">
					<div class="row">
						<div class="col-sm-6"><a class="tt-promo-02" href="' . get_wt_neoncart_options( 'mg_botban_cont_0_' . $id . '_link' ) . '">' . wt_image( $uploads_path . $mbc0, '', 'auto', 'auto', 'class="' . $lazyClass . '"', 'banner') . '</a></div>
						<div class="col-sm-6"><a class="tt-promo-02" href="' . get_wt_neoncart_options('mg_botban_cont_1_' . $id . '_link') . '">' . wt_image( $uploads_path . $mbc1, '', 'auto', 'auto', 'class="' . $lazyClass . '"', 'banner') . '</a></div>
					</div>
				</div>
			</div>';
	}
	return $html;
}

function wt_neoncart_create_sort_heading( $sortby, $colnum, $heading ) {

	$sort_prefix = '';
	if ( $sortby ) {
		$select = (isset($_GET['sort']) && (($_GET['sort']==$colnum . 'a') || ($_GET['sort']==$colnum . 'd')) )? "selected='selected'":"";
		$sort_prefix = '<option ' .  $select  . ' value="' .  $colnum . 'a">' . $heading . '</option>' ;
	}
	return $sort_prefix;
}

function wt_neoncart_create_sort_heading_asc_des($sortby, $colnum, $heading) {

    $sort_prefix = '';
    $sort_suffix = '';
    $orderitm = (substr($sortby, 1, 1));
	$colnum = str_replace($orderitm,'',$sortby);
    if ( $sortby ) {
      $sort_prefix = '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('page', 'info', 'sort')) . 'page=1&sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a'), 'SSL') . '" title="' . zen_output_string(TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . '">' ;
      $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? '<span class="ascending_direction direction">' . PRODUCT_LIST_SORT_ORDER_ASCENDING . '</span>' : '<span class="descending_direction direction">' . PRODUCT_LIST_SORT_ORDER_DESCENDING . '</span>') : '') . '</a>';
    }

    return $sort_prefix . $sort_suffix;
}

function wt_neoncart_gridlist($page) {
	$html = '<ul class="layout_btns d-flex gap-2 nav ul_li clearfix">';	
	if ( ( !empty( $_GET['view'] ) && $_GET['view'] == 'rows' ) || ( PRODUCT_LISTING_LAYOUT_STYLE == 'rows' && ( !isset( $_GET['view'] ) ) ) )   {   
		$html .= '<li><a class="" title="' . HEADING_VIEW_AS_GRID . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('view')) . 'view=columns', 'SSL') . '" ><i class="fas fa-th fa-lg"></i></a></li>';
		$html .= '<li><a class="active theme-color" title="' . HEADING_VIEW_AS_LIST . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('view')) . 'view=rows', 'SSL') . '"><i class="fas fa-list fa-lg"></i></a></li>';
	} else {
		$html .= '<li><a class="active theme-color" title="' . HEADING_VIEW_AS_GRID . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('view')) . 'view=columns', 'SSL') . '" ><i class="fas fa-th fa-lg"></i></a></li>';
		$html .= '<li><a class="" title="' . HEADING_VIEW_AS_LIST . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('view')) . 'view=rows', 'SSL') . '"><i class="fas fa-list fa-lg"></i></a></li>';
	}
	$html .= '</ul>';
	return $html;
}

function wt_neoncart_new_product( $products_ar ) {
	
	global $db;
	$products_date_available = (isset($products_ar['products_date_available']))? $products_ar['products_date_available'] : '';
	$products_date_added = (isset($products_ar['products_date_added']))? $products_ar['products_date_added'] : '';
	$new_range = 0;
	if($products_date_added !='' || $products_date_available!=''){
		$time_limit=false;
		if ($time_limit == false) {
		  $time_limit = SHOW_NEW_PRODUCTS_LIMIT;
		}
		// 120 days; 24 hours; 60 mins; 60secs
		$date_range = time() - ($time_limit * 24 * 60 * 60);
		$upcoming_mask_range = time();
		$upcoming_mask = date('Ymd', $upcoming_mask_range);

		// echo 'Now:      ' .  date('Y-m-d') ."<br />";
		// echo $time_limit . ' Days: ' .  date('Ymd', $date_range) ."<br />";
		$zc_new_date = date('Ymd', $date_range);
		$products_date_added = date('Ymd', strtotime($products_date_added));
		switch (true) {
		case (SHOW_NEW_PRODUCTS_LIMIT == 0):
			$new_range = 1;
			break;
		case (SHOW_NEW_PRODUCTS_LIMIT == 1):
			$zc_new_date = date('Ym', time()) . '01';
			if($products_date_added >= $zc_new_date){
				$new_range = 1;
			}
			//$new_range = ' and p.products_date_added >=' . $zc_new_date;
			break;
		default:
			if($products_date_added >= $zc_new_date){
				$new_range = 1;
			}
			//$new_range = ' and p.products_date_added >=' . $zc_new_date;
		}

		if (SHOW_NEW_PRODUCTS_UPCOMING_MASKED == 0) {
		  // do nothing upcoming shows in new
		}else {
		  // do not include upcoming in new
			if($products_date_available <= $upcoming_mask || $products_date_available==''){
				$new_range=1;
			}
		  //$new_range .= " and (p.products_date_available <=" . $upcoming_mask . " or p.products_date_available IS NULL)";
		}
		return $new_range;
	}
}

function wt_neoncart_specials_product( $products_id ) {
	global $db;
	$listing_res = $db->Execute( "select s.products_id from " . TABLE_SPECIALS . " s where s.status = 1 and s.products_id='". $products_id ."'" );
	return $listing_res->RecordCount();
}

function wt_neoncart_product_reviews( $product_id, $products_type = 'products_info' ) {
		
	$products_type = strtoupper( $products_type );

	$content = '';
	$flag_show_product_info_reviews = constant( 'SHOW_' . $products_type . '_REVIEWS' );
	$flag_show_product_info_reviews_count = constant( 'SHOW_' . $products_type . '_REVIEWS_COUNT' );

    if ( $flag_show_product_info_reviews == 1 && $flag_show_product_info_reviews_count == 1 ) {
		// if more than 0 reviews, then show reviews button; otherwise, show the "write review" button
		global $db;
		$review_status = " AND r.status = 1";
		$reviews_query = "select count(*) as count, avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r
						   where r.products_id = '" . (int)$product_id . "'" .
						   $review_status;

		$reviews = $db->Execute($reviews_query);

		if ( $reviews->fields['count'] > 0 ) {
			$content.= '<div class="item_rating">
							<div class="rating-box">';
							if ( $flag_show_product_info_reviews_count ) {
								$stars_image_suffix = str_replace(' . ', '_', zen_round($reviews->fields['average_rating'] * 2, 0) / 2);
								$average_rating = zen_round(($reviews->fields['average_rating']*100)/5, 2);
								$content .= '<div style="width:' . $average_rating . '%" class="rating fas"></div>';
							}
				$content .= '</div>
						</div>';
		} else {
			$content.= '<div class="item_rating"><div class="rating-box"></div></div>';
		}
	} 	
	return $content;
}

function wt_get_info_page( &$products_obj ) {
	
	$products_obj_ar = ( is_object( $products_obj ) ) ? $products_obj->fields : $products_obj;
	$return = '';
	
	if ( !isset( $products_obj_ar['products_type'] ) ) {
		$return = zen_get_info_page( $products_obj_ar['products_id'] );
	} else if ( $products_obj_ar['products_type'] == 1 ) {
		$return = 'product_info';
	} else if ( !empty( $products_obj_ar['zen_get_info_page'] ) ) {
		$return = $products_obj_ar['zen_get_info_page'];
	} else {
		global $db;
		$zp_handler = $db->Execute( "select type_handler from " . TABLE_PRODUCT_TYPES . " where type_id = '" . (int)$products_obj_ar['products_type'] . "'" );
		$return = $zp_handler->fields['type_handler'] . '_info';
    }
	if ( !empty( $return ) ) {
		if ( is_object( $products_obj ) ) {
			$products_obj->fields['zen_get_info_page'] = $return;
		} else {
			$products_obj['zen_get_info_page'] = $return;
		}
		return $return;
	}
	return;
}

function wt_get_show_product_switch( $lookup, $field, $prefix = 'SHOW_', $suffix = '_INFO', $field_prefix = '_', $field_suffix = '' ) {
	
	global $db;
	$sql = "select p.products_type, pt.type_handler from " . TABLE_PRODUCTS . " as p, " . TABLE_PRODUCT_TYPES . " pt  where p.products_id='" . $lookup . "' and pt.type_id = p.products_type";
	$show_key = $db->Execute($sql);
	$zv_key = strtoupper($prefix . $show_key->fields['type_handler'] . $suffix . $field_prefix . $field . $field_suffix);
	
	$sql = "select tptl.configuration_key as tptl_congiguration_key, tptl.configuration_value as tptl_congiguration_value, tc.configuration_key as tc_congiguration_key, tc.configuration_value as tc_congiguration_value from " . TABLE_PRODUCT_TYPE_LAYOUT . " as tptl, " . TABLE_CONFIGURATION . " as tc  where tptl.configuration_key='" . $zv_key . "' or tc.configuration_key='" . $zv_key . "'";
	$zv_key_value = $db->Execute($sql);
	if ($zv_key_value->RecordCount() > 0) {
		if ( $zv_key_value->fields['tptl_congiguration_key'] == $zv_key ) {
			return $zv_key_value->fields['tptl_congiguration_value'];
		}else if($zv_key_value->fields['tc_congiguration_key']== $zv_key){
			return $zv_key_value->fields['tc_congiguration_value'];
		}
	}
}
function wt_get_manufactures_list(){
		global $languages_id, $db;
		$content = '';
		$mn_manfact_query = "SELECT m.manufacturers_id, m.manufacturers_name, m.manufacturers_image FROM ".DB_PREFIX."manufacturers m GROUP BY m.manufacturers_id ORDER BY m.manufacturers_name" ;
		$mn_manfact = $db->Execute($mn_manfact_query);
		if (count($mn_manfact) > 0 ) {
			$content .='<li id="brands" class="submenu has-submenu" >
						<a href="' . (zen_href_link(FILENAME_MANUFACTURERS_ALL,'&pg=brands', 'SSL')) . '">
							<span class="act-underline">' . HEADER_TITLE_MANUFACTURER . '</span>
						</a>
						<ul class="level2" role="menu">';
								while (!$mn_manfact->EOF) {
									$mn_manfact_id=$mn_manfact->fields['manufacturers_id'];
									$mn_manfact_name=$mn_manfact->fields['manufacturers_name'];
										if($mn_manfact_name !='' ) {
								$content .='<li><a href="' . zen_href_link(FILENAME_DEFAULT,'&manufacturers_id="' . $mn_manfact_id . '"&pg=brands"','', 'SSL') . '">
												' . $mn_manfact_name . '</a>			
											</li>';
									}
									$mn_manfact->MoveNext();
								}
			$content .='</ul>
					</li>';
		}
	return $content;
}

function wt_neoncart_additional_images( $products_ar, $wt_display_style, $width = '', $height = '' ) {
	global $db, $wt_gl_config, $wt_pimgldr, $zco_notifier;
	
	$cPath = (isset($products_ar['cPath'])) ? $products_ar['cPath'] : '';
	$zen_get_info_page = (isset($products_ar['zen_get_info_page'])) ? $products_ar['zen_get_info_page'] : '';
	
	$products_image = $products_ar['products_image'];
	$products_id = $products_ar['products_id'];
	$product_link=zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_id, 'SSL');
	
	//Options
	$dis_addimgs_type = get_wt_neoncart_options( 'prod_' . $wt_display_style . '_addtionalimg_style', 'default');
	$dis_imghover_style = get_wt_neoncart_options( 'prod_' . $wt_display_style . '_imghover_style', 'fade' );
	
	//bo etc config
	if ( isset( $wt_gl_config['dis_addimgs_type'] ) ) {
		$dis_addimgs_type = $wt_gl_config['dis_addimgs_type'];
	}
	if ( isset( $wt_gl_config['prod_imghover_style'] ) ) {
		$dis_imghover_style = $wt_gl_config['prod_imghover_style'];
	}
	//eo etc config
	if( !in_array( $dis_imghover_style, array('default') ) ) {
		$dis_imghover_classes = 'hover-effect';
	}
	$dis_imghover_classes .= ' image-'.$dis_imghover_style.'-effect';
	
	//lazyload Class
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	
	$prodlist_nums_addimgs = 1;
	if ( in_array( $wt_display_style, array( 'micro_slider', 'micro_grid', 'micro_small_grid', 'micro_small_slider' ) ) ) {
		$width = SMALL_IMAGE_WIDTH;
		$height = SMALL_IMAGE_HEIGHT;
	} else {
		$width =( $width == '' ) ? IMAGE_PRODUCT_LISTING_WIDTH : $width;
		$height = ( $height == '' ) ? IMAGE_PRODUCT_LISTING_HEIGHT : $height;
	}
	
	$content = '';
	/*************************************** BOF Additional Image Default Content ****************************************************/
	
	/*BOF--WT--DEMO-CONFIG*/
	$GLOBALS['zco_notifier']->notify('NOTIFY_MODULES_ADDITIONAL_PRODUCT_IMAGES_START', array('products_image' => $products_image), $products_image);
	/*EOF--WT--DEMO-CONFIG*/

	if (!defined('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE')) define('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE','Yes');
	$images_array = array();
	// do not check for additional images when turned off
	if ( $products_image != '' && $dis_addimgs_type != 'default') {
		// prepare image name
		$products_image_extension = substr($products_image, strrpos($products_image, '.'));
		$products_image_base = str_replace($products_image_extension, '', $products_image);

		// if in a subdirectory
		if (strrpos($products_image, '/')) {
			$products_image_match = substr($products_image, strrpos($products_image, '/')+1);
			//echo 'TEST 1: I match ' . $products_image_match . ' - ' . $file . ' -  base ' . $products_image_base . '<br>';
			$products_image_match = str_replace($products_image_extension, '', $products_image_match) . '_';
			$products_image_base = $products_image_match;
		}

		$products_image_directory = str_replace($products_image, '', substr($products_image, strrpos($products_image, '/')));
		if ($products_image_directory != '') {
			$products_image_directory = DIR_WS_IMAGES . str_replace($products_image_directory, '', $products_image) . "/";
		} else {
			$products_image_directory = DIR_WS_IMAGES;
		}

		// Check for additional matching images
		$file_extension = $products_image_extension;
		$products_image_match_array = array();
		if ($dir = @dir($products_image_directory)) {
			while ($file = $dir->read()) {
				if (!is_dir($products_image_directory . $file)) {
					// -----
					// Some additional-image-display plugins (like Fual Slimbox) have some additional checks to see
					// if the file is "valid"; this notifier "accommodates" that processing, providing these parameters:
					//
					// $p1 ... (r/o) ... An array containing the variables identifying the current image.
					// $p2 ... (r/w) ... A boolean indicator, set to true by any observer to note that the image is "acceptable".
					//
					$current_image_match = false;
					$GLOBALS['zco_notifier']->notify(
						'NOTIFY_MODULES_ADDITIONAL_IMAGES_FILE_MATCH',
						array(
							'file' => $file,
							'file_extension' => $file_extension,
							'products_image' => $products_image,
							'products_image_base' => $products_image_base
						),
						$current_image_match
					);
					if ($current_image_match || substr($file, strrpos($file, '.')) == $file_extension) {
						if ($current_image_match || preg_match('/' . preg_quote($products_image_base, '/') . '/i', $file) == 1) {
							if ($current_image_match || $file != $products_image) {
								if ($products_image_base . str_replace($products_image_base, '', $file) == $file) {
									//  echo 'I AM A MATCH ' . $file . '<br>';
									$images_array[] = $file;
								} else {
									//  echo 'I AM NOT A MATCH ' . $file . '<br>';
								}
							}
						}
					}
				}
			}
			if (count($images_array) > 0) {
				sort($images_array);
			}
			$dir->close();
		}
	}

	$GLOBALS['zco_notifier']->notify('NOTIFY_MODULES_ADDITIONAL_PRODUCT_IMAGES_LIST', NULL, $images_array);


	// Build output based on images found
	$num_images = count($images_array);
	// BOF changed by WT Tech. 1 of 8
	if ( $dis_addimgs_type == 'hover' ) {
		$num_images=( $num_images > 1 ) ? 1 : $num_images;
	} else if ( $dis_addimgs_type == 'vslide' ) {
		$max_additionalimg = (int)($prodlist_nums_addimgs);
		$num_images = ($num_images > $max_additionalimg) ? $max_additionalimg : $num_images;
	}
	// EOF changed by WT Tech. 1 of 8
	
	$list_box_contents = array();
	$title = '';
	// BOF changed by WT Tech. 2 of 8
	if ($num_images > 0 && $dis_addimgs_type != 'default' ) {
	// EOF changed by WT Tech. 2 of 8
		$row = 0;
		$col = 0;
		if ($num_images < IMAGES_AUTO_ADDED || IMAGES_AUTO_ADDED == 0 ) {
			$col_width = floor(100/$num_images);
		} else {
			$col_width = floor(100/IMAGES_AUTO_ADDED);
		}
		// BOF changed by WT Tech. 3 of 8
		$num_images = ( $dis_addimgs_type == 'vslide' ) ? ( $num_images-1 ) : $num_images;
		for ($i=0, $n=$num_images; $i<$n; $i++) {
		// BOF changed by WT Tech. 3 of 8
			$file = $images_array[$i];
			$products_image_large = str_replace(DIR_WS_IMAGES, DIR_WS_IMAGES . 'large/', $products_image_directory) . str_replace($products_image_extension, '', $file) . IMAGE_SUFFIX_LARGE . $products_image_extension;

			// -----
			// This notifier lets any image-handler know the current image being processed, providing the following parameters:
			//
			// $p1 ... (r/o) ... The current product's name
			// $p2 ... (r/w) ... The (possibly updated) filename (including path) of the current additional image.
			//
			$GLOBALS['zco_notifier']->notify('NOTIFY_MODULES_ADDITIONAL_IMAGES_GET_LARGE', $products_ar['products_name'], $products_image_large);

			$flag_has_large = file_exists($products_image_large);
			$products_image_large = ($flag_has_large ? $products_image_large : $products_image_directory . $file);
			$flag_display_large = (IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE == 'Yes' || $flag_has_large);
			$base_image = $products_image_directory . $file;
			// BOF changed by WT Tech. 4 of 8
			$thumb_slashes = wt_image(addslashes($base_image), addslashes($products_ar['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="' . $lazyClass . '"', 'product');
			// BOF changed by WT Tech. 4 of 8
			
			// BOF changed by WT Tech. 5 of 8
			$img_class='';
			if ( $dis_addimgs_type != 'vslide' ){
				$img_class = 'class="secondary ' . $lazyClass . '"';
			}
			// BOF changed by WT Tech. 5 of 8
			
			// -----
			// This notifier lets any image-handler "massage" the name of the current thumbnail image name (with appropriate
			// slashes for javascript/jQuery display):
			//
			// $p1 ... (n/a) ... An empty array, not applicable.
			// $p2 ... (r/w) ... A reference to the "slashed" thumbnail image name.
			//
			$GLOBALS['zco_notifier']->notify('NOTIFY_MODULES_ADDITIONAL_IMAGES_THUMB_SLASHES', array(), $thumb_slashes);
			// BOF changed by WT Tech. 6 of 8
			$image_regular = wt_image( $base_image, $products_ar['products_name'], $width, $height, $img_class, 'product' );
			$large_link = zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $products_ar['products_id'] . '&pic=' . $i . '&products_image_large_additional=' . $products_image_large);
			// BOF changed by WT Tech. 6 of 8
			

			// Link Preparation:
			// -----
			// This notifier gives notice that an additional image's script link is requested.  A monitoring observer sets
			// the $p2 value to boolean true if it has provided an alternate form of that link; otherwise, the base code will
			// create that value.
			//
			// $p1 ... (r/o) ... An associative array, containing the 'flag_display_large', 'products_name', 'products_image_large', 'thumb_slashes' and current 'index' values.
			// $p2 ... (r/w) ... A reference to the $script_link value, set here to boolean false; if an observer modifies that value, the
			//                     this module's processing is bypassed.
			// $p3 ... (r/w) ... A reference to the $link_parameters value, which defines the parameters associated with the above
			//                     link's display.  If the $script_link is updated, these parameters will be used for the display.
			//
			$script_link = false;
			$link_parameters = 'class="additionalImages centeredContent back"' . ' ' . 'style="width:' . $col_width . '%;"';
			$GLOBALS['zco_notifier']->notify(
				'NOTIFY_MODULES_ADDITIONAL_IMAGES_SCRIPT_LINK',
				array(
					'flag_display_large' => $flag_display_large,
					'products_name' => $products_ar['products_name'],
					'products_image_large' => $products_image_large,
					'thumb_slashes' => $thumb_slashes,
					'large_link' => $large_link,
					'index' => $i
				),
				$script_link,
				$link_parameters
			);
			
			$script_link = '<a href="' . $product_link . '" title="' . $products_ar['products_name'] . '">' . $image_regular  . '</a>';
			
			// BOF changed by WT Tech. 7 of 8
			$list_box_contents[$row][$col] = array('params' => 'class="item"', 'text' => array( 'imglink' => $script_link, 'img' => $image_regular ) );
			// BOF changed by WT Tech. 7 of 8
		   
			$col++;
			if ($col > (IMAGES_AUTO_ADDED -1)) {
				$col = 0;
				$row++;
			}
		} // end for loop
		// BOF changed by WT Tech. 8 of 8
		if ( $dis_addimgs_type == 'hover' ) {
				$second_img = '';
				for($row=0;$row<sizeof($list_box_contents);$row++)
				{
					for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
					{
						$r_params = "";
						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
							if (isset($list_box_contents[$row][$col]['text']['img'])) 
							{ 
								$second_img.=$list_box_contents[$row][$col]['text']['img'];
							}
						}
				}
				
				$content .= '<a class="prd-img ' . $dis_imghover_classes . '" href="' . $product_link . '" title="' . $products_ar['products_name'] . '"><span class="tt-img">' . wt_image(DIR_WS_IMAGES.$products_image, $products_ar['products_name'], $width, $height, 'class="primary js-prd-img ' . $lazyClass . '"', 'product') . '</span><span class="tt-img-roll-over">' .$second_img . '</span></a>';
		  
		} else {
			$content.='
			<div class="data-slick prd-imgs-slider" data-slick="{\'slidesToShow\': 1}">';
				$content.='<div class="img-item"><a class="prd-img" href="' . $product_link . '" title="' . $products_ar['products_name'] . '">' . wt_image(DIR_WS_IMAGES.$products_image, $products_ar['products_name'], $width, $height, 'class="' . $lazyClass . '"', 'product')  . '</a></div>';
				
				
			for($row=0;$row<sizeof($list_box_contents);$row++)
				{
					$params = "";
					//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
					for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
					{
						$r_params = "";
						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
							if (isset($list_box_contents[$row][$col]['text']['imglink'])) 
							{ 
								$content.='<div' . $r_params . '>' . $list_box_contents[$row][$col]['text']['imglink'] .  '</div>';
							}
						}
				}
			$content.='
			</div>
			';
		}
		// BOF changed by WT Tech. 8 of 8
	} else { // endif
		$content.='<span class="tt-img"><a class="prd-img" href="' . $product_link . '" title="' . $products_ar['products_name'] . '">' .wt_image(DIR_WS_IMAGES.$products_image, $products_ar['products_name'], $width, $height, 'class="' . $lazyClass . '"', 'product')  . '</a></span>';
	} // endif

	$GLOBALS['zco_notifier']->notify('NOTIFY_MODULES_ADDITIONAL_PRODUCT_IMAGES_END');
	/*************************************** EOF Additional Image Default Content ****************************************************/
	return $content;
}

function wt_neoncart_quickview( $id ){
	$quickview_status = ( !empty( get_wt_neoncart_options('wt_quickview_status') ) ) ? get_wt_neoncart_options('wt_quickview_status') : 1 ;
	if( $quickview_status ) {
		$quickview = '<a href="' . (zen_href_link(FILENAME_DEFINE_WT_QUICKVIEW,'products_id=' . $id, 'SSL')) . '" class="icon-quickview tt-btn-quickview quickview-action" data-toggle="modal" data-target="#ModalquickView" title="' . WT_QUICK_VIEW_TEXT . '" tabindex="0"><i class="far fa-eye"></i></a>';
		return $quickview;
	}
	return;
}

function get_wt_neoncart_sidebox_products_content( $products_obj ) {
	
	global $wt_pimgldr;
		
	//set cPath
	$cPath = zen_get_generated_category_path_rev( $products_obj->fields['master_categories_id'] );
	
	//set Infopagelink
	$zen_get_info_page = wt_get_info_page( $products_obj );
	
	/*EOF changed by WT Tech. -------------------*/
	
	$content = '';
	$product_price = zen_get_products_display_price( $products_obj->fields['products_id'] );
	
	//lazyload Class
	$lazyClass = ( !empty($wt_pimgldr ) ) ? $wt_pimgldr['class'] : '';
	
	$content .= '<div class="item">
					<div class="supermarket_product_small">
						<div class="item_image">
							<a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id']) . '">
							' . wt_image( DIR_WS_IMAGES . $products_obj->fields['products_image'], $products_obj->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="' . $lazyClass . '"', 'product' ) . '
							</a>
						</div>
						<div class="item_content">
							<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id']) . '">' . $products_obj->fields['products_name'] . '</a></h3>
							<div class="item_price">' . $product_price . '</div>
							' . wt_neoncart_product_reviews( $products_obj->fields['products_id'], ( isset( $products_obj->fields['zen_get_info_page'] ) ) ? $products_obj->fields['zen_get_info_page'] :  wt_get_info_page( $products_obj->fields ) ) . '
						</div>
					</div>
				</div>';
	
	return $content;
}
function wtExtraBtnLink( $products_obj ) {
	if ( !defined( 'WT_AJAXCART_STATUS' ) ) define( 'WT_AJAXCART_STATUS', 'false' );
	if ( WT_AJAXCART_STATUS == 'true' ) {
		$products_id = $products_obj->fields['products_id'];
		if ( zen_has_product_attributes( $products_id ) == 1 ) {
			return 'onclick="setWTShowOptions(this, \'' . $products_id.  '\', \'' . zen_href_link( FILENAME_DEFINE_WT_AJAXCART, 'products_id=' . $products_id, 'SSL') . '\'); return false;"';
		}else{
			return 'onclick="setWTAjaxCart(this, \'' . $products_id . '\'); return false;"';
		}
	}
	return false;
}

function get_wt_neoncart_compare( $products_id, $wt_display_style ) {
	$display_compare = get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_compare', 1 );
	$compare_link = array();
	if ( COMPARE_MODULE_ENABLED && !empty( $display_compare ) ) {
		$is_added = ( !empty( $_SESSION['compare'] ) ) ? ( ( in_array( $products_id, ( ( !empty( $_SESESION['compare'] ) ) ? (array)$_SESESION['compare'] : array() ) ) ) ? 'active' : '' ) : '';
		$compare_link['classes'] = 'compare-action ' . ( !empty( $is_added ) ? $is_added : '' );
		$compare_link['params'] = ' href="'. zen_href_link( FILENAME_COMPARE, 'add=' . $products_id, 'SSL') .'" data-action="add" data-compare_id="'. $products_id .'" data-add="' . TITLE_ADD_TO_COMPARE . '" data-remove="' . TITLE_REMOVE_FROM_COMPARE . '" data-tooltip="'. ( ( !empty( $is_added ) ) ? TITLE_REMOVE_FROM_COMPARE : TITLE_ADD_TO_COMPARE ) .'" data-tposition="left"';
	}
	return $compare_link;
}

function wt_get_products_class( $type = 'general' ) {
	global $homepage_version;
	$classes = '';
	if( in_array( $homepage_version, array( 'homepage_v2' ) ) ) {
		$classes = 'ecommerce_product_grid';
	} else if( in_array( $homepage_version, array( 'homepage_v3' ) ) ) {
		$classes = 'fashion_minimal_product';
	} else {
		$classes = 'supermarket_product_item';
	}
	return $classes;
}

function get_wt_neoncart_product_content( $products_obj, $wt_display_style, $etc_ar = array(), $type = '' ) {

	global $current_page_base;
	$products_ar = array();
	$products_ar['products_class'] = array();
	$products_ar['products_name'] = '';
	$products_ar['products_price'] = '';
	$products_ar['product_quickview'] = '';
	$products_ar['hover_label_prod'] = '';
	$products_ar['buy_now'] = '';
	$products_ar['wishlist_link'] = '';
	$products_ar['compare_link'] = array();
	$products_ar['products_image'] = '';
	$products_ar['products_label'] = '';
	$products_ar['products_review'] = '';
	$products_ar['products_new'] = '';
	$products_ar['zen_has_product_attributes'] = false;
	$products_ar['zen_get_products_allow_add_to_cart'] = '';
	
	if ( is_array( $products_obj ) ) {
		$products_obj_ar = $products_obj;
	} else {
		$products_obj_ar = $products_obj->fields;
	}
		
	// Products name
	$products_ar['products_name'] = '<h2 class="product-name"><a href="' . zen_href_link($products_obj_ar['zen_get_info_page'], 'cPath=' . $products_obj_ar['cPath'] . '&products_id=' . $products_obj_ar['products_id'], 'SSL') . '">' . $products_obj_ar['products_name'] . '</a></h2>';
	
	// Additional Image
	$image_width = ( isset( $etc_ar['image_width'] ) ) ? $etc_ar['image_width'] : '';
	$image_height = ( isset( $etc_ar['image_height'] ) ) ? $etc_ar['image_height'] : '';
	$products_ar['products_image'] =  wt_neoncart_additional_images( $products_obj_ar, $wt_display_style, $image_width, $image_height );
	
	if ( in_array( $wt_display_style, array( 'tab_slider', 'micro_slider', 'micro_small_slider', 'micro_small_ver_slider' ) ) ){
		$wt_display_style = 'slider';
	}
	
	if ( $wt_display_style == '' ) {
		if ( $current_page_base == 'product_info' ) {
			$wt_display_style = 'pinfo';
		}
	}

	// Products model
	if(!isset($products_obj_ar['products_model'])) $products_obj_ar['products_model'] = '';
	$products_ar['products_model'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_model', 1 ) ) ? $products_obj_ar['products_model'] : '';
	
	// Products price
	$products_ar['products_price'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_price', 1 ) ) ? zen_get_products_display_price( $products_obj_ar['products_id'] ) : '';
	
	// Quickview
	$products_ar['product_quickview'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_quickview', 1 ) )? wt_neoncart_quickview( $products_obj_ar['products_id'] ) : '';
	
	// Ratings
	$products_ar['products_review'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_rattings', 1 ) ) ? wt_neoncart_product_reviews( $products_obj_ar['products_id'], ( isset( $products_obj_ar['zen_get_info_page'] ) ) ? $products_obj_ar['zen_get_info_page'] :  wt_get_info_page( $products_obj_ar ) ) : '';
	
	// Label
	$products_ar['products_new'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_newlabel', 1 ) ) ? wt_neoncart_new_product( $products_obj_ar ) : '';
	$products_ar['product_sale'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_salelabel', 1 ) ) ? wt_neoncart_specials_product( $products_obj_ar['products_id'] ) : '';
	$products_ar['products_label'] .= (($products_ar['product_sale']) ? '<li class="label-sale">' . WT_BADGE_SALE . '</li>' : '');
	$products_ar['products_label'] .= (($products_ar['products_new']) ? '<li class="label-new">' . WT_BADGE_NEW . '</li>' : '');
		
	// Wishlist 
	$products_ar['wishlist_link'] = ( UN_DB_MODULE_WISHLISTS_ENABLED == 'true' && get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_wishlist', 1 ) ) ? zen_href_link( UN_FILENAME_WISHLIST, 'products_id=' . $products_obj_ar['products_id'] . '&action=wishlist_add_product', 'SSL') : '';
	
	//compare
	$products_ar['compare_link'] = ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_copmare', 1 ) ) ? get_wt_neoncart_compare( $products_obj_ar['products_id'], $wt_display_style ) : '';
		
	// Get products has attribute
	$products_ar['zen_has_product_attributes'] = zen_has_product_attributes( $products_obj_ar['products_id'] );
	
	// Allow add to cart
	$products_ar['zen_get_products_allow_add_to_cart'] = zen_get_products_allow_add_to_cart($products_obj_ar['products_id']);
	
	// Other content
	$minmaxqty = zen_get_products_quantity_min_units_display( $products_obj_ar['products_id'] );
	if ( $products_obj_ar['products_quantity'] <= 0 && $products_obj_ar['products_type'] != 3 && SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1' ) {
		$products_ar['products_class'][] = 'prd-outstock';
		$products_ar['products_label'] = '<li class="label-outstock">' . WT_BADGE_SOLD_OUT . '</li>';
		$product_content['buy_now'] = '<button class="normal_button button btn button_sold_out">'.WT_BADGE_SOLD_OUT.'</button>';
	} else if ( get_wt_neoncart_options( 'display_prod_' . $wt_display_style . '_addtocart', 1 ) ) {
		if ( ( $products_ar['zen_get_products_allow_add_to_cart'] != 'N' ) && $products_obj_ar['product_is_call'] == '1' ) {
			$products_ar['buy_now'] = '<a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '" title="' . TEXT_CALL_FOR_PRICE . '"><i class="fal fa-phone-volume"></i></a>';
		} else if ( $products_ar['zen_has_product_attributes'] == 1 ) {
			$products_ar['buy_now'] = zen_get_buy_now_button($products_obj_ar['products_id'],'<a class="addtocart_btn button thumbprod-button-bg btn-opt btn" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_obj_ar['products_id'], 'SSL') . '" ' . wtExtraBtnLink($products_obj) . ' title="' . TITLE_SELECT_OPTIONS . '"><i class="far fa-list mr-2"></i><span class="qck-text d-none">' . TITLE_SELECT_OPTIONS . '</span></a>') . ( ( $minmaxqty ) ? '<span class="tt-row-btn min-max-qty">' . $minmaxqty . '</span>' : '' );
		} else {
			$products_ar['buy_now'] = zen_get_buy_now_button( $products_obj_ar['products_id'], '<a class="addtocart_btn button thumbprod-button-bg" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_obj_ar['products_id'], 'SSL') . '" ' . wtExtraBtnLink($products_obj) . ' title="' . TITLE_ADD_TO_CART . '"><i class="fal fa-shopping-basket mr-2"></i><span class="qck-text d-none">' . TITLE_ADD_TO_CART . '</span></a>' ).(($minmaxqty) ?'<span class="tt-row-btn min-max-qty">' . $minmaxqty . '</span>' : '' );
		}
	}
	return $products_ar;
}