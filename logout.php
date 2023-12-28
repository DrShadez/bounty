<?php
//accessing session info
session_start();


//if the user isn't logged in, redirect to login
if (!isset($_SESSION["valid"])) {
    header('Location:signin.php');
}

//destroy the session
session_destroy();


//redirect to home.php
header('Location:signin.php');
