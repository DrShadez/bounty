<html>

<head>
    <link rel="stylesheet" href="p2.css">

</head>

<body class='haha2'>


    <!--navbar config-->
    <ul class="nav">
        <li><a href="home.php">Your Requests </a></li>
        <li><a href="main.php">Bounty Board</a></li>
        <li><a href="cart.php">Claimed</a></li>
        <li><a class="current" href="vtest.php">Request</a></li>
        <li class="logoish"><a href="home.php">Bounty</a></li>
        <li><a href="update.php">Updates</a></li>
    </ul>

    <p class='center'> Request Info </p>
    <table>
        <tr>
            <td>
                <h1 class='center'> Request </h1>

                <?php
                //accessing session info
                session_start();
                require 'config.php';
                if (!isset($_SESSION["valid"])) {
                    header('Location:signin.php');
                }

                try {
                    //dbh configuration
                    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');

                    //seperate query for getting info from player table
                    $sth1 = $dbh->prepare("SELECT * FROM requests");

                    $sth1->execute();
                    $userinfo = $sth1->fetchAll();

                    //form for making username and password, and retyping password
                    echo "<div class = 'center'><form action='datastore.php' id='home' method='post'>";
                    echo "<div><input type='text' id='task' class='textfield' name='task' placeholder='task' required></div>";
                    echo "<div><input type='text' class='textfield' id='usernamemake' name='usernamemake' placeholder='details' required></div>";


                    echo "<div><input type='number' class='textfield' id='passmake' name='passmake' placeholder='pay' required></div>";

                    echo "<div><input type='submit' class ='sub' value='signup'></div>";
                    echo "</form></div>";
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>";
                }

                ?>
            </td>
        </tr>
    </table>

</body>

</html>