<?php
    $page_roles = array('admin');
    require_once '../db.php';
    require_once 'checksession.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    
    if(isset($_POST['delete'])){
        $review_id = $_POST['review_id'];
    
        $query = "DELETE FROM review WHERE review_id='$review_id'";
        
        $result = $conn->query($query);
        if(!$result) die($conn->error);

        $restaurant_id = $_POST['restaurant_id'];
        $food_id = $_POST['food_id'];
        header("Location: viewReview.php?food_id=$food_id&restaurant_id=$restaurant_id");
    }
    

?>