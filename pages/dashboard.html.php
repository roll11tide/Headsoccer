<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'php/htmlheader.html.php'; ?>
    <title>TA Head Soccer</title>
</head>

<body>
    <?php include 'php/auth_header.html.php'; ?>

    <div id="wrapper">
        <?php include 'php/navbars.html.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Stats</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Division Summaries
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php include 'php/records_summary_table.html.php'; ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!--
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bar Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="stats_bar_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            -->
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
