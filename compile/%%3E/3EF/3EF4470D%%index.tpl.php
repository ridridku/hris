<?php /* Smarty version 2.6.18, created on 2017-06-02 09:32:42
         compiled from defaults/modules/payroll/posting_payroll//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'defaults/modules/payroll/posting_payroll//index.tpl', 238, false),array('modifier', 'number_format', 'defaults/modules/payroll/posting_payroll//index.tpl', 377, false),)), $this); ?>
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
   //background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
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
	var tableWidget_okToSort = true;
	var tableWidget_arraySort = new Array();
	tableWidget_tableCounter = 1;
	var activeColumn = new Array();
	var currentColumn = false;

	

	
	
</script>
<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-sack.js"></SCRIPT>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/global.js"></SCRIPT>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/datatable/css/jquery.dataTables.min-custom.css" type="text/css">
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
<!--D:\xampp\htdocs\hris\themes\defaults\javascripts\datatable  -->
  
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
       searching: true,
       ordering:true,
       paging: false,
       info:false,
       dom: 'Bfrtip',
        buttons: [
          'excel'
        ], language: {search: "Pencarian:"},
           select: {style: 'single'},
         fixedColumns:   { leftColumns: 3,rightColumns:0 }
    } );
       
} );

$(document).ready(function() {
    var table = $('#payroll').DataTable( {
        scrollY:        "430",
        scrollX:        true,
        scrollCollapse: true,
        info:true,
        paging: false,  
    dom: 'Bfrtip',
    buttons: ['copy'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
        //  pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
     fixedColumns:   { leftColumns: 3,rightColumns:0 }

        });
    

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
    
    .number_range_filter
{
  width:100px;
}

div.container {
        width: 60%;
    }
    
    #new-search-area {
    width: 100%;
    clear: both;
    padding-top: 20px;
    padding-bottom: 20px;
}
#new-search-area input {
    width: 600px;
    font-size: 20px;
    padding: 5px;
}
  </STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
    <!--tombol_tambah  -->
<div id="add-search-box">
  
<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<?php else: ?>
 
 <?php endif; ?>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->

<DIV ID="_menuEntry1_1" style="top:10px; width:100%; display:none;position:absolute;">
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="100%" >
<tr><td class="tcat" colspan="22">
<a class="button" href="#" name="Check_All" value="CheckAll" onClick="CheckAll(document.frmCreate.check_list)"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/tick.png" align="absmiddle"> Approve All</span></a>
<a class="button" href="#" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/purge.gif" align="absmiddle"> Unchecked All</span></a>
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
</td></tr></TABLE>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
<tr><td class="tcat"> Approval Salary Per Periode <?php echo ((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B-%Y") : smarty_modifier_date_format($_tmp, "%d %B-%Y")); ?>
 s/d <?php echo ((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B-%Y") : smarty_modifier_date_format($_tmp, "%d %B-%Y")); ?>
</td></tr>
</table>		

		
<table id="payroll" class="display" cellpadding="4" cellspacing="6" width="100%">
<thead  class="tdatacontent">
    <!-- <TH class="tdatahead" align="center"><img src="/icon/tick.png" align="absmiddle"><br>B</TH>  -->
<tr>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>NO</u> </font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>NAMA</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>KET</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>JABATAN</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>LEVEl</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>SB LOKASI</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>LAMA(BLN)</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>MASUK</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>HADIR</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>SAKIT</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>IZIN</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>CUTI</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>ALFA</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>STATUS AKTIF</u></font></TH>  
<TH class="alt2" align="center"><Font style="font-size:10;"><u>GAJI POKOK</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>T.JABATAN</u></font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;"><u>T.TRANS</u></font></TH>         
<TH class="alt2" align="center"><Font style="font-size:10;"><u>T.MAKAN</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>T.LAIN-LAIN1</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>T.LAIN-LAIN2</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>KEMAHALAN</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>GAJI GROSS</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>DASAR BPJS</u></font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">BPJS TK Perus<BR> 0,0424</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">BPJS TK Kary<BR> 0,02</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">BPJS Kes Peru<BR> 0,040</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">BPJS Kes Kar<BR> 0,010</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;"><u>ANGSURAN</u></font></TH> 

<TH class="alt2" align="center" ><Font style="font-size:10;"><u>THP</u><BR>V</font></TH> 
</TR>
  
    
    
    <!--thead dua-->
   
    <!-- <TH class="tdatahead" align="center"><img src="/icon/tick.png" align="absmiddle"><br>B</TH>  -->
<tr>
<TH class="alt2" align="center"><Font style="font-size:10;">1 </font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">2</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">3</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">4</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">5</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">6</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">7</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">8</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">9</font></TH>  
<TH class="alt2" align="center"><Font style="font-size:10;">10</font></TH>
<TH class="alt2" align="center">11</TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">12</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">13</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">14</font></TH>  
<TH class="alt2" align="center"><Font style="font-size:10;">15</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">16</font></TH>
<TH class="alt2" align="center"><Font style="font-size:10;">17=col9/<?php echo $this->_tpl_vars['HARI_KERJA']; ?>
x<?php echo $this->_tpl_vars['U_MAKAN']; ?>
</font></TH>         
<TH class="alt2" align="center"><Font style="font-size:10;">18=col9/<?php echo $this->_tpl_vars['HARI_KERJA']; ?>
x<?php echo $this->_tpl_vars['U_TRANSPORT']; ?>
</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">19</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">20</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">21</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">22=15+16+17+18+19+20+21</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">23</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">24=col23 * 0,0424</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">25=col23 * 0,02</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">26=col23 * 0,040</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">27=col23 * 0,010</font></TH> 
<TH class="alt2" align="center"><Font style="font-size:10;">28</font></TH> 

<TH class="alt2" align="center" ><Font style="font-size:10;">29=(22-(25+27)-28)</font></TH> 
</TR>
    </thead>
  

    <!-- isi kontent   <input type="button" value="Delete" onclick="deleteRow(this)"> -->
    <tbody  class="tdatacontent">
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
            <TR>
            <TD ><?php echo $this->_sections['x']['index']+1; ?>
</TD>
            <TD align="LEFT"><Font style="font-size:12;"><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</TD>
             <TD align="center"><Font style="font-size:12;">  
                 <?php if (( $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['status_staf'] ) == 1): ?>
                 <font color="#ff0000">Non-Staff</font>     
               <?php else: ?>  
               <font>Peg-Staff</font>
               <?php endif; ?> </TD>
       
          
            <TD><input type="hidden" name="jabatan[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
"><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</TD>
            <TD align="CENTER"><input type="hidden" name="level[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_level__ket']; ?>
"><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_level__ket']; ?>
</TD>
            <TD > <input type="hidden"  name="mutasi[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pnpt__no_mutasi']; ?>
">
                <INPUT type="hidden" name="approval[]" id="check_list" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pnpt__id_pegawai']; ?>
" >
                <input type="hidden" name="cabang__id[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_cabang__id']; ?>
">
                <input type="hidden" name="cabang__nama[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
">   
                <input type="hidden" name="subcab__id[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_subcab__id']; ?>
">
                <input type="hidden" name="subcab__nama[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
">    
                <input type="hidden" name="nip[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pnpt__nip']; ?>
"> 
                <input type="hidden" name="nama[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
"> 
                <input type="hidden" name="bank_nama[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__bank1']; ?>
"> 
                <input type="hidden" name="bank_akun_peg[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__bank1_rek']; ?>
"> 
                <input type="hidden" name="bank_norek[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__bank1_norek']; ?>
"> 
                <input type="hidden" name="bank_alm[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__bank1_alm']; ?>
"> 
                <input type="hidden" name="nama_pegawai[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
"> 
               <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_subcab__nama']; ?>
</TD>
            <TD align="CENTER">
            <input type="hidden" name="tgl_masuk[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__tgl_masuk']; ?>
">   
            <input type="hidden" name="lama_bln[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['lama_bln']; ?>
"> 
            <input type="hidden" name="dept__ket[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_dept__ket']; ?>
"> 
            <input type="hidden" name="dept__cc[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_dept__cc']; ?>
"> 
            <input type="hidden" name="dept__id[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_dept__id']; ?>
">
             <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['lama_bln']; ?>
 
            </TD>
            <TD align="CENTER">  <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['r_pegawai__tgl_masuk'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 </TD>
            <TD align="CENTER">  
            <input type="hidden" name="rekap_awal[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__awal']; ?>
">   
            <input type="hidden" name="rekap_akhir[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__akhir']; ?>
"> 
            <input type="hidden" name="rekap_hadir[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['absen_hadir']; ?>
"> 
            <input type="hidden" name="rekap_sakit[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__sakit']; ?>
">   
            <input type="hidden" name="rekap_izin[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__izin']; ?>
">   
            <input type="hidden" name="rekap_cuti[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__cuti']; ?>
"> 
            <input type="hidden" name="rekap_dinas[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__dinas']; ?>
">
            <input type="hidden" name="rekap_alpa[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__alpa']; ?>
">
            <textarea name="ket_resign[]" style="display:none;" rows="4" cols="50"><?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['ket_resign']; ?>
</textarea>
              <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['absen_hadir']; ?>
  </TD>
            <TD align="CENTER">  <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__sakit']; ?>
    </TD>
            <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__izin']; ?>
     </TD>
            <TD align="CENTER">  <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__cuti']; ?>
    </TD>
            <TD align="CENTER">  <?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['t_rkp__alpa']; ?>
    </TD>  
            <TD align="CENTER">        
               <?php if (( $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['ket_resign'] ) == 1): ?><font color="#ff0000">Resign</font>     
               <?php else: ?>  
               <font>aktif</font>
               <?php endif; ?> </TD>
                <TD align="RIGHT"> <input size="10" type="text" id="gapok" name="gapok[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gapok'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :Right;"></TD><!-- gajipokok -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="hidden" size="7" name="t_jabatan[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['tunj_jabatan']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['tunj_jabatan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- t.jabatan -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="hidden" size="7"  name="t_transport[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_transport']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_transport'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- t.tranportasi -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="hidden" size="7"  name="t_makan[]"  value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_makan']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_makan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- t.makan -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="10"  name="lain1[]"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['lain1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
"></TD><!-- t.lain1 -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="text" size="10"  name="lain2[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['lain2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
"></TD><!-- t.lain2 -->
                <TD align="RIGHT"><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="hidden" size="7"  name="kemahalan[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['tunj_kemahalan']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['tunj_kemahalan'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- kemahalan -->
                <TD align="RIGHT" ><INPUT onkeyup="formatangka(this)" style="text-align :left;" type="hidden" size="10"  name="gaji_kotor[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_gross']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_gross'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- GAJI KOTOR -->
                <TD align="CENTER"><INPUT type="hidden"name="dasar_bpjs[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- dasar_bpjs -->
                <TD align="CENTER"><INPUT type="hidden"name="bpjs_tk_tmw[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.0424; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.0424)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- bpjs TK TMW -->
                <TD align="CENTER"><INPUT type="hidden"name="bpjs_tk_peg[]"  value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.02; ?>
"><font color="#2200ff"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.02)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</font></TD><!-- bpjs TK karyawan -->
                <TD align="CENTER"><INPUT type="hidden"name="bpjs_kes_tmw[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.040; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.040)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD><!-- bpjs kes TMW -->
                <TD><INPUT type="hidden"name="bpjs_kes_peg[]" value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.010; ?>
"><font color="#2200ff"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['dasar_bpjs']*0.010)) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</font></TD><!-- bpjs kes karyawan -->       
                <TD align="RIGHT"><INPUT type="hidden" size="8"  name="angsuran[]"  value="<?php echo $this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['angsuran']; ?>
">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['angsuran'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
<!-- angsuran --> 
                <INPUT type="hidden" size="8"  name="thp[]"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_netto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
" onkeyup="formatangka(this)" style="text-align :left;">
                </TD> 
                <TD align="RIGHT"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_PJM'][$this->_sections['x']['index']]['gaji_netto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
</TD>
                       
        </tr>
           <?php endfor; else: ?>
        <TR>
        <TD  COLSPAN="21" align="center">Maaf karyawan Tersebut Tidak Ada</TD>
        </TR>
	<?php endif; ?>
           
        
    </tbody>
</table>

                       
                </form>

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
				<TD>Periode Awal  <font color="#ff0000">*</font></TD>
                                <TD>:
                                <input type="text"  NAME="awal" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AWAL'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
				<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmList1.awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
				
                                
                                </TD>
			</TR>  
                        <TR>
				<TD>Periode Akhir  <font color="#ff0000">*</font></TD>
                                <TD>:
                                <input type="text"  NAME="akhir" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PERIODE_AKHIR'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
				<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmList1.akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					
                                
                                
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
		<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
                <TR><td class="tcat"> Posting Payroll Per Cabang  </td></tr>
		</TABLE>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Payroll Untuk Periode <?php echo ((is_array($_tmp=$this->_tpl_vars['PRE_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B-%Y") : smarty_modifier_date_format($_tmp, "%d %B-%Y")); ?>
 s/d <?php echo ((is_array($_tmp=$this->_tpl_vars['END_ACTIVE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B-%Y") : smarty_modifier_date_format($_tmp, "%d %B-%Y")); ?>
 </td></tr>
		<tr><td class="alt2" style="padding:0px;"></td></tr>
		</table>
		<table id="example" class="display nowrap" cellspacing="0" width="100%">
        <thead class="tdatacontent" style="font-size:12px;">
            <tr>
                 <th>NO</th>
            <th>CABANG</th>
            <th>PERIODE AWAL</th>
            <th>PERIODE AKHIR</th>
            <th>JML PEG AWAL</th>
            <th>JML RESIGN</th>
            <th>JML PEG AKHIR</th>
             <th>ABSEN KOSONG</th>
            <th>JML PEG DIAJUKAN</th>
            <th>KETERANGAN</th> 
            <th>JML MASUK PAYROLL</th>
            <th>POSTING</th>
            </tr>
        </thead>
        <tfoot class="tdatacontent">
            <tr>
            <th>NO</th>
            <th>CABANG</th>
            <th>PERIODE AWAL</th>
            <th>PERIODE AKHIR</th>
            <th>JML PEG AWAL</th>
            <th>JML RESIGN</th>
            <th>JML PEG AKHIR</th>
             <th>ABSEN KOSONG</th>
            <th>JML PEG DIAJUKAN</th>
            <th>KETERANGAN</th> 
            <th>JML MASUK PAYROLL</th>
            <th>POSTING</th>
            </tr>
        </tfoot>
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
                <TR>
                <TD> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
</TD>
                <TD align="LEFT"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['awal']; ?>
  </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['akhir']; ?>
 </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['rkp_peg']; ?>
 </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['rkp_resign']; ?>
 </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['peg_aktif']; ?>
 </TD>
                 <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['rkp_nol']; ?>
 </TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['rkp_closing']; ?>
 </TD>
                <TD align="CENTER"><?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['posting_payroll'] ) == 0): ?><font color="#450ef9">Payroll Belum Di Posting</font>
                <?php else: ?><font color="#ff0000">Sudah Di Posting</font><?php endif; ?></TD>
                <TD align="CENTER"> <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['posting_payroll']; ?>
 </TD>
                <TD width="20"  ALIGN="CENTER">
                    <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/arrow_skip.png" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__id']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
                </TR>
                <?php endfor; else: ?>
                <TR>
                <TD COLSPAN="13" align="center">Maaf, Data masih kosong</TD>
                </TR>
                <?php endif; ?>
            
        </tbody>
    </table>

<div id="panel-footer">
    <!--halaman -->
                   
    <!--halaman -->
</div>
		

		</form>

	<div id="div-bg-note-trans"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>