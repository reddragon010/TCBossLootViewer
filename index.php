<?php
ini_set('display_errors', ON);
error_reporting(E_ALL);


require_once('config.php');
require_once('classes/database.php');
require_once('classes/model.php');
require_once('classes/item.php');
require_once('classes/creature.php');
require_once('classes/template.php');

$db = Database::start();
if(isset($_GET['id'])){
	$creature_id = (int)$_GET['id'];	
	$creature = Creature::find($creature_id);
	if($creature){
		$loot = $creature->loot;
		$hero_loot = $creature->hero_loot;
	} else {
		$message = "No Creature With ID $creature_id Found!";
	}
	echo Template::render('head', array('creature' => $creature, 'creature_id' => $creature_id));
} else {
	echo Template::render('head');
}
?>	
	<?php if(isset($message)){ ?>
		<div id="message"><?php echo $message ?></div>
	<?php } ?>
		
	<?php if(isset($creature) && $creature){ ?>
		<table>
			<tr><th><h1><?php echo $creature->name ?></h1>(NormalID: <?php echo $creature->entry ?> / HeroID: <?php echo $creature->hero_entry?>)</th></tr>
		</table>
		
		<?php if(isset($loot) && !empty($loot)){ ?>
		<div id="loot">
			<table><tr><th><h2>Normal Loot</h2></th></tr></table>
			<?php 
				echo Template::render('loot_table', array('title' => 'Local Loot', 'loot' => $loot['local'])); 
				foreach($loot['ref'] as $refid=>$ref){
					echo Template::render('loot_table', array('title' => "Ref #$refid Loot", 'ref' => $ref, 'loot' => $ref['items']));
				}
			?>
		</div>
		<?php } ?>
		
		<?php if(isset($hero_loot) && !empty($hero_loot)){ ?>
		<div id="hero_loot">
			<table><tr><th><h2>Hero Loot</h2></th></tr></table>
			<?php 
				echo Template::render('loot_table', array('title' => 'Local Loot', 'loot' => $hero_loot['local']));
				foreach($hero_loot['ref'] as $refid=>$ref){
					echo Template::render('loot_table', array('title' => "Ref #$refid Loot", 'ref' => $ref, 'loot' => $ref['items']));
				}
			?>
		</div>
		<?php } ?>
	<?php } ?>
	
<?php Template::render('foot'); ?>
