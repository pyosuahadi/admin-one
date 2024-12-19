<?php
date_default_timezone_set('Asia/Jakarta');
ob_start();

if (session_status() == PHP_SESSION_NONE) {
    session_name('disdoc');
    session_start();
}
set_time_limit(0);

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$section_id = isset($_SESSION['section_id']) ? $_SESSION['section_id'] : null;

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;

?>