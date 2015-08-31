<?php
    session_start();

    require("Config.php");

    mysqli_report(MYSQLI_REPORT_STRICT);

    $reset_complete = false;
    $error_message = "";

    if(isset($_POST['btnReset'])) {
        reset_db();
    }

    function reset_db()
    {
        global $dbname;
        global $dblocation;
        global $dbpassword;
        global $dbuser;
        global $reset_complete;
        global $error_message;

        $db_connected = false;

        try {

            $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);

            if ($mysqli->connect_errno) {
                $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") Check your setting in the Config.php file.  " . $mysqli->connect_error;
            }

            $db_connected = True;

        }
        catch(mysqli_sql_exception $e){
            $error_message = "Check your settings in the Config.php file.<br /><br />  Failed to connect to MySQL.  " . $e;
        }

        if($db_connected) {

            $command = "mysql --user=" . $dbuser . " --password=" . $dbpassword . " --database=" . $dbname . " < ./db-scripts/ResetDB.sql";
            $output = shell_exec($command);
            echo $output;

            $reset_complete = True;

            logout();
        }

    }

    function logout()
    {

        // Remove the cookie
        setcookie('wipluserinfo', '', time()-60*60*24*365);

        // Unset all of the session variables.
        $_SESSION = array();

        // Destroy the session.
        session_destroy();
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - Reset the Database</title>

    <?php include "_htmlhead.php" ?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="Home.php">Home</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <p class="navbar-text navbar-right">
                    <?php include "_navlogin.php" ?>
                </p>
            </div>
        </div>
    </nav>

    <div class="jumbotron banner">
        <div class="container banner-text">
            <h1>Reset Database</h1>
            <p>
                Reset the database back to the original state
            </p>
        </div>
    </div>

    <div class="container">

        <form action="" method="post" class="form-horizontal">

            <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <strong>Read Me</strong> Clicking on the reset button will drop all the WIPL tables; the dropping of the
                tables will delete all the data in the WIPL database.  After the tables are dropped the tables will be
                recreated and loaded with the default WIPL data.  You will also be logged out of the application
            </div>

            <?php if($reset_complete){ ?>
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <strong>Reset Complete</strong>  The database has been reset.  Happy Hacking!!
                </div>
            <?php } ?>

            <?php if(strlen($error_message) > 0){ ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    <strong>Oh snap!</strong> <?php echo $error_message ?>
                </div>
            <?php } ?>

            <div>
                <button id="btnReset" name="btnReset" type="submit" class="btn btn-default" value="1">Go ahead and reset it!</button>
            </div>

        </form>

    </div>

    <?php include "_footer.php" ?>

</body>
</html>