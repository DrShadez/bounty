<html>

<head>
    <title>Install p2</title>
</head>

<body>
    <?php
    require_once "config.php";
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');

        $query = file_get_contents('p2.sql');
        $dbh->exec($query);
    } catch (PDOException $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
    ?>
</body>