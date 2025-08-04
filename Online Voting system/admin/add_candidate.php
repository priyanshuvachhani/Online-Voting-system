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
	<title> ADD Candidate </title>
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
	<form method="post" enctype="multipart/form-data">
		<div style="padding:1px 16px; position:relative; z-index:1;">
			<h2 align="center">ADD CANDIDATE</h2>
			<table align="center">
				<tr>
					<td><label for="candidate"><b>Name of candidate:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name of candidate" name="candidate" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="canimage"><b>Candidate photo(jpg):</b></label></td>
					<td><input type="file" class="afile" name="canimage" accept="image/jpg" required></td>
				</tr>
				<tr>
					<td><label for="party"><b>Name of party:</b></label></td>
					<td><select class="atex" name="party" required>
							<option disabled="disabled" selected>Select Party Name</option>
							<?php
							$selc = mysqli_query($system, "SELECT * from political_party");
							if ($selc) {
								while ($row = mysqli_fetch_array($selc)) {
									echo "<option value='{$row[1]}'>{$row[1]}</option>";
								}
							}
							?>
						</select></td>
				</tr>
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
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Insert"></td>
				</tr>
			</table>
			<?php
			if (isset($_POST["submit"]) && isset($_POST["area"]) && isset($_POST["party"])) {
				$start = mysqli_query($system, "SELECT * from control where name='svoting'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					if (isset($_FILES['canimage'])) {
						$path = "../image/Candidate/";

						$canimage = $_FILES['canimage'];
						$canimageName = $_POST['candidate'];
						$desti_aimage = $path . $canimageName . ".jpg";
						move_uploaded_file($canimage['tmp_name'], $desti_aimage);
					}


					$party = $_POST["party"];
					$logo = $_POST["party"] . ".jpg";
					$candidate = $_POST["candidate"];
					$canimage = $_POST["candidate"] . ".jpg";
					$area = $_POST["area"];
					$qury = mysqli_query($system, "INSERT INTO candidate (`logo`, `party`, `candidate`, `canimage`, `area`)
    					SELECT * FROM (SELECT '$logo', '$party', '$candidate', '$canimage', '$area') AS tmp
    					WHERE NOT EXISTS (SELECT 1 FROM candidate WHERE party = '$party' AND area = '$area')LIMIT 1");

					$count = mysqli_query($system, "INSERT INTO countvote (`party`, `vote`, `area`)
    					SELECT * FROM (SELECT '$party', '0', '$area') AS tmp
    					WHERE NOT EXISTS (SELECT 1 FROM countvote WHERE party = '$party' AND area = '$area')LIMIT 1");
					if ($qury && $count && mysqli_affected_rows($system) > 0) {
						header("location:candidate_list.php");
					} else {
						echo "<script>
								alert('Something wrong in insert data');
							</script>";
					}
				} else {
					echo "<script>
							alert('Voting Started You Cannot ADD Candidate');
						</script>";
				}
			}
			?>
		</div>
	</form>
</body>

</html>