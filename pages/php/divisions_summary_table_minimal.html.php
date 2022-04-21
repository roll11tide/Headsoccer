<?php
	include 'php/component_auth_header.html.php';

    // Creat mysqli object
	$conn = new mysqli("tusc-al.com", "headsoccerviewer", "headsoccer2016", "headsoccer");

	// Set SQL statement
    $sql = "SELECT * FROM divisions";

    // Query server
    $result = $conn->query($sql);

    // Create array
    $resultArray = $result->fetch_all(MYSQLI_NUM);
?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>Name</th>
            <th>Members</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($resultArray as $key => $value) {
                $memberArray = json_decode($value[2]);
                $membersLine = "";
                foreach ($memberArray as $key2 => $value2) {
                    // Get name from UUID
                    $sql = "SELECT name FROM game_records WHERE UUID=\"" . $value2 . "\"";
                    $result2 = $conn->query($sql);
                    $resultArray2 = $result2->fetch_all(MYSQLI_NUM);
                    
                    $membersLine = $membersLine . $resultArray2[0][0] . ", ";
                }
                $membersLine = substr($membersLine, 0, -2);

                echo "
        			<tr class=\"gradeA\">
                        <td>" . $value[1] . "</td>
                        <td>" . $membersLine . "</td>
                    </tr>
        		";
            }
        ?>
    </tbody>
</table>