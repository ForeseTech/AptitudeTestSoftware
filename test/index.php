<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>MOCK PLACEMENT TEST</title>
		<link href="../static/css/test-index.css" rel="stylesheet">
		<script src = "../static/js/index.js"></script>
	</head>

	<body>
		<span id="timer"></span>

		<form method="POST" id = "quiz" action="php/test-index.php" name = "quiz">
		
			<input type="hidden" name="reg_number">

			<?php

				require '../sql_connections.php';

				$name       = strtoupper($_POST['nameIn']);
				$regnumber  = $_POST['regIn'];
				$department = $_POST['deptIn'];
				$email      = $_POST['emailIn'];

				try{

					$conn = getConn();
					$sql_query = "INSERT INTO users VALUES(SNO, :name, :regNum, :deptInput, :email)";
					$sql = $conn->prepare($sql_query);
					$sql->execute([
						':name' => $name,
						':regNum' => $regnumber,
						':deptInput' => $department,
						':email' => $email,
					]);

				} catch(PDOException $e){
					echo $e."<br>";
				}
				
				$question_count = 1;

				try{

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

					foreach($results as $row) {

						$question = nl2br($row['QuestionText']);
						$optiona  = nl2br($row['OptA']);
						$optionb  = nl2br($row['OptB']);
						$optionc  = nl2br($row['OptC']);
						$optiond  = nl2br($row['OptD']);

						echo "<div class = \"questions\"><b>$question_count. $question</b></div>";
						echo "<label>";
						echo "<input type = \"radio\" id = \"mc$question_count\" name = \"question$question_count\" value = \"A\">$optiona<br>";
						echo "</label>";
						echo "<label>";
						echo "<input type = \"radio\" id = \"mc$question_count\" name = \"question$question_count\" value = \"B\">$optionb<br>";
						echo "</label>";
						echo "<label>";
						echo "<input type = \"radio\" id = \"mc$question_count\" name = \"question$question_count\" value = \"C\">$optionc<br>";
						echo "</label>";
						echo "<label>";
						echo "<input type = \"radio\" id = \"mc$question_count\" name = \"question$question_count\" value = \"D\">$optiond<br>";
						echo "</label>";

						$question_count += 1;
					}
				} catch (PDOException $e){
					echo $e."<br>";
				}

				//We finally also pass the department and registration number to avoid session variables/
				echo "<input type='hidden' name='department' value='$department'> ";
				echo "<input type='hidden' name='regnumber' value='$regnumber'> ";

			?>

			<button type="submit">Submit!</button>

		</form>
	</body>
</html>
