<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	
	Head_Section("Patient Tracking System");
?>

<body>
<div id='wrapper'>
	<?php
		PageHeading("Patient Tracking System");
		BackButton("Back","../patient/patient_details.php?pid=" . $_GET['pid']); 
	?>

	<div id='error_msg'>
		<?php echo $_GET['err']; ?>
	</div>
</div>
</body>
</html>