<?php
session_start();
if (isset($_SESSION['counter'])) {
} else {
	header("Location: login.php");
}
if (isset($_POST['signout'])) {
	session_destroy();
	header("Location: login.php");
}
require "../database/db.php";

$start = mysqli_query($system, "SELECT * from control where name='dresult'");
$crow = mysqli_fetch_array($start);
if ($crow[2] != 1) {
	session_destroy();
	header("Location: login.php");
}
?>

<html>

<head>
	<title> Result of Voting </title>
	<link rel="icon" type="image/x-icon" href="../image/logo.jpg">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.svg" width="200px" height="60px">
			<input type="submit" class="hbtn" style="margin-left: 78%;" value="Signout" name="signout">
		</div>
	</form>
	<form method="post">
		<div style="padding:1px 16px; position:relative; z-index:1;">
			<h1 align="center">RESULT OF VOTING</h1>
			<?php
			$id = $_SESSION['counter'];
			$query = mysqli_query($system, "SELECT * from vote_counter where login_id ='$id'");
			$area = mysqli_fetch_array($query);
			$vote = mysqli_query($system, "SELECT * from countvote where area='$area[4]' ORDER BY `countvote`.`vote` DESC");

			echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Vote</th>
					</tr>
			";

			while ($array = mysqli_fetch_array($vote)) {
				$qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'AND area = '$area[4]'");
				$row = mysqli_fetch_array($qury);
				echo "
					<tr align='center'>
						<td><img src='../image/Candidate/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/Candidate/" . $row[4] . "' height='150' width='120'></td>
						<td>" . $array[3] . "</td>
					</tr>
				";
			}
			echo "</table>";
			?>
		</div>

	</form>

</body>

</html>