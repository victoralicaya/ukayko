<?php
//placeholder21// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright(c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright(c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: categories_ul_generator.php 2004-07-11  DrByteZen $
//      based on site_map.php v1.0.1 by networkdad 2004-06-04
//


class wt_neoncart_categories_ul_generator {
    var $root_category_id = 0,
    $max_level = 0,
	$root_start_string = '',
    $root_end_string = '',
    $parent_start_string = '',
    $parent_end_string = '',
    $data = array(),
    $parent_group_start_string = '<ul%s>',
    $parent_group_end_string = '</ul>',
    $child_start_string = '<li%s>',
    $child_end_string = '</li>',
    $spacer_string = '
',
	$lazyClass = '',
    $spacer_multiplier = 1;
    
    var $document_types_list = ' (3) ';
    // acceptable format example: ' (3, 4, 9, 22, 18) '
    
    function __construct( $wt_menu )
    {
		global $languages_id, $db, $wt_pimgldr;
		
		//lazyload Class
		$this->lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
		
        $this->data = array();
		if ( empty( $wt_menu ) ) {
			$categories_query = "select c.categories_id, c.categories_image, cd.categories_name, c.parent_id
											from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
											where c.categories_id = cd.categories_id
											and c.categories_status=1 " .
											" and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' " .
											" order by c.parent_id, c.sort_order, cd.categories_name";
			$categories = $db->Execute($categories_query);
			while (!$categories->EOF) {
				$this->data[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'categories_image' => $categories->fields['categories_image']);
				$categories->MoveNext();
			}
		} else {
			$this->data = $wt_menu;
		}
    }
	
	function buildBranch($parent_id, $level = 0, $submenu = true, $parent_link = '')
    {
        $level = (int)$level+1;
        $result = sprintf( $this->parent_group_start_string, ( $submenu ) ? ' class="level'. ($level+1) . '"' : '' );
        
        if (($this->data[$parent_id])) {
            foreach($this->data[$parent_id] as $category_id => $category) {
                $category_link = $parent_link . $category_id;
                if (isset($this->data[$category_id])) {
                    $result .= sprintf( $this->child_start_string, ( $submenu ) ? ' class="submenu"' : '' );
                } else {
                    $result .= sprintf( $this->child_start_string, '' );
                }
                $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '">';
                $result .= $category['name'];
                $result .= '</a>';

                if ( isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1)) ) {
                    $result .= $this->buildBranch($category_id, $level+1, $submenu, $category_link . '_');
                }
                $result .= $this->child_end_string;
            }
        }
        
        $result .= $this->parent_group_end_string;
        return $result;
    }
	
	function buildBranchMegamenu($parent_id, $level = 0, $submenu = true, $parent_link = ''){
		
		global $main_menu_type;
		
		$level = (int)$level;
		if( $level == 1 ) {
			$main_menu_type = $menu_type = get_wt_neoncart_options( 'menu_type_' . $parent_id, 1 );
		}
		$megamenu_columns = get_wt_neoncart_options( 'megamenu_show_columns_' . $parent_id, 3 );
		$sideblock_type = get_wt_neoncart_options( 'megamenu_btype_' . $parent_id, 'none' );
		$mn_html = '';
		if( $level == 1 ){
			if ( $main_menu_type == 1 ) {
				$mn_html = '<div class="dropdown-menu mega_menu "><div class="mmenu-submenu-inside"><div class="container">';
				$mn_html .= ( $sideblock_type != 'none' ) ? '<div class="row">' : '';
				$mn_html .= ( $sideblock_type != 'none' ) ? ( ( $sideblock_type == 'banner' ) ? '<div class="col-sm-9">' : '<div class="col-sm-8">' ) : '';
				$mn_html .= sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="row tt-col-list level'. ( $level ) . '"' : '' );
			} else {
				$mn_html .= sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="submenu level'. ( $level ) . '"' : '' );
			}
		} else if( $level != 0 ) {
			if ( $main_menu_type == 1 ) {
				$mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="'.(($level==2)? 'tt-megamenu-submenu ' : '') . $parent_id.' level'. ( $level ) . '"' : '' );
			} else {
				$mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="submenu level'. ( $level ) . '"' : '' );
			}
        }
		
        if ( isset( $this->data[$parent_id] ) ) {
            foreach( $this->data[$parent_id] as $category_id => $category ) {
                $category_link = $parent_link . $category_id;
				$cat_lnk = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link, 'SSL');
				$cat_hor_status = 1;
				if ( $level == 0 ) {
					$cat_hor_status = get_wt_neoncart_options( 'display_in_hor_menu_' . $category_id, 1 );
					$menu_class = ( ( get_wt_neoncart_options( 'menu_type_' . $category_id, 1 ) == 1 )? 'megamenu' : 'mmenu-item--simple' ).' dropdown has-submenu menu_item_has_child tt-submenu level'. ( $level );
				}
				
				if ( $cat_hor_status == 1 ) {
					if ( isset( $this->data[$category_id] ) ) {
						if (!isset($mn_html)) $mn_html='';
						if ( $level == 0 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.$menu_class.'"' : '');
						} else if ( $level == 1 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.(( $main_menu_type == 1 ) ? 'col ' . wt_cols_class( 'sm', $megamenu_columns ) : ' has-submenu menu_item_has_child').'"' : '');
						} else {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="dropdown has-submenu menu_item_has_child tt-submenu level'. ( $level ) . '"' : '');
						}
					} else {
						if ( $level == 0 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="dropdown"' : '');
						} else if ( $level == 1 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.(( $main_menu_type == 1 ) ? wt_cols_class( 'sm', $megamenu_columns ) : '').'"' : '');
						} else {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class=" level'. ( $level ) . '"' : '');
						}
					}
					
					$cat_lnk_title = '<a class="cat-title" href="' . $cat_lnk . '">' . $category['name'] . '</a>';
					$mn_html .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1);
					if ( $level == 0 ) {
						$mn_html .='<a href="' . $cat_lnk . '">'.$category['name'].'[BADGE ID="' . $category_id.'"]'.'</a>';
					} else if ( $level == 1 ) {
						$submenu_img = '';
						$imgstatus = get_wt_neoncart_options( 'subcat_imgstatus_' . $parent_id, 1 );
						if ( $category['categories_image'] && $imgstatus == 1 ){
							$submenu_img = '<a href="' . $cat_lnk . '"><span class="submenu-img">' . wt_image( DIR_WS_IMAGES . $category['categories_image'], '', WT_MEGAMENU_CATEGORY_IMAGE_WIDTH, WT_MEGAMENU_CATEGORY_IMAGE_HEIGHT, 'class="img-responsive '.$this->lazyClass.'"' ) . '</span></a>';
						}
						$mn_html .= ( $main_menu_type == 1 ) ? '<h6 class="tt-title-submenu">' . $cat_lnk_title . $submenu_img . '</h6>' : $cat_lnk_title;
					} else {
						$mn_html .= $cat_lnk_title;
					}
				
					if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
						$rs_sub = $this->buildBranchMegamenu($category_id, $level+1, $submenu, $category_link . '_');
						$mn_html .= $rs_sub;
					}
					$mn_html .= $this->child_end_string;
				}
            }
        }
		
		if ( $level != 0 ) {
			$mn_html .= $this->parent_group_end_string;
			if ( $main_menu_type == 1 && $level == 1 ) {
				$mn_html .= '</div>';
				$mn_html .= '[MEGAMENU--SIDE-BLOCK ID="' . $parent_id . '"]';
				$mn_html .= ( $sideblock_type != 'none' ) ? '</div></div></div>' : '';
				$mn_html .='[MEGAMENU-BOTTOM-BLOCK ID="' . $parent_id . '"]';
				$mn_html .= '</div>';
			}
		}
        return $mn_html;
	}
	
	function buildBranchVerMegamenu($parent_id, $level = 0, $submenu = true, $parent_link = ''){
		$level = (int)$level;
		$menu_type = get_wt_neoncart_options( 'menu_type_' . $parent_id, 1 );
		$megamenu_columns = get_wt_neoncart_options( 'megamenu_show_columns_' . $parent_id, 3 );
		$sideblock_type = get_wt_neoncart_options( 'megamenu_btype_' . $parent_id, 'none' );
		
		if ( $level == 0 ) {
			$mn_html = '';
		} else if( $level == 1 ) {
			if ( $menu_type == 1 ){
				$mn_html = '<div class="dropdown-menu size-lg"><div class="dropdown-menu-wrapper">';
				$mn_html .= ( $sideblock_type != 'none' ) ? '<div class="row">' : '';
				$mn_html .= ( $sideblock_type != 'none' ) ? ( ( $sideblock_type == 'banner' ) ? '<div class="col-sm-9">' : '<div class="col-sm-8">' ) : '';
				$mn_html .= sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="row tt-col-list level'. ( $level ) . '"' : '' );
			} else {
				$mn_html = '<div class="dropdown-menu">';
				$mn_html .= sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="tt-megamenu-submenu level'. ( $level ) . '"' : '' );
			}
		} else if( $level != 0 ) {
			if ( $menu_type == 1 ) {
				$mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="'.(($level==2)? 'tt-megamenu-submenu ' : '').' level'. ( $level ) . '"' : '' );
			} else {
				$mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="level'. ( $level ) . '"' : '' );
			}
        }
		
        if ( isset( $this->data[$parent_id] ) ) {
            foreach( $this->data[$parent_id] as $category_id => $category ) {
                $category_link = $parent_link . $category_id;
				$cat_lnk = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link, 'SSL');
				$cat_hor_status = 1;
				if ( $level == 0 ) {
					$cat_hor_status = get_wt_neoncart_options( 'display_in_ver_menu_' . $category_id, 1 );
					$menu_class = ( ( get_wt_neoncart_options( 'menu_type_' . $category_id, 1 ) == 1 ) ? 'dropdown' : 'mmenu-item--simple') . ' has-submenu tt-submenu level'. ( $level );
				}
				
				if ( $cat_hor_status == 1 ) {
					if ( isset( $this->data[$category_id] ) ) {
						if ( $level == 0 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.$menu_class.'"' : '');
						} else if ( $level == 1 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.(( $menu_type == 1 ) ? 'col ' . wt_cols_class( 'sm', $megamenu_columns ) : ' has-submenu tt-submenu').'"' : '');
						} else {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="dropdown has-submenu tt-submenu level'. ( $level ) . '"' : '');
						}
					} else {
						if ( $level == 0 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="dropdown"' : '');
						} else if ( $level == 1 ) {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="'.(( $menu_type == 1 ) ? wt_cols_class( 'sm', $megamenu_columns ) : '').'"' : '');
						} else {
							$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class=" level'. ( $level ) . '"' : '');
						}
					}
					
					$cat_lnk_title = '<a href="' . $cat_lnk . '">'.$category['name'].'</a>';
					$mn_html .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1);
					if ( $level == 0 ) {
						$mn_html .='<a href="' . $cat_lnk . '">'.$category['name'].'[BADGE ID="' . $category_id.'"]'.'</a>';
					} else if ( $level == 1 ) {
						$submenu_img = '';
						$imgstatus = get_wt_neoncart_options( 'subcat_imgstatus_' . $parent_id, 1 );
						if ( $category['categories_image'] && $imgstatus == 1 ){
							$submenu_img = '<a href="' . $cat_lnk . '"><span class="submenu-img">' . wt_image( DIR_WS_IMAGES . $category['categories_image'], '', WT_MEGAMENU_CATEGORY_IMAGE_WIDTH, WT_MEGAMENU_CATEGORY_IMAGE_HEIGHT, 'class="img-responsive '.$this->lazyClass.'"' ) . '</span></a>';
						}
						$mn_html .= ($menu_type == 1) ? '<h6 class="tt-title-submenu">'.$cat_lnk_title . $submenu_img . '</h6>' : $cat_lnk_title;
					} else {
						$mn_html .= $cat_lnk_title;
					}
				
					if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
						$rs_sub = $this->buildBranchVerMegamenu($category_id, $level+1, $submenu, $category_link . '_');
						$mn_html .= $rs_sub;
					}
					$mn_html .= $this->child_end_string;
				}
            }
        }
		
		if ( $level != 0 ) {
			$mn_html .= $this->parent_group_end_string;
			if ( $menu_type == 1 && $level == 1 ) {
				$mn_html .= '</div>';
				$mn_html .= '[MEGAMENU--SIDE-BLOCK ID="' . $parent_id . '"]';
				$mn_html .= ( $sideblock_type != 'none' ) ? '</div>' : '';
				$mn_html .='[MEGAMENU-BOTTOM-BLOCK ID="' . $parent_id . '"]';
				$mn_html .= ( $sideblock_type != 'none' ) ? '</div>' : '';
				$mn_html .= '</div>';
			}
		}
        return $mn_html;
	}
	
	function buildBranchMmenu($parent_id, $level = 0, $submenu=true, $parent_link='')
    {
		$level = (int)$level;
		if( $level == 0 ) {
			$mn_html = '';
		} else if($level != 0){
			$mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="category-sub nav-level-'. ($level+1) . '"' : '' );
		}
		
        if (($this->data[$parent_id])) {
            foreach($this->data[$parent_id] as $category_id => $category) {
                $category_link = $parent_link . $category_id;
				$cat_lnk = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link, 'SSL');
				//$cat_hor_status = $cat_ver_status = 1;
				$cat_ver_status = get_wt_neoncart_options( 'display_in_ver_menu_' . $category_id, 1 );
				$menu_type = 1;
			
                if ( isset( $this->data[$category_id] ) ) {
					if($cat_ver_status == 1){
						$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="has-sub"' : '');
					}
                } else {
					if($cat_ver_status == 1){
					if (isset($this->data[$category_id]) && ($submenu==false)) {
						$mn_html .= sprintf($this->parent_start_string, ( $submenu ) ? ' class="nav-level-'.($level+1) . '"' : '');
						$mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="has-sub"' : '');
					} else {
						$mn_html .= sprintf($this->child_start_string, '');
					}
					}
                }
				
				if ($level == 0) {
					if($cat_ver_status == 1){
				   $mn_html .= $this->root_start_string;
					}
				}
				if($cat_ver_status == 1){
				$mn_html .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1) . '<a href="' . $cat_lnk . '">' . $category['name'] . '</a><span class="arrow"></span>';
				}
				if ($level == 0) {
					if($cat_ver_status == 1){
					$mn_html .= $this->root_end_string;
					}
				}
				if (isset($this->data[$category_id])) {
					if($cat_ver_status == 1){
					$mn_html .= $this->parent_end_string;
					}
				}
				
                if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
					$rs_sub = $this->buildBranchMmenu($category_id, $level+1, $submenu, $category_link . '_');
					if($cat_ver_status == 1){
					$mn_html .= $rs_sub;
					}
                }
            }
        }
		
		if($level != 0){
			$mn_html .= $this->parent_group_end_string;
		}
		
        return $mn_html;
    }
	
	function buildBranchSimpleMenu($parent_id, $level = 0, $submenu=true, $parent_link='')
    {
		$level = (int)$level;
        $mn_html = sprintf($this->parent_group_start_string, ( $submenu ) ? ' class="'.(($level==0) ? ' submenu' : '') . (($level != 0)? '' : '').' submenu level'. ($level+1) . '"' : '' );
		
        if (($this->data[$parent_id])) {
            foreach($this->data[$parent_id] as $category_id => $category) {
                $category_link = $parent_link . $category_id;
				$cat_lnk = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link, 'SSL');
				
                if (isset($this->data[$category_id])) {
                    $mn_html .= sprintf($this->child_start_string, ( $submenu ) ? ' class="menu_item_has_child level'. ($level+1).'"' : ' class="level'. ($level+1).'"');
					$mn_html .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1) . '<a href="' . $cat_lnk  . '">';
					$mn_html .= '<span>'.$category['name'].'</span>';
					$mn_html .= '</a>';
										
                } else {
                    $mn_html .= sprintf($this->child_start_string, ' class="level'. ($level+1).'"');
					$mn_html .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1) . '<a href="' . $cat_lnk . '">';
					$mn_html .= $category['name'];
					$mn_html .= '</a>';
                }
				
                if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
					$rs_sub = $this->buildBranchSimpleMenu($category_id, $level+1, $submenu, $category_link . '_');
                    $mn_html .= $rs_sub;
                }
                $mn_html .= $this->child_end_string;
            }
        }
		
        $mn_html .= $this->parent_group_end_string;
		
        return $mn_html;
    }
    
    function buildTree($submenu=false)
    {
        return $this->buildBranch($this->root_category_id, '', $submenu);
    }
	
	function buildTreeMegamenu($submenu=false)
    {
        return $this->buildBranchMegamenu($this->root_category_id, '', $submenu);
    }
	
	function buildTreeVerMegamenu($submenu=false)
    {
        return $this->buildBranchVerMegamenu($this->root_category_id, '', $submenu);
    }
	
	function buildTreeMmenu($submenu=false)
    {
        return $this->buildBranchMmenu($this->root_category_id, '', $submenu);
    }
	
	function buildTreeSimpleMenu($submenu=false)
    {
        return $this->buildBranchSimpleMenu($this->root_category_id, '', $submenu);
    }
}