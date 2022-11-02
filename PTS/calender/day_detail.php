<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	include_once(__DIR__ . '/calender_helper.php');
	
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
	?>
	</script>

	<div id='wrapper'>
		<?php 
			PageHeading("Patient Tracking System"); 
			NavigationBar("control_panel");
		?>

		<div id='round_div'>
			<p id='pannel_title' >
				Agenda for 
				<?php 
					echo $_GET['date'];
				?>
			</p>
			<?php
			BeginCentCon(890);
				include_once(__DIR__ . '/../lib/mysql.php');
				$con = OpenConnection();
				DayDetails($_GET['date'],'normal','');
				mysql_close($con);
			EndCentCon();
			?>
		</div>
		<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>