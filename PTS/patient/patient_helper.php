<?php
/* -------------------------------------------------------------------------------------- */
function CheckTables($row,$readonly=false){
	include_once(__DIR__ . "/patient_classes.php");
	$ct = new CheckTables($row,'check_table_container','check_table',$readonly);
	$ct->BeginContainer();
	
		echo "<table border=0>
				<tr>
					<th colspan=2>Personal Medical Condition</th>
				</tr>
				<tr>
					<td>";
		#Personal Medical Condition ************************************
					$ct->BeginLR('Venous');
						$ct->CheckPair('Varicose Veins','PMC_Varicose_Veins');
						$ct->CheckPair('VV Surgery','PMC_VV_Surgery');
						$ct->CheckPair('Sclerotherapy','PMC_Sclerotherapy');
						$ct->CheckPair('Thrombophlebitis','PMC_Thrombophlebitis');
						$ct->CheckPair('DVT','PMC_DVT');
						$ct->CheckPair('Leg Fracture','PMC_Leg_Fracture');
						$ct->CheckPair('Leg Infection','PMC_Leg_Infection');
					$ct->EndLR();
		echo		"</td>
					<td>";
					$ct->BeginYN();
						$ct->Check('Pregnancy','PMC_Pregnancy');
						$ct->Check('Bypass Surgery','PMC_Bypass_Surgery');
						$ct->Check('Ischaemic HD','PMC_Ischaemic_HD');
						$ct->Check('Hypertension','PMC_Hypertension');
						$ct->Check('TIA','PMC_TIA');
						$ct->Check('CVA','PMC_CVA');
						$ct->Check('Diabetes','PMC_Diabetes');
						$ct->Check('Rheumatoid Arthritis','PMC_Rheumatoid_Arthritis');
						$ct->Check('Claudication','PMC_Claudication');
					$ct->EndYN();
		echo		"</td></tr>";
		#Personal Medical Condition ************************************
		
		echo "<tr><td>";
		#Leg Venous ****************************************
			$ct->BeginLR('Leg Venous');
				$ct->CheckPair('Eczema','LV_Eczema');
				$ct->CheckPair('Itch','LV_Itch');
				$ct->CheckPair('Pigmentation','LV_Pigmentation');
				$ct->CheckPair('Oedema','LV_Oedema');
				$ct->CheckPair('Ankle flare','LV_Ankle_flare');
				$ct->CheckPair('Induration','LV_Induration');
				$ct->CheckPair('AtrophIe Blanche','LV_AtrophIe_Blanche');
				$ct->CheckPair('Palpable pulse','LV_Palpable_pulse');
				$ct->CheckPair('RPI > 0.8','LV_RPI_08');
			$ct->EndLR();
		#Leg Venous ****************************************
		echo "</td><td>";
		#Leg Arterial ****************************************
				$ct->BeginLR('Leg Arterial');
					$ct->CheckPair('Loss of hair','LA_Loss_of_hair');
					$ct->CheckPair('Atrophic,shiny skin','LA_Atrophic_shiny_skin');
					$ct->CheckPair('Skin,cold/white/blue','LA_Skin_cold_white_blue');
					$ct->CheckPair('Poor capillary filling','LA_Poor_capillary_filling');
					$ct->CheckPair('Night pain relieved when leg is dependent','LA_Night_pain_leg');
					$ct->CheckPair('Calf/Thigh muscle wasting','LA_Calf_Thigh_muscle_wasting');
					$ct->CheckPair('RPI > 0.8','LA_RPI_08');
				$ct->EndLR();
		#Leg Arterial ****************************************
		echo "</td></tr>";
		
		echo "<tr><td>";
		#Perpetuating **************************************************
				$ct->BeginYN();
					$ct->Check('Obese','PER_Obese');
					$ct->Check('Smoker','PER_Smoker');
					$ct->Check('Poor nutrition','PER_Poor_nutrition');
					$ct->Check('Anaemia','PER_Anaemia');
					$ct->Check('Poor mobility','PER_Poor_mobility');
					$ct->Check('Poor ankle movement','PER_Poor_ankle_movement');
					$ct->Check('Psycho/social factors','PER_Psycho_social_factors');
					$ct->Check('Previous leg ulcers','PER_Previous_leg_ulcers');
					$ct->Check('IV drug use','PER_IV_drug_use');
				$ct->EndYN();
		#Perpetuating **************************************************
		echo "</td><td>";
		#Ulcer Venous **********************************************
					$ct->BeginLR('Ulcer Venous');
						$ct->CheckPair('Wound shallow','UV_Wound_shallow');
						$ct->CheckPair('Flat margins','UV_Flat_margins');
						$ct->CheckPair('Sited lateral/medial/malleoius','UV_Sited_lateral_mm');
					$ct->EndLR();
		#Ulcer Venous **********************************************
		#Ulcer Arterial **********************************************
					$ct->BeginLR('Ulcer Arterial');
						$ct->CheckPair('Wound deep','UA_Wound_deep');
						$ct->CheckPair('Punched out irregular shape','UA_Punched_irregular_shape');
						$ct->CheckPair('Sited foot/lateral aspect of leg','UA_Sited_foot_lateral_leg');
					$ct->EndLR();
		#Ulcer Arterial **********************************************
		echo "</td></tr></table>";
	$ct->EndContainer();
}
/* -------------------------------------------------------------------------------------- */
function GetPatientMedicalCondition($pid){
	$sql = "SELECT * FROM medical_condition WHERE PID='$pid'";
	$row = mysql_fetch_array(ExecuteSQL($sql));
	//redirect if invalid id
	/*if(count($row)<2){
		mysql_close($con);
		header("Location: patient_home.php?err=invalid id : " . $pid);
		exit;
	}*/
	
	return $row;
}
/* -------------------------------------------------------------------------------------- */
function GetPatientDetails($pid,$con){
	$sql = "SELECT * FROM patient WHERE ID='$pid'";
	$row = mysql_fetch_array(ExecuteSQL($sql));
	//redirect if invalid id
	if(count($row)<2){
		mysql_close($con);
		header("Location: patient_home.php?err=invalid id : " . $pid);
		exit;
	}
	
	return $row;
}
/* -------------------------------------------------------------------------------------- */
function PatientList($styleid,$pname){
try{
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	if($pname!='')
		$pname = " WHERE Name LIKE '$pname%'";
	$sql = "SELECT * FROM patient $pname ORDER BY Date DESC LIMIT 0 , 500";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	echo "<form id='form1' name='form1' method='post' action='add_edit_item.php'>";
	TabelHeader($styleid,array('#','Patient ID','Name','Age',
									'Gender','Contact 1','Contact 2','Registered Date','View'));
	while($row = mysql_fetch_array($result)){
		ZeebraStripes($b,$n,'alt');
		
		$d = new DateTime($row["Date"]);
		$date = $d->format('Y-m-d \a\t H:i');
		
		echo "<td>" . 
			$row['ID'] . "</td><td>" . 
			$row["Name"] . "</td><td>" . 
			$row["Age"] . "</td><td>" . 
			$row["Gender"] . "</td><td>" . 
			$row["Contact1"] . "</td><td>" . 
			$row["Contact2"] . "</td><td>" . 
			$date . "</td>";
		echo "<td align='center'><a href='patient_details.php?pid=" . $row['ID'] . "'>View</a></td></tr>";
	}
	mysql_close($con);
	echo "</table></form>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}  
/* -------------------------------------------------------------------------------------- */
function PutNewAppointmentForm($pid){
	echo 	"<div id='new_appointment'>
			<form action='../calender/calender_new_app.php?pid=$pid' method='post'>
				<input type='submit' value='Make New Appointment' name='btnNewAppointment'>
			</form>
			</div>";
}
/* -------------------------------------------------------------------------------------- */
function GetAppointments($pid){
	include_once(__DIR__ . '/../lib/helper.php');
	$sql = "SELECT * FROM patient_appointment WHERE PID='$pid' ORDER BY OpenDate";
	$result = ExecuteSQL($sql);
	$has_open = false;
	$n = 1;
	$canvas_id = 1;
	
	while($row = mysql_fetch_array($result)){
		echo 		"<div id='round_div'>";
				
				if($row['Status']=="close"){
		echo		"<p id='pannel_title' >$n. Appointment : " . FormatDateTime($row['OpenDate']) . "</p>";
					$n++;
					BeginColumnContainer(900);
						BeginColumn(260);
							DisplayFild('Assessment',$row['Intervention'],100,true);
							DisplayFild('Intervention',$row['Assessment'],100,true);
							UsedMedicines($row['AppointmentID']);
						EndColumn();
						BeginColumn(210);
							LoadWoundImage($row['Image'],$canvas_id,$pid,'appointment',$row['AppointmentID'],$row['ImageDescription']);
							$canvas_id++;
						EndColumn();
					EndColumnContainer();
				}else if($row['Status']=="open"){
					$has_open = true;
					$AppointmentID = $row['AppointmentID'];
					echo	"<p id='pannel_title' >Next Appointment on : " . FormatDateTime($row['OpenDate']) . "</p>
							<div id='edit_form'>
							<form id='frmAppClose' name='frmAppClose' 
									action='../calender/appointment_save.php?pid=$pid' 
									onSubmit='return ValidateAppClose();' 
									method='post' enctype='multipart/form-data'>
							<input type='hidden' value='$AppointmentID' name='txtAppointmentID'/>
							<table border=0>";
								FormCommentField('Assessment','20','4','txtIntervention','txtIntervention');
								FormCommentField('Intervention','20','4','txtAssessment','txtAssessment');
					echo 		"<tr><td>Wound image</td><td><input type='file' name='file' id='file'></td></tr>";
								FormCommentField('Comment','20','4','txtImageDescription','','none');
								 MedicineSection();
					echo		"<tr><td colspan=2 align='right'>
									<input id='DeleteButton' type='button' name='btnDelete' value='Delete'
											onclick=\"DelectionConfirm(
											'Do you really want to delete this appointment',
											'../calender/appointment_delete.php?aid=$AppointmentID&pid=$pid');\"/>
									<input type='submit' name='btnSaveAppointment' value='Save'>
								</td></tr>
							</table>
							</form>
							</div>";
				}	
		echo "</div>";
	}
	
	echo "<input id='num_of_images' type='hidden' value='$canvas_id'/>";
	
	return $has_open;
}
/* -------------------------------------------------------------------------------------- */
function UsedMedicines($AppointmentID){
	echo "Used Medicines <div id='table_display_field'>";
	
	$b = false;
	$n = 1;
	$sql = "SELECT stock.ProductID,stock.Name,stock_history.Quantity 
			FROM stock INNER JOIN stock_history 
			ON stock.ProductID=stock_history.ProductID WHERE stock_history.AppointmentID='$AppointmentID'";
	$result = ExecuteSQL($sql);
	
	if(mysql_num_rows($result)>0){
		TabelHeader('medicines_table',array('Product ID','Name','Quantity'));

		while($row = mysql_fetch_array($result)){
			ZeebraStripes($b,$n,'alt',false);
			
			echo	"<td>" . $row['ProductID'] . "</td>
					<td>" . $row['Name'] . "</td>
					<td>" . $row['Quantity'] . "</td>
				</tr>";
		}
				
		echo "</table>";
	}else
	{//no used medicines
		echo "Didn't use any special medicine";
	}
	
	echo "</div>";
}
/* -------------------------------------------------------------------------------------- */
function MedicineSection(){
	echo 	"<tr><td colspan=2><hr></td></tr>
			<tr><td colspan=2>
				<div id='medicine_container'>";
				$sql = "SELECT * FROM stock";
				$result = ExecuteSQL($sql);
				
				while($row = mysql_fetch_array($result)){
				echo 	"<div id='medicine_item'>
							<img src='../stock/image/" . $row['Image'] . "'/>
							<div id='div_description'>
								<p id='medicine_item_id'>" . $row['ProductID'] . "</p>
								<p id='medicine_item_name'>" . $row['Name'] . "</p>
							</div>
							<div  id='div_quantity'>
								<p id='medicine_item_unit'>Quantity[" . $row['Quantity'] . "]</p>
								<input id='quantity_checkbox' type='checkbox' name='chk" . $row['ProductID'] . "' onclick='SelectMedicine(this);'/>
								<input type='hidden' value='" . $row['Quantity'] . "' id='hid" . $row['ProductID'] . "'/>
								<input id='quantity_textbox' onchange='QuantityChanged(this);'
								name='txt" . $row['ProductID'] . "' type='text'/>
								<p id='medicine_item_unit'>" . $row['Unit_Of_Measure'] . "</p>
							</div>
						</div>";
				}
				
	echo		"</div>
			</td></tr>";			
}
/* -------------------------------------------------------------------------------------- */
function GenPatientID(){
	$part1 = 'P' . Date('y') . Date('m') .  Date('d') .  '-';
	$con = OpenConnection();
	$result = mysql_query("SELECT ID FROM patient WHERE ID LIKE '$part1%'");
	$n = mysql_num_rows($result);
	$pid = $part1;
	
	if($n==0)
		//this is the first patient today
		$pid = $pid . '001';
	else
		$pid = $pid . str_pad(++$n, 3, '0', STR_PAD_LEFT);
	
	//check for uniqueness
	while(true){
		$result = mysql_query("SELECT ID FROM patient WHERE ID ='$pid'");
		if(mysql_num_rows($result)>0){
			$pid = $part1;
			$pid = $pid . str_pad(++$n, 3, '0', STR_PAD_LEFT);
		}else break;
	}
	
	mysql_close($con);
	return $pid;
}
/* ------------------------------------------------------------------------------------------------------------------- */
function LoadWoundImage($file,$canvas_id,$pid,$type,$aid='',$mage_description=''){
echo	"<div id='wound_image'>	
			<img class='wound_image' id='img" . $canvas_id . "' src='./wound/$file'/>
			<img class='delay_image' id='ani" . $canvas_id . "' src='../img/delay.gif'/>
			<canvas id='can" . $canvas_id . "' width='0' height='0'></canvas>";
			DisplayFild('',"$mage_description",20,false,569);
						
echo		"<form action='change_wound_image.php' method='post' onSubmit='return IsImageSelected(this);'>
					<input id='chk" . $canvas_id . "'  type='checkbox' onclick='ShowHideGrid(this);'/>
					Show Grid [Cell Size 30X30 Pixels]
					<input type='hidden' name='hidOldFile' value='$file'/>
					<input type='hidden' name='hidPid' value='$pid'/>
					<input type='hidden' name='hidaid' value='$aid'/>
					<input type='hidden' name='hidOldDis' value='$mage_description'/>
					<input type='hidden' name='hidtype' value='$type'/>
					<input type='submit' value='Change'/>";
echo		"</form>
		</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function EditPatient($pid){
echo	"<div id='edit_patient'>	
			<form action='patient_edit_register.php' method='post'>
				<input type='hidden' name='hidPID' value='$pid'/>
				<input type='submit' name='btnEdit' value='Edit patient details'/>
			</form>
		</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
?>