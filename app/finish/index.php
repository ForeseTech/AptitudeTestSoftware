<?php

// TODO : Show what answers the user has entered and the actual correct answers.
// TODO : Will have to store the answer of each question for each user in the database.
// TODO : Improve UI of the index.php page
session_start();

// Include necessary modules 
require_once '../../includes/pdo.php';
require_once '../../includes/utilities.php';

date_default_timezone_set('Asia/Kolkata');

// Sanitize GET parameters
$sec1 = sanitize($_GET['s1']);
$sec2 = sanitize($_GET['s2']);
$sec3 = sanitize($_GET['s3']);
$sec4 = sanitize($_GET['s4']);

$total = $sec1 + $sec2 + $sec3 + $sec4;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Finish Page</title>

  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />


  <link rel="icon" href="../../favicon.ico" />


	<link href="finishPage.css" rel="stylesheet">
</head>

<body>

	<div class="container">
		<div class="display-4 text-center mt-5 mb-5">Your Result</div>

		<p>
			<b>Section 1 : <br>Verbal Ability</b> : <?= $sec1; ?> / 25
			<br>
		</p>

		<p>
			<b>Section 2 : <br>Quantitative Aptitude</b> : <?= $sec2; ?> / 16
			<br>
		</p>

		<p>
			<b>Section 3 : <br>Logical Reasoning</b> : <?= $sec3; ?> / 14
			<br>
		</p>


		<p>
			<b>Section 4 : <br>Programming</b> : <?= $sec4; ?> / 7
			<br>
		</p>

		<!-- Display total score -->
		<p>
			<b>Total Score : <?= $total; ?> / 62</b>
		</p>
	</div>

	<p id="total">
		Please screenshot this page for future use.
		<br>
		You may now close this browser tab.
	</p>
</body>

<?php
$regNum = $_SESSION["regNum"];
$startTestTime = $_SESSION["startTestTime"];

$endTestTime = new DateTime("now", new DateTimeZone("Asia/Kolkata")); 
$endTestTimeStamp = $endTestTime->format("Y-m-d H:i:s");

$timeInterval = $endTestTime->diff($startTestTime);
$timeIntervalFormat = $timeInterval->format("%i minutes");

$sql = "UPDATE users SET end_time = :end_time, time_taken = :time_taken WHERE reg_no = :reg_no";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	":reg_no" => $_SESSION['regNum'],
	":end_time" => $endTestTimeStamp,
	":time_taken" => $timeIntervalFormat,
]);

$sql = "INSERT INTO scores(reg_no, sec_1, sec_2, sec_3, sec_4, total) VALUES(:reg_no,:sec_1,:sec_2,:sec_3,:sec_4,:total)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	':reg_no' => $_SESSION['regNum'],
	':sec_1' => $sec1,
	':sec_2' => $sec2,
	':sec_3' => $sec3,
	':sec_4' => $sec4,
	':total' => $total,
]);

// Destroy the session after the test resuts have been shown so that user cannot go back and edit his answers.
session_unset();
session_destroy();
?>

</html>
