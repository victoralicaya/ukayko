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
<div class="centerColumn" id="newsArchiveDefault">
	<div class="page-title mb-4">
		<h1><?php echo HEADING_TITLE; ?></h1>
	</div>
  <?php
	if (count ($news) == 0) {
	?>
	  <div class="alert alert-info"><?php echo TEXT_NO_NEWS_CURRENTLY; ?></div>
	<?php
	} else {
	?>
	<div class="newsArchiveContent">
	  <?php
		foreach ($news as $news_id => $news_item) {
			$news_content = '';
			$dateAdded = date("j", strtotime($news_item['news_added_date']));
			$monthAdded = date("M", strtotime($news_item['news_added_date']));
			if (isset($news_item['news_content'])) {
				$news_content = ' <div class="news-content">' . $news_item['news_content'] . '</div>';
			}
	  ?>
		<div class="post-prw-big">
			<a class="post-img" href="<?php echo zen_href_link (FILENAME_MORE_NEWS, 'news_id=' . $news_id, 'SSL'); ?>"><?php echo zen_image(DIR_WS_IMAGES . $news_item['news_image'], $news_item['news_title'], '750', 'auto', 'class="'.$lazyClass.'"'); ?></a>
			<div class="post-inside">
				<h2 class="post-title"><a href="<?php echo zen_href_link (FILENAME_MORE_NEWS, 'news_id=' . $news_id, 'SSL'); ?>"><?php echo $news_item['title']; ?></a></h2>
				<?php if($news_content){ ?>
				<p class="post-teaser"><?php echo htmlspecialchars_decode(stripslashes($news_content)); ?></p>
				<?php } ?>
				<div class="post-bot">
					<div class="post-date"><?php echo $dateAdded . ' '. $monthAdded; ?></div><a href="<?php echo zen_href_link (FILENAME_MORE_NEWS, 'news_id=' . $news_id, 'SSL'); ?>" class="post-link"><?php echo TEXT_READ_MORE; ?></a>
				</div>
			</div>
		</div>
	  <?php
		}
	} ?>
	</div>
	<div class="clearBoth"></div>
	<div class="pagi-bot">
		<div class="prod-list-wrap group">
			<div class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $news_split->display_links (MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params (array ('page', 'info', 'x', 'y', 'main_page'))); ?></div>
			<div class="navSplitPagesResult"><?php echo $news_split->display_count (TEXT_DISPLAY_NUMBER_OF_NEWS_ARTICLES); ?></div>
		</div>
	</div>
	<div class="newsArchive-links">
		<div class="buttonRow back">
			<?php echo zen_back_link() . zen_image_button (BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
		</div>
	</div>
</div>