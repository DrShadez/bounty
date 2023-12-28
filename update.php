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
    $sth = $dbh->prepare('SELECT * FROM `requests` WHERE reqid=:newuser');
    $sth->bindValue(":newuser", $_SESSION['id']);
    $sth->execute();
    $reqs = $sth->fetchAll();
    $sth1 = $dbh->prepare('SELECT * FROM `claimed`');
    $sth1->execute();
    $claimd = $sth1->fetchAll();
    $sth2 = $dbh->prepare('SELECT * FROM `user_info`');
    $sth2->execute();
    $uinfo = $sth2->fetchAll();
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
        <li><a href="cart.php">Claimed</a></li>
        <li><a href="vtest.php">Request</a></li>
        <li class="current"><a href="update.php">Updates</a></li>
        <li class="logoish"><a href="home.php">Bounty</a></li>



    </ul>
    <!--two buttons send user to a fake loadbingbar-->
    <div class="main">
        <h2>Your Requests</h2>
        <p> These are the requests that you have sent out</p>



        <!--logout-->
        <a href=logout.php>logout</a>

        <?php
        //displaying all the bushes with their corresponding images and values 

        //very big form that essentially puts all the bushes in checkboxes
        echo "<form action='del.php' id='bushoption' method='post'>";
        echo "<div class='choices'>";
        for ($x = 0; $x < count($reqs); $x++) {
            echo "
            <div class='optionl'>

                </br>
        <div id='content'>
                    
                    <h3>";
            for ($z = 0; $z < count($claimd); $z++) {
                if ($reqs[$x]['id'] == $claimd[$z]['claimid']) {
                    for ($y = 0; $y < count($uinfo); $y++) {
                        if ($claimd[$z]['userid'] == $uinfo[$y]['id']) {
                            echo $uinfo[$y]['username'] . 'wants to take your request:' . $reqs[$x]['task'];
                            echo '</br>';
                        }
                    }
                };
            }
            echo $reqs[$x]['reqid'];
            // echo $bush[$x]['id'];
            echo "</br>";
            // echo $bush[$x]['pay'];
            echo "</h3>

                    <p>";
            // echo $bush[$x]['taskdetail'];
            echo "</p>
                    <input type='checkbox' name='selected[]' value='{1}'>
                    <label for='selected[]'> Select?</label><br>
                </div>
            </div>";
        }
        echo "</div>";

        ?>
        <input type='submit' value='delete'>
        </form>
    </div>

</body>

</html>