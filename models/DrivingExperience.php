<?php
    class DrivingExperience
    {
        private int $experienceId; 
        private string $date; 
        private string $startTime; 
        private string $endTime;
        private int $km; 
        private ?WeatherCondition $weatherCondition = null; 
        private ?TrafficCondition $trafficCondition= null ;
        private ?VisibilityCondition $visibilityCondition = null; 
        private ?RoadCondition $roadCondition = null;


        private static string $dbTableName = "DrivingExperiences";
        private static string $primaryKeyName = "experienceId";

        private static $dbConnection = null; 


        public function __construct(
            int $experienceId = null,
            string $date = null,
            string $startTime = null,
            string $endTime = null,
            int $km = null,
            ?WeatherCondition $weatherCondition = null,
            ?TrafficCondition $trafficCondition = null,
            ?VisibilityCondition $visibilityCondition = null,
            ?RoadCondition $roadCondition = null,
            int $weatherId = null,
            int $trafficId = null,
            int $visibilityId = null,
            int $roadId = null
        ){
            $this->experienceId = $experienceId ?? 0;
            $this->date = $date ?? '';
            $this->startTime = $startTime ?? '';
            $this->endTime = $endTime ?? '';
            $this->km = $km ?? 0;
    
            $this->weatherCondition = $weatherCondition ?? ($weatherId ? WeatherCondition::findById($weatherId) : null);
            $this->trafficCondition = $trafficCondition ?? ($trafficId ? TrafficCondition::findById($trafficId) : null);
            $this->visibilityCondition = $visibilityCondition ?? ($visibilityId ? VisibilityCondition::findById($visibilityId) : null);
            $this->roadCondition = $roadCondition ?? ($roadId ? RoadCondition::findById($roadId) : null);
        }

        public static function getDbConnection(): DB
        {
            if(self::$dbConnection == null)
            {
                self::$dbConnection = DB::getInstance();
            }
            return self::$dbConnection;
        }

        public function getExperienceId(): int
        {
            return $this->experienceId;
        }

        public function setExperienceId(int $experienceId): void
        {
            $this->experienceId = $experienceId;
        }

        public function getDate(): string
        {
            return $this->date;
        }

        public function setDate(string $date): void
        {
            $this->date = $date;
        }

        public function getStartTime(): string
        {
            return $this->startTime;
        }

        public function setStartTime(string $startTime): void
        {
            $this->startTime = $startTime;
        }

        public function getEndTime(): string
        {
            return $this->endTime;
        }

        public function setEndTime(string $endTime): void
        {
            $this->endTime = $endTime;
        }

        public function getKm(): int
        {
            return $this->km;
        }

        public function setKm(int $km): void
        {
            $this->km = $km;
        }

        public function getWeatherCondition(): ?WeatherCondition
        {
            return $this->weatherCondition;
        }

        public function setWeatherCondition(WeatherCondition $weatherCondition): void
        {
            $this->weatherCondition = $weatherCondition;
        }

        public function setWeatherConditionById(int $weatherId): void
        {
            $this->weatherCondition = WeatherCondition::findById($weatherId);
        }

        public function getTrafficCondition(): ?TrafficCondition
        {
            return $this->trafficCondition;
        }

        public function setTrafficCondition(TrafficCondition $trafficCondition): void
        {
            $this->trafficCondition = $trafficCondition;
        }

        public function setTrafficConditionById(int $trafficId): void
        {
            $this->trafficCondition = TrafficCondition::findById($trafficId);
        }

        public function getVisibilityCondition(): ?VisibilityCondition
        {
            return $this->visibilityCondition;
        }

        public function setVisibilityCondition(VisibilityCondition $visibilityCondition): void
        {
            $this->visibilityCondition = $visibilityCondition;
        }

        public function setVisibilityConditionById(int $visibilityId): void
        {
            $this->visibilityCondition = VisibilityCondition::findById($visibilityId); 
        }

        public function getRoadCondition(): ?RoadCondition
        {
            return $this->roadCondition;
        }

        public function setRoadCondition(RoadCondition $roadCondition): void
        {
            $this->roadCondition = $roadCondition;
        }

        public function setRoadConditionById(int $roadId): void
        {
            $this->roadCondition = RoadCondition::findById($roadId);
        }

        public function save(): bool
        {   
            $data = [
                "date" => $this->getDate(), 
                "startTime" => $this->getStartTime(),
                "endTime" => $this->getEndTime(),
                "km" => $this->getKm(),
                "weatherId" => $this->weatherCondition? $this->weatherCondition->getWeatherId() : null,
                "trafficId" => $this->trafficCondition? $this->trafficCondition->getTrafficId() : null,
                "roadId" => $this->roadCondition? $this->roadCondition->getRoadId() : null,
                "visibilityId" => $this->visibilityCondition? $this->visibilityCondition->getVisibilityId() : null
            ]; 

            if($this->getExperienceId() == 0)
            {
                return self::getDbConnection()->insertOne(self::$dbTableName, $data);
            }
            else 
            {
                return self::getDbConnection()->updateOne(
                    self::$dbTableName, 
                    "experienceId",
                    $this->getExperienceId(),
                    $data
                );
            }
        }

        public static function findById(int $experienceId): self
        {
            $joins = [
                WeatherCondition::getDbTableName() => self::$dbTableName . ".weatherId = " . WeatherCondition::getDbTableName() . "." . WeatherCondition::getPrimaryKeyName(), 
                TrafficCondition::getDbTableName() => self::$dbTableName. ".trafficId = " . TrafficCondition::getDbTableName() . "." . TrafficCondition::getPrimaryKeyName(),
                RoadCondition::getDbTableName() => self::$dbTableName. ".roadId = " . RoadCondition::getDbTableName() . "." . RoadCondition::getPrimaryKeyName(),
                VisibilityCondition::getDbTableName() => self::$dbTableName. ".visibilityId = " . VisibilityCondition::getDbTableName(). "." . VisibilityCondition::getPrimaryKeyName()   
            ]; 

            $row = self::getDbConnection()->selectOneByPrimaryKeyWithJoins(
                self::$dbTableName,
                self::$primaryKeyName, 
                $experienceId,
                $joins
            ); 
            
            return new self(
                $row["experienceId"]?? null,
                $row["date"]?? null,
                $row["startTime"]?? null,
                $row["endTime"]?? null,
                $row["km"]?? null,
                $row["weatherId"] ? new WeatherCondition(
                    $row["weatherId"], 
                    $row["weatherCondition"]
                ) : null,
                $row["trafficId"] ? new TrafficCondition(
                    $row["trafficId"], 
                    $row["trafficCondition"]
                ) : null,
                $row["visibilityId"] ? new VisibilityCondition(
                    $row["visibilityId"], 
                    $row["visibilityCondition"]
                ) : null,
                $row["roadId"] ? new RoadCondition(
                    $row["roadId"], 
                    $row["roadType"]
                ) : null
            );
        }

        public static function findAll(): array
        {
            $joins = [
                WeatherCondition::getDbTableName() => self::$dbTableName . ".weatherId = " . WeatherCondition::getDbTableName() . "." . WeatherCondition::getPrimaryKeyName(), 
                TrafficCondition::getDbTableName() => self::$dbTableName. ".trafficId = " . TrafficCondition::getDbTableName() . "." . TrafficCondition::getPrimaryKeyName(),
                RoadCondition::getDbTableName() => self::$dbTableName. ".roadId = " . RoadCondition::getDbTableName() . "." . RoadCondition::getPrimaryKeyName(),
                VisibilityCondition::getDbTableName() => self::$dbTableName. ".visibilityId = " . VisibilityCondition::getDbTableName(). "." . VisibilityCondition::getPrimaryKeyName()   
            ]; 

            $rows = self::getDbConnection()->selectAllWithJoins(self::$dbTableName, $joins);

            $result = []; 

            foreach ($rows as $row) 
            {
                $result[] = new self(
                    $row["experienceId"]?? null,
                    $row["date"]?? null,
                    $row["startTime"]?? null,
                    $row["endTime"]?? null,
                    $row["km"]?? null,
                    $row["weatherId"]? new WeatherCondition(
                        $row["weatherId"], 
                        $row["weatherCondition"]
                    ) : null,
                    $row["trafficId"]? new TrafficCondition(
                        $row["trafficId"], 
                        $row["trafficCondition"]
                    ) : null,
                    $row["visibilityId"]? new VisibilityCondition(
                        $row["visibilityId"], 
                        $row["visibilityCondition"]
                    ) : null,
                    $row["roadId"]? new RoadCondition(
                        $row["roadId"], 
                        $row["roadType"]
                    ) : null
                );
            }

            return $result;
        }

        public static function deleteById(int $experienceId): bool
        {
            return self::getDbConnection()->deleteByPrimaryKey(
                self::$dbTableName, 
                self::$primaryKeyName,
                $experienceId
            ); 
        }

        public static function deleteAll() : bool
        {
            return self::getDbConnection()->deleteAll(self::$dbTableName);
        }
    }