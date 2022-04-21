<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'php/htmlheader.html.php'; ?>
    <title>Player Administration</title>
</head>

<body>
    <?php include 'php/auth_header.html.php'; ?>

    <div id="wrapper">
        <?php include 'php/navbars.html.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Player Administration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    UUID & Name Pairs
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <?php include 'php/records_summary_table_minimal.html.php'; ?>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Log
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <?php
                                            if (isset($_SESSION['admin_output'])) {
                                                // Recently issued admin commands
                                                foreach ($_SESSION['admin_output'] as $key => $value) {
                                                    echo '<p>' . $value . '</p>';
                                                }

                                                unset($_SESSION['admin_output']);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Add Player
                                </div>

                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/player_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Name:</label>
                                                    <input class="form-control" placeholder="New Name" name="new_player_name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Division:</label>
                                                <select class="form-control" id="new_player_division" name="new_player_division">
                                                    <?php
                                                        $conn = new mysqli("tusc-al.com", "headsoccerviewer", "headsoccer2016", "headsoccer");
                                                        $sql = "SELECT name FROM divisions;";
                                                        $result = $conn->query($sql);

                                                        while($row = $result->fetch_assoc()) {
                                                            echo "<option>" . $row['name'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <input class="btn btn-outline btn-primary btn-lg btn-block" name="submit" type="submit" value="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col-lg-12 -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Remove Player
                                </div>

                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/player_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>UUID:</label>
                                                    <input class="form-control" placeholder="UUID" name="remove_player_UUID" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <input class="btn btn-outline btn-danger btn-lg btn-block" name="submit" type="submit" value="Remove">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col-lg-12 -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Administrative Utilities
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/player_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Player UUID:</label>
                                                    <input class="form-control" placeholder="UUID" name="UUID">
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <label>Actions:</label>

                                        <hr>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">Change Name:</p>
                                                    <input class="form-control" placeholder="New Name" name="name_change" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">+/- Elo:</p>
                                                    <input class="form-control" placeholder="0" name="elo_change" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">Change Division:</p>
                                                    <select class="form-control" id="division_change" name="division_change">
                                                        <option></option>
                                                        <?php
                                                            $conn = new mysqli("tusc-al.com", "headsoccerviewer", "headsoccer2016", "headsoccer");
                                                            $sql = "SELECT name FROM divisions;";
                                                            $result = $conn->query($sql);

                                                            while($row = $result->fetch_assoc()) {
                                                                echo "<option>" . $row['name'] . "</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">+/- Championships:</p>
                                                    <input class="form-control" placeholder="New Name" name="championship_change" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">+/- Career Wins:</p>
                                                    <input class="form-control" placeholder="0" name="career_wins_change" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-center">+/- Career Losses:</p>
                                                    <input class="form-control" placeholder="0" name="career_losses_change">
                                                </div>
                                            </div>
                                        </div>

                                        <input class="btn btn-outline btn-primary btn-lg btn-block" name="submit" type="submit" value="Apply">
                                    </form>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

    <?php include 'php/htmlfooter.html.php'; ?>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
