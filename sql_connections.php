<?php

function getConn() {
  $DB_HOST =  "remotemysql.com";
  $DB_NAME =  "3f3XkfQeQr";
  $DB_USERNAME =  "3f3XkfQeQr";
  $DB_PASSWORD =  "ZRB7dBQCqd";
  $DB_CHARSET =  "utf8mb4";

  $dsn = "mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";charset=" . $DB_CHARSET;
  $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  try {
      $pdo = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD, $options);
  } catch (PDOException $e) {
      echo $e->getMessage();
  }

  return $pdo;
}

?>
