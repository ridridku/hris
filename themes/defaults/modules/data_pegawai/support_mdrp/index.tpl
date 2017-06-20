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
</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{"Pengajuan MDRP"}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">Klarifikasi Mutasi/Promosi/Rotasi</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Form MDRP</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                    <TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
        
            <TR>
                        <TD>No Formulir <font color="#ff0000">*</font></TD>
                        <TD>
                            <!--{if $EDIT_VAL==0}-->
                            <DIV id="ajax_cek_id">
                                <INPUT  TYPE="text" name="no_mdrp" size="35" value=""  OnChange="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?no_mdrp='+frmCreate.no_mdrp.value)">
                            </DIV>
                        <!--{else}-->
                            <div id="ajax_cek_id">
                                <INPUT readonly=""  TYPE="text" name="no_mdrp" size="35" value="<!--{$EDIT_FORMULIR}-->" OnChange="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?no_mdrp='+frmCreate.no_mdrp.value)">
                            </DIV>
                        <!--{/if}-->
                        </TD>
            </TR>  
              <TR>
                    <TD><font color="#045df7" size="2">JABATAN LAMA</font></TD> 
                    <TD></TD>      
                     </TR> 
            <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD>
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang" onchange="cari_subcab(this.value);">
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_CABANG_LAMA}-->
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

                                                <SELECT name="kode_cabang" onchange="cari_subcab(this.value);">
                                                        <option value=""> Pilih Cabang </option>
                                                                        <!--{section name=x loop=$DATA_CABANG}-->

                                                                        <!--{if ($OPT==1)}-->

                                                                                <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_CABANG_LAMA}-->
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
                            <TD>
                             <INPUT TYPE="text" NAME="nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_NAMA}-->">
                             <INPUT TYPE="text" NAME="id_pegawai" readonly id="id_pegawai" size="35" value="<!--{$EDIT_PEGAWAI_ID}-->" >
                             <INPUT TYPE="hidden" NAME="cabang_lama" readonly id="r_cabang__nama" size="35" value="<!--{$EDIT_NAMACABANG_LAMA}-->" > 
                             <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value="..."/>
                            </TD>
                    </TR>
                     <TR>
                        <TD>Departemen Lama<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="dep_lama" readonly id="dep_lama" size="35" value="<!--{$EDIT_DEP_LAMA}-->" ></TD>                                			                       
                    </TR>
                     <TR>
                        <TD>Sub Departemen Lama<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="subdep_lama" readonly id="subdep_lama" size="35" value="<!--{$EDIT_SUBDEP_LAMA}-->" ></TD>                                			                       
                    </TR>
                    <TR>
                        <TD>Jabatan Lama<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="jabatan_lama" readonly id="r_jabatan__ket" size="35" value="<!--{$EDIT_JAB_LAMA}-->" ></TD>                                			                       
                    </TR>
                   
                    <TR>
                        <TD>Tanggal Masuk Karyawan </TD>
                        <TD><input type="text" name="tgl_masuk" id="tgl_masuk" value="<!--{$EDIT_TGL_MSK|date_format:'%d-%b-%Y'}-->" readonly="">
			</TD>         
                    </TR>
                    
                    <TR>
                        <TD>Lama Bekerja<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="lama_kerja" readonly id="lama_kerja" size="10" value="<!--{$EDIT_LAMA_KERJA}-->"> Tahun</TD>                                			                       
                    </TR>
                     <TR>
                    <TD><font color="#045df7" size="2">JABATAN BARU</font></TD> 
                    <TD></TD>      
                     </TR>             
                        <TR>
                    <TD>Lokasi Cabang Baru <font color="#ff0000">*</font>
                    </TD>
                            <TD>

                            <select name="cabang_baru" onchange="cari_subcab(this.value);">
                                <option value="" selected=""> Pilih Cabang </option>
                                    <!--{section name=x loop=$DATA_CABANG}-->
                                    <!--{if trim($DATA_CABANG[x].r_cabang__id)==$EDIT_CAB_BARU}-->
                                    <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->" selected > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                    <!--{else}-->
                                    <option value="<!--{$DATA_CABANG[x].r_cabang__id}-->"  > <!--{$DATA_CABANG[x].r_cabang__nama}--> </option>
                                    <!--{/if}-->
                            <!--{/section}-->
                            </SELECT>

                            </TD>
                            </TR>
                                                   
                                                   
                                                  <TR>
                        <TD>Pilih Sub Cabang <font color="#ff0000">*</font></TD>
                        <TD>
                        
                            <DIV id="ajax_subcabang">
                                   <!--{if ($OPT==1)}-->
                                    <select name="subcabang_baru" >
                                    <option value="">[Pilih Sub Cabang]</option>
                                    <!--{section name=x loop=$DATA_SUBCABANG}-->
                                    <!--{if trim($DATA_SUBCABANG[x].r_subcab__id)==$EDIT_SUB_BARU}-->
                                    <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                    <!--{else}-->
                                    <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                    <!--{/if}-->
                                    <!--{/section}-->                                   
                                    <!--{else}-->
                                      <select name="subcabang_baru" >
                                    <option value="">[Pilih Sub Cabang]</option>
                                     
                                     
                                         </select>
                                       <!--{/if}-->
                                       
                               
                                      
                                           
                                            
                            </DIV>
                                 
                        </TD>
                </TR>
                <TR>
                        <TD>Departemen <font color="#ff0000">*</font></TD>
                            <TD>
                                        <select name="dep_baru" onchange="cari_subdep(this.value);">
                                        <option value="">[Pilih Departemen]</option>
                                        <!--{section name=x loop=$DATA_DEPARTEMEN}-->
                                        <!--{if trim($DATA_DEPARTEMEN[x].r_dept__id)==$EDIT_DEP_BARU}-->
                                        <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->" selected > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                        <!--{else}-->
                                        <option value="<!--{$DATA_DEPARTEMEN[x].r_dept__id}-->"  > <!--{$DATA_DEPARTEMEN[x].r_dept__ket}--> </option>
                                        <!--{/if}-->
                                        <!--{/section}-->
                                        </select>
                            </TD>
                    </TR>
                    <TR>
                           <TD>Sub Departemen <font color="#ff0000">*</font></TD>
                           <TD> <DIV id="ajax_subdep">
                                       <select name="subdep_baru" onChange="cari_jabatan(this.value);">
                                       <option value="">[Pilih Sub Departemen]</option>
                                       <!--{section name=x loop=$DATA_SUBDEP}-->
                                       <!--{if trim($DATA_SUBDEP[x].r_subdept__id)==$EDIT_SUBDEPT_BARU}-->
                                       <option value="<!--{$DATA_SUBDEP[x].r_subdept__id}-->" selected > <!--{$DATA_SUBDEP[x].r_subdept__ket}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_SUBDEP[x].r_subdept__id}-->"  > <!--{$DATA_SUBDEP[x].r_subdept__ket}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select>
                               </DIV>

                           </TD>
                   </TR> 
                    <TR>
                           <TD>Jabatan <font color="#ff0000">*</font></TD>
                           <TD><DIV id="ajax_jabatan">
                                       <select name="jabatan_baru" >
                                       <option value="">[Pilih Jabatan]</option>
                                       <!--{section name=x loop=$DATA_JABATAN}-->
                                       <!--{if trim($DATA_JABATAN[x].r_jabatan__id)==$EDIT_JAB_BARU}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->" selected > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->"  > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select></DIV>
                           </TD>
                   </TR>
                     <TR>
                           <TD>Keterangan MDRP <font color="#ff0000">*</font></TD>
                           <TD>
                                         <select name="tipe_mdrp">
                                       <option value="">[Pilih Keterangan MDRP]</option>
                                       <!--{section name=x loop=$DATA_TIPEPDRM}-->
                                       <!--{if trim($DATA_TIPEPDRM[x].tipe_penempatan__pdrm)==$EDIT_JENIS_PENEMPATAN}-->
                                       <option value="<!--{$DATA_TIPEPDRM[x].tipe_penempatan__pdrm}-->" selected > <!--{$DATA_TIPEPDRM[x].tipe_penempatan}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_TIPEPDRM[x].tipe_penempatan__pdrm}-->"  > <!--{$DATA_TIPEPDRM[x].tipe_penempatan}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select>
                           </TD>
                   </TR>
                       <!--{if $GROUP_USER==2}-->
                       <input type="hidden" name="status" value="0">
                          <!--{/if}-->
                        
                        <!--{if $GROUP_USER==1}-->
                         <TR>
				<TD>Tanggal Efektif </TD>
			
                                  <TD>
                                    <!--{if $EDIT_VAL==0}-->

							 <input type="text" NAME="tgl_efektif"  value="<!--{$smarty.now|date_format:"%Y-%m-%d"}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_efektif,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                                        <input type="text" name="tgl_efektif" value="<!--{$EDIT_TGL_EFEKTIF}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_efektif,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->           
                                </TD>         
			</TR>
                        <TR>
                            
                                <TD>Status aktif <font color="#ff0000">*</font></TD> 
				<TD>
                                    <SELECT name="status">
							<OPTION value="">[Pilih Approval]</OPTION>
							<OPTION value="1"  <!--{if $EDIT_STATUS=='1'}-->selected<!--{/if}-->>Sudah Disetujui</OPTION>
							<OPTION value="0" <!--{if $EDIT_STATUS=='0'}-->selected<!--{/if}-->>Belum Disetujui</OPTION>                                                       
                                    </SELECT>
                                </TD>
                     </TR>
                    <!--{/if}--> 
                    
                    
                    
                    <TR><TD height="40"></TD>
                            <TD>
                            <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                            <INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
                            <INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
                            <INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
                            <INPUT TYPE="hidden" name="op" value="0">
                            <INPUT TYPE="hidden" name="mdrp_id" value="<!--{$EDIT_MDRP_ID}-->">



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
		<TABLE id="table-search-box">
                <TR>
                <TD>Cabang <font color="#ff0000">*</font></TD> 
                <TD><!--{if ($JENIS_USER_SES==1)}-->

                                        <SELECT name="kode_cabang_cari" onchange="cari_subcab2(this.value);"> 
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
								<TD>Status</TD>
								<TD>
                                                                            <select name="status_cari" >
                                                                            <option value="">[Pilih Status]</option>
                                                                            <OPTION value=1>Disetujui</OPTION>
                                                                            <OPTION VALUE=2>Tidak Disetujui</OPTION>
                                                                            </select> 
                                                                            
                                                   
                                                                    
                                                                </TD>
                                                     </TR> 
                                                    <TR>
                                                                <TD>Keterangan MDRP <font color="#ff0000">*</font></TD>
                                                                <TD>
                                                                              <select name="mdrp_cari">
                                                                            <option value="">[Pilih Keterangan MDRP]</option>
                                                                            <!--{section name=x loop=$DATA_TIPEPDRM}-->
                                                                            <!--{if trim($DATA_TIPEPDRM[x].tipe_penempatan__pdrm)==$EDIT_JENIS_PENEMPATAN}-->
                                                                            <option value="<!--{$DATA_TIPEPDRM[x].tipe_penempatan__pdrm}-->" selected > <!--{$DATA_TIPEPDRM[x].tipe_penempatan}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_TIPEPDRM[x].tipe_penempatan__pdrm}-->"  > <!--{$DATA_TIPEPDRM[x].tipe_penempatan}--> </option>
                                                                            <!--{/if}-->
                                                                            <!--{/section}-->
                                                                            </select>
                                                                </TD>
                                                     </TR>  
                            <TR>
                                    <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari" ></TD>
                            </TR>
                            <TR>
							<TD>Periode</TD>
							<TD>						
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="01"<!--{if $BULAN_SES==1}-->selected<!--{/if}-->>Januari</OPTION>
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
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
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
		<tr><td class="tcat">Klarifikasi Promosi / Mutasi /Rotasi</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Daftar Pegawai Keluar</td></tr>
		<tr><td class="alt2" style="padding:0px;">
                <table id="example" class="display" cellpadding="6" cellspacing="6" width="100%">
                <thead class="tdatahead">
                            <TH class="alt2" align="left">NO</TH>
                            <TH class="alt2" align="left" width="10%">NO FORMULIR</TH>
                            <TH class="alt2" align="left" width="10%">FINGER PRINT </TH>
                            <TH  class="alt2" align="left" width="10%">NAMA</TH>                                                                                       
                            <TH class="alt2" align="left" >CABANG LAMA</TH>
                            <TH class="alt2" align="left">DEPARTEMEN LAMA</TH>
                            <TH class="alt2" align="left" >JABATAN LAMA</TH>                                                                                       
                            <TH class="alt2" align="left" width="10%">CABANG BARU</TH>
                            <TH class="alt2" align="left"> DEPARTEMEN BARU</TH>   
                            <TH class="alt2" align="left">JABATAN BARU</TH> 
                            <TH class="alt2" align="left">JENIS MDRP</TH> 
                            <TH class="alt2" align="left">TGL Effektif</TH>   
                            <!--if $GROUP_USER==1}-->
                            <TH class="alt2" align="left">STATUS</TH>   
                            <!--/if }-->
                            <TH   class="alt2" ><!--{$ACTION}--></TH>

                </THEAD>
                    <tbody class="tdatacontent">
                            <!--{section name=x loop=$DATA_TB}-->
                            <TR>
                            <TD> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                            <TD> <!--{$DATA_TB[x].formulir}--> </TD>
                            <TD> <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                            <TD> <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                            <TD> <!--{$DATA_TB[x].nama_cabang_lama}--> </TD>
                            <TD> <!--{$DATA_TB[x].dep_lama}-->  </TD>
                            <TD> <!--{$DATA_TB[x].jab_lama}--> </TD>                                                                                        
                            <TD> <!--{$DATA_TB[x].cabang_baru}--></TD>											
                            <TD><!--{$DATA_TB[x].dep_baru}--></TD>  
                            <TD><!--{$DATA_TB[x].jab_baru}--></TD>
                            <TD><!--{$DATA_TB[x].jenis_mdrp}--></TD>
                            <TD><!--{$DATA_TB[x].mdrp__efektif}--></TD>
                            <!--if $GROUP_USER==1}-->
                            <TD> 
                            <!--{if ($DATA_TB[x].mdrp__status)==1}-->
                            <font color="#3423ef">Sudah Disetujui</font>
                            <!--{else ($DATA_TB[x].r_resign__approval) ==0}-->  
                            <font color="#FF0000">Belum Disetujui</font>     
                            <!--{/if}--> 
                            </TD>	 
                            <!--/if}-->
                            <TD width="20" ALIGN="CENTER">
                            <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].mdrp__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                            &nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].mdrp__id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
                            </TD>
                            </TR>
                            <!--{sectionelse}-->
                            <TR>
                            <TD COLSPAN="14" align="center">Maaf, Data masih kosong</TD>
                            </TR>
                            <!--{/section}-->
                            </TBODY>
                            </TABLE>
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
