<?php 
  require_once '../../includes/pdo.php';
  require_once '../../includes/utilities.php';

  $result = loadAnswers($pdo, "test3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

  <link rel="icon" href="../../favicon.ico" />
  <link rel="stylesheet" href="answers.css">

  <title>Test 1 Answers</title>
</head>
<body>
  <div class="display-4 text-center mt-5">CTS Mock Test 3 Answers</div>
  <div class="container">

    <?php foreach($result as $row) : ?>
      <b><?=$row['QNO'];?></b>.
      <?=nl2br($row['QUESTION_TEXT']);?><br><br>
      A. <?=$row['OPTA'];?><br>
      B. <?=$row['OPTB'];?><br>
      C. <?=$row['OPTC'];?><br>
      D. <?=$row['OPTD'];?><br><br>
      Correct Option : <b><?=$row['CORRECT_OPT'];?></b>
      <br><br>
    <?php endforeach; ?>

  </div>
</body>
</html>
