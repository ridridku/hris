<?php /* Smarty version 2.6.18, created on 2016-10-19 11:48:42
         compiled from defaults/modules/pelaporan/lap_kepegawaian/data_pegawai_detail/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/pelaporan/lap_kepegawaian/data_pegawai_detail/index.tpl', 470, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/preload.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/
      " type="text/css">
<script language="JavaScript" type="text/javascript">
n=document.layers
ie=document.all

//Hides the layer onload
function hideIt(){
	if(ie || n){
		if(n) document.divLoadCont.display="none"
		else divLoadCont.style.display="none"
	} else {
		document.getElementById('divLoadCont').style.display='none';
	}
}
var err = 0;
var err_ = 0;
</script>
<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>


<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<?php if ($this->_tpl_vars['SEARCH_BOX'] == 1): ?>
<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
<?php else: ?>
<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
<?php endif; ?>

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<?php if ($this->_tpl_vars['KODE_CABANG_CARI'] <> ""): ?>
<a class="button" href="#" onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>
<?php endif; ?>
</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
                  <!--PENCARIAN_DATA -->      
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">
                <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

                                                               <select name="kode_cabang_cari" onchange="cari_subcab(this.value);"> 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_CABANG']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>

                                                                                           <?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_R_CABANG__ID']): ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php else: ?>

                                                                                                   <?php if (( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['KODE_PW_SES']): ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>
                                                                                           <?php endif; ?>

                                                                                           <?php endfor; endif; ?>
                                                                                           </SELECT>

                                                                           <?php else: ?>

                                                                   <select name="kode_cabang_cari" >
                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_CABANG']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>

                                                                                           <?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_R_CABANG__ID']): ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php else: ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == trim ( $this->_tpl_vars['KODE_PW_SES'] )): ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                           <?php endfor; endif; ?>
                                                                                           </SELECT>

                                                                           <?php endif; ?>
                                                           </TD>
                                                   </TR>
                                                  
                                    
                                    <TR>
								<TD>Pilih Sub Cabang</TD>
								<TD>
                                                                        <DIV id="ajax_subcabang" >
                                                                            <select name="kode_subcab_cari" >
                                                                            <option value="">[Pilih Sub Cabang]</option>
                                                                            <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_SUBCABANG']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
                                                                            <?php if (trim ( $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__id'] ) == 0): ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </option>
                                                                            <?php else: ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </option>
                                                                            <?php endif; ?>
                                                                            <?php endfor; endif; ?>
                                                                            </select> 
                                                                    </DIV>
                                                                </TD>
                                                                
							</TR>
                                                        
                                                        <TR>
								<TD>Departemen</TD>
								<TD>
                                                                            <select name="departemen_cari">
                                                                            <option value="">[Pilih Departemen]</option>
                                                                            <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_DEPARTEMEN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
                                                                            <?php if (trim ( $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__id'] ) == 0): ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__ket']; ?>
 </option>
                                                                            <?php else: ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__ket']; ?>
 </option>
                                                                            <?php endif; ?>
                                                                            <?php endfor; endif; ?>
                                                                            </select> 
                                                                </TD>
							</TR>
                                    
                                    
                                    <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nama_karyawan_cari" readonly  id="r_pegawai__nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__PEGAWAI_NAMA']; ?>
">
                                                                 
                                </TD>

                    </TR>
                     <TR>
                         <TD >NIP<font color="#ff0000" >*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nip_karyawan_cari" readonly id="r_pnpt__nip" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__NIP']; ?>
" >
                              
                               <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />  
                               
                            </TD>

                    </TR>
                   

                                                                        
                                                                   

                                                                       
                                                           </TD>
                                                                                             
                                                        <TR>
								<TD></TD>
								<TD>
								<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
								<INPUT TYPE="hidden" name="limit" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
">
								<INPUT TYPE="hidden" name="search" value="1">
								<INPUT TYPE="hidden" name="SORT" value="<?php echo $this->_tpl_vars['SORT']; ?>
">
								<INPUT TYPE="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
								<INPUT TYPE="hidden" name="op" value="0">
                                                               
<a class="button" href="#"  onclick="return checkFrm(frmList1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/button/blank.gif" align="absmiddle"> Cari</span></a>
<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmList1); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/button/blank.gif" align="absmiddle"> <?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
								</TD>
							</TR>	
                   
						
                </TABLE>
                                  

                                                                
			</FORM>
			</div></div>	 <!--TUTUP_PENCARIAN_DATA -->  
		</DIV>
       
														
		<?php if ($this->_tpl_vars['SEARCH'] <> ""): ?><br>
                <!--VIEW_INDEX-->
		<FORM METHOD=GET ACTION="" NAME="frmList">
		
		<!--<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		</TD>	
                
		</TR>	
		</TABLE>-->
                <br>
<center>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {font-size: 14px}
-->
</style>
<table width='95%' height="124" border="0">
  <tr>
    <td width="4" height="28">&nbsp;</td>
    <td width="197" rowspan="3" align="right"><img src="http://hris.tmw.co.id/hris/images/logo_tmw.jpg" width=82 height=75 border=0 alt=""></td>
    <td width="552"><div align="center">
      <h2 class="style2">PT.TRITUNGGAL MULIA WISESA </h2>
    </div></td>
    <td width="1">&nbsp;</td>
    <td width="180" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td><div align="center"><span class="style3 style1">Jl.Kopo Jaya I No.8 Telp (022) 5416678 Fax.(022) 5415888 </span></div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td class="style3" valign="top"><div align="center" class="style1">Kompleks Perkantoran Kopo Cirangrang - Bandung 40224 </div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td colspan="5"><hr width="80%" size="4"></td>
  </tr>
  <tr>
    <td height="21">&nbsp;<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TB']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?></td>
    <td>&nbsp;</td>
    <td><div align="center" class="style1">BIO DATA PEGAWAI </div></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
    <!--tutup_data-->
    <?php endfor; else: ?>
    <?php endif; ?>
</table>
<table cellpadding=2 cellspacing=0 border=0 bordercolor=#333300 width="95%">
<tr><td>

<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TB']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
<!-- section I. DATA PRIBADI -->
<table cellpadding=5 cellspacing=0 border=0 width="95%" >
<tr>
	<td colspan=5></td>
	<td rowspan="14" valign=top>
            <!--<img src="http://localhost/hris/themes/defaults/images/common/image_user/admin.png" width=105 height=134 border=0 alt=""> -->
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>Nama</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
 </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>NIP</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
 </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top width=10>&nbsp;</td>
	<td valign=top width=150 nowrap>Tgl lahir</td>
	<td valign=top align=center width=20>:</td>
	<td valign=top width=500><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__tgl_lahir']; ?>
 </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Agama</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_agama__nama']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>No KTP</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__ktp']; ?>
</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Propinsi</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_provinsi__nama']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Kabupaten</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_kabupaten__nama']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Kecamatan</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_kecamatan__nama']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Desa</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_desa__nama']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Alamat Domisili</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama_jalan']; ?>
</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Tgl Mulai Bekerja</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__tgl_masuk']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Departemen</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_dept__ket']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Jabatan</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign=top>&nbsp;</td>
	<td valign=top nowrap>Cabang</td>
	<td valign=top align=center>:</td>
	<td valign=top><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
</td>
</tr>


</table>
</td></tr></table>
<p>

	
<!-- section II. RIWAYAT JABATAN -->
<table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr> 
      <td><div class=head2><br>RIWAYAT JABATAN</div></td>
    </tr>

    <tr>
      <td valign=top nowrap> 
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width="100%%"%>
          <tr bgcolor="#CCCCCC"> 
            <td class=bdr><div align="center"><b>NO</b></div></td>
            <td class=bdr><div align="center"><b>KONTRAK AWAL</b></div></td>
            <td class=bdr><div align="center"><b>KONTRAK AKHIR</b></div></td>
            <td class=bdr><div align="center"><b>JABATAN</b></div></td>
            <td class=bdr><div align="center"><b>DEPARTEMEN</b></div></td>
          </tr>

<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['CV_JABATAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>					
          <tr> 
              <td class=bdr align=right width=10 valign=top><?php echo $this->_sections['x']['index']+1; ?>
.&nbsp;</td>
               <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_JABATAN'][$this->_sections['x']['index']]['r_pnpt__kon_awal']; ?>
</td>
                <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_JABATAN'][$this->_sections['x']['index']]['r_pnpt__kon_akhir']; ?>
</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_JABATAN'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_JABATAN'][$this->_sections['x']['index']]['r_dept__ket']; ?>
</td>
           
          </tr>
<?php endfor; endif; ?>	

        </table>
      </td>
    </tr>
</table>
<p>
	
<!-- SECTION II. RIWAYAT PENDIDIKAN DAN PENGHARGAAN -->	
<table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr>
		<td colspan=4><div class=head2><br>RIWAYAT PENDIDIKAN</div></td>
    </tr>
    <tr> 
      <td>
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width=100%>
          <tr bgcolor="#CCCCCC"> 
              <td class=bdr width=10><div align="center"><b>NO</div></b></td>
            <td class=bdr width=175><div align="center"><b>PENDIDIKAN AKHIR</b></div></td>
            <td class=bdr><div align="center"><b>SEKOLAH / UNIVERSITAS </b></div></td>
            <td class=bdr width=200><div align="center"><b>JURUSAN</b></div></td>
            <td class=bdr width=200><div align="center"><b>TAHUN LULUS</b></div></td>
          </tr>
	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['CV_PENDIDIKAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>				
          <tr> 
            <td class=bdr align=center width=80 valign=top><?php echo $this->_sections['x']['index']+1; ?>
.&nbsp;</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PENDIDIKAN'][$this->_sections['x']['index']]['r_pegawai__pend_akhir']; ?>
</td>
           <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PENDIDIKAN'][$this->_sections['x']['index']]['r_pegawai__pend_sekolah']; ?>
</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PENDIDIKAN'][$this->_sections['x']['index']]['r_pegawai__pend_jurusan']; ?>
</td>
             <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PENDIDIKAN'][$this->_sections['x']['index']]['r_pegawai__pend_tgl_lulus']; ?>
</td>
          </tr>
		<?php endfor; endif; ?>	
        </table>
      </td>
    </tr>
</table>  
  <P>

<!-- SECTION II. RIWAYAT PELATIHAN -->	
  <table cellpadding=2 cellspacing=0 border=0 width="95%">
    <tr>
		<td colspan=4><div class=head2><br>RIWAYAT PELATIHAN DI TMW</div></td>
    </tr>
    <tr> 
      <td>
        <table border="1" cellspacing="0" cellpadding="2" bordercolor="#000000" width=100%>
          <tr bgcolor="#CCCCCC"> 
            <td class=bdr width=10><b>NO</b></td>
            <td class=bdr><b>TEMA</b></td>
            <td class=bdr><b>TAHUN</b></td>
            <td class=bdr width=80><b>PENYELENGGARA</b></td>
            <td class=bdr width=80><b>NILAI</b></td>
          </tr>
          <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['CV_PELATIHAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>				
          <tr> 
            <td class=bdr align=center width=80 valign=top><?php echo $this->_sections['x']['index']+1; ?>
.&nbsp;</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PELATIHAN'][$this->_sections['x']['index']]['r_mastpel__tema']; ?>
</td>
           <td class=bdr align=center width=80 valign=top><?php echo ((is_array($_tmp=$this->_tpl_vars['CV_PELATIHAN'][$this->_sections['x']['index']]['r_mastpel__tgl_awal'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
</td>
            <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PELATIHAN'][$this->_sections['x']['index']]['r_mastpel__penyelenggara']; ?>
</td>
             <td class=bdr align=center width=80 valign=top><?php echo $this->_tpl_vars['CV_PELATIHAN'][$this->_sections['x']['index']]['r_pel__nilai']; ?>
</td>
          </tr>
		<?php endfor; endif; ?>	
         
	
        </table>
      </td>
    </tr>
    <!--tutup_data-->
    <?php endfor; else: ?>
    <TR>
            <TD class=bdr align=center>Maaf, Data yang dicari tidak ditemukan</TD>
    </TR>
<!--tutup_data
<?php endif; ?>
  </table>

</center>
<div align=right>
<hr width=300><font size="1"><i><?php echo $this->_tpl_vars['SHOW_NAMA_KARYAWAN']; ?>
 - <?php echo $this->_tpl_vars['SHOW_NPK']; ?>
</i></font>&nbsp;&nbsp;</div>

                    
                <div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
                <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';" onMouseOut="document.frmList.print_desc.value='';" 
                onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');">							
                </div>
                </FORM>
           <!--CLOSE_VIEW_INDEX-->

            <?php endif; ?>

	</DIV>

</BODY>
</HTML>