<?php /* Smarty version 2.6.18, created on 2016-10-20 03:50:33
         compiled from defaults/modules/data_pegawai/surat_peringatan/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'defaults/modules/data_pegawai/surat_peringatan/index.tpl', 720, false),)), $this); ?>
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
		<tr><td class="tcat">Surat Peringatan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" meta http-equiv="Location" content="http://example.com/"> 
                    <TABLE id="table-add-box">
				
					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<?php else: ?>
                                        <INPUT TYPE="hidden" NAME="id" value="<?php echo $this->_tpl_vars['EDIT_ID']; ?>
" size="35" readOnly class="text_disabled">
					<?php endif; ?>
        
            <TR>
                        <TD>No Surat Peringatan <font color="#ff0000">*</font></TD>
                        <TD>
                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <div id="ajax_cek_id">
                                <INPUT readonly=""   TYPE="text" name="t_sp__no" size="35" value="<?php echo $this->_tpl_vars['NO_OTOMATIS']; ?>
"  OnChange="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
                            </DIV>
                        <?php else: ?>
                            <div id="ajax_cek_id">
                             <INPUT   TYPE="text" name="t_sp__no" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NO']; ?>
" OnChange="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
                            </DIV>
                        <?php endif; ?>
                        </TD>
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

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_T_SP__CABANG_ID']): ?>
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

                                                                                <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_T_SP__CABANG_ID']): ?>
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
                   <!--1 NAMA DAN ATASAN--->
                    <?php if (( ( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) || ( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) )): ?>      
                   <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="sp_nama" readonly  id="nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NAMA']; ?>
">
                                <INPUT TYPE="hidden" NAME="sp_mutasi" readonly id="mutasi" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NIP']; ?>
" >       
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>
                    </TR>
                    <TR>
                        <TD>Jabatan Karyawan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="jabatan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                    <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="nama_atasan"  size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN']; ?>
">
                           
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan2()" value=" ... " />
                            </TD>
                    </TR>
                     <TR>
                        <TD>Jabatan Atasan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="atasan_jabatan" readonly id="jabatan_atasan" size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN_JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                    
                   
                    <!--2 NAMA DAN ATASAN--->
                     <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 )): ?>   
                      <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="sp_nama" readonly  id="nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NAMA']; ?>
">
                            <INPUT TYPE="hidden" NAME="sp_mutasi" readonly id="mutasi" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NIP']; ?>
" >
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                        <TD>Jabatan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="jabatan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                     <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="nama_atasan"  size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN']; ?>
">
                                <INPUT TYPE="hidden" NAME="atasan__mutasi" readonly id="mutasi_atasan" size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN_MUTASI']; ?>
">
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan2()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                        <TD>Jabatan Atasan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="atasan_jabatan" readonly id="jabatan_atasan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                                        
                   <!--3 NAMA DAN ATASAN EDIT CABANG SP1--->
                       <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 ) && ( $this->_tpl_vars['EDIT_T_SP__JENIS'] == 1 )): ?>      
                       <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="sp_nama" readonly  id="nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NAMA']; ?>
">
                                <INPUT TYPE="text" NAME="sp_mutasi" readonly id="mutasi" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NIP']; ?>
" >
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                        <TD>Jabatan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="jabatan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                      <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="nama_atasan"  size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN']; ?>
">
                          
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan2()" value=" ... " />
                            </TD>

                    </TR>
                      <TR>
                        <TD>Jabatan Atasan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="atasan_jabatan" readonly id="jabatan_atasan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>
                    
                    
                    
                    <!-- 4.NAMA ATASAN EDIT JENIS SP 2&3--->       
                    
                     <?php else: ?> 		    
                     <TR>
                        <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                        <TD><INPUT TYPE="text" NAME="sp_nama" readonly  id="nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NAMA']; ?>
">
                            <INPUT TYPE="hidden" NAME="sp_mutasi" readonly id="mutasi" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__NIP']; ?>
" >
                        </TD>
                    </TR>
                    <TR>
                        <TD>Jabatan Karyawan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="jabatan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>    
                    <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="nama_atasan"  size="35" value="<?php echo $this->_tpl_vars['EDIT_ATASAN']; ?>
">
                              
                            </TD>
                    </TR>         
                    <TR>
                        <TD>Jabatan Atasan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="jabatan" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_SP__JABATAN']; ?>
" ></TD>                                			                      
                    </TR>  

              
                     <?php endif; ?>            
                   
         
                        <!--1.TGL AKHIR -->  
                        <?php if (( ( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) || ( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) )): ?> 
                                
                        <TR>
				<TD>Tanggal Terbit SP</TD>
                                <TD>
				<input type="text" NAME="sp_tgl"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl']; ?>
">
				<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.sp_tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">	
                                </TD>         
			</TR> 
                        <TR>
				<TD>Tanggal Berakhir SP</TD>
                                <TD>
                                <input type="text" NAME="sp_tgl_exp"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl_EXP']; ?>
">
                                <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.sp_tgl_exp,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                </TD>         
			</TR>
                        <!--2.TGL AKHIR -->  
                        
                        <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 )): ?>  
                         <TR>
				<TD>Tanggal Terbit SP</TD>
                                <TD>
				<input type="text" NAME="sp_tgl"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl']; ?>
">
				<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.sp_tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">	
                                </TD>         
			</TR> 
                        <TR>
				<TD>Tanggal Berakhir SP</TD>
                                <TD>
                                 <input type="text" NAME="sp_tgl_exp"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl_EXP']; ?>
">
                         <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.sp_tgl_exp,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                </TD>         
			</TR>
                        
                        <!--3.TGL AKHIR --> 
                         <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 ) && ( $this->_tpl_vars['EDIT_T_SP__JENIS'] == 1 )): ?>  
                         <TR>
				<TD>Tanggal Terbit SP</TD>
                                <TD>
				<input type="text" NAME="sp_tgl"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl']; ?>
">
				<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.sp_tgl,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">	
                                </TD>         
			</TR> 
                        <TR>
				<TD>Tanggal Berakhir SP</TD>
                                <TD>
                                   <input type="text" name="sp_tgl_exp" value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl_EXP']; ?>
" >
			<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.sp_tgl_exp,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                </TD>         
			</TR>
                        
                        <!--4.PELANGGARAN CABANG -->  
                       <?php else: ?> 	
                       <TR>
				<TD>Tanggal Terbit SP</TD>
                                <TD>
				<input type="text" NAME="sp_tgl"  value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl']; ?>
"  readonly="" >
				</TD>         
			</TR> 
                        <TR>
				<TD>Tanggal Berakhir SP</TD>
                                <TD>
                                <input type="text" name="sp_tgl_exp" value="<?php echo $this->_tpl_vars['EDIT_T_SP__TGl_EXP']; ?>
" readonly="" > </TD>         
			</TR>
                     
                        <?php endif; ?>    
                        
                        
                                                       
                        <!-- SURAT PERINGATAN TAMBAH PUSAT TAMBAH-->
                        <?php if (( ( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) || ( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) )): ?> 
                             <TR>
                                <TD>Jenis Surat Peringatan <font color="#ff0000">*</font></TD> 
			
					<TD><SELECT name="sp_jenis">
							<OPTION value="">[Pilih Surat Peringatan]</OPTION>
							<OPTION value="1" <?php if ($this->_tpl_vars['EDIT_T_SP__JENIS'] == '1'): ?>selected<?php endif; ?>>Surat Peringatan 1</OPTION>
                                                        <OPTION value="2" <?php if ($this->_tpl_vars['EDIT_T_SP__JENIS'] == '2'): ?>selected<?php endif; ?>>Surat Peringatan 2</OPTION>    
                                                        <OPTION value="3" <?php if ($this->_tpl_vars['EDIT_T_SP__JENIS'] == '3'): ?>selected<?php endif; ?>>Surat Peringatan 3</OPTION>
						</SELECT>
                                        </TD>
                        </TR>
                         <!-- SURAT PERINGATAN EDIT TAMBAH CABANG-->
                         <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 )): ?>
                         <TR>
                                <TD>Jenis Surat Peringatan <font color="#ff0000">*</font></TD> 
			
					<TD><SELECT name="sp_jenis">
							<OPTION value="">[Pilih Surat Peringatan]</OPTION>
							<OPTION value="1" <?php if ($this->_tpl_vars['EDIT_T_SP__JENIS'] == '1'): ?>selected<?php endif; ?>>Surat Peringatan 1</OPTION>
                                                        
						</SELECT>
                                        </TD>
                        </TR>
                        <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 ) && ( $this->_tpl_vars['EDIT_T_SP__JENIS'] == 1 )): ?>
                         <TR>
                                <TD>Jenis Surat Peringatan <font color="#ff0000">*</font></TD> 
			
					<TD><SELECT name="sp_jenis">
							<OPTION value="">[Pilih Surat Peringatan]</OPTION>
							<OPTION value="1" <?php if ($this->_tpl_vars['EDIT_T_SP__JENIS'] == '1'): ?>selected<?php endif; ?>>Surat Peringatan 1</OPTION>
						</SELECT>
                                        </TD>
                        </TR>
                        
                        <!-- SURAT PERINGATAN EDIT TAMBAH CABANG-->
                        <?php else: ?>
                         <TR>
                                <TD>Jenis Surat Peringatan <font color="#ff0000">*</font></TD> 
			
					<TD> <INPUT TYPE="text" name="sp_jenis" value="<?php echo $this->_tpl_vars['JENIS_SP']; ?>
" readonly="">
                                        </TD>
                        </TR>
                        
                         <?php endif; ?>  
                         
                    <!--1.PELANGGARAN PUSAT -->       
                    <?php if (( ( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) || ( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) )): ?>      
                    <TR>
                                <TD>Pelanggaran<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_pelanggaran"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__PELANGGARAN']; ?>
</textarea></TD>
                    </TR>
                       <!--2.PELANGGARAN CABANG TAMBAH -->  
                   <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 )): ?>   
                    <TR>
                                <TD>Pelanggaran<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_pelanggaran"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__PELANGGARAN']; ?>
</textarea></TD>
                    </TR>
                       <!--3.PELANGGARAN CABANG -->  
                     <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 ) && ( $this->_tpl_vars['EDIT_T_SP__JENIS'] == 1 )): ?>   
                      <TR>
                                <TD>Pelanggaran<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_pelanggaran"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__PELANGGARAN']; ?>
</textarea></TD>
                    </TR>
                     <!--4.PELANGGARAN CABANG -->  
                       <?php else: ?>   
                     <TR>
                                <TD>Pelanggaran<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_pelanggaran"  size="12" readonly=""><?php echo $this->_tpl_vars['EDIT_T_SP__PELANGGARAN']; ?>
</textarea></TD>
                    </TR>
                         <?php endif; ?>  
                        
                      <!--PELANGGARAN CLOSE -->  
                    
                        <!--ALASAN PUSAT -->       
                    <?php if (( ( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) || ( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 1 ) )): ?>   
                    <TR>
                                <TD>Alasan<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_alasan"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__ALASAN']; ?>
</textarea></TD>
                    </TR>
                       <!--2.PELANGGARAN CABANG TAMBAH -->  
                   <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 0 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 )): ?>
                    <TR>
                                <TD>Alasan<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_alasan"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__ALASAN']; ?>
</textarea></TD>
                    </TR>
                      <!--3.PELANGGARAN CABANG -->  
                     <?php elseif (( $this->_tpl_vars['EDIT_VAL'] == 1 ) && ( $this->_tpl_vars['JENIS_USER_SES'] == 2 ) && ( $this->_tpl_vars['EDIT_T_SP__JENIS'] == 1 )): ?>   
                       <TR>
                                <TD>Alasan<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_alasan"  size="12" ><?php echo $this->_tpl_vars['EDIT_T_SP__ALASAN']; ?>
</textarea></TD>
                    </TR>
                       <!--4.PELANGGARAN CABANG -->  
                       <?php else: ?>   
                       <TR>
                                <TD>Alasan<font color="#ff0000">*</font></TD> 
			
                                <TD><textarea rows="5" cols="20" NAME="sp_alasan"  size="12" readonly="" ><?php echo $this->_tpl_vars['EDIT_T_SP__ALASAN']; ?>
</textarea></TD>
                    </TR> 
                     <?php endif; ?>
                     
                    <TR><TD height="40"></TD>
                    <TD>
                    <INPUT TYPE="hidden" name="jenis_user" value="<?php echo $this->_tpl_vars['JENIS_USER_SES']; ?>
">    
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

					</TR>
                
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
                                    <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari" ></TD>
                            </TR>
                            <TR>
                                    <TD>Finger print</TD><TD><INPUT TYPE="text" NAME="finger_cari" ></TD>
                            </TR>
                            <TR>
							<TD>Periode</TD>
							<TD>						
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01">Januari</OPTION>
								<OPTION VALUE="02">Februari</OPTION>
								<OPTION VALUE="03">Maret</OPTION>
								<OPTION VALUE="04">April</OPTION>
								<OPTION VALUE="05">Mei</OPTION>
								<OPTION VALUE="06">Juni</OPTION>
								<OPTION VALUE="07">Juli</OPTION>
								<OPTION VALUE="08">Agustus</OPTION>
								<OPTION VALUE="09">September</OPTION>
								<OPTION VALUE="10">Oktober</OPTION>
								<OPTION VALUE="11">November</OPTION>
								<OPTION VALUE="12">Desember</OPTION>				 
                                                        </SELECT> 


							<SELECT name="tahun" > 
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
 							  <?php if (( $this->_sections['foo']['index'] ) == $this->_tpl_vars['TAHUN_SES']): ?>
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
		<tr><td class="tcat">Surat Peringatan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0">Daftar Surat Peringatan</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                    <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NIP </TH>
											<TH class="tdatahead" align="left" width="10%">NAMA</TH>                                                                                       
                                                                                        <TH class="tdatahead" align="left" >CABANG</TH>
											<TH class="tdatahead" align="left" >JABATAN</TH>                                                                                       
											<TH class="tdatahead" align="left" width="10%">TGL KELUAR SP</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">TGL BERAKHIR SP</TH>
                                                                                        <TH class="tdatahead" align="left">MASA BERLAKU</TH>
                                                                                        <TH class="tdatahead" align="left">PELANGGARAN</TH>
                                                                                        <TH class="tdatahead" align="left">ALASAN</TH>                                                                                      
                                                                                        <TH class="tdatahead" align="left">JENIS SP </TH>                                                                                
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
											<TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
                                                                                        <TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
 </TD>
                                                                                        <TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </TD>
											<TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </TD>                                                                                        
											<TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl']; ?>
</TD>	
                                                                                        <TD class="tdatacontent"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl_expired']; ?>
</TD>
                                                                                        <TD class="tdatacontent">  
                                                                                                <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['selisih'] <= 0 )): ?>
                                                                                                <font color="#035b09">Masih Berlaku</font>              
                                                                                              
                                                                                                 <?php else: ?>  
                                                                                                           <font color="#FF0000">Habis</font>     
                                                                                                <?php endif; ?> 
                                                                                        </TD>
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__pelanggaran']; ?>
  
                                                                                        <TD class="tdatacontent"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__alasan']; ?>
                                                                                           
                                                                                               
                                                                                        
                                                                                        <TD class="tdatacontent"> 
                                                                                          <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 1): ?>
                                                                                         <font color="#b27f31">Surat Peringatan 1</font>              
                                                                                                <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 2): ?>  
                                                                                                         <font color="#1f0ccc">Surat Peringatan 2</font>     
                                                                                                 <?php else: ?>  
                                                                                                           <font color="#FF0000">Surat Peringatan 3</font>     
                                                                                                <?php endif; ?> 
                                                                                        </TD>	                                                                                     
                                                                                          
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__no']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['DELETE']; ?>
" onclick="return checkDelete('engine.php?op=2&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__no']; ?>
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