<?php
    session_start();

?>

<!doctype html>
<html lang="us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - Create New User</title>

    <?php include "_htmlhead.php" ?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="Home.php">Home</a>
                <a class="navbar-brand" href="ControlPanel.php">Control Panel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <p class="navbar-text navbar-right">
                    <?php include "_navlogin.php" ?>
                </p>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <div class="jumbotron banner">
        <div class="container banner-text">
            <h1>New User</h1>
            <p>
                Create a new user account
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Authorization By-Pass
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Cross-Site Request Forgery (CSRF)
            </p>
        </div>
    </div>

    <div class="container">

        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-10">
                    <input id="txtName" name="txtName" type="text" class="form-control" placeholder="First and Last Name" maxlength="100" />
                </div>
            </div>
            <div class="form-group">
                <label for="txtEmail" class="col-sm-2 control-label">E-mail Address</label>
                <div class="col-sm-10">
                    <input id="txtEmail" name="txtEmail" type="text" class="form-control" placeholder="E-mail" maxlength="100"  />
                </div>
            </div>
            <div class="form-group">
                <label for="txtPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input id="txtPassword" name="txtPassword" type="password" class="form-control" placeholder="Password" maxlength="100" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Create User</button>
                </div>
            </div>
        </form>

    </div>

    <?php include "_footer.php" ?>

</body>
</html>