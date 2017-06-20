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
    <tr><td class="tcat">Form Open Ticketing </td></tr>
    </table>
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
    <tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
    <tr><td class="alt2" style="padding:0px;">
    <FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php" enctype="multipart/form-data">
    <TABLE id="table-add-box" border="0">
                     <TR> <INPUT TYPE="hidden" NAME="ticket_id" readonly  size="35" value="<!--{$EDIT_ID}-->">
                            <TD>Pengirim <font color="#ff0000">*</font> </TD>
                            <TD>
                                 <!--{if $EDIT_VAL==1}-->
                                   <INPUT TYPE="text" NAME="nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$EDIT_NAMA_PENGIRIM}-->">
                                     <INPUT TYPE="text" NAME="pengirim" readonly  id="r_pegawai__id"  size="35" value="<!--{$EDIT_ID_PENGIRIM}-->">
                                   <!--{else}-->
                                   <INPUT TYPE="text" NAME="nama" readonly  id="r_pegawai__nama"  size="35" value="<!--{$NAMA_USER}-->">
                                 <INPUT TYPE="text" NAME="pengirim" readonly  id="r_pegawai__id"  size="35" value="<!--{$ID_USER}-->">
                                 <!--{/if}--> 
                            </TD>
                    </TR>
                    <TR>
                            <TD>Modul  <font color="#ff0000">*</font></TD>
                            <TD>
                                <SELECT name="modul_parent" onchange="cari_subcab2(this.value);">
                                <option value=""> Pilih Modul </option>
                                <!--{section name=x loop=$DATA_PARENT}-->
                                        <!--{if trim($DATA_PARENT[x].menu_id)==$EDIT_PARENT}-->
                                        <option value="<!--{$DATA_PARENT[x].menu_id}-->" selected > <!--{$DATA_PARENT[x].menu_label}--> </option>
                                        <!--{else}-->
                                        <option value="<!--{$DATA_PARENT[x].menu_id}-->"  > <!--{$DATA_PARENT[x].menu_label}--> </option>
                                        <!--{/if}-->
                                <!--{/section}-->
                                </SELECT>
                            </TD>
                    </TR>
                    <TR>
                            <TD>Pilih Sub Modul</TD>
                                    <TD>
                                        <DIV id="ajax_subcabang2">
                                           <select name="modul_child">
                                                <option value="">Pilih Sub Modul</option>
                                                <!--{section name=x loop=$DATA_SUBMODUL}-->
                                                <!--{if trim($DATA_SUBMODUL[x].menu_id)==$EDIT_CHILD}-->
                                                <option value="<!--{$DATA_SUBMODUL[x].menu_id}-->" selected > <!--{$DATA_SUBMODUL[x].menu_label}--> </option>
                                                <!--{else}-->
                                                <option value="<!--{$DATA_SUBMODUL[x].menu_id}-->"  > <!--{$DATA_SUBMODUL[x].menu_label}--> </option>
                                                <!--{/if}-->
                                                <!--{/section}-->
                                           </select>
                                        </DIV>
                                    </TD>
                        </TR>
                   
                    <TR>
                                <TD>Keterangan <font color="#ff0000">*</font><font color="#ff0000">*</font></TD>
				                        <TD>
                                     <!--{if $EDIT_VAL==1}-->
                                    <TEXTAREA name="keterangan" cols="50" rows="10" ><!--{$EDIT_KET}--></TEXTAREA>
                                     <!--{else}-->
                                    <TEXTAREA name="keterangan" cols="50" rows="10" ></TEXTAREA>
                                    <!--{/if}-->
                                </TD>
                    </TR>
                    <TR>
                        <TD>Status<font color="#ff0000">*</font></TD>
                                <TD>
                                <!--{if $GROUP_USER==1}-->
                                    <SELECT name="status" size="1" >
                                    <OPTION value="">[Status]</OPTION>
                                    <OPTION value="1" <!--{if $EDIT_STATUS=='1'}-->selected<!--{/if}-->>Open</OPTION>
                                    <OPTION value="2" <!--{if $EDIT_STATUS=='2'}-->selected<!--{/if}-->>On Hold</OPTION>
                                    <OPTION value="3" <!--{if $EDIT_STATUS=='3'}-->selected<!--{/if}-->>In Progress</OPTION>
                                    <OPTION value="4" <!--{if $EDIT_STATUS=='4'}-->selected<!--{/if}-->>Closed</OPTION>
                                    </SELECT>

                                    <!--{else}-->
                                  <SELECT name="status" size="1" >
                                              <OPTION value="">[Status]</OPTION>
                                             <OPTION value="1" <!--{if $EDIT_STATUS=='1'}-->selected<!--{/if}-->>Open</OPTION>

                                  </SELECT>

                                 <!--{/if}-->
                          </TD>
                    </TR>
                         <!--{if $GROUP_USER==1}-->
                    <TR>
                            <TD>Prioritas<font color="#ff0000">*</font></TD>
                            <TD>
                                <SELECT name="prioritas">
                                    <OPTION value="">Pilih Prioritas</OPTION>
                                    <OPTION value="1" <!--{if $EDIT_PRIORITAS=='1'}-->selected<!--{/if}-->>Low</OPTION>
                                    <OPTION value="2" <!--{if $EDIT_PRIORITAS=='2'}-->selected<!--{/if}-->>Normal</OPTION>
                                    <OPTION value="3" <!--{if $EDIT_PRIORITAS=='3'}-->selected<!--{/if}-->>High</OPTION>
                                </SELECT>
                            </TD>
                    </TR>
                    <TR>
                              <TD>Estimasi Pekerjaan <font color="#ff0000">*</font></TD>
                              <TD>
                                  <INPUT TYPE="text" NAME="estimasi"  size="10" value="<!--{$EDIT_ESTIMASI}-->" >Hari
                              </TD>
                   </TR>
                 <TR>
                              <TD>Support By</TD>
                              <TD>
                                  <INPUT TYPE="text" NAME="support"  size="35" value="<!--{$EDIT_SUPPORT}-->" >
                              </TD>
                         </TR>
                            <!--{/if}-->
                    <TR>
                                <TD>Check Jika ada File Upload</TD>
				<TD>
                                    <input type="checkbox" onclick="codename()" name="checkboxname" value="1">
                                </TD>
                     </TR>
                     <TR>
                                <TD>Capture </TD>
				<TD>
                                    <INPUT TYPE="file" disabled NAME="file_gambar" size="35"  value="<!--{$EDIT_GAMBAR}-->" >
                                    <INPUT TYPE ="hidden"  name="foto2"  value="<!--{$EDIT_GAMBAR}-->">
                                </TD>

                     </TR>
                     <!--{if $EDIT_VAL==1}-->
                   <TR>
                        <TD></TD>
                        <TD>
                        <img src="<!--{$HREF_FOTO}-->/<!--{$EDIT_GAMBAR}-->" width=105 height=134 >
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
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
					</TD>
				</TR>
					<TR><TD  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>
					</TR>

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
                         <TD>Status Ticketing<font color="#ff0000">*</font></TD>
                         <TD>
                             <SELECT name="status_cari" size="1" >
                                         <OPTION value="">[Status]</OPTION>
                                         <OPTION value="1">Open</OPTION>
                                         <OPTION value="2">On Hold</OPTION>
                                         <OPTION value="3">In Progress</OPTION>
                                          <OPTION value="4">Closed</OPTION>

                             </SELECT>
                         </TD>
                         </TR>                 
                         <TR>
                         <TD>No Ticketing<font color="#ff0000">*</font></TD>
                         <TD><INPUT type="" name="ticket_cari"></TD>
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
		<tr><td class="tcat">Data Ticketing</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Data Ticketing</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                    <THEAD>
											<TH class="tdatahead" align="left">NO</TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NO TICKETING </TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NIP </TH>
                                                                                        <TH class="tdatahead" align="left" width="10%">NAMA</TH>
                                                                                        <TH class="tdatahead" align="left" >CABANG</TH>
                                                                                        <TH class="tdatahead" align="left" >TGL KIRIM</TH>
                                                                                        <TH class="tdatahead" align="left" >MODUL / SUBMODUL</TH>
											<TH class="tdatahead" align="left">KETERANGAN</TH>
											<TH class="tdatahead" align="left">STATUS</TH>
                                                                                         <!--{if $GROUP_USER==1}-->
											<TH class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
                                                                                            <!--{/if}-->
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent"><!--{$DATA_TB[x].ticketing__id}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_pnpt__nip}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_pegawai__nama}--> </TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].r_cabang__nama}--> </TD>
											<TD class="tdatacontent"><!--{$DATA_TB[x].ticketing__date_created|date_format:'%d-%b-%Y'}--> </TD>
											<TD class="tdatacontent"><!--{$DATA_TB[x].LABEL_PARENT}--> / <!--{$DATA_TB[x].LABEL_CHILD}--></TD>
                                                                                        <TD class="tdatacontent"><!--{$DATA_TB[x].ticketing__deskripsi}--></TD>
                                                                                        <TD class="tdatacontent">
                                                                                           <!--{if ($DATA_TB[x].ticketing__status)==1}-->
                                                                                           <font color="#ff0000"> Open </font>
                                                                                            <!--{elseif ($DATA_TB[x].ticketing__status)==2}-->
                                                                                           <font color="#fcef02"> On Hold </font>
                                                                                            <!--{elseif ($DATA_TB[x].ticketing__status)==3}-->
                                                                                           <font color="#41b527"> On Progress </font>
                                                                                          
                                                                                           <!--{else}-->
                                                                                                <font color="#0a8727">Done</font>
                                                                                            <!--{/if}-->


                                                                                        </TD>
 <!--{if $GROUP_USER==1}-->
											<TD width="20" class="tdatacontent" ALIGN="CENTER">  
                                                                                            <IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].ticketing__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].ticketing__id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
			 <!--{/if}-->							
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
