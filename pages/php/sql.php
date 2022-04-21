<?php
	// This script must be at the very top of the page in order to avoid session_start() errors

	if (empty(session_id())) {
		// No session set
		session_start();
	}

	if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized')
	{
	    // Not authorized - use basic viewer connection
		if (!function_exists('executeSQL')) {
			function executeSQL($sql, $fetch) {
				$conn = new mysqli("tusc-al.com", "headsoccerviewer", "headsoccer2016", "headsoccer");
				$result = $conn->query($sql);
				$conn->close();

				if ($fetch) {
					$resultArray = $result->fetch_all(MYSQLI_NUM);
					return $resultArray;
				}
			}
		}
	} else {
		// Authorized - use elevated connection
		if (!function_exists('executeSQL')) {
			function executeSQL($sql, $fetch) 
			{
				$conn = new mysqli("tusc-al.com", "headsoccer", "8Gd7GGs0koUOnvqFbVxv", "headsoccer");
				$result = $conn->query($sql);
				$conn->close();

				if ($fetch) {
					$resultArray = $result->fetch_all(MYSQLI_NUM);
					return $resultArray;
				}
			}
		}
	}
?>