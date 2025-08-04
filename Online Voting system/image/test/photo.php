<?php session_start(); ?>
<html>

<head>
	<title> Login </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.jpg">
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<form method="POST" action="">
  	  		<video id="webcam" width="280px" autoplay></video>
    		<button onclick="captureImage()" class="lbtn" name="photo">Capture Photo</button>
			<script src="save_photo.js"></script>
	</form>
</body>

</html>