<?php
    if(isset($_SESSION['user_fullname']) && strlen($_SESSION['user_fullname']) > 0) {

        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li class="dropdown">';
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">';
        echo '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>  ' . $_SESSION['user_fullname'] .'  <span class="caret"></span></a>';
        echo '<ul class="dropdown-menu" role="menu">';

        if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1)
        {
            echo '<li><a href="ControlPanel.php">Control Panel</a></li>';
        }

        echo '<li><a href="Profile.php?id=' . $_SESSION["user_recordid"] . '">Profile</a></li>';
        echo '<li class="divider"></li>';
        echo '<li><a href="LogOut.php">Log Out</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '</ul>';

    }else{
        echo "Not Signed In";
    }
?>