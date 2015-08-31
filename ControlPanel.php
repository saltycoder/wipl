<?php
    session_start();

    require("Config.php");

    $error_message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        login();
    }elseif(!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == 0){
        header("location: Home.php");
        exit;
    }

    function login()
    {
        global $dbname;
        global $dblocation;
        global $dbpassword;
        global $dbuser;
        global $error_message;

        $userid = strtolower($_POST['txtUserName']);

        $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);

        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        # Prepare the statement
        if (!($stmt = $mysqli->prepare("SELECT user_record_id,user_full_name,user_password,user_isadmin FROM wipl.user WHERE LOWER(user_id) = ?"))) {
            $error_message = $error_message . "<br />Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("s", $userid)) {
            $error_message = $error_message . "<br />Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            $error_message = $error_message . "<br />Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->store_result();

        $stmt->bind_result($userrecordid,$username,$userpassword,$isadmin);

        # User not found
        if($stmt->num_rows == 0){
            header("location: Home.php?errorcode=1");
            #exit;
        }

        while($stmt->fetch()){

            # Validate password
            if($_POST['txtUserPassword'] != $userpassword){
                header("location: Home.php?errorcode=2");
                #exit;
            }else{

                $_SESSION['user_fullname'] = $username;
                $_SESSION['isadmin'] = $isadmin;
                $_SESSION['user_recordid'] = $userrecordid;

                setcookie('wipluserinfo',base64_encode($userid . "/" . $userpassword),time() + 86400);  // 86400 = 1 day

                if(!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == 0){
                    header('location: Home.php');
                    exit;
                }

            }

        }

        $stmt->close();

    }


?>

<!doctype html>
<html lang="us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - Control Panel</title>

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
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <div class="jumbotron banner">
        <div class="container banner-text">
            <h1>Control Panel</h1>
            <p>
                Authentication By-Pass
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                HTTP 302
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Information Leakage
            </p>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h3>New User</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus aliquam ante id malesuada
                            tincidunt. Quisque dictum porttitor dui, vitae condimentum nulla mollis in. Fusce porta
                            magna tortor, sit amet iaculis dolor ullamcorper in. Phasellus turpis felis, sagittis eget
                            tempor sit amet, egestas et urna. Sed condimentum dolor varius, congue sapien.
                        </p>

                        <div style="padding-top:10px;text-align: center;">
                            <a href="CreateUser.php" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Create a User
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h3>Contact Messages</h3>

                        <p>
                            Nunc non hendrerit arcu. Etiam in efficitur purus. Sed turpis magna, dapibus at
                            sollicitudin eu, sagittis a enim. Interdum et malesuada fames ac ante ipsum primis in
                            faucibus. In porta sed quam ac tincidunt. Nunc sed orci sollicitudin est vulputate
                            sollicitudin eu quis erat. Nunc risus ligula, tempus ut mattis.  Sed condimentum dolor
                            varius.
                        </p>

                        <div style="padding-top:10px;text-align: center;">
                            <a href="ContactList.php" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> View Messages
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h3>Settings</h3>

                        <p>
                            Ut ligula metus, vestibulum a pretium at, feugiat at ante. Vivamus eget nisi sapien. Phasellus
                            consequat viverra lorem, quis maximus tortor tincidunt non. Nam ultricies at libero cursus
                            laoreet. Vivamus sit amet mollis tellus. Phasellus dolor massa, dapibus eget augue a,
                            efficitur faucibus neque. Sed interdum, nibh et cursus mollis.
                        </p>

                        <div style="padding-top:10px;text-align: center;">
                            <a href="#" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> System Settings
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include "_footer.php" ?>

</body>
</html>