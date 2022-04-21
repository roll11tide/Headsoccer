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
                    <h1 class="page-header">Division Administration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Divisions
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <?php include 'php/divisions_summary_table.html.php'; ?>
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
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Add Division
                                </div>

                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/division_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Name:</label>
                                                    <input class="form-control" placeholder="New Name" name="new_division_name" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <input class="btn btn-outline btn-primary btn-lg btn-block" name="submit" type="submit" value="Apply">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Remove Division
                                </div>

                                <div class="panel-body">
                                    <form role="form" lpfornum="1" method="post" action="php/division_admin_handler.php">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>UUID:</label>
                                                    <input class="form-control" placeholder="UUID" name="remove_division_UUID" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <input class="btn btn-outline btn-danger btn-lg btn-block" name="submit" type="submit" value="Apply">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                Change Division Name
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" lpfornum="1" method="post" action="php/player_admin_handler.php">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Division UUID:</label>
                                                <input class="form-control" placeholder="UUID" name="UUID">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>New Name:</label>
                                                <input class="form-control" placeholder="New Name" name="change_division_name">
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
