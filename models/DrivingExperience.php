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
    }