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
                require_once "../components/dashboardleftContainer.php";
            ?>
        </div>
        <div class="dashboard-right-container">
            <?php
                require_once "../components/dashboardNavBar.php";
            ?>
            <div class="dashboard-main">
                <div class="title">edit user</div>
                <div class="dashboard-list-container">
                <?php
                        $page_roles = array('admin');
                        require_once '../db.php';

                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);
                        
                        if(isset($_GET['user_id'])){
                            $user_id = $_GET['user_id'];
                        
                            $query = "SELECT * FROM user WHERE user_id=$user_id";
                        
                            
                            $result = $conn->query($query);
                            if(!$result) die($conn->error);
                        
                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<<_END
                                        <form class="restaurant-input-grid" action="updateUser.php" method="post">
                                            <input required value=$row[name] type="text" name="user-name" placeholder="name" id="user-name">
                                            <input required value=$row[username] type="text" name="user-username" placeholder="username" id="user-username">
                                            <input required value=$row[email] type="email" name="user-email" placeholder="email" id="user-email">
                                            <input required value=$row[role] type="text" name="user-role" placeholder="role" id="user-role">
                                            <input type='hidden' name='update' value='yes'>
                                            <input type='hidden' name='user_id' value='$user_id'>
                                            <a href="viewUser.php" id="cancel-change-restaurant">cancel</a>
                                            <button id="confirm-change-restaurant">update</button>
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
require_once 'checksession.php';
require_once '../db.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


//check if restaurant_id exists
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user-name'];
    $user_username = $_POST['user-username'];
    $user_email = $_POST['user-email'];
    $user_role = $_POST['user-role'];


    $query = "UPDATE user SET user_id='$user_id',username='$user_name',name='$user_name',email='$user_email',role='$user_role' WHERE user_id =$user_id";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: viewUser.php");
}
$conn->close();
    

?>