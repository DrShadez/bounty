<html>

<head>
    <link rel="stylesheet" href="p2.css">

</head>

<body class='haha2'>


    <!--navbar config-->
    <ul class="nav">
        <li><a href="home.php">Home </a></li>
        <li><a href="catalogue.php">Cuts</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li class="logoish"><a href="home.php">TheCuts</a></li>
    </ul>

    <p class='center'> Sign In to view our catalogue </p>
    <table>
        <tr>
            <td>
                <h1 class="center"> Sign In </h1>
                <?php
                //accessing session info
                session_start();
                require 'config.php';

                try {
                    //dbh configuration
                    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');

                    //seperate query for getting info from user_info table
                    $sth1 = $dbh->prepare("SELECT * FROM user_info");

                    $sth1->execute();
                    $userinfo = $sth1->fetchAll();


                    //form for username and password textboxes
                    echo "<div class = 'center'><form action='logincheck.php' id='home' method='post'>";

                    echo "<div><input type='text' id='username' name='username' placeholder='username' required></div>";

                    echo "<div><input type='password' id='pass' name='pass' placeholder='password' required></div>";

                    echo "<div><input type='submit' class = 'sub' value='login'></div>";
                    echo "</form><div>";
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>";
                }

                ?>
            </td>
        </tr>
    </table>
    <p class='center'>Don't have an account? Click Here: <a href='signup.php' class='button'> SIGN UP </a></p>

</body>

</html>