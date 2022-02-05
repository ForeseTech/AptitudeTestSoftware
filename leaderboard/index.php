<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    
	<link
      href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped:wght@500;600&family=Roboto+Slab:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
    />

	<!-- Semantic UI CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.semanticui.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../static/css/leaderboard.css">
	
	<title>Leaderboard</title>
	</head>

	<body>
	    <h1 class="ui header">Leaderboard</h1>
		
		<div class="ui container">
			<table class="ui celled table" id="scores">
				<thead>
					<tr>
					<th>SNo.</th>
					<th class="duplifer">Register Num.</th>
					<th>Name</th>
					<th>Dept.</th>
					<th>E-Mail ID</th>
					<th>Quants</th>
					<th>Verbal</th>
					<th>Coding</th>
					<th>Core</th>
					<th>Total</th>
					<th>Action</th>
					</tr>
				</thead>
			
				<tbdoy>

					<?php 

						require '../sql_connections.php';
						$conn = getConn();

						$query = "SELECT scores.SNO, users.reg_no, users.name, users.dept, users.email, scores.sec_1, scores.sec_2, scores.sec_3, scores.sec_4, scores.total FROM scores, users WHERE scores.reg_no = users.reg_no ORDER BY reg_no";

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
							<td>
								<form action="delete.php" method="POST">
									<input type="hidden" name="sno" value="<?= $student["SNO"]; ?>">
									<button type="submit" style="background-color: white;border:none;cursor:pointer">
										<i class="icon trash alternate red large"></i>
									</button>
								</form>
							</td>
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

	<!-- Duplifier JS -->
	<script src="../static/js/duplifier.js"></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.semanticui.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
	
	<!-- Initialize Datatables and Duplifier -->
	<script>
		$(document).ready(function () {
			$("#scores").DataTable({ paging: false });
			$(".table").duplifer();
		});
	</script>

</html>
