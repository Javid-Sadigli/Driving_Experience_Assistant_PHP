<?php
    include("../db/DB.php");
    
    class WeatherCondition
    {
        private string $weatherCondition;
        private int $weatherId; 

        private static $dbTableName = "WeatherConditions"; 
        private static $primaryKeyName = "weatherId";
        
        private static $dbConnection = DB::getInstance();
        
        public function __construct($weatherId, $weatherCondition)
        {
            $this->weatherCondition = $weatherCondition;
            $this->weatherId = $weatherId;   
        }

        public function getWeatherCondition(): string
        {
            return $this->weatherCondition;
        }

        public function getWeatherId(): int
        {
            return $this->weatherId;
        }

        public function setWeatherCondition($weatherCondition): void
        {
            $this->weatherCondition = $weatherCondition;
        }

        public function setWeatherId($weatherId): void
        {
            $this->weatherId = $weatherId;
        }

        public static function findAll() : array
        {
            $rows = self::$dbConnection->selectAll(self::$dbTableName);

            $result = []; 
            foreach ($rows as $row)
            {
                $result[] = new self(
                    $row["weatherId"],
                    $row["weatherCondition"]
                ); 
            }

            return $result;
        }

        public static function findById(int $weatherId): self
        {
            $row = self::$dbConnection->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $weatherId
            ); 
            return new self(
                $row["weatherId"],
                $row["weatherCondition"]
            );
        }
    }
?>