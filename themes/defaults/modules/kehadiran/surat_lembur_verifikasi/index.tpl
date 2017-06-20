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
<!--{if $EDIT_VAL==0}-->
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<!--{else}-->

<!--{/if}-->
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Posting Lembur</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Approval</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                <TABLE id="table-add-box">
                    <TABLE width="100%" border="0" align="left" > 
                    <THEAD>
                    <TH class="tdatahead" align="left">NO</TH>
                    <TH class="tdatahead" align="left">NAMA </TH>
                    <TH class="tdatahead" align="left">ID FINGER </TH>
                    <TH class="tdatahead" align="left">TGL MASUK </TH>
                    <TH class="tdatahead" align="left">JAM MASUK</TH>
                    <TH class="tdatahead" align="left" >JAM KELUAR</TH>                                                                                       
                    <TH class="tdatahead" align="left" >WORK TIME</TH>
                    <TH class="tdatahead" align="left">OVER TIME</TH>
                    <TH class="tdatahead" align="left" >LESS TIME</TH>         
                    <TH class="tdatahead" align="center" >NAMA ATASAN</TH> 
                    <TH class="tdatahead" align="center" width="10%">APPROVAL</TH>   
                    </THEAD>
			<tbody>
			<!--{section name=x loop=$DATA_PJM}-->
                <tr class='<!--{cycle values="alt,alt3"}-->'>
                    <td class="tdatacontent-first-col"> <!--{$smarty.section.x.index+1}--></TD>
                        <TD class="tdatacontent" ><input size="3" type="hidden"  name="id_pegawai[]" value="<!--{$DATA_PJM[x].id_pegawai}-->"><!--{$DATA_PJM[x].r_pegawai__nama}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].r_pnpt__finger_print}--></TD>
                        <TD class="tdatacontent" ><input type="hidden" readonly="" name="tgl_lembur[]" value="<!--{$DATA_PJM[x].t_abs__tgl}-->"><!--{$DATA_PJM[x].t_abs__tgl}--></TD>
                        <TD class="tdatacontent" ><!--{$DATA_PJM[x].t_abs__jam_masuk}--></TD>
                        <TD class="tdatacontent"><!--{$DATA_PJM[x].t_abs__jam_keluar}--> </TD>
                        <TD class="tdatacontent">
                         <!--{if ($DATA_PJM[x].t_abs__worktime) <'08:00:00'}-->
                            <font color="#ff0000"><!--{$DATA_PJM[x].t_abs__worktime}--> </font>
                        <!--{elseif ($DATA_PJM[x].t_abs__worktime) >'08:00:00'}-->
                                  <font color="#072ff9"><!--{$DATA_PJM[x].t_abs__worktime}--> </font>
                        <!--{else}-->
                                <!--{$DATA_PJM[x].t_abs__worktime}--> 
                        <!--{/if}-->
                        </TD>
                        <TD class="tdatacontent">
                        <!--{if ($DATA_PJM[x].t_abs__overtime) >'00:00:00'}-->
                        <font color="#072ff9"><input type="hidden" readonly="" name="overtime[]" value="<!--{$DATA_PJM[x].t_abs__overtime}-->"> <!--{$DATA_PJM[x].t_abs__overtime}--></font>
                         <!--{else}-->
                            <!--{$DATA_PJM[x].t_abs__overtime}-->
                        <!--{/if}-->

                        </TD>
                        <TD class="tdatacontent"><input size="2" type="hidden"  name="level[]" value="<!--{$DATA_PJM[x].r_level__id}-->"><!--{$DATA_PJM[x].t_abs__lesstime}--></TD>                                                                                                                                                                    
                        <TD class="tdatacontent" align="center"><INPUT type="hidden" size="15" name="nama_atasan[]"  value=""><!--{$DATA_PJM[x].t_abs__atasan_nama}--></TD>
                        <TD class="tdatacontent" align="center"><INPUT type="checkbox" name="approval[]" id="check_list" value="<!--{$DATA_PJM[x].t_abs__id}-->" > </TD>
                 </TR>
                                                                                
                        <!--{sectionelse}-->
                        <TR>
                                <TD class="tdatacontent" COLSPAN="11" align="center">Maaf karyawan Tersebut, Tidak Ada Data Overtime</TD>
                        </TR>
			<!--{/section}-->
			</tbody>						
                        <TR><TD></TD><TD>
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Posting</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
                                       
                                        
                                 </TD>
                                 
                                 <TD colspan="5" >
                                     
                                     
                                        
                                 </TD>
                                  <TD colspan="2" >
                                     
                                     
                                        
                                 </TD>
                                 <TD colspan="3">
                                    <a style="font-size:9pt;" class="button"   name="Check_All" value="Check All" onClick="CheckAll(document.frmCreate.check_list)"><span>Checked All</span></a>
                                   <a style="font-size:9pt;" class="button"  name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.frmCreate.check_list)"><span>Unchecked All</span></a>
                                 </TD>
                                
                                
				</TR>
                                
                                <TR><td  colspan="2" style="font-size:8pt;"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td></tr>   
                                       
		</table>
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
                <TR><td class="tcat"> Posting Lembur  </td></tr>
		</TABLE>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Nama Karyawan Yang Hadir Periode <!--{$PERIODE_AWAL|date_format:"%d"}--> s/d <!--{$PERIODE_AKHIR|date_format:"%d %B-%Y"}--> </td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                <THEAD>
                <tr>
                    
                        <th class="tdatahead" align="left">NO</TH>
                        <th class="tdatahead" align="left" width="10%">NAMA KARYAWAN</TH>
                        <th class="tdatahead" align="left" width="10%">NIP KARYAWAN</TH>
                         <th class="tdatahead" align="left" width="10%">ID PRINT</TH>
                        <th class="tdatahead" align="left" >CABANG</TH>
                        <th class="tdatahead" align="left">DEPARTEMEN</TH>
                        <th class="tdatahead" align="left" >JABATAN</TH>
                        <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
		</tr>
		</thead>
                <tbody>
                <!--{section name=x loop=$DATA_TB}-->
                <TR class='<!--{cycle values="alt,alt3"}-->'>
                <td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                 <TD class="tdatacontent"> <!--{$DATA_TB[x].r_pnpt__finger_print}--> </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_cabang__nama}--> </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_dept__ket}-->  </TD>
                <TD class="tdatacontent"> <!--{$DATA_TB[x].r_jabatan__ket}--> </TD>
                <TD width="20" class="tdatacontent" ALIGN="CENTER">
                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_pnpt__finger_print}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
                </TR>
                <!--{sectionelse}-->
                <TR>
                <TD class="tdatacontent" COLSPAN="13" align="center">Maaf, Data masih kosong</TD>
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
                    <INPUT TYPE="hidden" name="kode_perwakilan_cari" value="<!--{$KODE_PERWAKILAN_CARI}-->">
                    <INPUT TYPE="hidden" name="no_paspor_cari" value="<!--{$NO_PASPOR_CARI}-->">
                    <INPUT TYPE="hidden" name="nama_wni_cari" value="<!--{$NAMA_WNI_CARI}-->">
                    <INPUT TYPE="hidden" name="kode_sumber" value="<!--{$KODE_SUMBER}-->">
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
