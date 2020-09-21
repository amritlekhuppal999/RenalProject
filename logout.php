<?php include('function/function.class.php');
	
session_unset();
session_destroy();
ReDirect(LOCAL_HOME_URL);
?>