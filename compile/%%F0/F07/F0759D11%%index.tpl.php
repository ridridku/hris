<?php /* Smarty version 2.6.18, created on 2016-10-20 07:11:40
         compiled from defaults/modules/manfaat/angsuran/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'defaults/modules/manfaat/angsuran/index.tpl', 140, false),array('modifier', 'number_format', 'defaults/modules/manfaat/angsuran/index.tpl', 147, false),array('modifier', 'date_format', 'defaults/modules/manfaat/angsuran/index.tpl', 291, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<STYLE>   {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


ul, ol {
    list-style-type: none;
}
p, label {
   background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
    color: #083772;
    font-size: 11px;

}
.container-wrapper {
    margin: 7% auto;
    overflow: hidden;
    position: relative;
    width: 100%;
}
input.tab-menu-radio {
    display: none;
}
label.tab-menu {
    cursor: pointer;
    display: inline-block;
    float: left;
    padding: 10px 30px;

}
.tab-content {
    background-color: #eef2f8 none repeat scroll 0 0;
    border-top: #eef2f8 none repeat scroll 0 0;
    clear: both;
  //  padding: 20px;
   // position: relative;
  //  top: -3px;
    width: 100%;
}
.tab-menu-radio:checked + label {
    background-color: #eef2f8 none repeat scroll 0 0;
    color: #000000;
    transition: all 1s ease 0s;
}
.tab-content .tab {
    height: 0;
    opacity: 0;
}
#tab-menu1:checked ~ .tab-content .tab-1, #tab-menu2:checked ~ .tab-content .tab-2, #tab-menu3:checked ~ .tab-content .tab-3 {
    height: auto;
    opacity: 1;
    transition: opacity 1s ease 0s;
}

    </STYLE>
    

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
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-sack.js"></SCRIPT>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <?php if ($this->_tpl_vars['OPT'] == 1): ?> DISABLED <?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/details.gif" align="absmiddle">Posting</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Master Data Pinjaman</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="left">
                 <tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;"> 

                <FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                
                  <TABLE width="100%" border="0" align="left" > 
                        <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left">NAMA </TH>
                                                                                        <TH class="tdatahead" align="left">NIP </TH>
                                                                                        <TH class="tdatahead" align="left">NO PJM </TH>
                                                                                        <TH class="tdatahead" align="left">CABANG </TH>
											<TH class="tdatahead" align="left" >JENIS PINJAMAN</TH>                                                                                       
                                                                                        <TH class="tdatahead" align="left" >PLATFON</TH>
											<TH class="tdatahead" align="left">TENOR</TH>
											<TH class="tdatahead" align="left" >CICILAN PER BULAN</TH>         
                                                                                        
											<TH class="tdatahead" align="left" width="10%">APROVAL</TH>   
											
			
			</THEAD>
			<tbody>
			<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_PJM']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
											<td class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+1; ?>
</TD>
                                                                                        <TD class="tdatacontent" ><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</TD>
                                                                                        <TD class="tdatacontent" ><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
</TD>
                                                                                        <TD class="tdatacontent" ><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_pjm__no_pinjaman']; ?>
</TD>
                                                                                        <TD class="tdatacontent" ><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
</TD>
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__jenis']; ?>
 </TD>
                                                                                        <TD class="tdatacontent">Rp. <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__platfond'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, ".", ",") : number_format($_tmp, 2, ".", ",")); ?>
 </TD>
											<TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__tenor_bulan']; ?>
  </TD>
                                                                                        <TD class="tdatacontent">Rp. <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__cicilan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, ".", ",") : number_format($_tmp, 2, ".", ",")); ?>
 </TD>                                                                                                                                                                    
                                                                                              
                                                                                        <TD class="tdatacontent" align="center"><INPUT type="checkbox" name="bayar[]" id="check_list" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_pjm__no_pinjaman']; ?>
"></TD>
                                                                                                                                                                          
                                                                                          
											
										</TR>
                                                                                
										<?php endfor; else: ?>
										<TR>
											<TD class="tdatacontent" COLSPAN="7" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<?php endif; ?>
			</tbody>
                                        
										
                        <TR><TD></TD><TD>
					<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
					<INPUT TYPE="hidden" name="limit" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
">
					<INPUT TYPE="hidden" name="SORT" value="<?php echo $this->_tpl_vars['SORT']; ?>
">
					<INPUT TYPE="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
					<INPUT TYPE="hidden" name="op" value="0">
                                        
                               
                                     
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle">Posting</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>
                                       
                                        
                                 </TD>
                                 
                                 <TD colspan="4" >
                                     
                                     
                                        
                                 </TD>
                                  <TD colspan="2" >
                                     
                                     
                                        
                                 </TD>
                                 <TD colspan="3">
                                    <a style="font-size:9pt;" class="button"   name="Check_All" value="Check All" onClick="CheckAll(document.frmCreate.check_list)"><span>Checked All</span></a>
                                   <a style="font-size:9pt;" class="button"  name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span>Unchecked All</span></a>
                                 </TD>
                                
                                
				</TR>
                                
                                <TR><td  colspan="2" style="font-size:8pt;"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td></tr>   
                                       
		</table>
               
				
					
            </table>                  
                    
                
			
                </form>
 </td></tr>
 </DIV>

<!--close_form_tambah-->

<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR><TD>
		<DIV ID="_menuEdit_1">
<!--form_cari-->
<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">

		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box" >
                                     
                                                       
                            <TR>
                                <TD>Nama karyawan </TD><TD><INPUT TYPE="text" NAME="nama_cari"></TD>
                            </TR>
                             <TR>
                                <TD>No Pinjaman </TD><TD><INPUT TYPE="text" NAME="nopjm_cari"></TD>
                            </TR>
                            
			<TR><TD></TD>
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
                               
				<CENTER>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle">Cari</span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset();"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>
				</CENTER>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></div>



<!--form_cari-->
		</DIV>

		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Data Pembayaran Pinjaman</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0">Data Pembayaran Pinjaman</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                        <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left">NAMA KARYAWAN </TH>
                                                                                        <TH class="tdatahead" align="left" >NIP </TH>
                                                                                          <TH class="tdatahead" align="left" >NO PINJAMAN </TH>
											<TH class="tdatahead" align="left" >PLATFON</TH>                                                                                       
											<TH class="tdatahead" align="left">TENOR</TH>
											<TH class="tdatahead" align="left" >CICILAN</TH>                                                                                       
											<TH class="tdatahead" align="left" width="10%">CICILAN KE</TH>    
                                                                                        <TH class="tdatahead" align="left" width="10%">TGL PEMBAYARAN</TH>  
                                                                                        </THEAD>
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
                                                                                        <tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
											<td width="17" class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>
                                                                                        <TD class="tdatacontent" ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</TD>
                                                                                        <TD class="tdatacontent"  ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
</TD>
                                                                                        <TD class="tdatacontent"  ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_ang__nopjm']; ?>
</TD>
                                                                                        <TD class="tdatacontent">Rp.<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__platfond'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, ".", ",") : number_format($_tmp, 2, ".", ",")); ?>
 </TD>
                                                                                       
											<TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__tenor_bulan']; ?>
  </TD>
                                                                                        <TD class="tdatacontent">Rp. <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_ang__cicilan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, ".", ",") : number_format($_tmp, 2, ".", ",")); ?>
 </TD>                                                                                        
											<TD class="tdatacontent">Cicilan ke- <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_ang__angsuran_ke']; ?>
</TD>
                                                                                        <TD class="tdatacontent"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_ang__tanggal'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
</TD>
    
										</TR>
										<?php endfor; else: ?>
										<TR>
											<TD class="tdatacontent" COLSPAN="14" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<?php endif; ?>
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->
                    <table width="100%">
                    <tr class="text-regular">
                    <td width="20">Tampilkan</td>
                    <td width="35"><INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
                    <INPUT TYPE="hidden" name="kode_perwakilan_cari" value="<?php echo $this->_tpl_vars['KODE_PERWAKILAN_CARI']; ?>
">
                    <INPUT TYPE="hidden" name="no_paspor_cari" value="<?php echo $this->_tpl_vars['NO_PASPOR_CARI']; ?>
">
                    <INPUT TYPE="hidden" name="nama_wni_cari" value="<?php echo $this->_tpl_vars['NAMA_WNI_CARI']; ?>
">
                    <INPUT TYPE="hidden" name="kode_sumber" value="<?php echo $this->_tpl_vars['KODE_SUMBER']; ?>
">
                                    <SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
                                    <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['LISTVAL']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <OPTION VALUE = "<?php echo $this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']]; ?>
" <?php if ($this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']] == $this->_tpl_vars['LIMIT']): ?> SELECTED <?php endif; ?>> <?php echo $this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']]; ?>
 </OPTION>
                                    <?php endfor; endif; ?>
                                    </SELECT></td>
                    <td>Baris : <?php echo $this->_tpl_vars['COUNT_VIEW']; ?>
 - <?php echo $this->_tpl_vars['COUNT_ALL']; ?>
 Dari <?php echo $this->_tpl_vars['COUNT']; ?>
</td>
                    <td align="right"><?php echo $this->_tpl_vars['NEXT_PREV']; ?>
</td>
                    </tr>
                    </table>
    <!--halaman -->
</div>
		</td></tr>
		</table>

		</form>

	<div id="div-bg-note-trans"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>