<?php
    include_once("./include_all.php");
    try
    {
        session_start();

        $deleteKey = $_SESSION['pass-to-controller']['delete-key']; 
        $_SESSION['pass-to-controller']['delete-key'] = null; 

        $experienceId = $_SESSION['experiences'][$deleteKey]->getExperienceId();

        DrivingExperience::deleteById($experienceId);

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
    