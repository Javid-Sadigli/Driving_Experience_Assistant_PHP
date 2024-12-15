<?php
    session_start(); 
    $_SESSION['experiences'] = array();
    $_SESSION['redirect'] = array(); 
    $_SESSION['action'] = array();
    $_SESSION['pass-to-controller'] = array();

    $_SESSION['redirect']['homepage'] = true; 

    header('Location: ../views/templates/index.php');
    exit; 