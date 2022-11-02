<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	Authenticate();
	include_once(__DIR__ . '/patient_helper.php');
	
	Head_Section("Patient Tracking System");
?>
<body>

<script type="text/javascript">	
<?php
	include_once(__DIR__ . '/../lib/js_feeder.php');
	JQ_DocReady_Start();
		NavigationBarJS();
	JQ_DocReady_End();
?>
</script>

<div id='wrapper'>

	<?php 
		PageHeading("Patient Tracking System");
		NavigationBar("control_panel");
	?>
	
	<div id='round_div'>
		<p id='pannel_title'>Patients List</p>
		<div id='patient_search_by_name'>
			<form action="patient_list.php" method="post" name='frmRegister'>
				Type Patient's name
				<?php 
				if(isset($_POST['txtPatientName']))
					$pname = $_POST['txtPatientName'];
				else
					$pname = '';
				echo "<input type='text' name='txtPatientName' value='$pname'/>";
				?>
				<input type='submit' value='Search'/>
			</form>
		</div>
		<?php PatientList('stock',$pname);?>
	</div>
	
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>