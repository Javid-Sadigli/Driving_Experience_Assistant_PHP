<?php 

    $host="mysql-javidsadigli.alwaysdata.net";
    $username="334744_sqluser"; 
    $password="sqluser";
    $db="javidsadigli_ufaz_db_demo";

    $mysqli = null; 

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try
    {
        $mysqli = new mysqli($host, $username, $password, $db); 

        if ($mysqli->connect_errno)
        {
            die("Connection error: $mysqli->connect_errno");
        }
    }
    catch(Exception $e)
    {
        echo "MySQL Error Code : " . $e->getCode();
        echo "<br>";
        echo "Exception message : " . $e->getMessage();
        exit();
    }

?>