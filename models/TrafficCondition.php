<?php
    class TrafficCondition 
    {
        private int $trafficId; 
        private string $trafficCondition; 

        private static string $dbTableName = "TrafficConditions"; 
        private static string $primaryKeyName = "trafficId";
        
        private static $dbConnection = null;

        public function __construct(int $trafficId, string $trafficCondition)
        {
            $this->trafficId = $trafficId;
            $this->trafficCondition = $trafficCondition;
        }

        public static function getDbConnection(): DB
        {
            if (self::$dbConnection === null) 
            {
                self::$dbConnection = DB::getInstance();
            }
            return self::$dbConnection;
        }

        public function getTrafficId(): int
        {
            return $this->trafficId;
        }

        public function getTrafficCondition(): string
        {
            return $this->trafficCondition;
        }

        public function setTrafficCondition(string $trafficCondition): void
        {
            $this->trafficCondition = $trafficCondition;
        }

        public function setTrafficId(int $trafficId): void
        {
            $this->trafficId = $trafficId;
        }

        public static function findAll(): array
        {
            $rows = self::getDbConnection()->selectAll(self::$dbTableName);

            $result = []; 
            foreach ($rows as $row)
            {
                $result[] = new self(
                    $row["trafficId"],
                    $row["trafficCondition"]
                );
            }
            return $result;
        }

        public static function findById(int $roadId):self
        {
            $row = self::getDbConnection()->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $roadId
            ); 
            return new self(
                $row["trafficId"],
                $row["trafficCondition"]
            );
        }
    }