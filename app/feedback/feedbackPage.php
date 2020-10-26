<?php 
// TODO : Validate if all fields are filled
session_start();

// Include necessary modules
require_once '../../includes/pdo.php';
require_once '../../includes/utilities.php';

$regNo = $_SESSION['regNum'];
$questionQuality = sanitize($_POST['questionQuality']);
$interfaceQuality = sanitize($_POST['interfaceQuality']);
$commentText = sanitize($_POST['commentText']);

$sql_stmt = "INSERT INTO feedback VALUES(SNO, :regNum, :questionQuality, :interfaceQuality, :commentText)";
$stmt = $pdo->prepare($sql_stmt);
$stmt->execute([
  ':regNum' => $regNo,
  ':questionQuality' => $questionQuality,
  ':interfaceQuality' => $interfaceQuality,
  ':commentText' => $commentText,
]);

?>
