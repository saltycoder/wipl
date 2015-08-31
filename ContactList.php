<?php
    session_start();

    require("Config.php");

    $error_message = "";
    $contact_list;

    if(isset($_POST['btnSearch'])) {
        search();
    }else{
        get_messages();
    }

    function search(){
        global $dbname;
        global $dblocation;
        global $dbpassword;
        global $dbuser;
        global $error_message;
        global $contact_list;

        $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);

        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL for search: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if(!$contact_list = $mysqli->query("SELECT * FROM wipl.contact WHERE full_name LIKE '%" . $_POST["txtSearch"] . "%' ORDER BY sent_on")) {
            $error_message = "Search Failed " . $mysqli->error;
        }

    }

    function get_messages(){
        global $dbname;
        global $dblocation;
        global $dbpassword;
        global $dbuser;
        global $error_message;
        global $contact_list;

        $mysqli = new mysqli($dblocation, $dbuser, $dbpassword, $dbname);


        if ($mysqli->connect_errno) {
            $error_message = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if(!$contact_list = $mysqli->query("SELECT * FROM wipl.contact ORDER BY sent_on")) {
            $error_message = "Failed to retrieve contacts " . $mysqli->error;
        }

    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - Contact Us Messages</title>

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
            <h1>Contact Us Messages</h1>
            <p>
                Cross-Site Scripting (XSS)
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                SQL Injection (SQLi)
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Authorization By-Pass
            </p>
        </div>
    </div>

    <div class="container">

        <?php if(strlen($error_message) > 0){ ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                <strong>Oh snap!</strong> <?php echo $error_message ?>
            </div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-body">

                <form action="" method="post" class="form-inline">
                    <div class="form-group">
                        <label for="txtSearch">Search by Name</label>
                        <input id="txtSearch" name="txtSearch" type="text" class="form-control" placeholder="Search by Name" style="width:600px;" maxlength="100" data-validation="alphanumeric" />
                    </div>
                    <button id="btnSearch" name="btnSearch" type="submit" class="btn btn-default" value="1">Search</button>
                </form>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Messages</div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width:10%;">Contacted On</th>
                        <th style="width:20%;">Full Name</th>
                        <th style="width:20%;">E-mail Address</th>
                        <th style="width:50%;">Message</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        while($row = $contact_list->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $row["sent_on"] . "</td>";
                            echo "<td>" . $row["full_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["message"] . "</td>";
                            echo "</tr>";
                        }
                    ?>

                </tbody>
            </table>

        </div>

    </div>

    <?php include "_footer.php" ?>

    <script>

        $.validate({
            validation: false,
            errorMessagePosition: 'top',
            scrollToTopOnError: false
        });

    </script>

</body>
</html>