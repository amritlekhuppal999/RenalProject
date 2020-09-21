<?php 
ini_set('display_errors', true);
include('function/function.class.php');

if($_POST["action"] == "reg-rate"){

	$data = array();

	// $getPatient = new RecordSet('SELECT id, cdate FROM `patient` LIMIT 7');
	// if($getPatient->totalRows){
	// 	$patient_count = 0;
	// 	$patientArr = array(); $dateArr = array();
	// 	while($rowData = $getPatient->result->fetch_assoc()){
	// 		array_push($dateArr, $rowData["cdate"]);
	// 		array_push($patientArr, ++$patient_count);
	// 	}
	// 	$data["patientArr"] = $patientArr;
	// 	$data["dateArr"] = $dateArr;
	// }
	$data["dat"] = "working";
	echo json_encode($data, JSON_PRETTY_PRINT);

}
?>