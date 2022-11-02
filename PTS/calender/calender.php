<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	include_once(__DIR__ . '/calender_helper.php');
	
	
	
	if(!isset($_SESSION['cal_set'])){
		date_default_timezone_set('Asia/Colombo');
		$year = date('Y');
		$month = date('m');
	}else{
		$year = $_SESSION['normal_cal_year'];
		$month = $_SESSION['normal_cal_month'];
	}
	
	unset($_SESSION['cal_set']);
	
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
		<?php
			include_once(__DIR__ . '/../lib/helper.php');
			$year_month = $year . '-' . $month;
			CalenderHead('Calender ' . $year_month,$year_month,'normal');
			DrawCalender($year,$month,'normal');
		?>
		</div>
		<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>