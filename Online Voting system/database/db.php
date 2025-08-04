<?php
	$system = new mysqli("localhost", "root", "", "online_voting_system");
	if (!$system) {
		// die('Not connected'. mysqli_error ( )) ;
		echo  "Not Connected";
	}
?>
