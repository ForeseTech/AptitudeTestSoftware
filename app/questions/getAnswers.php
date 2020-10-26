<?php 

// TODO : Use helper function to retrieve records from database

// Include necessary files
require_once '../../includes/pdo.php';

$sql_stmt = "SELECT CORRECT_OPT FROM test";
$stmt = $pdo->query($sql_stmt);
$results = $stmt->fetchAll();
$ans = array();

foreach($results as $row) {
  $correctAns = $row['CORRECT_OPT'];

  if($correctAns == 'A') {
    echo "1";
  }

  else if($correctAns == 'B') {
    echo "2";
  }

  else if($correctAns == 'C') {
    echo "3";
  }

  else if($correctAns == 'D') {
    echo "4";
  }
}

?>
