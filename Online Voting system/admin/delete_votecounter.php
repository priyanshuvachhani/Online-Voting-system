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
    <title> Delete Vote Counter </title>
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
            <h2 align="center">DELETE VOTE COUNTER</h2>
            <?php
            if (isset($_GET["no"])) {
                $qury = mysqli_query($system, "SELECT * from vote_counter where id=" . $_GET["no"]);
                $row = mysqli_fetch_array($qury);
                $name = $row[1];
                $area = $row[4];
            }
            if (isset($_POST["submit"])) {
                $start = mysqli_query($system, "SELECT * from control where name='svoting'");
                $row = mysqli_fetch_array($start);
                if ($row[2] == 0) {
                    $qury = mysqli_query($system, "SELECT * from vote_counter where id=" . $_GET["no"]);
                    $del = mysqli_fetch_array($qury);
                    $path = "../image/Vote Counter/";
                    $photoName = $del[2];
                    $desti_aphoto = $path . $photoName . ".jpg";
                    unlink($desti_aphoto);

                    $result = mysqli_query($system, "DELETE from vote_counter where id=" . $_GET["no"]);
                    if ($result) {
                        header("location:votecounter_list.php");
                    } else {
                        echo "<script>
								alert('Something wrong in delete data.......!');
							</script>";
                    }
                } else {
                    echo "<script>
							alert('Voting Started You Cannot Delete Vote Counter');
						</script>";
                }
            }
            ?>
            Are you sure to delete the Boothmanager with Name:<b><u><?php echo $name; ?></u></b> ; Allocated Area:<b><u><?php echo $area; ?></u></b>?<br><br>
            <input type="submit" class="abtn" name="submit" value="Delete">
        </div>
    </form>
</body>

</html>