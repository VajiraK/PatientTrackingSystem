<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	include_once(__DIR__ . '/patient_helper.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	
	Head_Section("Patient Tracking System");
?>
<body> 
<script type='text/javascript'>
	<?php
		include_once(__DIR__ . '/../lib/js_feeder.php');
		JQ_DocReady_Start();
			NavigationBarJS();
		JQ_DocReady_End();
		ValidateFormEx();
		DelectionConfirm();
	?>  
</script> 

<div id='wrapper'>
	<?php 
		PageHeading("Patient Tracking System");
		NavigationBar("control_panel");
		if(isset($_POST['btnEdit']))
			BackButton("< Patient","patient_details.php?pid=" . $_POST['hidPID']);
	?>
	<div id='round_div'>
	
		<?php 
		$row_detail = 0;
		$row_medical = 0;
		if(isset($_POST['btnEdit'])){
			include_once(__DIR__ . '/../lib/mysql.php');
			$con = OpenConnection();
			$row_detail = GetPatientDetails($_POST['hidPID'],$con);
			$row_medical = GetPatientMedicalCondition($_POST['hidPID']);
			echo "<p id='pannel_title'>Edit Patient : " . $_POST['hidPID'] . "</p>
					<div id='edit_form'>
						<form id='frmRegPatient' action='patient_save_del_up.php' method='post' name='frmRegister'
							onSubmit='return ValidateForm(\"frmRegPatient\");'>";
		}else{
			echo "<p id='pannel_title'>Patient Registration</p>
					<div id='edit_form'>
						<form id='frmRegPatient' action='patient_save_del_up.php' method='post' name='frmRegister'
							enctype='multipart/form-data' onSubmit='return ValidateForm(\"frmRegPatient\");'>";
		
		}
		?>
		<table>
		<?php 
			FormField('Name','text','txtName',$row_detail['Name']);
			FormField('Age','text','txtAge',$row_detail['Age']);
		?>
			<tr>
			<td>
			Gender
			</td>
			<td>
			<select name="txtGender">
				<?php
				if($row_detail['Gender']=='female')
					echo "<option value='male'>male</option><option selected value='female'>female</option>";
				else
					echo "<option selected value='male'>male</option><option value='female'>female</option>";
				?>
			</select>
			</td>
			<tr>
		<?php 
			FormField('Contact 1','text','txtContact1',$row_detail['Contact1']);
			
			if($row_detail['Contact2']=='')
				FormField('Contact 2','text','txtContact2','none');
			else
				FormField('Contact 2','text','txtContact2',$row_detail['Contact2']);
				
			FormCommentField('Address','20','4','txtAddress','',$row_detail['Address']);
			echo '<tr><td colspan=2><hr></td></tr>';
			FormCommentField('Type of ulcer','20','4','txtType','',$row_detail['Type']);
			FormCommentField('Wound Location','20','4','txtLocation','',$row_detail['Location']);
			FormCommentField('Description','20','4','txtDescription','',$row_detail['Description']);
			
			if(!isset($_POST['btnEdit']))
				echo "<tr><td>Wound image</td><td><input type='file' name='file' id='file'></td></tr>";
				
			if($row_detail['ImageDescription']==''){
				FormCommentField('Comment','20','4',
								'txtImageDescription','','none');
			}else{
				FormCommentField('Image description','20','4',
								'txtImageDescription','',$row_detail['ImageDescription']);
			}
								
			FormCommentField('Plan','20','4','txtIntervention','',$row_detail['Intervention']);
			FormCommentField('Intervention','20','4','txtAssessment','',$row_detail['Assessment']);
		?>
		</table>
		</div><!-- edit_form 1 -->
		
		<div id='edit_form'>
		<?php 
			CheckTables($row_medical);
		echo "<div style='text-align:right;'>";
			if(isset($_POST['btnEdit'])){
				mysql_close($con);
				echo 	"<input type='hidden' name='hidPID' value='" . $_POST['hidPID'] . "'/>
						<input id='DeleteButton' type='button' name='btnDelete' value='Delete'
								onclick=\"DelectionConfirm(
								'Do you really want to delete this patient, this will also delete all of his appointments',
								'patient_save_del_up.php?action=delete&pid=" . $_POST['hidPID'] . "&image=" . $row_detail['Image'] . "');\"/>
						<input type='submit' name='btnUpdate' value='Update'>";
			}else{
				echo "<input type='submit' name='btnSave' value='Save'>";
			}
		echo "</div>";
		?>
		</div><!-- edit_form 2 -->
		</form>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>