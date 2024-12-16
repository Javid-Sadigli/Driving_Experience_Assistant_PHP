<?php
    include_once("./include_all.php");
    try
    {
        session_start();

        DrivingExperience::deleteAll(); 

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
    