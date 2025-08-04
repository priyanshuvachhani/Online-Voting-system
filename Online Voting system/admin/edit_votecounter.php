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
	<title> Edit Vote Counter </title>
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
			<h2 align="center">UPDATE VOTE COUNTER</h2>
			<?php
			if (isset($_GET["no"])) {
				$qury = mysqli_query($system, "SELECT * from vote_counter where id=" . $_GET["no"]);
				$row = mysqli_fetch_array($qury);
				$name = $row[1];
				$id = $row[2];
				$password = $row[3];
				$area = $row[4];
			}
			if (isset($_POST["submit"]) && isset($_POST["area"])) {
				$qury = mysqli_query($system, "SELECT * from vote_counter where id=" . $_GET["no"]);
				$del = mysqli_fetch_array($qury);
				$path = "../image/Vote Counter/";
				$photoName = $del[2];
				$desti_aphoto = $path . $photoName . ".jpg";
				unlink($desti_aphoto);

				$start = mysqli_query($system, "SELECT * from control where name='svoting'");
				$row = mysqli_fetch_array($start);
				if ($row[2] == 0) {
					if (isset($_FILES['photo'])) {
						$path = "../image/Vote Counter/";

						$photo = $_FILES['photo'];
						$photoName = $_POST['id'];
						$desti_aphoto = $path . $photoName . ".jpg";
						move_uploaded_file($photo['tmp_name'], $desti_aphoto);
					}

					$name = $_POST["name"];
					$id = $_POST["id"];
					$password = $_POST["password"];
					$photo = $_POST["id"] . ".jpg";
					$area = $_POST["area"];

					$qury = mysqli_query($system, "UPDATE vote_counter set name='$name' where id=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE vote_counter set login_id='$id' where id=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE vote_counter set password='$password' where id=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE vote_counter set area='$area' where id=" . $_GET["no"]);
					$qury = mysqli_query($system, "UPDATE vote_counter set photo='$photo' where id=" . $_GET["no"]);
					if ($qury) {
						header("location:votecounter_list.php");
					} else {
						echo "<script>
								alert('Something wrong in edit data.......!');
							</script>";
					}
				} else {
					echo "<script>
							alert('Voting Started You Cannot Update Vote Counter');
						</script>";
				}
			}
			?>
			<table align="center">
				<tr>
					<td><label for="name"><b>Name:</b></label></td>
					<td><input type="text" class="atex" placeholder="Name" name="name" value="<?php echo $name; ?>" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="id"><b>Login_ID:</b></label></td>
					<td><input type="text" class="atex" placeholder="Login_ID" name="id" value="<?php echo $id; ?>" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label for="password"><b>Password:</b></label></td>
					<td><input type="text" class="atex" placeholder="Password" name="password" value="<?php echo $password; ?>" autocomplete="off" required></td>
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
					<td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Insert"></td>
				</tr>
			</table>
		</div>
	</form>
</body>

</html>