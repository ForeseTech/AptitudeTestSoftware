<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>MockTest Answers Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  </head>

  <body>
    <h1 class="text-center text-uppercase">Answer Keys</h1>
    <main class="container">
    <?php 
	    require '../sql_connections.php';
	    $conn = getConn();
      $sql_stmt = "SELECT * FROM questions ORDER BY QuestionTopic DESC, CoreDept";
      $stmt = $conn->query($sql_stmt);
	    $result = $stmt->fetchAll();
    ?>
    <?php foreach($result as $index => $row) : ?>
      <b><?=$index + 1;?></b>.
      <?= nl2br($row['QuestionText']);?><br><br>
      <b>Question Topic </b> : <?= $row['QuestionTopic']; ?><br>
      <?php if($row["CoreDept"]) : ?>
        <b>Core Department</b> : <?= $row["CoreDept"]; ?><br>
      <?php endif; ?>
      A. <?=$row['OptA'];?><br>
      B. <?=$row['OptB'];?><br>
      C. <?=$row['OptC'];?><br>
      D. <?=$row['OptD'];?><br><br>
      Correct Option : <b><?=$row['CorrectOpt'];?></b>
      <br><br>
    <?php endforeach; ?>
    </main>
  </body>
</html>
