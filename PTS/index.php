<?php 
	session_start();
	if(isset($_POST['btnLogin'])){
		include_once(__DIR__ . '/lib/helper.php');
		$ret = LogIn($_POST['txtUserName'],$_POST['txtPassword']);
		if($ret==true){
			$_SESSION['user_name'] =  $_POST['txtUserName'];
			header('Location: ./home.php');
			exit;
		}
	}
	
	include_once(__DIR__ . '/lib/feeder.php');
	$_SESSION['pre_fix'] = "./";
	Head_Section("Patient Tracking System");
?>
<body>

<script type="text/javascript">	

</script>

<div id='wrapper'>

	<?php 
		PageHeading("Patient Tracking System"); 
	?>
	<div id='round_div'>
		<p id='pannel_title' >System is locked</p>
		<?php BeginCentCon(400);?>
		<div id='login_pannel'>
		<form method='post' action='index.php'>
			<table border=0>
			<tr>
				<td>User name</td>
				<td>
					<input type='text' name='txtUserName'/>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type='password' name='txtPassword'/>
				</td>
			</tr>
			<tr>
				<td colspan=2 align='right'>
					<input type='submit' name='btnLogin' value='Login'/>
				</td>
			</tr>
			</table>
		</form>
		</div>
		<?php EndCentCon();?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>