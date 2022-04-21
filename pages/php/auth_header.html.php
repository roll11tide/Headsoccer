<?php
	if (empty(session_id())) {
		// No session set
		session_start();
	}

	if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized')
	{
	    // IMPORTANT
		// Remove the /headsoccer from the beginning of the header before putting this on the server
		// IMPORTANT
		
		$_SESSION['status'] = 'unauthorized';
	    header("Location: /headsoccer/pages/login.html.php");
	    die();
	}
?>