<?php ini_set('display_errors', true);
include('function/function.class.php');
	

$myVar = json_decode(file_get_contents('php://input'));

	if(!empty($myVar->action) && $myVar->action == "check-email"){
		$email = $myVar->email;
		$datArr = array();

		$getEmail = new RecordSet('SELECT id FROM `admin` WHERE email="'.$email.'"');
		if($getEmail->totalRows > 0){
			$datArr["exists"] = 1;
		}
		else{
			$datArr["exists"] = 0;
		}
		
		echo json_encode($datArr, JSON_PRETTY_PRINT);
	}	
	
?>