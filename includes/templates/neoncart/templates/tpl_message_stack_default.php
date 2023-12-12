<?php
/**
 * Page Template
 *
 * Loaded by messageStack system to display error/caution messages as needed
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Jul 10 Modified in v1.5.8-alpha $
 */
?>
<?php for ($i=0, $n=sizeof($output); $i<$n; $i++) { ?>
	<?php
	$msg_pera='';
	if(strpos($output[$i]['params'],'messageStackError')>0){
		$msg_pera=str_replace('messageStackError','alert alert-message alert-danger alert-dismissable',$output[$i]['params']);
	}else if(strpos($output[$i]['params'],'messageStackWarning')>0){
		$msg_pera=str_replace('messageStackWarning','alert alert-message alert-warning alert-dismissable',$output[$i]['params']);
	}else if(strpos($output[$i]['params'],'messageStackSuccess')>0){
		$msg_pera=str_replace('messageStackSuccess','alert alert-message alert-success alert-dismissable',$output[$i]['params']);
	}else if(strpos($output[$i]['params'],'messageStackCaution')>0){
		$msg_pera=str_replace('messageStackCaution','alert alert-message alert-warning alert-dismissable',$output[$i]['params']);
	}else{
		$msg_pera=str_replace('messageStackCaution','alert alert-message alert-info alert-dismissable',$output[$i]['params']);
	}
	?>
	<div <?php echo $msg_pera; ?>><?php echo $output[$i]['text']; ?><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button></div>
<?php } ?>