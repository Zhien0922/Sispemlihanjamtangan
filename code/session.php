<?php

session_start();
if(!isset($_SESSION['idpengguna']) && !isset($_SESSION['idadmin'])){
    header("location: index.php");
    exit();
}

?>