<?php /* Smarty version 2.6.18, created on 2017-06-13 13:45:31
         compiled from defaults/modules/data_pegawai/penempatan//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/data_pegawai/penempatan//index.tpl', 396, false),)), $this); ?>
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
       buttons: ['excel'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
       select: {style: 'single'},
       Sorting: [[ 2, "desc" ]], 
       pageLength: "30", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 3,rightColumns:0}
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
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <?php if ($this->_tpl_vars['OPT'] == 1): ?> DISABLED <?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/details.gif" align="absmiddle"> <?php echo 'Penempatan Baru'; ?>
</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle">Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

        <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
        <tr><td class="tcat"> Data Penempatan</td></tr>
        </table>
        <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
        <tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
        <tr><td class="alt2" style="padding:0px;">

<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
<TABLE id="table-add-box">

            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
            <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
            <?php else: ?>
            <INPUT TYPE="hidden" NAME="id" value="<?php echo $this->_tpl_vars['EDIT_ID']; ?>
" size="35" readOnly class="text_disabled">
            <?php endif; ?>
            <TR>
            <TD>No Penempatan <font color="#ff0000">* Otomatis</font></TD>
            <TD>
                    <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                <div id="ajax_cek_id">
                    <INPUT  readonly=""  TYPE="text" name="r_pnpt__no_mutasi" size="35" value="<?php echo $this->_tpl_vars['ID_MUTASI_NEW']; ?>
"  OnChange="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?r_pnpt__no_mutasi='+frmCreate.r_pnpt__no_mutasi.value)">
                </DIV>
                   <?php else: ?>
                <div id="ajax_cek_id">
                    <INPUT readonly=""  TYPE="text" name="r_pnpt__no_mutasi" size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__NO_MUTASI']; ?>
" OnChange="JavaScript:Ajax('ajax_cek_id','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek.php?r_pnpt__no_mutasi='+frmCreate.r_pnpt__no_mutasi.value)">
                </DIV>
                    <?php endif; ?>
            </TD>
            </TR>
             <TR>
                    <TD>Cabang <font color="#ff0000">*</font></TD>
                    <TD><?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

                                                                                           <select name="kode_cabang" onchange="cari_subcab(this.value);">
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

                                                <SELECT name="kode_cabang" onchange="cari_subcab(this.value);">
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
                        <TD>Pilih Sub Cabang <font color="#ff0000">*</font></TD>
                        <TD>
                           <?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>
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
                                    <?php if (trim ( $this->_tpl_vars['DATA_SUBCABANG'][$this->_sections['x']['index']]['r_subcab__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__SUBCAB']): ?>
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
                                     <?php else: ?>
                                    <select name="kode_subcab_cari" >
                                    <option value="">[Pilih Sub Cabang]</option>
                                    <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_SUBCABANG_CARI']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <?php if (trim ( $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__SUBCAB']): ?>
                                    <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </option>
                                    <?php else: ?>
                                    <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </option>
                                    <?php endif; ?>
                                    <?php endfor; endif; ?>
                                    </select>
                                      <?php endif; ?>
                        </TD>
                </TR>
                <TR>
                        <TD>Departemen <font color="#ff0000">*</font></TD>
                            <TD>
                                        <select name="kode_departemen_new" onchange="cari_subdep(this.value);">
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
                                        <?php if (trim ( $this->_tpl_vars['DATA_DEPARTEMEN'][$this->_sections['x']['index']]['r_dept__id'] ) == $this->_tpl_vars['EDIT_R_DEPT__ID']): ?>
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
                           <TD>Sub Departemen <font color="#ff0000">*</font></TD>
                           <TD> <DIV id="ajax_subdep">
                                       <select name="kode_subdep" onChange="cari_jabatan(this.value);">
                                       <option value="">[Pilih Sub Departemen]</option>
                                       <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_SUBDEP']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_SUBDEP'][$this->_sections['x']['index']]['r_subdept__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__SUBDEPT']): ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_SUBDEP'][$this->_sections['x']['index']]['r_subdept__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_SUBDEP'][$this->_sections['x']['index']]['r_subdept__ket']; ?>
 </option>
                                       <?php else: ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_SUBDEP'][$this->_sections['x']['index']]['r_subdept__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_SUBDEP'][$this->_sections['x']['index']]['r_subdept__ket']; ?>
 </option>
                                       <?php endif; ?>
                                       <?php endfor; endif; ?>
                                       </select>
                               </DIV>

                           </TD>
                   </TR>
                    <TR>
                           <TD>Jabatan <font color="#ff0000">*</font></TD>
                           <TD><DIV id="ajax_jabatan">
                                       <select name="r_jabatan" >
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['r_jabatan__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__JABATAN']): ?>
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
                               </DIV>
                           </TD>
                   </TR>
                   
                        <TR>
                           <TD>Tipe Status Karyawan <font color="#ff0000">*</font></TD>
                           <TD>
                                 
                                <select name="r_pnpt__status" id="r_pnpt__status" onchange="cari_subpenempatan(this.value);">
                                       <option value="">[Pilih Status Karyawan]</option>
                                       <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_STATUS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['r_stp__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__STATUS']): ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['r_stp__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['r_stp__nama']; ?>
 </option>
                                       <?php else: ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['r_stp__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['r_stp__nama']; ?>
 </option>
                                       <?php endif; ?>
                                       <?php endfor; endif; ?>
                                       </select>
                                       
                                       
                              </TD>
                   </TR>
                   
                   
                   
                   <TR>
                    <td>Keterangan Penempatan <font color="#ff0000">*</font></td>
                    <td>
                        <DIV id="ajax_subpenempatan">
                        <select name="tipe_pdrm">
                                       <option value="">[Pilih Kontrak/MDRP]</option>
                                       <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TIPEPDRM']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                       <?php if (trim ( $this->_tpl_vars['DATA_TIPEPDRM'][$this->_sections['x']['index']]['tipe_penempatan__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__PDRM']): ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_TIPEPDRM'][$this->_sections['x']['index']]['tipe_penempatan__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_TIPEPDRM'][$this->_sections['x']['index']]['tipe_penempatan']; ?>
 </option>
                                       <?php else: ?>
                                       <option value="<?php echo $this->_tpl_vars['DATA_TIPEPDRM'][$this->_sections['x']['index']]['tipe_penempatan__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_TIPEPDRM'][$this->_sections['x']['index']]['tipe_penempatan']; ?>
 </option>
                                       <?php endif; ?>
                                       <?php endfor; endif; ?>
                                       </select>
                        </DIV>
                    </TD>
                    </TR>
                    <TR onclick="cek_jabatan()" >
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD >
                            <TD><INPUT TYPE="text" NAME="r_pegawai__nama" readonly  id="r_pegawai__nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PEGAWAI__NAMA']; ?>
" >
                                <INPUT TYPE="hidden" NAME="r_pegawai__id"  id="r_pegawai__id" size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PEGAWAI__ID']; ?>
" on ="ambil_data()">
                                <INPUT TYPE="hidden" NAME="r_pegawai__tgl_masuk" readonly id="r_pegawai__tgl_masuk" size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PEGAWAI__TGL_MASUK']; ?>
" >
                                <INPUT TYPE="hidden" NAME="pdrm__nip_new" readonly id="r_pnpt__nip" size="35" value="" >
                                    <?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>        
                                <INPUT  type="button" class="button" style="cursor: hand;"  onclick="goCarikaryawan(this.kode_cabang)" value="Cari nama"  />
                                   <?php elseif ($this->_tpl_vars['EDIT_VAL'] == 1 && $this->_tpl_vars['JENIS_USER_SES'] == 2): ?>
                                <INPUT  type="hidden" class="button" style="cursor: hand;"  onclick="goCarikaryawan(this.kode_cabang)" value="Cari nama"  />
                                  <?php else: ?>
                                <INPUT  type="button" class="button" style="cursor: hand;"  onclick="goCarikaryawan(this.kode_cabang)" value="Cari nama"  />
                                   <?php endif; ?>
                                <INPUT  type="button" class="button" style="cursor: hand;" value="cek jabatan"  />
                            </TD>

                    </TR>
                   <TR>
                           <TD>Tipe Salary</TD>
                           <TD>
                                <select name="r_pnpt__tipe_salary" >
                                   <OPTION value="">[Pilih Tipe Salary]</option>
                                   <OPTION value="1" <?php if ($this->_tpl_vars['EDIT_R_PNPT__TIPE_SALARY'] == '1'): ?> selected <?php endif; ?> >Transfer</OPTION>
                                   <OPTION value="0" <?php if ($this->_tpl_vars['EDIT_R_PNPT__TIPE_SALARY'] == '0'): ?> selected <?php endif; ?>>Tunai</OPTION>
                                </select>
                              </TD>
                   </TR>
                   <TR>
                            <TD>Tgl Effektif  <font color="#ff0000">*</font></TD>
                            <TD>
                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <input readonly="" type="text" NAME="tgl_sk" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_sk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <?php else: ?>
                            <input readonly="" type="text" name="tgl_sk" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['EDIT_TGL_SK'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" >
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_sk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <?php endif; ?>


                            </TD>
                    </TR>

                    <TR>
                            <TD>Tgl Kontrak Awal  <font color="#ff0000">*</font></TD>
                            <TD>
                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <input  type="text" readonly="" NAME="r_pnpt__kon_awal" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__KON_AWAL']; ?>
">
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <?php else: ?>
                            <input type="text" readonly=""  name="r_pnpt__kon_awal" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__KON_AWAL']; ?>
" >
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <?php endif; ?>
                            </TD>
                    </TR>

                    <TR>
                            <TD>Tgl Kontrak Akhir  <font color="#ff0000">*</font></TD>
                            <TD>
                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <input readonly=""  type="text" NAME="r_pnpt__kon_akhir" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__KON_AKHIR']; ?>
">
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                            <?php else: ?>
                            <input readonly=""  type="text" name="r_pnpt__kon_akhir" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__KON_AKHIR']; ?>
" >
                                                     <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                            <?php endif; ?>


                            </TD>
                    </TR>
                    
                    <TR>
                        <TD >Kode Finger Print <font color="#ff0000">*</font></TD>
                        <TD>

                            <?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                            <DIV id="ajax_cek_id2">
                            <INPUT   TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__FINGER_PRINT']; ?>
"  OnChange="JavaScript:Ajax('ajax_cek_id2','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)">
                            <INPUT  type="button" class="button" style="cursor: hand;"  onclick="JavaScript:Ajax('ajax_cek_id2','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)" value="Cek Finger"  />
                            </DIV>
                                    <?php else: ?>
                            <DIV id="ajax_cek_id2">
                            <INPUT   TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" size="35" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__FINGER_PRINT']; ?>
" OnChange="JavaScript:Ajax('ajax_cek_id2','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)">
                            <INPUT  type="button" class="button" style="cursor: hand;"  onclick="JavaScript:Ajax('ajax_cek_id2','<?php echo $this->_tpl_vars['HREF_HOME_PATH_AJAX']; ?>
/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)" value="Cek Finger"  />
                            </DIV>
                                <?php endif; ?>
                           <!-- <INPUT TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" value="EDIT_R_PNPT__FINGER_PRINT">-->
                       
                        </TD>
                    </TR>

                    <TR>
                        <TD>Pilih Shift <font color="#ff0000">*</font></TD>
                            <TD>
                                        <select name="r_pnpt__shift" >
                                        <option value="">[Pilih Shift]</option>
                                        <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_SHIFT']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <?php if (trim ( $this->_tpl_vars['DATA_SHIFT'][$this->_sections['x']['index']]['r_shift__id'] ) == $this->_tpl_vars['EDIT_R_PNPT__SHIFT']): ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_SHIFT'][$this->_sections['x']['index']]['r_shift__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_SHIFT'][$this->_sections['x']['index']]['r_shift__ket']; ?>
 </option>
                                        <?php else: ?>
                                        <option value="<?php echo $this->_tpl_vars['DATA_SHIFT'][$this->_sections['x']['index']]['r_shift__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_SHIFT'][$this->_sections['x']['index']]['r_shift__ket']; ?>
 </option>
                                        <?php endif; ?>
                                        <?php endfor; endif; ?>
                                        </select>
                            </TD>
                    </TR>
                    <TR>
                        <TD>Area Kerja <font color="#ff0000">*</font> </TD>
                            <TD>
                                <TEXTAREA name="areakerja" rows="5" cols="50"><?php echo $this->_tpl_vars['EDIT_AREA_KERJA']; ?>
</TEXTAREA>
                            </TD>
                    </TR>
                    
                     <TR>
                        <TD>Aktivasi Karyawan <font color="#ff0000">*</font> </TD>
                            <TD>
                                        <SELECT name="r_pnpt__aktif">
                                        <OPTION value="">[Pilih Status]</option>
                                        <OPTION value="1" <?php if ($this->_tpl_vars['EDIT_R_PNPT__AKTIF'] == '1'): ?> selected <?php endif; ?> >Aktif</OPTION>
                                        </SELECT>
                            </TD>
                    </TR>
                    <INPUT TYPE="hidden" name="r_pnpt__nip" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__NIP']; ?>
">
                    <INPUT TYPE="hidden" name="r_pnpt__id_pegawai" value="<?php echo $this->_tpl_vars['EDIT_R_PNPT__ID_PEGAWAI']; ?>
">

          <TR><TD height="40"></TD>
	<TD>
	<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
	<INPUT TYPE="hidden" name="limit2" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
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
	<TR><td colspan="2"><font color="#ff0000">Catatan: </font></td></tr>
    <TR><td colspan="2"><font color="#ff0000">
	<li>Untuk simbol(Bintang)* Wajib Diisi</li>
	<li>Untuk Cabang Terkait Mutasi,Rotasi,Promosi Atau Pegawai Menjadi Tetap lakukan Pengajuan Di Modul Klarifikasi MDRP </li></font></td></tr>
</TABLE>
 </form>
</td></tr>
</table>


<DIV align="center" id="ajax_cekjabatan">

</DIV>

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
                <TD>Cabang <font color="#ff0000">*</font></TD>
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
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_SUBCABANG_CARI']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                                            <?php if (trim ( $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id'] ) == 0): ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
 </option>
                                                                            <?php else: ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_SUBCABANG_CARI'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
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
                                      <TD>Level Karyawan</TD>
                                      <TD>
                                                  <select name="level_cari" >
                                                  <option value="">[Pilih Level Karyawan]</option>
                                                  <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_LEVEL']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                  <?php if (trim ( $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['r_level__id'] ) == 0): ?>
                                                  <option value="<?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['r_level__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['r_level__ket']; ?>
 </option>
                                                  <?php else: ?>
                                                  <option value="<?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['r_level__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['r_level__ket']; ?>
 </option>
                                                  <?php endif; ?>
                                                  <?php endfor; endif; ?>
                                                  </select>
                                      </TD>
                           </TR>
                           <TR>
                                       <TD>Status Pegawai</TD>
                                       <TD>
                                            <select name="sts_pegawai" >
                                                    <option value="">[Pilih Status pegawai]</option>
                                                    <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_STS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                    <?php if (trim ( $this->_tpl_vars['DATA_STS'][$this->_sections['x']['index']]['r_stp__id'] ) == 0): ?>
                                                    <option value="<?php echo $this->_tpl_vars['DATA_STS'][$this->_sections['x']['index']]['r_stp__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_STS'][$this->_sections['x']['index']]['r_stp__nama']; ?>
 </option>
                                                    <?php else: ?>
                                                    <option value="<?php echo $this->_tpl_vars['DATA_STS'][$this->_sections['x']['index']]['r_stp__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_STS'][$this->_sections['x']['index']]['r_stp__nama']; ?>
 </option>
                                                    <?php endif; ?>
                                                    <?php endfor; endif; ?>
                                            </select>
                                       </TD>
                            </TR>

                            <TR><TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari"></TD></TR>
                            <TR><TD>NIP</TD><TD><INPUT TYPE="text" NAME="r_pnpt__nip_cari" ></TD></TR>
                            <TR>
                            <TD>ID Finger Print </TD><TD><INPUT TYPE="text" NAME="finger_pegawai_cari" ></TD>
                            </TR>

                        <TR>
							<TD>Akhir Kontrak</TD>
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
 							  <?php if (( $this->_sections['foo']['index'] ) == 0): ?>
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
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
				<INPUT TYPE="hidden" name="limit2" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
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
		<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Daftar Penempatan</td></tr>
		</TABLE>
		<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Daftar Penempatan</td></tr>
		<tr><td class="alt2" style="padding:0px;">
	<table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
        <thead class="tdatahead">
            <tr>
            <TH class="alt2" align="left">NO</TH>
            <TH class="alt2"  align="left">NAMA</TH>
            <TH class="alt2" align="left">NIP</TH>
            <TH class="alt2" align="left" >ID FINGER</TH>
            <TH class="alt2" align="left">DEPARTEMEN</TH>
            <TH class="alt2" align="left" >JABATAN</TH>
            <TH class="alt2" align="left" >LEVEL</TH>
            <TH class="alt2" align="left" >CABANG</TH>
            <TH class="alt2" align="left">SUB CABANG</TH>
            <TH class="alt2" align="left">STATUS KARYAWAN</TH>
            <TH class="alt2" align="left">MULAI MASUK</TH>
            <TH class="alt2" align="left">AWAL KONTRAK</TH>
            <TH class="alt2" align="left">AKHIR KONTRAK</TH>
          
            <TH class="alt2" ><?php echo $this->_tpl_vars['ACTION']; ?>
</th>
            </tr>
        </thead>
        <tbody class="tdatacontent">
            
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
			<tr>
                        <TD> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>
                        <TD> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_dept__ket']; ?>
  </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_level__ket']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
</TD>
                        <TD > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__nama']; ?>
 </TD>
                        <TD > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__tgl_masuk'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</TD>
                        <TD ><?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                                 <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__kon_awal'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 
                             <?php else: ?>Tetap<?php endif; ?></TD>
                        <TD > <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                              <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__kon_akhir'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>

                             <?php else: ?>
                               Tetap
                              <?php endif; ?>
                              
                       <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['warning'] ) == '1' && ( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                        <br><font color="#b71010"><b>Akan Segera Habis</b></font>
                       <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['warning'] ) == '11' && ( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                       <br> <font color="#ea4402"><b>Kontrak Akan Habis 1-Bulan lagi</b></font>
                        <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['warning'] ) == '12' && ( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                       <br> <font color="#d870ad"><b>Kontrak Akan Habis 2-Bulan lagi</b></font>
                         <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['warning'] ) == '13' && ( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                       <br> <font color="#c45f36"><b>Kontrak Akan Habis 3-Bulan lagi</b></font>
                         <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['warning'] ) >= '201' && ( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                       <br> <font color="#ff0000"><b>Sudah Habis</b></font>
                       
                        <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_stp__id'] ) < 4): ?>
                        <br> <font color="#4286f4"><b>Masih Berjalan</b></font>
                       <?php endif; ?></TD>
                        
              
                      <TD>
                          <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__no_mutasi']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink">
                      &nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['DELETE']; ?>
" onclick="return checkDelete('engine.php?op=2&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__no_mutasi']; ?>
 &mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink">
                      </TD>
                     
                </TR>
                <?php endfor; else: ?>
                <TR>
                        <TD  COLSPAN="14" align="center">Maaf, Data masih kosong</TD>
                </TR>
			<?php endif; ?>
			</TBODY>
		</table>
<div id="panel-footer">
    <!--halaman -->
                   
    <!--halaman -->
</div></td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans">
        <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png">
        </div>

	</DIV>
</BODY>
</HTML>