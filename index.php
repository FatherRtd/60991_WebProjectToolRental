<?php
    require __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;
    if(file_exists(__DIR__."/.env"))
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    $host = $_ENV['host'];
    $db = $_ENV['database'];
    $user = $_ENV['user'];
    $pass = $_ENV['password'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    echo ("<table border='1'>");
    $result = $conn->query("SELECT * FROM user");
    while($row = $result->fetch())
    {
        echo '<tr>';
        echo '<td>'.$row['id'].'</td><td>'.$row['firstname'].' '.$row['lastname'].'</td>';
        echo '</tr>';
    }
    echo ("</table>");

?>