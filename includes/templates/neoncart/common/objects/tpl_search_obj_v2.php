<?php echo zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get',  ' class="search"'); ?>
	<i class="icon-f-85"></i>
	<?php echo zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT); ?>
	<?php echo zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id(); ?>
	<?php echo zen_draw_input_field('keyword', '', 'maxlength="30" class="search-input tt-search-input" value="'.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'" onfocus="if(this.value == \''.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . TEXT_SEARCH_PLACEHOLDER_KEYWORD . '\';" autocomplete="off"'); ?>
	<button class="tt-btn-search" type="submit"><?php echo TEXT_SEARCH; ?></button>
	<div class="search-results">
		<div class="resultsContainer"></div>
		<p class="no-res"><?php echo WT_INSTANT_SEARCH_TEXT_NO_PRODUCTS; ?></p>
		<button type="button" onclick="javascript: submit();" class="tt-view-all" style="display:none;"><?php echo WT_VIEW_ALL_PRODUCTS_TEXT; ?></button>
	</div>
</form>