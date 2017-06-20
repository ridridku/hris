<?php /* Smarty version 2.6.18, created on 2017-06-06 09:46:50
         compiled from defaults/modules/pelaporan/lap_payroll/payroll_result/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/pelaporan/lap_payroll/payroll_result/index.tpl', 305, false),array('modifier', 'number_format', 'defaults/modules/pelaporan/lap_payroll/payroll_result/index.tpl', 508, false),)), $this); ?>
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
/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/global.js"></SCRIPT>

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/jquery.dataTables.min.css" type="text/css">
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


<script>
 $(document).ready(function() {
    var table = $('#example').DataTable( {
         searching: true,
          dom: 'Bfrtip',
        buttons: [
           'excel', 'print'
        ],
       ordering:false,
        paging: false,
        info:false,
        fixedHeader: {
        header: true,
        footer: true},
    select: {style: 'multi'},  language: {search: "Pencarian:"}
    } );
    
    
} );

$(document).ready(function() {
    var table = $('#payroll').DataTable( {
       
        scrollY:        "470",
        scrollX:        true,
        scrollCollapse: true,
       
        ordering:true,
        paging:         false,
        searching: true,
        info:false,
        language: {search: "Pencarian:"},
           select: {style: 'multi'},
    } );   

   
} );

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("payroll").deleteRow(i);
}
</script>
<STYLE>
	/* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
       margin-bottom: 0.5em;  
    }
 
    div.ColVis {
        float: centerPage;
    }
  </STYLE>
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
<?php if ($this->_tpl_vars['NAMA_CABANG'] <> ""): ?>
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
		<TABLE id="table-search-box" > 
                <TR>
                    <TD>Cabang <font color="#ff0000">*</font></TD> 
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
                                                                <TD>Jenis Level <font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                            <select name="jenis_cari" >
                                                                            <option value="">[Pilih Jenis]</option>
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
                                                                            <?php if (trim ( $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['r_level__id'] ) == 0): ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['r_level__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['r_level__ket']; ?>
 </option>
                                                                            <?php else: ?>
                                                                            <option value="<?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['r_level__id']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JENIS'][$this->_sections['x']['index']]['r_level__ket']; ?>
 </option>
                                                                            <?php endif; ?>
                                                                            <?php endfor; endif; ?>
                                                                            </select> 
                                                                </TD>
                                                         </TR>
                                                            <TR>
                                                                <TD>Jabatan <font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                            <select name="jenis_cari" >
                                                                            <option value="">[Pilih Jenis]</option>
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
                                                                </TD>
                                                         </TR>
                                                          <TR>
                                                                <TD>Status<font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                            <select name="status_cari" >
                                                                            <option value="">[Pilih Status]</option>
                                                                            <option value="1">Masih Aktif</option>
                                                                            <option value="2">Resign</option>
                                                                          
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
                                                                <TD>Finger Print</TD>
                                                                        <TD>
                                                                            <INPUT TYPE="text" NAME="finger_cari" value=""  id="finger_cari"  size="35" > 
                                                                        </TD>
							</TR>
   
                                                        <TR>
							<TD>Periode Awal</TD>
							<TD>
                                                        <SELECT NAME="tgl1" > 
                                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                                        <?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)1;
$this->_sections['foo']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                                  <?php if (( $this->_sections['foo']['index'] ) == ((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d"))): ?>
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
							<SELECT name="bulan1"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 1): ?>selected<?php endif; ?>>Januari</OPTION>
								<OPTION VALUE="02"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 2): ?>selected<?php endif; ?>  >Februari</OPTION>
								<OPTION VALUE="03"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 3): ?>selected<?php endif; ?>  >Maret</OPTION>
								<OPTION VALUE="04"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 4): ?>selected<?php endif; ?>  >April</OPTION>
								<OPTION VALUE="05"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 5): ?>selected<?php endif; ?> >Mei</OPTION>
								<OPTION VALUE="06"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 6): ?>selected<?php endif; ?>  >Juni</OPTION>
								<OPTION VALUE="07"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 7): ?>selected<?php endif; ?>  >Juli</OPTION>
								<OPTION VALUE="08"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 8): ?>selected<?php endif; ?>  >Agustus</OPTION>
								<OPTION VALUE="09"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 9): ?>selected<?php endif; ?>  >September</OPTION>
								<OPTION VALUE="10"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 10): ?>selected<?php endif; ?>  >Oktober</OPTION>
								<OPTION VALUE="11"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 11): ?>selected<?php endif; ?>  >November</OPTION>
								<OPTION VALUE="12"<?php if (((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 12): ?>selected<?php endif; ?>  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun1" > 
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
 							  <?php if (( $this->_sections['foo']['index'] ) == ((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y"))): ?>
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
                                        <TD>Periode Akhir</TD>
                                        <TD>
                                        <SELECT NAME="tgl2" > 
                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                        <?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)1;
$this->_sections['foo']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <?php if (( $this->_sections['foo']['index'] ) == ((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d"))): ?>
                                        <option value="<?php echo $this->_sections['foo']['index']; ?>
"  selected><?php echo $this->_sections['foo']['index']; ?>
</option>
                                        <?php else: ?>
                                        <option value="<?php echo $this->_sections['foo']['index']; ?>
"><?php echo $this->_sections['foo']['index']; ?>
</option>
                                        <?php endif; ?> 
                                        <?php endfor; endif; ?>
                                        </SELECT> 
					<SELECT name="bulan2"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 1): ?>selected<?php endif; ?>>Januari</OPTION>
								<OPTION VALUE="02"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 2): ?>selected<?php endif; ?>  >Februari</OPTION>
								<OPTION VALUE="03"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 3): ?>selected<?php endif; ?>  >Maret</OPTION>
								<OPTION VALUE="04"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 4): ?>selected<?php endif; ?>  >April</OPTION>
								<OPTION VALUE="05"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 5): ?>selected<?php endif; ?> >Mei</OPTION>
								<OPTION VALUE="06"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 6): ?>selected<?php endif; ?>  >Juni</OPTION>
								<OPTION VALUE="07"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 7): ?>selected<?php endif; ?>  >Juli</OPTION>
								<OPTION VALUE="08"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 8): ?>selected<?php endif; ?>  >Agustus</OPTION>
								<OPTION VALUE="09"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 9): ?>selected<?php endif; ?>  >September</OPTION>
								<OPTION VALUE="10"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 10): ?>selected<?php endif; ?>  >Oktober</OPTION>
								<OPTION VALUE="11"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 11): ?>selected<?php endif; ?>  >November</OPTION>
								<OPTION VALUE="12"<?php if (((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == 12): ?>selected<?php endif; ?>  >Desember</OPTION>				 
                                        </SELECT> 
						<SELECT NAME="tahun2" > 
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
 							  <?php if (( $this->_sections['foo']['index'] ) == ((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y"))): ?>
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
				
                                </TD>
                                </TR>
                                    
                                
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
		<tr><td class="tcat">LAPORAN REKAP PAYROLL </td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%" >
		<TR>
		<TD COLSPAN="2">
				<table width="100%" class="tbheader" border=0>	
				<?php if (( $this->_tpl_vars['NAMA_CABANG'] != '' )): ?>
											<tr><td class="tdatacontent"  width="100" >CABANG</td><td width="5"> : </td><td colspan="2"><?php echo $this->_tpl_vars['NAMA_CABANG']; ?>
 &nbsp;</td></tr>
				<?php endif; ?>
                            

				<?php if (( $this->_tpl_vars['PRE_ACTIVE'] != '' || $this->_tpl_vars['END_ACTIVE'] != '' )): ?>


											<tr><td class="tdatacontent"  >PERIODE </td><td> : </td><td>
																			
											<?php echo ((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
 &nbsp; s/d &nbsp;  <?php echo ((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
</td></tr>
				<?php endif; ?>
				
				</table></TD></TR>
                                <TR>
									<TD COLSPAN="2"></TD> 
										  
								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>
										<!--<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">-->	
                                                                                    <table id="payroll" class="display" cellpadding="4" cellspacing="6" width="100%" >
										<THEAD>									 
										<TR>
                                                                                    <TH  align="left">NO</TH>
                                                                                    <TH  align="left">NIP</TH>
                                                                                    <TH  align="left">IDFINGER </TH>   
                                                                                    <TH  align="left">NAMA</TH>
                                                                                    <TH  align="left">CABANG</TH>
                                                                                    <TH  align="left">SUBCABANG</TH>
                                                                                    <TH  align="left">DEPARTEMEN</TH>
                                                                                    <TH  align="left">COST CENTRE</TH>
                                                                                    <TH  align="left">LEVEL</TH>
                                                                                    <TH  align="left">JABATAN</TH>
                                                                                    <TH  align="left">TGL MASUK</TH>
                                                                                    <TH  align="left">LAMA KERJA (BLN)</TH>
                                                                                    <TH  align="left">KEHADIRAN</TH>
                                                                                    <TH  align="left">STATUS</TH>
                                                                                    <TH  align="left">GAPOK</TH>
                                                                                    <TH  align="left">T.JABATAN</TH>
                                                                                    <TH  align="left">T.TRANS</TH>
                                                                                    <TH  align="left">T.MAKAN</TH>
                                                                                    <TH  align="left">T.KOST</TH>
                                                                                    <TH  align="left">T.LAIN</TH>
                                                                                    <TH  align="left">T.KEMAHALAN</TH>
                                                                                    <TH  align="left">DASAR BPJS</TH>
                                                                                    <TH  align="left">BPJS TK TMW</TH>
                                                                                    <TH  align="left">BPJS TK PEG</TH>
                                                                                    <TH  align="left">BPJS KES TMW</TH>  
                                                                                    <TH  align="left">BPJS KES PEG</TH>
                                                                                    <TH  align="left">ANGSURAN</TH>
                                                                                    <TH  align="left">ROUND</TH>
                                                                                    <TH  align="left">NO REKENING</TH>
                                                                                    <TH  align="left">NAMA DI BANK</TH>
                                                                                    <TH  align="left">IDR</TH>
                                                                                       <TH  align="left">NOMINAL</TH>
                                                                                    <TH  align="left">BANK</TH>
                                                                                  
                                                                       
                                                                                    
                                                                                     
										</TR>										 
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
										<TR onmouseover="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'over', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'out', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <?php echo $this->_tpl_vars['INITSET'][$this->_sections['x']['index']]; ?>
, 'click', '<?php echo $this->_tpl_vars['ROW_CLASSNAME'][$this->_sections['x']['index']]; ?>
', '#CCFFCC', '#FFCC99');">
                                                                                    <TD width="17" class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>  
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
 </TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pnpt__finger_print']; ?>
 </TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
 </TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
</TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
</TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_dept__ket']; ?>
</TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cc__ket']; ?>
</TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_level__ket']; ?>
</TD>
                                                                                    <TD align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</TD>
                                                                                    
                                                                                    <TD  ><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__tgl_masuk'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%b-%Y") : smarty_modifier_date_format($_tmp, "%d-%b-%Y")); ?>
</TD>
                                                                                    <TD ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['lama_bln']; ?>
 Bln</TD>
                                                                                    <TD ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__hadir']; ?>
</TD>
                                                                                    <TD >
                                                                                    <?php if ($this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__status_resign'] == 0): ?>
                                                                                    <font style="color: #006600">MASIH AKTIF</font>
                                                                                    <?php else: ?>
                                                                                    <font style="color: #ff0000">KELUAR</font
                                                                                    <?php endif; ?>
                                                                                    </TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__gapok']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__tunj_jabatan']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__transport']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__makan']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__lain1']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__lain2']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__kemahalan']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__dasarbpjs']; ?>
</TD><!-- dasar_bpjs -->
                                                                                    <TD  align=" right"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__dasarbpjs']*0.0424)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- bpjs TK TMW -->
                                                                                    <TD  align=" right"><font color="#2200ff"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__dasarbpjs']*0.02)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</font></TD><!-- bpjs TK karyawan -->
                                                                                    <TD  align=" right"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__dasarbpjs']*0.040)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- bpjs kes TMW -->
                                                                                    <TD  align=" right"><font color="#2200ff"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__dasarbpjs']*0.010)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</font></TD><!-- bpjs kes karyawan --> 
                                                                                    <TD  align=" right"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__angsuran'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD>
                                                                                    <TD  align=" right"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__netto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__bank1_norek']; ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__bank1_rek']; ?>
</TD>
                                                                                     <TD  align=" right">IDR</TD>
                                                                                    <TD  align=" right"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_gaji__netto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD>
                                                                                    <TD  align=" right"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__bank1']; ?>
</TD>
                                                                                    
                                                                                    
										<?php endfor; else: ?>
										<TR>
											<TD  COLSPAN="30" align="center">Maaf, Data Masih Kosong</TD>
										</TR>
										<?php endif; ?>
										</tbody>
                                                                                <TBODY class="tdatahead">
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
										<Td   colspan="2"  align="right" >JML Karyawan :</td>	
                                                                                <Td   colspan="12"  align="left" ><?php echo $this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['total_orang']; ?>
</td>
                                                                               
									
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_gapok'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td>
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_tunj_jabatan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- jabatan-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_tunj_trasport'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- trans-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_tunj_makan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- makan-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_kost'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- KOST-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_lainlain'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- LAIN-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_tunj_kemahalan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- KEMAHALAN-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_dasarbpjs'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- DASAR BPJS-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_bpjs_tk_tmw'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- BPJS TK TMW-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_bpjs_tk_pegawai'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- BPJS TK PEG-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_bpjs_kes_tmw'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- BPJS KES TMW-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_bpjs_kes_pegawai'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- BPJS KES PEG-->
                                                                                <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_angsuran'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- TRANS.AMOUNT-->
                                                                               <TD  align=" right" > <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB4'][$this->_sections['y']['index']]['sum_netto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
 </td><!-- TRANS.AMOUNT-->
                                                                               <!-- 	COUNT(A.r_pegawai__id) AS total_orang,
	A.t_gaji__dasarbpjs AS dasar_bpjs,
	ROUND(A.t_gaji__dasarbpjs * 0.0424) AS sum_bpjs_tk_tmw,
	ROUND(A.t_gaji__dasarbpjs * 0.02) AS sum_bpjs_tk_pegawai,
	ROUND(A.t_gaji__dasarbpjs * 0.040) AS sum_bpjs_kes_tmw,
	ROUND(A.t_gaji__dasarbpjs * 0.010) AS sum_bpjs_kes_pegawai,
	sum(A.t_gaji__hadir) AS sum_hadir,
	sum(A.t_gaji__dasarbpjs) AS sum_dasarbpjs,
	sum(A.t_gaji__gapok) AS sum_gapok,
	sum(A.t_gaji__tunj_jabatan) AS sum_tunj_jabatan,
	sum(A.t_gaji__makan) AS sum_tunj_makan,
	sum(A.t_gaji__transport) AS sum_tunj_trasport,
	sum(A.t_gaji__kemahalan) AS sum_tunj_kemahalan,
	sum(A.t_gaji__kompleksitas) AS sum_kompleksitas,
	sum(A.t_gaji__kost) AS sum_kost,
	sum(A.t_gaji__angsuran) AS sum_angsuran,
	sum(A.t_gaji__gross) AS sum_gross,
	sum(A.t_gaji__netto) AS sum_netto,
	sum(A.t_gaji__lain1) AS sum_lainlain-->                                                                                <?php endfor; endif; ?>
                                                                                
										</TR>
                                                                                                
                                                                                                
                                                                                  </TBODY>              
                                                                                                
									</TABLE>


									
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" onMouseOver="document.frmList.print_desc.value='Download';" style="background:transparant;border:0;">
&nbsp;&nbsp;
 <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';"  
 onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');">	
					</FORM>
<!--CLOSE_VIEW_INDEX-->

					
<?php endif; ?>

	</DIV>

</BODY>
</HTML>