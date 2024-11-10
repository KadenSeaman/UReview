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
                <div class="title">add food item</div>
                <div class="dashboard-list-container">
                    <?php
                        $page_roles = array('admin');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';
                        require_once '../../security/sanitize.php';

                        $restaurant_id = sanitize($conn,$_GET['restaurant_id']);

                        echo <<<_END
                            <form class='restaurant-input-grid' method='post' action='ownerAddFoodItem.php?restaurant_id=$restaurant_id'>
                                <input required name='name' id='restaurant-name' placeholder='food name'  type='text'>
                                <input required maxlength='60' type='text' name='type' id='restaurant-address' placeholder='type'>
                                <input required maxlength='60' type='text' name='price' id='restaurant-email' placeholder='price'>
                                <textarea required maxlength='60' type='text' name='description' id='restaurant-description' placeholder='description'></textarea>
                                <a href="ownerViewFoodItem.php?restaurant_id=$restaurant_id" id="cancel-change-restaurant">cancel</a>
                                <input id='confirm-change-restaurant' type='submit' value='add'>
                                <input type='hidden' name='update' value='yes'>
                                <input type='hidden' name='restaurant_id' value='$restaurant_id'>
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

//check if restaurant_id exists
if(isset($_POST['name'])){
    $food_name = sanitize($conn, $_POST['name']);
    $food_price = sanitize($conn,$_POST['price']);
    $food_type = sanitize($conn, $_POST['type']);
    $food_description = sanitize($conn, $_POST['description']);
    $restaurant_id = sanitize($conn, $_POST['restaurant_id']);

    $query = "INSERT INTO food(name,price,type,description, restaurant_id)
    VALUES('$food_name','$food_price','$food_type','$food_description','$restaurant_id');";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: ownerViewFoodItem.php?restaurant_id=$restaurant_id");
}
$conn->close();

?>