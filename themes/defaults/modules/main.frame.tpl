<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>

<!-- #BeginEditable "TITLE" -->

<title><!--{$TITLE}--></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
<script src='<!--{$HREF_JS_PATH}-->/jquery.js' type='text/javascript'></script>
<script src='<!--{$HREF_JS_PATH}-->/jquery.imghover.js' type='text/javascript'></script>
<script src='<!--{$HREF_JS_PATH}-->/common.js' type='text/javascript'></script>
<script src='<!--{$HREF_JS_PATH}-->/global.js' type='text/javascript'></script>


<style type="text/css">
img.pngfix { behavior: url("<!--{$HREF_CSS_PATH}-->/iepngfix.htc") }
img.link { behavior: url("<!--{$HREF_CSS_PATH}-->/iepngfix.htc"); cursor:pointer; }

</style>

<!-- <body onLoad="window.openPopUpFullScreen('../splash.php?userid=<!--{$USER_ID}-->','','');"> -->

<div id="divLoadCont">
	<table width="100%" height="100%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<!--{$HREF_IMG_PATH}-->/common/ajax-lob.gif" align="absmiddle"> Loading Page....
		</td></tr>
	</table>
</div>

<!-- #EndEditable -->



<!-- ### START INFO BOX ### -->

<table id="infoBox" width="400px" border="0" cellspacing="0" cellpadding="0" class="tdatacontent">
  <tr>
    <td class="theadInfoBox"><b>Information</b></td>
    <td class="theadInfoBox" align="right"><a href="#" id="closeBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" border="0" class="buttonStyle"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentInfoBox">
    <table width="100%" class="tdatacontent">
		  <tr>
		    <td width="120">Jumlah Propinsi </td>
		    <td>: <!--{$NAMA_PROPINSI}--></td>
		  </tr>
		  <tr>
		    <td>Jumlah Kabupaten </td>
		    <td>: <!--{$JUMLAH_KABUPATEN}--></td>
		  </tr>
		  <tr>
		    <td>Jumlah Kecamatan </td>
		    <td>: <!--{$JUMLAH_KECAMATAN}--></td>
		  </tr>
		  <tr>
		    <td>Jumlah Desa/Kelurahan </td>
		    <td>: <!--{$JUMLAH_KELURAHAN}--></td>
		  </tr>
		  <tr>
		    <td>Letak Geografis</td>
		    <td>: 02' 27` 20" LS 04' 24` 55" LU
		    113 49'00 119 57 ' BT</td>
		  </tr> 
		</table>
		</td>
  </tr> 
</table>

<!-- ### END INFO BOX ### -->

<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
<tr><td class="tcat"><img src="<!--{$HREF_IMG_PATH}-->/icon/card_address.png" align="absmiddle" class="pngfix"> SELAMAT DATANG '<!--{$USER_ID}-->' !</td></tr>
</table>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">

<tr><td style="padding:5px;">

<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="250px" align="left">
<tr><td class="thead" height="30px">
<div style="float:left;"></div>
<div style="float:right;">

<!--<a href="#" title="Info Negara" id="openBox"><img id="info" src="<!--{$HREF_IMG_PATH}-->/icon/document_small.png" border="0" class="buttonStyle"></a></div>-->

</td></tr>
<tr><td>


<!--{if $USER_ID == 'BABEL'}-->
    <img src="<!--{$HREF_IMG_PATH}-->/common/propinsi/BABEL.PNG">
 
      <!--{else}-->
    <img src="<!--{$HREF_IMG_PATH}-->/common/kabupaten/pwni1.gif">
<!--{/if}-->


</td></tr></table>

<table class="tborder" cellpadding="2" cellspacing="1" border="0" style="float:left;margin-left:10px;">
<tr><td class="thead" height="30px"><img src="<!--{$HREF_IMG_PATH}-->/icon/columns.gif" align="absmiddle" border="0" style="margin-left:3px;margin-right:4px;"> Info Dan Status Pengguna</td></tr>
<tr><td>
<table width="97%" align="center">

        <tr> 
          <td class="text-regular" width="120px">Level Pengguna</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><B><!--{$LEVEL|upper}--></B></td>
		  </tr>
     
        <tr> 
          <td class="text-regular" width="120px">Nama Lengkap</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><B><!--{$USER_NAME|upper}--></B></td>
		  </tr>
		<tr> 
          <td class="text-regular">Nama Panggilan</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_NICK|upper}--></td>
        </tr>
 	<!--	<tr> 
          <td class="text-regular">Tanggal Aktif User</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right">$USER_DATE_JOIN</td>
        </tr> -->
		<tr> 
          <td class="text-regular">Alamat</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_ADDRESS}--></td>
        </tr>
		<tr> 
          <td class="text-regular">No. Telepon</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_TELEPON}--></td>
        </tr>
		<tr> 
          <td class="text-regular">E-mail</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_EMAIL}--></td>
        </tr>
        <tr> 
          <td class="text-regular">Terakhir Masuk<i>(Waktu)</i></td>
          <td class="text-regular">:</td>
          <td class="text-regular" align="right"><!--{$USER_LAST_LOGIN_DATE}--></td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Masuk <i>(Host)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_LAST_LOGIN_HOST}--></td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Keluar Aplikasi <i>(Waktu)</i></td>
          <td class="text-regular">:</td>
          <td class="text-regular" align="right"><!--{$USER_LAST_LOGOUT_DATE}--></td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Keluar Aplikasi <i>(Host)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><!--{$USER_LAST_LOGOUT_HOST}--></td>
        </tr>
        
      </table>
      </td></tr></table>
</td></tr></table>

</BODY>
</HTML>
