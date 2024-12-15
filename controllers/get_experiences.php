<?php
    include_once("./include_all.php");

    session_start();
    $_SESSION['experiences'] = array();

    $drivingExperiences = DrivingExperience::findAll(); 

    foreach($drivingExperiences as $drivingExperience)
    {
        $key = random_pw(20); 
        $_SESSION['experiences'][$key] = $drivingExperience; 
    }

    $_SESSION['redirect']['table'] = true;

    header('Location: ../views/templates/table.php');
    exit; 


