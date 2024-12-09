<?php
include('../util/random_pw.php');

session_start(); 
$_SESSION['code'] = array();

header('Location: ../views/templates/index.php');
exit; 