<?php echo zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get',  ' class="search"'); ?>
	<?php echo zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT); ?>
	<?php echo zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id(); ?>
	<div class="medical_search_bar">
		<div class="form_item">
			<?php echo zen_draw_input_field('keyword', '', 'class="search-input tt-search-input" value="'.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'" onfocus="if(this.value == \''.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . TEXT_SEARCH_PLACEHOLDER_KEYWORD . '\';" aria-label="search"'); ?>
		</div>
		<button type="submit" class="submit_btn" aria-label="Search"><i class="fal fa-search"></i></button>
	</div>
	<div class="search-results">
		<div class="resultsContainer"></div>
	</div>
</form>