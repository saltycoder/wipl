<?php
    session_start();

    $error_message = "";
    $error = "0";

    if(isset($_GET['errorcode'])) {
        $error = $_GET['errorcode'];
    }

    if($error == "1"){
        $error_message = "The User ID could not be found.";
    }elseif ($error == "2") {
        $error_message = "The password is invalid for your User ID.";
    }else{
        $error_message = "";
    }

?>

<!doctype html>
<html lang="us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIP Lab</title>

    <?php include "_htmlhead.php" ?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="About.php">About</a>
                <a class="navbar-brand" href="Contact.php">Contact Us</a>
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
            <h1>WIP Lab</h1>
            <p>
                Web Interception Proxy Lab (WIPL)
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                Think differently; attack your code!
            </p>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada nibh dolor, et vehicula sem
                    ornare nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus luctus vel ante eu
                    egestas. Nam vehicula eget massa a gravida. Nunc accumsan feugiat blandit. Pellentesque efficitur
                    felis quis turpis aliquet, ut lobortis ante laoreet. Fusce quis porta velit. Morbi egestas quis
                    elit quis malesuada. Aliquam maximus risus non quam finibus, at tincidunt mi dapibus. Sed urna
                    tortor, aliquam varius finibus ut, aliquet vel ipsum. Duis vitae dolor congue sapien porta eleifend
                    id a nibh.
                </p>

                <p>
                    Donec turpis lectus, pharetra at magna a, interdum gravida felis. Phasellus quis iaculis risus. Aenean
                    non dui porta magna dapibus semper. Quisque fringilla ex vel nunc ornare, a semper odio suscipit.
                    Pellentesque commodo ante quis ante sodales, vel eleifend risus auctor. Duis eget ipsum vulputate,
                    gravida nisi nec, faucibus velit. Vivamus id libero viverra, dignissim ligula sed, dictum odio.
                </p>

                <!--
                <a href="Administration.php">Administration</a>
                <a href="Profile.php">My Profile</a>
                -->

                <p>
                    Phasellus fringilla bibendum pulvinar. Morbi viverra nibh id dolor laoreet, ac hendrerit ex auctor.
                    Nulla auctor lorem est. Phasellus mauris nisl, aliquam quis ante non, tincidunt varius augue. In
                    lacinia lectus nisl. In in feugiat orci, et rhoncus erat. Proin pretium vehicula ante, finibus
                    finibus leo fringilla at. In hac habitasse platea dictumst.
                </p>

                <ul>
                    <li>Aenean venenatis urna et quam pellentesque pulvinar sagittis id augue.</li>
                    <li>Nam at lacus tincidunt, rhoncus augue et, blandit orci.</li>
                    <li>Etiam sed odio eu massa sagittis cursus.</li>
                    <li>Donec vulputate urna et metus suscipit, at vehicula ante auctor.</li>
                </ul>

            </div>
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">

                        <?php if(strlen($error_message) > 0){ ?>
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                                <strong>Oh snap!</strong> <?php echo $error_message ?>
                            </div>
                        <?php } ?>

                        <form action="ControlPanel.php" method="post" class="form-horizontal">
                            <div class="form-group" style="height:40px;">
                                <label for="txtUserName" class="col-sm-2 control-label">User ID</label>
                                <div class="col-sm-10">
                                    <input  id="txtUserName" name="txtUserName" type="text" class="form-control" placeholder="User ID" data-validation="alphanumeric" data-validation-allowing="-'">
                                </div>
                            </div>
                            <div class="form-group" style="height:40px;">
                                <label for="txtUserPassword" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input id="txtUserPassword" name="txtUserPassword" type="password" class="form-control" placeholder="Password" data-validation="alphanumeric" data-validation-allowing="-!@#$%^&*()_'">
                                </div>
                            </div>
                            <div class="form-group" style="height:30px;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="height:40px;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button id="btnSignIn" name="btnSignIn" type="submit" class="btn btn-default">Sign in</button>
                                </div>
                            </div>
                        </form>

                        <!--
                        UID:  Demo
                        PWD:  Demo777
                        -->

                    </div>
                </div>

                <div style="margin-top:50px;margin-bottom:50px;text-align: center;">
                    <img src="images/hacker-safe.png" alt="Hacker Safe" />
                </div>

            </div>
        </div>

    </div>

    <?php include "_footer.php" ?>

</body>
</html>
