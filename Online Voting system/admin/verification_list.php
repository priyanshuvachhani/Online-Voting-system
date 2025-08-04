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
	<title>Home Verification List</title>
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
			<h2 align="center">LIST OF HOME VERIFICATION</h2>
			<?php
			$qury = mysqli_query($system, "SELECT * from home_verification");

			echo "<table class='table'>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Login_ID</th>
						<th>Password</th>
						<th>Area</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
			";

			while ($row = mysqli_fetch_array($qury)) {
				echo "
					<tr align='center'>
						<td><img src='../image/Home Verification/" . $row[5] . "' height='70' width='50'></td>
						<td>" . $row[1] . "</td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
						<td>" . $row[4] . "</td>
						<td><a href='edit_verification.php?no=" . $row[0] . "'><i class='fa-solid fa-pencil fa-lg' style='color: blue;'></a></td>
						<td><a href='delete_verification.php?no=" . $row[0] . "'><i class='fa-solid fa-trash-can fa-lg' style='color: red;'></a></td>
						</tr>
				";
			}
			echo "</table>";
			?>
		</div>
	</form>
</body>

</html>