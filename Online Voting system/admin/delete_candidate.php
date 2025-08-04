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
    <title> Delete Candidate </title>
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
    <form method="post">
        <div style="padding:1px 16px; position:relative; z-index:1;">
            <h2 align="center">DELETE CANDIDATE</h2>
            <?php
            if (isset($_GET["no"])) {
                $qury = mysqli_query($system, "SELECT * from candidate where no=" . $_GET["no"]);
                $row = mysqli_fetch_array($qury);
                $party = $row[2];
                $name = $row[3];
            }
            if (isset($_POST["submit"])) {
                $start = mysqli_query($system, "SELECT * from control where name='svoting'");
                $row = mysqli_fetch_array($start);
                if ($row[2] == 0) {

                    $qury = mysqli_query($system, "SELECT * from candidate where no=" . $_GET["no"]);
                    $del = mysqli_fetch_array($qury);

                    $path = "../image/Candidate/";

                    $canimageName = $del[3];
                    $desti_aimage = $path . $canimageName . ".jpg";
                    unlink($desti_aimage);

                    $result = mysqli_query($system, "DELETE from candidate where no=" . $_GET["no"]);
                    $count = mysqli_query($system, "DELETE from countvote where no=" . $_GET["no"]);
                    if ($result && $count) {
                        header("location:candidate_list.php");
                    } else {
                        echo "<script>
								alert('Something wrong in delete data.......!');
							</script>";
                    }
                } else {
                    echo "<script>
							alert('Voting Started You Cannot Delete Candidate');
						</script>";
                }
            }
            ?>
            Are you sure to delete the <b><u><?php echo $name; ?></u></b> from <b><u><?php echo $party; ?></u></b>?<br><br>
            <input type="submit" class="abtn" name="submit" value="Delete">
        </div>
    </form>
</body>

</html>