<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	include_once(__DIR__ . '/patient_helper.php');
	include_once(__DIR__ . '/../lib/mysql.php');
	
	if(isset($_POST['txtPatientID']))
		$patientID = $_POST['txtPatientID'];
	else if(isset($_GET['pid']))
		$patientID = $_GET['pid'];
		
	$con = OpenConnection();
	$row_detail = GetPatientDetails($patientID,$con);
	$row_medical = GetPatientMedicalCondition($patientID);
	
	Head_Section("Patient Tracking System");
?>

<body>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type='text/javascript' src='../js/patient_details.js'></script>
<script type="text/javascript">	
<?php
	include_once(__DIR__ . '/../lib/js_feeder.php');
	JQ_DocReady_Start();
		NavigationBarJS();
	JQ_DocReady_End();
	DelectionConfirm();
	IsImageSelected();
	DrawGrid();
	DrawGridById();
	DrawGrids();
	ShowHideGrid();
?>
</script>

<div id='wrapper'>
	<?php 
		PageHeading("Patient Tracking System");
		NavigationBar("control_panel");
	?>
	<div id='round_div'>
		<p id='pannel_title' >Patients Details ID : <?php echo $patientID ?></p>
		<?php
		BeginColumnContainer(800);
			BeginColumn(210);
				DisplayFild('ID',$row_detail['ID']);
				DisplayFild('Name',$row_detail['Name']);
				DisplayFild('Age',$row_detail['Age']);
				DisplayFild('Gender',$row_detail['Gender']);
				DisplayFild('Contact 1',$row_detail['Contact1']);
				DisplayFild('Contact 2',$row_detail['Contact2']);
				DisplayFild('Address',$row_detail['Address'],100,true);
				DisplayFild('Type of ulcer',$row_detail['Type'],100,true);
				DisplayFild('Ulcer Location',$row_detail['Location'],100,true);
				DisplayFild('Comment',$row_detail['Description'],100,true);
				DisplayFild('Plan',$row_detail['Intervention'],100,true);
				DisplayFild('Intervention',$row_detail['Assessment'],100,true);
			EndColumn();
			BeginColumn(210);
				LoadWoundImage($row_detail['Image'],0,$row_detail['ID'],'patient','',$row_detail['ImageDescription']);
				CheckTables($row_medical,true);
				EditPatient($row_detail['ID']);
			EndColumn();
		EndColumnContainer();
		?>
	</div>
	
	<!-- old appointments -->
	<?php 
		$has_open = GetAppointments($patientID);
		mysql_close($con);
		
		//new appointment -->
		if($has_open==false)
			PutNewAppointmentForm($patientID);
		Footer();
	?>
</div><!--Wrapper DIV -->
<script>
	setTimeout('DrawGrids()',4000);
</script>
</body>
</html>