<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
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
		<p id='pannel_title' >Control Pannel</p>
		<?php
		BeginCentCon(450);
			PutControlPanelItem('Medicine','medicine.png','stock.php','');
			PutControlPanelItem('Category','category.png','category_home.php','');
		EndCentCon();
		?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>