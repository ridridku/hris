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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
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
					
<td  width="150" colspan="2">Tahun Anggaran</td>
<td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->
<!--{$smarty.now|date_format:"%Y-%m-%d"}-->
<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List"></td>
</tr>
<tr>
<td colspan="2">Nama Propinsi </td>
<td>
					<SELECT name="no_propinsi" onChange="cari_kabupaten2(this.value)">
					<OPTION VALUE="">[Pilih Propinsi]</OPTION>
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
<td colspan="2">Nama Kabupaten </td>
<td>
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
					</div>	
								</td>
</tr></table>
		<div id="title-box2">Detail</div>
		<TABLE id="table-add-box">
<tr>
<td colspan="2" width="150">Nama Penggisi </td>
<td><input type="text" name="nama_penggisi" maxlength="50" value="<!--{$NAMA_PENGGISI}-->"></td>
</tr>
<tr>
<td colspan="2">No Ruas </td>
<td><input type="text" name="no_ruas" maxlength="50" value="<!--{$NO_RUAS}-->"></td>
</tr>
<tr>
<td colspan="2">Nama Jembatan/Sungai </td>
<td><input name="nama_jembatan_sungai" type="text" value="<!--{$NAMA_JEMBATAN_SUNGAI}-->" size="35" maxlength="150"></td>
</tr>
<tr>
<td colspan="2">PAL Km </td>
<td><input type="text" name="pal_km" maxlength="25" value="<!--{$PAL_KM}-->"></td>
</tr>
<tr>
<td colspan="2">Tipe Penyebrangan </td>
<td>
	<SELECT name="tipe_penyebrangan">
	<OPTION VALUE="">[Pilih Tipe Penyebrangan]</OPTION>
	<!--{section name=x loop=$DATA_TIPE_PENYEBRANGAN}-->
	<!--{if $DATA_TIPE_PENYEBRANGAN[x].kode_tipe_penyebrangan == $TIPE_PENYEBRANGAN}-->
	<option value="<!--{$DATA_TIPE_PENYEBRANGAN[x].kode_tipe_penyebrangan}-->" selected > <!--{$DATA_TIPE_PENYEBRANGAN[x].nama_tipe_penyebrangan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_TIPE_PENYEBRANGAN[x].kode_tipe_penyebrangan}-->"  > <!--{$DATA_TIPE_PENYEBRANGAN[x].nama_tipe_penyebrangan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td colspan="2">Panjang (m) </td>
<td><input type="text" name="panjang" value="<!--{$PANJANG}-->"></td>
</tr>
<tr>
<td colspan="2">Lebar (m) </td>
<td><input type="text" name="lebar" value="<!--{$LEBAR}-->"></td>
</tr>
<tr>
<td colspan="2">Jumlah Bentang </td>
<td><input type="text" name="jumlah_bentang" value="<!--{$JUMLAH_BENTANG}-->"></td>
</tr>
</table>
		<div id="title-box2">Tipe / Kondisi</div>
		<TABLE id="table-add-box">
<tr>
  <td colspan="2" width="150">Bangunan Atas </td>
  <td>&nbsp;</td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Tipe</td>
<td>
	<SELECT name="bangunan_atas_tipe">
	<OPTION VALUE="">[Pilih Tipe Bangunan Atas]</OPTION>
	<!--{section name=x loop=$DATA_TIPE_BANGUNAN_ATAS}-->
	<!--{if $DATA_TIPE_BANGUNAN_ATAS[x].kode_bangunan_atas_jembatan == $BANGUNAN_ATAS_TIPE}-->
	<option value="<!--{$DATA_TIPE_BANGUNAN_ATAS[x].kode_bangunan_atas_jembatan}-->" selected > <!--{$DATA_TIPE_BANGUNAN_ATAS[x].nama_bangunan_atas_jembatan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_TIPE_BANGUNAN_ATAS[x].kode_bangunan_atas_jembatan}-->"  > <!--{$DATA_TIPE_BANGUNAN_ATAS[x].nama_bangunan_atas_jembatan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Bahan</td>
<td>
	<SELECT name="bangunan_atas_bahan">
	<OPTION VALUE="">[Pilih Tipe Bahan Bangunan]</OPTION>
	<!--{section name=x loop=$DATA_TIPE_BANGUNAN_BAHAN}-->
	<!--{if $DATA_TIPE_BANGUNAN_BAHAN[x].kode_bahan_jembatan == $BANGUNAN_ATAS_BAHAN}-->
	<option value="<!--{$DATA_TIPE_BANGUNAN_BAHAN[x].kode_bahan_jembatan}-->" selected > <!--{$DATA_TIPE_BANGUNAN_BAHAN[x].nama_bahan_jembatan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_TIPE_BANGUNAN_BAHAN[x].kode_bahan_jembatan}-->"  > <!--{$DATA_TIPE_BANGUNAN_BAHAN[x].nama_bahan_jembatan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Asal</td>
<td><input name="bangunan_atas_asal" type="text" value="<!--{$BANGUNAN_ATAS_ASAL}-->" size="35" maxlength="100"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Kondisi</td>
<td>
	<SELECT name="bangunan_atas_kondisi">
	<OPTION VALUE="">[Pilih Kondisi Bangunan]</OPTION>
	<!--{section name=x loop=$DATA_KONDISI}-->
	<!--{if $DATA_KONDISI[x].kode_kondisi_jembatan == $BANGUNAN_ATAS_KONDISI}-->
	<option value="<!--{$DATA_KONDISI[x].kode_kondisi_jembatan}-->" selected > <!--{$DATA_KONDISI[x].nama_kondisi_jembatan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_KONDISI[x].kode_kondisi_jembatan}-->"  > <!--{$DATA_KONDISI[x].nama_kondisi_jembatan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td colspan="2">Lantai</td>
<td>&nbsp;</td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Tipe 1 </td>
  <td><input type="text" name="lantai_tipe1" maxlength="50" value="<!--{$LANTAI_TIPE1}-->"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Tipe 2 </td>
<td><input type="text" name="lantai_tipe2" maxlength="50" value="<!--{$LANTAI_TIPE2}-->"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Kondisi</td>
<td><input type="text" name="lantai_kondisi" maxlength="50" value="<!--{$LANTAI_KONDISI}-->"></td>
</tr>
<tr>
<td colspan="2">Sandaran</td>
<td></td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Tipe 1 </td>
  <td><input name="sandaran_tipe1" type="text" id="sandaran_tipe1" value="<!--{$SANDARAN_TIPE1}-->" maxlength="50"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Tipe 2 </td>
<td><input type="text" name="sandaran_tipe2" maxlength="50" value="<!--{$SANDARAN_TIPE2}-->"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Kondisi</td>
<td><input type="text" name="sandaran_kondisi" maxlength="50" value="<!--{$SANDARAN_KONDISI}-->"></td>
</tr>
<tr>
<td colspan="2">Pondasi</td>
<td>&nbsp;</td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Tipe</td>
  <td>
	<SELECT name="pondasi_tipe">
	<OPTION VALUE="">[Pilih Tipe Pondasi]</OPTION>
	<!--{section name=x loop=$DATA_TIPE_PONDASI}-->
	<!--{if $DATA_TIPE_PONDASI[x].kode_pondasi_jembatan == $PONDASI_TIPE}-->
	<option value="<!--{$DATA_TIPE_PONDASI[x].kode_pondasi_jembatan}-->" selected > <!--{$DATA_TIPE_PONDASI[x].nama_pondasi_jembatan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_TIPE_PONDASI[x].kode_pondasi_jembatan}-->"  > <!--{$DATA_TIPE_PONDASI[x].nama_pondasi_jembatan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Bahan 1 </td>
<td><input name="pondasi_bahan1" type="text" id="pondasi_bahan1" value="<!--{$PONDASI_BAHAN1}-->" maxlength="50"></td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Bahan 2 </td>
  <td><input name="pondasi_bahan2" type="text" id="pondasi_bahan2" value="<!--{$PONDASI_BAHAN2}-->" maxlength="50"></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Kondisi</td>
<td><input type="text" name="pondasi_kondisi" maxlength="50" value="<!--{$PONDASI_KONDISI}-->"></td>
</tr>
<tr>
<td colspan="2">Kepala Jembatan </td>
<td>&nbsp;</td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Tipe</td>
  <td>
	<SELECT name="kep_jembatan_tipe">
	<OPTION VALUE="">[Pilih Tipe Kep Jembatan]</OPTION>
	<!--{section name=x loop=$DATA_TIPE_KEPALA_JEMBATAN}-->
	<!--{if $DATA_TIPE_KEPALA_JEMBATAN[x].kode_kepala_jembatan == $KEP_JEMBATAN_TIPE}-->
	<option value="<!--{$DATA_TIPE_KEPALA_JEMBATAN[x].kode_kepala_jembatan}-->" selected > <!--{$DATA_TIPE_KEPALA_JEMBATAN[x].nama_kepala_jembatan}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_TIPE_KEPALA_JEMBATAN[x].kode_kepala_jembatan}-->"  > <!--{$DATA_TIPE_KEPALA_JEMBATAN[x].nama_kepala_jembatan}--> </option>
	<!--{/if}-->
	<!--{/section}-->								
	</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Bahan 1 </td>
<td><input name="kep_jembatan_bahan1" type="text" id="kep_jembatan_bahan1" value="<!--{$KEP_JEMBATAN_BAHAN1}-->" maxlength="50"></td>
</tr>
<tr>
  <td><div align="right">&raquo;</div></td>
  <td>Bahan 2 </td>
  <td><input type="text" name="kep_jembatan_bahan2" maxlength="50" value="<!--{$KEP_JEMBATAN_BAHAN2}-->"></td>
</tr>

				<TR>
					<TD COLSPAN="2"></TD><TD>
					<INPUT TYPE="hidden" name="xid_k_10_main" value="<!--{$ID_K_10_MAIN}-->">
					<INPUT TYPE="hidden" name="xid_form_k_10_detail" value="<!--{$ID_FORM_K_10_DETAIL}-->">		
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
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
		<table width="100%">
			<tr>
				<td>
					<table class="tbheader">
					<tr>
						<td width="100">Propinsi </td>
						<td width="10"> : </td>
						<td><!--{$NAMA_PROPINSI}--></td>
					</tr>
					<tr>
						<td>Kabupaten/Kota </td>
						<td> : </td>
						<td><!--{$NAMA_KABUPATEN}--></td>
					</tr>
					<tr>
						<td>Tahun </td>
						<td> : </td>
						<td><!--{$SEARCH_YEAR}--></td>
					</tr>
					</table>
				</TD>
			</TR>
			<TR>
				<TD>
					<TABLE  WIDTH="100%">
					<TR>
						<th class="tdatahead"><!--{$TB_NO}--></TH>
						<th class="tdatahead"><!--{$TB_NO_RUAS}--></TH>
						<th class="tdatahead"><!--{$TB_NAMA_JEMBATAN}--></TH>
						<th class="tdatahead"><!--{$TB_PAL_KM}--></TH>
						<th class="tdatahead"><!--{$TB_NAMA_PENGGISI}--></TH>
						<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
					</TR>
					<!--{section name=x loop=$DATA_TB}-->
					<tr class='<!--{cycle values="alt,alt3"}-->'>
						<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
						<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].no_ruas}--> </TD>
						<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_jembatan_sungai}--> </TD>
						<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].pal_km}--> </TD>
						<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_penggisi}--> </TD>
						<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_k_10_main=<!--{$DATA_TB[x].id_k_10_main}-->&id_k_10_detail=<!--{$DATA_TB[x].id_fk_10_detail}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
						<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_k_10_main=<!--{$DATA_TB[x].id_k_10_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
					</TR>
					<!--{sectionelse}-->
					<TR>
						<td class="tdatacontent" COLSPAN="7" align="center">Sorry, your query has not been successful, please try again</TD>
					</TR>
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

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>	
</HTML>