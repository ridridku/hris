<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
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

</script>
<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>


<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>

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

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<!--{if $NAMA_CABANG<>""}-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>
<!--{/if}-->
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
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box" > 
                <TR>
                    <TD>Cabang <font color="#ff0000">*</font></TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang_cari" onchange="cari_subcab(this.value);"> 
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
                                                                        <DIV id="ajax_subcabang">
                                                                            <select name="kode_subcab_cari" >
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
                                                                <TD>Jenis Level <font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                            <select name="jenis_cari" >
                                                                            <option value="">[Pilih Jenis]</option>
                                                                            <!--{section name=x loop=$DATA_JENIS}-->
                                                                            <!--{if trim($DATA_JENIS[x].r_level__id)==0}-->
                                                                            <option value="<!--{$DATA_JENIS[x].r_level__id}-->" selected > <!--{$DATA_JENIS[x].r_level__ket}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_JENIS[x].r_level__id}-->"  > <!--{$DATA_JENIS[x].r_level__ket}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                            </select> 
                                                                </TD>
                                                         </TR>
                                                            <TR>
                                                                <TD>Jabatan <font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                            <select name="jenis_cari" >
                                                                            <option value="">[Pilih Jenis]</option>
                                                                            <!--{section name=x loop=$DATA_JABATAN}-->
                                                                            <!--{if trim($DATA_JABATAN[x].r_jabatan__id)==0}-->
                                                                            <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->" selected > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->"  > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
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
                                                        <!--{section name=foo start=1 loop=31 step=1}-->
                                                                  <!--{if ($smarty.section.foo.index)==$PRE_ACTIVE|date_format:"%d"}-->
                                                                         <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                                                  <!--{else}-->
                                                                                 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
                                                                 <!--{/if}--> 
                                                        <!--{/section}-->
                                                        </SELECT> 
							<SELECT name="bulan1"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<!--{if $PRE_ACTIVE|date_format:"%m"==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $PRE_ACTIVE|date_format:"%m"==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="03"<!--{if $PRE_ACTIVE|date_format:"%m"==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="04"<!--{if $PRE_ACTIVE|date_format:"%m"==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="05"<!--{if $PRE_ACTIVE|date_format:"%m"==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="06"<!--{if $PRE_ACTIVE|date_format:"%m"==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="07"<!--{if $PRE_ACTIVE|date_format:"%m"==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="08"<!--{if $PRE_ACTIVE|date_format:"%m"==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $PRE_ACTIVE|date_format:"%m"==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $PRE_ACTIVE|date_format:"%m"==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $PRE_ACTIVE|date_format:"%m"==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $PRE_ACTIVE|date_format:"%m"==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun1" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$PRE_ACTIVE|date_format:"%Y"}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT>                                                 
						 </TD></TR>    
                                        <TR>
                                        <TD>Periode Akhir</TD>
                                        <TD>
                                        <SELECT NAME="tgl2" > 
                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                        <!--{section name=foo start=1 loop=31 step=1}-->
                                        <!--{if ($smarty.section.foo.index)==$END_ACTIVE|date_format:"%d"}-->
                                        <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                        <!--{else}-->
                                        <option value="<!--{$smarty.section.foo.index}-->"><!--{$smarty.section.foo.index}--></option>
                                        <!--{/if}--> 
                                        <!--{/section}-->
                                        </SELECT> 
					<SELECT name="bulan2"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<!--{if $END_ACTIVE|date_format:"%m"==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $END_ACTIVE|date_format:"%m"==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="03"<!--{if $END_ACTIVE|date_format:"%m"==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="04"<!--{if $END_ACTIVE|date_format:"%m"==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="05"<!--{if $END_ACTIVE|date_format:"%m"==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="06"<!--{if $END_ACTIVE|date_format:"%m"==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="07"<!--{if $END_ACTIVE|date_format:"%m"==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="08"<!--{if $END_ACTIVE|date_format:"%m"==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $END_ACTIVE|date_format:"%m"==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $END_ACTIVE|date_format:"%m"==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $END_ACTIVE|date_format:"%m"==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $END_ACTIVE|date_format:"%m"==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                        </SELECT> 
						<SELECT NAME="tahun2" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$END_ACTIVE|date_format:"%Y"}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT>                                                 
						 </TD></TR>
				
                                </TD>
                                </TR>
                                    
                                
                                    <TR>
					<TD></TD>
					<TD>
                                            <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                                            <INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
                                            <INPUT TYPE="hidden" name="search" value="1">
                                            <INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
                                            <INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
                                            <INPUT TYPE="hidden" name="op" value="0">
                                            <a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> Cari</span></a>
                                            <a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
                                                </TD>
                                        </TR>							
                </TABLE>
			</FORM>
			</div></div>	 <!--TUTUP_PENCARIAN_DATA -->  
		</DIV>												
		<!--{if $SEARCH<>""}--><br>
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
				<!--{if ($NAMA_CABANG !='') }-->
											<tr><td class="tdatacontent"  width="100" >CABANG</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_CABANG}--> &nbsp;</td></tr>
				<!--{/if}-->
                            

				<!--{if ($PRE_ACTIVE !='' or  $END_ACTIVE !='' ) }-->


											<tr><td class="tdatacontent"  >PERIODE </td><td> : </td><td>
																			
											<!--{$PRE_ACTIVE|date_format:"%d-%b-%Y"}--> &nbsp; s/d &nbsp;  <!--{$END_ACTIVE|date_format:"%d-%b-%Y"}--></td></tr>
				<!--{/if}-->
				
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
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
                                                                                    <TD width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>  
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_cabang__nama}--></TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_subcab__nama}--></TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_dept__ket}--></TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_cc__ket}--></TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_level__ket}--></TD>
                                                                                    <TD align=" right"><!--{$DATA_TB[x].r_jabatan__ket}--></TD>
                                                                                    
                                                                                    <TD  ><!--{$DATA_TB[x].r_pegawai__tgl_masuk|date_format:"%d-%b-%Y"}--></TD>
                                                                                    <TD ><!--{$DATA_TB[x].lama_bln}--> Bln</TD>
                                                                                    <TD ><!--{$DATA_TB[x].t_gaji__hadir}--></TD>
                                                                                    <TD >
                                                                                    <!--{if $DATA_TB[x].t_gaji__status_resign==0}-->
                                                                                    <font style="color: #006600">MASIH AKTIF</font>
                                                                                    <!--{else}-->
                                                                                    <font style="color: #ff0000">KELUAR</font
                                                                                    <!--{/if}-->
                                                                                    </TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__gapok}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__tunj_jabatan}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__transport}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__makan}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__lain1}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__lain2}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__kemahalan}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__dasarbpjs}--></TD><!-- dasar_bpjs -->
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__dasarbpjs*0.0424|number_format:0:".":","}--></TD><!-- bpjs TK TMW -->
                                                                                    <TD  align=" right"><font color="#2200ff"><!--{$DATA_TB[x].t_gaji__dasarbpjs*0.02|number_format:0:".":","}--></font></TD><!-- bpjs TK karyawan -->
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__dasarbpjs*0.040|number_format:0:".":","}--></TD><!-- bpjs kes TMW -->
                                                                                    <TD  align=" right"><font color="#2200ff"><!--{$DATA_TB[x].t_gaji__dasarbpjs*0.010|number_format:0:".":","}--></font></TD><!-- bpjs kes karyawan --> 
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__angsuran|number_format:0:".":","}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__netto|number_format:0:".":","}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].r_pegawai__bank1_norek}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].r_pegawai__bank1_rek}--></TD>
                                                                                     <TD  align=" right">IDR</TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].t_gaji__netto|number_format:0:".":","}--></TD>
                                                                                    <TD  align=" right"><!--{$DATA_TB[x].r_pegawai__bank1}--></TD>
                                                                                    
                                                                                    
										<!--{sectionelse}-->
										<TR>
											<TD  COLSPAN="30" align="center">Maaf, Data Masih Kosong</TD>
										</TR>
										<!--{/section}-->
										</tbody>
                                                                                <TBODY class="tdatahead">
                                                                                <TR><!--{section name=y loop=$DATA_TB4}-->
										<Td   colspan="2"  align="right" >JML Karyawan :</td>	
                                                                                <Td   colspan="12"  align="left" ><!--{$DATA_TB4[y].total_orang}--></td>
                                                                               
									
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_gapok|number_format:0:".":","}--> </td>
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_tunj_jabatan|number_format:0:".":","}--> </td><!-- jabatan-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_tunj_trasport|number_format:0:".":","}--> </td><!-- trans-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_tunj_makan|number_format:0:".":","}--> </td><!-- makan-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_kost|number_format:0:".":","}--> </td><!-- KOST-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_lainlain|number_format:0:".":","}--> </td><!-- LAIN-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_tunj_kemahalan|number_format:0:".":","}--> </td><!-- KEMAHALAN-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_dasarbpjs|number_format:0:".":","}--> </td><!-- DASAR BPJS-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_bpjs_tk_tmw|number_format:0:".":","}--> </td><!-- BPJS TK TMW-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_bpjs_tk_pegawai|number_format:0:".":","}--> </td><!-- BPJS TK PEG-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_bpjs_kes_tmw|number_format:0:".":","}--> </td><!-- BPJS KES TMW-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_bpjs_kes_pegawai|number_format:0:".":","}--> </td><!-- BPJS KES PEG-->
                                                                                <TD  align=" right" > <!--{$DATA_TB4[y].sum_angsuran|number_format:0:".":","}--> </td><!-- TRANS.AMOUNT-->
                                                                               <TD  align=" right" > <!--{$DATA_TB4[y].sum_netto|number_format:0:".":","}--> </td><!-- TRANS.AMOUNT-->
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
	sum(A.t_gaji__lain1) AS sum_lainlain-->                                                                                <!--{/section}-->
                                                                                
										</TR>
                                                                                                
                                                                                                
                                                                                  </TBODY>              
                                                                                                
									</TABLE>


									
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" onMouseOver="document.frmList.print_desc.value='Download';" style="background:transparant;border:0;">
&nbsp;&nbsp;
 <IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';"  
 onClick = "window.open('<!--{$FILES}-->');">	
					</FORM>
<!--CLOSE_VIEW_INDEX-->

					
<!--{/if}-->

	</DIV>

</BODY>
</HTML>