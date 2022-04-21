<?php
	include 'auth_header.html.php';
	include 'sql.php';

	$_REQUEST['UUID'] = strtoupper($_REQUEST['UUID']);
	$_SESSION['admin_output'] = array();

	if(!empty($_REQUEST['new_player_name']) & !empty($_REQUEST['new_player_division'])) {
		// New player request
		$UUID = strtoupper(substr(hash('sha512', $_REQUEST['new_player_name']), 0, 6));
		executeSQL("INSERT INTO game_records (UUID, name, elo, division, championships, career_wins, career_losses) VALUES (\"" . $UUID . "\", \"" . $_REQUEST['new_player_name']  . "\", \"0\", \"". strtoupper($_REQUEST['new_player_division']) . "\", \"0\", \"0\", \"0\");", false);
		executeSQL("INSERT INTO divisions", false);
	}

	if (!empty($_REQUEST['name_change'])) {
		// User requested a name change
		$originalName = executeSQL("SELECT name FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
    	executeSQL("UPDATE game_records SET name=\"" . $_REQUEST['name_change'] . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	if (!empty($_REQUEST['elo_change'])) {
		// User requested an elo change
		$originalElo = executeSQL("SELECT elo FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
		executeSQL("UPDATE game_records SET elo=\"" . ($originalElo + $_REQUEST['elo_change']) . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	if (!empty($_REQUEST['division_change'])) {
		/* User requested a division change */

		// Remove player from original division
		$originalDivision = executeSQL("SELECT division FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
		$rawCellData = executeSQL("SELECT members FROM divisions WHERE name=\"" . $originalDivision . "\"", true)[0][0];
		if (substr($rawCellData, 0, 1) != "[" | substr($rawCellData, -1, 1) != "]") {
			// Empty members array - set proper JSON format
			executeSQL("UPDATE divisions SET members=\"[]\" WHERE name=\"" . $originalDivision . "\";", false);
		} else {
			$memberArray = json_decode($rawCellData);
			if(($key = array_search($_REQUEST['UUID'], $memberArray)) !== false) {
			    unset($memberArray[$key]);
			}

			// Push updated array to database
			$jsonArray = json_encode($memberArray);
			$sanitizedJSON = addslashes($jsonArray);
			executeSQL("UPDATE divisions SET members=\"" . $sanitizedJSON . "\" WHERE name=\"" . $originalDivision . "\";", false);
		}

		$rawCellData = executeSQL("SELECT members FROM divisions WHERE name=\"" . $_REQUEST['division_change'] . "\"", true)[0][0];
		if (substr($rawCellData, 0, 1) != "[" | substr($rawCellData, -1, 1) != "]") {
			// Empty members array - set proper JSON format
			executeSQL("UPDATE divisions SET members=\"[]\" WHERE name=\"" . $_REQUEST['division_change'] . "\";", false);
		} else {
			// Add player to new division
			$memberArray = json_decode($rawCellData);
			array_push($memberArray, $_REQUEST['UUID']);

			// Push updated array to database
			$jsonArray = json_encode($memberArray);
			$sanitizedJSON = addslashes($jsonArray);
			executeSQL("UPDATE divisions SET members=\"" . $sanitizedJSON . "\" WHERE name=\"" . $_REQUEST['division_change'] . "\";", false);
		}
		
		// Update user's record
		executeSQL("UPDATE game_records SET division=\"" . $_REQUEST['division_change'] . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	if (!empty($_REQUEST['championship_change'])) {
		// User requested a championship change
		$originalChampionships = executeSQL("SELECT championships FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
		executeSQL("UPDATE game_records SET championships=\"" . ($originalChampionships + $_REQUEST['championship_change']) . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	if (!empty($_REQUEST['career_wins_change'])) {
		// User requested a career wins change
		$originalCareerWins = executeSQL("SELECT career_wins FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
    	executeSQL("UPDATE game_records SET career_wins=\"" . ($originalCareerWins + $_REQUEST['career_wins_change']) . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	if (!empty($_REQUEST['career_losses_change'])) {
		// User requested a career losses change
		$originalCareerLosses = executeSQL("SELECT career_losses FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
    	executeSQL("UPDATE game_records SET career_losses=\"" . ($originalCareerLosses + $_REQUEST['career_losses_change']) . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}

	// IMPORTANT
	// Remove the /headsoccer from the beginning of the headers before putting this on the server
	// IMPORTANT
	header("Location:/headsoccer/pages/player_administration.html.php");

	function changeDivision($divisionUUID, $playerUUID) 
	{
		// Remove player from original division
		$originalDivision = executeSQL("SELECT division FROM game_records WHERE UUID=\"" . $_REQUEST['UUID'] . "\"", true)[0][0];
		if (!empty($originalDivision)) {
			$rawCellData = executeSQL("SELECT members FROM divisions WHERE name=\"" . $originalDivision . "\"", true)[0][0];
			if (substr($rawCellData, 0, 1) != "[" | substr($rawCellData, -1, 1) != "]") {
				// Empty members array - set proper JSON format
				executeSQL("UPDATE divisions SET members=\"[]\" WHERE name=\"" . $originalDivision . "\";", false);
			} else {
				$memberArray = json_decode($rawCellData);
				if(($key = array_search($_REQUEST['UUID'], $memberArray)) !== false) {
				    unset($memberArray[$key]);
				}

				// Push updated array to database
				$jsonArray = json_encode($memberArray);
				$sanitizedJSON = addslashes($jsonArray);
				executeSQL("UPDATE divisions SET members=\"" . $sanitizedJSON . "\" WHERE name=\"" . $originalDivision . "\";", false);
			}
		}

		$rawCellData = executeSQL("SELECT members FROM divisions WHERE name=\"" . $_REQUEST['division_change'] . "\"", true)[0][0];
		if (substr($rawCellData, 0, 1) != "[" | substr($rawCellData, -1, 1) != "]") {
			// Empty members array - set proper JSON format
			executeSQL("UPDATE divisions SET members=\"[]\" WHERE name=\"" . $_REQUEST['division_change'] . "\";", false);
		} else {
			// Add player to new division
			$memberArray = json_decode($rawCellData);
			array_push($memberArray, $_REQUEST['UUID']);

			// Push updated array to database
			$jsonArray = json_encode($memberArray);
			$sanitizedJSON = addslashes($jsonArray);
			executeSQL("UPDATE divisions SET members=\"" . $sanitizedJSON . "\" WHERE name=\"" . $_REQUEST['division_change'] . "\";", false);
		}
		
		// Update user's record
		executeSQL("UPDATE game_records SET division=\"" . $_REQUEST['division_change'] . "\" WHERE UUID=\"" . $_REQUEST['UUID'] . "\";", false);
	}
?>