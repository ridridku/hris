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
		<tr><td class="tcat">FORM MASTER LIBUR</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0">Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
               <TABLE id="table-add-box">
                <!--{if $EDIT_VAL==0}-->
                <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
                <!--{else}-->
                <INPUT TYPE="hidden" NAME="id" value="<!--{$EDIT_ID}-->" size="35" readOnly class="text_disabled">
                <!--{/if}-->
                
                <INPUT   TYPE="hidden" name="cutibersama__id" size="35" value="<!--{$EDIT_CUTIBERSAMA__ID}-->"  >
          
                
                 <TR>
                            <TD>Tgl Libur  <font color="#ff0000">*</font></TD>
                            <TD>
                            <!--{if $EDIT_VAL==0}-->
                            <input readonly="" type="text" NAME="tgl_libur" value="<!--{$smarty.now|date_format|date_format:"%Y-%m-%d"}-->">
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_libur,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                            <!--{else}-->
                            <input readonly="" type="text" name="tgl_libur" value="<!--{$EDIT_CUTIBERSAMA__TGL}-->" >
                                                     <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_libur,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
                                    <!--{/if}-->


                            </TD>
                    </TR>

            
 <TR>
                                <TD>Keterangan Libur Bersama<font color="#ff0000">*</font></TD> 
				<TD>    
                                    <TEXTAREA name="keterangan" id="id_ket"  rows="5" cols="30"> <!--{$EDIT_CUTIBERSAMA__KET}--></TEXTAREA>   
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
					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td><TR>

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
                           
                            
							<TD>Periode Awal</TD>
							<TD>
                                                        <SELECT NAME="tgl1" > 
                                                        <OPTION VALUE="" selected>[Pilih Tgl]</OPTION>
                                                        <!--{section name=foo start=1 loop=31 step=1}-->
                                                                  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%d"}-->
                                                                         <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                                                  <!--{else}-->
                                                                                 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
                                                                 <!--{/if}--> 
                                                        <!--{/section}-->
                                                        </SELECT> 
							<SELECT name="bulan1"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="1"<!--{if $smarty.now|date_format:"%m"==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="2"<!--{if $smarty.now|date_format:"%m"==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="3"<!--{if $smarty.now|date_format:"%m"==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="4"<!--{if $smarty.now|date_format:"%m"==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="5"<!--{if $smarty.now|date_format:"%m"==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="6"<!--{if $smarty.now|date_format:"%m"==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="7"<!--{if $smarty.now|date_format:"%m"==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="8"<!--{if $smarty.now|date_format:"%m"==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="9"<!--{if $smarty.now|date_format:"%m"==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $smarty.now|date_format:"%m"==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $smarty.now|date_format:"%m"==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $smarty.now|date_format:"%m"==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun1" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%Y"}-->
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
                                                                  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%d"}-->
                                                                         <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
                                                                  <!--{else}-->
                                                                                 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
                                                                 <!--{/if}--> 
                                                        <!--{/section}-->
                                                        </SELECT> 
							<SELECT name="bulan2"> 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
                                                                <OPTION value="1"<!--{if $smarty.now|date_format:"%m"==1}-->selected<!--{/if}-->>Januari</OPTION>
								<OPTION VALUE="2"<!--{if $smarty.now|date_format:"%m"==2}-->selected<!--{/if}-->  >Februari</OPTION>
								<OPTION VALUE="3"<!--{if $smarty.now|date_format:"%m"==3}-->selected<!--{/if}-->  >Maret</OPTION>
								<OPTION VALUE="4"<!--{if $smarty.now|date_format:"%m"==4}-->selected<!--{/if}-->  >April</OPTION>
								<OPTION VALUE="5"<!--{if $smarty.now|date_format:"%m"==5}-->selected<!--{/if}--> >Mei</OPTION>
								<OPTION VALUE="6"<!--{if $smarty.now|date_format:"%m"==6}-->selected<!--{/if}-->  >Juni</OPTION>
								<OPTION VALUE="7"<!--{if $smarty.now|date_format:"%m"==7}-->selected<!--{/if}-->  >Juli</OPTION>
								<OPTION VALUE="8"<!--{if $smarty.now|date_format:"%m"==8}-->selected<!--{/if}-->  >Agustus</OPTION>
								<OPTION VALUE="9"<!--{if $smarty.now|date_format:"%m"==9}-->selected<!--{/if}-->  >September</OPTION>
								<OPTION VALUE="10"<!--{if $smarty.now|date_format:"%m"==10}-->selected<!--{/if}-->  >Oktober</OPTION>
								<OPTION VALUE="11"<!--{if $smarty.now|date_format:"%m"==11}-->selected<!--{/if}-->  >November</OPTION>
								<OPTION VALUE="12"<!--{if $smarty.now|date_format:"%m"==12}-->selected<!--{/if}-->  >Desember</OPTION>				 
                                                        </SELECT> 
						<SELECT NAME="tahun2" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
						<!--{section name=foo start=2010 loop=2021 step=1}-->
 							  <!--{if ($smarty.section.foo.index)==$smarty.now|date_format:"%Y"}-->
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
		<tr><td class="tcat">Data Libur Bersama</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Daftar Master Libur Bersama</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
                <THEAD>
											<TH class="tdatahead" align="left" width="3%">NO</TH>
                                                                       
											<TH class="tdatahead" align="left">TGL LIBUR</TH>
                                                                                        <TH class="tdatahead" align="left">KETERANGAN LIBUR</TH>
											                                                                                                 								<TH class="tdatahead" COLSPAN="2" ><!--{$ACTION}--></TH>
		</THEAD>

			<tbody width="70%">
			<!--{section name=x loop=$DATA_TB}-->
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"><!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_tglcuti__tgl|date_format:"%d-%b-%Y"}--></TD>
                                                                                        <TD class="tdatacontent"> <!--{$DATA_TB[x].r_tglcuti__ket}--></TD>
											
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].r_tglcuti__id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].r_tglcuti__id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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
                    </SELECT>
                    </td>
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
