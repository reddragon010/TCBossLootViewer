<?php
$entry = "31125";
    $mysqlhost="localhost"; // MySQL-Host angeben

    $mysqluser="root"; // MySQL-User angeben

    $mysqlpwd=""; // Passwort angeben
        $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");
    
        $mysqldb="world"; // Gewuenschte Datenbank angeben

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht waehlen.");
	
$sql = "SELECT difficulty_entry_1 from creature_template where entry =".$entry.";";
$hero_entry = mysql_query($sql) or die("Anfrage nicht erfolgreich");
echo $hero_entry;
echo "<br><br>";
echo $sql;
echo "<br><br>";
	
	
	

$sql = "SELECT name FROM item_template WHERE entry IN (
	SELECT item from creature_loot_template WHERE entry = 
	(SELECT lootid FROM creature_template WHERE entry = ".$entry."));";

$creature_loot_template = mysql_query($sql) or die("Anfrage nicht erfolgreich");

echo "Loot aus creature_loot_template:<br><br>";
    while ($loot = mysql_fetch_array($creature_loot_template)){

    echo $loot['name'];
    echo "<br>";

    }
echo "<br><br>";
$sql = "SELECT mincountorref FROM `creature_loot_template` WHERE entry IN
(SELECT `lootid` FROM `creature_template` WHERE entry = ".$entry." AND mincountorref < 0);";
$reverence_loot_template = mysql_query($sql) or die("Anfrage nicht erfolgreich");  

echo "Loot aus reverence_loot_template:<br><br>";
    while ($loot = mysql_fetch_array($reverence_loot_template)){


    $variable = (-1 * $loot['mincountorref'] );
    $sql = "select entry, name from item_template where entry in (
select item from `reference_loot_template` where entry IN (".$variable."));";

$reverence_loot_template_items = mysql_query($sql) or die("Anfrage nicht erfolgreich");
 while ($loot = mysql_fetch_array($reverence_loot_template_items)){

    echo $loot['name'];
    echo "<br>";

    }
    echo "<br>";

    }


?>

