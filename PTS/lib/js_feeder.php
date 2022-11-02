<?php
/* ------------------------------------------------------------------------------------------------------------------- */
function JQ_DocReady_Start(){
	echo "$(document).ready(function(){ ";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function JQ_DocReady_End(){
	echo "});";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ShowHideGrid(){
	echo "function ShowHideGrid(check){
			var id = check.id.substring(3);
			DrawGridById(id,check.checked);
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawGrid(){
	echo	"function drawGrid(ctx,size){
				var w = ctx.canvas.width,
				h = ctx.canvas.height;
				ctx.beginPath();
				
				for (var x=0;x<=w;x+=size){
					ctx.moveTo(x-0.5,0);
					ctx.lineTo(x-0.5,h);
				}
				
				for (var y=0;y<=h;y+=size){
					ctx.moveTo(0,y-0.5);
					ctx.lineTo(w,y-0.5);
				}
				
				ctx.stroke();
			}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawGridById(){
	echo	"function DrawGridById(id,grid){
				var can = document.getElementById('can' + id);
				var img = document.getElementById('img' + id);

				var w = 569;
				can.width = w;
				var h = img.clientHeight;
				can.height = h;
			
				var ctx = can.getContext('2d');

				ctx.drawImage(img,0,0,w,h);
				//remove animation image
				var ani = document.getElementById('ani' + id);
				if(ani!=null)
					img.parentNode.removeChild(ani);

				//ctx.strokeStyle = '#ffffff'; //stroke colour
				if(grid==true)
					drawGrid(ctx,30);
			}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DrawGrids(){
	echo	"function DrawGrids(){
				var n = document.getElementById('num_of_images').value - 1;
				for (var x=0;x<=n;x++){
					DrawGridById(x,false);
				}
			}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function IsImageSelected(){
	echo 	"function IsImageSelected(form){
				var frmEle = form.elements;
				for(var i=0;i<frmEle.length;i++){
					var ele = frmEle[i];
					if((ele.type=='file')&&(ele.value=='')){
						alert('Please select an image to upload!');
						return false;
					}
				}
				return true;
			}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ValidateFormEx(){
	echo "function ValidateForm(formID){
			var frmEle = document.getElementById(formID).elements;
			for(var i=0;i<frmEle.length;i++){
				var ele = frmEle[i];
				if((ele.type == 'text')||(ele.type == 'password')||(ele.nodeName=='TEXTAREA')){
					if(ele.value==''){
						alert('Required field empty!');
						return false;
					}
				}else if(ele.nodeName=='SELECT'){
					if(ele.options[ele.selectedIndex].value==''){
						alert('Required field empty!');
						return false;
					}
				}
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DelectionConfirm(){
echo 	"function DelectionConfirm(msg,location){
			var r = confirm(msg);
			if(r==true)
				window.location = location;
		};";
}

/* ---------------------------------------------------------------------------- */
function ValidateIgnoreFile($form){
echo	"function ValidateIgnoreFile(){
			var frmEle = document.$form.elements;
			
			for(var e = 0; e < frmEle.length; e++){
				if((frmEle[e].value=='')&&(frmEle[e].id!='file')){
					alert('Required field empty!' + frmEle[e].type);
					return false;
				}
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function NavigationBarJS(){
echo 	"$(function(){
				$('#1, #2, #3').lavaLamp({
					fx: 'backout',
					speed: 700,
				});
		});";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function RegisterFormValidate($frmName){
	echo "function RegisterFormValidate(){
			if(ValidateMyForm($frmName)){
				var frmEle = document.$frmName.elements;
				if(!CheckPasswords(frmEle[1].value,frmEle[2].value))
					return false;
				if(!IsEmail(frmEle[4].value))
					return false;
				if(frmEle[6].value==''){
					alert('Please type an address!');
					return false;
				}
			}else{
				return false;
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DeleteConfirmation($id){
	echo "$('$id').click(
			function(){
				r = confirm('Are you sure you want to delete user ' + $('#hidden_text').val() + '?');
				if (r)
					return true;
				return false;
			}
		);";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ValidateFormById(){
	echo "function ValidateFormById(frmId){
			var frmEle = document.getElementById(frmId).elements;
			for(var e = 0; e < frmEle.length; e++){
				if((frmEle[e].type == 'text')||(frmEle[e].type == 'password')){
					if(frmEle[e].value==''){
						alert('Required textbox empty!');
						return false;
					}
				}
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ValidateForm($frmName){
	echo "function ValidateMyForm(){
			var frmEle = document.$frmName.elements;
			for(var e = 0; e < frmEle.length; e++){
				if((frmEle[e].type == 'text')||(frmEle[e].type == 'password')){
					if(frmEle[e].value==''){
						alert('Required textbox empty!');
						return false;
					}
				}
			}
			return true;
		}";
}
?>