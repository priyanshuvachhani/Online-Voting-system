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
?>

<html>

<head>
    <title> Result of Voting </title>
    <link rel="icon" type="image/x-icon"  href="../image/logo.png">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="all.css">
</head>

<body>
    <form method="post">
        <div class="header">
            <IMG src="../image/logo.png" width="55px" height="55px">
            <h2 style="margin:15px 0;">Admin Panel</h2>
            <input type="submit" class="sobtn" value="Signout" name="signout">
        </div>
        <ul align="center">
            <li><a href="home.php">Home</a></li>
            <li><a href="addboothmanager.php">ADD Boothmanager</a></li>
            <li><a href="boothmanagerlist.php">Boothmanager list</a></li>
            <li><a href="addvoter.php">ADD Voter</a></li>
            <li><a href="voterlist.php">Voter list</a></li>
            <li><a href="addarea.php">ADD Area</a></li>
            <li><a href="arealist.php">Area list</a></li>
            <li><a href="addcandidate.php">ADD Candidate</a></li>
            <li><a href="candidatelist.php">Candidate list</a></li>
            <li><a class="active" href="result.php">Result of Voting</a></li>
            <li><?php
                require "./database.php";
                $start = mysqli_query($system, "SELECT * from control where name='vstart'");
                $row = mysqli_fetch_array($start);
                if ($row[2] == 0) {
                    echo "<input type='submit' class='abtn' value='Start Voting' name='start'>";
                    if (isset($_POST['start'])) {
                        $qury = mysqli_query($system, "UPDATE control set status=1 where name='vstart'");
                        echo "	<script>
							alert('Voting Started');
							location.reload();
						</script>";
                        $qury = mysqli_query($system, "UPDATE countvote set vote=0");
                        $result = mysqli_query($system, "DELETE from voted");
                    }
                } else {
                    echo "<input type='submit' class='abtn' value='Stop Voting' name='stop'>";
                    if (isset($_POST['stop'])) {
                        $qury = mysqli_query($system, "UPDATE control set status=0 where name='vstart'");
                        echo "<script>
							alert('Voting Stoped');
							location.reload();
						</script>";
                    }
                }
                ?></li>
        </ul>
        <div style="margin-left:15%; padding:1px 16px;">
            <h2 align="center">RESULT OF VOTING </h2>
            <?php
            $vote = mysqli_query($system, "SELECT * from countvote ORDER BY `countvote`.`vote` DESC");

            echo "<table class='table'>
					<tr>
						<th>Logo</th>
						<th>Party</th>
						<th>Candidate</th>
                        <th>Image</th>
						<th>Select Candidate</th>
					</tr>
			";

            while ($array = mysqli_fetch_array($vote)) {
                $qury = mysqli_query($system, "SELECT * from candidate where party='" . $array[1] . "'");
                $row = mysqli_fetch_array($qury);
                echo "
					<tr align='center'>
						<td><img src='../image/" . $row[1] . "' height='150' width='220'></td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
                        <td><img src='../image/" . $row[4] . "' height='150' width='120'></td>
				";
                echo "       <td>" . $array[2] . "</td>
                    </tr>";
            }
            echo "</table>";
            ?>
        </div>
    </form>
</body>

</html>