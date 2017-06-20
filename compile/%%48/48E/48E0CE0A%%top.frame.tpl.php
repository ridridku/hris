<?php /* Smarty version 2.6.18, created on 2017-06-02 09:11:06
         compiled from defaults/modules/top.frame.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/top.frame.tpl', 27, false),)), $this); ?>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
 <!-- 1800000000 30 minutes
 60000000  1 Menit
 30 minutes->1800 detik->1800000 millisecond -->
 <script>
//     $(document).ready(function(){
// setInterval(function(){cache_clear()},1800000);
// });
// function cache_clear()
//{
 //window.location.reload(true);
// window.location.href = '../modules/logout.php';

// }
</script>
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body leftmargin="0" topmargin="0" style="background: url('<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/global_bg.jpg');">
<table width=60% border="0">

  <tr style="font-style: italic; font-size:12;color:blue;">
    <th width="18" scope="row"></th>
    <td width="31" align="center" ><img class="pngfix" align="absmiddle" src="http://hris.tmw.co.id/hris/themes/defaults/images/icon/card_address.png"></td>
    <td width="77" ><?php echo $this->_tpl_vars['SESSION_NAMA']; ?>
</td>
    <td width="504">Periode aktif absensi : <?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AWAL'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
 s/d <?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AKHIR'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
 &nbsp;&nbsp;&nbsp;<font color="#003fff"><br>Infomasi : Gunakan<FONT style="font-style: italic; font-size:15;color:#ff0800;"> Google Chrome</font> Untuk yang tampilan Lebih Baik </td>
    <td width="13">&nbsp;</td>
  </tr>
  <tr style="font-style: italic; font-size:12;color:blue;">
    <th colspan="4" scope="row"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/common/bg.gif" /></th>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>