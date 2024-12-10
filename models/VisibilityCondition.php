<?php 
    class VisibilityCondition
    {
        private int $visibilityId;
        private string $visibilityCondition; 

        private static string $dbTableName = "VisibilityConditions"; 
        private static string $primaryKeyName = "visibilityId";
        
        private static $dbConnection = null;

        public function __construct(int $visibilityId, string $visibilityCondition)
        {
            $this->visibilityId = $visibilityId;
            $this->visibilityCondition = $visibilityCondition;
        }

        public static function getDbConnection(): DB
        {
            if(self::$dbConnection == null)
            {
                self::$dbConnection = DB::getInstance();
            }
            return self::$dbConnection;
        }

        public function getVisibilityId(): int
        {
            return $this->visibilityId;
        }

        public function getVisibilityCondition(): string
        {
            return $this->visibilityCondition;
        }

        public function setVisibilityId(int $visibilityId): void
        {
            $this->visibilityId = $visibilityId;
        }

        public function setVisibilityCondition(string $visibilityCondition): void
        {
            $this->visibilityCondition = $visibilityCondition;
        }

        public static function findAll() : array
        {
            $rows = self::getDbConnection()->selectAll(self::$dbTableName);

            $result = []; 
            foreach ($rows as $row)
            {
                $result[] = new self(
                    $row["visibilityId"],
                    $row["visibilityCondition"]
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
                $row["visibilityId"],
                $row["visibilityCondition"]
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