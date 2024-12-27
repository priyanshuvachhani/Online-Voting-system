<html>

<head>
	<title> Edit Area </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="sidebar.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.png" width="55px" height="55px">
			<h2 style="margin:15px 0;">Admin Panel</h2>
			<input type="submit" class="sobtn" value="Signout" name="signout">
		</div>
		<ul align="center">
			<li><a href="home.php">Home</a></li>
			<li><a href="addboothmanager.php">ADD Boothmanager</a></li>
			<li><a href="boothmanagerlist.php">Boothmanager list</a></li>
			<li><a href="addvoter.php">ADD Voter</a></li>
			<li><a href="voterlist.php">Voter list</a></li>
			<li><a href="addarea.php">ADD Area</a></li>
            <li><a class="active" href="arealist.php">Area list</a></li>
			<li><a href="addcandidate.php">ADD Candidate</a></li>
			<li><a href="candidatelist.php">Candidate list</a></li>
			<li><a href="result.php">Result of Voting</a></li>
			<li><?php
				require "./database.php";
				$start = mysqli_query($system, "SELECT * from control where name='vstart'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					echo "<input type='submit' class='abtn' value='Start Voting' name='start'>";
					if (isset($_POST['start'])) {
						$qury = mysqli_query($system, "UPDATE control set status=1 where name='vstart'");
						echo "	<script>
							alert('Voting Started');
							location.reload();
						</script>";
						$qury = mysqli_query($system, "UPDATE countvote set vote=0");
						$result = mysqli_query($system, "DELETE from voted");
					}
				} else {
					echo "<input type='submit' class='abtn' value='Stop Voting' name='stop'>";
					if (isset($_POST['stop'])) {
						$qury = mysqli_query($system, "UPDATE control set status=0 where name='vstart'");
						echo "<script>
							alert('Voting Stoped');
							location.reload();
						</script>";
					}
				}
				?></li>
		</ul>
		<div style="margin-left:15%; padding:1px 16px;">
			<h2 align="center">UPDATE AREA</h2>
			<?php
			if (isset($_GET["no"])) {
				$qury = mysqli_query($system, "SELECT * from area where id=" . $_GET["no"]);
				$row = mysqli_fetch_array($qury);
				$area = $row[1];
			}
			if (isset($_POST["submit"])) {
				$start = mysqli_query($system, "SELECT * from control where name='vstart'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					$area = $_POST["area"];

					$qury = mysqli_query($system, "UPDATE area set name='$area' where id=" . $_GET["no"]);
					if ($qury) {
						header("location:arealist.php");
					} else {
						echo "Something wrong in edit data.......!";
					}
				} else {
					echo "<script>
							alert('Voting Started You Cannot Update Area');
						</script>";
				}
			}
			?>
			<table align="center">
				<tr>
					<td><label for="area"><b>Area:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name as per Aadhar card" name="area" value="<?php echo $area; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Update"></td>
				</tr>
			</table>
		</div>
	</form>
</body>

</html>