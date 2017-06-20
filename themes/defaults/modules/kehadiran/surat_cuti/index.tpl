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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        buttons: ['excel','colvis'],
       language: {search: "Pencarian:",buttons: {colvis: 'Atur Kolom'}},
        select: {style: 'single'},
          Sorting: [[ 2, "desc" ]], 
          pageLength: "50", 
    // lengthMenu: [ 50, 100, 300, 1000],
       fixedColumns:   { leftColumns: 4,rightColumns:0 }

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
<!-- #EndEditable -->
</HEAD>
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Cuti</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                    <TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
              <TR>
                        <TD>No Cuti <font color="#ff0000">*</font></TD>
                                 <TD>
                                    <!--{if $EDIT_VAL==0}-->
                                        <INPUT  readonly=""  TYPE="text" name="cuti__no" size="35" value="<!--{$ID_PELATIHAN}-->"  onkeypress="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
					<!--{else}-->
                                        <INPUT  readonly=""  TYPE="text" name="cuti__no" size="35" value="<!--{$EDIT_T_CUTI__NO}-->"  onkeypress="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
					<!--{/if}-->  
                                      
                                </TD>   
            </TR>                              
            
            <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang" onchange="cari_subcab(this.value);"> 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_T_CUTI__CABANG}-->
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

                                                <SELECT name="kode_cabang" >
                                                        <option value=""> Pilih Cabang </option>
                                                                        <!--{section name=x loop=$DATA_CABANG}-->

                                                                        <!--{if ($OPT==1)}-->

                                                                                <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_T_LEMBUR__CABANG}-->
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
                            <TD><INPUT TYPE="text" NAME="karyawan_nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_T_LEMBUR__PEGAWAI_NAMA}-->">
                             NIP   <INPUT TYPE="text" NAME="karyawan_nip" readonly id="r_pnpt__no_mutasi" size="35" value="<!--{$EDIT_T_LEMBUR__PEGAWAI_NIP}-->" >
                                
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>

                    </TR>
                  <!-- <TR>
                            <TD>Cek Cuti<font color="#ff0000">*</font> </TD>
                            <TD><INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="cek_sisa_cuti()" value=" ... " />
                            </TD>

                    </TR>*} -->
                    
                    <TR>
                            <TD>Nama Atasan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="atasan__nama" readonly  id="atasan_nama"  size="35" value="<!--{$EDIT_T_CUTI__ATASAN_NAMA}-->">
                             NIP<INPUT TYPE="text" NAME="atasan__nip" readonly id="mutasi_atasan" size="35" value="<!--{$EDIT_T_CUTI__ATASAN_NIP}-->" >
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan2()" value=" ... " />
                            </TD>
                    </TR>
                    <TR>
				<TD>Tanggal Awal Cuti</TD>
			
                                <TD>
                                    <!--{if $EDIT_VAL==0}-->

                                    <input readonly="" type="text" NAME="tgl_awal"  value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                                        <input readonly=""  type="text" name="tgl_awal" value="<!--{$EDIT_T_CUTI__AWAL}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->  
                                      
                                </TD>         
                                        
                                
			
			</TR>
                        <TR>
				<TD>Tanggal Akhir Cuti </TD>
			
                                <TD>
                                    <!--{if $EDIT_VAL==0}-->

                                    <input readonly="" type="text" NAME="tgl_akhir"  value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                                        <input readonly=""  type="text" name="tgl_akhir" value="<!--{$EDIT_T_CUTI__AWAL}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->  
                                      
                                </TD>         
                                        
                                
			
			</TR>
                        <TR onclick="cek_cuti()" >
				<TD>Lama Hari</TD>
			
                                <TD><input type="text" NAME="lama_hari" size="10" value="<!--{$EDIT_T_CUTI__LAMA}-->" onkeydown="cek_cuti()" onkeyup="formatangka(this)"> Hari		
                                </TD>         
                                        
                                
			
			</TR>
                         <TR>
                        <TD>Rincian Cuti<font color="#ff0000">*</font> </TD>
                            <TD> 
                                <div id="cekcuti">
                                   <TABLE class='tborder' border='0' cellpadding='0' cellspacing='0' border='0' width='100%' align='left'>
                                       <THEAD>
                                       <th class='tdatahead' align='left' width='10%'>Tgl Masuk</th>
                                         <th class='tdatahead' align='left' width='10%'>Approval Hak Cuti</th>
                                         <th class='tdatahead' align='left' width='10%'>Periode Aktif</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Cuti Bersama</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Cuti Tahunan</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Cuti Khusus</th>
                                         <th class='tdatahead'  align='left'  width='10%'>Sisa Cuti Tahunan</th>
				  </THEAD>
                                  <TR>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_nominal' value=<!--{$CEK_TGL_MASUK}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_jml' value=<!--{$CEK_LABEL}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_makan' value=<!--{$CEK_AKTIF}-->s/d<!--{$CEK_EXPIRED}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_transport' value=<!--{$CEK_JML_CUTI}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_total' value=<!--{$CEK_JML_THN_AMBIL}-->></TD>
                                   <TD><INPUT TYPE='text' readonly='' name='lembur_total' value=<!--{$CEK_JML_KHS_AMBIL}-->></TD>
                                       <TD><INPUT TYPE='text' readonly='' name='lembur_total' value=<!--{$CEK_LABEL_SISA}-->></TD>
                                   </TABLE>
                      
                            </div>
                                   <INPUT  type="button" class="button" style="cursor: hand;"  value="Cek" onkeydown="cek_cuti()" />
                        <INPUT  type="button" class="button" style="cursor: hand;"  value="Report" onclick="report_cuti()" /> 
                            </TD>
                    </TR>
                        <TR>
                                <TD>Jenis Cuti  <font color="#ff0000">*</font></TD> 
			
					<TD><SELECT name="jenis_cuti">
							<OPTION value="">[Pilih Jenis Cuti]</OPTION>
							<OPTION value="1" <!--{if $EDIT_T_CUTI__JENIS=='1'}-->selected<!--{/if}-->>Cuti Tahunan</OPTION>
							<OPTION value="2" <!--{if $EDIT_T_CUTI__JENIS=='2'}-->selected<!--{/if}-->>Cuti Khusus</OPTION>  
                                                       
						</SELECT>
                                        </TD>
                    </TR>

                     <TR>
                                <TD>Alasan<font color="#ff0000">*</font></TD> 
                                <TD><textarea rows="5" cols="20" NAME="alasan"  size="12" ><!--{$EDIT_T_CUTI__ALASAN}--></textarea></TD>
                    </TR>
                
                    
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
                                                                    <DIV id="ajax_subcabang">
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
                                            <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari" ></TD>
                                        </TR>
                                        <TR>
                                            <TD>Finger Print</TD><TD><INPUT TYPE="text" NAME="finger_cari" ></TD>
                                        </TR>
                                        <TR>
                                            <TD>Periode Awal  <font color="#ff0000">*</font></TD>
                                        <TD>
                                    <input type="text"  NAME="awal" value="">
				<img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmList1.awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
				
                                
                                </TD>
			</TR>  
                        <TR>
				<TD>Periode Akhir  <font color="#ff0000">*</font></TD>
                                <TD>
                                <input type="text"  NAME="akhir" value="">
				<img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmList1.akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					
                                
                                
                                </TD>
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
		<tr><td class="tcat"> Pengajuan Cuti HRD</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Pengajuan Cuti HRD</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
		<thead class="tdatahead">
                <th class="alt2" align="left">NO</TH>
                <th class="alt2" align="left" width="10%">NAMA KARYAWAN</TH>
                <th class="alt2" abbr="" align="left" width="10%">NIP KARYAWAN</TH>
                <th class="alt2" align="left" width="10%">FINGER PRINT</TH>
                <th class="alt2" align="left">CABANG</TH>
                <th class="alt2" align="left">DEPARTEMEN</TH>
                <th class="alt2" align="left">TGL MASUK</TH>
                <th class="alt2" align="left">NAMA ATASAN</TH>
                <th class="alt2" align="left">TGL PENGAMBILAN</TH>
                <th class="alt2" align="left">JENIS CUTI </TH>
                <th class="alt2" align="left">LAMA CUTI</TH>
                <th class="alt2" align="left">ALASAN</TH>
                <th class="alt2" ><!--{$ACTION}--></th>
			
		</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<TR >
                        <TD class="tdatacontent" width="17" > <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__tgl_masuk|date_format:"%d-%b-%Y"}--> </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].t_cuti__atasan_nama}--></TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].t_cuti__awal|date_format:'%d-%m-%y'}--> &nbsp;s/d &nbsp;<!--{$DATA_TB[x].t_cuti__akhir|date_format:'%d-%m-%y'}--></TD>
                        <TD class="tdatacontent">

                            <!--{if ($DATA_TB[x].t_cuti__jenis_cuti) ==1}-->
                              <font color="#ff1a1a"> Cuti Tahunan</font>
                            <!--{else ($DATA_TB[x].t_cuti__jenis_cuti) ==2}-->  
                               <font color="#4d4dff"> Cuti Khusus</font>
                            <!--{/if}--> 


                        </TD>
                        <TD class="tdatacontent"> <!--{$DATA_TB[x].t_cuti__lama_hari}--> Hari</TD>
                        <TD class="tdatacontent"><!--{$DATA_TB[x].t_cuti__alasan}--></TD>


                        <TD class="tdatacontent" width="60" class="tdatacontent" ALIGN="CENTER">
                            <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].t_cuti__no}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                        <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].t_cuti__no}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                        <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/print.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="" onclick=" window.open('../../../laporan/inc.cuti_detail.php?id=<!--{$DATA_TB[x].r_pnpt__no_mutasi}-->');" class="imgLink"></TD>
                        </TR>
                        <!--{sectionelse}-->
                        <TR>
                        <TD class="tdatacontent" COLSPAN="14" align="center">Maaf, Data masih kosong</TD>
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
