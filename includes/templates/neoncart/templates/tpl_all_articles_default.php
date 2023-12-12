<?php
// -----
// Part of the News Box Manager plugin, re-structured for Zen Cart v1.5.1 and later by lat9.
// Copyright (C) 2015, Vinos de Frutas Tropicales
//
// +----------------------------------------------------------------------+
// | Do Not Remove: Coded for Zen-Cart by geeks4u.com                     |
// | Dedicated to Memory of Amelita "Emmy" Abordo Gelarderes              |
// +----------------------------------------------------------------------+
//
?>
<?php 
global $wt_pimgldr;
//lazyload Class
$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
?>
<div class="centerColumn" id="allArticlesDefault">
	<h1 class="tt-title no-border text-left"><?php echo sprintf(HEADING_TITLE, $news_type_name); ?></h1>
  <?php
	if (count ($news) == 0) {
	?>
	  <div class="alert alert-info"><?php echo TEXT_NO_NEWS_CURRENTLY; ?></div>
	<?php
	} else {
		
		if (NEWS_BOX_ALL_ARTICLES_DISPLAY == 'Table') {
		?>
			<div id="news-info"><?php echo TEXT_NEWS_BOX_INFO; ?></div>
			<div id="news-table">
				<div class="news-row news-heading">
					<div class="news-cell"><?php echo NEWS_BOX_HEADING_DATES; ?></div>
					<div class="news-cell"><?php echo NEWS_BOX_HEADING_TITLE; ?></div>
				</div>
		<?php
				foreach ($news as $news_id => $news_item) {
					$news_content = '';
					if (isset($news_item['news_content'])) {
						$news_content = ' <div class="news-content">' . $news_item['news_content'] . '</div>';
					}
					$row_class = 'nbt-' . $news_item['type'];
		?>
				<div class="news-row <?php echo $row_class; ?>">
					<div class="news-cell news-dates"><?php echo $news_item['start_date'] . ((isset($news_item['end_date'])) ? (NEWS_DATE_SEPARATOR . $news_item['end_date']) : ''); ?></div>
					<div class="news-cell"><a href="<?php echo zen_href_link(FILENAME_ARTICLE, 'p=' . $news_id); ?>"><?php echo $news_item['title']; ?></a><?php echo $news_content; ?></div>
				</div>
		<?php
				}
		?>
			</div>
			<div class="clearBoth"></div>
		<?php
			// -----
			// Start 'Listing' display ...
			//
			} else {
			?>
				<div class="newsArchiveContent row justify-content-lg-between">
				  <?php
					foreach ($news as $news_id => $news_item) {
						$news_content = '';
						$dateAdded = date("j", strtotime($news_item['news_added_date']));
						$monthAdded = date("M", strtotime($news_item['news_added_date']));
						$yearAdded = date("Y", strtotime($news_item['news_added_date']));
						if (isset($news_item['news_content'])) {
							$news_content = ' <p class="news-content">' . $news_item['news_content'] . '</p>';
						}
				  ?>
					<div class="col-lg-6 col-md-6">
						<div class="blog_grid">
							<a class="blog_image" href="<?php echo zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL'); ?>"><?php echo zen_image(DIR_WS_IMAGES . $news_item['news_image'], $news_item['title'], NEWS_BOX_HOME_IMAGE_WIDTH, NEWS_BOX_HOME_IMAGE_HEIGHT, 'class="'.$lazyClass.'"'); ?></a>
							<div class="blog_content">
								<span class="blog_post_time text-uppercase bg_default_red text-white"><i class="fal fa-calendar-alt me-1"></i> <?php echo $dateAdded . ' '. $monthAdded .', '.$yearAdded; ?></span>
								<h3 class="blog_title"><a href="<?php echo zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL'); ?>"><?php echo $news_item['title']; ?></a></h3>
								<?php if($news_content){ ?>
								<div class="tt-description mb_30"><?php echo htmlspecialchars_decode(stripslashes($news_content)); ?></div>
								<?php } ?>
								<a href="<?php echo zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL'); ?>" class="custom_btn bg_default_black text-uppercase"><?php echo TEXT_READ_MORE; ?><i class="fal fa-arrow-circle-right ms-2"></i></a>
							</div>
						</div>
					</div>
				  <?php	} ?>
				</div>
			<?php } ?>
	<?php } ?>
	<div class="clearBoth"></div>
	<div class="tt-pagination tt-pagination-left pagi-bot">
			<div class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $news_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
			<div class="navSplitPagesResult"><?php echo $news_split->display_count(TEXT_DISPLAY_NUMBER_OF_NEWS_ARTICLES); ?></div>
	</div>
	<div class="newsArchive-links">
		<div class="buttonRow back text-end">
			<?php echo zen_back_link() . zen_image_button (BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
		</div>
	</div>
</div>