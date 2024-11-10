<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=2, initial-scale=1.0">
    <title>U Review</title>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="icon" href="../../assets/favicon.ico?" type="image/x-icon">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-left-container">
            <h1 class="dashboard-nav-title">U Review</h1>
            <?php
                require_once "../../components/dashboardleftContainer.php";
            ?>
        </div>
        <div class="dashboard-right-container">
            <?php
                require_once "../../components/dashboardNavBar.php";
            ?>
            <div class="dashboard-main">
                <div class="title">find restaurants</div>
                <form method="POST" onchange="updateSort()" id="sort-by-form">
                    <label for="sort-by-form">sort by:</label>
                    <select name="sortby" id="sortby">
                        <?php
                            $values = ['r.restaurant_name','average_rating','follower_count'];
                            $valueLabels = ['name','rating','followers'];

                            $sortBy = $values[0];

                            if(isset($_POST['sortby'])){
                                $sortBy = $_POST['sortby'];
                            }

                            for($i = 0; $i < count($values); $i++){
                                if($values[$i] == $sortBy){
                                    echo "<option selected value=$values[$i]>$valueLabels[$i]</option>";
                                }
                                else{
                                    echo "<option value=$values[$i]>$valueLabels[$i]</option>";
                                }
                            }
                        ?>
                    </select>
                </form>
                <div class="dashboard-list-container">
                    <ul>
                        <li class="restaurant-list-item header-list-item">
                            <p>restaurant name:</p>
                            <p>rating:</p>
                            <p>followers:</p>
                            <a href="" id="restaurantFiller"></a>
                        </li>
                        <?php
                            $page_roles = array('admin','owner','user');
                            require_once '../../security/checksession.php';
                            require_once '../../db.php';
                            require_once '../../security/sanitize.php';

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $sortBy = "r.restaurant_name";

                            if(isset($_POST['sortby'])){
                                $sortBy = $_POST['sortby'];
                            }

                            $query = "SELECT 
                                            r.restaurant_id,
                                            r.restaurant_name,
                                            r.description,
                                            COALESCE(ROUND(AVG(rv.rating), 1), 'N/A') as average_rating,
                                            COALESCE(COUNT(DISTINCT f.follow_id), 0) as follower_count
                                        FROM 
                                            restaurant r
                                            LEFT JOIN food fd ON r.restaurant_id = fd.restaurant_id
                                            LEFT JOIN review rv ON fd.food_id = rv.food_id
                                            LEFT JOIN follow f ON r.restaurant_id = f.restaurant_id
                                        GROUP BY 
                                            r.restaurant_id, 
                                            r.restaurant_name,
                                            r.description
                                        ORDER BY 
                                            $sortBy ASC;";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    $restaurant_id = $row['restaurant_id'];
                                    $followerCount = $row['follower_count'];
                                    $averageRating = $row['average_rating'];

                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <a href="findFoodItem.php?restaurant_id=$restaurant_id">$row[restaurant_name]</a>
                                                <p>$averageRating</p>
                                                <p>$followerCount</p>
                                                <a href="findRestaurantInfo.php?restaurant_id=$restaurant_id">Info</a>
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
    <script>
        const updateSort = () => {
            document.getElementById("sort-by-form").submit();
        }
    </script>
</body>