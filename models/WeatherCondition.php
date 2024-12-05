<?php
    include("../db/DB.php");
    
    class WeatherCondition
    {
        private $weatherCondition;
        private $weatherId; 

        private static $dbTableName = "WeatherConditions"; 
        private static $primaryKeyName = "weatherId";
        
        private static $dbConnection = DB::getInstance();
        
        public function __construct($weatherId, $weatherCondition)
        {
            $this->weatherCondition = $weatherCondition;
            $this->weatherId = $weatherId;   
        }

        public function getWeatherCondition()
        {
            return $this->weatherCondition;
        }

        public function getWeatherId()
        {
            return $this->weatherId;
        }

        public function setWeatherCondition($weatherCondition)
        {
            $this->weatherCondition = $weatherCondition;
        }

        public function setWeatherId($weatherId)
        {
            $this->weatherId = $weatherId;
        }

        public static function findAll() : array
        {
            $rows = self::$dbConnection->selectAll(self::$dbTableName);

            $result = []; 
            foreach ($rows as $row)
            {
                $result[] = new WeatherCondition(
                    $row["weatherId"],
                    $row["weatherCondition"]
                ); 
            }

            return $result;
        }

        public static function findById(int $weatherId) : WeatherCondition
        {
            $row = self::$dbConnection->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $weatherId
            ); 
            return new WeatherCondition(
                $row["weatherId"],
                $row["weatherCondition"]
            );
        }
    }
?>