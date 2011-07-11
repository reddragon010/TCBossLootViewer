<table><tr><th><h3><?php echo $title ?> <?php if(isset($ref)){ ?>(Mode: <?php echo $ref['lootmode'] ?> / Group: <?php echo $ref['groupid'] ?> / Chance: <?php echo $ref['chance'] ?>%)<?php } ?></h3></th></tr></table>
<table class="loot_table">
	<thead>
	<tr>
		<th></th>
		<th>Id</th>
		<th>Ref</th>
		<th>Name</th>
		<th>Mode</th>
		<th>Group</th>
		<th>Max</th>
		<th>%</th>
	</tr>
	</thead>
	<tbody>
	<?php
  for($i=0;$i<count($loot);$i++){
	$item = $loot[$i];
	$class = ($i % 2 == 0) ? ' class="alt" ' : ''; 
	?>
	<tr>
		<td><a rel="item=<?php echo $item->entry ?>"><img class="wowicon" src="<?php echo $config['wowimages_url'] . strtolower($item->icon) . $config['wowimages_ext']; ?>" /></a></td>
		<td<?php echo $class ?> style="min-width: 40px"><a rel="item=<?php echo $item->entry ?>"><?php echo $item->entry ?></a></td>
		<td<?php echo $class ?> style="min-width: 40px"><?php echo $item->ref ?></td>
		<td<?php echo $class ?> style="width: 100%"><?php echo $item->name ?></td>
		<td<?php echo $class ?> style="min-width: 20px"><?php echo $item->lootmode ?></td>
		<td<?php echo $class ?> style="min-width: 20px"><?php echo $item->groupid ?></th>
		<td<?php echo $class ?> style="min-width: 20px"><?php echo $item->maxcount ?></th>
		<td<?php echo $class ?> style="min-width: 20px"><?php echo $item->chance ?>%</td>
	</tr>
	<?php
	}
	?>	
	</tbody>
</table>