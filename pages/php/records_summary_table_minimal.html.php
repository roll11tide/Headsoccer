<?php
    include 'auth_header.html.php';

    // Creat mysqli object
	$conn = new mysqli("tusc-al.com", "headsoccerviewer", "headsoccer2016", "headsoccer");

	// Set SQL statement
    $sql = "SELECT * FROM game_records";

    // Query server
    $result = $conn->query($sql);

    // Create array
    $resultArray = $result->fetch_all(MYSQLI_NUM);
?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>UUID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($resultArray as $key => $value) {
            	echo "
        			<tr class=\"gradeA\">
                        <td>" . $value[0] . "</td>
                        <td>" . $value[1] . "</td>
                    </tr>
        		";
            }
        ?>
    </tbody>
</table>