<?php 
    include_once("./include_all.php");
    try
    {
        session_start();

        $experienceKey = $_SESSION['pass-to-controller']['key']; 
        $_SESSION['pass-to-controller']['key'] = null; 
        $experienceId = $_SESSION['experiences'][$experienceKey]->getExperienceId(); 
        $drivingExperience = DrivingExperience::findById($experienceId);

        $_SESSION['pass-by-controller']['driving-experience'] = $drivingExperience;

        $_SESSION['redirect']['edit-form'] = true; 

        header("Location: ../views/templates/edit-form.php?key=$experienceKey");
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