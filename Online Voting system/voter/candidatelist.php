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
	<title> Candidate list </title>
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
				<li><a class="active" href="">Candidate list</a></li>
				<li><a href="result.php">Result of Voting</a></li>
				<input style="float:right" type="submit" class="lobtn" value="Signout" name="signout">
			</ul>
		</div>

		<h2>Candidate list</h2>
		<?php
		require "./database.php";
		$qury = mysqli_query($system, "SELECT * from candidate");

		echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Select Candidate</th>
					</tr>
			";

		while ($row = mysqli_fetch_array($qury)) {
			echo "
					<tr align='center'>
						<td><img src='../image/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/" . $row[4] . "' height='150' width='120'></td>
						<td><input type='radio' value='" . $row[0] . "' name='party' required></td>
						</tr>
				";
		}
		echo "	<tr align='center'>
					<td colspan=5><input type='submit' class='btn' value='Submit Your Vote' name='submit'></td>
				</tr></table>";
		$start = mysqli_query($system, "SELECT * from control where name='vstart'");
		$row = mysqli_fetch_array($start);
		if ($row[2] == 1) {
			if (isset($_POST['submit'])) {

				$vid = $_SESSION["vid"];
				$voted = mysqli_query($system, "SELECT vid from voted where vid='" . $vid . "'");
				$oldvid = mysqli_fetch_array($voted);

				if (isset($_POST['party']) && $oldvid[0] != $vid) {

					$count = mysqli_query($system, "INSERT into voted (`vid`)
					values('$vid') ");

					$select = mysqli_query($system, "SELECT vote from countvote where no=" . $_POST['party']);
					$array = mysqli_fetch_array($select);
					$add = $array[0] + 1;
					$update = mysqli_query($system, "UPDATE countvote set vote='$add' where no=" . $_POST['party']);
					echo "<script>
							alert('Your Vote has been submitted');
						</script>";
				} else {
					echo "<script>
							alert('You have Voted');
						</script>";
				}
			}
		} else {
			echo "<script>
					alert('Voting has not started yet');
				</script>";
		}
		?>
	</form>
</body>

</html>