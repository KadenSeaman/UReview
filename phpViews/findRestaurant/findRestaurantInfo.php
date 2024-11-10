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
                <div class="title">view restaurant info</div>
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
                                            <input readonly required value='$row[restaurant_name]' name='restaurant-name' id='restaurant-name' placeholder='restaurant name'  type='text'>
                                            <input readonly required value='$row[address]' maxlength='60' type='text' name='restaurant-address' id='restaurant-address' placeholder='address'>
                                            <input readonly required value='$row[email]' maxlength='60' type='email' name='restaurant-email' id='restaurant-email' placeholder='email'>
                                            <input readonly required value='$row[owner_name]' maxlength='30' type='text' name='restaurant-owner-name' id='restaurant-owner-name' placeholder='owner name'>
                                            <input readonly required value='$row[phone]' maxlength='12' type='tel' name='restaurant-phone' id='restaurant-phone' placeholder='phone'>
                                            <textarea readonly required maxlength='60' type='text' name='restaurant-description' id='restaurant-description' placeholder='description'>$row[description]</textarea>
                                            <input readonly required value='$row[type]' maxlength='30'type='text' name='restaurant-type' id='restaurant-type' placeholder='type'>
                                            <a href="findRestaurant.php" id="cancel-change-restaurant">cancel</a>
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