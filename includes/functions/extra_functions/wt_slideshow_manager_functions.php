<?php
/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */

if ( WT_SLIDESHOW_MANAGER_STATUS == 'true' ) {
	
	if ( !function_exists( 'wt_slideshow_manager' ) ) {
		
		function wt_slideshow_manager( $wtsm_id, $slider_title = '' ) {
			
			global $db, $wt_pimgldr;
			$wtsm_id_flag = false;
			
			//lazyload Class
			$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
			
			if ( $wtsm_id ) {
				
				$wtsm_ar = $wtsmb_ids_ar = array();
				$wtsm_res = $db->Execute( "SELECT wtsm.*, wtsmb.*, wtsmbc.*
				FROM " . TABLE_WT_SLIDESHOW_MANAGER . " wtsm 
				LEFT JOIN " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " wtsmb on wtsm.wtsm_id = wtsmb.wtsm_id and wtsmb.wtsmb_status = 1
				LEFT JOIN " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT . " wtsmbc on wtsmb.wtsmb_id = wtsmbc.wtsmb_id AND wtsmbc.languages_id = '" . (int)$_SESSION['languages_id'] . "'
				where wtsm.wtsm_id = '".$wtsm_id."' and wtsm.wtsm_status = '1' order by wtsmb.wtsmb_sort_order");
				if ( $wtsm_res->RecordCount() >  0 ) {
					$br_total = $wtsm_res->RecordCount();
					$fullScreen = false;
					$wtsm_id_flag = true;
					$i = 0;
				
					$wrapper_data = array();
					$wrapper_data['id'] = 'wtslider-'. $wtsm_id;
					$wrapper_data['class'] = array( 'wtslider', 'keep-scale' );
					if ( !empty( $wtsm_res->fields['wtsm_full_screen'] ) ) {
						$fullScreen = true;
						$wrapper_data['class'][] = 'wtslider--fullscreen';
					} else {
						$wrapper_data['data-width'] = ( isset( $wtsm_res->fields['wtsm_width'] ) ) ? $wtsm_res->fields['wtsm_width'] : 0;
						$wrapper_data['data-height'] = ( isset( $wtsm_res->fields['wtsm_height'] ) ) ? $wtsm_res->fields['wtsm_height'] : 0;
						$wrapper_data['class'][] = ( $wrapper_data['data-width'] == 0 ) ? 'fixWidth' : 'autoWidth';
						$wrapper_data['class'][] = ( $wrapper_data['data-height'] == 0 ) ? 'fixHeight' : 'autoHeight';
						
					}
					
					$wrapper_data['data-autoplay'] = wtsm_get_boolean_value( ( isset( $wtsm_res->fields['wtsm_autoplay'] ) ) ? $wtsm_res->fields['wtsm_autoplay'] : 1 );
					$wrapper_data['data-autoplay-speed'] =  ( isset( $wtsm_res->fields['wtsm_interval_time'] ) ) ? $wtsm_res->fields['wtsm_interval_time'] : 3000;
					$wrapper_data['data-speed'] = ( isset( $wtsm_res->fields['wtsm_slide_speed'] ) ) ? $wtsm_res->fields['wtsm_slide_speed'] : 300;
					$wrapper_data['data-dots'] = wtsm_get_boolean_value( ( isset( $wtsm_res->fields['wtsm_pager'] ) ) ? $wtsm_res->fields['wtsm_pager'] : 1 );
					$wrapper_data['data-nav'] = wtsm_get_boolean_value( ( isset( $wtsm_res->fields['wtsm_controls'] ) ) ? $wtsm_res->fields['wtsm_controls'] : 1 );
					$wrapper_data['data-infinite'] = wtsm_get_boolean_value( ( isset( $wtsm_res->fields['wtsm_infinite'] ) ) ? $wtsm_res->fields['wtsm_infinite'] : 1 );
					$wrapper_data['data-onhoverpause'] = wtsm_get_boolean_value( ( isset( $wtsm_res->fields['wtsm_on_hover'] ) ) ? $wtsm_res->fields['wtsm_on_hover'] : 0 );
					$wrapper_data['data-fade'] = ( !empty( $wtsm_res->fields['wtsm_slide_animation'] ) && $wtsm_res->fields['wtsm_slide_animation'] == 'fade' ) ? 'true' : 'false';
					
					$html = '<div class="wtslider-wrapper">';
						$html .= '<div ' . wt_stringify_atts( $wrapper_data ) . '>';
						//$dots_html = '';
						foreach( $wtsm_res as $k => $banner ) {
							//print_r($banner);exit;
							$wtsmb_ids_ar[] = $banner['wtsmb_id'];
							$cp_class = $cp_styles = '';
							extract( $banner );
							$slideHeightClass = ( $wtsmb_type == 'img_with_link' ) ? 'imgLink' : 'imgCont';
							
							if ( !empty( $wtsmb_background_image ) ) {
								$wtsmb_background_image = DIR_WS_IMAGES . $wtsmb_background_image;
								list( $width, $height, $type, $wtsmb_mobile_image_info ) = getimagesize( $wtsmb_background_image );
							}
							
							if ( !empty( $wtsmb_image ) ) {
								$wtsmb_image = DIR_WS_IMAGES . $wtsmb_image;
								list( $width, $height, $type, $wtsmb_image_info ) = getimagesize( $wtsmb_image );
							}	
							if ( !empty( $wtsmb_mobile_image ) ) {
								$wtsmb_mobile_image = DIR_WS_IMAGES . $wtsmb_mobile_image;
								list( $width, $height, $type, $wtsmb_mobile_image_info ) = getimagesize( $wtsmb_mobile_image );
							}
							
							if ( $wtsmb_cp == 'cp-custom' ) {
								$cp_styles = ( $wtsmb_cpleft ) ? 'left:'.$wtsmb_cpleft.'%;' : '';
								$cp_styles .= ( $wtsmb_cptop ) ? ' top:'.$wtsmb_cptop.'%;' : '';
								$cp_class = $wtsmb_cp;
							} else {
								$cp_class = str_replace( 'cp-', 'txt-', $wtsmb_cp );
							}
							$wtsmbc_content = htmlspecialchars_decode( stripslashes( $wtsmbc_content ) );
							if ( $wtsmb_type == 'ban_img_with_content' ) {
								$wtsmb_attr = array();
								$wtsmb_attr['class'][] = 'wtslider-slide item';
								$wtsmb_attr['class'][] = $slideHeightClass;
								if( !empty( $wtsmb_extra_classes ) ) $wtsmb_attr['class'][] = $wtsmb_extra_classes;
								if( !empty( $wtsmb_background_color ) ) $wtsmb_attr['data-bg-color'] = $wtsmb_background_color;
								if( !empty( $wtsmb_background_image ) ) $wtsmb_attr['data-background'] = $wtsmb_background_image;
								if( ( $wtsmb_image !='' && ( $fullScreen == true ) ) ) $wtsmb_attr['style'] = 'background-image: url(' . $wtsmb_image . '); ';
								
								$html .= '<div ' . wt_stringify_atts( $wtsmb_attr ) . '>';
								if ( $fullScreen == false ) {
									if ( $wtsmb_image ) {
										$html .= '<div class="slider_image order-last"><img class="wtslider-image" src="' . $wtsmb_image . '" ' . $wtsmb_image_info . '/></div>';
									}
								}
								$html .= '<div class="wtslider-text-wrap wtslider-overlay">
												<div class="wtslider-text-content ' . ( ( $cp_class ) ? $cp_class : '' ) .'" style="' . ( ( $cp_styles ) ? $cp_styles : '' ) . '">
													' . $wtsmbc_content . '
												</div>
											</div>';
								$html .= '</div>';
								
							} else if ( $wtsmb_type == 'img_with_content' ) {
								$html .= '<div class="wtslider-slide item ' . $slideHeightClass .'" '. ( !empty( $wtsmb_background_color ) ? 'data-bg-color="'.$wtsmb_background_color.'"' : '' ) .' style="' . ( ( $wtsmb_image !='' && ( $fullScreen == true ) ) ? 'background-image: url(' . $wtsmb_image . '); ' : '' ) . '">';
								$html .= '<div class="wtslider-text-wrap wtslider-overlay">
												<div class="wtslider-text-content ' . ( ( $cp_class ) ? $cp_class : '' ) .'" style="' . ( ( $cp_styles ) ? $cp_styles : '' ) . '">
													' . $wtsmbc_content . '
												</div>
											</div>';
								if ( $fullScreen == false ) {
									if ( $wtsmb_image ) {
										$html .= '<div class="slider_image"><img class="wtslider-image" src="' . $wtsmb_image . '" ' . $wtsmb_image_info . '/></div>';
									}
								}
								$html .= '</div>';
								
							} else if ( $wtsmb_type == 'img_with_link' ) {
								$html .= '<div class="wtslider-slide ' . $slideHeightClass . '" '. ( !empty( $wtsmb_background_color ) ? 'data-bg-color="'.$wtsmb_background_color.'"' : '' ) .'>';
								if ( $wtsmb_link ) { echo '<a href="' . $wtsmb_link . '">'; }
									$html .= '<div class="slider_image"><img class="slide-image lazyOwl" src = "' . $wtsmb_image . '" alt="slide" ' . $wtsmb_image_info . ' /></div>';
								if ( $wtsmb_link ){ $html .= '</a>'; }
								$html .= '</div>';
							}
							$i++;
							//$dots_html .= '<div class="dot"></div>';
						}
						$html .= '</div>';
						/*if ( $wrapper_data['data-dots'] ) {
							$html .= '<div class="wtslider-loader"><div class="loader-wrap">' . ( ( $dots_html ) ? '<div class="dots">' . $dots_html . '</div>' : '' ) . '</div></div>';
							$html .= '<div class="wtslider-dots hor-dots container-fluid"></div>';
						}
						if ( $wrapper_data['data-nav'] ) {
							$html .= '<div class="wtslider-arrows container-fluid"><div></div></div>';
						}*/
					$html .= '</div>';
					
					//wtsm_update_banner_display_count( $wtsmb_ids_ar );
				}
				
				if ( $wtsm_id_flag == false ) {
					$html = '<span class="alert alert-danger">Slideshow not found.</span>';
				}
			}
			return $html;
		}
	}
	
	function wt_slideshow_manager_shortcode( $homepage_html ) {
		global $template, $current_page_base, $db;
		$wt_is_home = true;
		require_once(DIR_FS_CATALOG . 'wt_includes/shortcodes.php');
		add_shortcode('wtsm_slider', 'wt_slideshow_manager_slider_shortcode');
		$homepage_html = do_shortcode( $homepage_html );
		return $homepage_html;
	}
		
	function wt_slideshow_manager_slider_shortcode( $atts, $content ) {
		
		global $template, $db, $current_page_base, $var_pageDetails;
		if ( !empty( $atts ) ) {
			$wtsm_id = isset( $atts['id'] ) ? $atts['id'] : '';
			$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
			$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
			$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
			$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
			$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
			$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
			$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
			$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
		}
		ob_start();
		include( $template->get_template_dir( 'tpl_wt_slideshow_manager.php', DIR_WS_TEMPLATE, $current_page_base, 'wtsm_templates'). '/tpl_wt_slideshow_manager.php' );
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
		
	/*function wtsm_update_banner_display_count( $wtsmb_ids_ar ) {
		global $db;
		if ( is_array( $wtsmb_ids_ar ) ) {
			$wtsmb_ids = implode( ',', $wtsmb_ids_ar);
			$wtsmh_count_ar = array();
			if($wtsmb_ids){
				$wtsmb_res = $db->Execute("select wtsmb.*, wtsmbh_.wtsmbh_id from " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " wtsmb LEFT JOIN " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " wtsmbh_ on wtsmb.wtsmb_id = wtsmbh_.wtsmb_id where wtsmb.wtsmb_id in (".$wtsmb_ids.")");
				if($wtsmb_res->RecordCount() > 0){
					while (!$wtsmb_res->EOF) {
						$wtsmh_count_ar[$wtsmb_res->fields['wtsmb_id']] = array('wtsmbh_id' => $wtsmb_res->fields['wtsmbh_id'], 'wtsmbh_shown' => $wtsmb_res->fields['wtsmbh_shown']);
						$wtsmb_res->MoveNext();
					}
				}
			}
			foreach($wtsmh_count_ar as $pck => $pcv){
				if($pcv['wtsmbh_id']){
					$sql = "update " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " set wtsmbh_shown = wtsmbh_shown +1 where wtsmbh_id = '".$pcv['wtsmbh_id']."' and date_format(wtsmbh_history_date, '%%Y%%m%%d') = date_format(now(), '%%Y%%m%%d')";
					$db->Execute($sql);
				} else {
					$sql = "insert into " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " (wtsmb_id, wtsmbh_shown, wtsmbh_history_date) values (" . (int)$pck . ", 1, now())";
					$db->Execute($sql);
				}
			}
		}
	}*/

	/*function wtsm_update_banner_click_count( $wtsmb_id ) {
		global $db;
		DEFINE('SQL_WTSMB_UPDATE_CLICK_COUNT', "update " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " set wtsmbh_clicked = wtsmbh_clicked + 1 where wtsmb_id = '%s' and date_format(wtsmbh_history_date, '%%Y%%m%%d') = date_format(now(), '%%Y%%m%%d')");
		$db->Execute(sprintf(SQL_WTSMB_UPDATE_CLICK_COUNT, (int)$wtsmb_id));
		return array('status' => 'success');
	}*/
	
	if ( ! function_exists( 'get_wt_slideshow_config_options' ) ) {
		function get_wt_slideshow_config_options() {
			
			$options = array();
			$sldspeed = ( !empty( WT_SLIDESHOW_SLIDESPEED ) ) ? filter_var( WT_SLIDESHOW_SLIDESPEED, FILTER_SANITIZE_NUMBER_INT ) : 2000;
			$autoplay_interval_time=(WT_SLIDESHOW_AUTOPLAY_INTERVAL)? filter_var(WT_SLIDESHOW_AUTOPLAY_INTERVAL, FILTER_SANITIZE_NUMBER_INT) : 5000;
			$slideshow_width = (WT_SLIDESHOW_WIDTH!=0)? filter_var(WT_SLIDESHOW_WIDTH, FILTER_SANITIZE_NUMBER_INT) : 0;
			$slideshow_height = (WT_SLIDESHOW_HEIGHT!=0)? filter_var(WT_SLIDESHOW_HEIGHT, FILTER_SANITIZE_NUMBER_INT) : 0;
			$options['autoplay']= ( WT_SLIDESHOW_AUTOPLAY == 'true' ) ? true : false;
			$options['autoplayTimeout'] = ( WT_SLIDESHOW_AUTOPLAY_INTERVAL ) ? filter_var( WT_SLIDESHOW_AUTOPLAY_INTERVAL, FILTER_SANITIZE_NUMBER_INT ) : 5000; 
			$options['autoplaySpeed'] = $sldspeed;
			$options['navSpeed'] = $sldspeed;
			$options['dotsSpeed'] = $sldspeed;
			$options['dots']=((WT_SLIDESHOW_PAGER == 'true')? true : false);
			$options['autoplayHoverPause']=((WT_SLIDESHOW_ONHOVERSTOP == 'true')? true : false);
			$options['nav']=((WT_SLIDESHOW_CONTROLS == 'true')? true : false);
			
			$options['slideWidth'] = $slideshow_width;
			if($slideshow_height == 0){
				$options['autoHeight'] = true; 
			}else{
				$options['autoHeight'] = false;
				$options['slideHeight'] = $slideshow_height;
			}
			if(WT_SLIDESHOW_SLIDEEFFECT!='slide'){
				$options['animateIn']=(WT_SLIDESHOW_SLIDEEFFECT) ? WT_SLIDESHOW_SLIDEEFFECT.'In' : '';
				$options['animateOut']=(WT_SLIDESHOW_SLIDEEFFECT) ? WT_SLIDESHOW_SLIDEEFFECT.'Out' : '';
			}
			
			$options['navText']= ['prev','next'];
			$options['singleItem']= true;
			$options['addClassActive']= true;
			$options['items']= 1;
			$options['loop']= true;
			$options['center']= true;
			$options['autoWidth']= false;
			$options['rewind']= true;
			$options['info']= true;	
			$options['responsiveRefreshRate']= 10;	
			$options['fullscreen']= (defined(WT_SLIDESHOW_FULLSCREEN)? WT_SLIDESHOW_FULLSCREEN : false);
			return $options;
		}
	}
	
	if ( ! function_exists( 'wtsm_get_boolean_value' ) ) {
		function wtsm_get_boolean_value( $val ) {
			
			return ( $val ) ? 'true' : 'false';
		}
	}
	
	if ( ! function_exists( 'wt_stringify_atts' ) ) {

		function wt_stringify_atts( $attributes ) {

			if ( !empty( $attributes ) && is_array( $attributes ) ) { 
				$atts = array();
				
				foreach ( $attributes as $name => $value ) {
					if ( is_array( $value ) ) {
						$atts[] = $name . '="' . wt_stringify_classes( $value ) . '"';
					} else {
						$atts[] = $name . '="' . ( $value ) . '"';
					}
				}

				return implode( ' ', $atts );
			}
			return;
		}
	}
	
	if ( ! function_exists( 'wt_stringify_classes' ) ) {

		function wt_stringify_classes( $classes ) {
			
			if ( is_array($classes) ) {
				$classes = array_unique( $classes );
				$classes = ( trim( implode( ' ', $classes ) ) );
			}

			return $classes;
		}

	}
}