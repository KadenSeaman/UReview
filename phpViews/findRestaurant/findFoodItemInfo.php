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
                <div class="title">food item</div>
                <div class="dashboard-list-container">
                    <?php
                    $page_roles = array('admin');
                    require_once '../../security/checksession.php';
                    require_once '../../db.php';
                    require_once '../../security/sanitize.php';

                    $conn = new mysqli($hn, $un, $pw, $db);
                    if ($conn->connect_error)
                        die($conn->connect_error);

                    if (isset($_GET['food_id'])) {
                        $restaurant_id = sanitize($conn, $_GET['restaurant_id']);

                        $food_id = sanitize($conn, $_GET['food_id']);

                        $query = "SELECT * FROM food WHERE food_id=$food_id";


                        $result = $conn->query($query);
                        if (!$result)
                            die($conn->error);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                echo <<<_END
                                        <form class='restaurant-input-grid' method='post' action='updateFoodItem.php?restaurant_id=$restaurant_id'>
                                            <input readonly required value='$row[name]' name='name' id='restaurant-name' placeholder='food name'  type='text'>
                                            <input readonly required value='$row[type]' maxlength='60' type='text' name='type' id='restaurant-address' placeholder='type'>
                                            <input readonly required value='$row[price]' maxlength='60' type='text' name='price' id='restaurant-email' placeholder='price'>
                                            <textarea required maxlength='60' type='text' name='description' id='restaurant-description' placeholder='description'>$row[description]</textarea>
                                            <a href="findFoodItem.php?restaurant_id=$restaurant_id" id="cancel-change-restaurant">back</a>
                                            <input type='hidden' name='food_id' value='$row[food_id]'>
                                            <input type='hidden' name='restaurant_id' value='$row[restaurant_id]'>
                                        </form>
                                    _END;
                            }
                        } else {
                            echo "No data found <br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
</body>
</html>