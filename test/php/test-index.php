<?php

	require '../../sql_connections.php';
	
	$regnumber = (int)$_POST['regnumber'];
	$department = $_POST['department'];

	$correct_answers = array();
	$count = 0;

	$conn = getConn();

	$offsetArr = array("AUT" => 0, "BIO" => 0, "CHE" => 0, "CIV" => 10, "CSE" => 10, "EEE" => 10, "ECE" => 20, "INT" => 20, "MEC" => 20);
	$offset = $offsetArr[$department];

	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE CoreDept = :CoreDept";
	$stmt = $conn->prepare($sql_stmt);
	$stmt->execute([":CoreDept" => $department]);
	$core = $stmt->fetchAll();

	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' LIMIT 10 OFFSET $offset";
	$stmt = $conn->query($sql_stmt);
	$verbal = $stmt->fetchAll();

	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' LIMIT 10 OFFSET $offset";
	$stmt = $conn->query($sql_stmt);
	$quant = $stmt->fetchAll();

	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic= 'PROGRAMMING' LIMIT 10 OFFSET $offset";
	$stmt = $conn->query($sql_stmt);
	$programming = $stmt->fetchAll();

	$results = array_merge($core, $verbal, $quant, $programming);

	foreach($results as $row) {
		$correct_answers[$count] = $row['CorrectOpt'];
		$count += 1;
	}

	$count = 0;
	$no_of_questions = count($correct_answers);

	$correct = 0;
	$section_scores = array (0, 0, 0, 0);

	for($count = 0; $count < $no_of_questions; $count += 1) {
	
		$question_count = $count + 1;
		$user_answer = !empty($_POST["question$question_count"]) ? $_POST["question$question_count"] : "";

		if($correct_answers[$count] == $user_answer){
			$correct += 1;

			if($count < 20) {
				$section_scores[0] += 1;
			}
			else if($count < 30) {
				$section_scores[1] += 1;
			}
			else if($count < 40) {
				$section_scores[2] += 1;
			}
			else if($count < 50) {
				$section_scores[3] += 1;
			}
		}

	}

	$conn      = getConn();
	$sql_query = "INSERT INTO scores(reg_no, sec_1, sec_2, sec_3, sec_4, total) VALUES(:reg_no,:sec_1,:sec_2,:sec_3,:sec_4,:total)";
	$stmt      = $conn->prepare($sql_query);
	$stmt->execute([
		':reg_no' => $regnumber,
		':sec_1' => $section_scores[0],
		':sec_2' => $section_scores[1],
		':sec_3' => $section_scores[2],
		':sec_4' => $section_scores[3],
		':total' => $correct,
	]);

	$alert_message  = "Your submission has been successfully recorded!\\n";
	$alert_message .= "Your score is as follows:\\n\\n";
	$alert_message .= "Section 1 (Core Department) : $section_scores[0]/20\\n";
	$alert_message .= "Section 2 (Verbal Ability) : $section_scores[1]/10\\n";
	$alert_message .= "Section 3 (Quantitative Ability) : $section_scores[2]/10\\n";
	$alert_message .= "Section 4 (Programming) : $section_scores[3]/10\\n";
	$alert_message .= "Your total score is $correct/50! Your results shall be sent as a soft-copy to your e-mail soon. Thank you!";

	echo "<script>alert('$alert_message')</script>;";
	echo "<script>window.location.href='../../login/index.html'</script>;";
?>


