<?php

function getConn() {
    // Authentication credentials
    $cleardb_url = parse_url("my_sql_url");
    $DB_HOST = $cleardb_url["host"];
    $DB_USERNAME = $cleardb_url["user"];
    $DB_PASSWORD = $cleardb_url["pass"];
    $DB_NAME = substr($cleardb_url["path"], 1);
    $DB_CHARSET = "utf8mb4";

//   $DB_HOST =  "localhost";
//   $DB_NAME =  "mocks";
//   $DB_USERNAME =  "root";
//   $DB_PASSWORD =  "";
//   $DB_CHARSET =  "utf8mb4";

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
