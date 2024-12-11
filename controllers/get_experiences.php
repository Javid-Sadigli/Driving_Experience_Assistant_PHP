<?php
    include_once("./include_all.php");

    session_start();
    $_SESSION['code'] = array();

    $drivingExperiences = DrivingExperience::findAll(); 

    foreach($drivingExperiences as $drivingExperience)
    {
        $key = random_pw(20); 
        $_SESSION['code'][$key] = $drivingExperience->getExperienceId(); 
    }

    $_SESSION['redirect']['table'] = true;

    header('Location: ../views/templates/table.php');
    exit; 


