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
		<p id='pannel_title' >Patient Control</p>
		<?php
			BeginCentCon(700);
			PutControlPanelItem('All Patients','patient_list.png','patient_list.php','');
			PutControlPanelItem('Registration','register.png','patient_edit_register.php','');
		?>
			<div id='adm_pannel_item'>
				<div id='patient_search_by_id'>
					<form method='post' action='patient_details.php'>
					<table border=0>
						<tr><td align='center'><img src='../img/search.png'></td></tr>
						<tr><td>Type Patient's ID</td></tr>
						<tr><td><input name='txtPatientID' type='text'/></td></tr>
						<tr><td align='right'><input name='btnSearch' type='submit' value='Search'/></td></tr>
						<?php
						if(isset($_GET['err'])){
							echo "<tr><td id='error_text'>";
								echo $_GET['err'];
							echo "</td></tr>";
						}
						?>
					</table>
					</form>
				</div>
			</div>
		<?php
			EndCentCon();		
		?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>