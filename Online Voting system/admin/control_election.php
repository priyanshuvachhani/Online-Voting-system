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
	<title>Election Controller</title>
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
			<h1 align="center"> ELECTION CONTROLLER </h1>
			<table class="table">
				<tr>
					<th>
						<h2>No.</h2>
					</th>
					<th>
						<h2>Property</h2>
					</th>
					<th>
						<h2>Status</h2>
					</th>
				</tr>
				<tr align='center'>
					<td>
						<h2>1</h2>
					</td>
					<td>
						<h2>Verification</h2>
					</td>
					<td>
						<h2>
							<?php
							$verifi = mysqli_query($system, "SELECT * from control where name='sverifying'");
							$row = mysqli_fetch_array($verifi);
							if ($row[2] == 0) {
								echo "<input type='submit' class='controlactive' style='background: #00d110;' value='Start' name='verstart'>";
								if (isset($_POST['verstart'])) {
									$control = mysqli_query($system, "SELECT * from control where status=1");
									$crow = mysqli_fetch_array($control);
									if ($crow[2] == 0) {
										$qury = mysqli_query($system, "UPDATE control set status=1 where name='sverifying'");
										echo "	<script>
				                		    		alert('Verification Started');
				                		    		location.reload();
				                		    	</script>";
									} else {
										echo "	<script>
				                			    	alert('Only One Process Start at Same Time');
				                			    </script>";
									}
								}
							} else {
								echo "<input type='submit' class='controlinactive' style='background: red;' value='Stop' name='verstop'>";
								if (isset($_POST['verstop'])) {
									$qury = mysqli_query($system, "UPDATE control set status=0 where name='sverifying'");
									echo "<script>
				                				alert('Verification Stoped');
				                				location.reload();
				                			</script>";
								}
							}
							?>
						</h2>
					</td>
				</tr>
				<tr align='center'>
					<td>
						<h2>2</h2>
					</td>
					<td>
						<h2>Voting</h2>
					</td>
					<td>
						<h2><?php
							$voting = mysqli_query($system, "SELECT * from control where name='svoting'");
							$row = mysqli_fetch_array($voting);
							if ($row[2] == 0) {
								echo "<input type='submit' class='controlactive' style='background: #00d110;' value='Start' name='votstart'>";
								if (isset($_POST['votstart'])) {
									$control = mysqli_query($system, "SELECT * from control where status=1");
									$crow = mysqli_fetch_array($control);
									if ($crow[2] == 0) {
										$qury = mysqli_query($system, "UPDATE control set status=1 where name='svoting'");
										echo "	<script>
				                			    	alert('Voting Started');
				                			    	location.reload();
				                			    </script>";
										$count = mysqli_query($system, "UPDATE countvote set vote=0");
										$result = mysqli_query($system, "DELETE from voted");
									} else {
										echo "	<script>
				                			    	alert('Only One Process Start at Same Time');
				                			    </script>";
									}
								}
							} else {
								echo "<input type='submit' class='controlinactive' style='background: red;' value='Stop' name='votstop'>";
								if (isset($_POST['votstop'])) {
									$qury = mysqli_query($system, "UPDATE control set status=0 where name='svoting'");
									echo "<script>
				                				alert('Voting Stoped');
				                				location.reload();
				                			</script>";
								}
							}
							?></h2>
					</td>
				</tr>
				<tr align='center'>
					<td>
						<h2>3</h2>
					</td>
					<td>
						<h2>Result declaration</h2>
					</td>
					<td>
						<h2><?php
							$result = mysqli_query($system, "SELECT * from control where name='dresult'");
							$row = mysqli_fetch_array($result);
							if ($row[2] == 0) {
								echo "<input type='submit' class='controlactive' style='background: #00d110;' value='Start' name='resstart'>";
								if (isset($_POST['resstart'])) {
									$control = mysqli_query($system, "SELECT * from control where status=1");
									$crow = mysqli_fetch_array($control);
									if ($crow[2] == 0) {
										$qury = mysqli_query($system, "UPDATE control set status=1 where name='dresult'");
										echo "	<script>
				                		    		alert('Result is declared');
				                		    		location.reload();
				                		    	</script>";
									} else {
										echo "	<script>
				                			    	alert('Only One Process Start at Same Time');
				                			    </script>";
									}
								}
							} else {
								echo "<input type='submit' class='controlinactive' style='background: red;' value='Stop' name='resstop'>";
								if (isset($_POST['resstop'])) {
									$qury = mysqli_query($system, "UPDATE control set status=0 where name='dresult'");
									echo "<script>
				                				alert('Result declaration Stoped');
				                				location.reload();
				                			</script>";
								}
							}
							?></h2>
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>

</html>