<?php
	include_once(__DIR__ . '/../lib/mysql.php');
	Delete("DELETE FROM patient_appointment WHERE AppointmentID=" . $_GET['aid']);
	
	if(isset($_GET['date'])){
		//call from day_detail.php
		header("Location: day_detail.php?date=" . $_GET['date']);
	}else{
		//call from patient_details.php
		header("Location: ../patient/patient_details.php?pid=" . $_GET['pid']);
	}
?>











