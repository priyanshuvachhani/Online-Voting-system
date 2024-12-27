<?php
session_start();
if (isset($_SESSION['manager'])) {
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
	<title> Manager Home </title>
	<link rel="icon" type="image/x-icon"  href="../image/logo.png">
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="sidebar.css">
	<link rel="stylesheet" href="all.css">
</head>
<?php
require "./database.php";
$start = mysqli_query($system, "SELECT * from control where name='vstart'");
$crow = mysqli_fetch_array($start);
if ($crow[2] != 1) {
    session_destroy();
	header("Location: login.php");
}
?>
<body>
	<form method="post">
		<div class="header">
			<IMG src="../image/logo.png" width="55px" height="55px">
			<h2 style="margin:15px 0;">Admin Panel</h2>
			<input type="submit" class="sobtn" value="Signout" name="signout">
		</div>
		<ul align="center">
			<li><a class="active" href="homeboothmanager.php">Home</a></li>
			<li><a href="bmvoterlist.php">Voter list</a></li>
		</ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">Search Voter</h2>
            <table align="center">
                <tr>
                    <td><i class="fa-solid fa-magnifying-glass fa-xl"></i></td>
                    <td><input type="text" class="atex" name="name" placeholder="Search Voter(name)" autocomplete="off"></td>
                    <td align="center" colspan="2"><input type="submit" class="abtn" name="search" value="Search"></td>
                </tr>
            </table>
            <?php
            if (isset($_POST["search"])) {
                $qury = mysqli_query($system, "SELECT * from voter where name='".$_POST['name']."'");
				$row = mysqli_fetch_array($qury);
				$bmqury = mysqli_query($system, "SELECT * from booth_manager where login_id='".$_SESSION['manager']."'");
				$bmrow = mysqli_fetch_array($bmqury);
				if($bmrow[4] === $row[4]){
					$qury = mysqli_query($system, "SELECT * from voter where name='".$_POST['name']."'");
                	echo "<table class='table'>
						<tr>
							<th>Name</th>
							<th>Aadhar card Noumber</th>
							<th>Voter ID Noumber</th>
							<th>Area</th>
							<th>Status</th>
						</tr>
			    	";
					
					while ($row = mysqli_fetch_array($qury)) {
						$voted = mysqli_query($system, "SELECT vid from voted where vid='" . $row[3] . "'");
						if (mysqli_num_rows($voted) == 0) {
    						echo "
	    						<tr align='center'>
				    				<td>" . $row[1] . "</td>
					    			<td>" . $row[2] . "</td>
	                            	<td>" . $row[3] . "</td>
									<td>" . $row[4] . "</td>
									<td class='edit'><a href='markasvoted.php?no=" . $row[0] . "'>Mark As Voted</a></td>
    							</tr>";
						} else {
							echo "
								<tr align='center'>
									<td>" . $row[1] . "</td>
									<td>" . $row[2] . "</td>
									<td>" . $row[4] . "</td>
									<td>Already Voted</td>
								</tr>";
						}
					}
					echo "</table>";
				}
			}
            ?>
        </div>
	</form>
</body>

</html>