<?php /* Smarty version 2.6.18, created on 2017-06-05 08:56:42
         compiled from defaults/modules/jaminan/jaminan/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/jaminan/jaminan/index.tpl', 206, false),array('function', 'cycle', 'defaults/modules/jaminan/jaminan/index.tpl', 516, false),)), $this); ?>
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
/icon/details.gif" align="absmiddle"> <?php echo $this->_tpl_vars['BTN_NEW']; ?>
</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
    <tr><td class="tcat">Form Jaminan </td></tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
    <tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
    <tr><td class="alt2" style="padding:0px;">
    <FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" enctype="multipart/form-data">
    <TABLE id="table-add-box" border="0">
    <TR>
            <TD>No Jaminan(Otomatis)<font color="#ff0000">*</font></TD>
                     <TD>
                        <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <INPUT  readonly=""  TYPE="text" name="jaminan_id" size="35" value="<?php echo $this->_tpl_vars['ID_JAMINAN_NEW']; ?>
"  onkeypress="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
                            <?php else: ?>
                            <INPUT  readonly=""  TYPE="text" name="jaminan_id" size="35" value="<?php echo $this->_tpl_vars['EDIT_ID']; ?>
"  onkeypress="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
                            <?php endif; ?>  

            </TR>   
                <TR>
                        <TD>Cabang <font color="#ff0000">*</font></TD> 
                                                               <TD><?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

                                                                                               <select name="kode_cabang" > 
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

                                                                                                       <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_CABANG_ID']): ?>
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

                                                    <SELECT name="kode_cabang" >
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

                                                                                    <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_CABANG_ID']): ?>
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
                            <TD>Nama <font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nama" readonly  id="r_pegawai__nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_PEGAWAI_NAMA']; ?>
">
                                <INPUT TYPE="hidden" NAME="nip" readonly id="r_pnpt__nip" size="35" value="<?php echo $this->_tpl_vars['EDIT_PNPT_NIP']; ?>
" >
                                <INPUT TYPE="hidden" NAME="id_peg" readonly id="idpeg" size="35" value="<?php echo $this->_tpl_vars['EDIT_PEGAWAI_ID']; ?>
" > 
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>
                    </TR>
                    <TR>
                            <TD>Jabatan<font color="#ff0000">*</font></TD>
                            <TD><INPUT TYPE="text" NAME="jabatan" readonly id="r_jabatan__ket" size="35" value="<?php echo $this->_tpl_vars['EDIT_JABATAN']; ?>
" ></TD>                         
                    </TR>
                     <TR>
				<TD>Tgl Penyerahan </TD>
                                <TD>
                                    <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>

                                        <input readonly="" type="text" NAME="tgl"  value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php else: ?>
                                        <input readonly="" type="text" name="tgl" value="<?php echo $this->_tpl_vars['EDIT_TGL']; ?>
" >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>  
                                </TD>         
                    </TR>
                    <TR>
                           <TD>Jenis Jaminan <font color="#ff0000">*</font></TD>
                           <TD>
                                       <select name="jenis_jaminan" >
                                           <option value="" >[Pilih Jenis Jaminan]</option>
                                       <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_JENIS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['tipe__jaminan_id'] == $this->_tpl_vars['EDIT_TIPE'] )): ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['tipe__jaminan_id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['tipe__jaminan']; ?>
 </option>
                                       <?php else: ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['tipe__jaminan_id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['tipe__jaminan']; ?>
 </option>
                                       <?php endif; ?>
                                       <?php endfor; endif; ?>
                                       </select> 
                           </TD>
                    </TR>
                     
                    <TR>
                              <TD>No Jaminan <font color="#ff0000">*</font></TD>
                              <TD>   
                                  <INPUT TYPE="text" NAME="no_jaminan"  size="35" value="<?php echo $this->_tpl_vars['EDIT_KODE']; ?>
" >      
                              </TD>
                   </TR>
                                 
                  
                    
                    
                    <TR>
                                <TD>Keterangan <font color="#ff0000">*</font><font color="#ff0000">*</font></TD> 
				<TD>   
                                     <?php if ($this->_tpl_vars['EDIT_VAL'] == 1): ?>
                                    <TEXTAREA name="keterangan" cols="50" rows="10" ><?php echo $this->_tpl_vars['EDIT_KET']; ?>
</TEXTAREA>   
                                     <?php else: ?>
                                    <TEXTAREA name="keterangan" cols="50" rows="10" ></TEXTAREA>  
                                    <?php endif; ?>
                                </TD>
                    </TR>
                        <TR>
                                   <TD>Status<font color="#ff0000">*</font></TD> 
                                           <TD><SELECT name="status" size="1" >
                                                           <OPTION value="">[Status Jaminan]</OPTION>
                                                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                                                            <OPTION value='1' <?php if ($this->_tpl_vars['EDIT_STATUS'] == 1): ?>selected<?php endif; ?>>Di Terima HRD </OPTION>
                                                           
                                                              <?php else: ?>   
                                                                 <OPTION value='2' <?php if ($this->_tpl_vars['EDIT_STATUS'] == 2): ?>selected<?php endif; ?>>Di Kembalikan</OPTION>
                                                             <OPTION value='1' <?php if ($this->_tpl_vars['EDIT_STATUS'] == 1): ?>selected<?php endif; ?>> Di Terima HRD</OPTION>
                                                          
                                                          <?php endif; ?>  
                                                   </SELECT>
                                           </TD>
                        </TR>
                                     <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                        <TR>
				<TD></TD>
                                <TD> 
                                <input readonly="" type="hidden" NAME="tgl_kembali"  value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
				<img hidden="" src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_kembali,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					
                                </TD>         
                                </TR>
                                <?php else: ?>       
                                <TR>
				<TD >Tgl Diambil Karyawan</TD>
                                <TD> 
                                <input readonly="" type="text" name="tgl_kembali" value="<?php echo $this->_tpl_vars['EDIT_TGL_KEMBALI']; ?>
" >
                                <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kembali,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>  
                                </TD>         
                                </TR>
                    <TR>
                                <TD>Check Jika ada File Upload</TD> 
				<TD>    
                                    <input type="checkbox" onclick="codename()" name="checkboxname" value="1">  
                                </TD>
                     </TR> 
                     <TR>
                                <TD>Foto/Gambar</TD> 
				<TD>    
                                    <INPUT TYPE="file" disabled NAME="file_gambar" size="35"  value="<?php echo $this->_tpl_vars['EDIT_GAMBAR']; ?>
" >   
                                    <INPUT TYPE ="hidden"  name="foto2"  value="<?php echo $this->_tpl_vars['EDIT_GAMBAR']; ?>
">  
                                </TD>
                                
                     </TR> 
                     <?php if ($this->_tpl_vars['EDIT_VAL'] == 1): ?>
                   <TR>
                        <TD></TD> 
                        <TD>   
                        <img src="<?php echo $this->_tpl_vars['HREF_FOTO']; ?>
/<?php echo $this->_tpl_vars['EDIT_GAMBAR']; ?>
" width=105 height=134 >
                    </TD>
                     </TR> 
                      <?php endif; ?>
                                <TR><TD height="40"></TD>
					<TD>
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
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['SUBMIT']; ?>
</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>
					</TD>
				</TR>
					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>

					</tr>
                
			</TABLE>
                </form>
 </td></tr>
 </table>
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
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

                                                                                           <select name="kode_cabang_cari" onchange="cari_subcab2(this.value);"> 
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
                                                                    <DIV id="ajax_subcabang2">
                                                                       <select name="kode_subcab_cari">
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
                                <TD>Status Inventaris<font color="#ff0000">*</font></TD> 
				<TD>    
                                    <SELECT NAME="status_cari" >   
                                            <option value="">Pilih Status Cari</OPTION>
                                            <option value="1">Sudah Kembali</OPTION>
                                            <option value="2">Dipinjam</OPTION>
                                           
                                    </SELECT>
                                </TD>
                                </TR>
                        <TR>
                           <TD>Jenis Inventaris <font color="#ff0000">*</font></TD>
                           <TD>
                                       <select name="jenis_alat" >
                                       <option value="">[Pilih Jenis]</option>
                                       <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TIPE']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_TIPE'][$this->_sections['x']['index']]['tipe__jaminan_id'] )): ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_TIPE'][$this->_sections['x']['index']]['tipe__jaminan_id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_TIPE'][$this->_sections['x']['index']]['tipe__jaminan']; ?>
 </option>
                                       <?php else: ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_TIPE'][$this->_sections['x']['index']]['tipe__jaminan_id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_TIPE'][$this->_sections['x']['index']]['tipe__jaminan']; ?>
 </option>
                                       <?php endif; ?>
                                       <?php endfor; endif; ?>
                                       </select> 
                           </TD>
                        </TR>
                            <TR>
                                    <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_cari" ></TD>
                            </TR>
                            <TR>
                                    <TD>Finger Print</TD><TD><INPUT TYPE="text" NAME="finger_cari" ></TD>
                            </TR>
                            
                            <TR>
                                    <TD>Kode Inventaris</TD><TD><INPUT TYPE="text" NAME="kode_inv_cari" ></TD>
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
		<tr><td class="tcat">Data Jaminan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0">Data Jaminan</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                    <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                          <TH class="tdatahead" align="left" width="10%">ID JAMINAN </TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NIP </TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">ID FINGER </TH>
											<TH class="tdatahead" align="left" width="10%">NAMA</TH>                                                                                       
                                                                                        <TH class="tdatahead" align="left" >CABANG</TH>
											<TH class="tdatahead" align="left">DEPARTEMEN</TH>
											<TH class="tdatahead" align="left">JABATAN</TH>                                                                                       
											<TH class="tdatahead" align="left">JENIS JAMINAN</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NO JAMINAN</TH>
                                                                                        <TH class="tdatahead" align="left">TGL DISERAHKAN</TH>
                                                                                        <TH class="tdatahead" align="left">TGL DIKEMBALIKAN</TH>
                                                                                        <TH class="tdatahead" align="left">STATUS</TH>
											<TH class="tdatahead" COLSPAN="2"><?php echo $this->_tpl_vars['ACTION']; ?>
</TH>
			
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
			<tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
											<td width="17" class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>
											<TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__id']; ?>
 </TD>
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
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['tipe__jaminan']; ?>
</TD>    
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__kode']; ?>
</TD>   
											<TD class="tdatacontent"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__tgl_penyerahan'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%b-%Y') : smarty_modifier_date_format($_tmp, '%d-%b-%Y')); ?>
</TD>
                                                                                        
                                                                                        <TD class="tdatacontent"> 
                                                                                         <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__status'] ) == 2): ?>
                                                                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__tgl_dikembalikan'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%b-%Y') : smarty_modifier_date_format($_tmp, '%d-%b-%Y')); ?>
</TD>
                                                                                          <?php else: ?>
                                                                                          
                                                                                        <?php endif; ?>
                                                                                        <TD class="tdatacontent">
                                                                                           <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__status'] ) == 1): ?>
                                                                                           <font color="#0a8727"> Ada Di HRD </font>
                                                                                           <?php else: ?>
                                                                                                <font color="#ff0000">Sudah Kembalikan</font>
                                                                                            <?php endif; ?>
                                                                                        
                                                                                        
                                                                                        </TD>
                                                                                        
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__id']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['DELETE']; ?>
" onclick="return checkDelete('engine.php?op=2&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_jaminan__id']; ?>
 &mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
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