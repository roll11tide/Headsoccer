<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'php/htmlheader.html.php'; ?>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    
                    <div class="panel-body">
                        <form role="form" action="php/auth.php" method="post">
                            <?php
                                if (empty(session_id())) {
                                    // No session set
                                    session_start();
                                    
                                }
                                if (isset($_SESSION['status']) && $_SESSION['status'] == 'unauthorized') {
                                    echo '<div class="alert alert-danger">
                                            Unauthorized
                                          </div>';
                                }

                                unset($_SESSION['status']);
                            ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'php/htmlfooter.html.php' ?>

</body>

</html>