<?php
/* ------------------------------------------------------------------------------------------------------------------- */
function CalenderHead($title,$year_month,$cal_type,$pid=''){
	if($cal_type=='normal')
		$get = "&year_month=$year_month&cal_type=$cal_type";
	else
		$get = "&year_month=$year_month&cal_type=$cal_type&pid=$pid";
	
	echo "<div id='calender_nav' >
			<div id='left' ><a href='calender_nav.php?direct=back$get'>< Back</a></div>
			$title
			<div id='right' ><a href='calender_nav.php?direct=forward$get'>Forward ></a></div>
		</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function GetNumOfDays($year,$month){
	return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawCalenderDay($d,$today,$month_year,$n_open_ap,$n_close_ap,$cal_type,$pid){
	$d = str_pad($d, 2, '0', STR_PAD_LEFT);
	
	if($cal_type=='normal')
		$target = "day_detail.php?date=$month_year$d";
	else
		$target = "day_detail_new_app.php?date=$month_year$d&pid=$pid";
		$is_today = $today==$month_year . $d;

	echo "<a href='$target'>";
		if($cal_type=='normal'){
			if($is_today)
				echo "<div id='calender_day_today'><p id='common_calender_day_para'>$d</p>";
			else
				echo "<div id='calender_day'><p id='common_calender_day_para'>$d</p>";
		}else
			if($is_today)
				echo "<div id='appointment_calender_day_today'><p id='common_calender_day_para'>$d</p>";
			else
				echo "<div id='appointment_calender_day'><p id='common_calender_day_para'>$d</p>";
				
			if($n_open_ap>0)
				echo "<div id='calender_open_ap'>$n_open_ap Open</div>";
			if($n_close_ap)
				echo "<div id='calender_close_ap'>$n_close_ap Closed</div>";
	echo	"</div>
		</a>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function AbstractPatientDetails($pid){
	$title = "Make new appointment for ID : $pid";
	echo 	"<div id='round_div'>
				<p id='pannel_title'>$title</p>
			</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawAppointment($pid,$aid,$date,$OpenDate,$status){

	$sql = "SELECT Name,Contact1,Contact2 FROM patient WHERE ID='$pid'";
	$row = mysql_fetch_array(ExecuteSQL($sql));

	if($status=='Open')
		$style = 'day_open_appointment';
	else
		$style = 'day_close_appointment';
	
	echo	"<div id='day_appointment_time'>" . substr($OpenDate,11,5) . "</div>
				<div id='$style'>
					<a href='../patient/patient_details.php?pid=" . $pid . "'>ID : " .
						$pid. " , Name : " .
						$row['Name'] . " , ( Contact 1 : " .
						$row['Contact1'] .  " , Contact 2 : " .
						$row['Contact2'] .
					" )</a>
					<a href='#'" . " onclick=\"DelectionConfirm(
						'Do you really want to delete this appointment',
						'appointment_delete.php?aid=$aid&date=$date'
					);\">" .
						"<div id='day_appointment_delete'>
							<img src='../img/delete.png'/>
						</div>
					</a>
				</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PutAppointments($start,$end,$date,$h,$status){
	$sql = "SELECT 	AppointmentID,PID,OpenDate FROM patient_appointment 
						WHERE OpenDate BETWEEN '$start' AND '$end' AND Status='$status' ORDER BY OpenDate";
	$result = ExecuteSQL($sql);
	$n = mysql_num_rows($result);
	
	if($n>0){
		//there are appointments in this hour 
		while($row = mysql_fetch_array($result)){
			DrawAppointment(
							$row['PID'],
							$row['AppointmentID'],
							$date,
							$row['OpenDate'],
							$status
							);
		}
	}
	
	return $n;
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawHour($date,$h,$cal_type,$pid){
	$start = $date . " $h:00:00";
	$end = $date . " $h:59:59";
	
	echo "<div id='calender_hour'><p>$h:00</p>";//calender_hour div
	
	$n_open = PutAppointments($start,$end,$date,$h,'Open');
	$n_close = PutAppointments($start,$end,$date,$h,'Close') + $n_open;
	
	//put bottom padding
	if($n_close>0)
		echo "<div id='hour_bottom_padding'></div>";
	
	//new appointment
	if(($n_open<10)&&($cal_type=='appointment')){
		$n_open = 6 * $n_open;//increment minutes
		$date = $date . " $h:$n_open:00";
		echo 	"<form action='appointment_save.php?date=$date&pid=$pid' method='post'>
					<input id ='day_new_appointment' type='submit' value='Make new appointment for : $pid' name='btnNewAppointment'>
				</form>";
	}

	echo "</div>";//calender_hour div
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DayDetails($date,$cal_type,$pid){
	for($i=5;$i<=23;$i++){
		$h = str_pad($i, 2, '0', STR_PAD_LEFT); 
		DrawHour($date,$h,$cal_type,$pid);
	}
	
	for($i=0;$i<=4;$i++){
		$h = str_pad($i, 2, '0', STR_PAD_LEFT); 
		DrawHour($date,$h,$cal_type,$pid);
	}
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawCalender($year,$month,$cal_type,$pid=''){
	include_once(__DIR__ . '/../lib/mysql.php');
	BeginCentCon(890);
		$days = GetNumOfDays($year,$month);
		$con = OpenConnection();
		$year_month = $year . '-' . $month . '-';
		//today
		date_default_timezone_set('Asia/Colombo');
		$today = date('Y-m-d');
		
		for($i=1;$i<=$days;$i++){
			$start = $year_month . $i . ' 00:00:00';
			$end = $year_month . $i . ' 23:59:59';
			
			$sql = "SELECT AppointmentID FROM patient_appointment 
						WHERE OpenDate BETWEEN '$start' AND '$end' AND Status='open'";
			$result = ExecuteSQL($sql);
			$n_open_ap = mysql_num_rows($result);
			
			$sql = "SELECT AppointmentID FROM patient_appointment 
						WHERE OpenDate BETWEEN '$start' AND '$end' AND Status='close'";
			$result = ExecuteSQL($sql);
			$n_close_ap = mysql_num_rows($result);
			
			DrawCalenderDay($i,$today,$year_month, $n_open_ap,$n_close_ap,$cal_type,$pid);
		}
		mysql_close($con);
	EndCentCon();
}
?>