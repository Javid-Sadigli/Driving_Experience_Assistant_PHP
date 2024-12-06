<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Javid Sadigli">
    <link rel="shortcut icon" href="https://static.thenounproject.com/png/386481-200.png">
    <title>Experience List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/table.css">

    <script>

        function get_object_from_dataArray_by_id(objectDataArray, id, objectName)
        {
            let length = objectDataArray.length; 
            let result = {};
            for (let i = 0; i < length; i++)
            {
                if(objectDataArray[i][`id${objectName}`] == id)
                {
                    result = objectDataArray[i];
                    return result;
                }
            }
        }

        let weatherDataArray = [{"idWeather":1,"weather":"sunny"},{"idWeather":2,"weather":"rainy"},{"idWeather":3,"weather":"windy"},{"idWeather":4,"weather":"cloudy"},{"idWeather":5,"weather":"snowy"},{"idWeather":6,"weather":"stormy"}];

        let roadDataArray = [{"idRoad":1,"roadCondition":"smooth"},{"idRoad":2,"roadCondition":"bumpy"},{"idRoad":3,"roadCondition":"icy"},{"idRoad":4,"roadCondition":"under construction"},{"idRoad":5,"roadCondition":"gravel"},{"idRoad":6,"roadCondition":"potholes"}];

        let trafficDataArray = [{"idTraffic":1,"traffic":"heavy"},{"idTraffic":2,"traffic":"light"},{"idTraffic":3,"traffic":"moderate"},{"idTraffic":4,"traffic":"accident"}];
        
        let visibilityDataArray = [{"idVisibility":1,"visibility":"clear"},{"idVisibility":2,"visibility":"foggy"},{"idVisibility":3,"visibility":"hazy"},{"idVisibility":4,"visibility":"smoky"},{"idVisibility":5,"visibility":"dusty"},{"idVisibility":6,"visibility":"misty"}];
        
        function show_experience_list()
        {
            let tbody = document.getElementById("table_body");
            let newTR;
            let newTD;

            let totalKm = 0;

            let experienceList = JSON.parse(localStorage.getItem("experienceList"));

            experienceList.forEach(function(item, index)
            {
                newTR = document.createElement("tr");
                
                totalKm += parseFloat(item.km);

                newTD = document.createElement("td");
                newTD.textContent = `${item.id}`;
                newTR.appendChild(newTD);
                
                newTD = document.createElement("td");
                newTD.textContent = `${item.date}`;
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                newTD.textContent = `${item.start_time}`;
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                newTD.textContent = `${item.end_time}`;
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                newTD.textContent = `${item.km}`;
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                if(item.weatherId)
                {
                    newTD.textContent = `${get_object_from_dataArray_by_id(weatherDataArray, item.weatherId, 'Weather').weather}`;
                }
                else
                {
                    newTD.textContent = `NULL`;
                }
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                if(item.roadId)
                {
                    newTD.textContent = `${get_object_from_dataArray_by_id(roadDataArray, item.roadId, "Road").roadCondition}`;
                }
                else
                {
                    newTD.textContent = `NULL`;
                }
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                if(item.trafficId)
                {
                    newTD.textContent = `${get_object_from_dataArray_by_id(trafficDataArray, item.trafficId, "Traffic").traffic}`;
                }
                else
                {
                    newTD.textContent = `NULL`;
                }
                newTR.appendChild(newTD);

                newTD = document.createElement("td");
                if(item.visibilityId)
                {
                    newTD.textContent = `${get_object_from_dataArray_by_id(visibilityDataArray, item.visibilityId, "Visibility").visibility}`;
                }
                else
                {
                    newTD.textContent = `NULL`;
                }
                newTR.appendChild(newTD);

                tbody.appendChild(newTR);
            });

            document.getElementById("total_km").innerText = `Total KM : ${totalKm} km`;
        }
        
        function clearList()
        {
            localStorage.removeItem("experienceList");
            location.reload();
        }

        document.onreadystatechange = function()
        {
            if(document.readyState == "complete")
            {
                show_experience_list();	
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

        <div class="table_div">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>KM</th>
                        <th>Weather</th>
                        <th>Road</th>
                        <th>Traffic</th>
                        <th>Visibility</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    
                </tbody>
            </table>

            <p><b id="total_km">Total KM : 0 km</b></p>
 
            <button type="button" class="clear_button" onclick="clearList()">Clear List</button>

        </div>
        
    </main>

    <footer>
        <p>&copy; 2023 Driving Experience Assistant. All rights reserved.</p>
    </footer>
</body>
</html>