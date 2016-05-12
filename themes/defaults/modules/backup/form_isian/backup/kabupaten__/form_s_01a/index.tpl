<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
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
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Loading Page....
		</td></tr>
	</table>
</div>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->
<div id="add-search-box">
<!--<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>-->
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>
		
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
				<TR>
				<td width="150">Tanggal</td><td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->
<!--{$smarty.now|date_format:"%Y-%m-%d"}-->
<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
</td></tr>
<tr><td>Nama Propinsi</td><td>
<SELECT name="no_propinsi" onChange="cari_kabupaten2(this.value)">
<OPTION VALUE="">[Pilih Propinsi]</OPTION>
<!--{section name=x loop=$DATA_PROPINSI}-->
<!--{if trim($DATA_PROPINSI[x].no_propinsi) == trim($NO_PROPINSI)}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td></tr>
<tr><td>Nama Kabupaten</td><td>
<div id="ajax_kabupaten2">
<SELECT name="no_kabupaten">
<OPTION VALUE="">[Pilih Kabupaten]</OPTION>
<!--{section name=x loop=$DATA_KABUPATEN}-->
<!--{if $DATA_KABUPATEN[x].no_kabupaten == $NO_KABUPATEN}-->
<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
<!--{else}-->
<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
<!--{/if}-->
<!--{/section}-->								
</SELECT>	
</td></tr>
</table>			

<div id="title-box2">Data Ruas Jalan</div>

<table id="table-add-box" border="0">

<tr><td width="150">Nomor Ruas</td><td width="200"><div id="ajax_no_ruas"><input type="text" name="no_ruas" maxlength="25" onBlur="get_data_ruas(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value,this.value)" value="<!--{$NO_RUAS}-->"></td>
</tr>

<!-- Tambahan 17-06-2010 -->
<tr><td>Kategori Jalan</td><td>
<!-- <div id="ajax_hidden_jns_jln"><INPUT TYPE="hidden" name="txt_hidden_jns_jln" value="<!--{$ID_HIDDEN_JSN_JLN}-->"></div> -->
<div id="ajax_hidden_jns_jln"><INPUT TYPE="hidden" name="txt_hidden_jns_jln" value="<!--{$ID_HIDDEN_JSN_JLN}-->"></div>
<div id="ajax_jns_jln"><input name="txt_jns_jln" type="text" value="<!--{$PID_JENIS_JLN2}-->" size="35" maxlength="200" readonly></div>
</td>
<!-- End 0f Tambahan 17-06-2010 -->

<tr><td>Nama Pangkal Ruas</td><td><div id="ajax_nama_pangkal_ruas"><input name="nama_pangkal_ruas" type="text" value="<!--{$NAMA_PANGKAL_RUAS}-->" size="35" maxlength="200" readonly></td>
</tr>
<tr><td>Nama Ujung Ruas</td><td><div id="ajax_nama_ujung_ruas"><input name="nama_ujung_ruas" type="text" value="<!--{$NAMA_UJUNG_RUAS}-->" size="35" maxlength="200" readonly></td>
</tr>
<tr><td>Awal KM Ruas</td><td><div id="ajax_awal_km_ruas"><input name="awal_km" type="text" value="<!--{$PAL_KM_AWAL}-->" size="35" maxlength="200" readonly></td>
</tr>
<tr><td>Akhir KM Ruas</td><td><div id="ajax_akhir_km_ruas"><input name="akhir_km" type="text" value="<!--{$PAL_KM_AKHIR}-->" size="35" maxlength="200" readonly></td>
</tr>
</table>

<div id="title-box2">Data Detail Survai Kondisi Jalan
</div>

<table style="margin-top:0;" width="750">
<thead>
<tr>
<th rowspan="2" class="tdatahead" width="50">No</th>
<th rowspan="2" class="tdatahead" width="300">No Segmen</th>
<th rowspan="2" class="tdatahead" width="100">Nilai Kerusakan (%)</th>
<th colspan="3" class="tdatahead">Program Penanganan</th>
<th rowspan="2" class="tdatahead" width="200" style="border-right:1px solid #FFF">Keterangan</th>
</tr>
<tr>
<th class="tdatahead" width="100">PR</th>
<th class="tdatahead" width="100">PM</th>
<th class="tdatahead" width="100">PK</th>
</tr>
</thead>
</table>
<div id="ajax_tbDetail">
<table id="tblItem" style="margin-top:0;" width="750">
<!--{section name=x loop=$DATA_DETAIL}-->
<tr>
<!-- Disabled on 14-09-2010
<td class="tdatacontent" width="45"><!--{$smarty.section.x.index+1}-->&nbsp;</td>
<td class="tdatacontent" width="295"><!--{$smarty.section.x.index+1}-->&nbsp;</td>
<td class="tdatacontent" width="110"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
<td class="tdatacontent" width="93"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
<td class="tdatacontent" width="93"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
<td class="tdatacontent" width="93"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
<td class="tdatacontent" width="200"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
-->
<td class="tdatacontent" width="45"><!--{$smarty.section.x.index+1}-->&nbsp;</td>
<td class="tdatacontent" width="295"><!--{$smarty.section.x.index+1}-->&nbsp;</td>
<td class="tdatacontent" width="110"><!--{$DATA_DETAIL[x].penilaian}-->&nbsp;</td>
<td class="tdatacontent" width="93" align="center"><!--{if $DATA_DETAIL[x].pr<>"-"}--><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" width="16" height="16"><!--{else}--><img src="<!--{$HREF_IMG_PATH}-->/icon/cross.png" width="16" height="16"><!--{/if}-->&nbsp;</td>
<td class="tdatacontent" width="93" align="center"><!--{if $DATA_DETAIL[x].pm<>"-"}--><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" width="16" height="16"><!--{else}--><img src="<!--{$HREF_IMG_PATH}-->/icon/cross.png" width="16" height="16"><!--{/if}-->&nbsp;</td>
<td class="tdatacontent" width="93" align="center"><!--{if $DATA_DETAIL[x].pk<>"-"}--><img src="<!--{$HREF_IMG_PATH}-->/icon/tick.png" width="16" height="16"><!--{else}--><img src="<!--{$HREF_IMG_PATH}-->/icon/cross.png" width="16" height="16"><!--{/if}-->&nbsp;</td>
<td class="tdatacontent" width="200" align="center"><!--{$DATA_DETAIL[x].keterangan}-->&nbsp;</td>
</tr>
<!--{/section}-->
</table>
</div>

<table border="0" width="100%">
<tr><td>&nbsp;</td><td width="20px" align="right">
<input type="hidden" name="jum_rows" id="jum_rows" value="<!--{$JUM}-->">
<INPUT TYPE="hidden" name="xid_s_01_main" value="<!--{$ID_S_01_MAIN}-->">	
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
<INPUT TYPE="hidden" name="op" value="0">
					<!--<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>-->
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
</td></tr>
</table>					
					</TD>
				</TR>
			</TABLE>
		</FORM>
		</td></tr>
		</table>
		
		</DIV>	
		
	<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">		
			<TR>
				<TD><!--{$TB_JENIS_JALAN}--></TD>
				<TD>
				<select name="jns_jln">
				<option value="">[Pilih Kategori Jalan]</option>
					<!--{section name=x loop=$DATA_JENIS_JLN}-->
					<!--{if $DATA_JENIS_JLN[x].id == $PID_JENIS_JLN}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->" selected > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{else}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->"  > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{/if}-->
					<!--{/section}-->
				</select>
				</TD>
			</TR>
			<!--
			<TR>
								<TD><!--{$TB_PROPINSI}--></TD>
								<TD>
								<SELECT name="no_propinsi" onChange="cari_kabupaten(this.value)">
								<OPTION VALUE="">[Pilih Propinsi]</OPTION>
								<!--{section name=x loop=$DATA_PROPINSI}-->
								<!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{else}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{/if}-->
								<!--{/section}-->
								</SELECT>
								</TD>
							</TR>
							-->
							<TR>
								<TD><!--{$TB_PROPINSI}--></TD>
								<TD>
								<SELECT name="no_propinsi" onChange="cari_kabupaten(this.value)">
								<OPTION VALUE="">[Pilih Provinsi]</OPTION>
								<!--{section name=x loop=$DATA_PROPINSI}-->
								<!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>				
								<!--{else}-->
									<!--{if $DATA_PROPINSI[x].no_propinsi == $ID_PROPINSI AND $NO_PROPINSI=="" }-->
									<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>		
									<!--{else}-->
									<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
									<!--{/if}-->
								<!--{/if}-->
								<!--{/section}-->
								</SELECT>
								</TD>
							</TR>
							<TR>
								<TD><!--{$TB_KABUPATEN}--></TD>
								<TD>
								<div id="ajax_kabupaten">
								<SELECT name="no_kabupaten" onChange="get_tanggal(document.frmList1.no_propinsi.value,this.value,document.frmList1.jns_jln.value)">
								<OPTION VALUE="">[Pilih Kabupaten]</OPTION>
								<!--{section name=x loop=$DATA_KABUPATEN}-->
								<!--{if $DATA_KABUPATEN[x].no_kabupaten == $NO_KABUPATEN}-->
								<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
								<!--{else}-->
								<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
								<!--{/if}-->
								<!--{/section}-->								
								</SELECT>	
								</div>							
								</TD>
							</TR>
							<TR>
								<TD>Tanggal</TD>
								<TD>
								<div id="ajax_tanggal">
								<select name="tanggal" onChange="get_no_ruas(document.frmList1.no_propinsi.value,document.frmList1.no_kabupaten.value,this.value,document.frmList1.jns_jln.value)">
								<option value="">Pilih Tanggal</option
								</select>
								</div>							
								</TD>
							</TR>
							<TR>
								<TD>No Ruas Jalan</TD>
								<TD>
								<div id="ajax_no_ruas2">
								<select name="no_ruas_search">
								<option value="">Pilih No Ruas</option
								</select>
								</div>							
								</TD>
							</TR>
							
							<TR><TD COLSPAN="2" height="4"></TD></TR>
							<TR>
								<TD></TD>
								<TD>
								<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
								<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
								<INPUT TYPE="hidden" name="search" value="1">
								<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
								<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
								<INPUT TYPE="hidden" name="op" value="0">
								<a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$SUBMIT}--></span></a>
								<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
								</TD>
							</TR>	
												
						</TABLE>
			</FORM>
			</div></div>	
		</DIV>

		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> <!--{$TABLE_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->	
		<table width="100%">

								<TR>
									<TD>
									<table class="tbheader">
									<tr><td width="100">Propinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
									<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
									<tr><td>Tahun </td><td> : </td><td><!--{$SEARCH_YEAR}--></td></tr>
									</table>
<table width="100%">
										<thead>
										<TR>
											<th class="tdatahead">No</TH>
											<th class="tdatahead">No Ruas/Nama Ruas</TH>
											<th class="tdatahead">Awal KM</TH>
											<th class="tdatahead">Akhir KM</TH>
											<th class="tdatahead">Tanggal</TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										</thead>
										<tbody>
										<!--{section name=x loop=$DATA_TB}-->
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap>[<!--{$DATA_TB[x].no_ruas}-->] <!--{$DATA_TB[x].nama_ruas_pangkal}--> - <!--{$DATA_TB[x].nama_ruas_ujung}--></TD>
											<td class="tdatacontent" nowrap><!--{$DATA_TB[x].titik_pengenal_pangkal}--></TD>
											<td class="tdatacontent" nowrap><!--{$DATA_TB[x].titik_pengenal_ujung}--></TD>
											<td class="tdatacontent" nowrap><!--{$DATA_TB[x].tanggal|DATE_FORMAT:'%D'}--></TD>
											<!--<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_fs_01_main=<!--{$DATA_TB[x].id_fs_01_main}-->&jns_jln2=<!--{$DATA_TB[x].id_jns_jln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>-->
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/view.gif" BORDER=0 ALT="View Selected Data" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_fs_01_main=<!--{$DATA_TB[x].id_fs_01_main}-->&jns_jln2=<!--{$DATA_TB[x].id_jns_jln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<!--<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_fs_01_main=<!--{$DATA_TB[x].id_fs_01_main}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>-->
										</TR>
			<!--{sectionelse}-->
			<tr>
				<td class="tdatacontent" COLSPAN="7" align="center">Sorry, your query has not been successful, please try again</td>
			</tr>
			<!--{/section}-->
			</tbody>
		</table></td></tr></table>
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Show</td>
<td width="35">
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="search" value="1">
<INPUT TYPE="hidden" name="no_propinsi" value="<!--{$NO_PROPINSI}-->">
<INPUT TYPE="hidden" name="no_kabupaten" value="<!--{$NO_KABUPATEN}-->">
		<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Record : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> of <!--{$COUNT}--></td>
<td align="right"><!--{$NEXT_PREV}--></td>

</tr>
</table>
<!--{/if}-->
</div>				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>	

</BODY>
</HTML>