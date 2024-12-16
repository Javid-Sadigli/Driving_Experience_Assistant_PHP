<?php
    include_once("./include_all.php");

    try
    {
        session_start();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($_SESSION['action'][$_POST['action_key']] == 'update')
            {
                $drivingExperience = array();
                $drivingExperience['experience_id'] = $_SESSION['experiences'][$_POST['experience_key']]->getExperienceId();
                $drivingExperience['date'] = $_POST['date'];
                $drivingExperience['start_time'] = $_POST['start_time'];
                $drivingExperience['end_time'] = $_POST['end_time'];
                $drivingExperience['km'] = intval($_POST['km']);
                $drivingExperience['weatherId'] = isset($_POST['weatherId'])? intval($_POST['weatherId']) : null;
                $drivingExperience['roadId'] = isset($_POST['roadId'])? intval($_POST['roadId']) : null;
                $drivingExperience['trafficId'] = isset($_POST['trafficId'])? intval($_POST['trafficId']) : null;
                $drivingExperience['visibilityId'] = isset($_POST['visibilityId'])? intval($_POST['visibilityId']) : null;

                $_SESSION['pass-to-controller']['save'] = $drivingExperience; 

                header('Location: ../../controllers/update_experience.php');
                exit;
            }
        }

        if($_SESSION['redirect']['edit-form'])
        {
            $_SESSION['redirect']['edit-form'] = false; 
        }
        else 
        {
            $_SESSION['pass-to-controller']['key'] = $_GET['key'];
            header("Location: ../../controllers/get_experience_by_id.php");
            exit; 
        }

        $drivingExperience = $_SESSION['pass-by-controller']['driving-experience'];
    }
    catch(Exception $e)
    {
        header('Location: ./error.html');
        exit;
    }
    catch(Error $e)
    {
        header('Location: ./error.html');
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
    <title>Update Experience</title>
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
                <input type="date" name="date" id="date" required value="<?php echo $drivingExperience->getDate(); ?>">
            </div>
            <div class="start_time_div input_div">
                <label for="start_time">Start time : </label>
                <input type="text" name="start_time" id="start_time" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:MM" required value="<?php echo $drivingExperience->getStartTime(); ?>">
            </div>
            <div class="end_time_div input_div">
                <label for="end_time">End time : </label>
                <input type="text" name="end_time" id="end_time" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:MM" required value="<?php echo $drivingExperience->getEndTime(); ?>">
            </div>
            <div class="km_div input_div">
                <label for="km">KM : </label>
                <input type="number" name="km" id="km" placeholder="km" step="0.01" required value="<?php echo $drivingExperience->getKm(); ?>">
            </div>
            <div class="weather_div input_div">
                <label for="weatherId">Weather : </label>
                <select name="weatherId" id="weatherId">
                    <option value="">-- Choose weather --</option>
                    <?php
                        try
                        {
                            $weathers = WeatherCondition::findAll(); 
                            if($drivingExperience->getWeatherCondition() == null)
                            {
                                foreach ($weathers as $weather) 
                                {
                                    echo "<option value=\"". $weather->getWeatherId() . "\">" . $weather->getWeatherCondition() . "</option>";
                                }
                            }
                            else 
                            {
                                foreach ($weathers as $weather)
                                {
                                    if($weather->getWeatherId() == $drivingExperience->getWeatherCondition()->getWeatherId())
                                    {
                                        echo "<option value=\"". $weather->getWeatherId() . "\" selected>" . $weather->getWeatherCondition() . "</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value=\"". $weather->getWeatherId() . "\">" . $weather->getWeatherCondition() . "</option>";
                                    }
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                        catch(Error $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                    ?>

                </select>

            </div>
            <div class="road_div input_div">
                <label for="roadId">Road : </label>
                <select name="roadId" id="roadId">
                    <option value="">-- Choose road --</option>
                    <?php
                        try
                        {
                            $roads = RoadCondition::findAll();
                            if ($drivingExperience->getRoadCondition() == null) 
                            {
                                foreach ($roads as $road)
                                {
                                    echo "<option value=\"". $road->getRoadId() . "\">" . $road->getRoadType() . "</option>";
                                }
                            }
                            else 
                            {
                                foreach ($roads as $road)
                                {
                                    if($road->getRoadId() == $drivingExperience->getRoadCondition()->getRoadId())
                                    {
                                        echo "<option value=\"". $road->getRoadId() . "\" selected>" . $road->getRoadType() . "</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value=\"". $road->getRoadId() . "\">" . $road->getRoadType() . "</option>";
                                    }
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                        catch(Error $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                    ?>

                </select>
            </div>

            <div class="traffic_div input_div">
                <label for="trafficId">Traffic : </label>
                <select name="trafficId" id="trafficId">
                    <option value="">-- Choose traffic --</option>
                    <?php 
                        try 
                        {
                            $traffics = TrafficCondition::findAll();
                            if ($drivingExperience->getTrafficCondition() == null)
                            {
                                foreach ($traffics as $traffic)
                                {
                                    echo "<option value=\"". $traffic->getTrafficId() . "\">" . $traffic->getTrafficCondition() . "</option>";
                                }   
                            }
                            else
                            {
                                foreach ($traffics as $traffic)
                                {
                                    if($traffic->getTrafficId() == $drivingExperience->getTrafficCondition()->getTrafficId())
                                    {
                                        echo "<option value=\"". $traffic->getTrafficId() . "\" selected>" . $traffic->getTrafficCondition() . "</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value=\"". $traffic->getTrafficId() . "\">" . $traffic->getTrafficCondition() . "</option>";
                                    }
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                        catch(Error $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                    ?>

                </select>
            </div>

            <div class="visibility_div input_div">
                <label for="visibilityId">Visibility : </label>
                <select name="visibilityId" id="visibilityId">
                    <option value="">-- Choose visibility --</option>
                    <?php
                        try
                        {
                            $visibilities = VisibilityCondition::findAll(); 
                            if($drivingExperience->getVisibilityCondition() == null)
                            {
                                foreach ($visibilities as $visibility)
                                {
                                    echo "<option value=\"". $visibility->getVisibilityId() . "\">" . $visibility->getVisibilityCondition() . "</option>";
                                }
                            }
                            else
                            {
                                foreach ($visibilities as $visibility)
                                {
                                    if($visibility->getVisibilityId() == $drivingExperience->getVisibilityCondition()->getVisibilityId())
                                    {
                                        echo "<option value=\"". $visibility->getVisibilityId(). "\" selected>". $visibility->getVisibilityCondition(). "</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value=\"". $visibility->getVisibilityId(). "\">". $visibility->getVisibilityCondition(). "</option>";
                                    }
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                        catch(Error $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }
                    ?>

                </select>
            </div>

            <?php
                try 
                {
                    $key = $_GET['key']; 
                    echo '<input type="hidden" value="' . $key . '" name="experience_key">';
                    
                    $key = random_pw(10); 
                    $_SESSION['action'][$key] = 'update'; 
                    echo '<input type="hidden" value="' . $key . '" name="action_key">';
                }
                catch(Exception $e)
                {
                    header('Location:./error.html');
                    exit;
                }
                catch(Error $e)
                {
                    header('Location:./error.html');
                    exit;
                }
            ?>
            
            <button type="submit" >Submit</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Driving Experience Assistant. All rights reserved.</p>
    </footer>
</body>
</html>