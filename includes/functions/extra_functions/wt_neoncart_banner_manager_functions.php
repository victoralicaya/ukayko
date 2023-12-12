<?php
/**
 * WT Neoncart Banner Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Neoncart Banner Manager 1.2.0
*/
if ( WT_NEONCART_BANNER_MANAGER_STATUS == 'true' ) {
	if ( !function_exists( 'wt_neoncart_banner_manager' ) ) {
		function wt_neoncart_banner_manager($wtwbm_id, $slider_title=''){
			global $db, $wt_pimgldr;
			$wtwbm_id_flag = false;
			
			//lazyload Class
			$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
			
			if( $wtwbm_id ){
				$wtwbm_ar = array();
				$wtwbm_res = $db->Execute('SELECT wtwbm.wtwbm_id, wtwbm.wtwbm_type, wtwbmb.wtwbmb_id, wtwbmb.wtwbmb_url, wtwbmb.wtwbmb_image, wtwbmbc.wtwbmbc_title, wtwbmbc.wtwbmbc_content
				FROM ' . TABLE_WT_NEONCART_BANNER_MANAGER . ' wtwbm 
				LEFT JOIN ' . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . ' wtwbmb on wtwbmb.wtwbm_id = wtwbm.wtwbm_id AND wtwbmb.wtwbmb_status = 1 
				LEFT JOIN ' . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT . ' wtwbmbc on wtwbmbc.wtwbmb_id = wtwbmb.wtwbmb_id AND wtwbmbc.languages_id = "' . (int)$_SESSION['languages_id'] . '" 
				WHERE wtwbm.wtwbm_id = "'.$wtwbm_id.'" AND wtwbm.wtwbm_status = 1 AND ( wtwbmb.wtwbmb_date_scheduled = "" || wtwbmb.wtwbmb_date_scheduled <= NOW() ) AND ( wtwbmb.wtwbmb_expires_date = "" || wtwbmb.wtwbmb_expires_date >= NOW() ) order by wtwbmb.wtwbmb_sort_order');
				if($wtwbm_res->RecordCount() >  0){
					$wtwbm_id_flag = true;
					while(!$wtwbm_res->EOF) {
						if ( isset( $wtwbm_res->fields ) ) {
							$wtwbm_res->fields['wtwbmbc_title'] = htmlspecialchars_decode( stripslashes( $wtwbm_res->fields['wtwbmbc_title'] ) );
							$wtwbm_res->fields['wtwbmbc_content'] = htmlspecialchars_decode( stripslashes( $wtwbm_res->fields['wtwbmbc_content'] ) );
						}
						$wtwbm_ar[$wtwbm_res->fields['wtwbm_id']][$wtwbm_res->fields['wtwbm_type']][$wtwbm_res->fields['wtwbmb_id']] = $wtwbm_res->fields;
						$wtwbm_res->MoveNext(); 
					}
				}
				if ( !empty( $wtwbm_ar ) ) {
					foreach( $wtwbm_ar as $k => $wtwbm_in_ar){
						foreach( $wtwbm_in_ar as $pk => $pv ){
							$wtwbmb_ids_ar = array_keys( $pv );
							if ( in_array( $pk, array( 'hm2-s1-s1' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="tt-carousel-products" data-item="1" data-item-lg="1" data-item-xl="1" data-item-md="1" data-item-sm="1" data-item-xs="1" data-arrows="false">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="item">';
											$html .= ''.$br_contents.'';						
											$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array( 'hm1-s6' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row tt-carousel-products tt-alignment-img tt-layout-product-item slick-animated-show-js slick-slider hide-slick-arrow"  data-item="5" data-item-lg="5" data-item-xl="5" data-item-md="3" data-item-sm="2" data-item-xs="1" >';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="item col-12">';
											$html .= ''.$br_contents.'';						
											$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array( 'hm2-s1-s2' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="grid-item bnr-wrap col-content bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
											$html .= ''.$br_contents.'';						
											$html .= '</div>';
										$i++;
									}
									
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array( 'hm2-s2', 'hm3-s1' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row no-gutters justify-content-lg-between">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bnr-wrap col-content bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
											$html .= ''.$br_contents.'';						
											$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array( 'hm3-s2' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row mt__30">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
										if( $i%3 == 0 ) {
											$html .= '<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
										} else if( $i%3 == 1 ) {
											$html .= '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
										}
										$html .= ''.$br_contents.'';
										if( $i%3 != 1 || $i == ( $br_total-1 ) ) {										
											$html .= '</div>';
										}
										$i++;
									}
									$html .= '</div>';
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array( 'hm3-s4' ) ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row justify-content-lg-between">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
										$html .= '<div class="col-lg-4 col-md-4 col-md-6 col-xs-12 bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
										$html .= ''.$br_contents.'';
										$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
									$html = wt_neoncart_home_shortcode( $html );
								}
							} else if ( in_array( $pk, array('hm1-s3', 'hm1-s4') ) ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row justify-content-center">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											if ( $pk == 'hm1-s3' ) {
												$html .= '<div class="col-lg-4">';
											} else {
												$html .= '<div class="col-lg-6">';
											}
											$html .= '<div class="bnr-wrap col-content bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
											$html .= $br_contents;					
											$html .= '</div>';
											$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
								}
							} else if ( $pk == 'hm1-s6' ) {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									$html .= '<div class="row bnr-grid">';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="col-md-12">';
											$html .= '<div class="bnr-wrap col-content bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
											$html .= $br_contents;						
											$html .= '</div>';
											$html .= '</div>';
										$i++;
									}
									$html .= '</div>';
								}
							} else {
								$br_total = count($pv);
								if(!empty($pv)){
									$i = 0;
									$html = '';
									foreach($pv as $bk => $bv){
										$br_contents = $bv['wtwbmbc_content'];
										$br_contents = str_replace('{image}', wt_image(DIR_WS_IMAGES.$bv['wtwbmb_image'], $bv['wtwbmbc_title'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'banner'), $br_contents);
											$html .= '<div class="col-md-12">';
											$html .= '<div class="bnr-wrap col-content bnr-click" data-bnr-id="'.$bv['wtwbmb_id'].'" data-href="'.$bv['wtwbmb_url'].'">';
											$html .= $br_contents;						
											$html .= '</div>';
											$html .= '</div>';
										$i++;
									}
									//$html .= '</div>';
								}
							}
							
							wtwbm_update_banner_display_count($wtwbmb_ids_ar);
						}
					}
				}
				
				if($wtwbm_id_flag == false){
					$html = '<span class="alert alert-danger">Banner Manager ID is not valid.</span>';
				}
			}
			return $html;
		}
	}
	
	function wtwbm_update_banner_display_count( $wtwbmb_ids_ar ) {
		global $db;
		if( is_array( $wtwbmb_ids_ar ) ) {
			$wtwbmb_ids_ar = array_filter($wtwbmb_ids_ar);
			$wtwbmb_ids = implode(',', $wtwbmb_ids_ar);
			$wtwbmh_count_ar = array();
			if($wtwbmb_ids){
				$wtwbmb_res = $db->Execute("select wtwbmb.wtwbmb_id, wtwbmbh.wtwbmbh_id, wtwbmbh.wtwbmbh_shown from " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " wtwbmb LEFT JOIN " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " wtwbmbh on wtwbmb.wtwbmb_id = wtwbmbh.wtwbmb_id where wtwbmb.wtwbmb_id in (".$wtwbmb_ids.")");
				if($wtwbmb_res->RecordCount() > 0){
					while (!$wtwbmb_res->EOF) {
						$wtwbmh_count_ar[$wtwbmb_res->fields['wtwbmb_id']] = array('wtwbmbh_id' => $wtwbmb_res->fields['wtwbmbh_id'], 'wtwbmbh_shown' => $wtwbmb_res->fields['wtwbmbh_shown']);
						$wtwbmb_res->MoveNext();
					}
				}
			}
			foreach($wtwbmh_count_ar as $pck => $pcv){
				if($pcv['wtwbmbh_id']){
					$sql = "update " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " set wtwbmbh_shown = wtwbmbh_shown +1 where wtwbmbh_id = '".$pcv['wtwbmbh_id']."' and date_format(wtwbmbh_history_date, '%%Y%%m%%d') = date_format(now(), '%%Y%%m%%d')";
					$db->Execute($sql);
				} else {
					$sql = "insert into " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " (wtwbmb_id, wtwbmbh_shown, wtwbmbh_history_date) values (" . (int)$pck . ", 1, now())";
					$db->Execute($sql);
				}
			}
		}
	}

	function wtwbm_update_banner_click_count($wtwbmb_id) {
		global $db;
		$sql = "update " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " set wtwbmbh_clicked = wtwbmbh_clicked + 1 where wtwbmb_id = '".$wtwbmb_id."' and date_format(wtwbmbh_history_date, '%%Y%%m%%d') = date_format(now(), '%%Y%%m%%d')";
		$db->Execute($sql);
		return array('status' => 'success');
	}
}