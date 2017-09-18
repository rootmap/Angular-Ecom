<?php
include '../config/config.php';

AdminLogout();
session_destroy();
header("Location:login.php");

?>