<?php
    class DB
    {
        private static $host="mysql-javidsadigli.alwaysdata.net";
        private static $username="334744_sqluser"; 
        private static $password="sqluser";
        private static $db="javidsadigli_ufaz_db_demo";
        private MySqlConnection $connection; 

        private function __construct() 
        {
            $this->connection =  new MySqlConnection(
                self::$host, self::$username, self::$password, self::$db
            );
        }

        private static $instance = null;

        public static function getInstance() : DB 
        {
            if (self::$instance == null)
            {
                self::$instance = new DB();
            }
            return self::$instance;
        }

        public function getDB(): MySqlConnection
        {
            return $this->connection;
        }

        public function selectAll(string $tableName): array
        {
            $query = "SELECT * FROM $tableName;";
            $result = $this->getDB()->getConnection()->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectOneByPrimaryKey(string $tableName, string $primaryKeyName, int $primaryKeyValue): array
        {
            $query = "SELECT * FROM $tableName WHERE $primaryKeyName = :primaryKey LIMIT 1;";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            $stmt->bindParam(':primaryKey', $primaryKeyValue);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function selectAllByAttribute(string $tableName, string $attributeName, $attributeValue): array
        {
            $query = "SELECT * FROM $tableName WHERE $attributeName = :value;";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            $stmt->bindParam(':value', $attributeValue);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertOne(string $tableName, array $data): bool
        {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $tableName ($columns) VALUES ($placeholders);";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            
            foreach ($data as $key => $value) 
            {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        }

        public function insertMany(string $tableName, array $rows): bool
        {
            if (count($rows) === 0) 
            {
                return false;
            }

            $columns = implode(", ", array_keys($rows[0]));
            $placeholders = "(" . implode(", ", array_map(fn($column) => ":$column", array_keys($rows[0]))) . ")";
            $query = "INSERT INTO $tableName ($columns) VALUES " . implode(", ", array_fill(0, count($rows), $placeholders)) . ";";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            
            foreach ($rows as $index => $data) 
            {
                foreach ($data as $key => $value) 
                {
                    $stmt->bindValue(":$key" . $index, $value);
                }
            }

            return $stmt->execute();
        }

        public function deleteByPrimaryKey(string $tableName, string $primaryKeyName, $primaryKeyValue): bool
        {
            $query = "DELETE FROM $tableName WHERE $primaryKeyName = :primaryKey;";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            $stmt->bindParam(':primaryKey', $primaryKeyValue);
            return $stmt->execute();
        }

        public function updateOne(string $tableName, string $primaryKeyName, $primaryKeyValue, array $data): bool
        {
            $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
            $query = "UPDATE $tableName SET $setClause WHERE $primaryKeyName = :primaryKey;";
            $stmt = $this->getDB()->getConnection()->prepare($query);
            
            foreach ($data as $key => $value) 
            {
                $stmt->bindValue(":$key", $value);
            }
            
            $stmt->bindParam(':primaryKey', $primaryKeyValue, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function selectAllWithJoins(string $baseTable, array $joins) : array 
        {
            $query = "SELECT * FROM $baseTable";
        
            foreach ($joins as $joinTable => $onCondition) 
            {
                $query .= " JOIN $joinTable ON $onCondition";
            }
        
            $stmt = $this->getDB()->getConnection()->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectOneByPrimaryKeyWithJoins(string $baseTable, string $primaryKeyName, $primaryKeyValue, array $joins): array 
        {
            $query = "SELECT * FROM $baseTable";

            foreach ($joins as $joinTable => $onCondition) 
            {
                $query .= " JOIN $joinTable ON $onCondition";
            }

            $query .= " WHERE $baseTable.$primaryKeyName = :primaryKey LIMIT 1";

            $stmt = $this->getDB()->getConnection()->prepare($query);
            $stmt->bindValue(':primaryKey', $primaryKeyValue);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }