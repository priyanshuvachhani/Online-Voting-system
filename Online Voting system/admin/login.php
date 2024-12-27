<?php session_start(); ?>
<html>

<head>
	<title> Login </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
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

			<input type="submit" class="lbtn" value="Signin" name="signin">
		</div>
	</form>
	
	<?php
	$n = "SOU";
	$p = "123";
	
	require "./database.php";
	if (isset($_POST['signin'])) //signin
	{
		$qury = mysqli_query($system, "SELECT * from booth_manager where login_id= '" . $_POST["ID"]."'");
		$row = mysqli_fetch_array($qury);
            
		if ($n == $_POST['ID'] && $p == $_POST['password']) {
			$_SESSION['admin'] = $_POST['ID'];
			$_SESSION['password'] = $_POST['password'];
			header("Location: voterlist.php");
		}
		elseif ($row[2] == $_POST['ID'] && $row[3] == $_POST['password']){
			$start = mysqli_query($system, "SELECT * from control where name='vstart'");
        	$crow = mysqli_fetch_array($start);
			if ($crow[2] == 1){
				$_SESSION['manager'] = $_POST['ID'];
				$_SESSION['password'] = $_POST['password'];
				header("Location: homeboothmanager.php");
			}else {
				echo "<script>
					alert('Voting has not started yet');
				</script>";
				}
		}
	}
	if (isset($_SESSION['admin'])) //relod
	{
		header("Location: voterlist.php");
	}
	elseif (isset($_SESSION['manager']))
	{
		header("Location: homeboothmanager.php");
	}
	?>
</body>

</html>