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
$yearAdded = date("Y", strtotime($news_added_date));

?>
<div class="centerColumn" id="moreNewsDefault">
	<?php if ( !empty( $news_box_query->fields['news_image'] ) ) { ?>
	<div class="details_image mb_30">
		<?php echo zen_image(DIR_WS_IMAGES . $news_box_query->fields['news_image'], $news_title, '750', 'auto', 'class="'.$lazyClass.'"'); ?>
	</div>
	<?php } ?>
	<div class="row mb_15 align-items-center justify-content-lg-between">
		<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
			<ul class="post_meta ul_li clearfix">
				<li><?php echo $dateAdded . ' '. $monthAdded .', '.$yearAdded; ?></li>
			</ul>
		</div>
	</div>
	<h1 id="moreNewsHeading" class="item_title mb_30 no-border text-left"><?php echo $news_title; ?></h1>
	<div class="tt-post-content">
		<?php if($news_content){ ?>
			<?php echo htmlspecialchars_decode(stripslashes($news_content)); ?>
		<?php } ?>
	</div>
	<div class="buttonRow back mt-2"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
