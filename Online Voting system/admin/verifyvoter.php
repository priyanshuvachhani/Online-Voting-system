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
			<input type="submit" class="hbtn" style="margin-left: 78%;" value="Signout" name="signout">
		</div>
	</form>
	<form method="post" enctype="multipart/form-data">
		<div style="padding:1px 16px; position:relative; z-index:1;">
			<h1 align="center">VERIFY VOTER</h1>
			<?php
			if (isset($_GET["no"])) {
				$qury = mysqli_query($system, "SELECT * from voter where no=" . $_GET["no"]);
				$row = mysqli_fetch_array($qury);
				$name = $row[1];
			}
			if (isset($_POST["submit"]) && isset($_POST["area"])) {
				if (isset($_FILES['photo'])) {
					$qury = mysqli_query($system, "SELECT * from voter where no=" . $_GET["no"]);
					$row = mysqli_fetch_array($qury);
					$path = "../image/Voter/";

					$photo = $_FILES['photo'];
					$photoName = $row[3];
					$desti_aphoto = $path . $photoName . ".jpg";
					move_uploaded_file($photo['tmp_name'], $desti_aphoto);
				}

				$name = $_POST["name"];
				$area = $_POST["area"];

				$qury = mysqli_query($system, "UPDATE voter set name='$name' where no=" . $_GET["no"]);
				$qury = mysqli_query($system, "UPDATE voter set photo='$row[3].jpg' where no=" . $_GET["no"]);
				$qury = mysqli_query($system, "UPDATE voter set area='$area' where no=" . $_GET["no"]);
				if ($qury) {
					header("location:home_verification.php");
				} else {
					echo "Something wrong in edit data.......!";
				}
			}
			?>
			<table align="center">
				<tr>
					<td><label for="name"><b>Name:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name as per Aadhar card" name="name" value="<?php echo $name; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="photo"><b>Photo(jpg):</b></label></td>
					<td><input type="file" class="afile" name="photo" accept="image/jpg" required></td>
				</tr>
				<tr>
					<td><label for="area"><b>Area:</b></label></td>
					<td><select class="atex" name="area" required>
							<option selected><?php echo $row[4]; ?></option>
							<?php
							$selc = mysqli_query($system, "SELECT * from area where name != '" . $row[4] . "'");
							if ($selc) {
								while ($row = mysqli_fetch_array($selc)) {
									echo "<option value='{$row[1]}'>{$row[1]}</option>";
								}
							}
							?>
						</select></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Update"></td>
				</tr>
			</table>
		</div>

	</form>

</body>

</html>