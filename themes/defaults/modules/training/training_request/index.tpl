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
		<tr><td class="tcat">Form Pinjaman</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" enctype="multipart/form-data">
                    <TABLE id="table-add-box">
				
					<!--{if $EDIT_VAL==0}-->
                                        <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
                                        <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
        
           
            <TR>
                        <TD>No Pelatihan <font color="#ff0000">*</font></TD>
                                 <TD>
                                    <!--{if $EDIT_VAL==0}-->
                                        <INPUT  readonly=""  TYPE="text" name="id_pel" size="35" value="<!--{$ID_PELATIHAN}-->"  onkeypress="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
					<!--{else}-->
                                        <INPUT  readonly=""  TYPE="text" name="id_pel" size="35" value="<!--{$EDIT_PEL_ID}-->"  onkeypress="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?t_sp__no='+frmCreate.t_sp__no.value)">
					<!--{/if}-->  
                                      
                                </TD>   
            </TR>           
            <TR>
                    <TD>Cabang <font color="#ff0000">*</font></TD> 
                                                           <TD><!--{if ($JENIS_USER_SES==1)}-->

                                                                                           <select name="kode_cabang" > 
                                                                                           <option value=""> Pilih Cabang </option>
                                                                                           <!--{section name=x loop=$DATA_CABANG}-->

                                                                                           <!--{if ($OPT==1)}-->

                                                                                                   <!--{if trim($DATA_CABANG[x].r_cabang__id) ==$EDIT_CABANG_ID}-->
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

                                                                                <!--{if trim($DATA_CABANG[x].r_cabang__id) == $EDIT_CABANG_ID}-->
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
                            <TD>Nama PIC<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_PEGAWAI_NAMA}-->">
                             NIP<INPUT TYPE="text" NAME="nip" readonly id="r_pnpt__nip" size="35" value="<!--{$EDIT_PNPT_NIP}-->" >
                            <INPUT TYPE="text" NAME="mutasi" readonly id="r_pnpt__no_mutasi" size="35" value="<!--{$EDIT_PNPT_MUTASI}-->" > 
                            <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                        <TD>Jabatan<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="sp_jabatan" readonly id="r_jabatan__ket" size="35" value="<!--{$EDIT_JABATAN}-->" ></TD>                         
                    </TR>
                    <TR>
                        <TD>Email PIC<font color="#ff0000">*</font></TD>
                        <TD><INPUT TYPE="text" NAME="email"   size="35" value="<!--{$EDIT_EMAIL}-->"  ></TD>                        
                    </TR>
                     <TR>
                                <TD>Tema <font color="#ff0000">*</font></TD>
                                <TD>   
                                  <INPUT TYPE="text" NAME="tema"  size="35" value="<!--{$EDIT_TEMA}-->" >      
                                </TD>
                     </TR>
                   
                    <TR>
				<TD>Tgl Awal Kegiatan </TD>
                                <TD>
                                    <!--{if $EDIT_VAL==0}-->

							 <input type="text" NAME="tgl_awal"  value="<!--{$EDIT_TGL_AWAL}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                                        <input type="text" name="tgl_awal" value="<!--{$EDIT_TGL_AWAL}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->  
                                </TD>         
                    </TR>
                     <TR>
				<TD>Tgl Akhir Kegiatan </TD>
                                <TD>
                                    <!--{if $EDIT_VAL==0}-->

							 <input type="text" NAME="tgl_akhir"  value="<!--{$EDIT_TGL_AKHIR}-->">
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"   onclick="displayCalendar(document.frmCreate.tgl_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{else}-->
                                                        <input type="text" name="tgl_akhir" value="<!--{$EDIT_TGL_AKHIR}-->" >
							 <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<!--{/if}-->  
                                </TD>         
                    </TR>
                      <TR>
                                <TD>Penyelenggara </TD>
                                <TD>   
                                    <INPUT TYPE="text" NAME="penyelenggara"  size="35" value="<!--{$EDIT_PENYELENGGARA}-->" >      
                                </TD>
                     </TR>
                     <TR>
                                <TD>Tempat</TD> 
				<TD>    
                                 <INPUT TYPE="text" NAME="tempat"  size="35" value="<!--{$EDIT_TEMPAT}-->" >      
                                </TD>
                    </TR>
                  
                        <TR>
                                   <TD>Jenis Kegiatan<font color="#ff0000">*</font></TD> 

                                           <TD><SELECT name="jenis">
                                                           <OPTION value="">[Jenis Kegiatan]</OPTION>
                                                           <OPTION value="1" <!--{if $EDIT_JENIS=='1'}-->selected<!--{/if}-->>Pelatihan </OPTION>
                                                           <OPTION value="2" <!--{if $EDIT_JENIS=='2'}-->selected<!--{/if}-->>Sosialisasi</OPTION>
                                                           <OPTION value="3" <!--{if $EDIT_JENIS=='3'}-->selected<!--{/if}-->>Pelatihan & Sosialisasi</OPTION>
                                                   </SELECT>
                                           </TD>
                        </TR>    
                        <TR>
                                    <TD>Deskripsi</TD> 
                                    <TD>    
                                       <textarea rows="5" cols="20" NAME="deskripsi"  size="12" ><!--{$EDIT_DESKRIPSI}--></textarea>
                                    </TD>
                        </TR>
                        <TR>
                                   <TD>Status Kegiatan<font color="#ff0000">*</font></TD> 
                                           <TD><SELECT name="status">
                                                           <OPTION value="">[Status Kegiatan]</OPTION>
                                                           <OPTION value='1' <!--{if $EDIT_STATUS==1}-->selected<!--{/if}-->> Belum Dilaksanakan </OPTION>
                                                           <OPTION value='2' <!--{if $EDIT_STATUS==2}-->selected<!--{/if}-->>Sudah Dilaksanakan </OPTION>
                                                   </SELECT>
                                           </TD>
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
                                    <TD>Bidang</TD><TD><INPUT TYPE="text" NAME="bidang_cari" ></TD>
                            </TR>                        
                            <TR>
                                    <TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_cari" ></TD>
                            </TR>
                             <TR>
                                <TD>Status Kegiatan<font color="#ff0000">*</font></TD> 
			
					<TD><SELECT name="status_cari">
							<OPTION value="">[Jenis Kegiatan]</OPTION>
							<OPTION VALUE="1">Belum Dilaksanakan </OPTION>
							<OPTION VALUE="2">Sudah Dilaksanakan</OPTION>
                                                        
						</SELECT>
                                        </TD>
                     </TR>  
                     <TR>
							<TD>Periode</TD>
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
		<tr><td class="tcat">Data Permintaan Training</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Data Permintaan Training</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                    <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NIP </TH>
											<TH class="tdatahead" align="left" width="10%">PIC</TH>  
                                                                                        <TH class="tdatahead" align="left" width="10%">E-MAIL PIC</TH> 
                                                                                        <TH class="tdatahead" align="left" >CABANG</TH>
											<TH class="tdatahead" align="left">DEPARTEMEN</TH>
											<TH class="tdatahead" align="left" >JABATAN</TH>                                                                                       
											<TH class="tdatahead" align="left">TEMA</TH>
                                                                                        <TH class="tdatahead" align="left">DESKRIPSI</TH>
                                                                                        <TH class="tdatahead" align="left">TEMPAT</TH>
                                                                                        <TH class="tdatahead" align="left">TGL KEGIATAN</TH>
                                                                                        <TH class="tdatahead" align="left">STATUS</TH>
											<TH class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
			
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"><!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_mastpel__email_pic}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_cabang__nama}--> </TD>
											<TD class="tdatacontent"><!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_jabatan__ket}--> </TD>                                                                                        
											<TD class="tdatacontent"><!--{$DATA_TB[x].r_mastpel__tema}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_mastpel__deskripsi}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_mastpel__tempat}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_mastpel__tgl_awal|date_format:'%d-%B'}--> s/d <!--{$DATA_TB[x].r_mastpel__tgl_akhir|date_format:'%d-%B-%Y'}--></TD>
                                                                                        <TD class="tdatacontent">                                                                                        
                                                                                            <!--{if ($DATA_TB[x].r_mastpel__status)==1}-->
                                                                                                         <font color="#FA0505">Belum Dilaksanakan</font>              
                                                                                           <!--{else ($DATA_TB[x].r_mastpel__status) ==2}-->  
                                                                                                         <font color="#2BCC40">Sudah Dilaksanakan</font>     
                                                                                                  
                                                                                           <!--{/if}--> 
                                                                                        
                                                                                        
                                                                                        </TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_mastpel__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].r_mastpel__id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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
                    <table width="100%">
                    <tr class="text-regular">
                    <td width="20">Tampilkan</td>
                    <td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
                
                                    <SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
                                    <!--{section name=x loop=$LISTVAL}-->
                                    <OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
                                    <!--{/section}-->
                                    </SELECT></td>
                    <td>Baris : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> Dari <!--{$COUNT}--></td>
                    <td align="right"><!--{$NEXT_PREV}--></td>
                    </tr>
                    </table>
    <!--halaman -->
</div>
		</td></tr>
		</table>

		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>
