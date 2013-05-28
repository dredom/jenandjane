<?php
/**
 * Manages the data acquizition for the standard jewelry picture show.
 * 2009-01
 */
class ShowDataManager extends DbManager {
	const VERSION = '2';
	const IMG_URL = '/img/';

	const SQL_SELECT_ITEM = 
		'SELECT pd.description, po.seq, po.optiontype, po.value, po.price
		  FROM product p
		  LEFT JOIN productdata pd
		    ON pd.productid = p.id
		  LEFT JOIN productoption po
		    ON po.productid = pd.productid
		   AND po.productid = p.id
		 WHERE p.id = :productid
		 ORDER BY po.seq ';
	private $stmtselectitem;
 
	/**
	 * Return the Show, which handles the paging.
	 * Checks cache, if none creates new Show with no items.
	 * @param $site directory segment
	 * @param $picsPerPage
	 * @return Show
	 */
	public function getShow($site, $picsPerPage) {
		$siteShow = $site.'-show'.self::VERSION;

		$show = Cacher::get($siteShow);
		if (!isset($show)) {
			$imagesConfig = DOCPATH.'jewel/'.$site.'/images.config';
			$items = $this->getShowItems($imagesConfig);
		   	$show = new Show($items, $picsPerPage );
		   	Cacher::set($siteShow, $show);
		}
		 
		return $show;
	} 
	
	/**
	 * Return an array of Items for the config, partially populated.
	 * @param $imagesConfig
	 * @return unknown_type
	 */
	public function getShowItems($imagesConfig) {
		$items = array();
		include 'show.config.php';	// $config
		foreach ($config as $id => $code) {
	      	$item = new Item($id, $code);
	      	$item->imageSmallUrl = self::IMG_URL.$code.'-sml.jpg';
	      	$item->imageLargeUrl = self::IMG_URL.$code.'-lrg.jpg';
	      	$items[] = $item;	// add
		}

	    reset($items);         // start
	    return $items;
	}
	
	/**
	 * Populate Item with description, price, etc.
	 * @param $item
	 * @return unknown_type
	 */
	public function populateItem(Item &$item) {
		if (isset($item->description)) {
			return;
		}
		if ($item->id == null) {
			return;
		}
		$stmt = $this->getStmtSelectItem($item);
		$stmt->bindParam(':productid', $item->id, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$itemView = $stmt->fetchObject('ItemView');
			$item->description = $itemView->description;
			$options = array();
			do {
				if ($itemView->seq != null) {
					$options[] = $itemView;
				}
				$itemView = $stmt->fetchObject('ItemView');
			} while ($itemView != null);
			$stmt->closeCursor();
			$item->options = $options;
		} else {
			Logger::error($stmt->errorInfo());
		}
	}

	private function getStmtSelectItem($item) {
		if (!$this->stmtselectitem) {
			$this->stmtselectitem = $this->getPdo()->prepare(self::SQL_SELECT_ITEM);
		}
		return $this->stmtselectitem;		
	}
	
	public static function clearShowCache($site) {
		$siteShow = $site.'-show'.self::VERSION;
		Cacher::delete($siteShow);
	}
}

class ItemView {
	public $description;
	public $seq;
	public $option;
	public $value;
	public $price;
}
?>