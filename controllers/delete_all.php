<?php
    include_once("./include_all.php");

    session_start();

    DrivingExperience::deleteAll(); 

    header('Location: ../views/templates/table.php');
    exit; 
    