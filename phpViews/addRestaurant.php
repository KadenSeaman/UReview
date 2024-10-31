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
                require_once "../components/dashbaordNavBar.html";
            ?>
            <div class="dashboard-main">
                <div class="title">add restaurant</div>
                <div class="dashboard-list-container">
                        <form class="restaurant-input-grid" method="post" action="addRestaurant.php">
                            <input required maxlength="30" type="text" name="name" id="restaurant-name" placeholder="restaurant name">
                            <input required maxlength="60" type="text" name="address" id="restaurant-address" placeholder="address">
                            <input required maxlength="60" type="email" name="email" id="restaurant-email" placeholder="email">
                            <input required maxlength="30" type="text" name="owner-name" id="restaurant-owner-name" placeholder="owner name">
                            <input required maxlength="12" type="tel" name="phone" id="restaurant-phone" placeholder="phone">
                            <textarea required maxlength="60" type="text" name="description" id="restaurant-description" placeholder="description"></textarea>
                            <input required maxlength="30"type="text" name="type" id="restaurant-type" placeholder="type">
                            <a href="viewRestaurant.php" id="cancel-change-restaurant">cancel</a>
                            <button id="confirm-change-restaurant">add</button>
                        </form>
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
if(isset($_POST['name'])){
    $restaurant_name = $_POST['name'];
    $restaurant_address = $_POST['address'];
    $restaurant_email = $_POST['email'];
    $restaurant_owner_name = $_POST['owner-name'];
    $restaurant_phone = $_POST['phone'];
    $restaurant_description = $_POST['description'];
    $restaurant_type = $_POST['type'];


    $query = "INSERT INTO restaurant(restaurant_name,address,email,owner_name,phone,description,type)
    VALUES ('$restaurant_name','$restaurant_address','$restaurant_email','$restaurant_owner_name','$restaurant_phone','$restaurant_description','$restaurant_type')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: viewRestaurant.php");
}
$conn->close();


?>