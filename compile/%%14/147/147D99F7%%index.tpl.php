<?php /* Smarty version 2.6.18, created on 2017-06-05 14:23:19
         compiled from defaults/modules/kehadiran/rekap_verifikasi_hrd//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'defaults/modules/kehadiran/rekap_verifikasi_hrd//index.tpl', 280, false),array('modifier', 'date_format', 'defaults/modules/kehadiran/rekap_verifikasi_hrd//index.tpl', 452, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<STYLE>{
    {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

ul, ol {
    list-style-type: none;
}
p, label {
   // background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
    color: #083772;
    font-size: 12px;
    
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

pre.code {
    border: 1px solid #999;
    background-color: #FF9;
    padding: 1em;
    margin: 0;
}

input.time-hh-mm {
    border: 1px solid #929aa9;
    font-size: 12px;
    width: 55px;
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

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/jquery.dataTables.min-right.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/fixedColumns.dataTables.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/buttons.dataTables.min.css" type="text/css">	  
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/jquery-1.12.4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/jquery.dataTables.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/dataTables.fixedColumns.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/dataTables.buttons.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/buttons.colVis.min.js"></SCRIPT>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/style_sorting.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/script_sorting.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/script_p.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/buttons.flash.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/jszip.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/pdfmake.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/vfs_fonts.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/buttons.html5.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/buttons.print.min.js"></SCRIPT>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/select.dataTables.min.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/js/dataTables.select.min.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->


<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "430",
        scrollX:        true,
        scrollCollapse: true,
        info:true,
       // paging: true,  
         dom: 'Bfrtip',
        buttons: ['excel','copy'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
          pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 4,rightColumns:1 }

        });
        
} );
$(document).ready(function() {
    var table = $('#example2').DataTable( {
        scrollY:        "430",
        scrollX:        true,
        scrollCollapse: true,
        info:true,
        paging: false,  
     //    dom: 'Bfrtip',
     //   buttons: ['copy'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
        //  pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
     fixedColumns:   { leftColumns: 3,rightColumns:0 }

        });
        
} );
</script>

<STYLE>
/* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {width: 1100;margin: 0 auto;}
    .number_range_filter{width:100px;}
    
      div.ColVis {
        float: centerPage;
    }
  </STYLE>
</HEAD>

<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
<!--tombol_tambah -->
<div id="add-search-box">
<?php if ($this->_tpl_vars['OPT'] == 0): ?>       
 
<a class="button" href="#" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__no_mutasi']; ?>
&tahun=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__thn']; ?>
&bulan=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__bln']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');"<?php if ($this->_tpl_vars['OPT'] == 1): ?> DISABLED <?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/details.gif" align="absmiddle"> <?php echo $this->_tpl_vars['BTN_VERIFIKASI']; ?>
</span></a>    
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>     
   <?php endif; ?>    
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">   
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="100%" >
<tr><td class="tcat" colspan="22">
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
</td></tr></TABLE>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
<tr><td class="tcat"> Verifikasi Rekap Data Kehadiran Oleh HRD</td></tr>
</table>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0"> Rekap Data Kehadiran Oleh HRD</td></tr>
<tr><td class="alt2" style="padding:0px;">

<table id="example2" class="display" cellpadding="6" cellspacing="1" width="100%">
<thead class="tdatahead">
        <tr>
                <th  class="alt2"  align="left">NO</TH>
                <th class="alt2"  align="center">ID FINGER</TH>
                <th  class="alt2" align="center">NAMA</TH>											
                <th  class="alt2"  align="center" >CABANG</TH>
                <th  class="alt2"  align="center" >SUB CABANG</TH>
                <th  class="alt2"  align="center" >DEPARTEMEN</TH>
                <th  class="alt2"  align="center" >JABATAN</TH>
                <th  class="alt2"  align="center" >AWAL</TH>
                <th  class="alt2"  align="center" >AKHIR</TH>
                <th  class="alt2"  align="center" >MAKS HK</TH>
                 <th  class="alt2"  align="center" >STATUS AKTIF</TH>
                <th  class="alt2"  align="center" >APPROVAL STATUS</TH>
               
                <th  class="alt2"  align="center" >HADIR</TH>
                <th  class="alt2"  align="center" >SAKIT</TH>
                <th  class="alt2"  align="center" >IZIN</TH>
                <th  class="alt2"  align="center" >ALPA</TH>
                <th  class="alt2"  align="center" >DINAS</TH>
                <th  class="alt2"  align="center" >CUTI</TH>
                <th  class="alt2"  align="center" >KETERANGAN</TH>
             
        </tr>
</thead>
<tbody class="tdatacontent">
<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_RKP']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<TD><?php echo $this->_sections['x']['index']+1; ?>
.</TD>
<TD align="center"> <?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
<TD align="center"> <?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
  </TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </TD> 
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_dept__ket']; ?>
 </TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__awal']; ?>
</TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__akhir']; ?>
 </TD>
<TD align="center"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['mx_day']; ?>
 
    <input type="hidden"  name="mutasi[]" value="<?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['r_pnpt__no_mutasi']; ?>
">
<INPUT type="hidden" name="awal[]" value="<?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__awal']; ?>
" >
<input type="hidden" name="akhir[]" value="<?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__akhir']; ?>
">
<input type="hidden" name="status[]" value="<?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval']; ?>
">
<input type="hidden" name="akhir[]" value="<?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__akhir']; ?>
">
</TD>
<TD align="center">
<?php if (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['ket_keluar'] ) == 0): ?>Aktif<?php else: ?>  <font color="#ff0000">Resign</font>
                    <?php endif; ?>  </TD>
<TD align="center"  >  
<?php if (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 1): ?>
Telah disetujui HRD
<?php elseif (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 2 && $this->_tpl_vars['JENIS_USER_SES'] != '1'): ?>
<font color="green">Telah disetujui BOM</font>
<?php elseif (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 2 && $this->_tpl_vars['JENIS_USER_SES'] == '1'): ?>
<font color="green"> Telah disetujui Koordinator</font>
<?php elseif (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 3): ?>  
<font color="#1384a0">Telah disetujui HGLM</font>
<?php elseif (( $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 4): ?>  
<font color="#d15e93">Closing</font>
<?php else: ?>  
<font color="#ff0000">Kehadiran Kosong</font>
<?php endif; ?>

</TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="hadir[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__hadir'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="sakit[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__sakit'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="izin[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__izin'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="alpa[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__alpa'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"> </TD>
<TD align="left"><input  maxlength="2" size="2" type="text" name="dinas[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__dinas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="left"><input maxlength="2" size="2" type="text" name="cuti[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__cuti'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"></TD>
<TD align="center"  > 
<textarea name="keterangan[]" cols="5" rows="1"><?php echo $this->_tpl_vars['DATA_RKP'][$this->_sections['x']['index']]['t_rkp__keterangan']; ?>
</textarea>

</TD>

              
                

        </TR>
        <?php endfor; else: ?>
        <TR>
                <TD  COLSPAN="16" align="center">Maaf, Data masih kosong</TD>
        </TR>
<?php endif; ?>
</tbody>
</table>

                       
             
		</td></tr>
		</table>		
</form>

		</DIV>
		
<!--form_tambah_tutup-->                              	
<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">
<!--form_cari--> 
<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">	
                    
		<TR>
                                <TD>Cabang <font color="#ff0000">*</font></TD> 
				<TD>
					<?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

								<select name="kode_perwakilan_cari" onchange="cari_subcab(this.value);">
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

					<select name="kode_perwakilan_cari  >
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
							
							
							
                                                        
                        <TR><TD>Nama Karyawan </TD><TD><INPUT TYPE="text" NAME="nama_karyawan_cari" size="30"></TD></TR>
                        <TR><TD>ID Finger </TD><TD><INPUT TYPE="text" NAME="id_finger_cari" size="30"></TD></TR>
                        <TR>
                            <TD>Jabatan</TD>
                            <TD>
                             <?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>
                                        <select name="jabatan_cari" >
                                        <option value="">[Pilih Jabatan]</option>
                                        <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_JABATAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <?php if (trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id'] ) == 0): ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </option>
                                        <?php else: ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </option>
                                        <?php endif; ?>
                                        <?php endfor; endif; ?>
                                        </select> 

                                    <?php else: ?>
                                     <select name="jabatan_cari" >
                                        <option value="">[Pilih Jabatan]</option>
                                        <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_JABATAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <?php if (trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id'] ) == 0 && trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__kategori_cabang'] ) == 2): ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </option>
                                        <?php else: ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </option>
                                        <?php endif; ?>
                                        <?php endfor; endif; ?>
                                        </select> 
                                             <?php endif; ?>
                            </TD>
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
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
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
		<tr><td class="tcat">Verifikasi Rekap Data Kehadiran HRD</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Periode aktif  Mulai : <?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AWAL'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
 s/d <?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AKHIR'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
 </td></tr>
                        <tr><td class="alt2" style="padding:0px;">
                    
             
		
<table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
<thead class="tdatahead">
                    
                        <TR>
                                <th class="alt2">NO</TH>
                                <th class="alt2">ID FINGER</TH>
                                <th class="alt2">NAMA</TH>											
                                <th class="alt2" align="center">CABANG</TH>
                                <th class="alt2" align="center">SUB CABANG</TH>
                                <th class="alt2" align="center">DEPARTEMEN</TH>
                                 <th class="alt2" align="center">JABATAN</TH>
                                <th class="alt2" align="center">PERIODE AWAL</TH>
                                <th class="alt2" align="center">PERIODE AKHIR</TH>
                                <th class="alt2" align="center">STATUS AKTIF</TH>
                                <th class="alt2" align="center">APPROVAL STATUS</TH>
                                <th class="alt2" align="center">HADIR</TH>
                                <th class="alt2" align="center">SAKIT</TH>
                                <th class="alt2" align="center">IZIN</TH>
                                <th class="alt2" align="center">ALPA</TH>
                                <th class="alt2" align="center">DINAS</TH>
                                <th class="alt2" align="center">CUTI</TH>
                                <th class="alt2" align="center">KETERANGAN</TH>
											
			</TR>
			</thead>
			<tbody class="tdatacontent" >
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
			<tr >
                                <TD> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>
                                <TD><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
                                <TD><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
  </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
  </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </TD> 
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_dept__ket']; ?>
 </TD>
                                 <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__awal']; ?>
</TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__akhir']; ?>
 </TD>
                                 <TD align="center"  >
                   <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['ket_keluar'] ) == 0): ?>Aktif<?php else: ?>  <font color="#ff0000">Resign</font>
                    <?php endif; ?>  </TD>
                                <TD>   
                                <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 1): ?>
                                Telah disetujui HRD
				<?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 2 && $this->_tpl_vars['JENIS_USER_SES'] != '1'): ?>
				<font color="green">Telah disetujui BOM</font>
				<?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 2 && $this->_tpl_vars['JENIS_USER_SES'] == '1'): ?>
				<font color="green"> Telah disetujui Koordinator</font>
				<?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 3): ?>  
                                <font color="#1384a0">Telah disetujui HGLM</font>
                                <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__approval'] ) == 4): ?>  
                                      <font color="#d15e93">Closing</font>
                               <?php else: ?>  
                                            <font color="#ff0000">Kehadiran Kosong</font>
                                <?php endif; ?>
                                </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__hadir']; ?>
 </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__sakit']; ?>
 </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__izin']; ?>
 </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__alpa']; ?>
 </TD>
                                <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__dinas']; ?>
 </TD>
                                 <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__cuti']; ?>
 </TD>
                                 <TD> 

                                   <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__keterangan'] ) == 'KURANG'): ?>
                                      <font color="#ff0000"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__keterangan']; ?>
</font>
                                   <?php else: ?>
                                      <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_rkp__keterangan']; ?>
   
                                    <?php endif; ?>


                                 </TD>

                        </TR>
                        <?php endfor; else: ?>
                        <TR>
                                <TD  COLSPAN="16" align="center">Maaf, Data masih kosong</TD>
                        </TR>
			<?php endif; ?>
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->
 
    <!--halaman -->
</div>       </td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>