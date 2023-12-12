<?php 
ob_start();
#WT_NEONCART_TEMPLATE_BASE#

require('includes/application_top.php');
$cancel_url= zen_href_link(FILENAME_WT_NEONCART_TEMPLATE);
$time=time();
$languages = zen_get_languages();			
$uploads_path= DIR_WS_CATALOG.DIR_WS_IMAGES.$template_dir.'/uploads/';
$zcVersion = PROJECT_VERSION_MAJOR . '.' . substr(PROJECT_VERSION_MINOR, 0, 3);

//create table function
//wt_neoncart_create_table_sql();
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Neoncart Template Settings</title>
<?php if(get_wt_neoncart_options('file_favicon')){ ?>
<link rel="icon" href="<?php echo $uploads_path.get_wt_neoncart_options('file_favicon'); ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $uploads_path.get_wt_neoncart_options('file_favicon'); ?>" type="image/x-icon" />
<?php } ?>
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
<?php ?>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<?php if( $zcVersion < '1.5.6' ) { ?>
<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/css/bootstrap.min.css">
<?php } ?>
<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/css/tabcontent.css" />
<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/css/mcColorPicker.css" />
<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/css/accordian.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/js/tabcontent.js" type="text/javascript"></script>
<script src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/js/mcColorPicker.js" type="text/javascript"></script>
<script src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/js/jquery.min.js" type="text/javascript"></script>
<script src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/js/custom.js" type="text/javascript"></script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
</head>

<!-- body //-->
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<?php 
if(isset($_POST['frm_wt_set_submit']))
	{
		unset($_POST['frm_wt_set_submit']);
		foreach($_POST as $k=>$v){
			if(is_array($v)){
				foreach($v as $k1=>$v1){
					wt_neoncart_update_options($k,zen_db_prepare_input($v1),$k1);
				}
			}else{
				wt_neoncart_update_options($k,zen_db_prepare_input($v));
			}
		}
		foreach( $_FILES as $k => $v ) {
			wt_neoncart_fileupload($k, $k);
		}
		$messageStack->add_session('Template settings has been successfully saved.', 'success');
	    zen_redirect(zen_href_link(FILENAME_WT_NEONCART_TEMPLATE.".php",'','SSL')); 
	}
?>
<!-- body //-->
<section class="main_wrapper">
   <div class="container">
   	  <div class="content">
	  <?php $get_admin_dir = str_replace(DIR_WS_CATALOG,'',preg_replace('#^' . str_replace('-', '\-', zen_parse_url(HTTP_SERVER, '/path')) . '#', '', dirname($_SERVER['SCRIPT_NAME']))); ?>
	  <?php $get_admin_dir = str_replace("/",'',$get_admin_dir); ?>
	  <?php $root_path = str_replace($get_admin_dir,'',DIR_WS_ADMIN); ?>
	  <?php $root_path = explode("/",$root_path); ?>
	  <?php $root_path = implode('/',array_filter($root_path)); ?>
	  <?php if($root_path!=''){ $root_path = '/'.$root_path; } ?>
	  <?php //echo dirname($_SERVER['SCRIPT_NAME']);echo "<br>"; ?>
	  <?php //echo preg_replace('#^' . str_replace('-', '\-', zen_parse_url(HTTP_SERVER, '/path')) . '#', '', dirname($_SERVER['SCRIPT_NAME'])); echo "<br>" ?>
   		<header>
        	<div class="logo">
            	<img class="logo" title="Image" alt="Image" src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/images/logo.png" />
            </div>
        </header>
        <div class="tab-wrapper">
            <ul class="tabs" data-persist="true">
				<li><a href="#view1">General</a></li>
				<li><a href="#homepage">Home Page</a></li>
				<li><a href="#topbar">TopBar</a></li>  
				<li><a href="#view2">Header</a></li>  
				<li><a href="#view3">Footer</a></li>
				<li><a href="#view4">Main Menu</a></li>
				<li><a href="#view12">Banner Manager</a></li>
				<li><a href="#view17">Category Page</a></li>
				<li><a href="#view18">Products List Page</a></li>
				<li><a href="#view19">Products Info Page</a></li>
            </ul> 
            <div class="tabcontents form-horizontal"> 
                <div id="view1" class="tab-content">
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<h1 class="tab-header">General</h1>
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">General Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'General Page Layout:', 'general_page_layout', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php 
											$homepage_page_layout_options =  array( 
												'1column' => array( 'label' => '1 Columns' ),
												'2columns-left' => array( 'label' => '2 Columns - Left' ),
												'2columns-right' => array( 'label' => '2 Columns - Right' ),
												'3columns' => array( 'label' => '3 Columns' ),
											);
											echo wt_neoncart_draw_radio( 'general_page_layout', $homepage_page_layout_options, get_wt_neoncart_options( 'general_page_layout', '2columns-left' ) );
											?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Page Loader:', 'page_loader', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php 
											echo wt_neoncart_draw_radio( 'page_loader', array( 
												'none' => array( 'label' => 'None', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_page_loader' ) ),
												'default' => array( 'label' => 'Default', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_page_loader' ) ),
												'custom' => array( 'label' => 'Custom', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_page_loader', 'data-target' => 'inner_pageloader_custom' ) ),
											), get_wt_neoncart_options( 'page_loader', 'default' ) );
											?>
											<div id="inner_pageloader_custom" class="inner_section inner_sec_page_loader" style="<?php echo ( get_wt_neoncart_options( 'page_loader', 'default' ) =='custom' ) ? 'display:block;' : 'display:none;'; ?>">
												<div class="rw">
													<div class="cont">
														<div class="rw_full">
															<div class="rw">
																<label>Loader Image :</label>
																<div class="con">
																	<input type="file" value="" id="" name="page_loader_custom" class="form-control">
																	<?php if(get_wt_neoncart_options('page_loader_custom')!=''){ ?>
																	<div class="file_content">
																		<img src="<?php echo $uploads_path.get_wt_neoncart_options('page_loader_custom'); ?>" height="auto" width="auto" title="Image" />
																	</div>
																	<?php } ?>
																</div>
															</div>
															<p class="notice">Please Upload Gif File.</p>
														</div>
													</div>
												</div>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Image Loader:', 'product_img_loader', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_enabledisable_radio( 'product_img_loader', 0 ); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Container Width:', 'container_width', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('container_width', get_wt_neoncart_options( 'container_width', '1200px' )); ?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Colors</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Theme Color:', 'theme_color', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_color_inputbox('theme_color'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Theme Second Color:', 'theme_second_color', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_color_inputbox('theme_second_color'); ?>
											<div class="notice">
												<p>Second color affected like button hover background color.</p>
											</div>
										
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'New Label Color:', 'new_lbl_color', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_color_inputbox('new_lbl_color', get_wt_neoncart_options('new_lbl_color', '#cc1414')); ?>
											<div class="notice">
												<p>New label color affected like new products label badge ackground color.</p>
											</div>
										
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Sale Label Color:', 'sale_lbl_color', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_color_inputbox('sale_lbl_color', get_wt_neoncart_options('sale_lbl_color', '#0062bd')); ?>
											<div class="notice">
												<p>Sale label color affected like sale products label badge ackground color.</p>
											</div>
										
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Fonts Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'General Font Family:', 'general_font_family', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_generate_fontfamily_pull_down( 'general_font_family', get_wt_neoncart_options('general_font_family', 'Open Sans') ); ?>
											<div class="notice">
												<p>Defualt : Open Sans</p>
												<p class="notice">Font preview is available on <a href="http://www.google.com/webfonts">Google Web Fonts</a></p>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Heading Font Family:', 'heading_font_family', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_generate_fontfamily_pull_down( 'heading_font_family', get_wt_neoncart_options('heading_font_family', 'Oswald') ); ?>
											<div class="notice">
												<p>Defualt : Oswald</p>
												<p class="notice">Font preview is available on <a href="http://www.google.com/webfonts">Google Web Fonts</a></p>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Banner Heading Font Family:', 'ban_heading_font_family', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_generate_fontfamily_pull_down( 'ban_heading_font_family', get_wt_neoncart_options('ban_heading_font_family', 'Poppins') ); ?>
											<div class="notice">
												<p>Defualt : Poppins</p>
												<p class="notice">Font preview is available on <a href="http://www.google.com/webfonts">Google Web Fonts</a></p>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Character Set: Latin Extended:', 'font_latin_charset_extended', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php $font_latin_charset_extended = get_wt_neoncart_options( 'font_latin_charset_extended', 0 ); ?>
											<select name="font_latin_charset_extended" class="form-control">
												<option <?php echo ( $font_latin_charset_extended == 1 ) ? 'selected="selected"' : '' ; ?>  value="1">Enable</option>
												<option <?php echo ( $font_latin_charset_extended == 0 ) ? 'selected="selected"' : '' ; ?> value="0">Disable</option>
											</select>
											<div class="notice">
												<p class="notice">Only selected fonts support extended character sets. For a complete list of available fonts and font subsets please refer to <a href="http://www.google.com/webfonts">Google Web Fonts</a>.</p>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Custom Character Subset:', 'heading_font_family', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('font_custom_charset'); ?>
											<div class="notice">
												<p class="notice">Only selected fonts support character sets. For a complete list of available fonts and font subsets please refer to <a href="http://www.google.com/webfonts">Google Web Fonts</a>.  eg: greek,greek-ext </p>
											</div>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Product Slider</h2>
								</header>
								<div class="block-content">
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Products Slider Show Column(s)</label>
												<?php $column_nums_ar =  array(
															1 => 1,
															2 => 2,
															3 => 3,
															4 => 4,
															5 => 5,
															6 => 6,
															7 => 7,
															8 => 8,
															); 
															?>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns above 1400px', 'prod_slider_col_xxl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_xxl', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_xxl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (1200px - 1400px)', 'prod_slider_col_xl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_xl', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_xl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (992px - 1199px)', 'prod_slider_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_lg', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_lg', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (768px - 991px)', 'prod_slider_col_md', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_md', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_md', 3 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (576px - 767px)', 'prod_slider_col_sm', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_sm', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_sm', 2 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (480px - 575px)', 'prod_slider_col_xs', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prod_slider_col_xs', $column_nums_ar, get_wt_neoncart_options( 'prod_slider_col_xs', 2 ) ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Additional Image Style:', 'prod_slider_addtionalimg_style', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php 
											echo wt_neoncart_draw_radio( 'prod_slider_addtionalimg_style', array( 
												'default' => array( 'label' => 'Default', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_addimgtype' ) ),
												'hover' => array( 'label' => 'Hover Effect', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_addimgtype', 'data-target' => 'prod_slider_imghover_effects' ) ),
											), get_wt_neoncart_options( 'prod_slider_addtionalimg_style', 'default' ) );
											?>
									  	</div>
										<div id="prod_slider_imghover_effects" class="inner_section inner_sec_addimgtype" style="<?php echo ( get_wt_neoncart_options( 'prod_slider_addtionalimg_style', 'default' ) == 'hover' ) ? 'display:block;' : 'display:none;'; ?>">
											<div class="rw">
												<div class="cont">
													<div class="rw_full">
														<div class="row">
															<div class="form-group">
																<?php echo zen_draw_label( 'Product Image Hover Effects:', 'prod_slider_imghover_style', 'class="col-sm-3 control-label"'); ?>
																<div class="col-sm-9 cont">
																	<?php
																	echo wt_neoncart_draw_radio( 'prod_slider_imghover_style', array( 
																		'fade' => array( 'label' => 'Fade Effect' ),
																		'vslide' => array( 'label' => 'Vertical Side Effect' ),
																	), get_wt_neoncart_options( 'prod_slider_imghover_style', 1 ) );
																	?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Model:', 'display_prod_slider_model', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_model'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Ratings:', 'display_prod_slider_rattings', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_rattings'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Price:', 'display_prod_slider_price', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_price'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Addtocart Button:', 'display_prod_slider_addtocart', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_addtocart'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Quickview:', 'display_prod_slider_quickview', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_quickview'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Wishlist:', 'display_prod_slider_wishlist', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_wishlist'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Compare:', 'display_prod_slider_compare', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_compare'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Sale Label:', 'display_prod_slider_salelabel', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_salelabel'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display New Label:', 'display_prod_slider_newlabel', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_prod_slider_newlabel'); ?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Testimonials Manager</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Testimonials:', 'display_testimonials', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_testimonials'); ?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Social Links</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Facebook:', 'facebook_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('facebook_link'); ?>
											<p class="notice">(e.g : envato). Leave text-box empty to hide the Facebook link.</p>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Twitter:', 'twitter_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('twitter_link'); ?>
											<p class="notice">(e.g : envato). Leave text-box empty to hide the Twitter link.</p>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Pinterest:', 'pinterest_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('pinterest_link'); ?>
											<p class="notice">(e.g : envato). Leave text-box empty to hide the Pinterest link. </p>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Instagram Link:', 'instagram_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('instagram_link'); ?>
											<p class="notice">(e.g : https://www.instagram.com/instagram). Leave text-box empty to hide the Instagram link.</p>
									  	</div>
									</div>
								</div>
							 </section>
							 <section class="block">
								<header class="block-header">
									<h2 class="title">Newsletter</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Newsletter Subcribe Code for your Store (Mail Chimp Account):', 'instagram_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_textarea('newsletter_details'); ?>
											<p class="notice">Get this code from your Mail Chimp Account. Follow instructions in Documentation to get the code.</p>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Newsletter Popup</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Newsletter Popup:', 'display_newsletter_popup', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php 
											echo wt_neoncart_draw_radio( 
												'display_newsletter_popup', 
												array( 
													1 => array( 'label' => WT_A_YES, 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_newsletterpopup', 'data-target' => 'inner_sec_newsletterpopup_yes1111' ) ),
													0 => array( 'label' => WT_A_NO, 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_newsletterpopup' ) ),
												), 
												get_wt_neoncart_options( 'display_newsletter_popup', 1 ) 
											);
											?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Google Map</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Google Map iframe code for your Store:', 'instagram_link', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_textarea('google_map'); ?>
											<p class="notice">Get this iframe code from Google Maps. Leave blank to remove Google Map from Contact Us page.</p>	
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Google Recaptcha Keys For Sign Up and Contact Us Page</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Site Key:', 'google_site_key', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('google_site_key'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Secret Key:', 'google_secret_key', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_inputbox('google_secret_key'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( '', '', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<p class="notice">Leave text-box empty to remove it.</p>
									  	</div>
									</div>
										
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
                </div>
				<div id="homepage" class="tab-content">
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<h1 class="tab-header">Home Page</h1>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Homepage Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Theme Layout:', 'general_page_layout', 'class="col-sm-12"'); ?>
									  	<div class="col-sm-12 cont">
									  		<?php
											$_SESSION['home_versions'] = $home_versions = 3;
											$homversion_layouts = array();
											if ( $home_versions > 0 ) {
												for( $i=1; $i <= $home_versions; $i++ ) {
													$homversion_layouts[ 'homepage_v'. $i ] = array( 'label' => 'Homepage - V'. $i, 'label_image' => wt_image( DIR_WS_INCLUDES . WT_NEONCART_TEMPLATE_INCLUDES . '/images/home-layouts/homepage_v' . $i . '.png', 'Homepage - V'. $i ), 'li_class' => 'hm-layout col-lg-2 col-md-3' );
												}
											}
											echo wt_neoncart_draw_radio( 'homepage_version', $homversion_layouts, get_wt_neoncart_options( 'homepage_version', 'homepage_v1' ) );
											?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Homepage Layout:', 'theme_layout_mode', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'homepage_page_layout', array( 
												'1column' => array( 'label' => '1 Columns' ),
												'2columns-left' => array( 'label' => '2 Columns - Left' ),
												'2columns-right' => array( 'label' => '2 Columns - Right' ),
												'3columns' => array( 'label' => '3 Columns' ),
											), get_wt_neoncart_options( 'homepage_page_layout', '2columns-left' ) );
											?>
									  	</div>
									</div>
								</div>
							</section>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
                </div>
				<div id="topbar" class="tab-content">
					<h1 class="tab-header">TopBar</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Topbar Promo Content</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Promo Topbar', 'display_promo_topbar', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio('display_promo_topbar'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Promo TopBar Content:', 'promo_topbar_content', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_langtextarea('promo_topbar_content', '', 50, 50); ?>
									  	</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
				</div>
				<div id="view2" class="tab-content">
					<h1 class="tab-header">Header</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Header</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Header Style:', 'header_style', 'class="col-12 control-label"'); ?>
									  	<div class="col-12 cont">
										<?php
											$header_versions = 3;
											$header_layouts = array();
											if ( $header_versions > 0 ) {
												for( $i=1; $i <= $header_versions; $i++ ) {
													$header_layouts[ 'tpl_header_v'. $i ] = array( 
														'label' => 'Header - V'. $i, 
														'label_image' => wt_image( DIR_WS_INCLUDES . WT_NEONCART_TEMPLATE_INCLUDES . '/images/header-styles/header_v' . $i . '.png', 'Header - V'. $i ), 
														'li_class' => 'hm-layout col-lg-3 col-md-3',
														'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_header"' ),
													);
												}
											}
											echo wt_neoncart_draw_radio( 'header_style', $header_layouts, get_wt_neoncart_options( 'header_style', 'tpl_header_v1' ) );
											?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Header Content</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Logo:', 'file_logo', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<input type="file" value="logo.png" id="file_logo" name="file_logo" size="30" class="form-control" >
											<?php if(get_wt_neoncart_options('file_logo')!=''){ ?>
											<div class="file_content">
												<img src="<?php echo $uploads_path.get_wt_neoncart_options('file_logo'); ?>" title="Site Logo" />
											</div>
											<?php } ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Favicon:', 'file_favicon', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<input type="file" value="logo.png" id="file_favicon" name="file_favicon" size="30" class="form-control">
											<?php if(get_wt_neoncart_options('file_favicon')!=''){ ?>
											<div class="file_content">
												<img src="<?php echo $uploads_path.get_wt_neoncart_options('file_favicon'); ?>" title="Favicon Icon" />
											</div>
											<?php } ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label('Contact Number:', 'header_store_contact', 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 col-md-6">
											<?php echo wt_neoncart_draw_inputbox('header_store_contact'); ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label('Email Address:', 'header_store_email', 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 col-md-6">
											<?php echo wt_neoncart_draw_inputbox('header_store_email'); ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label('Time:', 'header_store_time', 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 col-md-6">
											<?php echo wt_neoncart_draw_inputbox('header_store_time'); ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Topbar Shipping Content:', 'topbar_shipping_content', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_langtextarea('topbar_shipping_content'); ?>
									  	</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
				</div>
				<div id="view3" class="tab-content">
                    <h1 class="tab-header">Footer</h1>
					<div class="sec_accordian">
						<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Footer Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group footer-styles">
										<?php echo zen_draw_label( 'Footer Style:', 'footer_layout', 'class="col-sm-12"'); ?>
									  	<div class="col-sm-12 cont">
									  		<?php
											$footer_versions = 6;
											$footer_layouts = array();
											if ( $footer_versions > 0 ) {
												for( $i=1; $i <= $footer_versions; $i++ ) {
													$footer_layouts[ 'footer_v'. $i ] = array( 
														'label' => 'Footer - V'. $i, 
														'label_image' => wt_image( DIR_WS_INCLUDES . WT_NEONCART_TEMPLATE_INCLUDES . '/images/footer-styles/footer_v' . $i . '.png', 'Footer - V'. $i ), 
														'li_class' => 'hm-layout col-md-2',
														'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_footer"' ),
													);
												}
												$footer_layouts[ 'footer_v10' ][ 'params' ][ 'data-target' ] = 'inner_sec_footer';
											}
											echo wt_neoncart_draw_radio( 'footer_layout', $footer_layouts, get_wt_neoncart_options( 'footer_layout', 'footer_v1' ) );
											?>
											<div id="inner_sec_footer" class="inner_section inner_sec_footer" style="<?php echo (in_array($footer_layouts, array('footer_v10')))? 'display:block;' : 'display:none;'; ?>">
												<div class="rw">
													<div class="cont">
														<div class="rw_full">
															<div class="rw">
																<label>Footer Background Image  :</label>
																<div class="con">
																	<input type="file" value="" id="footer_bg_img" name="footer_bg_img" size="30">
																	<?php if(get_wt_neoncart_options('footer_bg_img')!=''){ ?>
																	<div class="file_content">
																		<img src="<?php echo $uploads_path.get_wt_neoncart_options('footer_bg_img'); ?>" />
																	</div>
																	<?php } ?>
																</div>
															</div>
															<div class="rw">
																<label>Footer Subscribe Background Image  :</label>
																<div class="con">
																	<input type="file" value="" id="footer_sub_bg_img" name="footer_sub_bg_img" size="30">
																	<?php if(get_wt_neoncart_options('footer_sub_bg_img')!=''){ ?>
																	<div class="file_content">
																		<img src="<?php echo $uploads_path.get_wt_neoncart_options('footer_sub_bg_img'); ?>" />
																	</div>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Payment Image:', 'payment_image', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<input type="file" value="payment_image.png" id="payment_image" name="payment_image" size="30">
											<?php if(get_wt_neoncart_options('payment_image')!=''){ ?>
											<div class="file_content">
												<img src="<?php echo $uploads_path.get_wt_neoncart_options('payment_image'); ?>" title="Payment Image" />
											</div>
											<?php } ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Copyrights Text:', 'store_copyright', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_textarea('store_copyright'); ?>
									  	</div>
									</div>
								</div>
							</section>
							<section class="block">
								<header class="block-header">
									<h2 class="title">Store Info</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Footer Logo:', 'footer_logo', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<input type="file" value="footer_logo.png" id="footer_logo" name="footer_logo" size="30">
											<?php if(get_wt_neoncart_options('footer_logo')!=''){ ?>
											<div class="file_content">
												<img src="<?php echo $uploads_path.get_wt_neoncart_options('footer_logo'); ?>" title="Footer Logo" />
											</div>
											<?php } ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Store Description:', 'store_description', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_langtextarea('store_description'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Store Address:', 'store_address', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_langtextarea('store_address'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Contact Number:', 'store_contact', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_inputbox('store_contact'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Fax:', 'store_fax', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_inputbox('store_fax'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Skype:', 'store_skype', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_inputbox('store_skype'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Email:', 'store_email', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_inputbox('store_email'); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Time:', 'store_time', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
											<?php echo wt_neoncart_draw_inputbox('store_time'); ?>
									  	</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
                </div>
				<div id="view4"class="main-menu tab-content">
					<h1 class="tab-header">Main Menu</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<section class="block-static single-block">
								<header class="block-header">
									<h2 class="title">Menu Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Menu Type:', 'menu_type', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'menu_type', array( 
												'simple' => array( 'label' => 'Simple Menu' ),
												'mega' => array( 'label' => 'Mega Menu' ),
											), get_wt_neoncart_options( 'menu_type', 'simple' ) );
											?>
									  	</div>
									</div>
								</div>
						</section>
						<div class="sec_accordian">
						<?php 
							global $languages_id, $db;
							$cat_array = array();
							$categories_query = "select c.categories_id, cd.categories_name, c.parent_id
															from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
															where c.categories_id = cd.categories_id
															and c.categories_status=1 " .
															" and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' " .
															" order by c.parent_id, c.sort_order, cd.categories_name";
							$categories = $db->Execute($categories_query);
							while (!$categories->EOF) {
								$cat_array[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'count' => 0);
								$categories->MoveNext();
							}
						?>
						<?php foreach($cat_array[0] as $k0=>$v0){ ?>
							<section class="block">
								<header class="block-header">
									<h2 class="title"><?php echo $v0['name']; ?></h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Display on Main Menu', 'display_in_hor_menu_' . $k0, 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio( 'display_in_hor_menu_' . $k0, 1 ); ?>
									  	</div>
									</div>
									<?php /*<div class="form-group">
										<?php echo zen_draw_label( 'Display on Vertical Menu', 'display_in_ver_menu_' . $k0, 'class="col-sm-3 control-label"'); ?>
											<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio( 'display_in_ver_menu_' . $k0, 1 ); ?>
									  	</div>
									</div>*/?>
									<div class="form-group">
										<?php echo zen_draw_label( 'Menu Type:', 'menu_type_' . $k0, 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'menu_type_' . $k0,
												array( 
													1 => array( 'label' => 'Megamenu', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_menutype_' . $k0, 'data-target' => 'inner_sec_menutype_' . $k0 )  ),
													2 => array( 'label' => 'Classic', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_menutype_' . $k0 ) ),
												), get_wt_neoncart_options( 'menu_type_' . $k0, 1 ) );
											?>
											<div id="inner_sec_menutype_<?php echo $k0; ?>" class="inner_section inner_sec_menutype_<?php echo $k0; ?>" style="<?php echo ( get_wt_neoncart_options( 'menu_type_' . $k0, 1 ) != 1 ) ? 'display:none;' : ''; ?>">
												<div class="form-group">
													<?php echo zen_draw_label( 'Show Columns:', 'megamenu_show_columns_' . $k0, 'class="col-sm-3 control-label"'); ?>
													<div class="col-sm-9 cont">
														<?php echo wt_neoncart_draw_selectbox( 'megamenu_show_columns_' . $k0, array( '1' => 'Column - 1', '2' => 'Columns - 2', '3' => 'Columns - 3', '4' => 'Columns - 4', '5' => 'Columns - 5' ), get_wt_neoncart_options( 'megamenu_show_columns_' . $k0, 3 ) ); ?>
													</div>
												</div>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Badge:', 'badge_type_' . $k0, 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'badge_type_' . $k0, array( 
												'new' => array( 'label' => 'New' ),
												'sale' => array( 'label' => 'Sale' ),
												'none' => array( 'label' => 'None' ),
											), get_wt_neoncart_options( 'badge_type_' . $k0, 'none' ) );
											?>
									  	</div>
									</div>
									<?php /*
									<div class="row">
										<label><?php echo WT_LABEL_; ?>Subcategory Display Mark :</label>
										<div class="cont"><?php echo wt_draw_yesnoradio('subcat_marked_' . $k0); ?></div>
									</div> */?>
									<div class="form-group">
										<?php echo zen_draw_label( 'Display Subcategory Image:', 'subcat_imgstatus_' . $k0, 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php echo wt_neoncart_draw_yesnoradio( 'subcat_imgstatus_' . $k0 ); ?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Megamenu Side Block:', 'megamenu_btype_' . $k0, 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'megamenu_btype_' . $k0,
												array( 
													'special' => array( 'label' => 'Special Products', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_btype_' . $k0 ) ),
													'featured' => array( 'label' => 'Featured Products', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_btype_' . $k0 ) ),
													'banner' => array( 'label' => 'Banner', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_btype_' . $k0, 'data-target' => 'inner_sec_btype_ban_' . $k0 ) ),
													'none' => array( 'label' => 'None', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_btype_' . $k0 ) ),
												), get_wt_neoncart_options( 'megamenu_btype_' . $k0, 'none' ) );
											?>
											<div id="inner_sec_btype_ban_<?php echo $k0; ?>" class="inner_section inner_sec_btype_<?php echo $k0; ?>" style="<?php echo ( get_wt_neoncart_options( 'megamenu_btype_' . $k0, 'none' ) != 'banner' ) ? 'display:none;' : ''; ?>">
												<div class="form-group">
													<?php echo zen_draw_label( 'Megamenu Side Block Banner:', 'mg_side_block_ban_' . $k0 . '_img', 'class="col-sm-3 control-label"'); ?>
													<div class="col-sm-9 cont">
														<input type="file" value="" id="" name="mg_side_block_ban_<?php echo $k0; ?>_img" size="30" class="form-control">
														<?php if ( get_wt_neoncart_options( 'mg_side_block_ban_' . $k0.'_img' ) ) { ?>
														<div class="file_content">
															<img src="<?php echo $uploads_path.get_wt_neoncart_options('mg_side_block_ban_' . $k0.'_img'); ?>" height="auto" width="auto" title="Image" />
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="form-group">
													<?php echo zen_draw_label( 'Link:', 'mg_side_block_ban_' . $k0 . '_link', 'class="col-sm-3 control-label"'); ?>
													<div class="col-sm-9 cont">
														<?php echo wt_neoncart_draw_inputbox( 'mg_side_block_ban_' . $k0.'_link' ); ?>
													</div>
												</div>
											</div>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Megamenu Bottom Block:', 'megamenu_bottom_block_' . $k0, 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											
											echo wt_neoncart_draw_radio( 'megamenu_bottom_block_' . $k0,
												array( 
													1 => array( 'label' => WT_A_YES, 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_megamenu_bottom_block_' . $k0, 'data-target' => 'inner_sec_megamenu_bottom_block_yes_' . $k0 ) ),
													0 => array( 'label' => WT_A_NO, 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_megamenu_bottom_block_' . $k0 ) ),
												), get_wt_neoncart_options( 'megamenu_bottom_block_' . $k0, 'none' ) );
											?>
											<div id="inner_sec_megamenu_bottom_block_yes_<?php echo $k0; ?>" class="inner_section inner_sec_megamenu_bottom_block_<?php echo $k0; ?>" style="<?php echo ( get_wt_neoncart_options( 'megamenu_bottom_block_' . $k0, 1 ) == 0 ) ? 'display:none;' : ''; ?>">
												<div class="rw">
													<label>Megamenu Bottom Banners Content</label>
													<div class="cont">
														<div class="form-group">
															<?php echo zen_draw_label( 'Image:', 'mg_botban_cont_0_' . $k0 . '_img', 'class="col-sm-3 control-label"'); ?>
															<div class="col-sm-9 cont">
																<input type="file" value="" id="" name="mg_botban_cont_0_<?php echo $k0; ?>_img" size="30" class="form-control">
																<?php if ( get_wt_neoncart_options( 'mg_botban_cont_0_' . $k0.'_img' ) ) { ?>
																<div class="file_content">
																	<img src="<?php echo $uploads_path.get_wt_neoncart_options('mg_botban_cont_0_' . $k0.'_img'); ?>" height="auto" width="auto" title="Image" />
																</div>
																<?php } ?>
															</div>
														</div>
														<div class="form-group">
															<?php echo zen_draw_label( 'Link:', 'mg_botban_cont_0_' . $k0 . '_link', 'class="col-sm-3 control-label"'); ?>
															<div class="col-sm-9 cont">
																<?php echo wt_neoncart_draw_inputbox( 'mg_botban_cont_0_' . $k0.'_link' ); ?>
															</div>
														</div>
														<div class="form-group">
															<?php echo zen_draw_label( 'Image:', 'mg_botban_cont_1_' . $k0 . '_img', 'class="col-sm-3 control-label"'); ?>
															<div class="col-sm-9 cont">
																<input type="file" value="" id="" name="mg_botban_cont_1_<?php echo $k0; ?>_img" size="30" class="form-control">
																<?php if ( get_wt_neoncart_options( 'mg_botban_cont_1_' . $k0.'_img' ) ) { ?>
																<div class="file_content">
																	<img src="<?php echo $uploads_path.get_wt_neoncart_options('mg_botban_cont_1_' . $k0.'_img'); ?>" height="auto" width="auto" title="Image" />
																</div>
																<?php } ?>
															</div>
														</div>
														<div class="form-group">
															<?php echo zen_draw_label( 'Link:', 'mg_botban_cont_1_' . $k0 . '_link', 'class="col-sm-3 control-label"'); ?>
															<div class="col-sm-9 cont">
																<?php echo wt_neoncart_draw_inputbox( 'mg_botban_cont_1_' . $k0.'_link' ); ?>
															</div>
														</div>
													</div>
												</div>
											</div>
									  	</div>
									</div>
							</section>
						<?php } ?>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
                </div>
				<div id="view12"class="topbanner_slider tab-content">
					<br><br>
					<div class="alert alert-info">Template Top Banner, Middle Banner, Sidebar Banner and Footer Banners Manage from WT Neoncart Banner Manager Module.</div>
					<h1 class="tab-header">Go to <a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER.".php",'','SSL'); ?>">Template Banner Manager</a></h1>
                </div>
				<div id="view17" class="tab-content">
					<h1 class="tab-header">Categories</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Categories Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Category Page Layout:', 'cat_page_layout', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'cat_page_layout', array( 
												'1column' => array( 'label' => '1 Columns' ),
												'2columns-left' => array( 'label' => '2 Columns - Left' ),
												'2columns-right' => array( 'label' => '2 Columns - Right' ),
												'3columns' => array( 'label' => '3 Columns' ),
											), get_wt_neoncart_options( 'cat_page_layout', '2columns-left' ) );
											?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Category Style:', 'cat_grid_style', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'cat_grid_style', array( 
												1 => array( 'label' => 'Category Style - 1' ),
												2 => array( 'label' => 'Category Style - 2' ),
											), get_wt_neoncart_options( 'cat_grid_style', 1 ) );
											?>
											<div class="col-lg-12">
												<div class="col-md-6"><img src="includes/wt_neoncart_template/images/catgrid-style-1.png" width="100%" height="auto" /></div>
												<div class="col-md-6"><img src="includes/wt_neoncart_template/images/catgrid-style-2.png" width="100%" height="auto" /></div>
											</div>
									  	</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Categories List</label>
												<?php $column_nums_ar =  array(
															1 => 1,
															2 => 2,
															3 => 3,
															4 => 4,
															5 => 5,
															6 => 6,
															7 => 7,
															8 => 8,
															); 
															?>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns above 1400px', 'catgrid_col_xxl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_xxl', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_xxl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (1200px - 1400px)', 'catgrid_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_xl', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_xl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (992px - 1200px)', 'catgrid_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_lg', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_lg', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (768px - 991px)', 'catgrid_col_md', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_md', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_md', 3 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (576px - 767px)', 'catgrid_col_sm', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_sm', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_sm', 2 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (480px - 575px)', 'catgrid_col_xs', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catgrid_col_xs', $column_nums_ar, get_wt_neoncart_options( 'catgrid_col_xs', 2 ) ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Category Products Slider</label>
												<?php $column_nums_ar =  array(
															1 => 1,
															2 => 2,
															3 => 3,
															4 => 4,
															5 => 5,
															6 => 6,
															7 => 7,
															8 => 8,
															); 
															?>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns above 1400px', 'catslide_col_xxl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_xxl', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_xxl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (1200px - 1400px)', 'catslide_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_xl', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_xl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (992px - 1200px)', 'catslide_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_lg', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_lg', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (768px - 991px)', 'catslide_col_md', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_md', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_md', 3 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (576px - 767px)', 'catslide_col_sm', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_sm', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_sm', 2 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (480px - 575px)', 'catslide_col_xs', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'catslide_col_xs', $column_nums_ar, get_wt_neoncart_options( 'catslide_col_xs', 2 ) ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
				</div>
				<div id="view18" class="tab-content">
					<h1 class="tab-header">Products List Page</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Products List Page Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Products List Page Layout:', 'prodlist_page_layout', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'prodlist_page_layout', array( 
												'1column' => array( 'label' => '1 Columns' ),
												'2columns-left' => array( 'label' => '2 Columns - Left' ),
												'2columns-right' => array( 'label' => '2 Columns - Right' ),
												'3columns' => array( 'label' => '3 Columns' ),
											), get_wt_neoncart_options( 'prodlist_page_layout', '2columns-left' ) );
											?>
									  	</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Products List</label>
												<?php $column_nums_ar =  array(
															1 => 1,
															2 => 2,
															3 => 3,
															4 => 4,
															5 => 5,
															6 => 6,
															7 => 7,
															8 => 8,
															); 
															?>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns above 1400px', 'prodgrid_col_xxl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_xxl', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_xxl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (1200px - 1400px)', 'prodgrid_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_xl', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_xl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (992px - 1200px)', 'prodgrid_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_lg', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_lg', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (768px - 991px)', 'prodgrid_col_md', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_md', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_md', 3 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (576px - 767px)', 'prodgrid_col_sm', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_sm', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_sm', 2 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (480px - 575px)', 'prodgrid_col_xs', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodgrid_col_xs', $column_nums_ar, get_wt_neoncart_options( 'prodgrid_col_xs', 2 ) ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Product Configuration</label>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Additional Image Style:', 'prod_grid_addtionalimg_style', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php 
															echo wt_neoncart_draw_radio( 'prod_grid_addtionalimg_style', array( 
																'default' => array( 'label' => 'Default', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_addimgtype' ) ),
																'hover' => array( 'label' => 'Hover Effect', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_addimgtype', 'data-target' => 'prod_grid_imghover_effects' ) ),
															), get_wt_neoncart_options( 'prod_grid_addtionalimg_style', 'default' ) );
															?>
														</div>
														<div id="prod_grid_imghover_effects" class="inner_section inner_sec_addimgtype" style="<?php echo ( get_wt_neoncart_options( 'prod_grid_addtionalimg_style', 'default' ) == 'hover' ) ? 'display:block;' : 'display:none;'; ?>">
															<div class="rw">
																<div class="cont">
																	<div class="rw_full">
																		<div class="row">
																			<div class="form-group">
																				<?php echo zen_draw_label( 'Product Image Hover Effects:', 'prod_grid_imghover_style', 'class="col-sm-3 control-label"'); ?>
																				<div class="col-sm-9 cont">
																					<?php
																					echo wt_neoncart_draw_radio( 'prod_grid_imghover_style', array( 
																						'fade' => array( 'label' => 'Fade Effect' ),
																						'vslide' => array( 'label' => 'Vertical Side Effect' ),
																					), get_wt_neoncart_options( 'prod_grid_imghover_style', 'fade' ) );
																					?>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Model:', 'display_prod_grid_model', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_model'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Ratings:', 'display_prod_grid_rattings', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_rattings'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Price:', 'display_prod_grid_price', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_price'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Addtocart Button:', 'display_prod_grid_addtocart', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_addtocart'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Quickview:', 'display_prod_grid_quickview', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_quickview'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Wishlist:', 'display_prod_grid_wishlist', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_wishlist'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Compare:', 'display_prod_grid_compare', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_compare'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Sale Label:', 'display_prod_grid_salelabel', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_salelabel'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display New Label:', 'display_prod_grid_newlabel', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_grid_newlabel'); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
				</div>
				<div id="view19" class="tab-content">
					<h1 class="tab-header">Products Info Page</h1>
					<form name='frm_wt' action="<?php echo zen_href_link(FILENAME_WT_NEONCART_TEMPLATE, '', 'SSL'); ?>" method="post" enctype="multipart/form-data">
						<div class="sec_accordian">
							<section class="block">
								<header class="block-header">
									<h2 class="title">Products Info Page Settings</h2>
								</header>
								<div class="block-content">
									<div class="form-group">
										<?php echo zen_draw_label( 'Products List Page Layout:', 'prodinfo_page_layout', 'class="col-sm-3 control-label"'); ?>
									  	<div class="col-sm-9 cont">
									  		<?php
											echo wt_neoncart_draw_radio( 'prodinfo_page_layout', array( 
												'1column' => array( 'label' => '1 Columns' ),
												'2columns-left' => array( 'label' => '2 Columns - Left' ),
												'2columns-right' => array( 'label' => '2 Columns - Right' ),
												'3columns' => array( 'label' => '3 Columns' ),
											), get_wt_neoncart_options( 'prodinfo_page_layout', '2columns-left' ) );
											?>
									  	</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Product Image Layout:', 'prod_img_layout', 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 cont">
											<?php 
											echo wt_neoncart_draw_radio( 'prod_img_layout', array( 
												'big' => array( 'label' => 'Big Size' ),
												'medium' => array( 'label' => 'Medium Size ( Default )' ),
												'small' => array( 'label' => 'Small Size' ),
											), get_wt_neoncart_options( 'prod_img_layout', 'medium' ) );
											?>
										</div>
									</div>
									<div class="form-group">
										<?php echo zen_draw_label( 'Product Image Effect:', 'prodinfo_image_effects', 'class="col-sm-3 control-label"'); ?>
										<div class="col-sm-9 cont">
											<?php 
											echo wt_neoncart_draw_radio( 'prodinfo_image_effects', array( 
												'default' => array( 'label' => 'Zencart Default', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_prod_imgs_styles' ) ),
												'elevatezoom' => array( 'label' => 'Elevate Zoom', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_prod_imgs_styles', 'data-target' => 'inner_sec_elevatezoom_styles' ) ),
												'fotorama' => array( 'label' => 'Fotorama Slider', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_prod_imgs_styles' ) ),
												'lightbox' => array( 'label' => 'Light Box', 'params' => array( 'class' => 'lnk_action', 'data-tarlnk' => 'inner_sec_prod_imgs_styles' ) ),
											), get_wt_neoncart_options( 'prodinfo_image_effects', 'default' ) );
											?>
										</div>
										<div id="inner_sec_elevatezoom_styles" class="inner_section inner_sec_prod_imgs_styles" style="<?php echo ( get_wt_neoncart_options( 'prodinfo_image_effects') == 'elevatezoom' )? 'display:block;' : 'display:none;'; ?>">
											<div class="rw">
												<div class="cont">
													<div class="rw_full">
														<div class="form-group">
															<?php echo zen_draw_label( 'Elevate Zoom Plus Style:', 'elevatezoom_style', 'class="col-sm-3 control-label"'); ?>
															<div class="col-sm-9 cont">
																<?php 
																echo wt_neoncart_draw_radio( 'elevatezoom_style', 
																array( 
																	'default' => array( 
																		'label' => 'Classic Horizontal ( Default )', 
																		'label_image' => wt_image( DIR_WS_INCLUDES . WT_NEONCART_TEMPLATE_INCLUDES . '/images/product-info-elevate-zoom-default.png', 'Classic Horizontal ( Default )' ), 
																		'li_class' => 'hm-layout ban-img-auto col-lg-6',
																	),
																), get_wt_neoncart_options( 'elevatezoom_style', 'default' ) );
																?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Product Configuration</label>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Short Description:', 'display_prod_short_desc', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_short_desc'); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Product Slider Configuration</label>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Model:', 'display_prod_info_model', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_info_model'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Ratings:', 'display_prod_pinfo_rattings', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_rattings'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Price:', 'display_prod_pinfo_price', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_price'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Addtocart Button:', 'display_prod_pinfo_addtocart', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_addtocart'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Quickview:', 'display_prod_pinfo_quickview', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_quickview'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Wishlist:', 'display_prod_pinfo_wishlist', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_wishlist'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Compare:', 'display_prod_pinfo_compare', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_compare'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display Sale Label:', 'display_prod_pinfo_salelabel', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_salelabel'); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Display New Label:', 'display_prod_pinfo_newlabel', 'class="col-sm-3 control-label"'); ?>
														<div class="col-sm-9 cont">
															<?php echo wt_neoncart_draw_yesnoradio('display_prod_pinfo_newlabel'); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="" class="inner_section">
											<div class="rw">
												<label>Products Slider</label>
												<?php $column_nums_ar =  array(
															1 => 1,
															2 => 2,
															3 => 3,
															4 => 4,
															5 => 5,
															6 => 6,
															7 => 7,
															8 => 8,
															); 
															?>
												<div class="rw_division block-content">
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns above 1400px', 'prodinfo_col_xxl', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_xxl', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_xxl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (1200px - 1400px)', 'prodinfo_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_xl', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_xl', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (992px - 1199px)', 'prodinfo_col_lg', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_lg', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_lg', 4 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (768px - 991px)', 'prodinfo_col_md', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_md', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_md', 3 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (576px - 767px)', 'prodinfo_col_sm', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_sm', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_sm', 2 ) ); ?>
														</div>
													</div>
													<div class="form-group">
														<?php echo zen_draw_label( 'Number of Columns within (480px - 575px)', 'prodinfo_col_xs', 'class="col-sm-5 control-label"'); ?>
														<div class="col-sm-7 col-md-2 cont">
															<?php echo wt_neoncart_draw_selectbox( 'prodinfo_col_xs', $column_nums_ar, get_wt_neoncart_options( 'prodinfo_col_xs', 2 ) ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<input type="hidden" name="frm_wt_set_submit" value="" />
					</form>
				</div>
            </div>
        </div>
        <footer>
			<?php if((!isset($_GET['botbeid'])) && (!isset($_GET['beid'])) && (!isset($_GET['slideshow_eid'])) && (!isset($_GET['action']))){ ?>
				<input type="button" class="md-btn btn btn-primary wt_save_settings" name="frm_wt_set_submit" value="Save Settings" />
			<?php } ?>
			<br/><br/>
			<div class="alert alert-danger">
            	<strong>Kindly Note : </strong>For any CSS changes in the template, please add your custom CSS in <strong>stylesheet_user_customcss.css</strong> file, which can be found under <strong>includes\templates\neoncart\css</strong> directory. Changes done in any other template defined CSS files may lost in future theme updates.
            </div>
        </footer>
   	 </div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$(".wt_save_settings").click(function(){
			$('.tab-content[style="display: block;"]').find('form[name="frm_wt"]').submit();
		});
	});
</script>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<script src="includes/<?php echo WT_NEONCART_TEMPLATE_INCLUDES ?>/js/jquery-ui.js" type="text/javascript"></script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php ob_flush(); ?>