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
  //  background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
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
		<tr><td class="tcat"> Data Pegawai</td></tr>
		</table>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">

		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" enctype="multipart/form-data">
              <!--  </FORM>
                <FORM METHOD=POST ACTION="" NAME="frmList"> -->
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">
		<div id="tcat">
		[ <a href="#" onClick="document.getElementById('table-search-box1').style.display='block';document.getElementById('table-search-box2').style.display='none';document.getElementById('table-search-box3').style.display='none'; document.getElementById('table-search-box4').style.display='none';document.getElementById('table-search-box5').style.display='none';document.getElementById('table-search-box6').style.display='none';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none';">Pribadi</a> |
		<a href="#" onClick="document.getElementById('table-search-box1').style.display='none';document.getElementById('table-search-box2').style.display='block';document.getElementById('table-search-box3').style.display='none';document.getElementById('table-search-box4').style.display='none';document.getElementById('table-search-box5').style.display='none';document.getElementById('table-search-box6').style.display='none';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none'; ">Data Orang Tua</a> |
		<a href="#" onClick="document.getElementById('table-search-box1').style.display='none';document.getElementById('table-search-box2').style.display='none';document.getElementById('table-search-box3').style.display='block';document.getElementById('table-search-box4').style.display='none';document.getElementById('table-search-box5').style.display='none';document.getElementById('table-search-box6').style.display='none';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none';">Data Menikah</a> |
		<a href="#" onClick="document.getElementById('table-search-box1').style.display='none';document.getElementById('table-search-box2').style.display='none';document.getElementById('table-search-box3').style.display='none';document.getElementById('table-search-box4').style.display='block';document.getElementById('table-search-box5').style.display='none';document.getElementById('table-search-box6').style.display='none';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none';">Asuransi & NPWP</a> |
		<a href="#" onClick="document.getElementById('table-search-box1').style.display='none';document.getElementById('table-search-box2').style.display='none';document.getElementById('table-search-box3').style.display='none';document.getElementById('table-search-box4').style.display='none';document.getElementById('table-search-box5').style.display='block';document.getElementById('table-search-box6').style.display='none';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none';">Data Bank</a> |
		<a href="#" onClick="document.getElementById('table-search-box1').style.display='none';document.getElementById('table-search-box2').style.display='none';document.getElementById('table-search-box3').style.display='none';document.getElementById('table-search-box4').style.display='none';document.getElementById('table-search-box5').style.display='none';document.getElementById('table-search-box6').style.display='block';document.getElementById('table-search-box7').style.display='none';document.getElementById('table-search-box8').style.display='none';document.getElementById('table-search-box9').style.display='none';document.getElementById('table-search-box10').style.display='none';">Pendidikan</a> ]</div>		
		</td></tr>
		
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="alt2" style="padding:0px;">
		<div id="table-search-box1">
		

		<table width="100%">
                    <input type="hidden" name="r_pegawai__id"> 
                     <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Tgl Mulai Masuk Di PT.TMW <font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td width="622" class="tdatacontent">
                                <!--{if $EDIT_VAL==0}-->

                                <input type="text" NAME="r_pegawai__tgl_masuk"  readonly="" value="<!--{$TODAY}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" readonly="" name="r_pegawai__tgl_masuk" value="<!--{$EDIT_R_PEGAWAI__TGL_MASUK}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->                                </td>
			                    <td width="177" colspan="2" rowspan="7" class="tdatacontent">
                                               <!--{if $EDIT_VAL==1&&$ADA_IMAGE==1}-->
                                              <img src="<!--{$HREF_FOTO}-->/<!--{$FOTO_NAME}-->" width=105 height=134 >
                                             <!--{/if}-->
                                              <!--{if $EDIT_VAL==1&&$ADA_IMAGE==0}-->
                                              <img src="<!--{$HREF_FOTO}-->/<!--{$FOTO_NAME}-->" width=105 height=134 >
                                             <!--{/if}-->
                                             
                                            </td>
                  </tr>
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Nama Pegawai  <font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__nama" value="<!--{$EDIT_R_PEGAWAI__NAMA}-->" ></td>
                  </tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Tempat Lahir<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__tmpt_lahir" value="<!--{$EDIT_R_PEGAWAI__TMPT_LAHIR}-->" ></td>
                  </tr>
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Tgl Lahir<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent">
                                    <!--{if $EDIT_VAL==0}-->

                                    <input type="text" NAME="r_pegawai__tgl_lahir"  readonly="" value="<!--{$TODAY}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input readonly="" type="text" name="r_pegawai__tgl_lahir" value="<!--{$EDIT_R_PEGAWAI__TGL_LAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->                                </td>
                  </tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Jenis Kelamin<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent">
                                        <select name="r_pegawai__jk" >
                                        <option value="">[Pilih Status]</option>
                                       <OPTION value="LAKI-LAKI" <!--{if $EDIT_R_PEGAWAI__JK == 'LAKI-LAKI'}--> selected <!--{/if}--> >Laki-laki</OPTION>
					<OPTION value="PEREMPUAN" <!--{if $EDIT_R_PEGAWAI__JK == 'PEREMPUAN'}--> selected <!--{/if}-->>Perempuan</OPTION>
                                        </select>                                </td>
                  </tr>
                      
                                                
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">NIK KTP<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent">
                                    <div id="ajax_cek_id">
                                    <INPUT type="text" name="r_pegawai__ktp" maxlenght="16" onkeyup="angka(this)" value="<!--{$EDIT_R_PEGAWAI__KTP}-->" OnChange="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?r_pegawai__ktp='+frmCreate.r_pegawai__ktp.value)">
                                    </DIV>
                                    </td>
                  </tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">No SIM</td>
				<td class="tdatacontent" width="20">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__sim" value="<!--{$EDIT_R_PEGAWAI__SIM}-->" ></td>
                  </tr>
                         
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Agama<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                        <select name="r_pegawai__agama">
                                        <OPTION value="">[Pilih Status]</option>
                                        <OPTION value="1" <!--{if $EDIT_R_PEGAWAI__AGAMA== '1'}--> selected <!--{/if}--> >Islam</OPTION>
					<OPTION value="2" <!--{if $EDIT_R_PEGAWAI__AGAMA== '2'}--> selected <!--{/if}-->>Katolik</OPTION>
					<OPTION value="3" <!--{if $EDIT_R_PEGAWAI__AGAMA== '3'}--> selected <!--{/if}--> >Budha</OPTION>
					<OPTION value="4" <!--{if $EDIT_R_PEGAWAI__AGAMA== '4'}--> selected <!--{/if}-->>Protestan</OPTION>
                                        <OPTION value="5" <!--{if $EDIT_R_PEGAWAI__AGAMA== '5'}--> selected <!--{/if}-->>Hindu</OPTION>
                                        </select>                                </td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Propinsi KTP<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent"><select name="r_pegawai__ktp_prov" onChange="cari_kab_ktp(this.value);">
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI_KTP}-->
						<!--{if trim($DATA_PROPINSI_KTP[x].r_provinsi__id) == $EDIT_R_PEGAWAI__KTP_PROV}-->
						<option value="<!--{$DATA_PROPINSI_KTP[x].r_provinsi__id}-->" selected > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI_KTP[x].r_provinsi__id}-->"  > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select></td>
			</tr>
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Kabupaten / Kota KTP<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                    <div id="ajax_kabupaten_ktp">
                                     <select name="r_pegawai__ktp_kab" onChange="cari_kec(this.value);">
						<option value="">[Pilih Kabupaten]</option>
						<!--{section name=x loop=$DATA_KABUPATEN_KTP}-->
						<!--{if trim($DATA_KABUPATEN_KTP[x].r_kabupaten__id) == $EDIT_R_PEGAWAI__KTP_KAB}-->
						<option value="<!--{$DATA_KABUPATEN_KTP[x].r_kabupaten__id}-->" selected > <!--{$DATA_KABUPATEN_KTP[x].r_kabupaten__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KABUPATEN_KTP[x].r_kabupaten__id}-->"  > <!--{$DATA_KABUPATEN_KTP[x].r_kabupaten__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select> 
                                  </div>                                </td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Kecamatan KTP<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent">
                                <div id="ajax_kecamatan_ktp">
					<select name="r_pegawai__ktp_kec" > 
						<option value="">[Pilih Kecamatan]</option>
						<!--{section name=x loop=$DATA_KECAMATAN_KTP}-->
						<!--{if trim($DATA_KECAMATAN_KTP[x].r_kecamatan__id) == $EDIT_R_PEGAWAI__KTP_KEC}-->
						<option value="<!--{$DATA_KECAMATAN_KTP[x].r_kecamatan__id}-->" selected > <!--{$DATA_KECAMATAN_KTP[x].r_kecamatan__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KECAMATAN_KTP[x].r_kecamatan__id}-->"<!--{$DATA_KECAMATAN_KTP[x].r_kecamatan__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>										
					</div>                           </td>
			</tr>   
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Desa / Kelurahan KTP<font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent">
                                    <div id="ajax_kecamatan2_ktp">
                                       <select name="r_pegawai__ktp_desa"> 
						<option value="">[Pilih Desa]</option>
					<!--{section name=x loop=$DATA_DESA_KTP}-->
						<!--{if trim($DATA_DESA_KTP[x].r_desa__id) == $EDIT_R_PEGAWAI__KTP_DESA}-->
						<option value="<!--{$DATA_DESA_KTP[x].r_desa__id}-->" selected > <!--{$DATA_DESA_KTP[x].r_desa__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_DESA_KTP[x].r_desa__id}-->"<!--{$DATA_DESA_KTP[x].r_desa__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
                                       </SELECT>
                                    </div>                          </td>
			</tr>
                        
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">RT/RW KTP</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                    RT<INPUT type="text" name="r_pegawai__ktp_rt" value="<!--{$EDIT_R_PEGAWAI__KTP_RT}-->" size="5" >
                                    RW<INPUT type="text" name="r_pegawai__ktp_rw"  value="<!--{$EDIT_R_PEGAWAI__KTP_RW}-->" size="5" >                                </td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Kode Pos KTP</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__ktp_kodepos" value="<!--{$EDIT_R_PEGAWAI__KTP_KODEPOS}-->" ></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Alamat KTP </td>
				<td class="tdatacontent" width="20">:</td>
                             
                               
			
                                <TD colspan="3"><textarea rows="5" cols="50"  NAME="r_pegawai__nama_jalan"  size="12" ><!--{$EDIT_R_PEGAWAI__ALAMAT}--></textarea></TD>
			</tr>
                        
                        
                        
                        <tr class='<!--{cycle values="alt,alt3"}-->' >
                            <td class="tdatacontent" width="249"><u><B> ALAMAT DOMISILI</U></B></td>
				<td class="tdatacontent" width="20"></td>
				<td colspan="3" class="tdatacontent"></td>
			</tr>      
			
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Propinsi Domisili</td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent"><select name="r_pegawai__alm_prov" onChange="cari_kab_alm(this.value);">
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI_ALM}-->
						<!--{if trim($DATA_PROPINSI_ALM[x].r_provinsi__id) == $EDIT_R_PEGAWAI__ALM_PROV}-->
						<option value="<!--{$DATA_PROPINSI_ALM[x].r_provinsi__id}-->" selected > <!--{$DATA_PROPINSI_ALM[x].r_provinsi__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI_ALM[x].r_provinsi__id}-->"  > <!--{$DATA_PROPINSI_ALM[x].r_provinsi__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select></td>
			</tr>
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Kabupaten / Kota Domisili</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                    <div id="ajax_kabupaten_alm">
                                     <select name="r_pegawai__alm_kab" onChange="cari_kec(this.value);">
						<option value="">[Pilih Kabupaten]</option>
						<!--{section name=x loop=$DATA_KABUPATEN_ALM}-->
						<!--{if trim($DATA_KABUPATEN_ALM[x].r_kabupaten__id) == $EDIT_R_PEGAWAI__ALM_KAB}-->
						<option value="<!--{$DATA_KABUPATEN_ALM[x].r_kabupaten__id}-->" selected > <!--{$DATA_KABUPATEN_ALM[x].r_kabupaten__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KABUPATEN_ALM[x].r_kabupaten__id}-->"  > <!--{$DATA_KABUPATEN_ALM[x].r_kabupaten__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select> 
                                  </div>                                </td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Kecamatan Domisili</td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent">
                                <div id="ajax_kecamatan_alm">
					<select name="r_pegawai__alm_kec" > 
						<option value="">[Pilih Kecamatan]</option>
						<!--{section name=x loop=$DATA_KECAMATAN_ALM}-->
						<!--{if trim($DATA_KECAMATAN_ALM[x].r_kecamatan__id) == $EDIT_R_PEGAWAI__ALM_KEC}-->
						<option value="<!--{$DATA_KECAMATAN_ALM[x].r_kecamatan__id}-->" selected > <!--{$DATA_KECAMATAN_ALM[x].r_kecamatan__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KECAMATAN_ALM[x].r_kecamatan__id}-->"<!--{$DATA_KECAMATAN_ALM[x].r_kecamatan__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>										
					</div>                           </td>
			</tr>   
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Desa / Kelurahan Domisili</td>
				<td class="tdatacontent" width="20">:</td>
				<td colspan="3" class="tdatacontent">
                                    <div id="ajax_kecamatan2_alm">
                                       <select name="r_pegawai__alm_desa" > 
						<option value="">[Pilih Desa]</option>
					<!--{section name=x loop=$DATA_DESA_ALM}-->
						<!--{if trim($DATA_DESA_ALM[x].r_desa__id) == $EDIT_R_PEGAWAI__ALM_DESA}-->
						<option value="<!--{$DATA_DESA_ALM[x].r_desa__id}-->" selected > <!--{$DATA_DESA_ALM[x].r_desa__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_DESA_ALM[x].r_desa__id}-->"<!--{$DATA_DESA_ALM[x].r_desa__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
                                       </SELECT>
                                    </div>                          </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">RT/RW Domisili</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                    RT<INPUT type="text" name="r_pegawai__alm_rt" value="<!--{$EDIT_R_PEGAWAI__ALM_RT}-->" size="5" >
                                    RW<INPUT type="text" name="r_pegawai__alm_rw"  value="<!--{$EDIT_R_PEGAWAI__ALM_RW}-->" size="5" >                                </td>
			</tr>
                        
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Alamat Domisili </td>
				<td class="tdatacontent" width="20">:</td>
                                <TD class="tdatacontent"  colspan="3"><textarea rows="5" cols="50" NAME="r_pegawai__alm_kodepos"  size="12" ><!--{$EDIT_R_PEGAWAI__ALM_KODEPOS}--></textarea></TD>
			</tr>
                        
                        
                        
                        
                       <TR>
                           <TD colspan="3">---------------------------</TD>
                       </TR>
                         <TR class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">No HP/Telepon Pribadi</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__tlp_pribadi" value="<!--{$EDIT_R_PEGAWAI__TLP_PRIBADI}-->" ></td>
			</TR>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">No HP/Telepon (Suami/Istri/Keluarga) </td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__tlp_rumah" value="<!--{$EDIT_R_PEGAWAI__TLP_RUMAH}-->"  ></td>
			</tr>
                        
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Telepon Kantor / Inventaris</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__tlp_kantor" value="<!--{$EDIT_R_PEGAWAI__TLP_KANTOR}-->" ></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Gol Darah</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__gol_darah"  value="<!--{$EDIT_R_PEGAWAI__GOL_DARAH}-->"></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Tinggi</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__tinggi" value="<!--{$EDIT_R_PEGAWAI__TINGGI}-->" ></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Berat</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent"><INPUT type="text" name="r_pegawai__berat" value="<!--{$EDIT_R_PEGAWAI__BERAT}-->" ></td>
			</tr>
                        <TR  class='<!--{cycle values="alt,alt3"}-->'>
                                <TD class="tdatacontent">Cek Jika Akan Upload Foto</TD> 
				<TD class="tdatacontent">     
                                    <!-- <input type="text" disabled size="10" name="file_xls">-->
                                    <input type="checkbox" onClick="codename()" name="checkboxname" value="1">                          </TD>
                     </TR> 
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Foto</td>
				<td class="tdatacontent" width="20">:</td>
                                <td colspan="3" class="tdatacontent">
                                  <INPUT TYPE="file" disabled NAME="file_foto" size="35"  value="<!--{$FOTO_NAME}-->" >   
                                  <INPUT TYPE ="hidden"  name="foto2"  value="<!--{$FOTO_NAME}-->">                                </td>
			</tr>
		</table>
		</div>

<!-- #ORANGTUA -->		
		<div id="table-search-box2" style="font:12/22px arial;display:none;">
		<table width="100%">
                   
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Ayah   </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__ayah" value="<!--{$EDIT_R_PEGAWAI__AYAH}-->" ></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Ibu</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__ibu" value="<!--{$EDIT_R_PEGAWAI__IBU}-->"></td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Propinsi Orang Tua</td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent"><select name="r_pegawai__ortu_prov" onChange="cari_kab_ortu(this.value);"> 
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI_KTP}-->
						<!--{if trim($DATA_PROPINSI_KTP[x].r_provinsi__id) == $EDIT_R_PEGAWAI__ORTU_PROV}-->
						<option value="<!--{$DATA_PROPINSI_KTP[x].r_provinsi__id}-->" selected > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI_KTP[x].r_provinsi__id}-->"  > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select></td>
			</tr>
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Kabupaten Orang Tua</td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                    <div id="ajax_kabupaten_ortu">
                                    <select name="r_pegawai__ortu_kab" onChange="cari_kec_ortu(this.value);">
						<option value=""> Pilih Provinsi Orang Tua </option>
						<!--{section name=x loop=$DATA_KABUPATEN_ORTU}-->
						<!--{if trim($DATA_KABUPATEN_ORTU[x].r_kabupaten__id) == $EDIT_R_PEGAWAI__ORTU_KAB}-->
						<option value="<!--{$DATA_KABUPATEN_ORTU[x].r_kabupaten__id}-->" selected > <!--{$DATA_KABUPATEN_ORTU[x].r_kabupaten__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KABUPATEN_ORTU[x].r_kabupaten__id}-->"  > <!--{$DATA_KABUPATEN_ORTU[x].r_kabupaten__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
                                    </select>
                    </DIV>
                  </td>
			</tr>
                          <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Kecamatan Orang Tua </td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                <div id="ajax_kecamatan_ortu">
					<select name="r_pegawai__ortu_kec" > 
						<option value="">[Pilih Kecamatan]</option>
						<!--{section name=x loop=$DATA_KECAMATAN_ORTU}-->
						<!--{if trim($DATA_KECAMATAN_ORTU[x].r_kecamatan__id) ==$EDIT_R_PEGAWAI__ORTU_KEC}-->
						<option value="<!--{$DATA_KECAMATAN_ORTU[x].r_kecamatan__id}-->" selected > <!--{$DATA_KECAMATAN_ORTU[x].r_kecamatan__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KECAMATAN_ORTU[x].r_kecamatan__id}-->"<!--{$DATA_KECAMATAN_ORTU[x].r_kecamatan__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>										
					</div>
                            </td>
			</tr>  
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Desa / Kelurahan Orang Tua</td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                     <div id="ajax_kecamatan2_ortu">
                                       <select name="r_pegawai__ortu_desa" > 
                                            <option value="">[Pilih Desa]</option>
					<!--{section name=x loop=$DATA_DESA_ORTU}-->
						<!--{if trim($DATA_DESA_ORTU[x].r_desa__id) == $EDIT_R_PEGAWAI__ORTU_DESA}-->
						<option value="<!--{$DATA_DESA_ORTU[x].r_desa__id}-->" selected > <!--{$DATA_DESA_ORTU[x].r_desa__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_DESA_ORTU[x].r_desa__id}-->"<!--{$DATA_DESA_ORTU[x].r_desa__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
                                       </SELECT>
                                    </div>                                
                          </td>
			</tr>
                        
                                        
                     
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">RT/RW Orangtua</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                    RT<INPUT type="text" name="r_pegawai__ortu_rt" size="5" value="<!--{$EDIT_R_PEGAWAI__ORTU_RT}-->" >
                                    RW<INPUT type="text" name="r_pegawai__ortu_rw"  size="5" value="<!--{$EDIT_R_PEGAWAI__ORTU_RW}-->">
                                </td>
			</tr>
                       
                     	  <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Alamat Orang Tua </td>
				<td class="tdatacontent" width="20">:</td>
                                <TD class="tdatacontent"  colspan="3"><textarea rows="5" cols="50" NAME="r_pegawai__ortu_kodepos"  size="12" ><!--{$EDIT_R_PEGAWAI__ORTU_KODEPOS}--></textarea></TD>
			</tr>
		</table>
		
		</div>
		
<!-- #MENIKAH -->		
		<div id="table-search-box3" style="font:12/22px arial;display:none;">
		
		<table width="100%" >
                 
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Status Menikah </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">       
                                <select name="r_pegawai__status_kawin" >
                                    <OPTION value="">[Pilih Status]</option>
                                    <OPTION value="K/0" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'K/0'}--> selected <!--{/if}--> >Menikah Tidak Ada Anak</OPTION>
                                    <OPTION value="K/1" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'K/1'}--> selected <!--{/if}--> >Menikah Anak 1</OPTION>
                                    <OPTION value="K/2" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'K/2'}--> selected <!--{/if}--> >Menikah Anak 2</OPTION>
                                    <OPTION value="K/2" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'K/3'}--> selected <!--{/if}--> >Menikah Anak 3</OPTION>
                                    <OPTION value="TK" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'TK'}--> selected <!--{/if}--> >Tidak Menikah</OPTION>
                                   <OPTION value="TK/1" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'TK/1'}--> selected <!--{/if}-->>Tidak Menikah Anak 1</OPTION>
                                   <OPTION value="TK/2" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'TK/2'}--> selected <!--{/if}-->>Tidak Menikah Anak 2</OPTION>
                                   <OPTION value="TK/3" <!--{if $EDIT_R_PEGAWAI__STATUS_KAWIN == 'TK/3'}--> selected <!--{/if}-->>Tidak Menikah Anak 3</OPTION>
                                   
                                </select>  
                                    
                                </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Pasangan Suami / Istri</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pasangan" value="<!--{$EDIT_R_PEGAWAI__PASANGAN}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Tempat Lahir Suami / Istri</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_tmptlahir" value="<!--{$EDIT_R_PEGAWAI__PAS_TMPTLAHIR}-->"></td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Tgl Lahir Suami / Istri</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                
                                <!--{if $EDIT_VAL==0}-->

                                <input type="text" NAME="r_pegawai__pas_tgllahir" readonly="" value="<!--{$TODAY}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__pas_tgllahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="r_pegawai__pas_tgllahir" readonly="" value="<!--{$EDIT_R_PEGAWAI__PAS_TGLLAHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__pas_tgllahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
                                
                                </td>
			</tr> 
                       
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Propinsi Pasangan</td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent"><select name="r_pegawai__pas_prov" onChange="cari_kab_pas(this.value);">
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI_KTP}-->
						<!--{if trim($DATA_PROPINSI_KTP[x].r_provinsi__id) == $EDIT_R_PEGAWAI__PAS_PROV}-->
						<option value="<!--{$DATA_PROPINSI[x].r_provinsi__id}-->" selected > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI_KTP[x].r_provinsi__id}-->"  > <!--{$DATA_PROPINSI_KTP[x].r_provinsi__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select></td>
			</tr>
                          
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Kabupaten Pasangan </td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                        <div id="ajax_kabupaten_pas">
                                        <select name="r_pegawai__pas_kab" onChange="cari_kec_pas(this.value);">
                                                    <option value=""> Pilih Kabupaten  </option>
                                                    <!--{section name=x loop=$DATA_KABUPATEN_PAS}-->
                                                    <!--{if trim($DATA_KABUPATEN_PAS[x].r_kabupaten__id) == $EDIT_R_PEGAWAI__PAS_KAB}-->
                                                    <option value="<!--{$DATA_KABUPATEN_PAS[x].r_kabupaten__id}-->" selected > <!--{$DATA_KABUPATEN_PAS[x].r_kabupaten__nama}--> </option>
                                                    <!--{else}-->
                                                    <option value="<!--{$DATA_KABUPATEN_PAS[x].r_kabupaten__id}-->"  > <!--{$DATA_KABUPATEN_PAS[x].r_kabupaten__nama}--> </option>
                                                    <!--{/if}-->
                                                    <!--{/section}-->
                                        </select> 
															
					</div>
                          </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Kecamatan Pasangan </td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                    <div id="ajax_kecamatan_pas">
                                      <select name="r_pegawai__pas_kec" > 
						<option value="">[Pilih Kecamatan]</option>
						<!--{section name=x loop=$DATA_KECAMATAN_PAS}-->
						<!--{if trim($DATA_KECAMATAN_PAS[x].r_kecamatan__id) == $EDIT_R_PEGAWAI__PAS_KEC}-->
						<option value="<!--{$DATA_KECAMATAN_PAS[x].r_kecamatan__id}-->" selected > <!--{$DATA_KECAMATAN_PAS[x].r_kecamatan__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KECAMATAN_PAS[x].r_kecamatan__id}-->"<!--{$DATA_KECAMATAN_PAS[x].r_kecamatan__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>	              
                                        
                                    </div>                               
                          </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Desa / Kelurahan Pasangan</td>
				<td class="tdatacontent" width="5">:</td>
				<td class="tdatacontent">
                                    <div id="ajax_desa_pas">
                                       <select name="r_pegawai__pas_desa" > 
					<!--{section name=x loop=$DATA_DESA_PAS}-->
						<!--{if trim($DATA_DESA_PAS[x].r_desa__id) == $EDIT_R_PEGAWAI__PAS_DESA}-->
						<option value="<!--{$DATA_DESA_PAS[x].r_desa__id}-->" selected > <!--{$DATA_DESA_PAS[x].r_desa__nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_DESA_PAS[x].r_desa__id}-->"<!--{$DATA_DESA_PAS[x].r_desa__nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
                                       </SELECT>
                                    </div>                               
                          </td>
			</tr>
                        
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">RT/RW Suami / Istri</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                    RT<INPUT type="text" name="r_pegawai__pas_rt" size="5" value="<!--{$EDIT_R_PEGAWAI__PAS_RT}-->" >
                                    RW<INPUT type="text" name="r_pegawai__pas_rw"  size="5" value="<!--{$EDIT_R_PEGAWAI__PAS_RW}-->">
                                </td>
			</tr>
                        
                     	  <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="249">Alamat Rumah </td>
				<td class="tdatacontent" width="20">:</td>
                                <TD class="tdatacontent"  colspan="3"><textarea rows="5" cols="50" NAME="r_pegawai__pas_kodepos"  size="12" ><!--{$EDIT_R_PEGAWAI__ORTU_KODEPOS}--></textarea></TD>
			</tr>
                        
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No Telepon/Hp Suami/Istri </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_tlp"  value="<!--{$EDIT_R_PEGAWAI__PAS_TLP}-->"></td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Jumlah Anak</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_jml_anak"  value="<!--{$EDIT_R_PEGAWAI__PAS_JML_ANAK}-->"></td>
			</tr>
                          <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Anak k-1</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_anak1"  value="<!--{$EDIT_R_PEGAWAI__PAS_ANAK1}-->"></td>
			</tr>
                          <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Anak k-2</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_anak2"  value="<!--{$EDIT_R_PEGAWAI__PAS_ANAK2}-->"></td>
			</tr>
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Anak k-3</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pas_anak3" value="<!--{$EDIT_R_PEGAWAI__PAS_ANAK3}-->" ></td>
			</tr>
                        
                       
                     	
		</table>
		
		</div>
<!-- #ASURANSI&NPWP -->		
		<div id="table-search-box4" style="font:12/22px arial;display:none;">
		<table width="100%">
                    <input type="hidden" name="r_pegawai__id"> 
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No NPWP  </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__npwp"  value="<!--{$EDIT_R_PEGAWAI__NPWP}-->"></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No BPJS Ketenagakerjaan</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__no_bpjs" value="<!--{$EDIT_BPJS_KETENAGAKERJAAN}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No BPJS kesehatan</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="bpjs_kesehatan" value="<!--{$EDIT_BPJS_KESEHATAN}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No Inhealth</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__no_askes" value="<!--{$EDIT_R_PEGAWAI__NO_ASKES}-->"></td>
			</tr>
              </table>
		
		</div>
		
<!-- #Bank -->
                <div id="table-search-box5" style="font:12/22px arial;display:none;">
                            
                        <table width="100%">
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Bank ke 1</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                        <select name="r_pegawai__bank1" >
                                        <option value="">[Pilih Status]</option>
                                        <OPTION value="CIMB NIAGA" <!--{if $EDIT_R_PEGAWAI__BANK1== 'CIMB NIAGA'}--> selected <!--{/if}--> >BANK CIMB NIAGA</OPTION>
					<OPTION value="BCA" <!--{if $EDIT_R_PEGAWAI__BANK1 == 'BCA'}--> selected <!--{/if}-->>BANK BCA</OPTION>
					<OPTION value="BRI" <!--{if $EDIT_R_PEGAWAI__BANK1== 'BRI'}--> selected <!--{/if}--> >BANK BRI</OPTION>
					
                                        </select>  
                                    
                                </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Pemilik Rekening Bank ke 1</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__bank1_rek" value="<!--{$EDIT_R_PEGAWAI__BANK1_REK}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No Rekening Bank ke 1</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__bank1_norek" value="<!--{$EDIT_R_PEGAWAI__BANK1_NOREK}-->"></td>
			</tr>
                        
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Alamat  Bank ke 1</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                 
                                <textarea rows="5" cols="50"  NAME="r_pegawai__bank1_alm"  size="12" ><!--{$EDIT_R_PEGAWAI__BANK1_ALM}--></textarea>
                                </td>
			</tr>
                        
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250"><-----------------------></td>
				<td class="tdatacontent" width="5"></td>
                                <td class="tdatacontent"></td>
			</tr>
                        
                       
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Bank ke 2</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                        <select name="r_pegawai__bank2" >
                                        <option value="">[Pilih Status]</option>
                                        <OPTION value="CIMB NIAGA" <!--{if $EDIT_R_PEGAWAI__BANK2=='CIMB NIAGA'}--> selected <!--{/if}--> >BANK CIMB NIAGA</OPTION>
					<OPTION value="BCA" <!--{if $EDIT_R_PEGAWAI__BANK2 == 'BCA'}--> selected <!--{/if}-->>BANK BCA</OPTION>
					<OPTION value="BRI" <!--{if $EDIT_R_PEGAWAI__BANK2== 'BRI'}--> selected <!--{/if}--> >BANK BRI</OPTION>
					
                                        </select>  
                                    
                                </td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Pemilik Rekening Bank ke 2</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__bank2_rek" value="<!--{$EDIT_R_PEGAWAI__BANK2_REK}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">No Rekening Bank ke 2</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__bank2_norek" value="<!--{$EDIT_R_PEGAWAI__BANK2_NOREK}-->"s></td>
			</tr>
                        
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Alamat  Bank ke 2</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                   
                                    <textarea rows="5" cols="50"  NAME="r_pegawai__bank2_alm"  size="12" ><!--{$EDIT_R_PEGAWAI__BANK2_ALM}--></textarea>
                                
                                </td>
			</tr>
                        
                        
                  </table>

                </div>
<!-- #Pendidikan -->
<div id="table-search-box6" style="font:12/22px arial;display:none;">
     <table width="100%">
                  <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Tgl lulus <font color="#ff0000">*</font></td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent">
                                <!--{if $EDIT_VAL==0}-->

                                <input type="text" NAME="r_pegawai__pend_tgl_lulus" readonly="" value="<!--{$TODAY}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__pend_tgl_lulus,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
								 <input type="text" name="r_pegawai__pend_tgl_lulus" value="<!--{$EDIT_R_PEGAWAI__TGL_LULUS}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pegawai__pend_tgl_lulus,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->
                                
                                
                                </td>
			</tr>
                    
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Pendidikan Terakhir </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pend_akhir" value="<!--{$EDIT_R_PEGAWAI__PEND_AKHIR}-->" ></td>
			</tr>
                        <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Nama Sekolah / Universitas</td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pend_sekolah" value="<!--{$EDIT_R_PEGAWAI__PEND_SEKOLAH}-->"></td>
			</tr>   
                         <tr class='<!--{cycle values="alt,alt3"}-->'>
				<td class="tdatacontent" width="250">Jurusan </td>
				<td class="tdatacontent" width="5">:</td>
                                <td class="tdatacontent"><INPUT type="text" name="r_pegawai__pend_jurusan" value="<!--{$EDIT_R_PEGAWAI__PEND_JURUSAN}-->"></td>
			</tr>
                        
                       
                        
                       <INPUT TYPE="hidden" name="r_pegawai__id" value="<!--{$EDIT_R_PEGAWAI__ID}-->">                       
                        
              </table>
		
</div>


<!-- #WARNING -->		

<!-- #CATATAN SDM -->		

<!-- #CATATAN SDM -->		

<div id="panel-footer">
<table width="100%">
<tr class="text-regular" align='center'>
	<td>&nbsp;
        <INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onClick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onClick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
					
        
        </td>
        
</tr>

<tr class="text-regular">
	<td>&nbsp;
        <font color="#ff0000"> Keterangan * Wajib Diisi</font>
        
        </td>
        
</tr>
</table>
</div>				
		</td></tr>
          </table>
		</form>
		</td></tr>
		</table>
		</DIV>

<!--form_tambah-->


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
                                    <TD>Nama Karyawan </TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari" ></TD>
                            </TR>
                            
                            <TR>
                                    <TD>ID Finger Print </TD><TD><INPUT TYPE="text" NAME="finger_pegawai_cari" ></TD>
                            </TR>
                            
                                <TR>
                            <TD>KTP</TD><TD><INPUT TYPE="text" NAME="ktp_cari" ></TD>
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
		<tr><td class="tcat"> Daftar Pegawai</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Pegawai</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table id="example" class="display" cellpadding="4" cellspacing="6" width="100%">
        <thead class="tdatahead">
            <tr>
                <th class="alt2" >NO</th>
                <th class="alt2" style="padding:0px;">NAMA</th>
                <th class="alt2" style="padding:0px;">NIP</th>
                <th class="alt2" style="padding:0px;">ID FINGER</th>
                 <TH class="alt2" align="left">DEPARTEMEN</TH>
            <TH class="alt2" align="left" >JABATAN</TH>
                <th class="alt2" style="padding:0px;">NO KTP</th>
                <th class="alt2" style="padding:0px;">BPJS KT</th>
                <th class="alt2" style="padding:0px;">BPJS KES</th>
                <th class="alt2" style="padding:0px;">INHEALTH.</th>
                <th class="alt2" style="padding:0px;">BANK</th>
                <th class="alt2" style="padding:0px;">NO REK</TH>
                <th class="alt2" style="padding:0px;">CABANG</TH>
                <th class="alt2" style="padding:0px;">SUB CABANG</TH>
                <th class="alt2" style="padding:0px;">MULAI MASUK</TH>
                <th class="alt2" style="padding:0px;">STATUS</TH>
                <th class="alt2" style="padding:0px;">ALAMAT RUMAH</TH>
                <th class="alt2" style="padding:0px;">PROPINSI</TH>
                <th class="alt2" style="padding:0px;">KABUPATEN</TH>
                <th class="alt2" style="padding:0px;">KECAMATAN</TH>
                <th class="alt2" style="padding:0px;">KEL/DESA</TH>
                <th class="alt2" style="padding:0px;" >HP</TH>
                <th class="alt2" style="padding:0px;">TLP RUMAH/ISTRI</TH>
              
                <th><!--{$ACTION}--></th>
            </tr>
        </thead>
     
           <tbody class="tdatacontent">
			<!--{section name=x loop=$DATA_TB}-->
			<tr >
                        <td> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                          <TD > <!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                        <TD > <!--{$DATA_TB[x].r_jabatan__ket}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__ktp}-->  </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__no_bpjs}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__bpjs_kesehatan}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__no_askes}--> </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__bank1}-->   </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__bank1_norek}-->  </TD>
                        <TD ><!--{$DATA_TB[x].r_cabang__nama}-->   </TD>
                        <TD ><!--{$DATA_TB[x].r_subcab__nama}-->  </TD>
                        <TD ><!--{$DATA_TB[x].r_pegawai__tgl_masuk|date_format:"%d-%m-%Y"}--></TD>
                        <TD > 
                        <!--{if ($DATA_TB[x].ket_resign)==1}-->
                            <font color="#0d47c4">Masih Aktif</font>  
                        <!--{else}-->  
                         <font color="#FF0000">Resign</font>     
                            <!--{/if}--> 
                        </TD>	
                    <TD><!--{$DATA_TB[x].r_pegawai__nama_jalan}--> </TD>
                    <TD><!--{$DATA_TB[x].r_provinsi__nama}--></TD>
                    <TD><!--{$DATA_TB[x].r_kabupaten__nama}--></TD>
                    <TD><!--{$DATA_TB[x].r_kecamatan__nama}--></TD>
                    <TD><!--{$DATA_TB[x].r_wilayah__nama}--></TD>
                    <TD><!--{$DATA_TB[x].r_pegawai__tlp_pribadi}--></TD>
                    <TD><!--{$DATA_TB[x].r_pegawai__tlp_rumah}--></TD>
               

                       <TD colspan="2" width="20"  ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_pegawai__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>

                </TR>
                <!--{sectionelse}-->
                <TR>
                        <TD  COLSPAN="15" align="center">Maaf, Data masih kosong</TD>
                </TR>
			<!--{/section}-->
			</tbody>
           
            
     
    </table
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
