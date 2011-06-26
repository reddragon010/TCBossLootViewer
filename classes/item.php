<?php

/**
* 
*/
class Item  extends Model
{
	function find_many($ids, $ref=null, $drop_chances=null){
		array_walk($ids, array('Item', 'add_quotes'));
		$ids_string = implode($ids,',');
		$sql = "SELECT entry, name FROM item_template WHERE entry IN (".$ids_string.");";
		$result = Database::query($sql);
		if(!empty($result)){
			$items = array();
			$i = 0;
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				if(is_numeric($ref)){
					$row['ref'] = $ref;
				} else {
					$row['ref'] = 0;
				}
				if(isset($drop_chances[$i]) && is_numeric($drop_chances[$i])){
					$row['drop_chance'] = $drop_chances[$i];
				} else {
					$row['drop_chance'] = '';
				}
				$items[] = new Item($row);
				$i++;
			}
			return $items;
		}
	}
	
	static function add_quotes(&$id){
		$id = "'" . $id . "'";
	}
}
