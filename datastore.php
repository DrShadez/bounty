
<?php
//accessing session info
session_start();
require 'config.php';

//if user isn't logged in, redirect to signin
if (!isset($_SESSION["valid"])) {
    header('Location:signin.php');
}
//backend validation for if any of the text fields are empty
if (empty(htmlspecialchars($_POST['usernamemake']))) {
    echo "empty username";
    exit;
} elseif (empty(htmlspecialchars($_POST['passmake']))) {
    echo "empty password";
    exit;
}
try {

    //dbh configuration
    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    //hashing the password that the users input
    $newpay = htmlspecialchars($_POST['passmake']);
    //storing the username that the users input
    $newusername = htmlspecialchars($_POST['usernamemake']);
    $newtask = htmlspecialchars($_POST['task']);



    //seperate query for getting info from user_info where the user info belongs to the username that is logged in
    $sth = $dbh->prepare("SELECT * FROM requests WHERE taskdetail=:newuser");
    $sth->bindValue(":newuser", $newusername);
    $sth->execute();
    // $count = $sth->fetchColumn();
    $count = 0;
    //if the username already exists, don't allow it
    if ($count > 1) {
        echo "username already taken";
    }


    //more backend validation

    elseif (empty(htmlspecialchars($_POST['usernamemake']))) {
        echo "please put a username";
    } elseif (empty(htmlspecialchars($_POST['passmake']))) {
        echo "please put a password";
    }
    //if the username is admin, give it the value$isadmin=1
    else {
        if (htmlspecialchars($_POST['usernamemake'] == 'admin')) {
            $isadmin = 1;
        }
        //elseif the username isn't admin, don't give them admin powers
        elseif (htmlspecialchars($_POST['usernamemake']) !== 'admin') {

            $isadmin = 0;
        }

        //insert all this information into user_info
        $sth2 = $dbh->prepare("INSERT INTO `requests` (is_admin, pay, taskdetail, task, reqid) VALUES (:is_admin,:pay,:taskdetail,:task, :reqid)");
        $sth2->bindValue(":is_admin", $isadmin);
        $sth2->bindValue(":pay", $newpay);
        $sth2->bindValue(":taskdetail", $newusername);
        $sth2->bindValue(":task", $newtask);
        $sth2->bindValue(":reqid", $_SESSION["id"]);
        $sth2->execute();
        //extract requests with the user id
        //once everything is executed, redirect to login
        header('location:main.php');
    }









    echo "<a href='signup.php'>back</a>";
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>";
}

?>
