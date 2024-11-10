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
                    $page_roles = array('admin','owner','user');
                    require_once '../../security/checksession.php';
                    require_once '../../db.php';
                    require_once '../../security/sanitize.php';

                    $user = $_SESSION['user'];
                    $user_roles = $user->getRoles();
                    $role = $user_roles[0];

                    if($role == 'user'){
                        echo "<div class='title'>purchase a lifetime restaurant membership ($59.99)</div>";
                    }
                    else{
                        echo "<div class='title'>pay fees</div>";
                    }
                ?>

                <div class="dashboard-list-container">
                            <?php
                                $page_roles = array('admin','owner','user');
                                require_once '../../security/checksession.php';
                                require_once '../../db.php';
                                require_once '../../security/sanitize.php';

                                $user = $_SESSION['user'];
                                $user_roles = $user->getRoles();
                                $role = $user_roles[0];

                                if($role === 'owner'){
                                    echo <<< _END
                                        <div class="">
                                            <p class="title">You do not have any fees due - you own a lifetime membership</p>
                                        </div>
                                    _END;
                                }
                                else if($role === 'user'){
                                    echo <<< _END
                                            <form class="restaurant-pay-grid" method="post" action="paySubscriptionFee.php">
                                                <input required maxlength="30" type="text" name="name" id="restaurant-name" placeholder="restaurant name">
                                                <input required maxlength="60" type="text" name="address" id="restaurant-address" placeholder="address">
                                                <input required maxlength="60" type="email" name="email" id="restaurant-email" placeholder="email">
                                                <input required maxlength="30" type="text" name="owner-name" id="restaurant-owner-name" placeholder="owner name">
                                                <input required maxlength="12" type="tel" name="phone" id="restaurant-phone" placeholder="phone">
                                                <textarea required maxlength="60" type="text" name="description" id="pay-description" placeholder="description"></textarea>
                                                <input required maxlength="30"type="text" name="type" id="pay-type" placeholder="type">
                                                <input required type="text" placeholder="card number" id="card-number">
                                                <input required type="text" placeholder="expiration date" id="expiration-date">
                                                <input required type="text" placeholder="CVV" id="cvv">
                                                <button id="confirm-payment">complete payment</button>
                                            </form>
                                    _END;
                                }
                                else if($role === 'admin'){
                                    echo <<< _END
                                        <div class="l-dashboard-container">
                                            <p class="title">you are on an admin account - please create a regular user account to purchase a membership</p>
                                        </div>
                                    _END;
                                }

                            ?>
                </div>
            </div>
    </div>
</body>
</html>

<?php

$page_roles = array('user');
require_once '../../security/checksession.php';
require_once '../../db.php';
require_once '../../security/sanitize.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check if restaurant_id exists
if(isset($_POST['name'])){
    $restaurant_name = sanitize($conn, $_POST['name']);
    $restaurant_address = sanitize($conn, $_POST['address']);
    $restaurant_email = sanitize($conn,  $_POST['email']);
    $restaurant_owner_name = sanitize($conn, $_POST['owner-name']);
    $restaurant_phone = sanitize($conn, $_POST['phone']);
    $restaurant_description = sanitize($conn, $_POST['description']);
    $restaurant_type = sanitize($conn, $_POST['type']);
    $user_id = $_SESSION['user']->user_id;

    //create the new restaurant
    $query = "INSERT INTO restaurant(restaurant_name,address,email,owner_name,phone,description,type,user_id)
    VALUES ('$restaurant_name','$restaurant_address','$restaurant_email','$restaurant_owner_name','$restaurant_phone','$restaurant_description','$restaurant_type','$user_id')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    //add the subscription data to the subscription table
    sleep(3);
    $query = "SELECT * FROM restaurant WHERE restaurant_name ='$restaurant_name'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $restaurant_id = $result->fetch_array(MYSQLI_ASSOC)['restaurant_id'];
    $date = date('Y-m-d');

    $query = "INSERT INTO subscription(date, amount, restaurant_id)
    VALUES ('$date','59.99','$restaurant_id')";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    //update the user's role
    $query = "UPDATE user SET role='owner' WHERE user_id='$user_id'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $_SESSION['user']->roles = ['owner'];

    header("Location: paySubscriptionFee.php");
}
$conn->close();

?>