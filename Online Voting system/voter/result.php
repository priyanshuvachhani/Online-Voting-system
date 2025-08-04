<?php
session_start();
if (isset($_SESSION['fullname'])) {
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
	<title> Result of Voting </title>
	<link rel="icon" type="image/x-icon" href="../image/logo.jpg">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body align="center">
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.svg" width="200px" height="60px">
			<ul>
				<li><a href="candidatelist.php">Candidate list</a></li>
				<li><a class="active" href="">Result of Voting</a></li>
			</ul>
			<input type="submit" class="lobtn" value="Signout" name="signout">
		</div>
	</form>
	<form method="post">
		<h2>Result of Voting </h2>
		<?php
		$start = mysqli_query($system, "SELECT * from control where name='dresult'");
		$row = mysqli_fetch_array($start);
		if ($row[2] == 1) {
			$area = $_SESSION['area'];
			$vote = mysqli_query($system, "SELECT * from countvote where area='$area' ORDER BY `countvote`.`vote` DESC");

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
				$qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'AND area = '$area'");
				$row = mysqli_fetch_array($qury);
				echo "
						<tr align='center'>
							<td><img src='../image/Candidate/" . $row[1] . "' height='150' width='220'></td>
							<td>" . $row[2] . "</td>
							<td>" . $row[3] . "</td>
							<td><img src='../image/Candidate/" . $row[4] . "' height='150' width='120'></td>
					";
				echo "       <td>" . $array[3] . "</td>
						</tr>";
			}
			echo "</table>";
		} else {
			echo "<script>
					alert('Result has not declared yet');
				</script>";
		}

		?>
	</form>
</body>

</html>