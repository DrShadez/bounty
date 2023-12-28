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

    <p class='center'> Sign Up to gain access! </p>
    <table>
        <tr>
            <td>
                <h1 class='center'> Sign up </h1>

                <?php
                //accessing session info
                session_start();
                require 'config.php';

                try {
                    //dbh configuration
                    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');

                    //seperate query for getting info from player table
                    $sth1 = $dbh->prepare("SELECT * FROM user_info");

                    $sth1->execute();
                    $userinfo = $sth1->fetchAll();

                    //form for making username and password, and retyping password
                    echo "<div class = 'center'><form action='loginstore.php' id='home' method='post'>";

                    echo "<div><input type='text' id='usernamemake' name='usernamemake' placeholder='Create username' required></div>";

                    echo "<div><input type='password' id='passmake' name='passmake' placeholder='Create password' required></div>";

                    echo "<div><input type='password' id='confirmpass' name='confirmpass' placeholder='Retype password' required></div>";

                    echo "<div><input type='submit' class ='sub' value='signup'></div>";
                    echo "</form></div>";
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>";
                }

                ?>
            </td>
        </tr>
    </table>
    <p class='center'> Already have an account? Click Here: <a href='signin.php' class='button'>Sign In </a> </p>
</body>

</html>