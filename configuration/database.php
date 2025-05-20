<?php
    define('DATABASE_SERVER', 'localhost');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASSWORD', 'Mysql18032003.');
    define('DATABASE_NAME', 'db_sm');
    define('DATABASE_PORT', '3307');

    $connection = null;
    try {
        $connection = new PDO(
            "mysql:host=" . DATABASE_SERVER . ";port=" . DATABASE_PORT . ";dbname=" . DATABASE_NAME,
            DATABASE_USER,
            DATABASE_PASSWORD
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        $connection = null;
    }
?>
