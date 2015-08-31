<?php
    session_start();

    require("Config.php");

    $contact_message = "";
    $error_message = "";

    if(isset($_POST['btnContactUs'])) {

        if(save()){
            $contact_message = $_POST['txtFrom'];
        }

    }

    function save()
    {
        global $dbname;
        global $dblocation;
        global $dbpassword;
        global $dbuser;
        global $error_message;

        $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);

        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        # Prepare the statement
        if (!($stmt = $mysqli->prepare("INSERT INTO contact (full_name, email, message, sent_on) VALUES (?, ?, ?, ?)"))) {
            $error_message = $error_message . "<br />Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        # Bind the parameters
        $now = new DateTime();

        if (!$stmt->bind_param("ssss", $_POST['txtFrom'], $_POST['txtFromEmail'], $_POST['txtMessage'], $now->format('Y-m-d H:i:s'))) {
            $error_message = $error_message . "<br />Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        # Save the new record
        if (!$stmt->execute()) {
            $error_message = $error_message . "<br />Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->close();

        if(strlen($error_message) == 0) {
            return true;
        }else{
            return false;
        }

    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - Contact Us</title>

    <?php include "_htmlhead.php" ?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="Home.php">Home</a>
                <a class="navbar-brand" href="About.php">About</a>
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
            <h1>Contact Us</h1>
            <p>
                Cross-Site Scripting (XSS)
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Data Validation Bypass
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Information Leakage
            </p>
        </div>
    </div>

    <div class="container">

        <?php if(strlen($contact_message) > 0){ ?>
            <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <strong><?php echo $contact_message ?>!</strong>  Thank you for contacting us!  We take your privacy and security very seriously.  Your personal information will never be sold.
            </div>
        <?php } ?>

        <?php if(strlen($error_message) > 0){ ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                <strong>Oh snap!</strong> <?php echo $error_message ?>
            </div>
        <?php } ?>

        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="txtFrom" class="col-sm-2 control-label">Your Name</label>
                <div class="col-sm-10">
                    <input id="txtFrom" name="txtFrom" type="text" class="form-control" placeholder="First and Last Name" style="width:400px;" maxlength="100" data-validation="alphanumeric" data-validation-allowing=" -'" />
                </div>
            </div>
            <div class="form-group">
                <label for="txtFromEmail" class="col-sm-2 control-label">E-mail Address</label>
                <div class="col-sm-10">
                    <input id="txtFromEmail" name="txtFromEmail" type="text" class="form-control" placeholder="E-mail" style="width:400px;" maxlength="100" data-validation="email" />
                </div>
            </div>
            <div class="form-group">
                <label for="txtMessage" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea id="txtMessage" name="txtMessage" class="form-control" placeholder="Something funny and clever" style="width:600px;height:100px;" maxlength="100" data-validation="alphanumeric" data-validation-allowing=" -'_#?!:"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="btnContactUs" name="btnContactUs" type="submit" class="btn btn-default" value="1">Contact Us</button>
                </div>
            </div>
        </form>

    </div>

    <?php include "_footer.php" ?>

    <script>

        $.validate({
            validation: false,
            errorMessagePosition: 'top',
            scrollToTopOnError: false
        });

        $('#txtNotes').restrictLength( $(1000) );

    </script>

</body>
</html>