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
                require_once "../components/dashboardleftContainer.php";
            ?>
        </div>
        <div class="dashboard-right-container">
            <?php
                require_once "../components/dashboardNavBar.php";
            ?>
            <div class="dashboard-main">
                <?php
                    $page_roles = array('admin');
                    require_once '../db.php';
                    require_once 'checksession.php';

                    $restaurant_id = $_GET['restaurant_id'];

                    $conn = new mysqli($hn,$un,$pw,$db);
                    if($conn->connect_error) die($conn->connect_error);

                    $query = "SELECT * FROM restaurant WHERE restaurant_id =$restaurant_id";

                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo "<div class='title'>manage $row[restaurant_name]'s food items</div>";
                        }
                    }
                    else{
                        echo "No data found <br>";
                    }
                ?>

                <label for="sortby">sort by:
                    <select name="sortby" id="sortby">
                        <option value="name">name</option>
                        <option value="price">price</option>
                        <option value="rating">rating</option>
                    </select>
                </select></label>
                <div class="dashboard-list-container">
                    <ul>
                        <li class="restaurant-list-item header-list-item">
                            <p>food:</p>
                            <p>price:</p>
                            <p>rating:</p>
                            <p>type:</p>
                            <a href="" id="itemFiller"></a>
                            <a href="addNewFoodItemAdmin.html" id="new-restaurant-btn">+ new item</a>
                        </li>
                        <?php
                            $page_roles = array('admin');
                            require_once '../db.php';
                            require_once 'checksession.php';

                            $restaurant_id = $_GET['restaurant_id'];

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $query = "SELECT * FROM food WHERE restaurant_id=$restaurant_id";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){

                                    $query = "SELECT ROUND(AVG(Rating),1) as avg FROM review WHERE food_id=$row[food_id]";
        
                                    $ratingResult = $conn->query($query);
                                    if(!$ratingResult) die($conn->error);

                                    $ratingRow = $ratingResult->fetch_array(MYSQLI_ASSOC);

                                    $rating = 'N/A';

                                    if($ratingRow['avg'] !== null){
                                        $rating = $ratingRow['avg'];
                                    }

                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <p>$row[name]</p>
                                                <p>$row[price]</p>
                                                <p>$rating</p>
                                                <p>$row[type]</p>
                                                <a href="updateFoodItem.php?food_id=$row[food_id]&restaurant_id=$restaurant_id">edit</a>
                                                <form action='deleteFoodItem.php' method='post'>
                                                    <input type='hidden' name='delete' value='yes'>
                                                    <input type='hidden' name='food_id' value='$row[food_id]'>
                                                    <input type='hidden' name='restaurant_id' value='$restaurant_id'>
                                                    <input class="delete-btn" type='submit' value='- delete'>
                                                </form>
                                            </li>
                                    _END;
                                }
                            }
                            else{
                                echo "No data found <br>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
    </div>
</body>
</html>