<?php
    $page_roles = array('user','admin','owner');
    require_once '../../security/checksession.php';
    require_once '../../db.php';
    require_once '../../security/sanitize.php';

    $restaurant_id = $_GET['restaurant_id'];
    $user_id = $_SESSION['user']->user_id;

    $conn = new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);

    $query = "DELETE FROM follow WHERE user_id='$user_id' AND restaurant_id='$restaurant_id'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    header("Location: findRestaurant.php")
?>