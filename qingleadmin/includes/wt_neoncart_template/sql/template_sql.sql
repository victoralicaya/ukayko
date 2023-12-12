#
# WT TEMPLATE SQL
#

CREATE TABLE IF NOT EXISTS wt_neoncart_template (
	opt_id int(11) NOT NULL AUTO_INCREMENT,
	lang_id int(11) NOT NULL DEFAULT '0',
	opt_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	opt_value text COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (opt_id)
);

INSERT INTO wt_neoncart_template (opt_id, lang_id, opt_name, opt_value) VALUES
(1, 0, 'homepage_version', 'homepage_v1'),
(2, 0, 'homepage_page_layout', '1column'),
(3, 0, 'general_page_layout', '2columns-left'),
(4, 0, 'page_loader', 'default'),
(5, 0, 'product_img_loader', '0'),
(6, 0, 'rtl_mode', '0'),
(7, 0, 'theme_color', '#cc1414'),
(8, 0, 'theme_second_color', '#003d82'),
(9, 0, 'general_font_family', 'Open Sans'),
(10, 0, 'font_latin_charset_extended', '0'),
(11, 0, 'font_custom_charset', ''),
(12, 0, 'prod_slider_addtionalimg_style', 'default'),
(13, 0, 'prod_slider_imghover_style', 'vslide'),
(14, 0, 'display_prod_slider_rattings', '1'),
(15, 0, 'display_prod_slider_price', '1'),
(16, 0, 'display_prod_slider_addtocart', '1'),
(17, 0, 'display_prod_slider_quickview', '1'),
(18, 0, 'display_prod_slider_wishlist', '0'),
(19, 0, 'display_prod_slider_compare', '1'),
(20, 0, 'display_prod_slider_salelabel', '1'),
(21, 0, 'display_prod_slider_newlabel', '1'),
(22, 0, 'display_testimonials', '1'),
(23, 0, 'facebook_link', '#'),
(24, 0, 'twitter_link', '#'),
(25, 0, 'pinterest_link', '#'),
(26, 0, 'instagram_link', '#'),
(27, 0, 'newsletter_details', '&lt;div class=&quot;form-inline&quot;&gt;\r\n	&lt;div class=&quot;subscribe-form-title&quot;&gt;subscribe to newsletter:&lt;/div&gt;\r\n	&lt;!-- Begin MailChimp Signup Form --&gt;\r\n	&lt;div id=&quot;mc_embed_signup&quot;&gt;\r\n	&lt;form action=&quot;https://gmail.us5.list-manage.com/subscribe/post?u=af50af167d2c4a9ef54fb921c&amp;amp;id=d7131598b4&quot; method=&quot;post&quot; id=&quot;mc-embedded-subscribe-form&quot; name=&quot;mc-embedded-subscribe-form&quot; class=&quot;validate&quot; target=&quot;_blank&quot; novalidate&gt;\r\n		&lt;label for=&quot;mce-EMAIL&quot;&gt;Sign up for our newsletter for exclusive updates on  new products, offers and more.&lt;/label&gt;\r\n		&lt;input type=&quot;email&quot; value=&quot;&quot; name=&quot;EMAIL&quot; class=&quot;email form-control&quot; id=&quot;mce-EMAIL&quot; placeholder=&quot;email address&quot; required&gt;\r\n		&lt;!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups--&gt;\r\n		&lt;div style=&quot;position: absolute; left: -5000px;&quot; aria-hidden=&quot;true&quot;&gt;&lt;input type=&quot;text&quot; name=&quot;b_aec0ecc511b9e4dec6925a777_be77ff1fb8&quot; tabindex=&quot;-1&quot; value=&quot;&quot;&gt;&lt;/div&gt;\r\n		&lt;div class=&quot;clear&quot;&gt;&lt;button type=&quot;submit&quot; class=&quot;submit_btn&quot;&gt;Sign Up&lt;/button&gt;&lt;/div&gt;\r\n	&lt;/form&gt;\r\n	&lt;/div&gt;\r\n	&lt;!--End mc_embed_signup--&gt;\r\n&lt;/div&gt;'),
(28, 0, 'display_newsletter_popup', '1'),
(29, 0, 'google_map', '&lt;iframe id=&quot;mapBox&quot; src=&quot;https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2201.3258493677126!2d-74.01291322172017!3d40.70657451080482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1492962272380&quot;&gt;&lt;/iframe&gt;'),
(30, 0, 'google_site_key', ''),
(31, 0, 'google_secret_key', ''),
(32, 0, 'display_promo_topbar', '1'),
(33, 1, 'promo_topbar_content', 'Welcome to Worldwide Online marketplace Store'),
(34, 2, 'promo_topbar_content', '20% STUDENT DISCOUNT PLUS FREE NEXT DAY DELIVEY, EXCLUDES SALE.'),
(35, 3, 'promo_topbar_content', '20% STUDENT DISCOUNT PLUS FREE NEXT DAY DELIVEY, EXCLUDES SALE.'),
(36, 4, 'promo_topbar_content', '20% STUDENT DISCOUNT PLUS FREE NEXT DAY DELIVEY, EXCLUDES SALE.'),
(37, 0, 'header_store_contact', '+777 2345 7885'),
(38, 0, 'header_store_time', 'From 8:00 to 21:00 (Mon-Sun) Free by United States'),
(39, 1, 'topbar_shipping_content', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-93&quot;&gt;&lt;/i&gt;&lt;a href=&quot;tel:+77723457885&quot;&gt;+777 2345 7885&lt;/a&gt;; &lt;a href=&quot;tel:+77723457886&quot;&gt;+777 2345 7886&lt;/a&gt;&lt;/li&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-92&quot;&gt;&lt;/i&gt;7 DAYS A WEEK FROM 10 AM TO 6 PM &lt;/li&gt;\r\n&lt;/ul&gt;'),
(40, 2, 'topbar_shipping_content', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-93&quot;&gt;&lt;/i&gt;&lt;a href=&quot;tel:+77723457885&quot;&gt;+777 2345 7885&lt;/a&gt;; &lt;a href=&quot;tel:+77723457886&quot;&gt;+777 2345 7886&lt;/a&gt;&lt;/li&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-92&quot;&gt;&lt;/i&gt;7 DAYS A WEEK FROM 10 AM TO 6 PM &lt;/li&gt;\r\n&lt;/ul&gt;'),
(41, 3, 'topbar_shipping_content', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-93&quot;&gt;&lt;/i&gt;&lt;a href=&quot;tel:+77723457885&quot;&gt;+777 2345 7885&lt;/a&gt;; &lt;a href=&quot;tel:+77723457886&quot;&gt;+777 2345 7886&lt;/a&gt;&lt;/li&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-92&quot;&gt;&lt;/i&gt;7 DAYS A WEEK FROM 10 AM TO 6 PM &lt;/li&gt;\r\n&lt;/ul&gt;'),
(42, 4, 'topbar_shipping_content', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-93&quot;&gt;&lt;/i&gt;&lt;a href=&quot;tel:+77723457885&quot;&gt;+777 2345 7885&lt;/a&gt;; &lt;a href=&quot;tel:+77723457886&quot;&gt;+777 2345 7886&lt;/a&gt;&lt;/li&gt;\r\n	&lt;li&gt;&lt;i class=&quot;icon-f-92&quot;&gt;&lt;/i&gt;7 DAYS A WEEK FROM 10 AM TO 6 PM &lt;/li&gt;\r\n&lt;/ul&gt;'),
(43, 0, 'file_logo', 'logo_1674716411.png'),
(44, 0, 'file_favicon', 'favicon_1674716501.png'),
(45, 0, 'footer_layout', 'footer_v1'),
(46, 0, 'store_copyright', '© Neoncart 2023. All Rights Reserved'),
(47, 1, 'store_description', '&lt;p&gt;&lt;strong&gt;Neoncart&lt;/strong&gt; is a premium Templates theme with advanced admin module. It’s extremely customizable, easy to use and fully responsive and retina ready.&lt;/p&gt;'),
(48, 2, 'store_description', '&lt;p&gt;&lt;strong&gt;Neoncart&lt;/strong&gt; is a premium Templates theme with advanced admin module. It’s extremely customizable, easy to use and fully responsive and retina ready.&lt;/p&gt;'),
(49, 3, 'store_description', '&lt;p&gt;&lt;strong&gt;Neoncart&lt;/strong&gt; is a premium Templates theme with advanced admin module. It’s extremely customizable, easy to use and fully responsive and retina ready.&lt;/p&gt;'),
(50, 4, 'store_description', '&lt;p&gt;&lt;strong&gt;Neoncart&lt;/strong&gt; is a premium Templates theme with advanced admin module. It’s extremely customizable, easy to use and fully responsive and retina ready.&lt;/p&gt;'),
(51, 1, 'store_address', '2548 Broaddus Maple Court Avenue, Madisonville KY 4783, United States of America'),
(52, 2, 'store_address', '2548 Broaddus Maple Court Avenue, Madisonville KY 4783, United States of America'),
(53, 3, 'store_address', '2548 Broaddus Maple Court Avenue, Madisonville KY 4783, United States of America'),
(54, 4, 'store_address', '2548 Broaddus Maple Court Avenue, Madisonville KY 4783, United States of America'),
(55, 0, 'store_contact', '+84 3333 6789'),
(56, 0, 'store_fax', '84 3333 6789'),
(57, 0, 'store_skype', '84 3333 6789'),
(58, 0, 'store_email', 'contact@domain.com'),
(59, 0, 'store_time', 'MON-FRI 9AM-8PM SAT 9AM-6PM'),
(60, 0, 'payment_image', 'payment_methods_1674718270.png'),
(61, 0, 'footer_logo', 'footer_logo_1674717791.png'),
(62, 0, 'menu_type', 'mega'),
(63, 0, 'display_in_hor_menu_160', '0'),
(64, 0, 'display_in_ver_menu_160', '1'),
(65, 0, 'menu_type_160', '1'),
(66, 0, 'badge_type_160', 'none'),
(67, 0, 'subcat_imgstatus_160', '0'),
(68, 0, 'megamenu_btype_160', 'none'),
(69, 0, 'mg_side_block_ban_160_link', ''),
(70, 0, 'megamenu_bottom_block_160', '0'),
(71, 0, 'mg_botban_cont_0_160_link', ''),
(72, 0, 'mg_botban_cont_1_160_link', ''),
(73, 0, 'display_in_hor_menu_114', '0'),
(74, 0, 'display_in_ver_menu_114', '1'),
(75, 0, 'menu_type_114', '1'),
(76, 0, 'badge_type_114', 'none'),
(77, 0, 'subcat_imgstatus_114', '0'),
(78, 0, 'megamenu_btype_114', 'none'),
(79, 0, 'mg_side_block_ban_114_link', ''),
(80, 0, 'megamenu_bottom_block_114', '0'),
(81, 0, 'mg_botban_cont_0_114_link', ''),
(82, 0, 'mg_botban_cont_1_114_link', ''),
(83, 0, 'display_in_hor_menu_159', '0'),
(84, 0, 'display_in_ver_menu_159', '1'),
(85, 0, 'menu_type_159', '1'),
(86, 0, 'badge_type_159', 'none'),
(87, 0, 'subcat_imgstatus_159', '0'),
(88, 0, 'megamenu_btype_159', 'none'),
(89, 0, 'mg_side_block_ban_159_link', ''),
(90, 0, 'megamenu_bottom_block_159', '0'),
(91, 0, 'mg_botban_cont_0_159_link', ''),
(92, 0, 'mg_botban_cont_1_159_link', ''),
(93, 0, 'display_in_hor_menu_158', '0'),
(94, 0, 'display_in_ver_menu_158', '1'),
(95, 0, 'menu_type_158', '1'),
(96, 0, 'badge_type_158', 'none'),
(97, 0, 'subcat_imgstatus_158', '0'),
(98, 0, 'megamenu_btype_158', 'none'),
(99, 0, 'mg_side_block_ban_158_link', ''),
(100, 0, 'megamenu_bottom_block_158', '0'),
(101, 0, 'mg_botban_cont_0_158_link', ''),
(102, 0, 'mg_botban_cont_1_158_link', ''),
(103, 0, 'display_in_hor_menu_111', '0'),
(104, 0, 'display_in_ver_menu_111', '1'),
(105, 0, 'menu_type_111', '1'),
(106, 0, 'badge_type_111', 'none'),
(107, 0, 'subcat_imgstatus_111', '0'),
(108, 0, 'megamenu_btype_111', 'none'),
(109, 0, 'mg_side_block_ban_111_link', ''),
(110, 0, 'megamenu_bottom_block_111', '0'),
(111, 0, 'mg_botban_cont_0_111_link', ''),
(112, 0, 'mg_botban_cont_1_111_link', ''),
(113, 0, 'display_in_hor_menu_112', '0'),
(114, 0, 'display_in_ver_menu_112', '1'),
(115, 0, 'menu_type_112', '1'),
(116, 0, 'badge_type_112', 'none'),
(117, 0, 'subcat_imgstatus_112', '0'),
(118, 0, 'megamenu_btype_112', 'none'),
(119, 0, 'mg_side_block_ban_112_link', ''),
(120, 0, 'megamenu_bottom_block_112', '0'),
(121, 0, 'mg_botban_cont_0_112_link', ''),
(122, 0, 'mg_botban_cont_1_112_link', ''),
(123, 0, 'display_in_hor_menu_110', '1'),
(124, 0, 'display_in_ver_menu_110', '1'),
(125, 0, 'menu_type_110', '1'),
(126, 0, 'badge_type_110', 'none'),
(127, 0, 'subcat_imgstatus_110', '0'),
(128, 0, 'megamenu_btype_110', 'special'),
(129, 0, 'mg_side_block_ban_110_link', ''),
(130, 0, 'megamenu_bottom_block_110', '1'),
(131, 0, 'mg_botban_cont_0_110_link', '#'),
(132, 0, 'mg_botban_cont_1_110_link', '#'),
(133, 0, 'display_in_hor_menu_141', '1'),
(134, 0, 'display_in_ver_menu_141', '1'),
(135, 0, 'menu_type_141', '1'),
(136, 0, 'badge_type_141', 'none'),
(137, 0, 'subcat_imgstatus_141', '1'),
(138, 0, 'megamenu_btype_141', 'banner'),
(139, 0, 'mg_side_block_ban_141_link', '#'),
(140, 0, 'megamenu_bottom_block_141', '0'),
(141, 0, 'mg_botban_cont_0_141_link', ''),
(142, 0, 'mg_botban_cont_1_141_link', ''),
(143, 0, 'mg_botban_cont_0_110_img', 'megamenu_bot_banner_1_1627150975.png'),
(144, 0, 'mg_botban_cont_1_110_img', 'megamenu_bot_banner_2_1627150975.png'),
(145, 0, 'mg_side_block_ban_141_img', 'megamenu_sideblock_banner_1627151008.jpg'),
(146, 0, 'prodlist_page_layout', '2columns-left'),
(147, 0, 'prodgrid_col_lg', '4'),
(148, 0, 'prodgrid_col_md', '3'),
(149, 0, 'prodgrid_col_sm', '2'),
(150, 0, 'prodgrid_col_xs', '2'),
(151, 0, 'prod_grid_addtionalimg_style', 'default'),
(152, 0, 'prod_grid_imghover_style', 'fade'),
(153, 0, 'display_prod_grid_rattings', '1'),
(154, 0, 'display_prod_grid_price', '1'),
(155, 0, 'display_prod_grid_addtocart', '1'),
(156, 0, 'display_prod_grid_quickview', '1'),
(157, 0, 'display_prod_grid_wishlist', '0'),
(158, 0, 'display_prod_grid_compare', '1'),
(159, 0, 'display_prod_grid_salelabel', '1'),
(160, 0, 'display_prod_grid_newlabel', '1'),
(161, 0, 'cat_page_layout', '2columns-left'),
(162, 0, 'cat_grid_style', '1'),
(163, 0, 'catgrid_col_lg', '4'),
(164, 0, 'catgrid_col_md', '3'),
(165, 0, 'catgrid_col_sm', '2'),
(166, 0, 'catgrid_col_xs', '2'),
(167, 0, 'catslide_col_lg', '3'),
(168, 0, 'catslide_col_md', '3'),
(169, 0, 'catslide_col_sm', '2'),
(170, 0, 'catslide_col_xs', '2'),
(171, 0, 'prodinfo_page_layout', '1column'),
(172, 0, 'prod_img_layout', 'medium'),
(173, 0, 'prod_tab_style', '2'),
(174, 0, 'prodinfo_image_effects', 'elevatezoom'),
(175, 0, 'ezplus_style', 'classic'),
(176, 0, 'display_prod_short_desc', '1'),
(177, 0, 'display_prod_pinfo_rattings', '1'),
(178, 0, 'display_prod_pinfo_price', '1'),
(179, 0, 'display_prod_pinfo_addtocart', '1'),
(180, 0, 'display_prod_pinfo_quickview', '1'),
(181, 0, 'display_prod_pinfo_wishlist', '0'),
(182, 0, 'display_prod_pinfo_compare', '1'),
(183, 0, 'display_prod_pinfo_salelabel', '1'),
(184, 0, 'display_prod_pinfo_newlabel', '1'),
(185, 0, 'prodinfo_col_lg', '5'),
(186, 0, 'prodinfo_col_md', '4'),
(187, 0, 'prodinfo_col_sm', '2'),
(188, 0, 'prodinfo_col_xs', '2'),
(189, 0, 'elevatezoom_style', 'default'),
(190, 0, 'product_info_tab_style', 'collapsible-tab'),
(191, 0, 'collapsible_tabs_show_in', 'default'),
(192, 0, 'prod_slider_col_lg', '4'),
(193, 0, 'prod_slider_col_md', '3'),
(194, 0, 'prod_slider_col_sm', '2'),
(195, 0, 'prod_slider_col_xs', '2'),
(196, 0, 'megamenu_show_columns_160', '3'),
(197, 0, 'megamenu_show_columns_114', '3'),
(198, 0, 'megamenu_show_columns_159', '3'),
(199, 0, 'megamenu_show_columns_158', '3'),
(200, 0, 'megamenu_show_columns_111', '3'),
(201, 0, 'megamenu_show_columns_112', '3'),
(202, 0, 'megamenu_show_columns_110', '3'),
(203, 0, 'megamenu_show_columns_141', '3'),
(204, 0, 'general_page_layout_mode', 'boxed'),
(205, 0, 'header_style', 'tpl_header_v1'),
(206, 0, 'display_prod_grid_model', '1'),
(207, 0, 'display_prod_info_model', '1'),
(208, 0, 'display_prod_slider_model', '1'),
(209, 0, 'header_store_email', 'Support@domain.com'),
(210, 0, 'container_width', '1480px'),
(211, 0, 'heading_font_family', 'Oswald'),
(212, 0, 'catgrid_col_xxl', '4'),
(213, 0, 'catgrid_col_xl', '4'),
(214, 0, 'catslide_col_xxl', '4'),
(215, 0, 'catslide_col_xl', '4'),
(216, 0, 'prodgrid_col_xxl', '4'),
(217, 0, 'prodgrid_col_xl', '4'),
(218, 0, 'prodinfo_col_xxl', '4'),
(219, 0, 'prodinfo_col_xl', '4'),
(220, 0, 'new_lbl_color', '#cc1414'),
(221, 0, 'sale_lbl_color', '#0062bd'),
(222, 0, 'ban_heading_font_family', 'Poppins'),
(223, 0, 'prod_slider_col_xxl', '4'),
(224, 0, 'prod_slider_col_xl', '4');

UPDATE template_select set template_dir='neoncart';

INSERT IGNORE INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single ) VALUES
('neoncart', 'wt_sidebar_megamenu.php', 1, 0, 0, 0, 0),
('neoncart', 'wt_categories.php', 1, 0, 1, 0, 0),
('neoncart', 'specials.php', 1, 0, 3, 0, 0),
('neoncart', 'search.php', 1, 0, 4, 0, 0),
('neoncart', 'wishlist.php', 1, 0, 5, 0, 0),
('neoncart', 'manufacturers.php', 1, 0, 6, 0, 0),
('neoncart', 'currencies.php', 1, 0, 7, 0, 0),
('neoncart', 'best_sellers.php', 1, 1, 1, 0, 0),
('neoncart', 'news_box_sidebox.php', 1, 1, 2, 0, 0),
('neoncart', 'whats_new.php', 1, 1, 5, 0, 0),
('neoncart', 'featured.php', 1, 1, 6, 0, 0),
('neoncart', 'testimonials_manager.php', 1, 1, 7, 0, 0),
('neoncart', 'reviews.php', 1, 0, 2, 0, 0);


UPDATE configuration set configuration_value='false' where configuration_key='SHOW_COUNTS';
UPDATE configuration set configuration_value='12' where configuration_key='MAX_DISPLAY_SPECIAL_PRODUCTS';
UPDATE configuration set configuration_value='8' where configuration_key='MAX_DISPLAY_NEW_PRODUCTS';
UPDATE configuration set configuration_value='8' where configuration_key='MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX';
UPDATE configuration set configuration_value='8' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED';
UPDATE configuration set configuration_value='5' where configuration_key='MAX_DISPLAY_NEW_REVIEWS';
UPDATE configuration set configuration_value='4' where configuration_key='MAX_RANDOM_SELECT_REVIEWS';
UPDATE configuration set configuration_value='4' where configuration_key='MAX_RANDOM_SELECT_NEW';
UPDATE configuration set configuration_value='4' where configuration_key='MAX_RANDOM_SELECT_FEATURED_PRODUCTS';
UPDATE configuration set configuration_value='4' where configuration_key='MAX_RANDOM_SELECT_SPECIALS';
UPDATE configuration set configuration_value='12' where configuration_key='MAX_DISPLAY_PRODUCTS_NEW';
UPDATE configuration set configuration_value='12' where configuration_key='MAX_DISPLAY_RESULTS_CATEGORIES';
UPDATE configuration set configuration_value='12' where configuration_key='MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS';
UPDATE configuration set configuration_value='12' where configuration_key='MAX_DISPLAY_PRODUCTS_ALL';
UPDATE configuration set configuration_value='7' where configuration_key='MAX_DISPLAY_BESTSELLERS';
UPDATE configuration set configuration_value='4' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS';
UPDATE configuration set configuration_value='4' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS';
UPDATE configuration set configuration_value='4' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS';

UPDATE configuration set configuration_value='112' where configuration_key='SMALL_IMAGE_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='SMALL_IMAGE_HEIGHT';
UPDATE configuration set configuration_value='' where configuration_key='SUBCATEGORY_IMAGE_WIDTH';
UPDATE configuration set configuration_value='' where configuration_key='SUBCATEGORY_IMAGE_HEIGHT';
UPDATE configuration set configuration_value='' where configuration_key='CATEGORY_ICON_IMAGE_WIDTH';
UPDATE configuration set configuration_value='' where configuration_key='CATEGORY_ICON_IMAGE_HEIGHT';
UPDATE configuration set configuration_value='' where configuration_key='IMAGE_SHOPPING_CART_WIDTH';
UPDATE configuration set configuration_value='250' where configuration_key='IMAGE_SHOPPING_CART_HEIGHT';
UPDATE configuration set configuration_value='true' where configuration_key='CONFIG_CALCULATE_IMAGE_SIZE';
UPDATE configuration set configuration_value='' where configuration_key='SUBCATEGORY_IMAGE_TOP_WIDTH';
UPDATE configuration set configuration_value='' where configuration_key='SUBCATEGORY_IMAGE_TOP_HEIGHT';
UPDATE configuration set configuration_value='450' where configuration_key='MEDIUM_IMAGE_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='MEDIUM_IMAGE_HEIGHT';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_PRODUCT_LISTING_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_PRODUCT_LISTING_HEIGHT';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_PRODUCT_NEW_LISTING_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_PRODUCT_NEW_LISTING_HEIGHT';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_PRODUCT_NEW_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_PRODUCT_NEW_HEIGHT';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_PRODUCT_ALL_LISTING_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_PRODUCT_ALL_LISTING_HEIGHT';
UPDATE configuration set configuration_value='1' where configuration_key='PROPORTIONAL_IMAGES_STATUS';

UPDATE configuration set configuration_value='1' where configuration_key='PRODUCT_LIST_IMAGE';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_LIST_MANUFACTURER';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_LIST_MODEL';
UPDATE configuration set configuration_value='2' where configuration_key='PRODUCT_LIST_NAME';
UPDATE configuration set configuration_value='3' where configuration_key='PRODUCT_LIST_PRICE';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_LIST_QUANTITY';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_LIST_WEIGHT';
UPDATE configuration set configuration_value='2' where configuration_key='PREV_NEXT_BAR_LOCATION';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration set configuration_value='' where configuration_key='SHOW_BANNERS_GROUP_SET6';
UPDATE configuration set configuration_value='' where configuration_key='BOX_WIDTH_lEFT';
UPDATE configuration set configuration_value='' where configuration_key='BOX_WIDTH_RIGHT';

UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration set configuration_value='0' where configuration_key='PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART';

UPDATE configuration set configuration_value='0' where configuration_key='SHOW_PRODUCT_INFO_CATEGORY_BEST_SELLERS';
UPDATE configuration set configuration_value='0' where configuration_key='SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS';
UPDATE configuration set configuration_value='0' where configuration_key='SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS';
UPDATE configuration set configuration_value='1' where configuration_key='SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS';

UPDATE configuration set configuration_value='false' where configuration_title='Add period prefix to cookie domain';

UPDATE configuration set configuration_value='yes' where configuration_key='IH_RESIZE';

UPDATE configuration set configuration_value='false' where configuration_key='ACCOUNT_COMPANY';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_GENDER';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_DOB';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_SUBURB';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_STATE';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN';
UPDATE configuration set configuration_value='true' where configuration_key='ACCOUNT_FAX_NUMBER';

UPDATE configuration set configuration_value='true' where configuration_key='DISPLAY_CONDITIONS_ON_CHECKOUT';
UPDATE configuration set configuration_value='true' where configuration_key='DISPLAY_PRIVACY_CONDITIONS';

UPDATE configuration set configuration_value='6' where configuration_key='SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS';
UPDATE configuration set configuration_value='1' where configuration_key='PRODUCT_INFO_PREVIOUS_NEXT';

UPDATE configuration set configuration_value='' where configuration_key='BREAD_CRUMBS_SEPARATOR';
UPDATE configuration set configuration_value='1' where configuration_key='DEFINE_BREADCRUMB_STATUS';
UPDATE configuration set configuration_value='false' where configuration_key='SHOW_CATEGORIES_BOX_SPECIALS';
UPDATE configuration set configuration_value='false' where configuration_key='SHOW_CATEGORIES_BOX_PRODUCTS_NEW';
UPDATE configuration set configuration_value='false' where configuration_key='SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS';
UPDATE configuration set configuration_value='false' where configuration_key='SHOW_CATEGORIES_BOX_PRODUCTS_ALL';
UPDATE configuration set configuration_value='1' where configuration_key='SHOW_CUSTOMER_GREETING';
UPDATE configuration set configuration_value='&nbsp;-' where configuration_title='Categories Separator between the Category Name and Count' and configuration_key='CATEGORIES_SEPARATOR';
UPDATE configuration set configuration_value='<i class="fa fa-angle-right"></i>' where configuration_title='Categories Separator between the Category Name and Sub Categories';
UPDATE configuration set configuration_value='yes' where configuration_title='CSS Buttons';
UPDATE configuration set configuration_value='True' where configuration_key='USE_SPLIT_LOGIN_MODE';
UPDATE configuration set configuration_value='false' where configuration_key='DISPLAY_CART';

UPDATE configuration set configuration_value='2' where configuration_key='SHOW_SHIPPING_ESTIMATOR_BUTTON';

UPDATE configuration set configuration_value='0' where configuration_key='DEFINE_MAIN_PAGE_STATUS';

UPDATE configuration set configuration_value='3' where configuration_key='SHOW_PRODUCT_INFO_MAIN_BEST_SELLERS';
UPDATE configuration set configuration_value='9' where configuration_key='MAX_DISPLAY_SEARCH_RESULTS_BEST_SELLERS';
UPDATE configuration set configuration_value='185' where configuration_key='IMAGE_BEST_SELLERS_LISTING_WIDTH';
UPDATE configuration set configuration_value='0' where configuration_key='IMAGE_BEST_SELLERS_LISTING_HEIGHT';

UPDATE configuration set configuration_value='' where configuration_key='USU_FILTER_PAGES';

UPDATE configuration set configuration_value='true' where configuration_key='DPU_STATUS';

UPDATE configuration set configuration_value='4' where configuration_key='NEWS_BOX_SHOW_CENTERBOX';
UPDATE configuration set configuration_value='4' where configuration_key='NEWS_BOX_SHOW_NEWS';
UPDATE configuration set configuration_value='130' where configuration_key='NEWS_BOX_CONTENT_LENGTH_CENTERBOX';

UPDATE configuration set configuration_value='130' where configuration_key='DEFINE_TESTIMONIAL_STATUS';
UPDATE configuration set configuration_value='185' where configuration_key='TESTIMONIAL_IMAGE_WIDTH';
UPDATE configuration set configuration_value='auto' where configuration_key='TESTIMONIAL_IMAGE_HEIGHT';

UPDATE configuration set configuration_value='0' where configuration_key='SHOW_FOOTER_IP';

delete from configuration where configuration_key in ('PRODUCT_LISTING_LAYOUT_STYLE');
delete from configuration where configuration_key in ('PRODUCT_LISTING_COLUMNS_PER_ROW');
delete from configuration where configuration_key in ('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER');
delete from configuration where configuration_key in ('PRODUCT_LISTING_GRID_SORT');

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Layout Style', 'PRODUCT_LISTING_LAYOUT_STYLE', 'columns', 'Select the layout style:&lt;br /&gt;Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)&lt;br /&gt; If customer control is enabled this sets the default style.', '8', '41', NULL, now(), NULL, 'zen_cfg_select_option(array(\'rows\', \'columns\'),');

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 'Select the number of columns of products to show in each row in the product listing. The default setting is 3.', '8', '42', NULL, now(), NULL, NULL);

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Layout Style - Customer Control', 'PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER', '1', 'Allow the customer to select the layout style (0=no, 1=yes):', '8', '43', NULL, now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Show Sorter for Columns Layout', 'PRODUCT_LISTING_GRID_SORT', '1', 'Allow the customer to select the item sort order (0=no, 1=yes):', '8', '44', NULL, now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');


INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Show Languages in Header?', 'HEADER_LANGUAGES_DISPLAY', 'True', 'Display the Languages flags/links in Header?', 19, 170, NULL, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Show Currencies in Header?', 'HEADER_CURRENCIES_DISPLAY', 'True', 'Display the Currencies symbols/links in Header?', 19, 171, NULL, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Max Products to Compare', 'COMPARE_VALUE_COUNT', '4', 'The number of products to compare at one time. Set 0 to disable.', '19', '300', now());

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Max Products to Compare', 'COMPARE_DESCRIPTION', '300', 'How many characters max to show of the products description.', '19', '151', now());

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Sidebar Banners Width', 'WT_SIDEBAR_BANNER_IMAGE_WIDTH', '291', 'Default = 291', 4, 44, now());
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Sidebar Banners Height', 'WT_SIDEBAR_BANNER_IMAGE_HEIGHT', '416', 'Default = 416', 4, 44, now());


#
#Tab products
#

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Tab Products Module', 'MAX_DISPLAY_TAB_PRODUCTS', '8', 'Number of tab products to display in a category', '3', '5', now());

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Tab Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_TAB_PRODUCTS', '3', 'Tab Products Columns per Row', '24', '95', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

#
#EOF Tab products
#

#
#TopRated products
#

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Top Rated Products Module', 'MAX_DISPLAY_TOP_RATED_PRODUCTS', '8', 'Number of top rated products to display in a category', '3', '5', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Top Rated Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_TOP_RATED_PRODUCTS', '3', 'Top Rated Products Columns per Row', '24', '95', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

#
#EOF TopRated products
#

#
#Megamenu Category
#

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Megamenu Category Width', 'WT_MEGAMENU_CATEGORY_IMAGE_WIDTH', '266', 'Default = 266', 4, 44, now());
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Megamenu Category Height', 'WT_MEGAMENU_CATEGORY_IMAGE_HEIGHT', '175', 'Default = 175', 4, 44, now());

#
# wishlist
#

SELECT @cid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Wish list';
DELETE FROM configuration WHERE configuration_group_id = @cid;
DELETE FROM configuration_group WHERE configuration_group_id = @cid;

INSERT IGNORE INTO configuration_group VALUES (NULL, 'Wish list', 'Settings for Wish list', '1', '1');


SET @cid=last_insert_id();
UPDATE configuration_group SET sort_order = @cid WHERE configuration_group_id = @cid;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist Module Switch', 'UN_DB_MODULE_WISHLISTS_ENABLED', 'true', 'Set this option true or false to enable or disable the wishlist', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist sidebox header link', 'UN_DB_SIDEBOX_LINK_HEADER', 'true', 'Set this option true or false to make the sidebox header a link to the wishlist page.', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist allow multiple lists', 'UN_DB_ALLOW_MULTIPLE_WISHLISTS', 'true', 'Set this option true or false to allow for more than 1 wishlist', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist display category filter', 'UN_DB_DISPLAY_CATEGORY_FILTER', 'true', 'Set this option true or false to enable a category filter', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist default name', 'DEFAULT_WISHLIST_NAME', 'Default', 'Enter the name you want to be assigned to the initial wishlist.', @cid, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist show list after product addition', 'DISPLAY_WISHLIST', 'true', 'Set this option true or false to show the wishlist after a product was added to the wishlist', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist display max items in extended view', 'UN_MAX_DISPLAY_EXTENDED', '10', 'Enter the maximum amount of products you want to show in extended view.<br />default = 10', @cid, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist display max items in compact view', 'UN_MAX_DISPLAY_COMPACT', '20', 'Enter the maximum amount of products you want to show in extended view.<br />default = 20', @cid, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist default view Switch', 'UN_DEFAULT_LIST_VIEW', 'extended', 'Set the default view of the list to compact or extended view', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'compact\', \'extended\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist allow multiple products to cart', 'UN_DB_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT', 'false', 'Set this option true or false to allow multiple products to be moved in the cart via checkboxes in compact view', @cid, NULL, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

DELETE FROM admin_pages WHERE page_key='configWishlist';
INSERT IGNORE INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES ('configWishlist','BOX_CONFIGURATION_WISH_LIST','FILENAME_CONFIGURATION',CONCAT('gID=',@cid), 'configuration', 'Y', @cid);


DROP TABLE IF EXISTS un_wishlists;
CREATE TABLE IF NOT EXISTS un_wishlists (
  id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  created datetime NOT NULL default '0001-01-01 00:00:00',
  modified datetime NOT NULL default '0001-01-01 00:00:00',
  name varchar(255) default NULL,
  comment varchar(255) default NULL,
  default_status tinyint(1) NOT NULL default '0',
  public_status tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (id)
);
INSERT IGNORE INTO un_wishlists VALUES (1, 0, now(), now(), 'donotuse', 'donotuse', 0, 0);


DROP TABLE IF EXISTS un_products_to_wishlists;
CREATE TABLE IF NOT EXISTS un_products_to_wishlists (
  products_id int(11) NOT NULL default '0',
  un_wishlists_id int(11) NOT NULL default '0',
  created datetime NOT NULL default '0001-01-01 00:00:00',
  modified datetime NOT NULL default '0001-01-01 00:00:00',
  quantity int(2) NOT NULL default '1',
  priority int(1) NOT NULL default '2',
  comment varchar(255) default NULL,
  attributes varchar(255) default NULL,
  PRIMARY KEY  (products_id,un_wishlists_id)
);

#
# manufacturers
#

DELETE FROM configuration_group WHERE configuration_group_title LIKE 'Manufacturers All Config' LIMIT 2;
DELETE FROM configuration WHERE configuration_description LIKE 'Manufacturers All Listing:%' LIMIT 7;

INSERT IGNORE INTO configuration_group (configuration_group_title ,configuration_group_description ,sort_order ,visible) VALUES ('Manufacturers All Config', 'Manufacturers All Config', '1', '1');

SELECT @gida:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Layout Settings'
LIMIT 1;

SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Manufacturers All Config'
LIMIT 1;

UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Categories Box - Show Manufacturers All Link', 'SHOW_CATEGORIES_BOX_MANUFACTURERS_ALL', '1', 'Manufacturers All Listing: Set this to 1 if you want to show the All Manufacturers link to show in the Categories Box.', @gid, '0', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),'),
('Display Empty Manufacturers', 'MANUFACTURERS_ALL_EMPTY_SHOW', '0', 'Manufacturers All Listing: Set this to 1 if you want manufacturers with no products to show on the list.', @gid, '7', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),'),
('Display Manufacturer Image', 'MANUFACTURERS_ALL_IMAGE_SHOW', '1', 'Manufacturers All Listing: Set this to 1 if you want the manufacturers logo to appear with the listing.', @gid, '7', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),'),
('Display Manufacturer URL', 'MANUFACTURERS_ALL_URL_SHOW', '0', 'Manufacturers All Listing: Set this to 1 if you want the manufacturers URL to appear with the listing.', @gid, '7', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),'),
('Manufacturers Per Row', 'MANUFACTURERS_ALL_COLUMNS', '3', 'Manufacturers All Listing: Set the number of manufacturers per row to display.<br>(default 4)', @gid, '7', now(), now(), NULL, NULL),
('Manufacturer Image Width', 'MANUFACTURERS_ALL_WIDTH', '175px', 'Manufacturers All Listing: Set the maximum width of the manufacturers image.<br>(default 100px)', @gid, '7', now(), now(), NULL, NULL),
('Manufacturer Image Height', 'MANUFACTURERS_ALL_HEIGHT', '0px', 'Manufacturers All Listing: Set the maximum height of the manufacturers image<br>(default 100px)', @gid, '7', now(), now(), NULL, NULL);

INSERT IGNORE INTO admin_pages (page_key ,language_key ,main_page ,page_params ,menu_key ,display_on_menu ,sort_order)VALUES 
('configManufacturersList', 'BOX_CONFIGURATION_MANUFACTURERS_LIST', 'FILENAME_CONFIGURATION', CONCAT('gID=',@gid), 'configuration', 'Y', @gid);

#
# news
#

CREATE TABLE IF NOT EXISTS box_news (
	box_news_id int(11) NOT NULL auto_increment,
	news_added_date datetime NOT NULL default '0001-01-01 00:00:00',
	news_modified_date datetime default NULL,
	news_start_date datetime default NULL,
	news_end_date datetime default NULL,
	news_status tinyint(1) default '0',
	news_content_type tinyint(1) NOT NULL default 0,
	PRIMARY KEY  (box_news_id)
);

ALTER TABLE box_news ADD news_image TEXT NOT NULL AFTER news_end_date;

INSERT IGNORE INTO box_news (box_news_id, news_added_date, news_modified_date, news_start_date, news_end_date, news_image, news_status, news_content_type) VALUES
(1, '2015-09-24 11:03:20', '2021-09-03 11:37:34', '2015-09-23 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-6.jpg', 1, 3),
(2, '2015-09-25 11:48:02', '2021-09-03 11:37:49', '2015-09-23 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-7.jpg', 1, 4),
(3, '2015-09-23 11:50:59', '2021-09-03 11:38:08', '2015-09-23 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-8.jpg', 1, 4),
(4, '2016-06-21 09:22:11', '2021-09-03 11:36:10', '2016-06-21 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-1.jpg', 1, 1),
(5, '2016-06-26 09:22:11', '2021-09-03 11:36:25', '2016-06-21 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-2.jpg', 1, 1),
(6, '2016-06-27 09:22:11', '2021-09-03 11:37:00', '2016-06-21 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-3.jpg', 1, 2),
(7, '2016-06-27 09:22:11', '2021-09-03 11:37:14', '2016-06-21 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-4.jpg', 1, 2),
(8, '2016-06-27 09:22:11', '2021-09-03 11:35:44', '2016-06-21 00:00:00', '2025-09-23 23:59:59', 'news/blog-img-5.jpg', 1, 3);



CREATE TABLE IF NOT EXISTS box_news_content (
	box_news_id int(11) NOT NULL default '0',
	languages_id int(11) NOT NULL default '1',
	news_title varchar(255) NOT NULL default '',
	news_content text NOT NULL,
	news_metatags_title varchar(255) NOT NULL default '',
	news_metatags_keywords text,
	news_metatags_description text,
	PRIMARY KEY  (languages_id,box_news_id)
);


INSERT IGNORE INTO box_news_content (box_news_id, languages_id, news_title, news_content, news_metatags_title, news_metatags_keywords, news_metatags_description) VALUES
(1, 1, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(2, 1, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(3, 1, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(4, 1, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', 'dolore magna aliqua', 'News Category', NULL),
(5, 1, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(6, 1, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(7, 1, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(8, 1, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(1, 2, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(2, 2, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(3, 2, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(4, 2, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', 'dolore magna aliqua', 'News Category', NULL),
(5, 2, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(6, 2, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(7, 2, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(8, 2, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(1, 3, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(2, 3, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(3, 3, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(4, 3, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', 'dolore magna aliqua', 'News Category', NULL),
(5, 3, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(6, 3, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(7, 3, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(8, 3, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(1, 4, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(2, 4, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(3, 4, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(4, 4, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', 'dolore magna aliqua', 'News Category', NULL),
(5, 4, 'The standard Lorem', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(6, 4, 'Lorem ipsum dolor', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(7, 4, 'Section of de Finibus', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL),
(8, 4, 'dolore magna aliqua', '<h2 class=\"tt-title\">Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>\r\n\r\n<p><em> Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</em></p>\r\n\r\n<blockquote class=\"tt-blockquote\">\r\n<i class=\"tt-icon icon-g-56\"></i> <span class=\"tt-title\">War and Marketing Have Many Similarities</span> <span class=\"tt-title-description\">— <span>DANIEL BROWN</span> </span>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>', '', NULL, NULL);

#
# testimonials
#

CREATE TABLE IF NOT EXISTS testimonials_manager (
  testimonials_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  testimonials_title varchar(64) NOT NULL default '',
  testimonials_url  VARCHAR( 255 ) NULL DEFAULT NULL,
  testimonials_name text NOT NULL,
  testimonials_image varchar(254) NOT NULL default '',
  testimonials_html_text text,
  testimonials_mail text NOT NULL,
  testimonials_company VARCHAR( 255 ) NULL DEFAULT NULL,
  testimonials_city VARCHAR( 255 ) NULL DEFAULT NULL,
  testimonials_country VARCHAR( 255 ) NULL DEFAULT NULL,
  testimonials_show_email char(1) default '0',
  status int(1) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  last_update datetime NULL default NULL,
  PRIMARY KEY  (testimonials_id)
);

INSERT IGNORE INTO testimonials_manager (testimonials_id, language_id, testimonials_title, testimonials_url, testimonials_name, testimonials_image, testimonials_html_text, testimonials_mail, testimonials_company, testimonials_city, testimonials_country, testimonials_show_email, status, date_added, last_update) VALUES
(1, 1, 'Customer Support', 'http://', 'PhaytalError', 'testimonials/img-person-01.jpg', 'A very high quality Zen Cart template with many options and customizability. Highly recommended and well worth the money! Customer service is nothing short of amazing with responses with-in hours, and bugs often fixed within hours. Keep up the great work!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2036-12-15 00:00:00', '2016-06-18 08:24:54'),
(2, 1, 'Design Quality', 'http://', 'Wang', 'testimonials/img-person-02.jpg', 'This is the second time i bought from them, always good, nice design and features, very easy to use. I have to say their customer service is the best, always reply and solve the problems quickly.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-08-20 00:00:00', '2016-06-18 08:25:07'),
(3, 1, 'Design Quality', 'http://', 'MoeyBell', 'testimonials/img-person-03.jpg', 'This template is great. WT Tech. Design. also has fabulous support and they have helped me to get the website perfect. Thank you :D', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-07-20 00:00:00', '2016-06-18 08:25:20'),
(4, 1, 'Customer Support', 'http://', 'Jason', 'testimonials/img-person-04.jpg', 'Not like any service i have ever experienced with any other template purchase. AWESOME team to work with. Forget the rest as this is also the easiest template I have ever worked set up. Well done it is WT Tech. Design. Jason Van Kuijk Skin Revival 5+yrs Ecommerce Over $5m in online sales 15,000 zencart orders', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-06-20 00:00:00', '2016-06-18 08:25:37'),
(5, 1, 'Customer Support', 'http://', 'Kimtownsend', 'testimonials/img-person-05.jpg', 'I\'ve purchased many themes throughout the years and I\'ve never had customer service like this. Stellar! AMAZING!! I cannot stay enough positive things about this company/author. Thank you!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:48'),
(6, 1, 'Design Quality', 'http://', 'Emendy', 'testimonials/img-person-06.jpg', 'Thank you so much for a clean, effective and excellent Zen Cart Template. The template is easy to use and very customizable. The support form the author for this template is fantastic and they will go out of their way to help making the template work 100% as well as small customizations related to the template itself.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:59'),
(7, 2, 'Customer Support', 'http://', 'PhaytalError', 'testimonials/img-person-01.jpg', 'A very high quality Zen Cart template with many options and customizability. Highly recommended and well worth the money! Customer service is nothing short of amazing with responses with-in hours, and bugs often fixed within hours. Keep up the great work!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2036-12-15 00:00:00', '2016-06-18 08:24:54'),
(8, 2, 'Design Quality', 'http://', 'Wang', 'testimonials/img-person-02.jpg', 'This is the second time i bought from them, always good, nice design and features, very easy to use. I have to say their customer service is the best, always reply and solve the problems quickly.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-08-20 00:00:00', '2016-06-18 08:25:07'),
(9, 2, 'Design Quality', 'http://', 'MoeyBell', 'testimonials/img-person-03.jpg', 'This template is great. WT Tech. Design. also has fabulous support and they have helped me to get the website perfect. Thank you :D', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-07-20 00:00:00', '2016-06-18 08:25:20'),
(10, 2, 'Customer Support', 'http://', 'Jason', 'testimonials/img-person-04.jpg', 'Not like any service i have ever experienced with any other template purchase. AWESOME team to work with. Forget the rest as this is also the easiest template I have ever worked set up. Well done it is WT Tech. Design. Jason Van Kuijk Skin Revival 5+yrs Ecommerce Over $5m in online sales 15,000 zencart orders', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-06-20 00:00:00', '2016-06-18 08:25:37'),
(11, 2, 'Customer Support', 'http://', 'Kimtownsend', 'testimonials/img-person-05.jpg', 'I\'ve purchased many themes throughout the years and I\'ve never had customer service like this. Stellar! AMAZING!! I cannot stay enough positive things about this company/author. Thank you!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:48'),
(12, 2, 'Design Quality', 'http://', 'Emendy', 'testimonials/img-person-06.jpg', 'Thank you so much for a clean, effective and excellent Zen Cart Template. The template is easy to use and very customizable. The support form the author for this template is fantastic and they will go out of their way to help making the template work 100% as well as small customizations related to the template itself.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:59'),
(13, 3, 'Customer Support', 'http://', 'PhaytalError', 'testimonials/img-person-01.jpg', 'A very high quality Zen Cart template with many options and customizability. Highly recommended and well worth the money! Customer service is nothing short of amazing with responses with-in hours, and bugs often fixed within hours. Keep up the great work!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2036-12-15 00:00:00', '2016-06-18 08:24:54'),
(14, 3, 'Design Quality', 'http://', 'Wang', 'testimonials/img-person-02.jpg', 'This is the second time i bought from them, always good, nice design and features, very easy to use. I have to say their customer service is the best, always reply and solve the problems quickly.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-08-20 00:00:00', '2016-06-18 08:25:07'),
(15, 3, 'Design Quality', 'http://', 'MoeyBell', 'testimonials/img-person-03.jpg', 'This template is great. WT Tech. Design. also has fabulous support and they have helped me to get the website perfect. Thank you :D', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-07-20 00:00:00', '2016-06-18 08:25:20'),
(16, 3, 'Customer Support', 'http://', 'Jason', 'testimonials/img-person-04.jpg', 'Not like any service i have ever experienced with any other template purchase. AWESOME team to work with. Forget the rest as this is also the easiest template I have ever worked set up. Well done it is WT Tech. Design. Jason Van Kuijk Skin Revival 5+yrs Ecommerce Over $5m in online sales 15,000 zencart orders', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-06-20 00:00:00', '2016-06-18 08:25:37'),
(17, 3, 'Customer Support', 'http://', 'Kimtownsend', 'testimonials/img-person-05.jpg', 'I\'ve purchased many themes throughout the years and I\'ve never had customer service like this. Stellar! AMAZING!! I cannot stay enough positive things about this company/author. Thank you!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:48'),
(18, 3, 'Design Quality', 'http://', 'Emendy', 'testimonials/img-person-06.jpg', 'Thank you so much for a clean, effective and excellent Zen Cart Template. The template is easy to use and very customizable. The support form the author for this template is fantastic and they will go out of their way to help making the template work 100% as well as small customizations related to the template itself.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:59'),
(19, 4, 'Customer Support', 'http://', 'PhaytalError', 'testimonials/img-person-01.jpg', 'A very high quality Zen Cart template with many options and customizability. Highly recommended and well worth the money! Customer service is nothing short of amazing with responses with-in hours, and bugs often fixed within hours. Keep up the great work!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2036-12-15 00:00:00', '2016-06-18 08:24:54'),
(20, 4, 'Design Quality', 'http://', 'Wang', 'testimonials/img-person-02.jpg', 'This is the second time i bought from them, always good, nice design and features, very easy to use. I have to say their customer service is the best, always reply and solve the problems quickly.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-08-20 00:00:00', '2016-06-18 08:25:07'),
(21, 4, 'Design Quality', 'http://', 'MoeyBell', 'testimonials/img-person-03.jpg', 'This template is great. WT Tech. Design. also has fabulous support and they have helped me to get the website perfect. Thank you :D', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-07-20 00:00:00', '2016-06-18 08:25:20'),
(22, 4, 'Customer Support', 'http://', 'Jason', 'testimonials/img-person-04.jpg', 'Not like any service i have ever experienced with any other template purchase. AWESOME team to work with. Forget the rest as this is also the easiest template I have ever worked set up. Well done it is WT Tech. Design. Jason Van Kuijk Skin Revival 5+yrs Ecommerce Over $5m in online sales 15,000 zencart orders', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-06-20 00:00:00', '2016-06-18 08:25:37'),
(23, 4, 'Customer Support', 'http://', 'Kimtownsend', 'testimonials/img-person-05.jpg', 'I\'ve purchased many themes throughout the years and I\'ve never had customer service like this. Stellar! AMAZING!! I cannot stay enough positive things about this company/author. Thank you!', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:48'),
(24, 4, 'Design Quality', 'http://', 'Emendy', 'testimonials/img-person-06.jpg', 'Thank you so much for a clean, effective and excellent Zen Cart Template. The template is easy to use and very customizable. The support form the author for this template is fantastic and they will go out of their way to help making the template work 100% as well as small customizations related to the template itself.', 'contact.wtdesign@gmail.com', '', '', '', '0', 1, '2015-04-15 00:00:00', '2016-06-18 08:25:59');

#
# Structured Data - Install
#

#Install new constants
INSERT IGNORE INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
('Structured Data', 'Set Structured Data Options', '1', '1');

SET @configuration_group_id=last_insert_id();
UPDATE configuration_group SET sort_order = @configuration_group_id WHERE configuration_group_id = @configuration_group_id;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Enable Structured Data generation', 'PLUGIN_SDATA_ENABLE', 'false', 'Enable Structured Data processing code and display of markup groups? This is a global option.', @configuration_group_id, 1, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Schema markup', 'PLUGIN_SDATA_SCHEMA_ENABLE', 'false', 'Show Schema markup?<br />Shows JSON-LD blocks for Organisation and Breadcrumbs on all pages, Product on product pages.', @configuration_group_id, 2, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Facebook-Open Graph markup', 'PLUGIN_SDATA_FOG_ENABLE', 'false', 'Show Facebook-Open Graph markup?<br />Shows Facebook og tags on all pages with additional product-specific tags on product pages.', @configuration_group_id, 3, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Twitter Card markup', 'PLUGIN_SDATA_TWITTER_CARD_ENABLE', 'false', 'Show Twitter Card markup?<br />Shows on all pages.', @configuration_group_id, 4, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Facebook Application ID', 'PLUGIN_SDATA_FOG_APPID', '', 'Enter your Facebook application ID (<a href="http://developers.facebook.com/setup/" target="_blank">Get an application ID</a>).', @configuration_group_id, 5, NOW(), NULL, NULL),
('Facebook Admin ID (optional)', 'PLUGIN_SDATA_FOG_ADMINID', '', 'Enter the Admin ID(s) of the Facebook user(s) that administer your Facebook fan page separated by commas. <a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>.', @configuration_group_id, 6, NOW(), NULL, NULL),
('Facebook Page (optional)', 'PLUGIN_SDATA_FOG_PAGE', '', 'Enter the full url/link to your facebook page eg.:https://www.facebook.com/zencart/.', @configuration_group_id, 7, NOW(), NULL, NULL),
('Logo (Schema)', 'PLUGIN_SDATA_LOGO', '', 'Enter the full url to your logo image.', @configuration_group_id, 10, NOW(), NULL, NULL),
('Street Address (Schema/OG)', 'PLUGIN_SDATA_STREET_ADDRESS', '', 'Enter the business street address.', @configuration_group_id, 11, NOW(), NULL, NULL),
('City (Schema/OG)', 'PLUGIN_SDATA_LOCALITY', '', 'Enter the business town/city.', @configuration_group_id, 12, NOW(), NULL, NULL),
('State (Schema/OG)', 'PLUGIN_SDATA_REGION', '', 'Enter the business state/province.', @configuration_group_id, 13, NOW(), NULL, NULL),
('Postal Code (Schema/OG)', 'PLUGIN_SDATA_POSTALCODE', '', 'Enter the business postal code/zip', @configuration_group_id, 14, NOW(), NULL, NULL),
('Country (Schema/OG)', 'PLUGIN_SDATA_COUNTRYNAME', '', 'Enter the business country name or <a href="https://en.wikipedia.org/wiki/ISO_3166-1" target="_blank">2 letter ISO code</a>', @configuration_group_id, 15, NOW(), NULL, NULL),
('Email (Schema, optional)', 'PLUGIN_SDATA_EMAIL', '', 'Enter your customer service email address (lower case).', @configuration_group_id, 16, NOW(), NULL, NULL),
('Phone (Schema)', 'PLUGIN_SDATA_TELEPHONE', '', 'Enter the customer service phone number in international format eg.: +1-330-871-4357. Format (spaces/dashes) is not important.', @configuration_group_id, 17, NOW(), NULL, NULL),
('Fax (Schema, optional)', 'PLUGIN_SDATA_FAX', '', 'Enter the customer service fax number in international format eg.: +1-877-453-1304).', @configuration_group_id, 18, NOW(), NULL, NULL),
('Available Languages (Schema, optional)', 'PLUGIN_SDATA_AVAILABLE_LANGUAGE', '', 'Languages spoken (for Schema contact point). Enter the language\'s english name, separated by commas. If omitted, the language defaults to English.', @configuration_group_id, 19, NOW(), NULL, NULL),
('Locales (OG)', 'PLUGIN_SDATA_FOG_LOCALES', '', 'Enter a comma-separated list of the database language_id and equivalent locale for each defined language eg.: 1,en_GB,2,es_ES, etc. (no spaces).<br />Separate the urls with commas.', @configuration_group_id, 22, NOW(), NULL, NULL),
('Tax ID (Schema, optional)', 'PLUGIN_SDATA_TAXID', '', 'The Tax/Fiscal ID of the business (eg. the TIN in the US or the CIF/NIF in Spain).', @configuration_group_id, 20, NOW(), NULL, NULL),
('VAT Number (Schema, optional)', 'PLUGIN_SDATA_VATID', '', 'Value-added Tax ID of the business.', @configuration_group_id, 21, NOW(), NULL, NULL),
('Profile/Social Pages (Schema-sameAs, optional)', 'PLUGIN_SDATA_SAMEAS', '', 'Enter a list of urls to other (NOT Facebook, Twitter or Google Plus) profile or social pages related to your business (eg. Linked In, Dun & Bradstreet, Yelp etc.).<br />Separate the urls with commas.', @configuration_group_id, 22, NOW(), NULL, NULL),
('Product Shipping Area (Schema, optional)', 'PLUGIN_SDATA_ELIGIBLE_REGION', '', 'Area to which you ship products.<br >Use the ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, or the GeoShape for the geo-political region(s).', @configuration_group_id, 23, NOW(), NULL, NULL),
('Currency (Schema/OG)', 'PLUGIN_SDATA_PRICE_CURRRENCY', '', 'Enter the currency code of the product price eg.: EUR.', @configuration_group_id, 24, NOW(), NULL, NULL),
('Product Delivery Time when in stock (Schema)', 'PLUGIN_SDATA_DELIVERYLEADTIME', '', 'Enter the average days from order to delivery when product is in stock (eg.:2).', @configuration_group_id, 25, NOW(), NULL, NULL),
('Product Delivery Time when out of stock (Schema)', 'PLUGIN_SDATA_DELIVERYLEADTIME_OOS', '', 'Enter the average days from order to delivery when product is out of stock (eg.:7).', @configuration_group_id, 25, NOW(), NULL, NULL),
('Product Condition (Schema/OG)', 'PLUGIN_SDATA_FOG_PRODUCT_CONDITION', 'new', 'Choose your product\'s condition.', @configuration_group_id, 27, NOW(), NULL, 'zen_cfg_select_option(array(\'new\', \'used\', \'refurbished\'),'),
('Accepted Payment Methods (Schema)', 'PLUGIN_SDATA_ACCEPTED_PAYMENT_METHODS', 'ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, GoogleCheckout, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA', 'List/delete as aplicable the <a href="http://www.heppnetz.de/ontologies/goodrelations/v1#PaymentMethod" target="_blank">accepted payment methods</a>. eg. ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, GoogleCheckout, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA.', @configuration_group_id, 28, NOW(), NULL, NULL),
('Legal Name (Schema, optional)', 'PLUGIN_SDATA_LEGAL_NAME', '', 'The registered company name.', @configuration_group_id, 29, NOW(), NULL, NULL),
('Dun & Bradstreet DUNS number (Schema, optional)', 'PLUGIN_SDATA_DUNS', '', 'The Dun & Bradstreet DUNS number for identifying an organization or business person.', @configuration_group_id, 30, NOW(), NULL, NULL),
('Area Served (Schema-Customer Service, optional)', 'PLUGIN_SDATA_AREA_SERVED', '', 'The geographical region served (<a href="https://schema.org/areaServed" target="_blank">further details here</a>).<br />If omitted, the area is assumed to be global.)', @configuration_group_id, 31, NOW(), NULL, NULL),

('Facebook Default Image: Product (optional)', 'PLUGIN_SDATA_FOG_DEFAULT_PRODUCT_IMAGE', '', 'Fallback image used in Facebook when there is no product image. Enter the full url or leave blank to use the no-image file defined in the Admin->Images configuration.', @configuration_group_id, 35, NOW(), NULL, NULL),
('Facebook Default Image: non Product (optional)', 'PLUGIN_SDATA_FOG_DEFAULT_IMAGE', '', 'Fallback image used in Facebook when there is no image on any page other than a product page. Enter the full url or leave blank to use the logo file defined above.', @configuration_group_id, 36, NOW(), NULL, NULL),
('Facebook Type - Non Product Page', 'PLUGIN_SDATA_FOG_TYPE_SITE', 'business.business', 'Enter an Open Graph type for your site - non-product pages (<a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Types</a>)', @configuration_group_id, 37, NOW(), NULL, NULL),
('Facebook Type - Product Page', 'PLUGIN_SDATA_FOG_TYPE_PRODUCT', 'product', 'Enter an Open Graph type for your site - product pages (<a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Types</a>)', @configuration_group_id, 38, NOW(), NULL, NULL),
('Twitter Default Image (optional)', 'PLUGIN_SDATA_TWITTER_DEFAULT_IMAGE', '', 'Fallback image used in Twitter when there is no image defined. Enter the full url.', @configuration_group_id, 39, NOW(), NULL, NULL),
('Twitter Username', 'PLUGIN_SDATA_TWITTER_USERNAME', '', 'Enter your Twitter username (eg.: @zencart).', @configuration_group_id, 40, NOW(), NULL, NULL),
('Twitter Page URL', 'PLUGIN_SDATA_TWITTER_PAGE', '', 'Enter the full url to your Twitter page (eg.: https://twitter.com/zencart)', @configuration_group_id, 41, NOW(), NULL, NULL),
('Google Publisher', 'PLUGIN_SDATA_GOOGLE_PUBLISHER', '', 'Enter your Google Publisher url/link (eg.: https://plus.google.com/+Pro-websNet/). Link does not display if field empty.', @configuration_group_id, 42, NOW(), NULL, NULL);

# Register the configuration page for Admin Access Control
INSERT IGNORE INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES ('configStructuredData','BOX_CONFIGURATION_STRUCTURED_DATA','FILENAME_CONFIGURATION',CONCAT('gID=',@configuration_group_id),'configuration','Y',@configuration_group_id);

ALTER TABLE products ADD COLUMN products_related VARCHAR(50);