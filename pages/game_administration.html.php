<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'php/htmlheader.html.php'; ?>
    <title>Division Administration</title>
</head>

<body>
    <?php include 'php/auth_header.html.php'; ?>

    <div id="wrapper">
        <?php include 'php/navbars.html.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Game Administration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Divisions
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <?php include 'php/match_summary_table.html.php'; ?>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->

                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Enter Match
                                </div>

                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/game_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Match UUID:</label>
                                                    <input class="form-control" placeholder="UUID" id="match_UUID" name="match_UUID">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Winner:</label>
                                                    <select class="form-control" id="winner_dropdown" name="winner_dropdown">
                                                        <option>TBT</option>
                                                        <option>Player 1</option>
                                                        <option>Player 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input class="btn btn-outline btn-primary btn-lg btn-block" name="enter_match" type="submit" value="Enter Result">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Generate Pairings
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                        <h2 class="lead text-center">This will wipe all existing matches!</h2>

                                        <form role="form" lpfornum="1" method="post" action="php/game_admin_handler.php">
                                            <div class="row">
                                                <div class="col-lg-5"><!-- spacer --></div>
                                                <div class="col-lg-2">
                                                    <div class="form-group text-center">
                                                        <label>Please type "confirm":</label>
                                                        <input class="form-control" placeholder="confirm" name="confirm_repairing" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="btn btn-outline btn-warning btn-lg btn-block" name="submit" type="submit" value="Generate Pairings">
                                        </form>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        <!-- /.panel -->
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    
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

    function changeMatchUUID(var UUID) // no ';' here
    {
        var elem = document.getElementById("match_UUID");
        elem.value = UUID;
    }
    </script>

</body>

</html>
