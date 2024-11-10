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
                <div class="title">update restaurant</div>
                <div class="dashboard-list-container">
                    <?php
                        $page_roles = array('admin');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';
                        require_once '../../security/sanitize.php';

                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);
                        
                        if(isset($_GET['restaurant_id'])){
                            $restaurant_id = sanitize($conn, $_GET['restaurant_id']);
                        
                            $query = "SELECT * FROM restaurant WHERE restaurant_id=$restaurant_id";
                        
                            $result = $conn->query($query);
                            if(!$result) die($conn->error);
                        
                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<<_END
                                        <form class='restaurant-input-grid' method='post' action='updateRestaurant.php'>
                                            <input required value='$row[restaurant_name]' name='restaurant-name' id='restaurant-name' placeholder='restaurant name'  type='text'>
                                            <input required value='$row[address]' maxlength='60' type='text' name='restaurant-address' id='restaurant-address' placeholder='address'>
                                            <input required value='$row[email]' maxlength='60' type='email' name='restaurant-email' id='restaurant-email' placeholder='email'>
                                            <input required value='$row[owner_name]' maxlength='30' type='text' name='restaurant-owner-name' id='restaurant-owner-name' placeholder='owner name'>
                                            <input required value='$row[phone]' maxlength='12' type='tel' name='restaurant-phone' id='restaurant-phone' placeholder='phone'>
                                            <textarea required maxlength='60' type='text' name='restaurant-description' id='restaurant-description' placeholder='description'>$row[description]</textarea>
                                            <input required value='$row[type]' maxlength='30'type='text' name='restaurant-type' id='restaurant-type' placeholder='type'>
                                            <a href="viewRestaurant.php" id="cancel-change-restaurant">cancel</a>
                                            <input id='confirm-change-restaurant' type='submit' value='update'>
                                            <input type='hidden' name='update' value='yes'>
                                            <input type='hidden' name='restaurant_id' value='$row[restaurant_id]'>
                                        </form>
                                    _END;
                                }
                            }
                            else{
                                echo "No data found <br>";
                            }
                        }
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
if(isset($_POST['restaurant_id'])){
    $restaurant_id = sanitize($conn,$_POST['restaurant_id']);
    $restaurant_name = sanitize($conn,$_POST['restaurant-name']); 
    $restaurant_address = sanitize($conn,$_POST['restaurant-address']);
    $restaurant_email = sanitize($conn, $_POST['restaurant-email']);
    $restaurant_owner_name = sanitize($conn, $_POST['restaurant-owner-name']);
    $restaurant_phone = sanitize($conn,$_POST['restaurant-phone']);
    $restaurant_description = sanitize($conn,$_POST['restaurant-description']);
    $restaurant_type = sanitize($conn, $_POST['restaurant-type']);


    $query = "UPDATE restaurant SET restaurant_id='$restaurant_id',restaurant_name='$restaurant_name',address='$restaurant_address',email='$restaurant_email',owner_name='$restaurant_owner_name',phone='$restaurant_phone',description='$restaurant_description',type='$restaurant_type' WHERE restaurant_id=$restaurant_id";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: viewRestaurant.php");
}
$conn->close();
?>