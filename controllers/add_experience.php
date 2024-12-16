<?php
    include_once("./include_all.php");
    try
    {
        session_start();

        $drivingExperience = new DrivingExperience(
            experienceId: null, 
            date: $_SESSION['pass-to-controller']['save']['date'],
            startTime: $_SESSION['pass-to-controller']['save']['start_time'],
            endTime: $_SESSION['pass-to-controller']['save']['end_time'],
            km: $_SESSION['pass-to-controller']['save']['km'], 
            weatherId: $_SESSION['pass-to-controller']['save']['weatherId'],
            roadId: $_SESSION['pass-to-controller']['save']['roadId'],
            trafficId: $_SESSION['pass-to-controller']['save']['trafficId'],
            visibilityId: $_SESSION['pass-to-controller']['save']['visibilityId']
        );

        $drivingExperience->save(); 

        $_SESSION['pass-to-controller']['save'] = null; 

        header('Location: ../views/templates/table.php');
        exit; 
    }
    catch (Exception $e)
    {
        header('Location: ../views/templates/error.html');
        exit; 
    }
    catch (Error $e)
    {
        header('Location: ../views/templates/error.html');
        exit; 
    }