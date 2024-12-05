<?php 
    include("../db/DB.php");

    class VisibilityCondition
    {
        private int $visibilityId;
        private string $visibilityCondition; 

        private static $dbTableName = "VisibilityConditions"; 
        private static $primaryKeyName = "visibilityId";
        
        private static $dbConnection = DB::getInstance();

        public function __construct(int $visibilityId, string $visibilityCondition)
        {
            $this->visibilityId = $visibilityId;
            $this->visibilityCondition = $visibilityCondition;
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
            $rows = self::$dbConnection->selectAll(self::$dbTableName);

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
            $row = self::$dbConnection->selectOneByPrimaryKey(
                self::$dbTableName, self::$primaryKeyName, $weatherId
            ); 
            return new self(
                $row["visibilityId"],
                $row["visibilityCondition"]
            );
        }
    }

?>