<?php 
	session_start();
	include_once(__DIR__ . '/../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	Authenticate();
	include_once(__DIR__ . '/../lib/mysql.php');
	include_once(__DIR__ . '/../lib/helper.php');
	
	if(isset($_POST['btnSave'])){
		$filename = UploadImage('no_image.png','../stock/image/',$_POST['txtProductID'],50,50);
		$sql = "INSERT INTO stock (ProductID,Name,Category,SubCategory,Price,Quantity,Unit_Of_Measure,Image) VALUES ('" .
						$_POST['txtProductID'] . "','" . 
						$_POST['txtName'] . "','" . 
						$_POST['drpCat'] . "','" . 
						$_POST['dropSubCat'] . "','" . 
						$_POST['txtPrice'] . "','" . 
						$_POST['txtQuantity'] . "','" . 
						$_POST['txtUnitOfMeasure'] . "','$filename')";
		Insert($sql);	
	}else if(isset($_GET['action'])){
		$con = OpenConnection();
		$id = $_GET['ProductID'];
		$result = ExecuteSQL("SELECT image FROM stock WHERE ProductID='$id'");
		$row = mysql_fetch_array($result);
		DeleteImage("./image/",$row['image']);
		ExecuteSQL("DELETE FROM stock WHERE ProductID='$id'");
		mysql_close($con);
	}else if(isset($_POST['btnUpdate'])){
		$sql = "UPDATE stock SET 
					Name='" . $_POST['txtName'] . "',
					Category='" . $_POST['drpCat'] . "',
					SubCategory='" . $_POST['dropSubCat'] . "',
					Price='" . $_POST['txtPrice'] . "',
					Quantity='" . $_POST['txtQuantity'] . "',
					Unit_Of_Measure='" . $_POST['txtUnitOfMeasure'] . 
					"' WHERE ProductID='" . $_POST['hidden_ProductID'] . "'";
		Update($sql);
	}
	
	header("Location: ./stock.php");
?>