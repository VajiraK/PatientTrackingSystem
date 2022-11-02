<?php
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	Authenticate();
	include_once(__DIR__ . '/stock_helper.php');
	Head_Section("Patient Tracking System");
?>
<body>

<script type="text/javascript">
<?php
	include_once(__DIR__ . '/../lib/js_feeder.php');
	JQ_DocReady_Start();
		NavigationBarJS();
	JQ_DocReady_End();
	DelectionConfirm();
	ValidateFormById();
?>
</script>

<div id='wrapper'>
	<?php 
		PageHeading("Patient Tracking System");
		NavigationBar("control_panel");
	?>
	<div id='round_div'>
	<p id='pannel_title' >Edit Categories</p>
	<?php
		BeginColumnContainer(800);
			BeginColumn(350);
				PutCategories('stock');
			EndColumn();
			BeginColumn(350);
				PutSubCategories('stock');
			EndColumn();
		EndColumnContainer();
	?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>