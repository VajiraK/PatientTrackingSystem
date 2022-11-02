<?php 
	include_once(__DIR__ . '/../lib/mysql.php');
	
	if($_GET['action']=='delcat'){
		$sql = "DELETE FROM category WHERE Category='" . $_GET['cat'] . "'";
		Delete($sql);
	}else if($_GET['action']=='delsubcat'){
		$sql = "DELETE FROM subcategory WHERE Category='" . $_GET['cat'] . "' AND SubCategory='"  . $_GET['sub'] . "'";
		Delete($sql);
	}else if($_GET['action']=='addcat'){
		$sql = "INSERT INTO category (category)VALUES('" . $_POST['txtCat'] . "')";
		Insert($sql);
	}else if($_GET['action']=='addsubcat'){
		$sql = "INSERT INTO subcategory (category,SubCategory	)VALUES('" . $_POST['drpCat'] . "','" . $_POST['txtSubCat'] . "')";
		Insert($sql);
	}
	
	header("Location: category_home.php");
?>