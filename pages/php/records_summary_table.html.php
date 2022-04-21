<?php
    //include 'auth_header.html.php';
    include 'sql.php';
    $resultArray = executeSQL("SELECT * FROM game_records;", true);
?>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>Name</th>
            <th>Elo</th>
            <th>Division</th>
            <th>Championships</th>
            <th>Career Wins</th>
            <th>Career Losses</th>
            <th>W/L Ratio</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($resultArray as $key => $value) {
            	$WL = "-";
                if ($value[6] != 0) {
                    $WL = round(($value[5] / $value[6]), 3);
                }

                echo "
        			<tr class=\"gradeA\">
                        <td>" . $value[1] . "</td>
                        <td>" . $value[2] . "</td>
                        <td>" . $value[3] . "</td>
                        <td class=\"center\">" . $value[4] . "</td>
                        <td class=\"center\">" . $value[5] . "</td>
                        <td class=\"center\">" . $value[6] . "</td>
                        <td class=\"center\">" . $WL . "</td>
                    </tr>
        		";
            }
        ?>
    </tbody>
</table>