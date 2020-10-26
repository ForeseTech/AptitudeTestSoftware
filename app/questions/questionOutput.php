<?php

// TODO : Each request for a question is being made twice. Need to do something about that.
// TODO : Get all the questions once and store them in an array.
// TODO : Display multiple white spaces for programming questions (indentation)
// TODO : Display question numbers as a navbar.
session_start();

require_once "../../includes/pdo.php";

$questionNum = $_GET["qno"];
$checkedOpt = $_GET["checked"];

$prevNum = 0;
$nextNum = 0;

if ($questionNum == 1) {
	$prevNum = 1;
	$nextNum = 2;
} else {
	$prevNum = $questionNum - 1;
	$nextNum = $questionNum + 1;
}

if ($questionNum != 63) : ?>

	<?php
	$sql_stmt = "SELECT question_text, opta, optb, optc, optd, picture FROM test WHERE qno=:questionNum";
	$stmt = $pdo->prepare($sql_stmt);
	$stmt->execute([":questionNum" => $questionNum]);
	$row = $stmt->fetch();

	$questionText = nl2br($row["question_text"]);
	$optA = $row["opta"];
	$optB = $row["optb"];
	$optC = $row["optc"];
	$optD = $row["optd"];
	$picture = $row["picture"];
	?>

	<header id="question">
		<?= "<b>$questionNum</b>. $questionText"; ?>
	</header>

	<?php if($picture != "NONE") : ?>
		<img src=images/$picture>
	<?php endif; ?>


	<div id="options">

		<label for="opt_a">
			<input type="radio" name="option" value="1" id="opt_a" class="radio_ans"><?= $optA; ?>
			<br>
		</label>
		<br>

		<label for="opt_b">
			<input type="radio" name="option" value="2" id="opt_b" class="radio_ans"><?= $optB; ?>
			<br>
		</label>
		<br>

		<label for="opt_c">
			<input type="radio" name="option" value="3" id="opt_c" class="radio_ans"><?= $optC; ?>
			<br>
		</label>
		<br>

		<label for="opt_d">
			<input type="radio" name="option" value="4" id="opt_d" class="radio_ans"><?= $optD; ?>
			<br>
		</label>
		<br>

	</div>

	<button type="button" class="form-buttons" id="prevBtn">Previous</button>
	<button type="button" class="form-buttons" id="nextBtn">Next</button>

<?php else : ?>

	<p id="finishPara">
		You have reached the final question. Your time limit is not over yet. You could review your answers <b>or</b> submit your answers and finish the test.
	</p>
	<button type="button" id="finishTestBtn" class="form-Buttons">Submit Answers!</button>

<?php endif; ?>

<script>
	var checkedOpt = <?= $checkedOpt; ?>;
	var questionNum = <?= $questionNum; ?>;
	var prevNum = <?= $prevNum; ?>;
	var nextNum = <?= $nextNum; ?>;
</script>

<script src="questionOutput.js"></script>
