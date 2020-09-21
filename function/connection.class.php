<?php

// class Connection{

// 	//Properties
// 	private $servername  = 'localhost';
// 	private $username = 'root';
// 	private $password = '';
// 	private $dbname = 'account_manager';

// 	//Constructor
// 	// public function __construct(){
// 	// 	$this->servername = 'localhost';
// 	// 	$this->username = 'root';
// 	// 	$this->password = '';
// 	// 	$this->dbname = 'meme_jar';
// 	// }

// 	//Method
// 	public function connect(){
// 		$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

// 		if($conn){
// 			return $conn;
// 		}
// 		else{
// 			die("Connection failed: " . mysqli_connect_error());
// 		}
// 	}
// }

// function SHOW_CON(){
// 	echo "<p>Connection page is working<p>";
// }

function connect(){
	
	$servername  = 'localhost';
	$username = 'root';
	//$password = '';
	$password = 'alu@1995';
	$dbname = 'renal_project';
	
	$con = new mysqli($servername, $username, $password, $dbname);

	if(mysqli_connect_error()){
		die("Connection failed: " . mysqli_connect_error());
	}else{
		return $con;
	}
}
