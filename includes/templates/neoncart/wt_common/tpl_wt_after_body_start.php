<?php
#WT_NEONCART_TEMPLATE_BASE#

if ( $page_loader != 'none' ) {
	if ( $page_loader == 'default' || ( $page_loader == 'custom' && empty( $page_loader_custom ) ) ) {
		echo '<div id="loader-wrapper" class="loader-wrapper">
				<div id="loading" class="loader load-bar"></div>
			</div>';
	} else {
		echo '<div id="loader-wrapper" class="loader-wrapper">
				<div id="loader">
					<img src="' . $uploads_path.$page_loader_custom . '" width="auto" height="auto" alt="loader" />
				</div>
			</div>';
	}
}