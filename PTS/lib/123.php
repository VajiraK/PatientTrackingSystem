<?php
	include_once(__DIR__ . '/mysql.php');
	$con = OpenConnection();
	ExecuteSQL("ALTER TABLE `patient_appointment` ADD `ImageDescription` VARCHAR( 400 ) NOT NULL AFTER `Image`");
?>