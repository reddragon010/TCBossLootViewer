<?php
require_once('config.php');
require_once('classes/database.php');
require_once('classes/model.php');
require_once('classes/item.php');
require_once('classes/boss.php');

$db = Database::start();
if(isset($_GET['id'])){
	$boss_id = (int)$_GET['id'];
} else {
	die("No Boss-ID given!");
}

$boss = Boss::find($boss_id);
$boss_name = $boss->name;
$loot = $boss->loot;

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
		<h1><?php echo $boss_name ?></h1>
		<table>
			<tr>
				<th>Entry</th>
				<th>Name</th>
				<th>Ref</th>
			</tr>
			<?php
		  foreach($loot as $item){
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
	</body>
	</html>
