<?php

  function getConn() {
    // Authentication credentials
    
    // $db_url   = parse_url("mysql://b9ad6106fda39e:7a6d2989@us-cdbr-east-03.cleardb.com/heroku_01cda5d379b4d85?reconnect=true");
    // $db_url   = parse_url("mysql://root:@localhost:3306/mocks?reconnect=true");

    $db_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $DB_HOST     = $db_url["host"];
    $DB_USERNAME = $db_url["user"];
    $DB_PASSWORD = $db_url["pass"];
    $DB_NAME     = substr($db_url["path"], 1);
    $DB_CHARSET  = "utf8mb4";

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
