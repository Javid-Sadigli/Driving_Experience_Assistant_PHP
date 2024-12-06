<?php 
    class MySqlConnection 
    {
        private $pdo;

        public function __construct(
            string $host, string $username, string $password, string $db
        ){
            $dsn="mysql:host=" . $host . ";dbname=" . $db . ";charset=utf8mb4";

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