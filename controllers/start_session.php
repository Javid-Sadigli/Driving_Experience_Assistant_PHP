<?php
    try
    {
        session_start(); 
        $_SESSION['experiences'] = array();
        $_SESSION['redirect'] = array(); 
        $_SESSION['action'] = array();
        $_SESSION['pass-to-controller'] = array();
        $_SESSION['pass-to-views'] = array();
        $_SESSION['pass-by-controller'] = array();

        $_SESSION['redirect']['homepage'] = true; 

        header('Location: ../views/templates/index.php');
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