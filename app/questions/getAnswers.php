<?php 

// TODO : Use helper function to retrieve records from database
session_start();

// Include necessary files
require_once '../../includes/pdo.php';

$offsetArr = array("AUT" => 0, "BIO" => 0, "CHE" => 0, "CIV" => 10, "CSE" => 10, "EEE" => 10, "ECE" => 20, "INT" => 20, "MEC" => 20);
$offset = $offsetArr[$_SESSION['department']];

$sql_stmt = "SELECT CorrectOpt FROM questions WHERE CoreDept = :CoreDept";
$stmt = $pdo->prepare($sql_stmt);
$stmt->execute([":CoreDept" => $_SESSION['department']]);
$core = $stmt->fetchAll();

$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$verbal = $stmt->fetchAll();

$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$quant = $stmt->fetchAll();

$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic= 'PROGRAMMING' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$programming = $stmt->fetchAll();

$answers = array_merge($core, $verbal, $quant, $programming);
$ans = array();

foreach($answers as $row) {
  $correctAns = $row['CorrectOpt'];

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
