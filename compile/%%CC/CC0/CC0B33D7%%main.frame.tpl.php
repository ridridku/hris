<?php /* Smarty version 2.6.18, created on 2016-05-17 09:39:46
         compiled from defaults/modules/main.frame.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'defaults/modules/main.frame.tpl', 175, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>

<!-- #BeginEditable "TITLE" -->

<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/common.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/preload.css" type="text/css">
<script src='<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/jquery.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/jquery.imghover.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/common.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/global.js' type='text/javascript'></script>


<style type="text/css">
img.pngfix { behavior: url("<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/iepngfix.htc") }
img.link { behavior: url("<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/iepngfix.htc"); cursor:pointer; }

</style>

<!-- <body onLoad="window.openPopUpFullScreen('../splash.php?userid=<?php echo $this->_tpl_vars['USER_ID']; ?>
','','');"> -->

<div id="divLoadCont">
	<table width="100%" height="100%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/ajax-lob.gif" align="absmiddle"> Loading Page....
		</td></tr>
	</table>
</div>

<!-- #EndEditable -->



<!-- ### START INFO BOX ### -->

<table id="infoBox" width="400px" border="0" cellspacing="0" cellpadding="0" class="tdatacontent">
  <tr>
    <td class="theadInfoBox"><b>Information</b></td>
    <td class="theadInfoBox" align="right"><a href="#" id="closeBox"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" border="0" class="buttonStyle"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentInfoBox">
    <table width="100%" class="tdatacontent">
		  <tr>
		    <td width="120">Jumlah Propinsi </td>
		    <td>: <?php echo $this->_tpl_vars['NAMA_PROPINSI']; ?>
</td>
		  </tr>
		  <tr>
		    <td>Jumlah Kabupaten </td>
		    <td>: <?php echo $this->_tpl_vars['JUMLAH_KABUPATEN']; ?>
</td>
		  </tr>
		  <tr>
		    <td>Jumlah Kecamatan </td>
		    <td>: <?php echo $this->_tpl_vars['JUMLAH_KECAMATAN']; ?>
</td>
		  </tr>
		  <tr>
		    <td>Jumlah Desa/Kelurahan </td>
		    <td>: <?php echo $this->_tpl_vars['JUMLAH_KELURAHAN']; ?>
</td>
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
<tr><td class="tcat"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/card_address.png" align="absmiddle" class="pngfix"> SELAMAT DATANG '<?php echo $this->_tpl_vars['USER_ID']; ?>
' !</td></tr>
</table>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">

<tr><td style="padding:5px;">

<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="250px" align="left">
<tr><td class="thead" height="30px">
<div style="float:left;"></div>
<div style="float:right;">

<!--<a href="#" title="Info Negara" id="openBox"><img id="info" src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/document_small.png" border="0" class="buttonStyle"></a></div>-->

</td></tr>
<tr><td>


<?php if ($this->_tpl_vars['USER_ID'] == 'BABEL'): ?>
    <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/BABEL.PNG">
<?php elseif ($this->_tpl_vars['USER_ID'] == 'BALI'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/BALI.PNG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'BANTEN'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/BANTEN.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'BENGKULU'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/BENGKULU.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'DIY'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/DIY.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'DKI'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/DKI.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'GTO'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/GTO.JPG">
   
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'JABAR'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/JABAR.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'JAMBI'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/JAMBI.PNG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'JATENG'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/JATENG.JPG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'JATIM'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/JATIM.PNG">
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'KALBAR'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/KALBAR.PNG">
 <?php elseif ($this->_tpl_vars['USER_ID'] == 'KALSEL'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/KALSEL.GIF">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'KALTENG'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/KALTENG.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'KALTIM'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/KALTIM.PNG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'KEPRI'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/KEPRI.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'LAMPUNG'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/LAMPUNG.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'MALUKU'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/MALUKU.PNG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'MALUT'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/MALUT.PNG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'NAD'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/NAD.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'NTB'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/NTB.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'NTT'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/NTT.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'PAPUA BARAT'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/PAPUA BARAT.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'PAPUA'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/PAPUA.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'RIAU'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/RIAU.JPG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'SULBAR'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SULBAR.JPG">
     <?php elseif ($this->_tpl_vars['USER_ID'] == 'SULSEL'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SULSEL.JPG">
     <?php elseif ($this->_tpl_vars['USER_ID'] == 'SULTRA'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SULTRA.JPG">
     <?php elseif ($this->_tpl_vars['USER_ID'] == 'SULUT'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SULUT.PNG">
     <?php elseif ($this->_tpl_vars['USER_ID'] == 'SUMBAR'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SUMBAR.PNG">
     <?php elseif ($this->_tpl_vars['USER_ID'] == 'SUMSEL'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SUMSEL.PNG">
    <?php elseif ($this->_tpl_vars['USER_ID'] == 'SUMUT'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/propinsi/SUMUT.JPG"> 
   <?php elseif ($this->_tpl_vars['USER_ID'] == 'admin'): ?>
   <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/image_user/admin.png"> 
      <?php else: ?>
    <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/kabupaten/pwni1.gif">
<?php endif; ?>


</td></tr></table>

<table class="tborder" cellpadding="2" cellspacing="1" border="0" style="float:left;margin-left:10px;">
<tr><td class="thead" height="30px"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/columns.gif" align="absmiddle" border="0" style="margin-left:3px;margin-right:4px;"> Info Dan Status Pengguna</td></tr>
<tr><td>
<table width="97%" align="center">

        <tr> 
          <td class="text-regular" width="120px">Level Pengguna</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><B><?php echo ((is_array($_tmp=$this->_tpl_vars['LEVEL'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</B></td>
		  </tr>
        <tr>
	<!--
	<tr>
	  <td class="text-regular">Tahun</td>
	  <td class="text-regular">:</td>
          <td class="text-regular"><?php echo $this->_tpl_vars['TAHUN']; ?>
</td>
	</tr>
	-->
        <!-- <tr> 
          <td class="text-regular" width="120px">Ruas Jalan</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><B><?php echo ((is_array($_tmp=$this->_tpl_vars['JENIS_RUAS_JALAN'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</B></td>
		  </tr> 
		  -->
        <tr> 
          <td class="text-regular" width="120px">Nama Lengkap</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><B><?php echo ((is_array($_tmp=$this->_tpl_vars['USER_NAME'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</B></td>
		  </tr>
		<tr> 
          <td class="text-regular">Nama Panggilan</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['USER_NICK'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</td>
        </tr>
 		<tr> 
          <td class="text-regular">Tanggal Bergabung</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_DATE_JOIN']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">Alamat</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_ADDRESS']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">No. Telepon</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_TELEPON']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">E-mail</td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_EMAIL']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Masuk Aplikasi <i>(Waktu)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_CURRENT_LOGIN_DATE']; ?>
</td>
        </tr>
        <tr> 
          <td class="text-regular">IP Terakhir Masuk Aplikasi <i>(Host)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_CURRENT_LOGIN_IP']; ?>
</td>
        </tr>
        <tr> 
          <td colspan="3"><hr size="1" color="#FFFFFF"></td>
        </tr>
        <tr> 
          <td class="text-regular">Terakhir Masuk<i>(Waktu)</i></td>
          <td class="text-regular">:</td>
          <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_LAST_LOGIN_DATE']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Masuk <i>(Host)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_LAST_LOGIN_HOST']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Keluar Aplikasi <i>(Waktu)</i></td>
          <td class="text-regular">:</td>
          <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_LAST_LOGOUT_DATE']; ?>
</td>
        </tr>
		<tr> 
          <td class="text-regular">Terakhir Keluar Aplikasi <i>(Host)</i></td>
          <td class="text-regular">:</td>
		  <td class="text-regular" align="right"><?php echo $this->_tpl_vars['USER_LAST_LOGOUT_HOST']; ?>
</td>
        </tr>
        
      </table>
      </td></tr></table>
</td></tr></table>

</BODY>
</HTML>