<?php
/**
 * WT AjxCompare for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT AjxCompare 1.0
 */
class zcAjaxWTAjxInstantSearch extends base
{
    public function ajxSearch(){
        global $db, $zco_notifier, $currencies;
		
		$zco_notifier->notify('NOTIFY_HEADER_START_WT_AJX_INSTANT_SEARCH');
		
		define( 'MAX_DISPLAY_SEARCH_RESULTS_INSTANT_SEARCH', 6 );
		
		//this gets the word we are searching for. Usually from instantSearch.js.
		$wordSearch = (isset($_POST['query']) ? $_POST['query'] : '');

		// we place or results into these arrays
		//$results will hold data that has the search term in the begining of the word. This will yield a better search result but the number of results will be a few.
		//$resultsAddAfter will hold data that has the search term anywhere in the word. This will yield a normal search result but the number of results will be a high.
		//$results has first priority over $resultsAddAfter
		$results=array();
		$resultsAddAfter=array();
		$prodResult;


		//the search word can not be empty
		if (strlen($wordSearch) > 0) {
			
			//if the user enters less than 2 characters we would like match search results that beging with these characters
			//if the characters are greater than 2 then we would like to broaden our search results
			if (strlen($wordSearch) <= 2) {
				$wordSearchPlus =  $wordSearch . "%";
			}else{
				$wordSearchPlus =  "%" . $wordSearch . "%";
			}
			
			$max_display_columns = MAX_DISPLAY_SEARCH_RESULTS_INSTANT_SEARCH;
			
			
			//first we would like to search for products that match our search word
			//we then order the search results with respect to the keyword found at the begining of each of the results
			$sqlProduct = "SELECT pd.products_name, p.products_model, pd.products_id, p.products_image, p.products_tax_class_id, p.products_price, p.products_status FROM " . TABLE_PRODUCTS_DESCRIPTION . " as pd , " . TABLE_PRODUCTS . " as p
				WHERE p.products_id = pd.products_id
					AND p.products_status <> 0
					AND ((pd.products_name LIKE :wordSearchPlus:) OR (p.products_model LIKE :wordSearchPlus:)  OR (LEFT(pd.products_name,LENGTH(:wordSearch:)) SOUNDS LIKE :wordSearch:))
					AND language_id = '" . (int)$_SESSION['languages_id'] . "'
				ORDER BY 
					field(LEFT(pd.products_name,LENGTH(:wordSearch:)), :wordSearch:) DESC,
					pd.products_viewed DESC";
								
			//this protects use from sql injection - i think????
			$sqlProduct = $db->bindVars($sqlProduct, ':wordSearch:', $wordSearch, 'string');
			$sqlProduct = $db->bindVars($sqlProduct, ':wordSearchPlus:', $wordSearchPlus, 'string');


			$dbProducts = $db->Execute($sqlProduct, $max_display_columns);
			
			//this takes each item that was found in the results and places it into 2 separate arrays
			if ($dbProducts->RecordCount() > 0) {
			  while (!$dbProducts->EOF) {
				$prodResult = strip_tags($dbProducts->fields['products_name']);
				$products_model = $dbProducts->fields['products_model'];
				
				if (strtolower(substr($prodResult,0,strlen($wordSearch))) == strtolower($wordSearch)){
					$results[] = array(
						//we have 4 seperate variables that will be passed on to instantSearch.js
						//'q' is the result thats been found
						//'c' is the number of item within a category search (we leave this empty for product search, look at the example bellow for category search)
						//'l' is used for creating a link to the product or category
						//'pc' lets us know if the word found is a product or a category
						//'pr' for the price of product
						//'img' gets the image of product/category
						'q'=>$prodResult,
						'c'=>zen_get_products_display_price($dbProducts->fields['products_id']),
						'l'=>$dbProducts->fields['products_id'],
						'pc'=>"p",
						'pr'=>"",
						'pm'=> (($products_model !='') ? '<span class="product-model">'.TEXT_PRODUCT_MODEL . '<strong>'.$products_model.'</strong></span>' : ''),
						'img'=>zen_image(DIR_WS_IMAGES . strip_tags($dbProducts->fields['products_image']), strip_tags($dbProducts->fields['products_name']), IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT)
					);
				}else{
					$resultsAddAfter[] = array(
						'q'=>$prodResult,
						'c'=>zen_get_products_display_price($dbProducts->fields['products_id']),
						'l'=>$dbProducts->fields['products_id'],
						'pc'=>"p",
						'pr'=>"",
						'pm'=> (($products_model !='') ? '<span class="product-model">'.TEXT_PRODUCT_MODEL . '<strong>'.$products_model.'</strong></span>' : ''),
						'img'=>zen_image(DIR_WS_IMAGES . strip_tags($dbProducts->fields['products_image']), strip_tags($dbProducts->fields['products_name']), IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT)
					);	
				}
				
				$dbProducts->MoveNext();
			  }
			}
			
		}

		//we now re-sort the results so that $results has first priority over $resultsAddAfter
		foreach ($resultsAddAfter as &$value) {
			$results[] = array(
				'q'=>$value["q"],
				'c'=>$value["c"],
				'l'=>$value["l"],
				'pc'=>$value["pc"],
				'pm'=>$value["pm"],
				'img'=>$value['img']
			);
		}

		unset($value);
		
		//the results are now passed onto instantSearch.js
		return $results;
		
		$zco_notifier->notify('NOTIFY_HEADER_END_WT_AJX_INSTANT_SEARCH');
    }

}
