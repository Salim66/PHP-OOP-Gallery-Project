<?php 

// include header
require_once('includes/header.php');

// logout user
$session->logout();
redirect("login.php");