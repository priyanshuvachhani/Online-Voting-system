<html>

<head>
	<title> Database </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
</head>

<body>
	<?php
	$system = new mysqli("localhost", "root", "", "voting_system");
	if (!$system) {
		// die('Not connected'. mysqli_error ( )) ;
		echo  "Not Connected";
	}
	?>
</body>

</html>