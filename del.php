<!DOCTYPE html>
<?php

//accessing session info
session_start();
require 'config.php';
//if user isn't logged in, redirect to signin
if (!isset($_SESSION["valid"])) {
    header('Location:signin.php');
}
//function for backend validation for each checkbox, so there isn't tons of lines of the same repeated code for each checkbox
function checkboxvalidation($post)
{
    $spherecheckbox = htmlspecialchars($_POST[$post]);
    //if spherechecked's value is the same as the post's value, proceed
    if ($spherecheckbox = $post) {
    }
    //else exit
    else {
        echo "not cool";
        exit;
    }
    //large block of function calls
}
if (empty($_POST['selected'])) {
    echo "nothing was inputed";
    exit;
}

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    //accessing info from bushes table
    $sth = $dbh->prepare('SELECT * FROM `bushes`');
    $sth->execute();
    $bush = $sth->fetchAll();
} catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

try {

    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    //hashing the password that the users input
    $countint = 0;

    if (isset($_POST['selected'])) {

        if ($countint > 1) {
            echo "you can't claim the same thing twice";
        } else {

            foreach ($_POST['selected'] as $animal) {
                echo count($_POST['selected']);
                echo $animal;
                $sth2 = $dbh->prepare("DELETE FROM requests WHERE id=(:waw)");
                $sth2->bindValue(":waw", $animal);
                $sth2->execute();
                $sth3 = $dbh->prepare("DELETE FROM claimed WHERE claimid=(:ww)");
                $sth3->bindValue(":ww", $animal);
                $sth3->execute();
            }
            //once everything is executed, redirect to login
            header('Location:home.php');
        }
    } else {
        echo "nothing was inputed";
    }
} catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

?>

<html>

<head>
    <link rel="stylesheet" href="p2.css">
</head>

<body>
    <!--navbar config-->
    <ul class="nav">
        <li><a href="home.php">Home </a></li>
        <li><a href="catalogue.php">Cuts</a></li>
        <li><a class="current" href="cart.php">Cart</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li class="logoish"><a href="home.php">TheCuts</a></li>

    </ul>
    <!--two buttons send user to a fake loadbingbar-->


</body>

</html>