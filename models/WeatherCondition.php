<?php
    include("../db/_connect_db.php");
    
    class WeatherCondition
    {
        private $weatherCondition;
        private $weatherId; 

        private static $dbTableName = "WeatherConditions"; 
        
        public function __construct($weatherCondition, $weatherId)
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

        public static function getAll()
        {
               
        }


    }
?>