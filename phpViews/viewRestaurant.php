<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=2, initial-scale=1.0">
    <title>U Review</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="favicon.ico?" type="image/x-icon">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-left-container">
            <h1 class="dashboard-nav-title">U Review</h1>
            <?php
                require_once "../components/dashboardleftContainer.html";
            ?>
        </div>
        <div class="dashboard-right-container">
            <?php
                require_once "../components/dashboardNavBar.php";
            ?>
            <div class="dashboard-main">
                <div class="title">manage restaurants</div>
                <label for="sortby">sort by:
                    <select name="sortby" id="sortby">
                        <option value="name">name</option>
                        <option value="rating">rating</option>
                        <option value="followers">followers</option>
                    </select>
                </select></label>
                <div class="dashboard-list-container">
                    <ul>
                        <li class="restaurant-list-item header-list-item">
                            <p>restaurant name:</p>
                            <p>rating:</p>
                            <p>followers:</p>
                            <a href="" id="restaurantFiller"></a>
                            <a href="addRestaurant.php" id="new-restaurant-btn">+ new restaurant</a>
                        </li>
                        <?php
                            $page_roles = array('admin');
                            require_once '../db.php';

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $query = "SELECT * FROM restaurant ORDER BY restaurant_name";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){

                                    //will have to do seperate queries for rating and followers - placeholder for now
                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <p>$row[restaurant_name]</p>
                                                <p>RATING ERROR</p>
                                                <p>FOLLOWER ERROR</p>
                                                <a href="updateRestaurant.php?restaurant_id=$row[restaurant_id]">edit</a>
                                                <form action='deleteRestaurant.php' method='post'>
                                                    <input type='hidden' name='delete' value='yes'>
                                                    <input type='hidden' name='restaurant_id' value='$row[restaurant_id]'>
                                                    <input class="delete-btn" type='submit' value='- delete'>
                                                </form>
                                            </li>

                                    _END;
                                }
                            }
                            else{
                                echo "No data found <br>";
                            }

                            $result->close();
                            $conn->close();

                        ?>
                    </ul>
                </div>
            </div>
    </div>
</body>