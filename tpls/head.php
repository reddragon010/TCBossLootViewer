<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>TC-LootViewer <?php if(isset($creature)) echo $creature->name; ?></title>
	<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8">
	<!-- Wowhead Item Links -->
	<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="jquery.tablesorter.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".loot_table").tablesorter();
		$("#hero_loot_table").tablesorter();
	})
	</script>
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