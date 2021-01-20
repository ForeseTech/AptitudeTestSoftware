<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>APTITUDE TEST</title>

		<link href="../static/css/test-index.css" rel="stylesheet">
		<script src = "../static/js/index.js"></script>
	</head>

	<body>
		<span id="timer"></span>

		<form method="POST" id="quiz" action="php/test-index.php" name="quiz">
		
			<?php

				require '../sql_connections.php';
				require '../includes/utilities.php';

				$name       = sanitize(strtoupper($_POST['nameIn']));
				$regnumber  = sanitize($_POST['regIn']);
				$department = sanitize($_POST['deptIn']);
				$section    = !empty($_POST['sectionInput']) ? sanitize($_POST['sectionInput']) : "";
				$email      = sanitize($_POST['emailIn']);


				$conn = getConn();
				$sql_query = "INSERT INTO users VALUES(SNO, :name, :regNum, :deptInput, :sectionInput, :email)";
				$sql = $conn->prepare($sql_query);
				$sql->execute([
					':name'         => $name,
					':regNum'       => $regnumber,
					':deptInput'    => $department,
					':sectionInput' => $section,
					':email' 				=> $email,
				]);
				
				$question_count = 1;


				$conn = getConn();
									
				$offsetArr = array("AUT" => 0, "BIO" => 0, "CHE" => 0, "CIV" => 10, "CSE" => 10, "EEE" => 10, "ECE" => 20, "INT" => 20, "MEC" => 20);
				$offset = $offsetArr[$department];

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE CoreDept = :CoreDept";
				$stmt = $conn->prepare($sql_stmt);
				$stmt->execute([":CoreDept" => $department]);
				$core = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$verbal = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$quant = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic= 'PROGRAMMING' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$programming = $stmt->fetchAll();

				$results = array_merge($core, $verbal, $quant, $programming);
			
			?>

			<?php foreach($results as $row) : ?>

				<?php
					$question = nl2br($row['QuestionText']);
					$optiona  = nl2br($row['OptA']);
					$optionb  = nl2br($row['OptB']);
					$optionc  = nl2br($row['OptC']);
					$optiond  = nl2br($row['OptD']);
				?>

				<div class = "questions"><b><?= $question_count ?>. <?= $question ?></b></div>

				<div class="options">
					<label>
						<input type="radio" id="mc<?= $question_count ?>" name="question<?= $question_count ?>" value="A"><?= $optiona ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $question_count ?>" name="question<?= $question_count ?>" value="B"><?= $optionb ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $question_count ?>" name="question<?= $question_count ?>" value="C"><?= $optionc ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $question_count ?>" name="question<?= $question_count ?>" value="D"><?= $optiond ?><br>
					</label>
				</div>

				<?php $question_count += 1; ?>

			<?php endforeach; ?>

			<input type="hidden" name="department" value="<?= $department ?>">
			<input type="hidden" name="regnumber" value="<?= $regnumber ?>">

			<button type="submit">Submit!</button>

		</form>
	</body>
</html>
