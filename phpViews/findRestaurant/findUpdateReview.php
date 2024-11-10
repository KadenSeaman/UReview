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
                <div class="title">update review</div>
                <div class="dashboard-list-container">
                    <?php
                        $page_roles = array('admin','user','owner');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';
                        require_once '../../security/sanitize.php';                 

                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);

                        $restaurant_id = sanitize($conn, $_GET['restaurant_id']);
                        $food_id = sanitize($conn, $_GET['food_id']);
                        $review_id = sanitize($conn,$_GET['review_id']);

                        $query = "SELECT r.rating, r.date, u.username FROM review as r JOIN user as u ON r.user_id = u.user_id WHERE review_id='$review_id'";

                        $result = $conn->query($query);
                        if(!$result) die($conn->error);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                $rating = $row['rating'];
                                $date = $row['date'];
                                $username = $row['username'];

                                echo <<< _END
                                <form class="restaurant-input-grid" method="post" action="findUpdateReview.php?restaurant_id=$restaurant_id&food_id=$food_id">
                                    <input readonly required maxlength="30" value='$username' type="text" name="username" id="review-username" placeholder="username">
                                    <input required type="date" name="date" id="review-date" value='$date' placeholder="date">
                                    <input required type="number" min="0" max="5" value="$rating" name="rating" id="review-rating" placeholder="rating">
                                    <input hidden value='$restaurant_id' name='restaurant_id'>
                                    <input hidden value='$review_id' name='review_id'>
                                    <input hidden value='$food_id' name='food_id'>
                                    <a href="findReview.php?restaurant_id=$restaurant_id&food_id=$food_id" id="cancel-change-restaurant">cancel</a>
                                    <button id="confirm-change-restaurant">update</button>
                                </form>
                            _END;
                            }
                        }
                    ?>
                </div>
            </div>
    </div>
</body>
</html>

<?php

$page_roles = array('admin','owner','user');
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
    $food_id = sanitize($conn, $_POST['food_id']);
    $review_id = sanitize($conn, $_POST['review_id']);

    $query = "UPDATE review SET date='$date',rating='$rating' WHERE review_id=$review_id";
    $result = $conn->query($query);

    header("Location: findReview.php?restaurant_id=$restaurant_id&food_id=$food_id");
}
$conn->close();

?>