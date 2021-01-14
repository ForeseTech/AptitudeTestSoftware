<?php

// TODO : Use fetch() instead of AJAX
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

if ($questionNum != 51): ?>

<?php

$offsetArr = array("AUT" => 0, "BIO" => 0, "CHE" => 0, "CIV" => 10, "CSE" => 10, "EEE" => 10, "ECE" => 20, "INT" => 20, "MEC" => 20);
$offset = $offsetArr[$_SESSION['department']];

$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE CoreDept = :CoreDept";
$stmt = $pdo->prepare($sql_stmt);
$stmt->execute([":CoreDept" => $_SESSION['department']]);
$core = $stmt->fetchAll();

$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$verbal = $stmt->fetchAll();

$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$quant = $stmt->fetchAll();

$sql_stmt = "SELECT QuestionText, OptA, OptB, OptC, OptD, Picture FROM questions WHERE QuestionTopic= 'PROGRAMMING' LIMIT 10 OFFSET $offset";
$stmt = $pdo->query($sql_stmt);
$programming = $stmt->fetchAll();

$questions = array_merge($core, $verbal, $quant, $programming);
?>

	<header id="question">
		<?php echo "<p><b>".$questionNum.". </b>" . $questions[$questionNum - 1]['QuestionText']."</p>"; ?>
		<!-- "<b>$questionNum</b>. $questionText" -->
	</header>

	<?php if ($questions[$questionNum - 1]["Picture"] != "NONE"): ?>
		<img src=images/$picture>
	<?php endif;?>


	<div id="options">

		<label for="opt_a">
			<input type="radio" name="option" value="1" id="opt_a" class="radio_ans"><?=$questions[$questionNum - 1]['OptA'];?>
			<br>
		</label>
		<br>

		<label for="opt_b">
			<input type="radio" name="option" value="2" id="opt_b" class="radio_ans"><?=$questions[$questionNum - 1]['OptB'];?>
			<br>
		</label>
		<br>

		<label for="opt_c">
			<input type="radio" name="option" value="3" id="opt_c" class="radio_ans"><?=$questions[$questionNum - 1]['OptC'];?>
			<br>
		</label>
		<br>

		<label for="opt_d">
			<input type="radio" name="option" value="4" id="opt_d" class="radio_ans"><?=$questions[$questionNum - 1]['OptD'];?>
			<br>
		</label>
		<br>

	</div>

	<button type="button" class="form-buttons" id="prevBtn">Previous</button>
	<button type="button" class="form-buttons" id="nextBtn">Next</button>

<?php else: ?>

	<p id="finishPara">
		You have reached the final question. Your time limit is not over yet. You could review your answers <b>or</b> submit your answers and finish the test.
	</p>
	<button type="button" id="finishTestBtn" class="form-Buttons">Submit Answers!</button>

<?php endif;?>

<script>
	var checkedOpt  = <?=$checkedOpt;?>;
	var questionNum = <?=$questionNum;?>;
	var prevNum     = <?=$prevNum;?>;
	var nextNum     = <?=$nextNum;?>;
</script>

<script src="questionOutput.js"></script>
