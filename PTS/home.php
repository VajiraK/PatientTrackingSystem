<?php 
	session_start();
	$_SESSION['pre_fix'] = "./";
	include_once(__DIR__ . '/lib/feeder.php');
	Authenticate();
	Head_Section("Patient Tracking System");
?>

<body>

<script type="text/javascript">	
<?php
	include_once(__DIR__ . '/lib/js_feeder.php');
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
		<p id='pannel_title' >Control Pannel</p>
		<?php
		BeginCentCon(450);
			PutControlPanelItem('Calender','calender.png','./calender/calender.php','');
			PutControlPanelItem('Today\'s Agenda','agenda1.jpg','./calender/calender_nav.php?direct=today','');
		EndCentCon();
		BeginCentCon(450);
			PutControlPanelItem('Patient','patient.png','./patient/patient_home.php','');
			PutControlPanelItem('Stock','stock.png','./stock/stock_home.php','');
		EndCentCon();
		?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>