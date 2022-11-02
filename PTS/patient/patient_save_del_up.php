<?php 
	include_once(__DIR__ . '/../lib/mysql.php');
	include_once(__DIR__ . '/../lib/helper.php');
	include_once(__DIR__ . '/patient_helper.php');
	
	if(isset($_POST['btnSave'])){
		$id = GenPatientID();
		$file = UploadImage("no_image.png","../patient/wound/",$id);
		date_default_timezone_set('Asia/Colombo');
		$sql = "INSERT INTO patient 
				(ID, Name,Age,Gender,Contact1,Contact2,Address,
				Type,Location,Date,Description,Intervention,Assessment,ImageDescription,Image)VALUES('" . 
				$id . "','" . 
				$_POST['txtName'] . "','" .
				$_POST['txtAge'] . "','" .
				$_POST['txtGender'] . "','" .
				$_POST['txtContact1'] . "','" .
				$_POST['txtContact2'] . "','" .
				$_POST['txtAddress'] . "','" .
				$_POST['txtType'] . "','" .
				$_POST['txtLocation'] . "','" .
				Date('Y-m-d G:i:s') . "','" .
				$_POST['txtDescription'] . "','" .
				$_POST['txtIntervention'] . "','" .
				$_POST['txtAssessment'] . "','" .
				$_POST['txtImageDescription'] . "','" .
				$file . "')";
		$con = OpenConnection();
		ExecuteSQL($sql);
		//Save checkbox series
		include_once(__DIR__ . "/patient_classes.php");
		$c = new CheckData();
		$c->GetDataFromPost();
		$sql = $c->GetInsertSql($id);
		ExecuteSQL($sql);
		
		mysql_close($con);
		header("Location: ../patient/patient_details.php?pid=$id");
		exit;
	}elseif(isset($_GET['action'])){
		$con = OpenConnection();
		//delete patient
		DeleteImage("./wound/",$_GET['image']);
		$sql = "DELETE FROM patient WHERE ID='" . $_GET['pid'] . "'";
		ExecuteSQL($sql);
		
		//delete medical_condition
		$sql = "DELETE FROM medical_condition WHERE PID='" . $_GET['pid'] . "'";
		ExecuteSQL($sql);
		
		//delete appointments
		$sql = "SELECT Image FROM patient_appointment WHERE PID='" . $_GET['pid'] . "'";
		$result = ExecuteSQL($sql);
		while($row = mysql_fetch_array($result)){
			DeleteImage("./wound/",$row['Image']);
		}
		$sql = "DELETE FROM patient_appointment WHERE PID='" . $_GET['pid'] . "'";
		ExecuteSQL($sql);
		mysql_close($con);
		header("Location: ../patient/patient_home.php");
		exit;
	}elseif(isset($_POST['btnUpdate'])){
		$sql = "UPDATE patient SET 
					Name='" . $_POST['txtName'] . "',
					Age='" . $_POST['txtAge'] . "',
					Gender='" . $_POST['txtGender'] . "',
					Contact1='" . $_POST['txtContact1'] . "',
					Contact2='" . $_POST['txtContact2'] . "',
					Address='" . $_POST['txtAddress'] . "',
					Type='" . $_POST['txtType'] . "',
					Location='" . $_POST['txtLocation'] . "',
					Description='" . $_POST['txtDescription'] . "',
					Intervention='" . $_POST['txtIntervention'] . "',
					ImageDescription='" . $_POST['txtImageDescription'] . "',
					Assessment='" . $_POST['txtAssessment'] . 
					"' WHERE ID='" . $_POST['hidPID'] . "'";
		$con = OpenConnection();
		ExecuteSQL($sql);
		
		//Update checkbox series
		include_once(__DIR__ . "/patient_classes.php");
		$c = new CheckData();
		$c->GetDataFromPost();
		
		$sql = "SELECT PID FROM medical_condition WHERE PID='" . $_POST['hidPID'] . "'";
		if(mysql_num_rows(ExecuteSQL($sql))==1){
			$sql = $c->GetUpdateSql($_POST['hidPID']);
		}else{
			//no record in medical_condition table so insert
			$sql = $c->GetInsertSql($_POST['hidPID']);
		}
		
		ExecuteSQL($sql);
		mysql_close($con);
		header("Location: ../patient/patient_details.php?pid=" . $_POST['hidPID']);
		exit;
	}
	
	