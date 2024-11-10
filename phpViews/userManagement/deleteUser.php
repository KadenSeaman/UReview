<?php
$page_roles = array('admin');

require_once '../../security/checksession.php';
require_once '../../db.php';
require_once '../../security/sanitize.php';


    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    
    if(isset($_POST['delete'])){
        $user_id = $_POST['user_id'];
    
        $query = "DELETE FROM user WHERE user_id='$user_id'";
        
        $result = $conn->query($query);
        if(!$result) die($conn->error);
        
        header("Location: viewUser.php");
    }
    

?>