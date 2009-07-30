<?php
class JewelShowController extends BaseController2 {
	public $function;
	const picsPerPage = 4;
		
	public function handle() {
 		include DOCPATH.'mdl/Show.class.php';
 		include DOCPATH.'mdl/Item.class.php';
 		include DOCPATH.'jewel/DbManager.class.php';
 		include DOCPATH.'jewel/ShowDataManager.class.php';
 
 		$mgr = new ShowDataManager;
		$show = $mgr->getShow($this->site, self::picsPerPage);
 		
		// Did we get here from a next/prev link?
		if ( isset($_GET['page']) ) {
			$thisPage = (int) $_GET['page'];
		} else {
			$thisPage = 1;
		}
		
		$firstPicNumForPage = (($thisPage - 1) * $show->perPage);
		$endi = $firstPicNumForPage + $show->perPage;
		$endi = $endi < sizeof($show->items) ? $endi : sizeof($show->items);
		for ($i = $firstPicNumForPage; $i < $endi; $i++) {
			$mgr->populateItem( $show->items[$i] );
		}
		
		$tpl = $this->template;
		$tpl->authorized = $this->authorized();
		$tpl->site = $this->site;
		$tpl->show = $show;
		
		$tpl->pageUrl = $_SERVER['PHP_SELF'];
		$tpl->thisPage = $thisPage;
		
		$tpl->firstPicNumForPage = $firstPicNumForPage;
 		
		return $tpl;
	}
	
}
?>