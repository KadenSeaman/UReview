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
                <div class="title">add review</div>
                <div class="dashboard-list-container">
                    <?php
                        $page_roles = array('admin');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';
                        require_once '../../security/sanitize.php';

                        $restaurant_id = sanitize($conn, $_GET['restaurant_id']);
                        $food_id = sanitize($conn, $_GET['food_id']);

                        echo <<< _END
                            <form class="restaurant-input-grid" method="post" action="addReview.php?restaurant_id=$restaurant_id&food_id=$food_id">
                                <input required maxlength="30" type="text" name="username" id="review-username" placeholder="username">
                                <input required type="date" name="date" id="review-date" placeholder="date (leave blank for today's date)">
                                <input required type="number" min="0" max="5" name="rating" id="review-rating" placeholder="rating">
                                <input hidden value='$restaurant_id' name='restaurant_id'>
                                <input hidden value='$food_id' name='food_id'>
                                <a href="viewReview.php?restaurant_id=$restaurant_id&food_id=$food_id" id="cancel-change-restaurant">cancel</a>
                                <button id="confirm-change-restaurant">add</button>
                            </form>
                        _END;
                    ?>
                </div>
            </div>
    </div>
</body>
</html>

<?php

$page_roles = array('admin');
require_once '../../security/checksession.php';
require_once '../../db.php';
require_once '../../security/sanitize.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_POST['username'])){
    $username = sanitize($conn, $_POST['username']);
    $date = sanitize($conn, $_POST['date']);
    $rating = sanitize($conn, $_POST['rating']);
    $restaurant_id = sanitize($conn, $_POST['restaurant_id']);
    $food_id = sanitize($conn, $_POST['food_id']) ;

    $query = "SELECT * FROM user WHERE username='$username'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    if($result->num_rows > 0){
        $user_id = $result->fetch_array(MYSQLI_ASSOC);
        $user_id = $user_id['user_id'];

        $query = "SELECT * FROM review WHERE user_id=$user_id AND food_id=$food_id";
        $result = $conn->query($query);
        if(!$result) die($conn->error);

        if($result->num_rows > 0){
            echo "a review already exists for this user";
        }
        else{
            $query = "INSERT INTO review(user_id, food_id, rating, date)
            VALUES ('$user_id','$food_id','$rating','$date')";
        
            $result = $conn->query($query);
            if(!$result) die($conn->error);
        
            header("Location: viewReview.php?restaurant_id=$restaurant_id&food_id=$food_id");
        }
    }
    else{
        echo "username does not exist";
    }
}
$conn->close();

?>