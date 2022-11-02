<?php
/* ------------------------------------------------------------------------------------------------------------------- */
function Authenticate(){
	if(!isset($_SESSION['user_name'])){
		header("Location: " . $_SESSION['pre_fix'] . "index.php");
		exit;
	}
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Head_Section($title){
	$prefix = $_SESSION['pre_fix'];
	
	echo "<!DOCTYPE html>";
    echo "<html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'>";
    echo "<head>";
    echo "<title>$title</title>";
	echo "<meta charset=utf-8 />";
	//CSS
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/main.css'>";
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/nav.css'>";
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/calender.css'>";
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/stock.css'>";
    //Script
	echo "<script src='" . $prefix . "js/jquery-1.2.3.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.easing.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.lavalamp.min.js' type='text/javascript'></script>";
	//Favicon
	echo "<link rel='shortcut icon' href='" . $prefix . "img/favicon.ico' type='image/x-icon' />";
	echo "</head>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PageHeading($title){
	echo "<div id='header'>
			<h1>$title</h1>
			<div id='header_time'></div>
			<script type='text/javascript'>
				function DisplayTime(){
					if (!document.all && !document.getElementById)
						return
						
					timeElement = document.getElementById? document.getElementById('header_time'): document.all.tick2
					
					var CurrentDate=new Date()
					var hours=CurrentDate.getHours()
					var minutes=CurrentDate.getMinutes()
					if (minutes<=9) minutes='0'+minutes;
					var currentTime=hours+':'+minutes;
					timeElement.innerHTML=currentTime;
					setTimeout('DisplayTime()',10000);
				}
				
				window.onload=DisplayTime;
			</script>	
	</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ZeebraStripes(&$b,&$n,$styleid,$row_num=true){//pass by ref

	if($row_num){
		if($b)
			echo "<tr class='$styleid'><td>" . $n++ . "</td>";
		else
			echo "<tr><td>" . $n++ . "</td>";
	}else{
		if($b)
			echo "<tr class='$styleid'>";
		else
			echo "<tr>";
	}
		
	$b = !$b;
}
/* ------------------------------------------------------------------------------------------------------------------- */
function TabelHeader($styleid,$headers,$caption=''){
	echo "<table id='$styleid' border=1><tr>";
	
	if($caption!=''){
		echo "<caption>$caption</caption>";
	}
	
	foreach ($headers as $i => $value) 
		echo "<th>$value</th>";
	echo "</tr>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function NavigationBar($active){
	$prefix = $_SESSION['pre_fix'];
	$control_panel='';$agenda='';$calender='';$patients='';$stock='';$signout='';
	$act = "class='current'";
	
	switch($active){
		case 'control_panel':$control_panel=$act;break;
		case "agenda":$agenda=$act;break;
		case 'calender':$calender=$act;break;
		case 'patients':$patients=$act;break;
		case 'stock':$stock=$act;break;
		case 'sign out':$signout=$act;break;
	}
	
	echo 	"<div class='lavaLampNoImage' id='2'>
			 <ul>
				 <li $control_panel><a href='" . $prefix . "home.php'>Control Panel</a></li>
				 <li $agenda><a href='" . $prefix . "calender/calender_nav.php?direct=today'>Today's Agenda</a></li>
				 <li $calender><a href='" . $prefix . "calender/calender.php'>Calender</a></li>
				 <li $patients><a href='" . $prefix . "patient/patient_home.php'>Patients</a></li>
				 <li $stock><a href='" . $prefix . "stock/stock_home.php'>Stock</a></li>
				 <li $signout><a id='sign_out' href='" . $prefix . "lib/sign_out.php'>Sign Out</a></li>
			</ul>
			</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Footer(){
	echo "<div id='footer'>
				<a href='#'><div id='scrollup'></div></a>
			<p>Patient Tracking System &#xA9; 2014</p>
		</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PanelTitle($title){
	echo "<p id='pannel_title' >$title</p>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BackButton($title,$target){
	echo "<div id='buttom_div'><a href='$target'>$title</a></div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BeginColumnContainer($width){
	echo "<div id='column_container' style='width:$width" . "px;'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function EndColumnContainer(){
	echo "</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BeginColumn($width){
	echo "<div id='column' style='width:$width" . "px;'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function EndColumn(){
	echo "</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BeginCentCon($width){
	echo "<div style='margin:auto;width:$width" . "px;'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function EndCentCon(){
	echo "</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PutControlPanelItem($title,$image,$target,$id){
	echo "<a href='$target' id='$id'>
			<div id='adm_pannel_item'><p><img src='" . $_SESSION['pre_fix'] . "img/$image'/><br/>$title</p></div>
		</a>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function FormField($caption,$type,$name,$value=''){
	echo "<tr>
			<td>$caption</td>
			<td> <input type='$type' name='$name' value='$value'/></td>
		</tr>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function FormCommentField($caption,$col,$row,$name,$id='',$value=''){
	echo "<tr>
			<td>$caption</td>
			<td><textarea id='$id' rows='$row' cols='$col' name='$name'>$value</textarea></td>
		</tr>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DisplayFild($title,$text,$height=18,$scroll=false,$width=0){
	$s = '';
	if($scroll) $s = 'overflow:scroll;';
	if($width>0) $s = $s . "width:$width" . "px;";
	echo "$title <div id='display_field' style='height:$height" . "px;$s'>$text</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Form_Head($id,$method,$action,$onSubmit){
	echo "<form id='" . $id . "' name='"  . $id .  "' method='" . $method . 
					"' action='" . $action . "' onSubmit='" . $onSubmit . "'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Space($n){
	for($i=0;$i<=$n;$i++)
		echo '&nbsp;';
}
/* ------------------------------------------------------------------------------------------------------------------- */
function TextBox($lable,$name){
	echo $lable . ' <input name=' . $name . "' type='text'/>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function SubmitBtn($text,$name){
	echo "<input type='submit' name='$name' value='$text'/>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function RadioGroup($lable,$name){
	echo "<input type='radio' name='" . $name . " value='radio' id='" . $name . "'/> " . $lable;                              
}
?>