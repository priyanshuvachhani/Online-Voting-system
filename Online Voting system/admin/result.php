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
	<title>Result of Voting</title>
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
			<h2 align="center">RESULT OF VOTING</h2>
			<table align="center">
				<tr>
					<td><label for="area"><b>Area:</b></label></td>
					<td><select class="atex" name="area" required>
							<option disabled="disabled" selected>Select Area</option>
							<?php
							$selc = mysqli_query($system, "SELECT * from area");
							if ($selc) {
								while ($row = mysqli_fetch_array($selc)) {
									echo "<option value='{$row[1]}'>{$row[1]}</option>";
								}
							}
							?>
						</select></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Search"></td>
				</tr>
			</table>
			<?php
			if (isset($_POST["submit"]) && isset($_POST["area"])) {
				$area = $_POST["area"];
				$vote = mysqli_query($system, "SELECT * from countvote where area='$area' ORDER BY `countvote`.`vote` DESC");
				echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Area</th>
						<th>Vote</th>
					</tr>
				";

				while ($array = mysqli_fetch_array($vote)) {
					$qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'AND area = '$array[2]'");
					$row = mysqli_fetch_array($qury);
					echo "
					<tr align='center'>
						<td><img src='../image/Candidate/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/Candidate/" . $row[4] . "' height='150' width='120'></td>
						<td>" . $row[5] . "</td>
				       	<td>" . $array[3] . "</td>
                    </tr>";
				}
				echo "</table>";
			} else {
				$vote = mysqli_query($system, "SELECT * FROM countvote ORDER BY area ASC, vote DESC");

				echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Area</th>
						<th>Vote</th>
					</tr>
				";

				while ($array = mysqli_fetch_array($vote)) {
					$qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'AND area = '$array[2]'");
					$row = mysqli_fetch_array($qury);
					echo "
					<tr align='center'>
						<td><img src='../image/Candidate/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/Candidate/" . $row[4] . "' height='150' width='120'></td>
						<td>" . $row[5] . "</td>
				       	<td>" . $array[3] . "</td>
                    </tr>";
				}
				echo "</table>";
			}
			?>
		</div>
	</form>
</body>

</html>