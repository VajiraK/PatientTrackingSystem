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
	ValidateFormEx();
?>
	function OnChange(drop){
		var i  = drop.selectedIndex
		var cat = drop.options[i].value
		var xmlhttp = new XMLHttpRequest();
	
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				var div = document.getElementById("subcatdrop_div");
				div.innerHTML = xmlhttp.responseText;
			}
		}
		
		xmlhttp.open("GET","get_sub_category.php?cat=" + cat,true);
		xmlhttp.send();
		return true;
	}
</script>
			
<div id='wrapper'>

<?php
	PageHeading("Patient Tracking System");
	NavigationBar("control_panel");
	BackButton("< Medicine","stock.php");
	$row = 0;
	
	if(isset($_POST['btnAdd'])){
		echo "<div id='round_div'><p id='pannel_title'>Add New Item</p>";
	}else{
		echo "<div id='round_div'><p id='pannel_title'>Edit item : " . $_GET['ProductID'] . "</p>";
		$row = GetStockItem($_GET['ProductID']);
	}
?>
		<div id='edit_form'>
			<form id='frmAddItem' name='frmAddItem' method='post' enctype="multipart/form-data"
					action='save_update_item.php' OnSubmit='return ValidateForm("frmAddItem");'>
				<table border=0>
					<?php
						echo "<input type='hidden' name='hidden_ProductID' value='" . $row['ProductID'] . "'/>";
						if(isset($_POST['btnAdd']))
							FormField('Product ID','text','txtProductID',$row['ProductID']);
						else{
						echo 	"<tr>
								<td>Product ID</td>
								<td>
									<input id='readonly_field' type='text' name='txtProductID' 
										value='" . $row['ProductID'] ."' readonly/>
								</td>
								</tr>";
						}
						FormField('Name','text','txtName',$row['Name']);
					?>
					<tr>
						<td>Category</td>
						<td>
							<?php CategoryDrop($row['Category'],"onchange='OnChange(this);'");?>
						</td>
					</tr>
					<tr>
						<td>Sub Category</td>
						<td>
						<?php 
						if(isset($_POST['btnAdd'])){
							echo "<div id='subcatdrop_div'>Select a category...</div>";
						}else{
							echo "<div id='subcatdrop_div'>";
								SubCategoryDrop($row['Category'],$row['SubCategory']);
							echo "</div>";
						}
						?>
						</td>
					</tr>
					<?php
						FormField('Quantity','text','txtQuantity',$row['Quantity']);
						echo "<div id='frmAddItem_txtQuantity_errorloc' class='error_strings'></div>";
						FormField('Price','text','txtPrice',$row['Price']);
						FormField('Unit Of Measure','text','txtUnitOfMeasure',$row['Unit_Of_Measure']);
					?>
					<tr>
						<td>Image</td><td><input type='file' name='file' id='file'></td>
					</tr>
					<tr>
					<?php
						if(isset($_POST['btnAdd'])){
							echo "<td align='right' colspan=2>
									<input type='submit' name='btnSave' value='Save'/>
								</td>";
						}else{
							echo "<td align='right' colspan=2>
							
									<input id='DeleteButton' type='button' name='btnDelete' value='Delete'
										onclick=\"DelectionConfirm(
										'Do you really want to delete this item',
										'save_update_item.php?action=delete&ProductID=" . $row['ProductID'] . "');\"/>
									
									<input type='submit' name='btnUpdate' value='Update'/>
								</td>";
						}
					?>
					</tr>
				</table>	
			</form>			
		</div>
	</div><!--round_div -->
	
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>