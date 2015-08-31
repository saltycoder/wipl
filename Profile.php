<?php
    session_start();

    require("Config.php");

    $user_full_name = "";
    $user_id = "";
    $user_password = "";
    $user_role = "";

    if($_SERVER["REQUEST_METHOD"] == "GET") {

        $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);

        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        # Prepare the statement
        if (!($stmt = $mysqli->prepare("SELECT user_full_name,user_id,user_password,user_isadmin FROM wipl.user WHERE user_record_id = ?"))) {
            $error_message = $error_message . "<br />Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("i", strtolower($_GET['id']))) {
            $error_message = $error_message . "<br />Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            $error_message = $error_message . "<br />Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->store_result();

        $stmt->bind_result($username,$userid,$userpassword,$isadmin);

        # User not found
        if($stmt->num_rows == 0){
            header("location: Home.php");
            exit;
        }

        while($stmt->fetch()){
            $user_full_name = $username;
            $user_id = $userid;
            $user_password = $userpassword;
            $user_role = $isadmin;
        }

        $stmt->close();

    }else{
        header("location: Home.php");
        exit;
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - My Profile</title>

    <?php include "_htmlhead.php" ?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="Home.php">Home</a>
                <a class="navbar-brand" href="About.php">About</a>
                <a class="navbar-brand" href="Contact.php">Contact Us</a>
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
            <h1>My Profile</h1>
            <p>
                Indirect Object Reference
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Parameter Tampering
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Information Leakage
            </p>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-4">

                <dl class="dl-horizontal">
                    <dt>Full Name</dt>
                    <dd><?php echo $user_full_name ?></dd>
                </dl>

            </div>
            <div class="col-md-8">

                <dl class="dl-horizontal">
                    <dt>User ID</dt>
                    <dd><?php echo $user_id ?></dd>
                </dl>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">

                <dl class="dl-horizontal">
                    <dt>Role</dt>
                    <dd>
                        <?php
                            if($user_role == "1"){
                                echo "Administrator";
                            }else{
                                echo "User";
                            }
                        ?>
                    </dd>
                </dl>

            </div>
            <div class="col-md-8">

                <dl class="dl-horizontal">
                    <dt>Password</dt>
                    <dd><?php echo $user_password ?></dd>
                </dl>

            </div>
        </div>

    </div>

    <?php include "_footer.php" ?>

</body>
</html>