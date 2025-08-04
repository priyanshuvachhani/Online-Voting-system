<?php
session_start();
if (isset($_SESSION['admin'])) {
} else {
	header("Location: login.php");
}
if (isset($_POST['signout'])) {
	session_destroy();
	header("Location: login.php");
}
require "../database/db.php";
?>

<html>

<head>
	<title> Candidate List </title>
	<link rel="icon" type="image/x-icon" href="../image/logo.jpg">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post">
		<div class="header">
			<a href="home.php"><IMG src="../image/logo.svg" width="200px" height="60px"></a>
			<button id="menub" type="button">
				<h2 style="margin: 0;"><i class="fa-solid fa-bars"></i> Menu</h2>
			</button>
			<input type="submit" class="hbtn" value="Signout" name="signout">
		</div>
		<?php include 'menu.php'; ?>
		<script src="menu.js"></script>
	</form>
	<form method="post">
		<div style="padding:1px 16px; position:relative; z-index:1;">
			<h2 align="center">LIST OF CANDIDATE</h2>
			<?php
			$qury = mysqli_query($system, "SELECT * from candidate ORDER BY `candidate`.`area` ASC");

			echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Area</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
			";

			while ($row = mysqli_fetch_array($qury)) {
				echo "
					<tr align='center'>
						<td><img src='../image/Candidate/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/Candidate/" . $row[4] . "' height='150' width='120'></td>
						<td>" . $row[5] . "</td>
						<td><a href='edit_candidate.php?no=" . $row[0] . "'><i class='fa-solid fa-pencil fa-2xl' style='color: blue;'></i></a></td>
						<td><a href='delete_candidate.php?no=" . $row[0] . "'><i class='fa-solid fa-trash-can fa-2xl' style='color: red;'></i></a></td>
					</tr>";
			}
			echo "</table>";
			?>
		</div>
	</form>
</body>

</html>