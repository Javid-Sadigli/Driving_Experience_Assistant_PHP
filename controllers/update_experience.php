<?php
    include_once("./include_all.php");

    session_start();

    $drivingExperience = DrivingExperience::findById(
        $_SESSION['pass-to-controller']['save']['experience_id']
    );
    
    $drivingExperience->setDate($_SESSION['pass-to-controller']['save']['date']);
    $drivingExperience->setStartTime($_SESSION['pass-to-controller']['save']['start_time']);
    $drivingExperience->setEndTime($_SESSION['pass-to-controller']['save']['end_time']);
    $drivingExperience->setKm($_SESSION['pass-to-controller']['save']['km']); 
    
    if($_SESSION['pass-to-controller']['save']['weatherId'])
    {
        $drivingExperience->setWeatherConditionById($_SESSION['pass-to-controller']['save']['weatherId']); 
    }
    else 
    {
        $drivingExperience->setWeatherCondition(null); 
    }

    if($_SESSION['pass-to-controller']['save']['roadId'])
    {
        $drivingExperience->setRoadConditionById($_SESSION['pass-to-controller']['save']['roadId']);
    }
    else 
    {
        $drivingExperience->setRoadCondition(null);
    }

    if($_SESSION['pass-to-controller']['save']['trafficId'])
    {
        $drivingExperience->setTrafficConditionById($_SESSION['pass-to-controller']['save']['trafficId']); 
    }
    else 
    {
        $drivingExperience->setTrafficCondition(null);
    }

    if($_SESSION['pass-to-controller']['save']['trafficId'])
    {
        $drivingExperience->setVisibilityConditionById($_SESSION['pass-to-controller']['save']['trafficId']);
    }
    else 
    {
        $drivingExperience->setVisibilityCondition(null);
    }

    $drivingExperience->save(); 

    $_SESSION['pass-to-controller']['save'] = null; 

    header('Location: ../views/templates/table.php');
    exit; 
    