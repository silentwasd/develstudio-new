<?

function iblockclass_sortlist_uasort($a, $b){
	
	//if (!is_array($a) && !is_object($a))
	$a1 = BlockData::toNormalType($a[$GLOBALS['iblockclass_sortlist_sort']]);
	
	//if (!is_array($b) && !is_object($b))
	$b1 = BlockData::toNormalType($b[$GLOBALS['iblockclass_sortlist_sort']]);
	
	
	if ($a1==$b1) return 0;
	
	if ($a1>$b1)
		return $GLOBALS['iblockclass_sortlist_order']=='desc' ? -1 : 1;
	else
		return $GLOBALS['iblockclass_sortlist_order']=='desc' ? 1 : -1;
}

class BlockData {
    
    
    static function toNormalType($value){
		
		if (is_numeric($value))
			return (float)$value;
		
		/*
		if (self::isDateTime($value)){
			return strtotime($value);
		}*/
		
		return (string)$value;
    }
    
    static function isDateTime($str){
		try {
		$tmp = new DateTime($str);
		} catch (Exception $e) {
			return false;
		}
		return true;
    }
    
    static function getItem($arr, $value, $name = 'ID'){
		if (!is_array($arr)) return false;
		
		foreach ($arr as $item){
			if ($item[$name] == $value) return $item;
		}
		
		return false;
    }
    
    static function getItems($arr, $value, $name = 'ID'){
		if (!is_array($arr)) return array();
		
		$result = array();
		foreach ($arr as $item){
			if ($item[$name] == $value) $result[]=$item;
		}
		
		return $result;
    }
    
    static function sortList(&$items, $sort, $order = 'asc'){
		$GLOBALS['iblockclass_sortlist_sort'] = $sort;
		$GLOBALS['iblockclass_sortlist_order'] = strtolower($order);
		usort($items, 'iblockclass_sortlist_uasort');
    }
}