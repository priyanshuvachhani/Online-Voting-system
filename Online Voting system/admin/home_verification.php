<?php
session_start();
if (isset($_SESSION['verification'])) {
} else {
	header("Location: login.php");
}
if (isset($_POST['signout'])) {
	session_destroy();
	header("Location: login.php");
}
require "../database/db.php";

$start = mysqli_query($system, "SELECT * from control where name='sverifying'");
$crow = mysqli_fetch_array($start);
if ($crow[2] != 1) {
	session_destroy();
	header("Location: login.php");
}
?>

<html>

<head>
	<title> Verify Voter </title>
	<link rel="icon" type="image/x-icon" href="../image/logo.jpg">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.svg" width="200px" height="60px">

			<div class="search">
				<table align="center">
					<tr>
						<td><i class="fa-solid fa-magnifying-glass fa-xl"></i></td>
						<td style="padding: 50px , 0;"><input type="text" class="stex" name="name" placeholder="Search Voter(name)" autocomplete="off"></td>
						<td align="center" colspan="2"><input type="submit" class="hbtn" name="search" value="Search"></td>
					</tr>
				</table>
			</div>

			<input type="submit" class="hbtn" style="margin-left: 0%;" value="Signout" name="signout">
		</div>
	</form>
	<form method="post">
		<div style="padding:1px 16px; position:relative; z-index:1;">
			<h1  align="center">VERIFY VOTER</h1>
			<?php
			if (isset($_POST["search"])) {
				$qury = mysqli_query($system, "SELECT * from voter where name='" . $_POST['name'] . "'");
				$row = mysqli_fetch_array($qury);
				$bmqury = mysqli_query($system, "SELECT * from home_verification where login_id='" . $_SESSION['verification'] . "'");
				$bmrow = mysqli_fetch_array($bmqury);
				if ($row == null) {
					echo "<script>
					    	alert('Voter not found');
				    	</script>";
				} else {
					if ($bmrow[4] === $row[4]) {
						$_POST['print'] = "vp";
						$qury = mysqli_query($system, "SELECT * from voter where name='" . $_POST['name'] . "'");
						echo "<table class='table'>
							<tr>
								<th>Image</th>
								<th>Name</th>
								<th>Aadhar card Noumber</th>
								<th>Voter ID Noumber</th>
								<th>Area</th>
								<th>Status</th>
							</tr>
				    	";

						while ($row = mysqli_fetch_array($qury)) {
							echo "
		    						<tr align='center'>
										<td><img src='../image/Voter/" . $row[5] . "' height='100' width='80'></td>
					    				<td>" . $row[1] . "</td>
						    			<td>" . $row[2] . "</td>
		                            	<td>" . $row[3] . "</td>
										<td>" . $row[4] . "</td>
										<td class='edit'><a href='verifyvoter.php?no=" . $row[0] . "'>Verify Voter</a></td>
	    							</tr>";
						}
						echo "</table>";
					} else {
						echo "<script>
					    	alert('This voter is not from your area');
				    	</script>";
					}
				}
			}
			if (!isset($_POST["print"])) {
				$bmqury = mysqli_query($system, "SELECT * from home_verification where login_id='" . $_SESSION['verification'] . "'");
				$bmrow = mysqli_fetch_array($bmqury);

				$qury = mysqli_query($system, "SELECT * from voter where area='" . $bmrow[4] . "'");
				echo "<table class='table'>
					<tr>
						<th>Name</th>
						<th>Aadhar card Noumber</th>
						<th>Voter ID Noumber</th>
						<th>Area</th>
					</tr>
    			";

				while ($row = mysqli_fetch_array($qury)) {
					$voted = mysqli_query($system, "SELECT vid from voted where vid='" . $row[3] . "'");
					if (mysqli_num_rows($voted) == 0) {
						echo "
    						<tr align='center'>
			    				<td>" . $row[1] . "</td>
				    			<td>" . $row[2] . "</td>
                   		    	<td>" . $row[3] . "</td>
								<td>" . $row[4] . "</td>
							</tr>";
					} else {
						echo "
							<tr align='center'>
								<td>" . $row[1] . "</td>
								<td>" . $row[2] . "</td>
								<td>" . $row[3] . "</td>
                                <td>" . $row[4] . "</td>
							</tr>";
					}
				}
				echo "</table>";
			}
			?>
		</div>

	</form>

</body>

</html>