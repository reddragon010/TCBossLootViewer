<?php

class Creature extends Model
{	
	public static function find($entry){
		$sql = "SELECT entry, difficulty_entry_1 as hero_entry, name from creature_template where entry =".$entry.";";
		$result = Database::query($sql)->fetch();
		if(!empty($result)){
			return new Creature($result);
		}
	}
	
	public function get_loot($entry=null){
		if(is_null($entry)){
			$entry = $this->entry;
		}
		$d_loot = $this->find_direct_loot($entry);
		$r_loot = $this->find_ref_loot($entry);
		return array('local' => $d_loot, 'ref' => $r_loot);
	}
	
	public function get_hero_loot(){
		if($this->hero_entry != 0){
			return $this->get_loot($this->hero_entry);
		} else {
			return array();
		}
	}
	
	private function find_ref_loot($entry){
		$loot = array();
		$referances = array();
		//referances
		$sql = "SELECT ABS(mincountorref) as refid, ChanceOrQuestChance as chance, lootmode, groupid, maxcount FROM `creature_loot_template` WHERE entry IN(SELECT `lootid` FROM `creature_template` WHERE entry = {$entry} AND mincountorref < 0);";
		$referances = Database::query($sql)->fetchAll();

		//referanced loot
		foreach($referances as $ref){
			$ref_id = $ref['refid'];
			
     	$sql = "SELECT item_template.entry as entry, reference_loot_template.maxcount, ChanceOrQuestChance as chance, name, icon, lootmode, groupid, reference_loot_template.entry as ref FROM reference_loot_template INNER JOIN item_template ON (reference_loot_template.item = item_template.entry) LEFT JOIN item_icon ON (reference_loot_template.item = item_icon.entry) WHERE reference_loot_template.entry = (".($ref_id).");";
			//echo($sql . "<br />");
			$result = Database::query($sql);
			$items = $result->fetchAll(PDO::FETCH_CLASS, 'Item');
			$loot[$ref_id] = $ref;
			$loot[$ref_id]['items'] = $items;
		}
		return $loot;
	}
	
	private function find_direct_loot($entry){
		$d_items  = array();
			$sql = "SELECT item_template.entry as entry, creature_loot_template.maxcount, ChanceOrQuestChance as chance, name, icon, lootmode, groupid, creature_loot_template.item as ref FROM creature_loot_template INNER JOIN item_template ON (creature_loot_template.item = item_template.entry) LEFT JOIN item_icon ON (creature_loot_template.item = item_icon.entry) WHERE creature_loot_template.entry = (SELECT lootid FROM creature_template WHERE entry = $entry AND mincountorref > 0);";
		$items = Database::query($sql)->fetchAll(PDO::FETCH_CLASS, 'Item');
		if($items){
			$d_items = $items;
		}
		return $d_items;
	}
	
}
