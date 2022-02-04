<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootswatch CSS -->
  <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.css" />

  <!-- DataTables Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../static/css/leaderboard.css">
  
  <title>Leaderboard</title>
</head>
<body>
  <div class="container mt-5">
    <table class="table table-bordered table-hover" id="scores">
      <thead>
        <tr>
          <th>SNo.</th>
          <th>Register Num.</th>
          <th>Name</th>
          <th>Dept.</th>
          <th>E-Mail ID</th>
          <th>Quants</th>
          <th>Verbal</th>
          <th>Coding</th>
          <th>Core</th>
          <th>Total</th>
        </tr>
      </thead>
      
      <tbdoy>

        <?php 

          require '../sql_connections.php';
          $conn = getConn();

          $query = "SELECT scores.SNO, scores.reg_no, users.name, users.dept, users.email, scores.sec_1, scores.sec_2, scores.sec_3, scores.sec_4, scores.total FROM scores, users WHERE scores.reg_no = users.reg_no ORDER by users.dept";

          $stmt = $conn->query($query);
          $students = $stmt->fetchAll();
        ?>

        <?php foreach($students as $key => $student) : ?>
          <tr>
            <td><?= $key + 1; ?></td>
            <td><?= $student["reg_no"]; ?></td>
            <td><?= $student["name"]; ?></td>
            <td><?= $student["dept"]; ?></td>
            <td><?= $student["email"]; ?></td>
            <td><?= $student["sec_1"]; ?></td>
            <td><?= $student["sec_2"]; ?></td>
            <td><?= $student["sec_3"]; ?></td>
            <td><?= $student["sec_4"]; ?></td>
            <td><?= $student["total"]; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbdoy>
    </table>
  </div>
  <footer>
      Copyright &copy; 2022 <b>FOR</b>um for <b>E</b>conomic <b>S</b>tudies by <b>E</b>ngineers - Designed and Developed
      by
      <b>FORESE Tech</b>
    </footer>
</body>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- DataTablesJS -->
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

  <!-- DataTables for Bootstrap -->
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

  <!-- Initialize Datatables -->
  <script>
    $(document).ready(function () {
      $("#scores").DataTable({paging: false});
    });
  </script>
</html>
