<?php
require 'session.php';
unset($_SESSION['idpengguna']);
unset($_SESSION['idadmin']);
ob_start();
header("Location: index.php");
ob_end_flush();
exit();
?>
