<!DOCTYPE html>
<?php

//accessing session info
session_start();
require 'config.php';
//if user isn't logged in, redirect to signin
if (!isset($_SESSION["valid"])) {
    header('Location:signin.php');
}

try {
    //accessing info from bushes table
    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $sth = $dbh->prepare('SELECT * FROM `claimed` WHERE userid=:newuser');
    $sth->bindValue(":newuser", $_SESSION['id']);
    $sth->execute();
    $bush = $sth->fetchAll();
    $sth1 = $dbh->prepare('SELECT * FROM `requests`');
    $sth1->execute();
    $bush1 = $sth1->fetchAll();
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
        <li><a href="home.php">Your Requests </a></li>
        <li><a href="main.php">Bounty Board</a></li>
        <li><a class="current" href="cart.php">Claimed</a></li>
        <li><a href="vtest.php">Request</a></li>
        <li><a href="update.php">Updates</a></li>

        <li class="logoish"><a href="home.php">Bounty</a></li>
    </ul>

    <div class="main">
        <h2>Claimed</h2>
        <p> These are the requests that you have decided to take up on yourself</p>



        <!--logout-->
        <a href=logout.php>logout</a>

        <?php
        //displaying all the bushes with their corresponding images and values 

        //very big form that essentially puts all the bushes in checkboxes
        echo "<form action='idassign.php' id='bushoption' method='post'>";
        echo "<div class='choices'>";
        for ($z = 0; $z < count($bush1); $z++) {
            for ($x = 0; $x < count($bush); $x++) {
                if ($bush1[$z]['id'] == $bush[$x]['claimid']) {
                    echo "
            <div class='optionl'>

                </br>
        <div id='content'>
                    
                    <h3>";
                    echo $bush1[$z]['task'];
                    echo "</br>";
                    echo $bush1[$z]['pay'];
                    echo "</h3>

                    <p>";
                    echo $bush1[$z]['taskdetail'];
                    echo "</p>
                    <input type='checkbox' name='selected[]' value='{$bush[$x]['id']}'>
                    <label for='selected[]'> Select?</label><br>
                </div>
            </div>";
                }
            }
        }
        echo "</div>";

        ?>
        <input type='submit' value='save selection'>
        </form>
    </div>
</body>

</html>