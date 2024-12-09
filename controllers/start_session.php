<?php
include('../util/random_pw.php');

session_start(); 
$_SESSION['code'] = array();
$code = random_pw(20);
$_SESSION['code'][$code] = 0;

header('Location: ../views/templates/index.php');
exit; 