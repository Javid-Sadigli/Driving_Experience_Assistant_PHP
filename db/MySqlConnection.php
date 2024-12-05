<?php 

    class MySqlConnection 
    {
        private $pdo;

        public function __construct(
            string $host, string $username, string $password, string $db
        ){
            // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // try
            // {
            //     $this->mysqli = new mysqli($host, $username, $password, $db); 

            //     if ($this->mysqli->connect_errno)
            //     {
            //         die("Connection error: " . $this->mysqli->connect_errno);
            //     }
            // }
            // catch(Exception $e)
            // {
            //     echo "MySQL Error Code : " . $e->getCode();
            //     echo "<br>";
            //     echo "Exception message : " . $e->getMessage();
            //     exit();
            // }

            $dsn="mysql:host" . $host . ";dbname=" . $db . ";charset=utf8mb4";

            try 
            {
                $this->pdo = new PDO($dsn, $username, $password);            
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            } 
            catch (PDOException $e) 
            {
                echo "Error: " . $e->getMessage();
            }
        }

        public function getConnection(): PDO
        {
            return $this->pdo;
        }
    }

?>