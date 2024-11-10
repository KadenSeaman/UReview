<?php
    $page_roles = array('admin');
    require_once '../../security/checksession.php';
    require_once '../../db.php';
    require_once '../../security/sanitize.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    
    if(isset($_POST['delete'])){
        $restaurant_id = sanitize($conn, $_POST['restaurant_id']);
    
        $query = "DELETE FROM restaurant WHERE restaurant_id='$restaurant_id' ";
        
        $result = $conn->query($query);
        if(!$result) die($conn->error);
        
        header("Location: viewRestaurant.php");
    }
    

?>