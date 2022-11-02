
function SelectMedicine(checkbox){
	var itemdiv = checkbox.parentNode.parentNode;

	if(checkbox.checked){
		itemdiv.style.backgroundColor="#FFB973";
		var id = checkbox.name;
	}else{
		itemdiv.style.backgroundColor="#DDDDDD";
	}
}
/* ---------------------------------------------------------------------------- */
function QuantityChanged(textbox){
	var id = textbox.name.substr(3,textbox.name.length);
	var avail = parseInt(document.getElementById("hid" + id).value);
	var req = parseInt(textbox.value);
	
	var itemdiv = textbox.parentNode.parentNode;
	
	if(req>avail){
		textbox.style.backgroundColor="#FF0000";
	}else{
		textbox.style.backgroundColor="#FFFFFF";
	}
}
/* ---------------------------------------------------------------------------- */
function ValidateAppClose(){
	var ana = document.getElementById("txtAnalysis").value;
	var con = document.getElementById("txtConsultant").value;
	
	if((ana=='')||(con=='')){
		alert("Required field empty");
		return false;
	}
		
	return true;
}
