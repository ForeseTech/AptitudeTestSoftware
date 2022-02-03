<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Aptitude Test - Mocks 2022</title>

		<!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600&display=swap" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="../static/css/test.css" rel="stylesheet">
		<!-- Timer JS -->
		<script src = "../static/js/timer.js"></script>
	</head>

	<body>
		<span id="timer"></span>

		<form method="POST" action="php/test-index.php" name="test" id="test">
		
			<?php

				require '../sql_connections.php';
				require '../includes/utilities.php';

				$name    = sanitize(strtoupper($_POST['name']));
				$regNum  = sanitize($_POST['regIn']);
				$dept    = sanitize($_POST['dept']);
				$email   = sanitize($_POST['email']);

				// Establish database connection
				$conn = getConn();
				$sql_query = "INSERT INTO users VALUES(SNO, :name, :regNum, :deptInput, :email)";
				$sql = $conn->prepare($sql_query);
				$sql->execute([
					':name'         => $name,
					':regNum'       => $regNum,
					':deptInput'    => $dept,
					':email' 		=> $email,
				]);
				
				$qCount = 1;

				$setNo = ((int)$regNum % 3);
				$offset = $setNo * 10;

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$quants = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$verbal = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic= 'PROGRAMMING' LIMIT 10 OFFSET $offset";
				$stmt = $conn->query($sql_stmt);
				$programming = $stmt->fetchAll();

				$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE CoreDept = :CoreDept";
				$stmt = $conn->prepare($sql_stmt);
				$stmt->execute([":CoreDept" => $dept]);
				$core = $stmt->fetchAll();
				
				$results = array_merge($quants, $verbal, $programming, $core);
			?>

			<?php foreach($results as $row) : ?>

				<?php
					$question = nl2br($row['QuestionText']);
					$optA  = nl2br($row['OptA']);
					$optB  = nl2br($row['OptB']);
					$optC  = nl2br($row['OptC']);
					$optD  = nl2br($row['OptD']);
					$image = $row["Picture"];
				?>

				<div class = "question">
					<?= $qCount ?>. <?= $question ?>
				</div>

				<?php if ($image !== "None") : ?>
					<img src="<?= $image ?>" alt="Question Image" width="400" />
				<?php endif; ?>

				<div class="options">
					<label>
						<input type="radio" id="mc<?= $qCount ?>" name="question<?= $qCount ?>" value="A"><?= $optA ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $qCount ?>" name="question<?= $qCount ?>" value="B"><?= $optB ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $qCount ?>" name="question<?= $qCount ?>" value="C"><?= $optC ?><br>
					</label>
					<label>
						<input type="radio" id="mc<?= $qCount ?>" name="question<?= $qCount ?>" value="D"><?= $optD ?><br>
					</label>
				</div>

				<?php $qCount += 1; ?>

			<?php endforeach; ?>

			<input type="hidden" name="department" value="<?= $dept ?>">
			<input type="hidden" name="regnumber" value="<?= $regNum ?>">
			<button type="submit">SUBMIT TEST</button>

		</form>

		<footer>
			Copyright &copy; 2022 - <b>FOR</b>um for <b>E</b>conomic <b>S</b>tudies by <b>E</b>ngineers - 
			Designed and Developed by<b> FORESE Tech</b>
    	</footer>

	</body>
	<script src="../static/js/script.js"></script>
</html>
