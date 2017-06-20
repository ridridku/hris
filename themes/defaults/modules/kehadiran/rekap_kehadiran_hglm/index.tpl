<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
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




<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>

<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/jquery.dataTables.min-right.css" type="text/css">
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
<link rel="stylesheet" href="<!--{$HREF_JS_PATH}-->/datatable/css/select.dataTables.min.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/datatable/js/dataTables.select.min.js"></SCRIPT>


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
          pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns:0,rightColumns:0 }

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

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--tombol_tambah -->
<div id="add-search-box">
 <!--{if $NAMA_SES=='ass_hglm' OR $NAMA_SES=='admin' }-->   
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle">Posting HGLM</span></a>
<!--{/if}-->
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>

</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Approval Rekap Absen Oleh <!--{$NAMA_SES|upper}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Posting Rekap Oleh <!--{$NAMA_SES|upper}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" >
		<TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
			<TR>
                                <TD>Cabang <font color="#ff0000">*</font></TD> 
				<TD>:

					<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_cabang" >
								<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_CABANG}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $KODE_PW_SES}-->
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

					<select name="kode_cabang" >
						<option value=""> Pilih Cabang </option>
								<!--{section name=x loop=$DATA_CABANG}-->

								<!--{if ($OPT==1)}-->

									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $KODE_PW_SES}-->
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
                                <TD>Periode<font color="#ff0000">*</font></TD> 
                                <TD>:<INPUT type="hidden"  name="periode_awal" readonly="" value=" <!--{$PERIODE_AWAL}-->"  size="10"> 
                                    <INPUT type="hidden"  name="periode_akhir" readonly="" value=" <!--{$PERIODE_AKHIR}-->"  size="10">
                                
                                <INPUT type="text"  readonly="" value=" <!--{$PERIODE_AWAL|date_format:"%d-%m-%Y"}-->"  size="10"> 
                                   S/D <INPUT type="text"   readonly="" value=" <!--{$PERIODE_AKHIR|date_format:"%d-%m-%Y"}-->"  size="10">
                                </TD> 
			</TR>
                        
                       
<INPUT TYPE="hidden" name="t_abs__id" value="<!--{$EDIT_T_ABS__ID}-->">      


<TR><TD height="40"></TD>
        <TD>
        <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
        <INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
        <INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
        <INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
        <INPUT TYPE="hidden" name="op" value="0">

        <a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Approved</span></a>
        <a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
        </TD>
</TR>
        <TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>

        </tr>
                
			</TABLE>
		</FORM>
		</td></tr>
		</table>
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
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">	
		<!--{if ($JENIS_USER_SES=='1')}-->
							<TR>
								<TD>Perwakilan</TD>
								<TD><select name="kode_perwakilan_cari" > 
									<option value=""> [Pilih Perwakilan] </option>
									<!--{section name=x loop=$DATA_CABANG}-->
									<!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_KODE_CABANG}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
									<!--{/if}-->
									<!--{/section}-->
									</select>		</TD>
							</TR>
					<!--{/if}-->	
			<TR>
				<TD>Periode Awal  <font color="#ff0000">*</font></TD>
                                <TD>:
                                <input type="text" NAME="awal" value="<!--{$PERIODE_AWAL|date_format:"%Y-%m-%d"}-->">
				<img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmList1.awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
				
                                
                                </TD>
			</TR>  
                        <TR>
				<TD>Periode Akhir  <font color="#ff0000">*</font></TD>
                                <TD>:
                                <input type="text"  NAME="akhir" value="<!--{$PERIODE_AKHIR|date_format:"%Y-%m-%d"}-->">
				<img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmList1.akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					
                                
                                
                                </TD>
			</TR>  
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
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Summary Rekap Absen  <!--{$NAMA_SES|upper}--> </td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Periode aktif  Mulai : <!--{$PERIODE_AWAL|date_format:"%d-%B-%Y"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d-%B-%Y"}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
            <table id="example" class="display" cellpadding="6" cellspacing="6" width="96%">
             <thead class="tdatahead">
		<tr>
					<th width="4%" rowspan="2" align="left" class="alt2">NO</TH>							
					<th width="8%" rowspan="2" align="left" class="alt2" >CABANG</TH>
					<th width="13%" align="left" class="alt2" >PERIODE AWAL</TH>
					<th width="13%" align="left" class="alt2" >PERIODE AKHIR</TH>
					<th width="4%" rowspan="2" align="left" class="alt2" >HK</TH>
					<th colspan="3" align="left" class="alt2" ><div align="center">PEGAWAI</div></TH>
					<th align="left" class="alt2" ><div align="center">REKAP ABSEN </div></TH>
			        <th colspan="4" align="left" class="alt2" ><div align="center">APPROVAL</div></TH>
	          </tr>
			<tr>
			  <th width="13%" align="left" class="alt2" >
                              <!--{if ($AWAL_CARI)!=''}--> 
                              <!--{$AWAL_CARI}-->
                            <!--{else}--> 
                            <!--{$PERIODE_AWAL}-->
                                 <!--{/if}--></TH>
                            <th width="13%" align="left" class="alt2" > <!--{if ($AWAL_CARI)!=''}--> 
                              <!--{$AKHIR_CARI}-->
                            <!--{else}--> 
                            <!--{$PERIODE_AKHIR}-->
                                 <!--{/if}--></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG AWAL </div></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG RESIGN </div></TH>
                            <th width="11%" align="left" class="alt2" ><div align="left">PEG AKTIF </div></TH>
                            <th width="7%" align="left" class="alt2" >TDK ADA ABSEN</TH>
                            <th width="8%" align="left" class="alt2" > HRD</TH>
                            <th width="14%" align="left" class="alt2" >BOM/KOORD</TH>
                            <th width="9%" align="left" class="alt2" > HGLM</TH>
                            <th width="9%" align="left" class="alt2" >CLOSING</TH>
			</tr>
			</thead>
			<tbody class="tdatacontent" >
			<!--{section name=x loop=$DATA_TB}-->
			<tr>
                        <TD  align="center"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                        <TD align="left"> <!--{$DATA_TB[x].r_cabang__nama}-->  </TD>
                        <TD align="center"> <!--{if ($DATA_TB[x].t_rkp__awal)>0}--> <!--{$DATA_TB[x].t_rkp__awal}-->
                            <!--{else}--> <font color="#ff0000">Blm ada Rkp Absen</font> 
                                 <!--{/if}--> </TD>
                        <TD align="center"><!--{if ($DATA_TB[x].t_rkp__akhir)>0}--> <!--{$DATA_TB[x].t_rkp__akhir}-->
                            <!--{else}--> <font color="#ff0000">Blm ada Rkp Absen</font> 
                                 <!--{/if}--> </TD>
                        <TD align="center"> <!--{$DATA_TB[x].mx_day}--> </TD>
                        <TD align="center"><font color="#0c49f2"> <!--{$DATA_TB[x].rkp_peg}--></font> </TD>
			<TD> <!--{$DATA_TB[x].rkp_resign}--> </TD>
			<TD> <font color="#0c49f2"><!--{$DATA_TB[x].rkp_peg_aktif}--></font> </TD>
                        <TD align="center"><font color="#ff0000"><!--{$DATA_TB[x].rkp_nol}--></font> </TD>
                        <TD align="center"><font color="#137477"><!--{$DATA_TB[x].rkp_hrd}--></font> </TD>
                        <TD align="center"><font color="#28490a"><!--{$DATA_TB[x].rkp_bom}--></font> </TD>
                        <TD align="center"><font color="#310538"><!--{$DATA_TB[x].rkp_hglm}--></font> </TD>
                         <TD align="center"><font color="#a00404"><!--{$DATA_TB[x].rkp_closing}--></font> </TD>
                        </TR>
                        <!--{sectionelse}-->
                        <TR>
                                <TD COLSPAN="17" align="center">Maaf, Data masih kosong</TD>
                        </TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->
 
    <!--halaman -->
</div>
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>