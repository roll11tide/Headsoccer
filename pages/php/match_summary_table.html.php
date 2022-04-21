<?php
    include 'auth_header.html.php';
    include 'sql.php';
    $resultArray = executeSQL("SELECT * FROM division_matches", true);
?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>Match UUID</th>
            <th>Division</th>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Winner</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($resultArray as $key => $value) {
            	$divisionName = executeSQL("SELECT name FROM divisions WHERE UUID=\"" . $value[1] . "\"", true)[0][0];
                $player1Name = executeSQL("SELECT name FROM game_records WHERE UUID=\"" . $value[2] . "\"", true)[0][0];
                $player2Name = executeSQL("SELECT name FROM game_records WHERE UUID=\"" . $value[3] . "\"", true)[0][0];

                // JS variables can't start with a number
            	$inputButton = "<input type=\"button\" value=\"Use\" onclick=\"changeMatchUUID(\"" . $value[0] . "\")\" />";
                echo "
        			<tr class=\"gradeA\">
                        <td>" . $value[0] . "   </td>
                        <td>" . $divisionName . "</td>
                        <td>" . $player1Name . "</td>
                        <td>" . $player2Name . "</td>
                        <td>" . $value[4] . "</td>
                    </tr>
        		";
            }
        ?>
    </tbody>
</table>