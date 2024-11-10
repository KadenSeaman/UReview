<?php
    $page_roles = array('admin');
    require_once '../../security/checksession.php';
    require_once '../../db.php';
    require_once '../../security/sanitize.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    
    if(isset($_POST['delete'])){
        $food_id = sanitize($conn, $_POST['food_id']);
    
        $query = "DELETE FROM review WHERE food_id='$food_id'";
        
        $result = $conn->query($query);
        if(!$result) die($conn->error);

        $query = "DELETE FROM food WHERE food_id='$food_id'";
        
        $result = $conn->query($query);
        if(!$result) die($conn->error);
        
        $restaurant_id = sanitize($conn, $_POST['restaurant_id']);
        header("Location: viewFoodItems.php?restaurant_id=$restaurant_id");
    }
?>