<?php
session_start();
if (isset($_SESSION['fullname'])) {
} else {
	header("Location: login.php");
}
if (isset($_POST['signout'])) {
	session_destroy();
	header("Location: login.php");
}
?>


<html>

<head>
	<title> Home </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="all.css">
</head>

<body>
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.png" width="65px" height="65px">
			<h2 style="margin:15px 0;">Vote India</h2>
			<ul>
				<li><a class="active" href="">Home</a></li>
				<li><a href="candidatelist.php">Candidate list</a></li>
				<li><a href="result.php">Result of Voting</a></li>
				<input style="float:right" type="submit" class="lobtn" value="Signout" name="signout">
			</ul>
		</div>

		<h1 style="margin:15px;">This is Online Voting system</h1>
	</form>
</body>

</html>