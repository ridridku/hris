// Declare Global Variable for XMLHTTPRequest--- >

function createRequestObject(){
	var request_o; //declare the variable to hold the object.
	var browser = navigator.appName; //find the browser name
	if(browser == "Microsoft Internet Explorer"){
		request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_o = new XMLHttpRequest();
	}
	return request_o; 
}

var http = createRequestObject(); 

// End Declaring Global Variablr for XMLHTTPRequest --- >

function openPopUp_(str_location, str_title) {
	var win_width = 400;
	var win_height = 580;
	w_left = ( screen.width / 2 ) - ( win_width / 2 );
	w_top = ( screen.height / 2 ) - ( win_height / 2 );
	window.open(str_location,str_title,"toolbar=no, location=0,directories=no,status=no,menubar=0, scrollbars=no,resizable=0,copyhistory=0,width=400,height=580,top="+w_top+",left="+w_left);
}


function ShowHide(idDiv) {
	if(document.getElementById(idDiv).style.display=='none'){
			document.getElementById(idDiv).style.display='block';
	} else {
			document.getElementById(idDiv).style.display='none';	
	}
}

function ShowDiv(idDiv) {
	
	document.getElementById(idDiv).style.display='block';

}

function HideDiv(idDiv) {
	
	document.getElementById(idDiv).style.display='none';

}
function doNavigateContentOver(str_location,str_target) {
	parent.frames[str_target].location = str_location;
}

function doNavigateContent(str_location) {
	parent.location = str_location;
}


$(document).ready(function(){
	
	$('#divLoadCont').hide();
	
  $('img.buttonStyle').imghover();
  $('img.buttonStyle').css("cursor","pointer");
	
	$("a#openBox").click(function() {
	$("#infoBox").fadeIn("slow");
		
	return false;
	});
	
	$("a#closeBox").click(function(){
	$("#infoBox").fadeOut("slow");
		
	return false;
	});
	
	$("a#openSearchBox").click(function() {
	$("#searchBox").fadeIn("slow");
		
	return false;
	});
	
	$("a#closeSearchBox").click(function(){
	$("#searchBox").fadeOut("slow");
		
	return false;
	});
	
	$("a#openFormBox").click(function() {
	$("#formBox").fadeIn("slow");
		
	return false;
	});
	
	$("a#closeFormBox").click(function() {
	$("#formBox").fadeOut("slow");
	$("#ID_MAINPAGE").fadeIn();	
	return false;
	});
		  
});