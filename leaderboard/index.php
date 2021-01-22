<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <link rel="stylesheet" href="../static/css/leaderboard.css">
  
  <title>Leaderboard</title>
</head>
<body>
  <div class="container mt-5">
    <table class="table table-bordered table-hover" id="scores">
      <thead>
        <tr>
          <th>SNO</th>
          <th>Register Number</th>
          <th>Name</th>
          <th>Department</th>
          <th>Section</th>
          <th>Section 1</th>
          <th>Section 2</th>
          <th>Section 3</th>
          <th>Section 4</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbdoy>
    <?php 

			require '../sql_connections.php';
			$conn = getConn();

      $query = "SELECT scores.SNO, scores.reg_no, users.name, users.dept, users.section, scores.sec_1, scores.sec_2, scores.sec_3, scores.sec_4, scores.total FROM scores, users WHERE scores.reg_no = users.reg_no";

      $stmt = $conn->query($query);
      $scores = $stmt->fetchAll();

    ?>
    <?php foreach($scores as $key=>$score) : ?>
      <tr>
        <td><?= $key + 1 ?></td>
        <td><?= $score["reg_no"]; ?></td>
        <td><?= $score["name"]; ?></td>
        <td><?= $score["dept"]; ?></td>
        <td><?= $score["section"]; ?></td>
        <td><?= $score["sec_1"]; ?></td>
        <td><?= $score["sec_2"]; ?></td>
        <td><?= $score["sec_3"]; ?></td>
        <td><?= $score["sec_4"]; ?></td>
        <td><?= $score["total"]; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbdoy>
    </table>
  </div>
</body>
</html>
