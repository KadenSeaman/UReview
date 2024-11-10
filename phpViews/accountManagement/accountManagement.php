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
                <div class="title">edit profile</div>
                <div class="dashboard-list-container">
                <?php
                        $page_roles = array('admin','owner','user');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';

                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);
                        
                        if(isset($_SESSION['user']->user_id)){
                            $user_id = $_SESSION['user']->user_id;
                        
                            $query = "SELECT * FROM user WHERE user_id=$user_id";
                        
                            
                            $result = $conn->query($query);
                            if(!$result) die($conn->error);
                        
                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<<_END
                                        <form class="restaurant-input-grid" action="accountManagement.php" method="post">
                                            <input required value=$row[name] type="text" name="user-name" placeholder="name" id="user-name">
                                            <input readonly required value=$row[username] type="text" name="user-username" placeholder="username" id="user-username">
                                            <input required value=$row[email] type="email" name="user-email" placeholder="email" id="user-email">
                                            <input type="text" name="user-password" placeholder="password - do not edit if you do not want to change passwords" id="user-role">
                                            <input type='hidden' name='update' value='yes'>
                                            <input type='hidden' name='user_id' value='$user_id'>
                                            <a href="accountManagement.php" id="cancel-change-restaurant">cancel changes</a>
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
$page_roles = array('admin','owner','user');
require_once '../../security/checksession.php';
require_once '../../db.php';
require_once '../../security/sanitize.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


//check if user_id exists
if(isset($_POST['user_id'])){
    $user_id = sanitize($conn, $_POST['user_id']);
    $user_name = sanitize($conn, $_POST['user-name']);
    $user_username = sanitize($conn, $_POST['user-username']);
    $user_email = sanitize($conn,$_POST['user-email']);
    $user_password = $_POST['user-password'];

    $query = "";

    if($user_password !== ""){
        //user updated password
        $token = password_hash($user_password, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password='$token',user_id='$user_id',username='$user_name',name='$user_name',email='$user_email' WHERE user_id =$user_id";
    }
    else{
        //user did not update password
        $query = "UPDATE user SET user_id='$user_id',username='$user_name',name='$user_name',email='$user_email' WHERE user_id =$user_id";
    }


    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: accountManagement.php");
}
$conn->close();
?>