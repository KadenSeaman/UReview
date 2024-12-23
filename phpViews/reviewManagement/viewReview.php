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

                    $conn = new mysqli($hn,$un,$pw,$db);
                    if($conn->connect_error) die($conn->connect_error);

                    $food_id = sanitize($conn, $_GET['food_id']);
                    $restaurant_id = sanitize($conn, $_GET['restaurant_id']);

                    $query = "SELECT * FROM food WHERE food_id=$food_id";

                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo "<div class='title'>$row[name]'s reviews</div>";
                        }
                    }
                    else{
                        echo "No data found <br>";
                    }

                    $result->close();
                    $conn->close();
                ?>
                <form method="POST" onchange="updateSort()" id="sort-by-form">
                    <label for="sort-by-form">sort by:</label>
                    <select name="sortby" id="sortby">
                        <?php
                            $values = ['username','rating','date'];
                            $valueLabels = ['username','rating','date'];

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
                            <p>username:</p>
                            <p>rating:</p>
                            <p>date:</p>
                            <a href="" id="restaurantSelectFiller"></a>
                            <?php
                                $page_roles = array('admin');
                                require_once '../../security/checksession.php';
                                require_once '../../db.php';
                                require_once '../../security/sanitize.php';

                                $conn = new mysqli($hn,$un,$pw,$db);
                                if($conn->connect_error) die($conn->connect_error);

                                $restaurant_id = sanitize($conn,$_GET['restaurant_id']);
                                $food_id = sanitize($conn, $_GET['food_id']);

                                $conn->close();

                                echo "<a href='addReview.php?restaurant_id=$restaurant_id&food_id=$food_id' id='new-restaurant-btn'>+ new review</a>";
                        ?>
                        </li>
                        <?php
                            $page_roles = array('admin');
                            require_once '../../security/checksession.php';
                            require_once '../../db.php';
                            require_once '../../security/sanitize.php';

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $food_id = sanitize($conn, $_GET['food_id']);
                            $restaurant_id = sanitize($conn, $_GET['restaurant_id']);

                            
                            $sortBy = "username";

                            if(isset($_POST['sortby'])){
                                $sortBy = $_POST['sortby'];
                            }

                            $query = "SELECT * FROM review as r JOIN user as u ON r.user_id = u.user_id WHERE food_id=$food_id ORDER BY $sortBy ASC";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <p>$row[username]</p>
                                                <p>$row[rating]</p>
                                                <p>$row[date]</p>
                                                <a href="updateReview.php?review_id=$row[review_id]&food_id=$food_id&restaurant_id=$restaurant_id">edit</a>
                                                <form action='deleteReview.php' method='post'>
                                                    <input type='hidden' name='delete' value='yes'>
                                                    <input type='hidden' name='restaurant_id' value=$restaurant_id>
                                                    <input type='hidden' name='food_id' value=$food_id;>
                                                    <input type='hidden' name='review_id' value='$row[review_id]'>
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
    <script>
        const updateSort = () => {
            document.getElementById("sort-by-form").submit();
        }
    </script>
</body>
</html>