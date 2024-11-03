<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U Review</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="favicon.ico?" type="image/x-icon">
</head>
<body>
    <div class="l-r-container">
        <div class="left-container">
            <h6>welcome!</h6>
            <p>enter your username, email, name and password to create an account</p>
        </div>
        <div class="right-container">
    
            <form id="vertical-form" action="signup.php" method="post">
                <h1 class="title">sign up</h1>
                <input required class="input-outline" type="text" name="username" id="username" placeholder="username">
                <input required class="input-outline" type="email" name="email" id="email" placeholder="email">
                <input required class="input-outline" type="text" name="name" id="name" placeholder="name">
                <input required class="input-outline" type="password" name="password" id="password" placeholder="password">
                <button class="button-outline"type="submit">sign up</button>
            </form>
    
            <a id="bottom-hyperlink" href="login.php">returning user? login instead</a>
        </div>
    </div>
</body>
</html>


<?php

require_once '../db.php';
require_once 'sanitize.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check if user name exists in post request
if(isset($_POST['name'])){

    $name = sanitize($conn,$_POST['name']);
	$username = sanitize($conn, $_POST['username']);
	$email = sanitize($conn, $_POST['email']);
	$password = sanitize($conn, $_POST['password']); 
    $role = ("user");


    $existsQuery = "SELECT * FROM user WHERE username='$username'";
    $existsResults = $conn->query($existsQuery);
    if(!$existsResults) die($conn->error);

    if($existsResults->num_rows !== 0){
        echo "<p id='signup-error'>username is taken, try again</p>";
    }
    else{
        //password_hash code here
        $token = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user(username,name,password,email,role)
        VALUES ('$username','$name','$token','$email','$role')";

        $result = $conn->query($query);
        if(!$result) die($conn->error);

        header("Location: login.php");
    }
}
$conn->close();


?>