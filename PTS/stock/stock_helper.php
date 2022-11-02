<?php
function PutCategories($styleid){
try{
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM category";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	TabelHeader($styleid,array('#','Category','Delete'),'Categories');

	while($row = mysql_fetch_array($result)){
		ZeebraStripes($b,$n,'alt');
		
		echo 	"<td>" . $row['Category'] . "</td> 
				<td align='center'>
					<a href='#' 
						onclick=\"DelectionConfirm(
							'Do you really want to delete this category, this will delete it\'s sub categories also',
							'modify_category.php?action=delcat&cat=" . $row['Category'] . "'
						);\"/>
						<img id='delete_image' src='../img/delete.png'/>
					</a>
				</td></tr>";
	}
	mysql_close($con);
	echo "<tr><td align='right' colspan=3>
		<form id='frmCat' name='frmCat' method='post' OnSubmit='return ValidateFormById(\"frmCat\");' action='modify_category.php?action=addcat'>
			<input type='text' name='txtCat'/>
			<input type='submit' name='btnAdd' value='Add'/>
		</form>
		</td></tr></table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function PutSubCategories($styleid){
try{
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM subcategory";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	TabelHeader($styleid,array('#','Category','subcategory','Delete'),'Sub Categories');

	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		
		echo "<td>" . $row['Category'] . "</td><td>" . $row['SubCategory'] . "</td> 
		<td align='center'>
			<a href='#'
				onclick=\"DelectionConfirm(
							'Do you really want to delete this sub category',
							'modify_category.php?action=delsubcat&cat=" . $row['Category'] . "&sub=" . $row['SubCategory'] .
						"');\">
				<img id='delete_image' src='../img/delete.png'/>
			</a>
		</td></tr>";
	}
	mysql_close($con);
	echo "<tr><td colspan=4>
		<form id='frmSubCat' name='frmCat' method='post' 
			OnSubmit='return ValidateFormById(\"frmSubCat\");' 
			action='modify_category.php?action=addsubcat'>
			<div id='subcatdiv'>";
				CategoryDrop('');
	echo		"<input type='text' name='txtSubCat'/>
				<input type='submit' name='btnAdd' value='Add'/>
			</div>
		</form>
		</td></tr></table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function SubCategoryDrop($category,$select=''){
	$response = "<select name='dropSubCat'>";
	
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT subcategory FROM subcategory WHERE Category='$category'";
	$result = ExecuteSQL($sql);
	
	if(mysql_num_rows($result)>0){
		while($row = mysql_fetch_array($result)){
			if($select==$row['subcategory'])
				$response = $response . "<option selected value='" . $row['subcategory'] . "'>" . $row['subcategory'] . "</option>";
			else
				$response = $response . "<option value='" . $row['subcategory'] . "'>" . $row['subcategory'] . "</option>";
		}
		echo $response . "</select>";
	}else{
		echo "No sub category for this category";
	}
	
	mysql_close($con);
}
/* -------------------------------------------------------------------------------------- */
function CategoryDrop($select,$OnChangeHandler=''){
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM category";
	$result = ExecuteSQL($sql);
	
	if(mysql_num_rows($result)>0){
		echo "<select name='drpCat' $OnChangeHandler>";
			echo "<option value=''></option>";//first blank one
		while($row = mysql_fetch_array($result)){
			if($select==$row['Category'])
				echo "<option selected value='" . $row['Category'] . "'>" . $row['Category'] . "</option>";
			else
				echo "<option value='" . $row['Category'] . "'>" . $row['Category'] . "</option>";
		}
			
		echo "</select>";
	}

	mysql_close($con);

}
/* -------------------------------------------------------------------------------------- */
function DisplayStock($styleid){
try{
	include_once(__DIR__ . '/../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM stock";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	echo "<form id='form1' name='form1' method='post' action='add_edit_item.php'>";
	TabelHeader($styleid,array('#','roduct ID','Name','Category','Sub Category',
										'Price','Quantity','Unit Of Measure','Edit'));
	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		
		echo "<td>" . 
			$row['ProductID'] . "</td><td>" . 
			$row["Name"] . "</td><td>" . 
			$row["Category"] . "</td><td>" . 
			$row["SubCategory"] . "</td><td>" . 
			$row["Price"] . "</td><td>" . 
			$row["Quantity"] . "</td><td>" . 
			$row["Unit_Of_Measure"] . "</td>";
		echo "<td align='center'><a href='add_edit_item.php?ProductID=" . $row['ProductID'] . "'>Edit</a></td></tr>";
	}
	mysql_close($con);
	echo "<tr><td align='right' colspan=9><input type='submit' name='btnAdd' value='Add'/></td></tr></table></form>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}  
/* -------------------------------------------------------------------------------------- */
function GetStockItem($code){
try{
	include_once(__DIR__ . '/../lib/mysql.php');
	$sql = "SELECT * FROM stock WHERE ProductID='$code'";
	return GetOneRowEx($sql);
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
?>