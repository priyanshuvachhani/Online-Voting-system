<html>

<head>
	<title> Edit Candidate </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="sidebar.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post" enctype="multipart/form-data">
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
            <li><a href="arealist.php">Area list</a></li>
			<li><a href="addcandidate.php">ADD Candidate</a></li>
			<li><a class="active" href="candidatelist.php">Candidate list</a></li>
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
			<h2 align="center">UPDATE CANDIDATE</h2>
			<?php
			if (isset($_GET["no"])) {
				$qury = mysqli_query($system, "SELECT * from candidate where no=" . $_GET["no"]);
				$row = mysqli_fetch_array($qury);
				$logo = $row[1];
				$party = $row[2];
				$name = $row[3];
				$img = $row[4];
			}
			if (isset($_POST["submit"])) {
				$start = mysqli_query($system, "SELECT * from control where name='vstart'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					if (isset($_FILES['logo']) && isset($_FILES['canimage'])) {
						$admin = "C:/xampp/htdocs/voting/image/";

						// Process and store the LOGO
						$logo = $_FILES['logo'];
						$logoName = $logo['name'];
						$desti_alogo = $admin . $logoName;
						move_uploaded_file($logo['tmp_name'], $desti_alogo);


						// Process and store the image
						$canimage = $_FILES['canimage'];
						$canimageName = $canimage['name'];
						$desti_aimage = $admin . $canimageName;
						move_uploaded_file($canimage['tmp_name'], $desti_aimage);
					}

					$party = $_POST["party"];
					$logo = $logo['name'];
					$candidate = $_POST["candidate"];
					$canimage = $canimage['name'];

					$qury = mysqli_query($system, "UPDATE candidate set logo='$logo' where no=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE candidate set party='$party' where no=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE candidate set candidate='$candidate' where no=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE candidate set canimage='$canimage' where no=" . $_GET["no"]);
					$count = mysqli_query($system, "UPDATE countvote set party='$party' where no=" . $_GET["no"]);
					if ($qury && $count) {
						header("location:candidatelist.php");
					} else {
						echo "Something wrong in edit data.......!";
					}
				} else {
					echo "<script>
							alert('Voting Started You Cannot Update Candidate');
						</script>";
				}
			}
			?>
			<table align="center">
				<tr>
					<td><label for="party"><b>Name of party:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name of party" name="party" value="<?php echo $party; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="logo"><b>LOGO(png):</b></label></td>
					<td><input type="file" class="afile" name="logo" value="<?php echo $logo; ?>" accept="image/png" required></td>
				</tr>
				<tr>
					<td><label for="candidate"><b>Name of candidate:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name of candidate" name="candidate" value="<?php echo $name; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="canimage"><b>Candidate photo(png):</b></label></td>
					<td><input type="file" class="afile" name="canimage" value="<?php echo $img; ?>" accept="image/png" required></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Update"></td>
				</tr>
			</table>
		</div>
	</form>
</body>

</html>