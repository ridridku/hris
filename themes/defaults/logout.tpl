<html>
<head>

<title><!--{$TITLE}--></title>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" src="<!--{$HREF_JS_PATH}-->/ck.form.js"></script>

<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>

<script language="javascript">
function keluar(){
	parent.location='<!--{$HREF_HOME}-->/hris/form.login.php';
}
</script>

<style type="text/css">

img.pngfix { behavior: url("themes/defaults/css/iepngfix.htc") }

</style>

</head>

<body class="login" onLoad="set_focus();">

<div style="background-image:url(<!--{$HREF_IMG_PATH}-->/common/global_bg.jpg); background-repeat:repeat-x; height:125px">
<img src="<!--{$HREF_IMG_PATH}-->/common/bg.gif" width="700" />
<div>
<!--
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="125">
  <param name="movie" value="<!--{$HREF_IMG_PATH}-->/header.swf">
  <param name="quality" value="high">
  <embed src="<!--{$HREF_IMG_PATH}-->/header.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="125"></embed>
</object>
-->
</div>
</div>

<div style="background-image:url(<!--{$HREF_IMG_PATH}-->/common/header_btm_sip_pjp.jpg); background-repeat:repeat-x; height:25px" align="center"></div>

<br/><br/>

<form name="login" method="post" action="log.engine.php">
<div align="center">
<fieldset style="width:400;">

<img src="<!--{$HREF_IMG_PATH}-->/icon/password.png" style="float:left;padding-top:17px;" class="pngfix" width="60px" height="60px">
<table style="float:left;padding-left:10px;padding-top:20px;padding-bottom:20px;">
<tr>
<td width="100px" class="login_txt"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">ID Pengguna</span></td><td><input type="text" name="txt_username" MAXLENGTH="25" value="" AUTOCOMPLETE="off" class="login_txt_box" size="25">
</td>
</tr>
<tr>
	<td class="login_txt"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">Sandi</span></td><td><input type="password" name="txt_password" MAXLENGTH="25" value="" onKeyPress="CheckEnter();" class="login_txt_box" size="25">
	</td>
</tr>
<!--tambah -->
<tr>
<td class="login_txt"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">Level</span></td>
<td><select name="jns_user"  onChange="cari(this.value);">
<option value="">[Pilih Level Pengguna]</option>
<option value="1">Pusat</option>
<option value="2">Cabang</option> 
</select>
</td>
</tr>

<tr><td class="login_txt" align="left">
<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;"> Cabang</span
></td>
<td> 
 <div id="ajax_instansi"> 
	 <select name="kode_cabang"> 
	 <option value="">[Pilih Cabang]</option> 
	 </select>
 </div>
 </td>
 </tr>
 <input type="hidden" name="txt_tahun" MAXLENGTH="4" value="<!--{$smarty.now|date_format:'%Y'}-->" class="login_txt_box" size="4">
 <input type="hidden" name="txt_bl" MAXLENGTH="4" value="<!--{$smarty.now|date_format:'%m'}-->" class="login_txt_box" size="4">

<!-- -->
<!-- -->

<tr><td></td><td>
<input type="submit" name="submit" value="MASUK" onClick="this.blur(); return Check_Form(); return false;">

</td></tr>
</table>
</fieldset>
</div>

</form>


</body>
</html>