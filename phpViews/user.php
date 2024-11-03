<?php

require_once "../db.php";

$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die ($conn->connect_error);

class User{
	
	public $username;
	public $roles = Array();
	public $user_id = -1;
	
	function __construct($username){
		global $conn;
				
		$this->username = $username;
		
		//roles
		$query="select role from user where username='$username'";
		$result = $conn->query($query);
		if(!$result) die($conn->error);
			
		$rows = $result->num_rows;		
		
		$roles = Array();
		for($i=0; $i<$rows; $i++){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$roles[] = $row['role'];
		}		
		
		$this->roles = $roles;


		//user_id
		$query="select user_id from user where username='$username'";
		$result = $conn->query($query);
		if(!$result) die($conn->error);
			
		$rows = $result->num_rows;		
		
		$user_id = -1;

		for($i=0; $i<$rows; $i++){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$user_id = $row['user_id'];
		}		
		
		$this->user_id = $user_id;
	}

	function getRoles(){
		return $this->roles;
	}

}

?>