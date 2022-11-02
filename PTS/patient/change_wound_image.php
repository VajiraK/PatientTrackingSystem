<?php
	if(isset($_POST['btnChange'])){
		include_once(__DIR__ . '/../lib/mysql.php');
		include_once(__DIR__ . '/../lib/helper.php');

		$has_file = ($_FILES["file"]["name"]!="")//check weather a new image has selected
					||isset($_POST['chkDeleteImage']);
		if($has_file){
			//delete existing file
			if($_POST['hidOldFile']!="no_image.png")
				unlink("../patient/wound/" . $_POST['hidOldFile']);
		}
		
		if($_POST['hidtype']=='patient'){
			if($has_file){
				$newfile = UploadImage("no_image.png","../patient/wound/",$_POST['hidPid']);
				$sql = "UPDATE patient SET Image='$newfile',ImageDescription='" . $_POST['txtImageDescription'] . 
							"' WHERE ID='" . $_POST['hidPid'] . "'";
			}else{
				$sql = "UPDATE patient SET ImageDescription='" . $_POST['txtImageDescription'] . 
							"' WHERE ID='" . $_POST['hidPid'] . "'";
			}
		}else{
			if($has_file){
				$newfile = UploadImage("no_image.png","../patient/wound/",$_POST['hidPid'] . '_' . $_POST['hidaid']);
				$sql = "UPDATE patient_appointment SET Image='$newfile',ImageDescription='" . $_POST['txtImageDescription'] . 
							"' WHERE AppointmentID='" . $_POST['hidaid'] . "'";
			}else{
				$sql = "UPDATE patient_appointment SET ImageDescription='" . $_POST['txtImageDescription'] . 
							"' WHERE AppointmentID='" . $_POST['hidaid'] . "'";
			}
		}
		
		Update($sql);
		header("Location: patient_details.php?pid=" . $_POST['hidPid']);
		exit;
	}
?>

<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
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
	BackButton("< " . $_POST['hidPid'],"patient_details.php?pid=" . $_POST['hidPid']);
	
	if($_POST['hidtype']=='patient'){
		echo "<div id='round_div'><p id='pannel_title'>Change wound image of : " . $_POST['hidPid'] . "</p>";
	}else{
		echo "<div id='round_div'><p id='pannel_title'>Change wound image of : " . $_POST['hidPid'] . "</p>";
	}
?>
		<div id='edit_form'>
			<form id='frmAddItem' name='frmAddItem' method='post' enctype="multipart/form-data"
					action='change_wound_image.php'>
				<table border=0>
					<tr><td>Wound image</td><td><input type='file' name='file' id='file'></td></tr>
					<tr><td></td><td><input type='checkbox' name='chkDeleteImage'> Delete existing image</td></tr>
					<?php FormCommentField('Comment','20','4','txtImageDescription','',$_POST['hidOldDis']);?>
					<tr><td align='right' colspan=2>
						<?php
						echo	"<input type='hidden' name='hidOldFile' value='" . $_POST['hidOldFile'] . "'/>
								<input type='hidden' name='hidPid' value='" . $_POST['hidPid'] . "'/>
								<input type='hidden' name='hidaid' value='" . $_POST['hidaid'] . "'/>
								<input type='hidden' name='hidtype' value='" . $_POST['hidtype'] . "'/>";
						?>
						<input type='submit' name='btnChange' value='Change'/>
					</td></tr>
				</table>	
			</form>			
		</div>
	</div><!--round_div -->
	
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>