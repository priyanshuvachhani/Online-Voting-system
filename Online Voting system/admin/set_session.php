<?php
session_start();

if (isset($_SESSION['a'])) {
    $_SESSION['admin'] = $_SESSION['a'];
} elseif (isset($_SESSION['v'])) {
    $_SESSION['verification'] = $_SESSION['v'];
} elseif (isset($_SESSION['m'])) {
    $_SESSION['manager'] = $_SESSION['m'];
} elseif (isset($_SESSION['c'])) {
    $_SESSION['counter'] = $_SESSION['c'];
}

?>
