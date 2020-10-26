<?php

define("DB_HOST", "localhost");
define("DB_NAME", "cts_aptitude");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_CHARSET", "utf8mb4");

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
} catch (PDOException $e) {
    echo $e->getMessage();
}
