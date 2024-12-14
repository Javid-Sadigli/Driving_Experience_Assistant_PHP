<?php
    include_once("./include_all.php");

    session_start();

    $drivingExperience = new DrivingExperience(
        experienceId: null, 
        date: $_SESSION['save']['date'],
        startTime: $_SESSION['save']['start_time'],
        endTime: $_SESSION['save']['end_time'],
        km: $_SESSION['save']['km'], 
        weatherId: $_SESSION['save']['weatherId'],
        roadId: $_SESSION['save']['roadId'],
        trafficId: $_SESSION['save']['trafficId'],
        visibilityId: $_SESSION['save']['visibilityId']
    );

    $drivingExperience->save(); 

    $_SESSION['save'] = array(); 

    header('Location: ../views/templates/table.php');
    exit; 
    