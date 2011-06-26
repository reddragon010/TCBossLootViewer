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
}

?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>untitled</title>
		<meta name="generator" content="TextMate http://macromates.com/">
		<meta name="author" content="Michael Riedmann">
		<!-- Date: 2011-06-25 -->
	</head>
	<body>
		<div>
			<form action="index.php" method="get">
				<lable for="id">ID</lable>
				<input type="text" name="id" id="creature-id" <?php if(isset($creature_id)){echo 'value="'.$creature_id.'"';}?> />
				<input type="submit" name="submit" />
			</form>
		</div>
		<?php if(isset($creature)){ ?>
		<h1><?php echo $creature->name ?></h1>
		<table>
			<tr>
				<th>Entry</th>
				<th>Name</th>
				<th>Ref</th>
			</tr>
			<?php
		  foreach($creature->loot as $item){
			?>
			<tr>
				<td><?php echo $item->entry ?></td>
				<td><?php echo $item->name ?></td>
				<td><?php echo $item->ref ?></td>
			</tr>
			<?php
			}
			?>	
		</table>
		<?php } ?>
	</body>
	</html>
