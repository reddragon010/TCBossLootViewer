<?php

/**
* 
*/
class Creature extends Model
{
	private $loot_list;
	
	public static function find($entry){
		$sql = "SELECT entry, difficulty_entry_1 as hero_entry, name from creature_template where entry =".$entry.";";
		$result = Database::query($sql)->fetch();
		if(!empty($result)){
			return new Creature($result);
		}
	}
	
	public function get_loot(){
		$loot = array();
		$referances = array();
		
		//direct loot
		$sql = "SELECT creature_loot_template.item as entry, 0 as ref, ChanceOrQuestChance as drop_chance, name FROM creature_loot_template INNER JOIN item_template ON (creature_loot_template.item = item_template.entry)  WHERE creature_loot_template.entry = (SELECT lootid FROM creature_template WHERE entry = {$this->entry} AND mincountorref > 0);";
		$d_items = Database::query($sql)->fetchAll(PDO::FETCH_CLASS, 'Item');
		if(count($d_items) > 0){
			$loot = array_merge($loot, $d_items);
		}
		
		//referances
		$sql = "SELECT ABS(mincountorref) as refid, ChanceOrQuestChance as drop_chance FROM `creature_loot_template` WHERE entry IN(SELECT `lootid` FROM `creature_template` WHERE entry = {$this->entry} AND mincountorref < 0);";
		$referances = Database::query($sql)->fetchAll();

		//referanced loot
		foreach($referances as $ref){
			$ref_id = $ref['refid'];
			$dropchance = $ref['drop_chance'];
    	$sql = "SELECT item_template.entry as entry, item_template.name as name, ((ChanceOrQuestChance / 100) * ($dropchance / 100) * 100) as drop_chance, reference_loot_template.entry as ref FROM `reference_loot_template` INNER JOIN item_template ON (reference_loot_template.item = item_template.entry) WHERE reference_loot_template.entry = (".($ref_id).");";
			//echo($sql . "<br />");
			$result = Database::query($sql);
			$items = $result->fetchAll(PDO::FETCH_CLASS, 'Item');
			$loot = array_merge($loot, $items);
		}
		$this->loot_list = $loot;
		return $loot;
	}
	
}
