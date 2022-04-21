<?php
    include 'auth_header.html.php';
    $resultArray = executeSQL("SELECT * FROM divisions", true);
?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>UUID</th>
            <th>Name</th>
            <th>Members</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($resultArray as $key => $value) {
            	$memberArray = json_decode($value[2]);
            	$membersLine = "";
            	if (empty($memberArray)) {
                    $membersLine = "---";
                } else {
                    foreach ($memberArray as $key2 => $value2) {
                        // Get name from UUID
                        $resultArray2 = executeSQL("SELECT name FROM game_records WHERE UUID=\"" . $value2 . "\"", true);
                        
                        $membersLine = $membersLine . $resultArray2[0][0] . ", ";
                    }
                    $membersLine = substr($membersLine, 0, -2);
                }

            	echo "
        			<tr class=\"gradeA\">
                        <td>" . $value[0] . "</td>
                        <td>" . $value[1] . "</td>
                        <td>" . $membersLine . "</td>
                    </tr>
        		";
            }
        ?>
    </tbody>
</table>