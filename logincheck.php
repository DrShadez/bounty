<body>
    <?php

    //accessing session info
    session_start();

    $sessionid = $_SESSION["seshid"];

    require 'config.php';

    //if user isn't logged in, redirect to signin
    if (!isset($_SESSION["valid"])) {
        header('Location:signin.php');
    }


    //backend validation for if either of the text fields are empty
    if (empty(htmlspecialchars($_POST['username']))) {
        echo "empty username";
        exit;
    } elseif (empty(htmlspecialchars($_POST['pass']))) {
        echo "empty password";
        exit;
    }

    try {
        //dbh configuration
        $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');

        //seperate query for getting info from user_info
        $sth1 = $dbh->prepare("SELECT * FROM user_info WHERE username=:enteredusername");

        $sth1->bindValue(":enteredusername", htmlspecialchars($_POST['username']));
        $sth1->execute();
        $userinfo = $sth1->fetchAll();
        //getting the password of the user that is logged in
        $realpass = ($userinfo[0]["passhash"]);
        $adminuser = 'admin';
        $isadmin = 1;

        //query for accessing all of userinfo that is specific to admin
        $adminsth = $dbh->prepare("SELECT * FROM user_info WHERE `username`=:adminuser AND `is_admin`=:isadmin");
        $adminsth->bindValue(":adminuser", $adminuser);
        $adminsth->bindValue(":isadmin", $isadmin);
        $adminsth->execute();
        $admininfo = $adminsth->fetchColumn();


        //if the user has a username of admin, check that the password is correct, and then redirect to adminview.  Also pass "valid" to $_SESSION[ädminvalid""]

        if (htmlspecialchars($_POST['username']) == $adminuser) {
            if (password_verify(htmlspecialchars($_POST['pass']), $realpass)) {
                header('Location:adminview.php');
                $_SESSION["adminvalid"] = "valid";
            } else {
                echo "wrong username or password";
            }
        }



        //if the rows exist, and the passwords are correct, redirect user to catalogue.php
        elseif (isset($userinfo)) {
            if (password_verify(htmlspecialchars($_POST['pass']), $realpass)) {
                header('Location:main.php');
                $_SESSION["valid"] = "valid";
                echo "everything worked";
            }
            //checking for if the username or passwords don't match
            elseif (!password_verify(htmlspecialchars($_POST['pass']), $realpass)) {
                echo "wrong username or password";
            } else {
                echo "wrong username or password";
            }
        }

        //defines the session username
        if (isset($_SESSION["user"])) {
            // code...
        } else {
            $_SESSION["user"] = htmlspecialchars($_POST['username']);
            $_SESSION["id"] = $userinfo[0]["id"];
        }

        echo "<a href='signin.php'>back</a>";
    } catch (PDOException $e) {
        echo "<p>Error connecting to database!</p>";
    }

    ?>

</body>