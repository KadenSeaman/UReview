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
                <div class="title">add user</div>
                <div class="dashboard-list-container">
                    <form class="restaurant-input-grid" action="addUser.php" method="post">
                        <input required type="text" name="name" placeholder="name" id="user-name">
                        <input required type="text" name="username" placeholder="username" id="user-username">
                        <input required type="email" name="email" placeholder="email" id="user-email">
                        <input required type="text" name="role" placeholder="role" id="user-role">
                        <input required type="text" name="password" placeholder="password" id="user-password">
                        <a href="viewUser.php" id="cancel-change-restaurant">cancel</a>
                        <button id="confirm-change-restaurant">add</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>

<?php

$page_roles = array('admin');

require_once '../db.php';
require_once 'sanitize.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check if user name exists in post request
if(isset($_POST['name'])){

    $name = sanitize($conn,$_POST['name']);
	$username = sanitize($conn, $_POST['username']);
	$email = sanitize($conn, $_POST['email']);
	$password = sanitize($conn, $_POST['password']); 
    $role = sanitize($conn, $_POST['role']);

    //password_hash code here
	$token = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user(username,name,password,email,role)
    VALUES ('$username','$name','$token','$email','$role')";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: addUser.php");
}
$conn->close();


?>