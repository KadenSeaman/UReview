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
            <div class="dashboard-link-container">
                <a href="findRestaurants.php" class="dashboard-nav-link">find restaurants</a>
                <a href="mangageRestaurantInfo.php" class="dashboard-nav-link">manage restaurant info</a>
                <a href="paySubscriptionFees.php" class="dashboard-nav-link">pay subscription fees</a>
                <a href="accountManagement.php" class="dashboard-nav-link">account management</a>
                <a href="viewRestaurant.php" class="dashboard-nav-link">manage restaurants</a>
                <a href="viewMember.php" class="dashboard-nav-link">manage members</a>
                <a href="viewFood.php" class="dashboard-nav-link">manage food items</a>
                <a href="viewReview.php" class="dashboard-nav-link">manage reviews</a>
                <a href="viewUser.php" class="dashboard-nav-link">manage users</a>
                <a href="revenueReport.php" class="dashboard-nav-link">revenue report</a>
            </div>
        </div>
        <div class="dashboard-right-container">
            <div class="dashboard-nav-bar">
                <p>role: admin</p>
                <a href="home.php">sign out</a>
            </div>
            <div class="dashboard-main">
                <div class="title">add restaurant</div>
                <div class="dashboard-list-container">
                        <form class="restaurant-input-grid" method='post' action="addRestaurant.php">
                            <input maxlength="30" type="text" name="restaurant-name" id="restaurant-name" placeholder="restaurant name">
                            <input maxlength="60" type="text" name="restaurant-address" id="restaurant-address" placeholder="address">
                            <input maxlength="60" type="email" name="restaurant-email" id="restaurant-email" placeholder="email">
                            <input maxlength="30" type="text" name="restaurant-owner-name" id="restaurant-owner-name" placeholder="owner name">
                            <input maxlength="12" type="tel" name="restaurant-phone" id="restaurant-phone" placeholder="phone">
                            <textarea maxlength="60" type="text" name="restaurant-description" id="restaurant-description" placeholder="description"></textarea>
                            <input maxlength="30"type="text" name="restaurant-type" id="restaurant-type" placeholder="type">
                            <button id="confirm-change-restaurant">add</button>
                        </form>
                        <a id="cancel-change-restaurant">cancel</a>
                </div>
            </div>
    </div>
</body>
</html>

<?php

require_once '../db.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check if restaurant_id exists
if(isset($_POST['restaurant_id'])){
    $restaurant_id = $_POST['restaurant_id'];
    $restaurant_name = $_POST['restaurant-name'];
    $restaurant_address = $_POST['restaurant-address'];
    $restaurant_email = $_POST['restaurant-email'];
    $restaurant_owner_name = $_POST['restaurant-owner-name'];
    $restaurant_phone = $_POST['restaurant-phone'];
    $restaurant_description = $_POST['restaurant-description'];
    $restaurant_type = $_POST['restaurant-type'];


    $query = "INSERT INTO restaurants(restaurant_id,restuarant_name,address,email,owner_name,phone,description,type);
    VALUES ('$restaurant_id','$restaurant_name','$restaurant_address','$restaurant_email','$restaurant_owner_name','$restaurant_phone','$restaurant_description','$restaurant_type')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: viewRestaurant.php");
}
$conn->close();


?>