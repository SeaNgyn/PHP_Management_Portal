<?php
    define('DATABASE_SERVER', 'turntable.proxy.rlwy.net');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASSWORD', 'tự điền');
    define('DATABASE_NAME', 'Php_SM');
    define('DATABASE_PORT', 'tự điền');

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
