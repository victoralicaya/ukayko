<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * @copyright 2007 Clyde Jones
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v1.5.4
 */
	$content = '';
		$content .='<div class="post-prws tt-carousel-products arrow-location-03" data-slick=\'{"slidesToShow": 1}\' data-item="1">';
				for ($i=1; $i<=sizeof($page_query_list); $i++) {
					$content .= '<div class="tt-aside-info">';
					$content .= '<div class="tt-product thumbprod-center">';
					$content .= '<div class="tt-aside-img">';
						$content .= '<a href="' . zen_href_link(FILENAME_TESTIMONIALS_MANAGER, 'testimonials_id=' . $page_query_list[$i]['id'], 'SSL') . '" class="post-img">';
						if ($page_query_list[$i]['image'] != '') { 
							$content .= zen_image(DIR_WS_IMAGES . $page_query_list[$i]['image'], $page_query_list[$i]['name'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT, 'class="img-responsive-inline"') ;  
						} else {
							$content .= zen_image(DIR_WS_IMAGES . 'no_picture.gif', $page_query_list[$i]['name'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT, 'class="img-responsive-inline"') ;  
						}
						$content .= '</div>';
						$content .= '</a>';
						if (DISPLAY_TESTIMONIALS_MANAGER_TRUNCATED_TEXT == 'true') {
						$content .= '<h4 class="tt-title"><a href="' . zen_href_link(FILENAME_TESTIMONIALS_MANAGER, 'testimonials_id=' . $page_query_list[$i]['id'], 'SSL') . '">'.$page_query_list[$i]['name'].'</a></h4>
									<p class="tt-aside-content mb-2">' . zen_trunc_string($page_query_list[$i]['story'],TESTIMONIALS_MANAGER_DESCRIPTION_LENGTH) . '</p>';
						}
					$content .= '</div>';
					$content .= '</div>';
				}
		$content .= '</div>';
  
	if (DISPLAY_ADD_TESTIMONIAL_LINK == 'true') {
		$content .= '<div class="bettertestimonial text-center mb-1"><a class="btn button btn-sm" href="' . zen_href_link(FILENAME_TESTIMONIALS_ADD, '', 'SSL') . '">' . TESTIMONIALS_MANAGER_ADD_TESTIMONIALS . '</a></div>';
	}
	if (DISPLAY_ALL_TESTIMONIALS_TESTIMONIALS_MANAGER_LINK == 'true') {
		$content .= '<div class="bettertestimonial text-center"><a class="btn button btn-sm" href="' . zen_href_link(FILENAME_TESTIMONIALS_MANAGER_ALL, '', 'SSL') . '">' . TESTIMONIALS_MANAGER_DISPLAY_ALL_TESTIMONIALS . '</a></div>';
	}
//EOF