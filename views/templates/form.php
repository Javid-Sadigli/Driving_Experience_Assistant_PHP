<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Javid Sadigli">
    <link rel="shortcut icon" href="https://static.thenounproject.com/png/386481-200.png">
    <title>New Experience</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/form.css">

    <script>

        let weatherDataArray = [{"idWeather":1,"weather":"sunny"},{"idWeather":2,"weather":"rainy"},{"idWeather":3,"weather":"windy"},{"idWeather":4,"weather":"cloudy"},{"idWeather":5,"weather":"snowy"},{"idWeather":6,"weather":"stormy"}];

        let roadDataArray = [{"idRoad":1,"roadCondition":"smooth"},{"idRoad":2,"roadCondition":"bumpy"},{"idRoad":3,"roadCondition":"icy"},{"idRoad":4,"roadCondition":"under construction"},{"idRoad":5,"roadCondition":"gravel"},{"idRoad":6,"roadCondition":"potholes"}];

        let trafficDataArray = [{"idTraffic":1,"traffic":"heavy"},{"idTraffic":2,"traffic":"light"},{"idTraffic":3,"traffic":"moderate"},{"idTraffic":4,"traffic":"accident"}];
        
        let visibilityDataArray = [{"idVisibility":1,"visibility":"clear"},{"idVisibility":2,"visibility":"foggy"},{"idVisibility":3,"visibility":"hazy"},{"idVisibility":4,"visibility":"smoky"},{"idVisibility":5,"visibility":"dusty"},{"idVisibility":6,"visibility":"misty"}];

        function saveExperience()
        {
            let date = document.getElementById("date").value;
            let start_time = document.getElementById("start_time").value;
            let end_time = document.getElementById("end_time").value;
            let km = document.getElementById("km").value;
            let weatherId = parseInt(document.getElementById("weatherId").value);
            let roadId = parseInt(document.getElementById("roadId").value);
            let trafficId = parseInt(document.getElementById("trafficId").value);
            let visibilityId = parseInt(document.getElementById("visibilityId").value);

            if(date && start_time && end_time && km)
            {
                let experienceList = [];
                let id = 1;

                if(localStorage.getItem("experienceList") != null)
                {
                    experienceList = JSON.parse(localStorage.getItem("experienceList"));
                    id = experienceList[experienceList.length - 1].id + 1;
                }
                
                let newExperience = {
                    id : id,
                    date : date, 
                    start_time : start_time, 
                    end_time : end_time,
                    km : km, 
                    weatherId : weatherId,
                    roadId : roadId,
                    trafficId : trafficId,
                    visibilityId : visibilityId
                };

                experienceList.push(newExperience);
                localStorage.setItem("experienceList", JSON.stringify(experienceList));
                document.getElementById("experience_form").reset();
            }
        }
    </script>

</head>
<body>
    <header>
        <h1 class="page_header">
            <a href="./" style="color: white;">Driving Experience Assistant</a>
        </h1>
        <nav>
            <ul>
                <li>
                    <a class="nav_link" href="./table.php">See List</a>
                </li>
                <li>
                    <a class="nav_link" href="./form.php">Add Experience</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="bg_image">
            <img src="https://cdn.bookingtimes.com/Common/LoadImage?Id=198903&v=1" class="bg_image_itself" alt="background image">
        </div>
        <form method="post" id="experience_form">
            <div class="date_div input_div">
                <label for="date">Enter date : </label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="start_time_div input_div">
                <label for="start_time">Start time : </label>
                <input type="text" name="start_time" id="start_time" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:MM" required>
            </div>
            <div class="end_time_div input_div">
                <label for="end_time">End time : </label>
                <input type="text" name="end_time" id="end_time" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:MM" required>
            </div>
            <div class="km_div input_div">
                <label for="km">KM : </label>
                <input type="number" name="km" id="km" placeholder="km" step="0.01" required>
            </div>
            <div class="weather_div input_div">
                <label for="weatherId">Weather : </label>
                <select name="weatherId" id="weatherId">
                    <option value="">-- Choose weather --</option>
                </select>
                <script>
                    weatherDataArray.forEach(function(item, index)
                    {
                        document.getElementById("weatherId").insertAdjacentHTML("beforeend", `<option value="${item.idWeather}">${item.weather}</option>`);
                    });
                </script>

            </div>
            <div class="road_div input_div">
                <label for="roadId">Road : </label>
                <select name="roadId" id="roadId">
                    <option value="">-- Choose road --</option>
                </select>
                <script>
                    roadDataArray.forEach(function(item, index)
                    {
                        document.getElementById("roadId").insertAdjacentHTML("beforeend", `<option value="${item.idRoad}">${item.roadCondition}</option>`);
                    });
                </script>
            </div>

            <div class="traffic_div input_div">
                <label for="trafficId">Traffic : </label>
                <select name="trafficId" id="trafficId">
                    <option value="">-- Choose traffic --</option>
                </select>
                <script>
                    trafficDataArray.forEach(function(item, index)
                    {
                        document.getElementById("trafficId").insertAdjacentHTML("beforeend", `<option value="${item.idTraffic}">${item.traffic}</option>`);
                    });
                </script>
            </div>

            <div class="visibility_div input_div">
                <label for="visibilityId">Visibility : </label>
                <select name="visibilityId" id="visibilityId">
                    <option value="">-- Choose visibility --</option>
                </select>
                <script>
                    visibilityDataArray.forEach(function(item, index)
                    {
                        document.getElementById("visibilityId").insertAdjacentHTML("beforeend", `<option value="${item.idVisibility}">${item.visibility}</option>`)
                    });
                </script>
            </div>
            
            <button type="submit" onclick="saveExperience()">Submit</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Driving Experience Assistant. All rights reserved.</p>
    </footer>
</body>
</html>