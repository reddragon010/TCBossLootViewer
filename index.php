<?php
require_once('config.php');
require_once('classes/database.php');
require_once('classes/model.php');
require_once('classes/item.php');
require_once('classes/creature.php');

$db = Database::start();
if(isset($_GET['id'])){
	$creature_id = (int)$_GET['id'];	
	$creature = Creature::find($creature_id);
	$loot = $creature->loot;
	$hero_loot = $creature->hero_loot;
}

?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>TC-LootViewer <?php echo $creature->name ?></title>
		<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8">
		<!-- Wowhead Item Links -->
		<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<table>
			<tr>
			<td>
			<form action="index.php" method="get">
				<lable for="id">ID</lable>
				<input type="text" name="id" id="creature-id" <?php if(isset($creature_id)){echo 'value="'.$creature_id.'"';}?> />
				<input type="submit" name="submit" />
			</form>
			</td>
			</tr>
		</table>
		<?php if(isset($creature)){ ?>
		<table>
			<th><h1><?php echo $creature->name ?></h1></th>
		</table>
		
		<div style="width:50%;float:left">
		
		<table>
			<tr>
				<th colspan="4"><h2>Normal Loot</h2></th>
			</tr>
			<tr>
				<th>Entry</th>
				<th>Name</th>
				<th>Ref</th>
				<th>Drop</th>
			</tr>
			<?php
		  for($i=0;$i<count($loot);$i++){
			$item = $loot[$i];
			$class = ($i % 2 == 0) ? ' class="alt" ' : ''; 
			?>
			<tr>
				<td<?php echo $class ?>><a href="#" rel="item=<?php echo $item->entry ?>"><?php echo $item->entry ?></a></td>
				<td<?php echo $class ?>><?php echo $item->name ?></td>
				<td<?php echo $class ?>><?php echo $item->ref ?></td>
				<td<?php echo $class ?>><?php echo $item->drop_chance ?></td>
			</tr>
			<?php
			}
			?>	
		</table>
		</div>
		
		<div style="width:50%; float:left">
		<table>
			<tr>
				<th colspan="4"><h2>Hero Loot</h2></th>
			</tr>
			<tr>
				<th>Entry</th>
				<th>Name</th>
				<th>Ref</th>
				<th>Drop</th>
			</tr>
			<?php
		  for($i=0;$i<count($hero_loot);$i++){
			$item = $loot[$i];
			$class = ($i % 2 == 0) ? ' class="alt" ' : '';
			?>
			<tr>
				<td<?php echo $class ?>><a href="#" rel="item=<?php echo $item->entry ?>"><?php echo $item->entry ?></a></td>
				<td<?php echo $class ?>><?php echo $item->name ?></td>
				<td<?php echo $class ?>><?php echo $item->ref ?></td>
				<td<?php echo $class ?>><?php echo $item->drop_chance ?></td>
			</tr>
			<?php
			}
			?>	
		</table>
		</div>
		<?php } ?>
		<div style="clear: both; padding: 20px; width: 100%; text-align: center">
		Idea & Code By Norseman & Robigo At <a href="http://rising-gods.de">Rising-Gods</a>
		</div>
		</div>
	</body>
	</html>
