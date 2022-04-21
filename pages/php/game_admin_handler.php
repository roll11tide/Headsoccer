<?php
	include 'auth_header.html.php';
	include 'sql.php';

	if(isset($_REQUEST['confirm_repairing']) && !empty($_REQUEST['confirm_repairing'] && $_REQUEST['confirm_repairing'] == "confirm")) {
		// Generate pairings
		$divisionInfo = executeSQL("SELECT UUID, members FROM divisions", true);

		// Empty table of all existing matches
		executeSQL("TRUNCATE division_matches", false);
		
		// Looping through divisions
		foreach ($divisionInfo as $index => $division) {
			// Now looping through info
			// The 0 index of $division is the division UUID
			// The 1 index of $division is the JSON player array

			foreach ($division as $UUID => $members) {
				// The UUID property had the index attached to it for some weird reason, probably because it is an array
				$UUID = $division[0];
				// Forgot to deserialize JSON array
				$members = json_decode($members);

				// Checking the second index ensures there are at least two people in the division
				if (!empty($members[1])) {
					foreach ($members as $index1 => $member1) {
						// Remove player from list so as not to make match with himself
						unset($members[$index1]);

						// Go through remaining players
						foreach ($members as $index2 => $member2) {
							$match_UUID = strtoupper(substr(hash('sha512', $member1 . $member2), 0, 6));
							executeSQL("INSERT INTO division_matches (match_UUID, division_UUID, player1_UUID, player2_UUID, winner) VALUES (\"" . $match_UUID . "\", \"" . $UUID . "\", \"". $member1 . "\", \"" . $member2 . "\", \"TBT\");", false);
						}
					}
				}
				
			}
		}
	}

	if(!empty($_REQUEST['enter_match']) & !empty($_REQUEST['match_UUID']) & !empty($_REQUEST['winner_dropdown'])) {
		// If the match isn't TBT (probably already determined), nothing happens
		if (executeSQL("SELECT winner FROM division_matches WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", true)[0][0] == "TBT") {
			include "elo.php";
			$player1UUID = executeSQL("SELECT player1_UUID FROM division_matches WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", true)[0][0];;
			$player2UUID = executeSQL("SELECT player2_UUID FROM division_matches WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", true)[0][0];
			$player1Elo = executeSQL("SELECT elo FROM game_records WHERE UUID=\"" . $player1UUID . "\"", true)[0][0];
			$player2Elo = executeSQL("SELECT elo FROM game_records WHERE UUID=\"" . $player2UUID . "\"", true)[0][0];

			/*
				elo function format is as follows:
				player1elo, player2elo, ifplayer1 won, if player2won
				-a 1 denotes a win and a 0 denotes a loss

				after using rating->getNewRatings the array's indexing works as follows
				results['a'] is player1's new elo
				results['b'] is player2's new elo
			*/
			if ($_REQUEST['winner_dropdown'] == "Player 1") {
				// Player 1 won
				executeSQL("UPDATE division_matches SET winner=\"" . $player1UUID . "\" WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", false);

				// Adjust elo
				$rating = new Rating($player1Elo, $player2Elo, 1, 0);
				$results = $rating->getNewRatings();

				executeSQL("UPDATE game_records SET elo=\"" . $results['a'] . "\" WHERE UUID=\"" . $player1UUID . "\"", false);
				executeSQL("UPDATE game_records SET elo=\"" . $results['b'] . "\" WHERE UUID=\"" . $player2UUID . "\"", false);
			} else if ($_REQUEST['winner_dropdown'] == "Player 2") {
				// Player 2 won
				executeSQL("UPDATE division_matches SET winner=\"" . $player2UUID . "\" WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", false);

				// Adjust elo
				$rating = new Rating($player1Elo, $player2Elo, 0, 1);
				$results = $rating->getNewRatings();

				executeSQL("UPDATE game_records SET elo=\"" . $results['a'] . "\" WHERE UUID=\"" . $player1UUID . "\"", false);
				executeSQL("UPDATE game_records SET elo=\"" . $results['b'] . "\" WHERE UUID=\"" . $player2UUID . "\"", false);
			} else {
				executeSQL("UPDATE division_matches SET winner=\"TBT\" WHERE match_UUID=\"" . $_REQUEST['match_UUID'] . "\"", false);
			}
		}
	}

	header("Location:/headsoccer/pages/game_administration.html.php");
?>