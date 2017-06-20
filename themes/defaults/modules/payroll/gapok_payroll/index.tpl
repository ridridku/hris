<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
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
    

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
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
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>



 <link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/jquery.dataTables.min.css" type="text/css">
 <link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/fixedColumns.dataTables.min.css" type="text/css">
 <link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/buttons.dataTables.min.css" type="text/css">	  
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jquery-1.12.4.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jquery.dataTables.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.fixedColumns.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.buttons.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.colVis.min.js"></SCRIPT>

<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/style_sorting.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/script_sorting.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/script_p.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.flash.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jszip.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/pdfmake.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/vfs_fonts.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.html5.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.print.min.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.flash.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/jszip.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/pdfmake.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/vfs_fonts.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.html5.min.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/buttons.print.min.js"></SCRIPT>



<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/select.dataTables.min.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.select.min.js"></SCRIPT>


  
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
        dom: 'Bfrtip',
        buttons: [
           'excel', 'print'
        ],
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

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
    <!--tombol_tambah  -->
<div id="add-search-box">
<!--{if $EDIT_VAL==0}-->
<!--<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--$HREF_IMG_PATH/icon/search.png" align="absmiddle"> Pencarian Data</span></a>-->
<!--{else}-->
 
 <!--{/if}-->
</div>
<!--tombol_tambah  -->

<!--form_tambah -->

<DIV ID="_menuEntry1_1" style="top:10px; width:100%; display:none;position:absolute;">
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="100%" >
<tr><td class="tcat" colspan="22">
<a class="button" href="#" name="Check_All" value="CheckAll" onClick="CheckAll(document.frmCreate.check_list)"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" align="absmiddle"> Approve All</span></a>
<a class="button" href="#" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/purge.gif" align="absmiddle"> Unchecked All</span></a>
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
<INPUT TYPE="hidden" name="op" value="0">
<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Posting</span></a>
<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>   
</td></tr></TABLE>
		
<table border="0" class="tborder" cellpadding="4" cellspacing="1" border="0" width="100%" >
   <THEAD>
       <TR> <TD class="thead">Master Gapok</TD>
  
    </TR>
    </THEAD></TABLE>
		
<table id="payroll" class="display" cellpadding="4" cellspacing="6" width="100%" >
    <thead>
        <tr>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>NO</u></font></TH>
           
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>STATUS VERIFIKASI</u></font></TH>   
            <TH class="tdatahead"><Font style="font-size:10;"><u>NAMA</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>STATUS JABATAN </u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>JABATAN</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>LEVEl</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>CABANG</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>SB LOKASI</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>LAMA(BLN)</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>GAJI POKOK</u></font></TH>
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.LAIN-LAIN1</u></font></TH> 
            <TH class="tdatahead" align="center"><Font style="font-size:10;"><u>T.LAIN-LAIN2</u></font></TH> 
          
           
</tr>
    </thead> 
    <!-- isi kontent  -->
    <tbody class="tdatacontent">
<!--{section name=x loop=$DATA_PJM}-->
           <tr>
            <TD align="center"><!--{$smarty.section.x.index+$COUNT_VIEW}--></td>
            <TD align="center"><!--{if $DATA_PJM[x].verifikasi==1}--><Font color='#450ef9'>Pegawai aktif</Font> <!--{else}--><Font color='#ff0000'>Belum Diverifikasi</Font><!--{/if}-->
                <INPUT type="hidden" name="approval[]"  value="<!--{$DATA_PJM[x].r_pegawai__id}-->" > 
            </TD>
             <TD ><Font style="font-size:12;"><!--{$DATA_PJM[x].r_pegawai__nama}--></TD>
            <TD align="center"><!--{if $DATA_PJM[x].status_staf==1}--><Font color='#450ef9'>Non-Staff </Font> <!--{else}--><Font color='#ff0000'>Peg-Staff</Font><!--{/if}-->
            <input type="hidden" name="cabang__id[]" value="<!--{$DATA_PJM[x].r_cabang__id}-->">
            <input type="hidden" name="subcab__id[]" value="<!--{$DATA_PJM[x].r_subcab__id}-->">
            <input type="hidden" name="nip[]" value="<!--{$DATA_PJM[x].r_pnpt__nip}-->"> 
            <input type="hidden"  name="mutasi[]" value="<!--{$DATA_PJM[x].r_pnpt__no_mutasi}-->">
          
         
           </TD>
            <TD align="center"<input type="hidden" name="jabatan[]" value="<!--{$DATA_PJM[x].r_jabatan__ket}-->"><!--{$DATA_PJM[x].r_jabatan__ket}--></TD>
            <TD align="center"><input type="hidden" name="level[]" value="<!--{$DATA_PJM[x].r_level__ket}-->"><!--{$DATA_PJM[x].r_level__ket}--></TD>
            <TD align="center"><!--{$DATA_PJM[x].r_cabang__nama}--></TD>
            <TD align="center"><!--{$DATA_PJM[x].r_subcab__nama}--></TD>
            <TD align="center"><!--{$DATA_PJM[x].lama_bln}--><input type="hidden" name="tgl_masuk[]" value="<!--{$DATA_PJM[x].r_pegawai__tgl_masuk}-->"> </TD>
            <TD align="center" > <input type="text"  size="15" name="gapok[]" value="<!--{$DATA_PJM[x].r_gapok__nilai|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :left;"></TD><!-- gajipokok -->
            <TD align="center" > <input type="text" size="15" name="lain1[]" value="<!--{$DATA_PJM[x].r_gapok__lain1|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :left;"></TD><!-- lainlain1 -->
            <TD align="center" > <input type="text" size="15" name="lain2[]" value="<!--{$DATA_PJM[x].r_gapok__lain2|number_format:0:".":","}-->" onkeyup="formatangka(this)" style="text-align :left;"></TD><!-- lainlain2 -->
        </tr>
           <!--{sectionelse}-->
        <TR>
        <TD  COLSPAN="10" align="center">Maaf karyawan Tersebut Tidak Ada</TD>
        </TR>
	<!--{/section}-->
           
        
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
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">

		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box" >
                <TR>
                <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang_cari" onchange="cari_subcab2(this.value);"> 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_R_CABANG__ID}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{else}-->

                                                                                                   <!--{if  ($DATA_CABANG[x].kode_cabang) == $KODE_PW_SES}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->
                                                                                           <!--{/if}-->

                                                                                           <!--{/section}-->
                                                                                           </SELECT>

                                                                           <!--{else}-->

                                                                   <select name="kode_cabang_cari" >
                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_R_CABANG__ID}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{else}-->

                                                                                                   <!--{if  trim($DATA_CABANG[x].r_cabang__id) == trim($KODE_PW_SES)}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{else}-->
                                                                                                   <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  disabled> <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                                                                                   <!--{/if}-->

                                                                                           <!--{/if}-->

                                                                                           <!--{/section}-->
                                                                                           </SELECT>

                                                                           <!--{/if}-->
                                                           </TD>
                                                   </TR>
                                                   <TR>
                                                        <TD>Pilih Sub Cabang</TD>
								<TD>
                                                                    <DIV id="ajax_subcabang2">
                                                                       <select name="kode_subcab_cari">
                                                                            <option value="">[Pilih Sub Cabang]</option>
                                                                            <!--{section name=x loop=$DATA_SUBCABANG}-->
                                                                            <!--{if trim($DATA_SUBCABANG[x].r_subcab__id)==0}-->
                                                                            <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                       </select> 
                                                                          
                                                                    </DIV>
                                                                </TD>
							</TR>
                                                      <TR>
								<TD>Departemen</TD>
								<TD>
                                                                            <select name="departemen_cari" >
                                                                            <option value="">[Pilih Departemen]</option>
                                                                            <!--{section name=x loop=$DATA_DEPARTEMEN}-->
                                                                            <!--{if trim($DATA_DEPARTEMEN[x].r_dept__id)==0}-->
                                                                            <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->" selected > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->"  > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                            </select> 
                                                                            
                                                   
                                                                    
                                                                </TD>
                                                     </TR>   
                            <TR>
                                <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_karyawan_cari" value="" ></TD>
                            </TR>
                            
			<TR><TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="search" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="0">
                               
				<CENTER>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Cari</span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
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
                <TR><td class="tcat"> MASTER GAPOK  </td></tr>
		</TABLE>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Master Gapok </td></tr>
		<tr><td class="alt2" style="padding:0px;"></td></tr>
		</table>
		<table id="example" class="display nowrap" cellspacing="0" width="100%">
        <thead class="tdatacontent">
            <tr>
                <th>NO</th>
                <th>CABANG</th>              
                <th>POSTING</th>
            </tr>
        </thead>
        <tfoot class="tdatacontent">
            <tr>
                <th >NO</th>
                <th>CABANG</th>
                <th>AKSI</th>
            </tr>
        </tfoot>
        <tbody class="tdatacontent">
            <!--{section name=x loop=$DATA_TB}-->
                <TR>
                <TD ALIGN="CENTER"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                <TD ALIGN="CENTER"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
                <TD ALIGN="CENTER" >
                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_cabang__id}-->&parent_id=<!--{$DATA_TB[x].r_subcab__parent}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
                </TR>
                <!--{sectionelse}-->
                <TR>
                <TD COLSPAN="13" align="center">Maaf, Data masih kosong</TD>
                </TR>
                <!--{/section}-->
            
        </tbody>
    </table>

<div id="panel-footer">
    <!--halaman -->
                   
    <!--halaman -->
</div>
		

		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>
