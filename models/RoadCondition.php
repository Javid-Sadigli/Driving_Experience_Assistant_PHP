<?php
    class RoadCondition 
    {
        private int $roadId; 
        private string $roadType; 

        private static $dbTableName = "RoadConditions";
        private static $primaryKeyName = "roadId";

        private static $dbConnection = DB::getInstance();

        public function __construct($roadId, $roadType)
        {
            $this->roadId = $roadId;
            $this->roadType = $roadType;
        }

        public static function getDbConnection(): DB
        {
            if(self::$dbConnection == null)
            {
                self::$dbConnection = DB::getInstance();
            }
            return self::$dbConnection;
        }

        public function getRoadId(): int
        {
            return $this->roadId;
        }

        public function getRoadType(): string
        {
            return $this->roadType;
        }

        public function setRoadType(string $roadType): void
        {
            $this->roadType = $roadType;
        }

        public function setRoadId(int $roadId): void
        {
            $this->roadId = $roadId;
        }

        public static function findAll(): array
        {
            $rows = self::$dbConnection->selectAll(self::$dbTableName);

            $result = []; 
            foreach ($rows as $row)
            {
                $result[] = new self(
                    $row["roadId"],
                    $row["roadType"]
                );
            }
            return $result;
        }

        public static function findById(int $roadId):self
        {
            $row = self::$dbConnection->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $roadId
            ); 
            return new self(
                $row["roadId"],
                $row["roadType"]
            );
        }
    }