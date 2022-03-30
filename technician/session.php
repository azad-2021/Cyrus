<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user'];
$_SESSION['empid'];

if (!isset($_SESSION['user'])) {
	header('location:index.html');
}


?>