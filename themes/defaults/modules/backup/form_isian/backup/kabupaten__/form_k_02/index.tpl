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

<div id="add-search-box" style="width:430px;">
<!-- <div>------debug : <!--{$NO_JENIS_JALAN}--></div> -->
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry3_',1);hideAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/databases.png" align="absmiddle">Export Data</span></a>
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);getAllData('<!--{$NO_PROPINSI}-->','<!--{$NO_KABUPATEN}-->','<!--{$SEARCH_YEAR}-->','<!--{$NO_JENIS_JALAN}-->');frmCreate.op.value=1;this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> Edit Data</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>
		
		<DIV ID="_menuEntry3_1" style="top:10px;width:100%;display:none;position:absolute;">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME2}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate2" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
			  <tr>
			    <td width="25%">MySQL Host Address </td>
			    <td width="75%"><input name="hostname1" type="text" id="hostname1" size="30" maxlength="30" value="localhost"></td>
			  </tr>
			  <tr>
			    <td>User Name </td>
			    <td><input name="username1" type="text" id="username1" size="20" maxlength="18" value="root"></td>
			  </tr>
			  <tr>
			    <td>Password</td>
			    <td><input name="password1" type="text" id="password1" size="20" maxlength="18"></td>
			  </tr>
			<TR>
				<TD COLSPAN="2" height="4"></TD></TR>
			<TR>
				<TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="import" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="3">
				<a class="button" href="#" onclick="this.blur();document.frmCreate2.submit(); document.frmCreate2.page.value='1';"  onSubmit="frmCreate2.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$SUBMIT}--></span></a>
				<a class="button" href="#" onclick="this.blur();document.frmCreate2.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>
				</TD>
			</TR>									
			</TABLE>	
		</FORM>
		</td></tr>
		</table>
		</DIV>

<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">

	<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
	<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
	</table>
	<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
	<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
	<tr><td class="alt2" style="padding:0px;">
	
		<TABLE id="table-add-box">

<tr>
<td>Nama Provinsi </td>
<td>					
<SELECT name="no_propinsi" onChange="cari_kabupaten2(this.value)">
<OPTION VALUE="">[Pilih Provinsi]</OPTION>
<!--{section name=x loop=$DATA_PROPINSI}-->
<!--{if trim($DATA_PROPINSI[x].no_propinsi) == trim($NO_PROPINSI)}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT>
</td>
</tr>
<tr>
<td>Nama Kabupaten </td>
<td>
<div id="ajax_kabupaten2">
<SELECT name="no_kabupaten" onchange="removeRowAllFromTable()">
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
					</td>
</tr>
				<TR>
					
<td width="170">Tanggal Usulan </td>
<td>

<input type="text" name="tanggal_usulan" value="
<!--{if $TANGGAL_USULAN==''}-->

<!--{else}-->
<!--{$TANGGAL_USULAN}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal_usulan,'dd-mm-yyyy',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
</td>
</tr>
<tr>
<td>Diisi Oleh </td>
<td><input type="text" name="nama_penggisi_usulan" maxlength="50" value="<!--{$NAMA_PENGGISI}-->"></td>
</tr>
</table>
	
	<div id="title-box2">Detail</div>

<TABLE WIDTH="900" style="margin:0px;">										
<TR>
	<th class="tdatahead" width="10">No.</TH>
	<th class="tdatahead" width="78">No Ruas</TH>
	<th class="tdatahead" width="200">Nama Ruas</TH>
	<th class="tdatahead" width="90">Kategori Jln</TH>
	<th class="tdatahead" width="60">Panjang<br>(KM)</TH>
	<th class="tdatahead" width="100">Kondisi</TH>
	<th class="tdatahead" width="65">Lebar<br>(m)</TH>
	<th class="tdatahead" width="65">LHR Roda 4 / Th</TH>
	<th class="tdatahead" width="">Kota Utama / Aktivitas yg Dilayani</TH>
</TR>
</table>
<div id="test"><!--{$TEST}--></div>

<div style="float:left;font:12px/24px;background:#FFFFF2;width:900px;">&nbsp;&nbsp;(A) Prioritas nasional, akses ke jalan nasional/provinsi</div>
<div style="float:left;">
<a class="button" href="#" title="Add Baris Data" onclick="this.blur();addRowToTable('tblItem1');get_data_ruas(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">+</span></a>
<a class="button" href="#" title="Hapus Baris Data Terakhir" onclick="this.blur();removeRowFromTable('tblItem1');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">-</span></a>
</div>

<div id="ajax_all_data">
<table id="tblItem1" cellspacing="0" cellpadding="0" width="900px" align="left">
</table>
</div>

<div style="border-top:1px solid #666;float:left;font:12px/24px;background:#FFFFF2;width:900px;">&nbsp;&nbsp;(B) Prioritas nasional, ruas-ruas jalan di daerah perbatasan, pulau-pulau kecil, rawan bencana, dll.</div>
<div style="float:left;">
<a class="button" href="#" title="Add Baris Data" onclick="this.blur();addRowToTable('tblItem2');get_data_ruas2(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">+</span></a>
<a class="button" href="#" title="Hapus Baris Data Terakhir" onclick="this.blur();removeRowFromTable('tblItem2');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">-</span></a>
</div>

<div id="ajax_all_data2">
<table id="tblItem2" cellspacing="0" cellpadding="0" width="900px" align="left">
</TABLE>
</div>

	</td></tr>
	</table>
<div style="margin-top:10px;margin-left:350px;">
<!--
<INPUT TYPE="hidden" name="xid_usulan_main" value="<!--{$ID_USULAN_MAIN}-->">	
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="op" value="0">
<input type="hidden" name="jum_rows1" id="jum_rows1" value="<!--{$JUM1}-->">
<input type="hidden" name="jum_rows2" id="jum_rows2" value="<!--{$JUM2}-->">
<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
-->
<INPUT TYPE="hidden" name="xid_usulan_main" >	
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="op" value="0">
<input type="hidden" name="jum_rows1" id="jum_rows1" >
<input type="hidden" name="jum_rows2" id="jum_rows2" >
<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>
</div>	
	</FORM>	
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
								<OPTION VALUE="">[Pilih Provinsi]</OPTION>
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
								</div>							
								</TD>
							</TR>
							<TR>
							<TD>Tahun</TD>
							<TD><!--{html_select_date prefix="Search_" start_year="2000" end_year="+10" display_days=false display_months=false}--></TD>
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
		<table width="100%"><tr><td>
									<table class="tbheader">
									<tr><td width="100">Provinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td>									
									<tr><td>Kabupaten </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td>
									<tr><td>Tahun </td><td> : </td><td><!--{$SEARCH_YEAR}--></td></tr>
									<td>Diisi Oleh </td><td> : </td><td><!--{$NAMA_PENGGISI|default:'-'}--></td>
									</tr>
									</table>
									</TD>
								</TR>								
								<TR>
									<TD><TABLE  WIDTH="100%">										
										<TR>
											<th class="tdatahead"><!--{$TB_NO}--></TH>
											<th class="tdatahead"><!--{$TB_RUAS}--></TH>
											<th class="tdatahead"><!--{$TB_JENIS_JALAN}--></TH>
											<th class="tdatahead"><!--{$TB_PANJANG}--></TH>
											<th class="tdatahead"><!--{$TB_KONDISI}--></TH>
											<th class="tdatahead"><!--{$TB_LEBAR}--></TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										<TR bgcolor="#999999"><TD class="tdatacontent" height="21" valign="absmiddle" COLSPAN="8">(A) Prioritas nasional, akses ke jalan nasional/provinsi</TD></TR>
										<!--{section name=x loop=$DATA_TB}-->
										
										<!--{if $DATA_TB[x].kelompok_prioritas=="A"}-->
										
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$DATA_TB[x].no_ruas}-->&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_ruas}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{if $DATA_TB[x].id_jns_jln==1}-->Provinsi<!--{elseif $DATA_TB[x].id_jns_jln==2}-->Kabupaten/ Kota<!--{/if}--> </TD>
											<!-- <TD class="tdatacontent" align="center" nowrap> <!--{$DATA_TB[x].panjang}--> </TD> -->
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_PANJANG[x]}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].kondisi}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_TB[x].lebar}--> </TD>
											<!-- <td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_usulan_main=<!--{$DATA_TB[x].id_usulan_main}-->&id_usulan_detail=<!--{$DATA_TB[x].id_usulan_detail}-->&Search_Year=<!--{$SEARCH_YEAR}-->&jns_jln_=<!--{$DATA_TB[x].id_jns_jln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_usulan_main=<!--{$DATA_TB[x].id_usulan_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD> -->
											<td width="20" colspan="2" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_usulan_main=<!--{$DATA_TB[x].id_usulan_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&jns_jln_=<!--{$DATA_TB[x].id_jns_jln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{/if}-->
										<!--{/section}-->
										<TR bgcolor="#999999"><TD class="tdatacontent" height="21" valign="absmiddle" COLSPAN="8">(B) Prioritas nasional, ruas-ruas jalan di daerah perbatasan, pulau-pulau kecil, rawan bencana, dll.</TD></TR>
										<!--{section name=x loop=$DATA_TB}-->
										
										<!--{if $DATA_TB[x].kelompok_prioritas=="B"}-->
										
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$DATA_TB[x].no_ruas}-->&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_ruas}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{if $DATA_TB[x].id_jns_jln=="1"}-->Propinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--> </TD>
											<!-- <TD class="tdatacontent" align="center" nowrap> <!--{$DATA_TB[x].panjang}--> </TD> -->
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_PANJANG[x]}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].kondisi}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_TB[x].lebar}--> </TD>
											<!-- <td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_usulan_main=<!--{$DATA_TB[x].id_usulan_main}-->&id_usulan_detail=<!--{$DATA_TB[x].id_usulan_detail}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD> -->
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_usulan_main=<!--{$DATA_TB[x].id_usulan_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{/if}-->
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
<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
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

	<!--{if $STATUS_ERROR==2}--><BR><BR><p align="center"> TIDAK ADA DATA YANG AKAN DIEKSPORT </p> <!--{/if}-->
	<!--{if $STATUS_ERROR==1}--><BR><BR><p align="center"> KONEKSI GAGAL </p> <!--{/if}-->
	<!--{if $STATUS_ERROR==3}--><BR><BR><p align="center"> DATA BERHASIL DI EKSPORT </p> <!--{/if}-->

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>	
</BODY>
</HTML>