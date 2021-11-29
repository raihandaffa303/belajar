<?php 
session_start();
session_destroy();
header("location:daffa_login.php");
?>