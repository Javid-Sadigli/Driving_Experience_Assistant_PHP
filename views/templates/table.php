<?php
    include_once("./include_all.php");

    try
    {
        session_start();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($_SESSION['action'][$_POST['action_key']] == 'delete-all')
            {
                header('Location: ../../controllers/delete_all.php');
                exit;
            }
            if($_SESSION['action'][$_POST['action_key']] == 'delete-one')
            {
                $_SESSION['pass-to-controller']['delete-key'] = $_POST['experience_key']; 
                header('Location: ../../controllers/delete_one.php');
                exit;
            }
        }

        if($_SESSION['redirect']['table'])
        {
            $_SESSION['redirect']['table'] = false; 
        }
        else 
        {
            header("Location: ../../controllers/get_experiences.php");
            exit; 
        }
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
    <title>Experience List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/table.css">
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
                        <!-- <th>ID</th> -->
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

                    <?php
                        try 
                        {
                            $drivingExperienceKeys = array_keys($_SESSION['experiences']); 
                            $totalKm = 0;

                            $actionKey = random_pw(10);
                            $_SESSION['action'][$actionKey] = 'delete-one';

                            foreach($drivingExperienceKeys as $key)
                            {
                                $drivingExperience = $_SESSION['experiences'][$key]; 
                                
                                echo "
                                ";
                                echo "<tr>";
                                // echo "<td>" . $drivingExperience->getExperienceId() . "</td>";
                                echo "<td class=\"date-td\">" . $drivingExperience->getDate() ."</td>";
                                echo "<td>". $drivingExperience->getStartTime() . "</td>";
                                echo "<td>". $drivingExperience->getEndTime() . "</td>";
                                echo "<td>". $drivingExperience->getKm() . "</td>";
                                echo "<td>". ($drivingExperience->getWeatherCondition() ? $drivingExperience->getWeatherCondition()->getWeatherCondition() : 'NULL') . "</td>";
                                echo "<td>". ($drivingExperience->getRoadCondition() ? $drivingExperience->getRoadCondition()->getRoadType() : 'NULL') . "</td>";
                                echo "<td>". ($drivingExperience->getTrafficCondition() ? $drivingExperience->getTrafficCondition()->getTrafficCondition() : 'NULL') . "</td>";
                                echo "<td>". ($drivingExperience->getVisibilityCondition() ? $drivingExperience->getVisibilityCondition()->getVisibilityCondition() : 'NULL') . "</td>";
                                echo '<td class="edit-td"><a href="./edit-form.php?key='. $key . '" class="edit-button">Edit</a></td>';
                                echo "
                                    <td class=\"delete-td\">
                                        <form method=\"post\" class=\"delete-form\">
                                            <input type=\"hidden\" value=\"$actionKey\" name=\"action_key\">
                                            <input type=\"hidden\" name=\"experience_key\" value=\"$key\">
                                            <button type=\"submit\" class=\"delete-button\">Delete</button>
                                        </form>
                                    </td>
                                ";
                                echo "</tr>";
                                echo "
                                ";

                                $totalKm += $drivingExperience->getKm();
                            }
                        }
                        catch(Exception $e)
                        {
                            header('Location: ./error.html');
                            exit;
                        }
                        catch(Error $e)
                        {
                            header('Location:./error.html');
                            exit;
                        }

                    ?>
                    
                    
                    
                </tbody>
            </table>

            <p><b id="total_km">Total KM : <?php echo $totalKm ?> km</b></p>
 
            <form method="post" class="clear-form">
                <?php
                    try 
                    {
                        $key = random_pw(10); 
                        $_SESSION['action'][$key] = 'delete-all';
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
                
                <button type="submit" class="clear_button">Clear List</button>
            </form>

        </div>
        
    </main>

    <footer>
        <p>&copy; 2023 Driving Experience Assistant. All rights reserved.</p>
    </footer>
</body>
</html>