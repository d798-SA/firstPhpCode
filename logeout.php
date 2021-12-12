<?php
session_start();

if (isset($_SESSION['logged_in'])) {

    $_SESSION = [];
    $_SESSION['messges'] = "You Now leaving the world We hope see you soon";
    header('location: index.php');
    die();
};
