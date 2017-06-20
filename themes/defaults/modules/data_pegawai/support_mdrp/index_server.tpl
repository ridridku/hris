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
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle">Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Penempatan</td></tr>
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
                        <TD>No Penempatan <font color="#ff0000">* Otomatis</font></TD>
                        <TD>       
                                <!--{if $EDIT_VAL==0}-->
                            <div id="ajax_cek_id">
                                <INPUT  readonly=""  TYPE="text" name="r_pnpt__no_mutasi" size="35" value="<!--{$ID_MUTASI_NEW}-->"  OnChange="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?r_pnpt__no_mutasi='+frmCreate.r_pnpt__no_mutasi.value)">
                            </DIV>
                               <!--{else}-->
                            <div id="ajax_cek_id">
                                <INPUT readonly=""  TYPE="text" name="r_pnpt__no_mutasi" size="35" value="<!--{$EDIT_R_PNPT__NO_MUTASI}-->" OnChange="JavaScript:Ajax('ajax_cek_id','<!--{$HREF_HOME_PATH_AJAX}-->/cek.php?r_pnpt__no_mutasi='+frmCreate.r_pnpt__no_mutasi.value)">
                            </DIV>
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

                                                <SELECT name="kode_cabang" onchange="cari_subcab(this.value);">
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
                        <TD>Pilih Sub Cabang <font color="#ff0000">*</font></TD>
                        <TD>
                           <!--{if ($JENIS_USER_SES==1)}-->
                            <DIV id="ajax_subcabang">
                                     <select name="kode_subcab_cari" >
                                    <option value="">[Pilih Sub Cabang]</option>
                                    <!--{section name=x loop=$DATA_SUBCABANG}-->
                                    <!--{if trim($DATA_SUBCABANG[x].r_subcab__id)==$EDIT_R_PNPT__SUBCAB}-->
                                    <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                    <!--{else}-->
                                    <option value="<!--{$DATA_SUBCABANG[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG[x].r_subcab__nama}--> </option>
                                    <!--{/if}-->
                                    <!--{/section}-->
                                    </select> 
                            </DIV>
                                     <!--{else}-->
                                    <select name="kode_subcab_cari" >
                                    <option value="">[Pilih Sub Cabang]</option>
                                    <!--{section name=x loop=$DATA_SUBCABANG_CARI}-->
                                    <!--{if trim($DATA_SUBCABANG_CARI[x].r_subcab__id)==$EDIT_R_PNPT__SUBCAB}-->
                                    <option value="<!--{$DATA_SUBCABANG_CARI[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG_CARI[x].r_subcab__nama}--> </option>
                                    <!--{else}-->
                                    <option value="<!--{$DATA_SUBCABANG_CARI[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG_CARI[x].r_subcab__nama}--> </option>
                                    <!--{/if}-->
                                    <!--{/section}-->
                                    </select> 
                                      <!--{/if}-->
                        </TD>
                </TR>       
                <TR>
                        <TD>Departemen <font color="#ff0000">*</font></TD>
                            <TD> 
                                        <select name="kode_departemen" onchange="cari_subdep(this.value);">
                                        <option value="">[Pilih Departemen]</option>
                                        <!--{section name=x loop=$DATA_DEPARTEMEN}-->
                                        <!--{if trim($DATA_DEPARTEMEN[x].r_dept__id)==$EDIT_R_DEPT__ID}-->
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
                                       <select name="kode_subdep">
                                       <option value="">[Pilih Sub Departemen]</option>
                                       <!--{section name=x loop=$DATA_SUBDEP}-->
                                       <!--{if trim($DATA_SUBDEP[x].r_subdept__id)==$EDIT_R_PNPT__SUBDEPT}-->
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
                           <TD>
                                       <select name="r_jabatan" >
                                       <option value="">[Pilih Jabatan]</option>
                                       <!--{section name=x loop=$DATA_JABATAN}-->
                                       <!--{if trim($DATA_JABATAN[x].r_jabatan__id)==$EDIT_R_PNPT__JABATAN}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->" selected > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_JABATAN[x].r_jabatan__id}-->"  > <!--{$DATA_JABATAN[x].r_jabatan__ket}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select> 
                           </TD>
                   </TR>
                    <TR>
                           <TD>Tipe Salary</TD>
                           <TD>   
                                <select name="r_pnpt__tipe_salary" >
                                   <OPTION value="">[Pilih Tipe Salary]</option>
                                   <OPTION value="1" <!--{if $EDIT_R_PNPT__TIPE_SALARY == '1'}--> selected <!--{/if}--> >Transfer</OPTION>
                                   <OPTION value="0" <!--{if $EDIT_R_PNPT__TIPE_SALARY == '0'}--> selected <!--{/if}-->>Tunai</OPTION>
                                </select>                                      
                              </TD>
                   </TR>
                    <TR>
                           <TD>Tipe Status Karyawan <font color="#ff0000">*</font></TD>
                           <TD>   
                                <select name="r_pnpt__status" id="r_pnpt__status" onchange="cari_subpenempatan(this.value);">
                                       <option value="">[Pilih Status Karyawan]</option>
                                       <!--{section name=x loop=$DATA_STATUS}-->
                                       <!--{if trim($DATA_STATUS[x].r_stp__id)==$EDIT_R_PNPT__STATUS}-->
                                       <option value="<!--{$DATA_STATUS[x].r_stp__id}-->" selected > <!--{$DATA_STATUS[x].r_stp__nama}--> </option>
                                       <!--{else}-->
                                       <option value="<!--{$DATA_STATUS[x].r_stp__id}-->"  > <!--{$DATA_STATUS[x].r_stp__nama}--> </option>
                                       <!--{/if}-->
                                       <!--{/section}-->
                                       </select> 
                              </TD>
                   </TR>
                   <tr>
                    <td>Tipe Penempatan <font color="#ff0000">*</font></td>
                    <td>
                        <DIV id="ajax_subpenempatan">
                        <select name="tipe_pdrm" >
                                <OPTION value="">[Pilih Tipe Penempatan]</OPTION>
                                <OPTION value="0" <!--{if $EDIT_R_PNPT__PDRM=='0'}--> selected <!--{/if}--> >Karyawan Verifikasi</OPTION>
                                <OPTION value="1" <!--{if $EDIT_R_PNPT__PDRM=='1'}--> selected <!--{/if}--> >Karyawan Kontrak </OPTION>
                                <OPTION value="2" <!--{if $EDIT_R_PNPT__PDRM=='2'}--> selected <!--{/if}--> >Karyawan Promosi</OPTION>
                                <OPTION value="3" <!--{if $EDIT_R_PNPT__PDRM=='3'}--> selected <!--{/if}--> >Karyawan Mutasi</OPTION>
                                <OPTION value="4" <!--{if $EDIT_R_PNPT__PDRM=='4'}--> selected <!--{/if}--> >Karyawan Rotasi</OPTION>
                                <OPTION value="5" <!--{if $EDIT_R_PNPT__PDRM=='5'}--> selected <!--{/if}--> >Karyawan Demosi</OPTION>
                                <OPTION value="7" <!--{if $EDIT_R_PNPT__PDRM=='7'}--> selected <!--{/if}--> >Karyawan Tetap</OPTION>
                        </select>  
                        </DIV>
                            </td>
                    </tr>
                    <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="r_pegawai__nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_R_PEGAWAI__NAMA}-->" >
                                <INPUT TYPE="text" NAME="r_pegawai__id"  id="r_pegawai__id" size="35" value="<!--{$EDIT_R_PEGAWAI__ID}-->" on ="ambil_data()">
                                <INPUT TYPE="text" NAME="r_pegawai__tgl_masuk" readonly id="r_pegawai__tgl_masuk" size="35" value="<!--{$EDIT_R_PEGAWAI__TGL_MASUK}-->" >
                                <INPUT TYPE="hidden" NAME="pdrm__nip" readonly id="r_pnpt__nip" size="35" value="" >
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan(this.kode_cabang)" value=" ... " />
                                <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="cek_jabatan()" value=" ... " />
                            </TD>

                    </TR>
                    <TR>
                            <TD>Tgl Kontrak Awal  <font color="#ff0000">*</font></TD>
                            <TD>
                            <!--{if $EDIT_VAL==0}-->
                            <input type="text" NAME="r_pnpt__kon_awal" value="<!--{$EDIT_R_PNPT__KON_AWAL}-->">
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <!--{else}-->
                                                             <input type="text" name="r_pnpt__kon_awal" value="<!--{$EDIT_R_PNPT__KON_AWAL}-->" >
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <!--{/if}-->


                            </TD>
                    </TR>
                        
                    <TR>
                            <TD>Tgl Kontrak Akhir  <font color="#ff0000">*</font></TD>
                            <TD>
                            <!--{if $EDIT_VAL==0}-->
                            <input type="text" NAME="r_pnpt__kon_akhir" value="<!--{$EDIT_R_PNPT__KON_AKHIR}-->">
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <!--{else}-->
                            <input type="text" name="r_pnpt__kon_akhir" value="<!--{$EDIT_R_PNPT__KON_AKHIR}-->" >
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.r_pnpt__kon_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <!--{/if}-->


                            </TD>
                    </TR>  
				
                    <TR>
                        <TD >Kode Finger Print <font color="#ff0000">*</font></TD>
                        <TD>
                                   
                                <!--{if $EDIT_VAL==0}-->
                            <div id="ajax_cek_id2">
                                <INPUT   TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" size="35" value="<!--{$EDIT_R_PNPT__FINGER_PRINT}-->"  OnChange="JavaScript:Ajax('ajax_cek_id2','<!--{$HREF_HOME_PATH_AJAX}-->/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)">
                            </DIV>
                               <!--{else}-->
                            <div id="ajax_cek_id2">
                             <INPUT   TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" size="35" value="<!--{$EDIT_R_PNPT__FINGER_PRINT}-->" OnChange="JavaScript:Ajax('ajax_cek_id2','<!--{$HREF_HOME_PATH_AJAX}-->/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)">
                            </DIV>
                                <!--{/if}-->
                            
                            
                           <!-- <INPUT TYPE="text" name="r_pnpt__finger_print" id="r_pnpt__finger_print" value="EDIT_R_PNPT__FINGER_PRINT">-->
                        </TD>
                    </TR>
                    
                    <TR>
                        <TD>Pilih Shift <font color="#ff0000">*</font></TD>
                            <TD> 
                                        <select name="r_pnpt__shift" >
                                        <option value="">[Pilih Shift]</option>
                                        <!--{section name=x loop=$DATA_SHIFT}-->
                                        <!--{if trim($DATA_SHIFT[x].r_shift__id)==$EDIT_R_PNPT__SHIFT}-->
                                        <option value="<!--{$DATA_SHIFT[x].r_shift__id}-->" selected > <!--{$DATA_SHIFT[x].r_shift__ket}--> </option>
                                        <!--{else}-->
                                        <option value="<!--{$DATA_SHIFT[x].r_shift__id}-->"  > <!--{$DATA_SHIFT[x].r_shift__ket}--> </option>
                                        <!--{/if}-->
                                        <!--{/section}-->
                                        </select> 
                            </TD>
                    </TR>
                     <TR>
                        <TD>Aktivasi Karyawan <font color="#ff0000">*</font> </TD>
                            <TD> 
                                        <SELECT name="r_pnpt__aktif">
                                        <OPTION value="">[Pilih Status]</option>
                                        <OPTION value="1" <!--{if $EDIT_R_PNPT__AKTIF=='1'}--> selected <!--{/if}--> >Aktif</OPTION>
                                        </SELECT>  
                            </TD>
                    </TR>                                  
                    <INPUT TYPE="hidden" name="r_pnpt__nip" value="<!--{$EDIT_R_PNPT__NIP}-->"> 
                    <INPUT TYPE="hidden" name="r_pnpt__id_pegawai" value="<!--{$EDIT_R_PNPT__ID_PEGAWAI}-->"> 
                    
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
					<TR><td colspan="2"><font color="#ff0000">Keterangan * Wajib Diisi</font></td></tr>
                
</TABLE>
 </form>
</td></tr>
</table>
 
                                   

                                        
                                        
<DIV id="ajax_cekjabatan">
                                      
</DIV>      
                                  
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
                <TD>Cabang <font color="#ff0000">*</font></TD> 
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
                                                                            <!--{section name=x loop=$DATA_SUBCABANG_CARI}-->
                                                                            <!--{if trim($DATA_SUBCABANG_CARI[x].r_subcab__id)==0}-->
                                                                            <option value="<!--{$DATA_SUBCABANG_CARI[x].r_subcab__id}-->" selected > <!--{$DATA_SUBCABANG_CARI[x].r_subcab__nama}--> </option>
                                                                            <!--{else}-->
                                                                            <option value="<!--{$DATA_SUBCABANG_CARI[x].r_subcab__id}-->"  > <!--{$DATA_SUBCABANG_CARI[x].r_subcab__nama}--> </option>
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
                                       <TD>Status Pegawai</TD>
                                       <TD>
                                            <select name="sts_pegawai" >
                                                    <option value="">[Pilih Status pegawai]</option>
                                                    <!--{section name=x loop=$DATA_STS}-->
                                                    <!--{if trim($DATA_STS[x].r_stp__id)==0}-->
                                                    <option value="<!--{$DATA_STS[x].r_stp__id}-->" selected > <!--{$DATA_STS[x].r_stp__nama}--> </option>
                                                    <!--{else}-->
                                                    <option value="<!--{$DATA_STS[x].r_stp__id}-->"  > <!--{$DATA_STS[x].r_stp__nama}--> </option>
                                                    <!--{/if}-->
                                                    <!--{/section}-->
                                            </select> 
                                       </TD>
                            </TR>
                            
                            <TR><TD>Nama Karyawan</TD><TD><INPUT TYPE="text" NAME="nama_pegawai_cari"></TD></TR>
                            <TR><TD>NIP</TD><TD><INPUT TYPE="text" NAME="r_pnpt__nip_cari" ></TD></TR>
                            <TR>
                            <TD>ID Finger Print </TD><TD><INPUT TYPE="text" NAME="finger_pegawai_cari" ></TD>
                            </TR>
                          
                        <TR>
							<TD>Akhir Kontrak</TD>
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
 							  <!--{if ($smarty.section.foo.index)==0}-->
								 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
							  <!--{else}-->
									 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
							 <!--{/if}--> 
						<!--{/section}-->
						</SELECT> 
						 </TD></TR>
			<TR>
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
		<tr><td class="tcat"> Daftar Penempatan</td></tr>
		</TABLE>
		<TABLE class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Penempatan</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<TABLE width="100%">
                <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
											<TH class="tdatahead" align="left" width="10%">NAMA</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NIP</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">ID FINGER</TH>
											<TH class="tdatahead" align="left">DEPARTEMEN</TH>
											<TH class="tdatahead" align="left" >JABATAN</TH>
                                                                                        <TH class="tdatahead" align="left" >LEVEL</TH>
                                                                                        <TH class="tdatahead" align="left" >CABANG</TH>
                                                                                        <TH class="tdatahead" align="left">SUB CABANG</TH>
											<TH class="tdatahead" align="left">STATUS KARYAWAN</TH>
                                                                                        <TH class="tdatahead" align="left">MULAI MASUK</TH>
											<TH class="tdatahead" align="left" >AWAL KONTRAK</TH>
											<TH class="tdatahead" align="left">AKHIR KONTRAK</TH>
											<TH class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			
		</THEAD>
			<TBODY>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<TD width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_jabatan__ket}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_level__ket}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_subcab__nama}--></TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_stp__nama}--> </TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__tgl_masuk|date_format:"%d-%m-%Y"}--></TD>
											<TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__kon_awal|date_format:"%d-%m-%Y"}--> </TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__kon_akhir|date_format:"%d-%m-%Y"}-->                                                                                          
                                                                                        <!--{if ($DATA_TB[x].warning) ==(-2)}-->
                                                                                        <br><font color="#c45f36"><b>Kontrak Akan Habis 2 Bulan lagi</b></font>
                                                                                       <!--{elseif ($DATA_TB[x].warning) ==(-1)}-->
                                                                                       <br> <font color="#ea4402"><b>Kontrak Akan Habis 1 Bulan lagi</b></font>
                                                                                       <!--{elseif ($DATA_TB[x].warning)==0}-->
                                                                                       <br> <font color="#f48342"><b>Kontrak Akan Segera habis</b></font>
                                                                                        <!--{elseif ($DATA_TB[x].warning)>=0}-->
                                                                                       <br> <font color="#ff0000"><b>Kontrak Sudah habis</b></font>
                                                                                       <!--{else}-->  
                                                                                       <br> <font color="#4286f4"><b>Kontrak Masih Berjalan</b></font>
                                                                                       <!--{/if}--></TD>
                                                                                        
                                                                                      <TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_pnpt__no_mutasi}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
                                                                                      <TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].r_pnpt__no_mutasi}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="10" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<!--{/section}-->
			</TBODY>
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

	<div id="div-bg-note-trans">
        <img src="<!--{$HREF_IMG_PATH}-->/layout/note.png">
        </div>

	</DIV>
</BODY>
</HTML>
