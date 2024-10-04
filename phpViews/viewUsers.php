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
                <a href="findRestaurants.html" class="dashboard-nav-link">find restaurants</a>
                <a href="mangageRestaurantInfo.html" class="dashboard-nav-link">manage restaurant info</a>
                <a href="paySubscriptionFees.html" class="dashboard-nav-link">pay subscription fees</a>
                <a href="accountManagement.html" class="dashboard-nav-link">account management</a>
                <a href="manageRestaurants.html" class="dashboard-nav-link">manage restaurants</a>
                <a href="manageMembers.html" class="dashboard-nav-link">manage members</a>
                <a href="manageFoodItems.html" class="dashboard-nav-link">manage food items</a>
                <a href="manageReviews.html" class="dashboard-nav-link">manage reviews</a>
                <a href="manageUsers.html" class="dashboard-nav-link">manage users</a>
                <a href="revenueReport.html" class="dashboard-nav-link">revenue report</a>
            </div>
        </div>
        <div class="dashboard-right-container">
            <div class="dashboard-nav-bar">
                <p>role: admin</p>
                <a href="home.html">sign out</a>
            </div>
            <div class="dashboard-main">
                <div class="title">manage users</div>
                <label for="sortby">sort by:
                    <select name="sortby" id="sortby">
                        <option value="username">username</option>
                        <option value="name">name</option>
                        <option value="email">email</option>
                        <option value="role">role</option>
                    </select>
                </select></label>
                <div class="dashboard-list-container">
                    <ul>
                        <li class="restaurant-list-item header-list-item">
                            <p>username:</p>
                            <p>name:</p>
                            <p>email:</p>
                            <p>role:</p>
                            <a href="" id="userFiller"></a>
                            <a href="addNewUser.html" id="new-restaurant-btn">+ new user</a>
                        </li>
                        <?php
                            require_once "db.php";

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $sortby = $_POST['sortby'];

                            $query = "SELECT * FROM user ORDER BY ".$sortby;

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<< _END
                                        <li class="restaurant-list-item>
                                            <p>$row[username]</p>
                                            <p>$row[name]</p>
                                            <p>$row[email]</p>
                                            <p>$row[role]</p>
                                            <a href="updateUser.php?$row[username]>edit</a>
                                            <form action='deleteUser.php' method='post'>
                                                <input type='hidden' name='delete' value='yes'>
                                                <input type='hidden' name='username' value='$row[username]'>
                                                <input class="delete-btn" type='submit' value='- delete'>
                                            </form>
                                        </li>
                                    _END;
                                }
                            }
                            else{
                                echo "No data found <br>"
                            }

                            $result->close();
                            $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
    </div>
</body>
</html>