<?php include('mysql_function.class.php');
session_start();

function LocalHomeUrl(){
	return 'http://localhost/ALU/RenalProject/';
}

define("LOCAL_HOME_URL", "http://localhost/ALU/RenalProject/");

function SHOW($str){
    echo $str;
}

function ReDirect($location){
	header('location: '.$location);

    //ob_start();
    //ob_end_flush();

    //Use these two methods for enabling output buffering.
    //watch this for more info: https://www.youtube.com/watch?v=-RnkbEdDShU
}

function CheckLogin(){
	if(!empty($_SESSION["userid"])){
	    ReDirect(LOCAL_HOME_URL);
		// echo 'User is: '.$_SESSION["user_name"];
	}
}

function IndexCheckLogin(){
	if(empty($_SESSION["userid"])){
		//$home_url = LocalHomeUrl();
		ReDirect(LOCAL_HOME_URL.'login-page.php');
	}
}

//Status Option
function Status(){
    return array(
        "0" => "Inactive",
        "1" => "Active"
    );
}
//Get Status
function getStatus($s){
    $a = Status();
    return $a[$s];
}

//Gender Option
function Gender(){
    return array(
        "1" => "Male",
        "2" => "Female",
        "3" => "Other"
    );
}
//Get Gender
function getGender($g){
    $gender = Gender();
    return $gender[$g];
}

//Otp Option
function OtpOption(){
	return array(
		"0" => "No",
		"1" => "Yes"
	);
}
//Get Otp Option
function getOtpOption($g){
    $otp = OtpOption();
    return $otp[$g];
}

//Admin Access Pages
function AdminAccessPages(){
    return array("home-page.php", "admin-add.php", "admin-view.php", "branch-add.php", "branch-view.php", "staff-add.php", "staff-view.php", "doctor-add.php", "doctor-view.php", "patient-view.php");
}

//Doctor Access Pages
function DoctorAccessPages(){
    return array("home-page.php", "patient-view.php");
}

//Staff Access Pages
function StaffAccessPages(){
    return array("home-page.php", "patient-add.php, patient-view.php");
}

