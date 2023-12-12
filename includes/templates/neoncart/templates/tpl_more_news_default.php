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

$dateAdded = date("j", strtotime($news_added_date));
$monthAdded = date("M", strtotime($news_added_date));
?>
<div class="centerColumn" id="moreNewsDefault">
	<div class="page-title page-title--blog">
		<div class="title">
			<h1 id="moreNewsHeading"><?php echo $news_title; ?></h1>
		</div>
	</div>
	<div class="post-full">
		<div class="post-bot">
			<div class="post-date"><?php echo $dateAdded . ' '. $monthAdded; ?></div>
		</div>
		<div class="post-img"><?php echo zen_image(DIR_WS_IMAGES . $news_image, $news_title, '750', 'auto', 'class="'.$lazyClass.'"'); ?></div>
		<div class="post-text">
			<?php if($news_content){ ?>
			<p><?php echo htmlspecialchars_decode(stripslashes($news_content)); ?></p>
			<?php } ?>
		</div>
	</div>
	<div class="buttonRow back">
		<a href="<?php echo zen_href_link (FILENAME_NEWS_ARCHIVE, '', 'SSL'); ?>">
			<?php echo zen_image_button (BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) ?>
		</a>
	</div>
</div>
