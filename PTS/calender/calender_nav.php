<?php 
	session_start();
	
	$date = $_GET['year_month'] . '-01';
	
	if($_GET['direct']=='forward')
		$date = strtotime("+1 months", strtotime($date));
	else if($_GET['direct']=='back')
		$date = strtotime("-1 months", strtotime($date));
	else if($_GET['direct']=='today'){
		date_default_timezone_set('Asia/Colombo');
		header("Location: day_detail.php?date=" .  date('Y-m-d'));
		exit;
	}

	if($_GET['cal_type']=='normal'){
		$_SESSION['cal_set'] = 'set';
		$_SESSION['normal_cal_year'] = date('Y', $date);
		$_SESSION['normal_cal_month'] = date('m', $date);
		header("Location: calender.php");
	}else{
		$_SESSION['cal_set'] = 'set';
		$_SESSION['appointment_cal_year'] = date('Y', $date);
		$_SESSION['appointment_cal_month'] = date('m', $date);
		header("Location: calender_new_app.php?pid=" . $_GET['pid']);
	}
?>