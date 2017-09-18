<?php
include '../config/config.php';
$username = "";
$password = "";
include basePath('admin/login_check.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><!-- <![endif]-->
<html>
    <head>
        <title>Ticket Chai | Admin Login Panel</title>

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <!--[if lt IE 9]><link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
        <link rel="stylesheet" href="assets/css/admin/module.admin.page.login.min.css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/components/library/jquery/jquery.min.js?v=v1.2.3"></script>
        <script src="assets/components/library/jquery/jquery-migrate.min.js?v=v1.2.3"></script>
        <script src="assets/components/library/modernizr/modernizr.js?v=v1.2.3"></script>
        <script src="assets/components/plugins/less-js/less.min.js?v=v1.2.3"></script>
        <script src="assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.2.3"></script>
        <script src="assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.2.3"></script>	
    </head>
    <body class=" loginWrapper">

        <div id="content">

            <div class="login spacing-x2">
                <div class="placeholder text-center"><img src="images/ticketchai_logo.png"></div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body innerAll">
                            <?php include basePath('admin/message.php'); ?>
                            <form role="form" id="login" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" >
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="username" value="<?php echo $username; ?> "placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Login</button>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>