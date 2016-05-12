<?php /* Smarty version 2.6.18, created on 2016-05-17 09:39:46
         compiled from defaults/modules/left.frame.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<style>
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	border-left: 1px solid  #CCCCCC;
	border-right: 1px solid  #F5F5F5;
	
	background-repeat: repeat-y;	
}

-->
</style>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<A HREF="javascript:checkFrame('FrameImg');" TITLE="Show/Hide Menu"><IMG ID="FrameImg" NAME="FrameImg" src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/mini-left2.gif" BORDER="0"></A></TD>
</td>
  </tr>
</table>
</body>
</html>

<SCRIPT LANGUAGE="JavaScript">
<!--

var openImg = new Image();
        openImg.src = "<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/mini-right2.gif"
var closeImg = new Image();
        closeImg.src = "<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/mini-left2.gif"

function showFrame(ImgID){
	var thisImg = document.getElementById(ImgID);
	window.parent.document.getElementById('frameSet_2').cols = '250,7,*,1';
	if(thisImg){
		thisImg.src = closeImg.src;
	}

}
function closeFrame(ImgID){
	var thisImg = document.getElementById(ImgID);
	window.parent.document.getElementById('frameSet_2').cols = '0,7,*,1';
	if(thisImg){
		thisImg.src = openImg.src;
	}
}
function checkFrame(ImgID){
	var frameWidth = window.parent.document.getElementById('frameSet_2').cols; 
	if(frameWidth != '0,7,*,1'){
		closeFrame(ImgID);
	}else{
		showFrame(ImgID);
	}
}
//-->
</SCRIPT>