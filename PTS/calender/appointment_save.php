<?php
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = "../";
	Authenticate();
	include_once(__DIR__ . '/../lib/mysql.php');
		
	if(isset($_POST['btnNewAppointment'])){
		include_once(__DIR__ . '/../lib/helper.php');
		$date = GetDateFormSring($_GET['date']);
		$sql = "INSERT INTO patient_appointment (PID,OpenDate,Status)VALUES('" .
				$_GET['pid'] . "','" .
				$date . "','" .
				"open" . "')";
		Insert($sql);
	}else if($_POST['btnSaveAppointment']){
	
		include_once(__DIR__ . '/../lib/mysql.php');
		$con = OpenConnection();
		
		//stock adjustment ********************
		$sql = "SELECT ProductID,Quantity FROM stock";
		$result = ExecuteSQL($sql);
		$sql ='';
		$sql_his ='';
	
		while($row = mysql_fetch_array($result)){
			$balance = 0;
			$id = $row['ProductID'];
			if(isset($_POST['chk'. $id])){
				$q =  floatval($_POST['txt'. $id]);
				
				if($q<1){//invalid Quantity
					mysql_close($con);
					header("Location: ../patient/Insufficient_stock.php?pid=" . $_GET['pid'] . "&err=Invalid quantity");
					exit;
				}
								
				$balance = floatval($row['Quantity']) - $q;
				
				if($balance>=0){
					//stock ok
					$sql = $sql . "UPDATE stock SET Quantity=$balance WHERE ProductID='$id';";
					$sql_his = $sql_his . "INSERT INTO stock_history (ProductID,AppointmentID,Quantity) VALUES ('" .
								"$id','" .
								$_POST['txtAppointmentID'] . "','
								$q');";
				}else{
					//out of stock
					mysql_close($con);
					header("Location: ../patient/Insufficient_stock.php?pid=" . $_GET['pid'] . "&err=Insufficient stock :(");
					exit;
				}
			}
		}
		//echo $sql_his;
		//exit;
		ExecuteMultipleSQL($sql_his);
		ExecuteMultipleSQL($sql);

		//stock adjustment ********************
		include_once(__DIR__ . '/../lib/helper.php');
		$AppointmentID = $_POST['txtAppointmentID'];
		$file = UploadImage("no_image.png","../patient/wound/",$_GET['pid'] . '_' . $AppointmentID);
		
		$ana = $_POST['txtIntervention'];
		$cnt = $_POST['txtAssessment'];
		$imgdis = $_POST['txtImageDescription'];
		
		$sql = "UPDATE patient_appointment SET 
					Intervention='$ana',
					Assessment='$cnt',
					Image='$file',
					ImageDescription='$imgdis',
					Status='close' WHERE AppointmentID=$AppointmentID";
		ExecuteSQL($sql);
		mysql_close($con);
	}

	header("Location: ../patient/patient_details.php?pid=" . $_GET['pid']);
?>











