<?php /* Smarty version 2.6.18, created on 2016-10-19 11:48:36
         compiled from defaults/modules/pelaporan/lap_kepegawaian/data_sp/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/pelaporan/lap_kepegawaian/data_sp/index.tpl', 316, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/preload.css" type="text/css">
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
<?php if ($this->_tpl_vars['SEARCH_YEAR'] <> ""): ?>
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
                                                                        <DIV id="ajax_subcabang">
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
                                                                            <select name="departemen_cari" >
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
                                                                <TD>Nama</TD>
                                                                        <TD>
                                                                            <INPUT TYPE="text" NAME="nama_karyawan_cari" value=""  id="nama_karyawan_cari"  size="35" > 
                                                                        </TD>
							</TR>
                                                        <TR>
							<TD>Periode </TD>
							<TD>							
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01">Januari</OPTION>
								<OPTION VALUE="02" >Februari</OPTION>
								<OPTION VALUE="03">Maret</OPTION>
								<OPTION VALUE="04" >April</OPTION>
								<OPTION VALUE="05">Mei</OPTION>
								<OPTION VALUE="06">Juni</OPTION>
								<OPTION VALUE="07" >Juli</OPTION>
								<OPTION VALUE="08">Agustus</OPTION>
								<OPTION VALUE="09">September</OPTION>
								<OPTION VALUE="10">Oktober</OPTION>
								<OPTION VALUE="11">November</OPTION>
								<OPTION VALUE="12">Desember</OPTION>				 
                                                        </SELECT>


						<SELECT NAME="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)2010;
$this->_sections['foo']['loop'] = is_array($_loop=2021) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
 							  <?php if (( $this->_sections['foo']['index'] ) == $this->_tpl_vars['TAHUN_SESSION']): ?>
								 <option value="<?php echo $this->_sections['foo']['index']; ?>
"  selected><?php echo $this->_sections['foo']['index']; ?>
</option>
							  <?php else: ?>
									 <option value="<?php echo $this->_sections['foo']['index']; ?>
"   ><?php echo $this->_sections['foo']['index']; ?>
</option>
							 <?php endif; ?> 
						<?php endfor; endif; ?>
						</SELECT> 
						 </TD></TR>
                                                <TR>
                            <TD>Status</TD>
                            <TD>						
                                <SELECT name="selisih_cari"> 
                                        <OPTION VALUE="" selected>[Pilih status SP]</OPTION>
                                        <OPTION value=">0">Tidak Aktif</OPTION>
                                         <OPTION value="<=0">Masih Berlaku</OPTION>

                                </SELECT>
                            </TD></TR>
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
                                                               
                                                               <a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/button/blank.gif" align="absmiddle"> Cari</span></a>
                                                               <a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
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
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">LAPORAN PEGAWAI YANG TERKENA SP</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%" >

				
									<TR>
									<TD COLSPAN="2">
											<table width="100%" class="tbheader" border=0>	
				<?php if (( $this->_tpl_vars['NM_PERWAKILAN'] != '' )): ?>
											<tr><td class="tdatacontent"  width="100" >CABANG</td><td width="5"> : </td><td colspan="2"><?php echo $this->_tpl_vars['NM_PERWAKILAN']; ?>
 &nbsp;</td></tr>
				<?php endif; ?>

				<?php if (( $this->_tpl_vars['BULAN'] != '' || $this->_tpl_vars['TAHUN'] != '' )): ?>


											<tr><td class="tdatacontent"  >PERIODE </td><td> : </td><td>
											<?php if (( $this->_tpl_vars['BULAN'] == 1 )): ?> Januari <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 2 )): ?> Februari <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 3 )): ?> Maret <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 4 )): ?> April <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 5 )): ?> Mei <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 6 )): ?> Juni <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 7 )): ?> Juli <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 8 )): ?> Agustus <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 9 )): ?> September <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 10 )): ?> Oktober <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 11 )): ?> November <?php endif; ?> 
											<?php if (( $this->_tpl_vars['BULAN'] == 12 )): ?> Desember <?php endif; ?> 									
											<?php echo $this->_tpl_vars['TAHUN']; ?>
 &nbsp;</td></tr>
				<?php endif; ?>
				<?php if (( $this->_tpl_vars['KODE_KAT_KASUS'] != '' )): ?>
                                
											<tr><td class="tdatacontent">KATEGORI KASUS</td><td width="5"> : </td>
											<td colspan="2" class="tdatacontent" >
											<?php if (( $this->_tpl_vars['KODE_KAT_KASUS'] == 1 )): ?> WNI NON TKI<?php endif; ?> 
											<?php if (( $this->_tpl_vars['KODE_KAT_KASUS'] == 2 )): ?> TKI <?php endif; ?>  &nbsp;
											</td>
											</tr>
					<?php endif; ?>
											</table>
										   </TD>
											</TR>
			


								<TR>
									<TD COLSPAN="2">
										<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<thead>									 
										<TR>
                                                                                    <TH class="tdatahead" align="left">NO </TH>
                                                                                        <TH class="tdatahead" align="left">NIP </TH>
                                                                                        <TH class="tdatahead" align="left">ID FINGER </TH>
											<TH class="tdatahead" align="left">NAMA PEGAWAI</TH>
											<TH class="tdatahead" align="left">CABANG</TH>
											<TH class="tdatahead" align="left">DEPARTEMEN</TH>
                                                                                        <TH class="tdatahead" align="left">JABATAN</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">TGL KELUAR SP</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">TGL BERAKHIR SP</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">STATUS</TH>
                                                                                         <TH class="tdatahead" align="left">JENIS SP </TH>
                                                                               
                                                                                      
                                                                                        
											
 									 
										</TR>										 
										</thead>
										
										<tbody>									
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
                                                                                        <TR onmouseover="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'over', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'out', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'click', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');">
                                                                                        <TD width="17" class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>  
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
 </TD>
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
											<TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
 </TD>
											<TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
</TD>
											<TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_dept__ket']; ?>
</TD>
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</TD>
                                                                                        <TD class="tdatacontent"> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
</TD>	
                                                                                        <TD class="tdatacontent"> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl_expired'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
</TD>
                                                                                        <TD class="tdatacontent">  
                                                                                                <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['selisih'] <= 0 )): ?>
                                                                                                <font color="#035b09">Masih Berlaku</font>              
                                                                                              
                                                                                                 <?php else: ?>  
                                                                                                           <font color="#FF0000">SP Expired</font>     
                                                                                                <?php endif; ?> 
                                                                                        </TD>
                                                                                         <TD class="tdatacontent"> 
                                                                                          <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 1): ?>
                                                                                         <font color="#b27f31">Surat Peringatan 1</font>              
                                                                                                <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 2): ?>  
                                                                                                         <font color="#1f0ccc">Surat Peringatan 2</font>     
                                                                                                 <?php else: ?>  
                                                                                                           <font color="#FF0000">Surat Peringatan 3</font>     
                                                                                                <?php endif; ?> 
                                                                                        </TD>	
                                                                                      

										<?php endfor; else: ?>
										<TR>
											<TD class="tdatacontent" COLSPAN="16" align="center">Maaf, Data Masih Kosong</TD>
										</TR>
										<?php endif; ?>
										</tbody>
                                                                                <TR><?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TB4']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['y']['show'] = true;
$this->_sections['y']['max'] = $this->_sections['y']['loop'];
$this->_sections['y']['step'] = 1;
$this->_sections['y']['start'] = $this->_sections['y']['step'] > 0 ? 0 : $this->_sections['y']['loop']-1;
if ($this->_sections['y']['show']) {
    $this->_sections['y']['total'] = $this->_sections['y']['loop'];
    if ($this->_sections['y']['total'] == 0)
        $this->_sections['y']['show'] = false;
} else
    $this->_sections['y']['total'] = 0;
if ($this->_sections['y']['show']):

            for ($this->_sections['y']['index'] = $this->_sections['y']['start'], $this->_sections['y']['iteration'] = 1;
                 $this->_sections['y']['iteration'] <= $this->_sections['y']['total'];
                 $this->_sections['y']['index'] += $this->_sections['y']['step'], $this->_sections['y']['iteration']++):
$this->_sections['y']['rownum'] = $this->_sections['y']['iteration'];
$this->_sections['y']['index_prev'] = $this->_sections['y']['index'] - $this->_sections['y']['step'];
$this->_sections['y']['index_next'] = $this->_sections['y']['index'] + $this->_sections['y']['step'];
$this->_sections['y']['first']      = ($this->_sections['y']['iteration'] == 1);
$this->_sections['y']['last']       = ($this->_sections['y']['iteration'] == $this->_sections['y']['total']);
?>
										<Td class="tdatahead" colspan="9" align="right" ><b>JML Karyawan : </b></td>	
										<Td class="tdatahead"  colspan="1"  align=" " > <?php echo $this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['total_orang']; ?>
 Orang </td>	
                                                                                <?php endfor; endif; ?>
										</TR>
                                                                                                
                                                                                                
                                                                                                
                                                                                                
									</TABLE></TD> 
										  


								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>


									<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									&nbsp;&nbsp;
                                                                    <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';" onMouseOut="document.frmList.print_desc.value='';" 
                                                                    onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');">							
									</div>
					</FORM>
<!--CLOSE_VIEW_INDEX-->

					<?php endif; ?>

	</DIV>

</BODY>
</HTML>