<?php

    session_start();

    // Remove the cookie
    #if(isset($_COOKIE['wipluserinfo'])){
    #    unset($_COOKIE['wipluserinfo']);
    #}
    setcookie('wipluserinfo', '', time()-60*60*24*365);

    // Unset all of the session variables.
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    header("location: Home.php");
    exit;

?>