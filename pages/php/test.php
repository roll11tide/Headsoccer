<input type=button value=Use onclick=changeMatchUUID("123ABC") />
<?php
	include 'sql.php';
	include 'elo.php';
	echo "<input type=\"button\" value=\"Use\" onclick=\"changeMatchUUID(\"" . "123ABC" . "\")\" />";
	echo "<input type=button value=Use onclick=changeMatchUUID(\"123ABC\") />"

	//resetElo(1000);
	
	function resetElo($elo) {
		$allPlayers = executeSQL("SELECT * FROM game_records", true);
		foreach ($allPlayers as $key => $value) {
			print_r($value);
			echo "<br>";
			executeSQL("UPDATE game_records SET elo=\"" . $elo . "\" WHERE UUID=\"" . $value[0] . "\"", false);
		}
	}
?>