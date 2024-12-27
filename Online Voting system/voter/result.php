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
?>


<html>

<head>
	<title> Result of Voting </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body align="center">
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.png" width="65px" height="65px">
			<h2 style="margin:15px 0;">Vote India</h2>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="candidatelist.php">Candidate list</a></li>
				<li><a class="active" href="">Result of Voting</a></li>
				<input style="float:right" type="submit" class="lobtn" value="Signout" name="signout">
			</ul>
		</div>
		<h2>Result of Voting </h2>
		<?php
		require "./database.php";
		$vote = mysqli_query($system, "SELECT * from countvote ORDER BY `countvote`.`vote` DESC");

		echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Select Candidate</th>
					</tr>
			";

		while ($array = mysqli_fetch_array($vote)) {
			$qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'");
			$row = mysqli_fetch_array($qury);
			echo "
					<tr align='center'>
						<td><img src='../image/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/" . $row[4] . "' height='150' width='120'></td>
				";
			echo "       <td>" . $array[2] . "</td>
                    </tr>";
		}
		echo "</table>";
		?>
	</form>
</body>

</html>