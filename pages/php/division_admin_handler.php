<?php
	include 'auth_header.html.php';
	include 'sql.php';

	if(!empty($_REQUEST['new_division_name'])) {
		// New player request
		$UUID = strtoupper(substr(hash('sha512', strtoupper($_REQUEST['new_division_name'])), 0, 6));
		executeSQL("INSERT INTO divisions (UUID, name, members) VALUES (\"" . $UUID . "\", \"" . strtoupper($_REQUEST['new_division_name'])  . "\", \"[]\");", false);
	}

	if(!empty($_REQUEST['remove_division_UUID'])) {
		// Set all members' division attribute to "---"
		$members = json_decode(executeSQL("SELECT members FROM divisions WHERE UUID=\"" . $_REQUEST['remove_division_UUID'] . "\"", true)[0][0]);

		foreach ($members as $key => $value) {
			executeSQL("UPDATE game_records SET division=\"---\" WHERE UUID=\"" . $value . "\"", false)[0][0];
		}

		// Delete division row
		executeSQL("DELETE FROM divisions WHERE UUID=\"" . $_REQUEST['remove_division_UUID'] . "\";", false);
	}

	// IMPORTANT
	// Remove the /headsoccer from the beginning of the headers before putting this on the server
	// IMPORTANT
	header("Location:/headsoccer/pages/division_administration.html.php");
?>