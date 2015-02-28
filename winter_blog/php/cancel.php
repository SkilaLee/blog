<?php
// session_unset();
// session_destroy();
// unset($_SESSION['views']);
	session_start();
session_destroy();
header('Location: ../index.php');
?>