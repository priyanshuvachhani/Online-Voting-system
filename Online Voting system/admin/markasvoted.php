<?php
require "./database.php";
$qury = mysqli_query($system, "SELECT * from voter where no=" . $_GET["no"]);
$row = mysqli_fetch_array($qury);
$id = $row[3];
$count = mysqli_query($system, "INSERT into voted (`vid`)
    values('$id') ");
if ($count) {
    header("location:homeboothmanager.php");
}
else{
    echo "<script>
            alert('Already Voted');
        </script>";
}
?>