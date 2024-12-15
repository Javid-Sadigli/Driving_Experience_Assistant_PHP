<?php
    include_once("./include_all.php");

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if($_SESSION['action'][$_POST['action_key']] == 'update')
        {
            $drivingExperience = array();
            $drivingExperience['date'] = $_POST['date'];
            $drivingExperience['start_time'] = $_POST['start_time'];
            $drivingExperience['end_time'] = $_POST['end_time'];
            $drivingExperience['km'] = intval($_POST['km']);
            $drivingExperience['weatherId'] = isset($_POST['weatherId'])? intval($_POST['weatherId']) : null;
            $drivingExperience['roadId'] = isset($_POST['roadId'])? intval($_POST['roadId']) : null;
            $drivingExperience['trafficId'] = isset($_POST['trafficId'])? intval($_POST['trafficId']) : null;
            $drivingExperience['visibilityId'] = isset($_POST['visibilityId'])? intval($_POST['visibilityId']) : null;

            $_SESSION['save'] = $drivingExperience; 

            header('Location: ../../controllers/add_experience.php');
            exit;
        }
    }

    if($_SESSION['redirect']['edit-form'])
    {
        $_SESSION['redirect']['edit-form'] = false; 
    }
    else 
    {
        $_SESSION['pass-to-controller']['experience-id'] = $_SESSION['experiences'][$_GET['key']]->getExperienceId();
        header("Location: ../../controllers/get_experience_by_id.php");
        exit; 
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Javid Sadigli">
    <link rel="shortcut icon" href="https://static.thenounproject.com/png/386481-200.png">
    <title>New Experience</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/edit-form.css">

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
                    <?php
                        $weathers = WeatherCondition::findAll(); 
                        foreach ($weathers as $weather) 
                        {
                            echo "<option value=\"". $weather->getWeatherId() . "\">" . $weather->getWeatherCondition() . "</option>";
                        }
                    ?>

                </select>

            </div>
            <div class="road_div input_div">
                <label for="roadId">Road : </label>
                <select name="roadId" id="roadId">
                    <option value="">-- Choose road --</option>
                    <?php
                        $roads = RoadCondition::findAll();
                        foreach ($roads as $road)
                        {
                            echo "<option value=\"". $road->getRoadId() . "\">" . $road->getRoadType() . "</option>";
                        }
                    ?>

                </select>
            </div>

            <div class="traffic_div input_div">
                <label for="trafficId">Traffic : </label>
                <select name="trafficId" id="trafficId">
                    <option value="">-- Choose traffic --</option>
                    <?php 
                        $traffics = TrafficCondition::findAll();
                        foreach ($traffics as $traffic)
                        {
                            echo "<option value=\"". $traffic->getTrafficId() . "\">" . $traffic->getTrafficCondition() . "</option>";
                        }
                    ?>

                </select>
            </div>

            <div class="visibility_div input_div">
                <label for="visibilityId">Visibility : </label>
                <select name="visibilityId" id="visibilityId">
                    <option value="">-- Choose visibility --</option>
                    <?php
                        $visibilities = VisibilityCondition::findAll(); 
                        foreach ($visibilities as $visibility)
                        {
                            echo "<option value=\"". $visibility->getVisibilityId() . "\">" . $visibility->getVisibilityCondition() . "</option>";
                        }
                    ?>

                </select>
            </div>

            <?php
                $key = random_pw(10); 
                $_SESSION['action'][$key] = 'update'; 
                echo '<input type="hidden" value="' . $key . '" name="action_key">';
            ?>
            
            <button type="submit" >Submit</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Driving Experience Assistant. All rights reserved.</p>
    </footer>
</body>
</html>