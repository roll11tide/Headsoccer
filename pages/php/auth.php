<?php
	include 'sql.php';

	if (isset($_REQUEST['username']) & isset($_REQUEST['password'])) {
		try {
		    $resultArray = executeSQL("SELECT * FROM auth", true);

		    session_start();
		    $_SESSION['status'] = 'unauthorized';
		    foreach ($resultArray as $key => $value) {
		    	if ($value[0] == $_REQUEST['username'] & $value[1] == hash('sha512', $_REQUEST['password'])) {
		    		// Username matches hashed password - indication of good login
		    		// Successful login
		    		session_start();
		    		$_SESSION['auth'] = $_REQUEST['username'];
		    		if (!empty($_REQUEST['remember'])) {
		    			// Persist session
		    			ini_set('session.cookie_lifetime', 60 * 60 * 24 * 1);  // 1 day cookie lifetime
		    		}

		    		// IMPORTANT
		    		// Remove the /headsoccer from the beginning of the headers before putting this on the server
		    		// IMPORTANT
		    		$_SESSION['status'] = 'authorized';
		    		header("Location:/headsoccer/pages/dashboard.html.php");
		    	}
		    }

		    if ($_SESSION['status'] == 'unauthorized') {
		    	header("Location:/headsoccer/pages/login.html.php");
		    }
		} catch (Exception $e) {
			echo $e;
		}
	} else {
		echo '<h1>Empty request.</h1><h3>Maybe if you say please?</h3>';
	}
?>