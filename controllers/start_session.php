<?php
    session_start(); 
    $_SESSION['code'] = array();
    $_SESSION['redirect'] = array(); 
    $_SESSION['save'] = array();

    $_SESSION['redirect']['homepage'] = true; 

    header('Location: ../views/templates/index.php');
    exit; 