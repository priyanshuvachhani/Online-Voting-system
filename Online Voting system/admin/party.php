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

if (isset($_GET["delete"])) {
    $delete = $_GET["delete"];
    if ($delete == "true") {
        $start = mysqli_query($system, "SELECT * from control where name='svoting'");
        $row = mysqli_fetch_array($start);
        if ($row[2] == 0) {

            $qury = mysqli_query($system, "SELECT * from political_party where id=" . $_GET["id"]);
            $del = mysqli_fetch_array($qury);

            $path = "../image/Candidate/";
            $logoName = $del[1];
            $desti_alogo = $path . $logoName . ".jpg";
            unlink($desti_alogo);

            $result = mysqli_query($system, "DELETE from political_party where id=" . $_GET["id"]);

            if ($result) {
                header("location:party.php");
            } else {
                echo "Something wrong in delete data.......!";
            }
        } else {
            echo "<script>
                alert('Voting Started You Cannot Delete Political Party');
            </script>";
        }
    }
}
?>

<html>

<head>
    <title> ADD Political Party </title>
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
    <form method="post" enctype="multipart/form-data">
        <div style="padding:1px 16px; position:relative; z-index:1;">
            <h2 align="center">ADD POLITICAL PARTY</h2>
            <table align="center">
                <tr>
                    <td><label for="party"><b>Name of party:</b></label></td>
                    <td><input type="text" class="atex" placeholder="Name of party" name="party" pattern="[A-Za-z. ]{1,}" title="Enter only Alphabets" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="logo"><b>LOGO(jpg):</b></label></td>
                    <td><input type="file" class="afile" name="logo" accept="image/jpg" required></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input type="submit" class="abtn" name="submit" value="Insert"></td>
                </tr>
            </table>
            <?php
            if (isset($_POST["submit"])) {
                $start = mysqli_query($system, "SELECT * from control where name='svoting'");
                $row = mysqli_fetch_array($start);
                if ($row[2] == 0) {
                    if (isset($_FILES['logo'])) {
                        $path = "../image/Candidate/";

                        // Process and store the LOGO
                        $logo = $_FILES['logo'];
                        $logoName = $_POST['party'];
                        $desti_alogo = $path . $logoName . ".jpg";
                        move_uploaded_file($logo['tmp_name'], $desti_alogo);
                    }

                    $party = $_POST["party"];
                    $logo = $_POST["party"] . ".jpg";
                    $qury = mysqli_query($system, "INSERT into political_party (`name`,`logo`)
						values('$party','$logo') ");
                    if ($qury) {
                        header("location:party.php");
                    } else {
                        echo "<script>
								alert('Something wrong in insert data');
							</script>";
                    }
                } else {
                    echo "<script>
							alert('Voting Started You Cannot ADD Political Party');
						</script>";
                }
            }
            ?>
            <h2 align="center">LIST OF POLITICAL PARTY</h2>
            <?php
            $qury = mysqli_query($system, "SELECT * from political_party");

            echo "<table class='table' style='width: 60%;' align='center'>
					<tr>
                        <th>Logo</th>
						<th>Party</th>
						<th>Delete</th>
					</tr>
			";

            while ($row = mysqli_fetch_array($qury)) {
                echo "
					<tr align='center'>
                        <td><img src='../image/Candidate/" . $row[2] . "' height='150' width='220'></td>
						<td>" . $row[1] . "</td>
						<td><a href='party.php?id=" . $row[0] . "&delete=true'><i class='fa-solid fa-trash-can fa-lg' style='color: red;'></i></a></td>
					</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </form>
</body>

</html>