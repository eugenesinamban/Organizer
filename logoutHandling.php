<?php 
session_start();
require_once("classes/Authenticate.php");
Authenticate::logout();
header("location:index.php");
exit();

?>