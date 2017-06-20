<?php /* Smarty version 2.6.18, created on 2017-06-02 09:11:06
         compiled from defaults/modules/header.frame.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style>
body {
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	margin-bottom: 0px;
	padding:0px;
}
tbody tr td:first-child {
    font-weight: bold;
}
.text-regular {
    font: 11px/22px "Trebuchet MS",Verdana,Arial,Helvetica,sans-serif;
}

</style>

<body>

<div style="background-image:url(<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/header_btm_sip_pjp.jpg); background-repeat:repeat-x; height:25px" align="center">
    <A HREF="javascript:checkFrame('FrameImg');" TITLE="Show/Hide Header">
        <img ID="FrameImg" NAME="FrameImg" src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/top_arrow_sip_pjp_2.jpg" BORDER="0">

    </A>

</div>
</body>
</html>
<SCRIPT LANGUAGE="JavaScript">
<!--
var openImg = new Image();
        openImg.src = "<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/top_arrow_sip_pjp_1.jpg"
var closeImg = new Image();
        closeImg.src = "<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/top_arrow_sip_pjp_2.jpg"

function showFrame(ImgID){
	var thisImg = document.getElementById(ImgID);
	window.parent.document.getElementById('frameSet_1').rows = '150,25,*';
	if(thisImg){
		thisImg.src = closeImg.src;
	}

}
function closeFrame(ImgID){
	var thisImg = document.getElementById(ImgID);
	window.parent.document.getElementById('frameSet_1').rows = '0,25,*';
	if(thisImg){
		thisImg.src = openImg.src;
	}
}
function checkFrame(ImgID){
	var frameWidth = window.parent.document.getElementById('frameSet_1').rows;
	if(frameWidth != '0,25,*'){
		closeFrame(ImgID);
	}else{
		showFrame(ImgID);
	}
}
//-->
</SCRIPT>