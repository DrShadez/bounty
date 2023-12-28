<title>drop</title>
</head>

<body>
    <?php
    require_once "config.php";
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        //create comic table
        $query = file_get_contents('drop.sql');
        $dbh->exec($query);
        echo "<p>Successfully dropped databases</p>";
    } catch (PDOException $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
    ?>
</body>

</html>