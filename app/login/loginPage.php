<?php

// TODO : Use helper function for inserting records into database
// TODO : Store login time and time and test finish time in database
session_start();

// Include necessary modules
require_once '../../includes/pdo.php';
require_once '../../includes/utilities.php';


// Sanitize user input
$name = strtoupper(sanitize($_POST['nameInput']));
$regNum = sanitize($_POST['regNum']);
$deptInput = sanitize($_POST['deptInput']);
$sectionInput = !empty($_POST['sectionInput']) ? sanitize($_POST["sectionInput"]) : "";
$email = sanitize($_POST['emailInput']);

$startTestTime = new DateTime("now", new DateTimeZone("Asia/Kolkata"));
$startTestTimeStamp = $startTestTime->format("Y-m-d H:i:s");
$timeInterval = $startTestTime->diff($startTestTime);
$timeInterval = $timeInterval->format("%m minutes");

$_SESSION['regNum'] = $regNum;
$_SESSION["startTestTime"] = $startTestTime;

$sql = "INSERT INTO users VALUES(SNO, :name, :regNum, :deptInput, :sectInput, :email, :start_time, :end_time, :time_taken)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name' => $name,
    ':regNum' => $regNum,
    ':deptInput' => $deptInput,
    ':sectInput' => $sectionInput,
    ':email' => $email,
    ':start_time' => $startTestTimeStamp,
    ':end_time' => $startTestTimeStamp, // Update this time at the end of the test
    ':time_taken' => $timeInterval,
]);

redirect("../rules/");
