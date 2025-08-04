<?php
session_start();
//relod
if (isset($_SESSION['admin'])) {
	header("Location: home.php");
} elseif (isset($_SESSION['verification'])) {
	header("Location: home_verification.php");
} elseif (isset($_SESSION['manager'])) {
	header("Location: home_manager.php");
} elseif (isset($_SESSION['counter'])) {
	header("Location: home_counter.php");
}
?>
<html>

<head>
	<title> Login </title>
	<link rel="icon" type="image/x-icon" href="../image/logo.jpg">
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<form method="POST" action="">
		<div class="login-box">
			<h1>Sign in</h1>
			<div class="ltextbox">
				<i class="fas fa-user"></i>
				<input type="text" placeholder="ID" name="ID" autocomplete="off" required>
			</div>

			<div class="ltextbox">
				<i class="fas fa-lock"></i>
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="ltextbox">
				<i class="fa-solid fa-list"></i>
				<select class="atex" name="category">
					<option disabled="disabled" selected>select category</option>
					<option value="admin">Election Commissioner</option>
					<option value="verification">Home Verification</option>
					<option value="manager">Booth Manager</option>
					<option value="counter">Vote Counter</option>
				</select>
			</div>

			<input type="submit" class="lbtn" value="Signin" name="signin">
		</div>
	</form>

	<?php

	require "../database/db.php";
	//signin
	if (isset($_POST['signin'])) {
		// Admin signin
		if ($_POST["category"] == "admin") {

			$qury = mysqli_query($system, "SELECT * from admin where login_id= '" . $_POST["ID"] . "'");
			$row = mysqli_fetch_array($qury);

			if ($row[2] == $_POST['ID'] && $row[3] == $_POST['password']) {

				$_SESSION['a'] = $_POST['ID'];
				$_SESSION['password'] = $_POST['password'];
				header("Location: photo.php");

				// $_SESSION['admin'] = $_POST['ID'];
				// $_SESSION['password'] = $_POST['password'];
				// header("Location: home.php");
			} else {
				echo "	<script>
                            alert('Entered Information was wrong');
                        </script>";
			}
		}
		//Home Verification signin
		elseif ($_POST["category"] == "verification") {

			$qury = mysqli_query($system, "SELECT * from home_verification where login_id= '" . $_POST["ID"] . "'");
			$row = mysqli_fetch_array($qury);

			if ($row[2] == $_POST['ID'] && $row[3] == $_POST['password']) {
				$start = mysqli_query($system, "SELECT * from control where name='sverifying'");
				$crow = mysqli_fetch_array($start);
				if ($crow[2] == 1) {

					$_SESSION['v'] = $_POST['ID'];
					$_SESSION['password'] = $_POST['password'];
					header("Location: photo.php");

					// $_SESSION['verification'] = $_POST['ID'];
					// $_SESSION['password'] = $_POST['password'];
					// header("Location: home_verification.php");
				} else {
					echo "<script>
					    alert('Verification has not started yet');
				    </script>";
				}
			} else {
				echo "	<script>
                            alert('Entered Information was wrong');
                        </script>";
			}
		}
		//Booth Manager signin
		elseif ($_POST["category"] == "manager") {

			$qury = mysqli_query($system, "SELECT * from booth_manager where login_id= '" . $_POST["ID"] . "'");
			$row = mysqli_fetch_array($qury);

			if ($row[2] == $_POST['ID'] && $row[3] == $_POST['password']) {
				$start = mysqli_query($system, "SELECT * from control where name='svoting'");
				$crow = mysqli_fetch_array($start);
				if ($crow[2] == 1) {

					$_SESSION['m'] = $_POST['ID'];
					$_SESSION['password'] = $_POST['password'];
					header("Location: photo.php");

					// $_SESSION['manager'] = $_POST['ID'];
					// $_SESSION['password'] = $_POST['password'];
					// header("Location: home_manager.php");
				} else {
					echo "<script>
					    alert('Voting has not started yet');
				    </script>";
				}
			} else {
				echo "	<script>
                            alert('Entered Information was wrong');
                        </script>";
			}
		}
		//Vote Counter signin
		elseif ($_POST["category"] == "counter") {

			$qury = mysqli_query($system, "SELECT * from vote_counter where login_id= '" . $_POST["ID"] . "'");
			$row = mysqli_fetch_array($qury);

			if ($row[2] == $_POST['ID'] && $row[3] == $_POST['password']) {
				$start = mysqli_query($system, "SELECT * from control where name='dresult'");
				$crow = mysqli_fetch_array($start);
				if ($crow[2] == 1) {

					$_SESSION['c'] = $_POST['ID'];
					$_SESSION['password'] = $_POST['password'];
					header("Location: photo.php");

					// $_SESSION['counter'] = $_POST['ID'];
					// $_SESSION['password'] = $_POST['password'];
					// header("Location: home_counter.php");
				} else {
					echo "<script>
					    alert('Result declaration has not started yet');
				    </script>";
				}
			} else {
				echo "	<script>
                            alert('Entered Information was wrong');
                        </script>";
			}
		} else {
			echo "	<script>
						alert('Select Category');
					</script>";
		}
	}

	?>
</body>

</html>