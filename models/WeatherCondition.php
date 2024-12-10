<?php
    class WeatherCondition
    {
        private string $weatherCondition;
        private int $weatherId; 

        private static string $dbTableName = "WeatherConditions"; 
        private static string $primaryKeyName = "weatherId";
        
        private static $dbConnection = null;
        
        public function __construct($weatherId, $weatherCondition)
        {
            $this->weatherCondition = $weatherCondition;
            $this->weatherId = $weatherId;   
        }

        private static function getDbConnection(): DB
        {
            if(self::$dbConnection == null)
            {
                self::$dbConnection = DB::getInstance();
            }
            return self::$dbConnection;
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
            $rows = self::getDbConnection()->selectAll(self::$dbTableName);

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
            $row = self::getDbConnection()->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $weatherId
            ); 
            return new self(
                $row["weatherId"],
                $row["weatherCondition"]
            );
        }

        public static function getDbTableName(): string
        {
            return self::$dbTableName;
        }

        public static function getPrimaryKeyName(): string
        {
            return self::$primaryKeyName;
        }
    }