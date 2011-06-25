<?php

/**
* 
*/
class Boss extends Model
{
	private $loot_list;
	
	public static function find($entry_or_name){
		if(is_numeric($entry_or_name)){
			$sql = "SELECT entry, difficulty_entry_1 as hero_entry, name from creature_template where entry =".$entry_or_name.";";
		} else {
			$sql = "SELECT entry, difficulty_entry_1 as hero_entry, name from creature_template where entry =".$entry_or_name.";";
		}
		$result = Database::query($sql)->fetch();
		if(!empty($result)){
			return new Boss($result);
		}
	}
	
	
	public function get_loot(){
		$loot = array();
		$referances = array();
		
		//direct loot
		$sql = "SELECT entry, name FROM item_template WHERE entry IN (SELECT item from creature_loot_template WHERE entry = (SELECT lootid FROM creature_template WHERE entry = {$this->entry}));";
		$result = Database::query($sql);
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$row['ref'] = 0;
			$loot[] = new Item($row);
		}
		
		//referances
		$sql = "SELECT mincountorref FROM `creature_loot_template` WHERE entry IN
		(SELECT `lootid` FROM `creature_template` WHERE entry = ".$this->entry." AND mincountorref < 0);";
		$ref_result = Database::query($sql);
		while($row = $ref_result->fetch(PDO::FETCH_ASSOC)){
			$referances[] = $row;
		}
		$referances = array_unique($referances);
		//referanced loot
		foreach($referances as $ref){
			$ref_id = (int)$ref['mincountorref'];
    	$sql = "SELECT entry, name FROM item_template WHERE entry IN (SELECT item FROM `reference_loot_template` WHERE entry IN (".(-1 * $ref_id)."));";
			$result = Database::query($sql);
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$row['ref'] = $ref_id;
				$loot[] = new Item($row);
			}
		}
		
		$this->loot_list = $loot;
		return $loot;
	}
	
}
