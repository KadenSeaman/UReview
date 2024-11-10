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
                <?php
                    $page_roles = array('admin');
                    require_once '../../security/checksession.php';
                    require_once '../../db.php';
                    require_once '../../security/sanitize.php';

                    $restaurant_id = sanitize($conn, $_GET['restaurant_id']);

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

                <form method="POST" onchange="updateSort()" id="sort-by-form">
                    <label for="sort-by-form">sort by:</label>
                    <select name="sortby" id="sortby">
                        <?php
                            $values = ['f.name','average_rating','f.type'];
                            $valueLabels = ['name','rating','type'];

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
                            <p>food:</p>
                            <p>price:</p>
                            <p>rating:</p>
                            <p>type:</p>
                            <a href="" id="itemFiller"></a>
                            <?php
                                $restaurant_id = $_GET['restaurant_id'];
                                echo "<a href='addFoodItem.php?restaurant_id=$restaurant_id' id='new-restaurant-btn'>+ new item</a>"
                            ?>
                        </li>
                        <?php
                            $page_roles = array('admin');
                            require_once '../../security/checksession.php';
                            require_once '../../db.php';
                            require_once '../../security/sanitize.php';

                            $restaurant_id = sanitize($conn,$_GET['restaurant_id']);

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $sortBy = "f.name";

                            if(isset($_POST['sortby'])){
                                $sortBy = $_POST['sortby'];
                            }

                            $query = "SELECT 
                                        f.food_id,
                                        f.name,
                                        f.price,
                                        f.type,
                                        f.description,
                                        COALESCE(ROUND(AVG(r.rating),1), 'N/A') as average_rating,
                                        COUNT(r.review_id) as review_count
                                    FROM 
                                        food f
                                        LEFT JOIN review r ON f.food_id = r.food_id
                                    WHERE 
                                        f.restaurant_id = $restaurant_id 
                                    GROUP BY 
                                        f.food_id, 
                                        f.name,
                                        f.price,
                                        f.type,
                                        f.description
                                    ORDER BY
                                        $sortBy ASC;";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <a href="../reviewManagement/viewReview.php?food_id=$row[food_id]&restaurant_id=$restaurant_id">$row[name]</a>
                                                <p>$row[price]</p>
                                                <p>$row[average_rating]</p>
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
    <script>
        const updateSort = () => {
            document.getElementById("sort-by-form").submit();
        }
    </script>
</body>
</html>