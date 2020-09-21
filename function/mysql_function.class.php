<?php include('connection.class.php');

// function SHOW_MYSQL(){
// 	echo "<p>MySql function page is working</p>";
// }

//CRUD FUNCTIONS (Object Oriented)

//Record Set
class RecordSet{
	//properties
	private $sql;
	private $conn;
	public $totalRows;
	public $result;

	//construct
	public function __construct($query=''){
		$this->conn = connect();
		$this->sql = $query;
		$this->result = mysqli_query($this->conn,$this->sql);
		 
		if(mysqli_num_rows($this->result)){
			$this->totalRows = mysqli_num_rows($this->result);
		}
	}
}

//Insert Row
class RowInsert{
	//properties
	private $conn;
	private $sql;
	private $array_count;
	private $count;
	public $id;

	//Constructor
	public function __construct($table_name, $table_data){
		$this->conn = connect();

		$this->sql = 'INSERT INTO '.$table_name.' (';
		$this->array_count = count($table_data);
		$this->count = 0;
		foreach($table_data as $key => $val){ 
			$this->count++;
			if($this->count == $this->array_count){
				$this->sql .= $key.')';
			}
			else{
				$this->sql .= $key.',';
			}
		}
		$this->sql .= ' VALUES (';
		$this->count = 0;
		foreach($table_data as $key => $val){ 
			$this->count++;
			if($this->count == $this->array_count){
				$this->sql .= '"'.$val.'")';
			}
			else{
				$this->sql .= '"'.$val.'",';
			}
		}
		//echo $this->sql;

		if(mysqli_query($this->conn, $this->sql)){
			$this->id = mysqli_insert_id($this->conn);
		}
		// else{ $this->id = 0; //echo 'Error Inserting record';
		// }
		//mysqli_close($conn);
	}
}

//Update Row 
class RowUpdate{
	//properties
	private $conn;
	private $sql;
	private $count;
	private $array_count;
	public $updated;

	//constructor
	public function __construct($table_name, $table_data, $condition){
		$this->conn = connect();

		$this->sql = 'UPDATE '.$table_name.' SET ';
		$this->count = 0;
		$this->array_count = count($table_data);

		foreach($table_data as $key => $val){ 
			$this->count++;
			if($this->count == $this->array_count){
				$this->sql .= $key.'= "'.$val.'"';
			}
			else{
				$this->sql .= $key.'= "'.$val.'", ';
			}
		}
		if (strpos($condition, 'WHERE') !== false || strpos($condition, 'Where') !== false) {
	    	$this->sql .= $condition;
		}
		else{ $this->sql .= ' WHERE '.$condition; }
		
		//echo $this->sql;

		if(mysqli_query($this->conn, $this->sql)){
			$this->updated = true;
			//echo 'Record updated';
		}else { 
			$this->updated = false;
			//echo 'Error updating record';
		}
	}
}

//Delete Row
class RowDelete{
	//properties
	private $conn;
	private $sql;
	public $deleted = false;

	//constructor
	public function __construct($table_name, $condition){
		$this->conn = connect();
		$this->sql = 'DELETE FROM '.$table_name;
		if (strpos($condition, 'WHERE') !== false || strpos($condition, 'Where') !== false) {
	    	$this->sql .= ' '.$condition;
		}
		else{ $this->sql .= ' WHERE '.$condition; }
		//echo $this->sql;
		if(mysqli_query($this->conn, $this->sql)){
			$this->deleted = true;
			// echo '<br/>Record deleted';
		}
		else{
			//echo 'error deleting record';
			$this->deleted = false;
		}
	}
}













//Procedural CRUD FUNCTIONS------------------------------------------------------------------------------------------
	
	//RECORD SET 
// function record_set($var1='', $var2=''){	//Read reocrds from database
// 	$sql = $var2;
// 	global  $$var1;
// 	global ${'totalRows_'.$var1};

// 	$conn = connection();		//To get connection object for database
// 	$$var1 = mysqli_query($conn,$sql);
// 	if(mysqli_num_rows($$var1)){
// 		${'totalRows_'.$var1} = mysqli_num_rows($$var1);
// 	}
// 	mysqli_close($conn);
// }


	//ROW INSERT
// function dbRowInsert($table_name,$table_data){		//Row insert function
// 	$conn = connection();
// 	$sql = 'INSERT INTO '.$table_name.' (';
// 	$array_count = count($table_data);
// 	$count = 0;
// 	foreach($table_data as $key => $val){ 
// 		$count++;
// 		if($count == $array_count){
// 			$sql .= $key.')';
// 		}
// 		else{
// 			$sql .= $key.',';
// 		}
// 	}
// 	$sql .= ' VALUES (';
// 	$count = 0;
// 	foreach($table_data as $key => $val){ 
// 		$count++;
// 		if($count == $array_count){
// 			$sql .= '"'.$val.'")';
// 		}
// 		else{
// 			$sql .= '"'.$val.'",';
// 		}
// 	}
// 	//echo $sql;
// 	if(mysqli_query($conn,$sql)){
// 		$insert_id = mysqli_insert_id($conn);
// 		return $insert_id;
// 		//echo 'Record Inserted';
// 	}
// 	//else {echo 'Error Inserting record';}
// 	mysqli_close($conn);
// }

	//Row Update
// function dbRowUpdate($table_name, $table_data, $condition){		//Row update function
// 	$conn = connection();
// 	$sql = 'UPDATE '.$table_name.' SET ';
// 	$count = 0;
// 	$array_count = count($table_data);
// 	foreach($table_data as $key => $val){ 
// 		$count++;
// 		if($count == $array_count){
// 			$sql .= $key.'= "'.$val.'"';
// 		}
// 		else{
// 			$sql .= $key.'= "'.$val.'", ';
// 		}
// 	}
// 	if (strpos($condition, 'WHERE') !== false || strpos($condition, 'Where') !== false) {
//     	$sql .= $condition;
// 	}
// 	else{ $sql .= ' WHERE '.$condition; }
// 	echo $sql;

// 	if(mysqli_query($conn,$sql)){
// 		return 1;
// 		//echo 'Record Inserted';
// 	}
// 	else {echo 'Error Inserting record';}
// 	mysqli_close($conn);
// }

	//Row Delete
// function dbRowDelete($table_name, $condition){
// 	$conn = connection();
// 	$sql = 'DELETE FROM '.$table_name;
// 	if (strpos($condition, 'WHERE') !== false || strpos($condition, 'Where') !== false) {
//     	$sql .= $condition;
// 	}
// 	else{ $sql .= ' WHERE '.$condition; }

// 	if(mysqli_query($conn,$sql)){
// 		//return 1;
// 		echo 'Record deleted';
// 	}
// 	else {echo 'error deleting record';}
// }

?>