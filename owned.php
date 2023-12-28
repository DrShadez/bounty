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
// checkboxvalidation("sphere");
// checkboxvalidation('spiral');
// checkboxvalidation('maze');
// checkboxvalidation('elephant');
// checkboxvalidation('heart');
// checkboxvalidation('tall');
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

// if (isset($_POST['selected'])) {
//     foreach ($_POST['selected'] as $animal) {
//         echo $animal;
//     }
//     echo $_SESSION['id'];
// }
// //backend validation for if the checkbox is empty
// if (empty(htmlspecialchars($_POST['sphere']))) {
// }

// //if it's checked, insert the value into current order as well as past orders
// else {
//     $sth = $dbh->prepare(

//         "INSERT INTO current_order
//   (`design`, `img`, `user`, `cost`)
//   VALUES('sphere', 'linglong.jpg', :user, :cost );
//   INSERT INTO `pastorders`
//     (`design`, `img`, `user`, `cost`)
//   VALUES('sphere', 'linglong.jpg', :user, :cost )"
//     );
//     $sth->bindValue(":user", $_SESSION["user"]);
//     $sth->bindValue(":cost", $sphere);
//     $sth->execute();
// }
//displays the current_orders that are specific to that user
try {

    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    //hashing the password that the users input
    $countint = 0;


    //seperate query for getting info from user_info where the user info belongs to the username that is logged in
    if (isset($_POST['selected'])) {
        // echo "debug";
        // foreach ($_POST['selected'] as $animal) {
        //     $sth = $dbh->prepare("SELECT * FROM claimed WHERE userid=:newuser AND claimid=:dinga");
        //     $sth->bindValue(":newuser", $_SESSION['id']);
        //     $sth->bindValue(":claimid", $animal);
        //     $sth->execute();
        //     $count = $sth->fetchColumn();

        //     $countint += $count;
        //     echo "debug";
        // }


        // //if the username already exists, don't allow it
        if ($countint > 1) {
            echo "you can't claim the same thing twice";
        } else {
            // echo "debug";

            //insert all this information into user_info
            foreach ($_POST['selected'] as $animal) {
                $sth2 = $dbh->prepare("INSERT INTO `claimed` (userid, claimid) VALUES (:uidd,:claimmid)");
                $sth2->bindValue(":uidd", $_SESSION['id']);
                $sth2->bindValue(":claimmid", $animal);
                echo $animal;


                $sth2->execute();
            }
            //once everything is executed, redirect to login
            header('Location:cart.php');
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
    <form action='loadingbar.php' id='drops' method='POST'>
        <input type='submit' name='buy' id='buy' value='BUY'>
        <a href="pastorders.php">Previous Orders</a>
        <a href="catalogue.php">Back?</a>

    </form>

</body>

</html>