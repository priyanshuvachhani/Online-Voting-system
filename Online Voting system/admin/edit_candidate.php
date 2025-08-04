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
	<title> Edit Candidate </title>
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
			<h2 align="center">UPDATE CANDIDATE</h2>
			<?php
			if (isset($_GET["no"])) {
				$qury = mysqli_query($system, "SELECT * from candidate where no=" . $_GET["no"]);
				$row = mysqli_fetch_array($qury);
				$name = $row[3];
				$img = $row[4];
			}
			if (isset($_POST["submit"])) {
				$qury = mysqli_query($system, "SELECT * from candidate where no=" . $_GET["no"]);
				$del = mysqli_fetch_array($qury);
				$path = "../image/Candidate/";

				$canimageName = $del[3];
				$desti_aimage = $path . $canimageName . ".jpg";
				unlink($desti_aimage);

				$start = mysqli_query($system, "SELECT * from control where name='svoting'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					if (isset($_FILES['canimage'])) {
						$path = "../image/Candidate/";

						// Process and store the image
						$canimage = $_FILES['canimage'];
						$canimageName = $_POST['candidate'];
						$desti_aimage = $path . $canimageName . ".jpg";
						move_uploaded_file($canimage['tmp_name'], $desti_aimage);
					}

					$candidate = $_POST["candidate"];
					$canimage = $_POST["candidate"] . ".jpg";

					$qury = mysqli_query($system, "UPDATE candidate set candidate='$candidate' where no=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE candidate set canimage='$canimage' where no=" . $_GET["no"]);
					if ($qury) {
						header("location:candidate_list.php");
					} else {
						echo "<script>
								alert('Something wrong in edit data.......!');
							</script>";
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
					<td><label for="candidate"><b>Name of candidate:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name of candidate" name="candidate" value="<?php echo $name; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="canimage"><b>Candidate photo(jpg):</b></label></td>
					<td><input type="file" class="afile" name="canimage" value="<?php echo $img; ?>" accept="image/jpg" required></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Update"></td>
				</tr>
			</table>
		</div>
	</form>
</body>

</html>