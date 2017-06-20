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
        buttons: ['excel','copy'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
          pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 4,rightColumns:1 }

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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>    
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
                            
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Update Verifikasi Rekap Kehadiran</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
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

					<select name="kode_cabang" >
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
                                <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="r_pegawai__nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_R_PEGAWAI__NAMA}-->">
                                </TD>   
                        </TR>
                         <TR>
                                <TD>Jumlah Hadir<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__hadir"  size="5" value="<!--{$EDIT_T_RKP__HADIR}-->">
                                </TD>
                        </TR>
                        <TR>
                                <TD>Jumlah Sakit<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__sakit"  size="5" value="<!--{$EDIT_T_RKP__SAKIT}-->">
                                </TD>
                        </TR>
                        <TR>
                                <TD>Jumlah Izin<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__izin"  size="5" value="<!--{$EDIT_T_RKP__IZIN}-->">
                                </TD>
                                
                        </TR>
                        <TR>
                                <TD>Jumlah Alpa<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__alpa"  size="5" value="<!--{$EDIT_T_RKP__ALPA}-->">
                                </TD>  
                        </TR>
                        <TR>
                                <TD>Jumlah Perjalanan Dinas<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__dinas"  size="5" value="<!--{$EDIT_T_RKP__DINAS}-->">
                                </TD>   
                        </TR>
                         <TR>
                                <TD>Jumlah Cuti<font color="#ff0000">*</font> </TD>
                                <TD>:
                                    <INPUT TYPE="text" NAME="t_rkp__cuti"  size="5" value="<!--{$EDIT_T_RKP__CUTI}-->">
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
                        
                            
                       
                        
                        <TR>
                                <TD>Status <font color="#ff0000">*</font></TD> 
			
					<TD>: <SELECT name="approval">
							<OPTION value="">[Pilih Status]</OPTION>
							<OPTION value="1" <!--{if $EDIT_T_RKP__APPROVAL =='1'}-->selected<!--{/if}-->>Disetujui HRD</OPTION>
							<OPTION value="2" <!--{if $EDIT_T_RKP__APPROVAL =='2'}-->selected<!--{/if}-->>Disetujui BOM</OPTION>
                                                        <OPTION value="3" <!--{if $EDIT_T_RKP__APPROVAL =='3'}-->selected<!--{/if}-->>Disetujui HGLM</OPTION>
                                                        <OPTION value="4" <!--{if $EDIT_T_RKP__APPROVAL =='4'}-->selected<!--{/if}-->>Closing</OPTION>
                                                        <OPTION value="0" <!--{if $EDIT_T_RKP__APPROVAL =='0'}-->selected<!--{/if}-->>Tidak Setuju</OPTION>
                                                        
						</SELECT>
			</TD>
                    </TR>
                        <TR>
                                <TD>Keterangan <font color="#ff0000">*</font></TD> 
                                <TD>:  <textarea rows="5" cols="20" NAME="t_rkp__keterangan"  size="12" ><!--{$EDIT_T_RKP__KETERANGAN}--></textarea>
                                   
                        </TR>
                        
                        

<INPUT TYPE="hidden" NAME="t_rkp__approval"  size="5" value="<!--{$EDIT_T_RKP__APPROVAL}-->">
<INPUT TYPE="hidden" NAME="t_rkp__no_mutasi"  size="5" value="<!--{$EDIT_T_RKP__NO_MUTASI}-->">
                              
                                
                                <TR><TD height="40"></TD>
					<TD>
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
                                     
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
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
                    
		<TR>
                                <TD>Cabang <font color="#ff0000">*</font></TD> 
				<TD>
					<!--{if ($JENIS_USER_SES==1)}-->

								<select name="kode_perwakilan_cari" onchange="cari_subcab(this.value);">
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

					<select name="kode_perwakilan_cari  >
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
							
							
							
                                                        
                        <TR><TD>Nama Karyawan </TD><TD><INPUT TYPE="text" NAME="nama_karyawan_cari" size="30"></TD></TR>
                        <TR><TD>ID Finger </TD><TD><INPUT TYPE="text" NAME="id_finger_cari" size="30"></TD></TR>
			<TR>
							<TD>Periode</TD>
							<TD>							
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01" <!--{if $BULAN_SES==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="02"<!--{if $BULAN_SES==2}-->selected<!--{/if}-->>Februari</OPTION>
								<OPTION VALUE="03"<!--{if $BULAN_SES==3}-->selected<!--{/if}-->>Maret</OPTION>
								<OPTION VALUE="04"<!--{if $BULAN_SES==4}-->selected<!--{/if}-->>April</OPTION>
								<OPTION VALUE="05"<!--{if $BULAN_SES==5}-->selected<!--{/if}-->>Mei</OPTION>
								<OPTION VALUE="06"<!--{if $BULAN_SES==6}-->selected<!--{/if}-->>Juni</OPTION>
								<OPTION VALUE="07"<!--{if $BULAN_SES==7}-->selected<!--{/if}-->>Juli</OPTION>
								<OPTION VALUE="08"<!--{if $BULAN_SES==8}-->selected<!--{/if}-->>Agustus</OPTION>
								<OPTION VALUE="09"<!--{if $BULAN_SES==9}-->selected<!--{/if}-->>September</OPTION>
								<OPTION VALUE="10"<!--{if $BULAN_SES==10}-->selected<!--{/if}-->>Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $BULAN_SES==11}-->selected<!--{/if}-->>November</OPTION>
								<OPTION VALUE="12"<!--{if $BULAN_SES==12}-->selected<!--{/if}-->>Desember</OPTION>				 
                                                        </SELECT> 


							<SELECT name="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$TAHUN_SES}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT> 
						 </TD></TR>
                        
                        
                        
                        
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
		<tr><td class="tcat">Verifikasi Rekap Data Kehadiran</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" >
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Periode aktif  Mulai : <!--{$PERIODE_AWAL|date_format:"%d-%B-%Y"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d-%B-%Y"}--> </td></tr>
                        <tr><td class="alt2" style="padding:0px;">
                    
             
		
<table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
<thead class="tdatahead">
        <tr>
                <th  class="alt2"  align="left">NO</TH>
                <th class="alt2"  align="center">ID FINGER</TH>
                <th  class="alt2" align="center">NAMA</TH>											
                <th  class="alt2"  align="center" >CABANG</TH>
                <th  class="alt2"  align="center" >SUB CABANG</TH>
                <th  class="alt2"  align="center" >DEPARTEMEN</TH>
                <th  class="alt2"  align="center" >AWAL</TH>
                <th  class="alt2"  align="center" >AKHIR</TH>
                <th  class="alt2"  align="center" >APPROVAL STATUS</TH>
                <th  class="alt2"  align="center" >HADIR</TH>
                <th  class="alt2"  align="center" >SAKIT</TH>
                <th  class="alt2"  align="center" >IZIN</TH>
                <th  class="alt2"  align="center" >ALPA</TH>
                <th  class="alt2"  align="center" >DINAS</TH>
                <th  class="alt2"  align="center" >CUTI</TH>
                <th  class="alt2"  align="center" >KETERANGAN</TH>
                <th class="alt2" align="center" ><!--{$ACTION}--></th>
        </tr>
</thead>
<tbody class="tdatacontent">
<!--{section name=x loop=$DATA_TB}-->
<tr>
                <TD> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                <TD align="center"  > <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                <TD aign="center"  > <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                <TD   align="center"  > <!--{$DATA_TB[x].r_cabang__nama}-->  </TD>
                <TD  align="center"  > <!--{$DATA_TB[x].r_subcab__nama}--> </TD> 
                <TD  align="center"  > <!--{$DATA_TB[x].r_dept__ket}--> </TD>
                <TD  align="center"  > <!--{$DATA_TB[x].t_rkp__awal}--></TD>
                <TD   align="center"  > <!--{$DATA_TB[x].t_rkp__akhir}--> </TD>
                <TD   align="center"  >  
                 <!--{if ($DATA_TB[x].t_rkp__approval) ==1}-->
                                Telah disetujui HRD
                <!--{elseif ($DATA_TB[x].t_rkp__approval) ==2}-->
                                 <font color="green">Telah disetujui BOM</font>
                <!--{elseif ($DATA_TB[x].t_rkp__approval) ==3}-->  
                                 <font color="#1384a0">Telah disetujui HGLM</font>
                <!--{elseif ($DATA_TB[x].t_rkp__approval) ==4}-->  
                                 <font color="#d15e93">Closing</font>
                <!--{else}-->   
                            <font color="#ff0000">Tidak Disetujui</font>
                    <!--{/if}-->  

                </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__hadir}--> </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__sakit}--> </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__izin}--> </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__alpa}--> </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__dinas}--> </TD>
                <TD align="center"  > <!--{$DATA_TB[x].t_rkp__cuti}--></TD>
                <TD align="center"  > 
                     <!--{if ($DATA_TB[x].t_rkp__keterangan) =='KURANG'}-->
                      <font color="#ff0000"><!--{$DATA_TB[x].t_rkp__keterangan}--></font>
                        <!--{else}-->
                      <!--{$DATA_TB[x].t_rkp__keterangan}-->   
                    <!--{/if}-->
                </TD>
                <INPUT TYPE="hidden" name="tahun" value="<!--{$DATA_TB[x].t_rkp__thn}-->">
                <INPUT TYPE="hidden" name="bulan" value="<!--{$DATA_TB[x].t_rkp__bln}-->">
                <TD  width="20"  align="center" ALIGN="CENTER">
                <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].t_rkp__no_mutasi}-->&tahun=<!--{$DATA_TB[x].t_rkp__thn}-->&bulan=<!--{$DATA_TB[x].t_rkp__bln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].t_rkp__no_mutasi}--> &mod_id=<!--{$MOD_ID}-->&tahun=<!--{$DATA_TB[x].t_rkp__thn}-->&bulan=<!--{$DATA_TB[x].t_rkp__bln}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>

        </TR>
        <!--{sectionelse}-->
        <TR>
                <TD  COLSPAN="16" align="center">Maaf, Data masih kosong</TD>
        </TR>
<!--{/section}-->
</tbody>
</table>
<div id="panel-footer">
    <!--halaman -->
 
    <!--halaman -->
</div>       </td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>