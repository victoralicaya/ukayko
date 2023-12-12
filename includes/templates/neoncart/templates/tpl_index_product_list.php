<?php
/**
 * Page Template
 *
 * Loaded by main_page=index
 * Displays product-listing when a particular category/subcategory is selected for browsing
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 29 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="indexProductList">
<div id="cat-top" class="group cat-top">
	<div class="category-wrapper">
		<div class="page-title text-left">
			<h1 id="productListHeading" class="tt-title"><?php echo $current_categories_name; ?></h1>
		</div>
		<?php
		if (PRODUCT_LIST_CATEGORIES_IMAGE_STATUS == 'true') {
		global $wt_pimgldr;
		//lazyload Class
		$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
		
		// categories_image
		  if ($categories_image = zen_get_categories_image($current_category_id)) {
		?>
		<div class="category-banner tt-post-content"><?php echo wt_image(DIR_WS_IMAGES . $categories_image, '', CATEGORY_ICON_IMAGE_WIDTH, CATEGORY_ICON_IMAGE_HEIGHT, 'class="'.$lazyClass.'"', 'category'); ?></div>
		<?php
		  }
		} // categories_image
		?>
		<?php
		// categories_description
			if ($current_categories_description != '') {
		?>
		<div  id="categoryDescription" class="category-description mt-3 pt-3 pb-3"><?php echo $current_categories_description;  ?></div>
		<?php } // categories_description ?>
	</div>
</div>
<?php //if (!empty($listing)) { ?>
<ul class="filter-row d-flex gap-3 ul_li mb_30 mt-4">
<?php //} ?>
			
				<?php
				$check_for_alpha = $listing_sql;
				$check_for_alpha = $db->Execute($check_for_alpha);
				if ($do_filter_list || isset($_GET['alpha_filter_id']) || ($check_for_alpha->RecordCount() > 0 && PRODUCT_LIST_ALPHA_SORTER == 'true')) {
					$form = zen_draw_form('filter', zen_href_link(FILENAME_DEFAULT), 'get');
				?>
				<li class="d-flex align-items-center">
				<?php
					echo $form;
					echo zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
				?>
				<?php
					// draw cPath if known
					if (empty($getoption_set)) {
						echo zen_draw_hidden_field('cPath', $cPath);
					} else {
						// draw manufacturers_id
						echo zen_draw_hidden_field($get_option_variable, $_GET[$get_option_variable]);
					}

					// draw music_genre_id
					if (isset($_GET['music_genre_id']) && $_GET['music_genre_id'] != '') echo zen_draw_hidden_field('music_genre_id', $_GET['music_genre_id']);

					// draw record_company_id
					if (isset($_GET['record_company_id']) && $_GET['record_company_id'] != '') echo zen_draw_hidden_field('record_company_id', $_GET['record_company_id']);

					// draw typefilter
					if (isset($_GET['typefilter']) && $_GET['typefilter'] != '') echo zen_draw_hidden_field('typefilter', $_GET['typefilter']);

					// draw manufacturers_id if not already done earlier
					if (!(isset($get_option_variable) && $get_option_variable == 'manufacturers_id') && !empty($_GET['manufacturers_id'])) {
						echo zen_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
					}

					// draw sort
					echo zen_draw_hidden_field('sort', $_GET['sort']);
					echo '<div class="d-flex gap-2 align-items-center filter-inn">';
					// draw filter_id (ie: category/mfg depending on $options)
					echo '<label class="select-label">' .PRODUCT_LISTING_GRID_SORT_TEXT . '</label>';
					if ($do_filter_list) { ?>
						<div class="select-wrapper-sm d-inline">
    						<?php echo zen_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"'); ?>
						</div>
					<?php }
					// draw alpha sorter
						require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER)); ?>
						</div>
					</form>
					</li>
					<li>
					<?php 
						if (defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') and PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1') {
							echo wt_neoncart_gridlist(FILENAME_DEFAULT);
					} ?>
					</li>
				<?php
				}
				?>
<?php // end wrapper ?>
<?php //<?php if (!empty($listing)) { ?>
</ul>
<?php //} ?>
<?php
/**
 * require the code for listing products
 */
 require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
?>
<?php $wt_display_style = 'slider'; ?>
<div class="products-center-box">
	<?php
	//// bof: categories error
	if ($error_categories==true) {
	  // verify lost category and reset category
	  $check_category = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_id='" . $cPath . "'");
	  if ($check_category->RecordCount() == 0) {
		$new_products_category_id = '0';
		$cPath= '';
	  }
	?>

	<?php
	$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MISSING);

	while (!$show_display_category->EOF) {
	?>

	<?php
	  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS') { ?>
	<?php
	/**
	 * display the Featured Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
	<?php } ?>

	<?php
	  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS') { ?>
	<?php
	/**
	 * display the Special Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
	<?php } ?>

	<?php
	  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS') { ?>
	<?php
	/**
	 * display the New Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
	<?php } ?>

	<?php
	  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_UPCOMING') {
		include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
	  }
	?>
	<?php
	  $show_display_category->MoveNext();
	} // !EOF
	?>
	<?php } //// eof: categories error ?>

	<?php
	//// bof: categories
	$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_LISTING_BELOW);
	if ($error_categories == false and $show_display_category->RecordCount() > 0) {
	?>

	<?php
	  $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_LISTING_BELOW);
	  while (!$show_display_category->EOF) {
	?>

	<?php
		if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS') { ?>
	<?php
	/**
	 * display the Featured Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
	<?php } ?>

	<?php
		if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS') { ?>
	<?php
	/**
	 * display the Special Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
	<?php } ?>

	<?php
		if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS') { ?>
	<?php
	/**
	 * display the New Products Center Box
	 */
	?>
	<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
	<?php } ?>

	<?php
		if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING') {
			include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
		}
	?>
	<?php
	  $show_display_category->MoveNext();
	  } // !EOF
	?>

	<?php
	} //// eof: categories
	?>
</div>
</div>
