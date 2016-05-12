function OnChangeMarginSelect(elmSelect, elmId){
  var element = document.getElementById(elmId);
  for(i=0; i<elmSelect.childNodes.length; i++){
	 oneChild = elmSelect.childNodes[i];
     if(oneChild.selected){
  	    element.width = oneChild.value;		
		return;
	 }
  }
}
function HideElement(elmId){
  var elm = document.getElementById(elmId);
  var parenElm = elm.parentNode;
  parenElm.removeChild(elm);
}

function DeleteElmWithName(id, name){
  var element = document.getElementById(id);
  for(i=0; i<element.childNodes.length; i++){
	 oneChild = element.childNodes[i];
     if(oneChild.name && oneChild.name == name){
		element.removeChild(oneChild); 
		return;
	 }
  }
}
function HideControlForId(id) 
{
  DeleteElmWithName(id, 'Turun');
  DeleteElmWithName(id, 'Naik');
}
function DownForId(id) 
{
  var objMenu = document.getElementById(id);
  var brItem = document.createElement("br");
  var oneChild = objMenu.firstChild;
  objMenu.insertBefore(brItem, oneChild);
}
function HideThis(elm){
  var parenElm = elm.parentNode;
  parenElm.removeChild(elm);
}
function UpForId(id) 
{
  var objMenu = document.getElementById(id);
  var oneChild;
  if(objMenu.childNodes.length > 0){
	 oneChild = objMenu.firstChild;
	 objMenu.removeChild(oneChild);
  }
}

/*
function AddSelectMarginElement(value, label, ){
  var selectItem = document.createElement("option");
  selectItem.value
  selectItem.selected;
  selectItem.label
	
}

  <option value="100" selected label="Letter">Letter</option>
  <option value="300" label="A4">A4</option>
  <option value="600" label="Folio">Folio</option>
  <option label="Default" value="750">Default</option>
  <option label="Extrim" value="1000">Extrim</option>


var objMenu = document.getElementById('control_margin');
var brItem = document.createElement("br");
var oneChild = objMenu.firstChild;
objMenu.insertBefore(brItem, oneChild);

*/// JavaScript Document