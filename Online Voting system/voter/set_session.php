<?php 
session_start();

if (isset($_SESSION['a']) && isset($_SESSION['b']) && isset($_SESSION['c']) && isset($_SESSION['d'])) {
    $_SESSION['fullname'] = $_SESSION['a'];
    $_SESSION['acid'] = $_SESSION['b'];
    $_SESSION['vid'] = $_SESSION['c'];
    $_SESSION['area'] = $_SESSION['d'];
}
