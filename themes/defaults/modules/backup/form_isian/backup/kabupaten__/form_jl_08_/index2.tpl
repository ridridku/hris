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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry3_',1);hideAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/databases.png" align="absmiddle">Import Data</span></a>
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
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
		<!--
			<TR>
				<TD><!--{$TB_IMP_SQL}--></TD>
				<TD>
				<input name="file" type="file" size="25">
				</TD>
			</TR>
			-->

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

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
				<TR>
					
<td colspan="2" width="175">Tanggal</td>
<td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->

<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'dd-mm-yyyy',this)"  class="imgLink" align="absmiddle" title="Show Calendar List"></td>
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
					</SELECT></td>
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
<td colspan="2">Nama Paket (Ruas Jalan)</td>
<td><div id="ajax_paket_jalan">
<input name="nama_paket" type="text" value="<!--{$NAMA_PAKET}-->" size="35" maxlength="200"><!--{if $TOTAL_PAKET_JALAN>0}--><img src="<!--{$HREF_IMG_PATH}-->/icon/table.gif" border="0" title="Tampilkan Data Paket Jalan" onclick="showPaket();" class="imgLink" align="absmiddle"><!--{/if}--></div>
<div id="ajax_paket_jalan2" style="position:absolute;display:none;">
<select id="nama_paket_result" multiple size="10" onchange="get_data_paket(<!--{$NO_PROPINSI|default:0}-->,<!--{$NO_KABUPATEN|default:0}-->,this.value,'<!--{$NO_JENIS_JALAN|default:0}-->');showPaket();">";
<!--{section name=x loop=$DATA_PAKET_JALAN}-->
<!--{if $DATA_PAKET_JALAN[x].id_fjl_06_detail == $NOMOR_PAKET_DETAIL}-->
<option value="<!--{$DATA_PAKET_JALAN[x].id_fjl_06_detail}-->" selected > <!--{$DATA_PAKET_JALAN[x].nama_paket}--></option>
<!--{else}-->
<option value="<!--{$DATA_PAKET_JALAN[x].id_fjl_06_detail}-->"  > <!--{$DATA_PAKET_JALAN[x].nama_paket}--></option>
<!--{/if}-->
<!--{/section}-->								
</SELECT>
</div>
</td>
</tr>		

<!-- Tambahan 24-06-2010 -->
<tr>
<td colspan="2">Kategori Jalan</td>
<td>
<div id="ajax_hidden_jns_jln"><INPUT TYPE="hidden" name="txt_hidden_jns_jln" value="<!--{$ID_HIDDEN_JSN_JLN}-->"></div>
<div id="ajax_jns_jln"><input name="txt_jns_jln" type="text" value="<!--{$PID_JENIS_JLN2}-->" size="35" maxlength="200"></div>
</td></tr>
<!-- End 0f Tambahan 24-06-2010 -->

<tr>
<td colspan="2">Triwulan</td>
<td><div id="ajax_triwulan"><input type="text" name="triwulan" value="<!--{$TRIWULAN}-->"></div></td>
</tr>
<tr>
<td colspan="2">Status Progres </td>
<td><div id="ajax_status_progres">
<!--<input type="text" name="status_progres" maxlength="50" value="<!--{$STATUS_PROGRESS}-->">-->
</div>
 <SELECT name="status_progres">
<option value="">[Pilih Status Progres]</option>
<!--{foreach from=$DAFTAR_STATUS_PROGRES item=foo key=k}-->
 <!--{if $DATA_STATUS_PROGRES==$k}--> 
	<option value="<!--{$k}-->" selected ><!--{$foo}--></option>
 <!--{else}-->
	<option value="<!--{$k}-->"><!--{$foo}--></option>
 <!--{/if}-->
 <!--{/foreach}-->
</SELECT>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">LHR (Lintas Harian Rata-rata) </td>
<td><input type="text" name="lhr" value="<!--{$LHR}-->"></td>
</tr>
<tr>
  <td colspan="2">Pekerjaan Jalan </td>
  <td>&nbsp;</td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Perkerasan</td>
<td>
<SELECT NAME="jalan_perkerasan">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_PERKERASAN=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_PERKERASAN=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_PERKERASAN=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_PERKERASAN=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT>
</td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Bahu</td>
<td><SELECT NAME="jalan_bahu">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_BAHU=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_BAHU=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_BAHU=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_BAHU=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Drainase</td>
<td><SELECT NAME="jalan_drainase">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_DRAINASE=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_DRAINASE=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_DRAINASE=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_DRAINASE=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Trotoar</td>
<td><SELECT NAME="jalan_trotoar">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_TROTOAR=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_TROTOAR=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_TROTOAR=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_TROTOAR=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Pagar Pengaman </td>
<td><SELECT NAME="jalan_pengaman">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_PENGAMAN=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_PENGAMAN=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_PENGAMAN=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_PENGAMAN=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Talud</td>
<td><SELECT NAME="jalan_talud">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_TALUD=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_TALUD=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_TALUD=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_TALUD=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Lainnya</td>
<td><SELECT NAME="jalan_lain">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JALAN_LAIN=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JALAN_LAIN=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JALAN_LAIN=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JALAN_LAIN=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<!-- Disabled on 07-09-2010
<tr>
  <td colspan="2">Pekerjaan Jembatan </td>
  <td>&nbsp;</td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Beton</td>
<td><SELECT NAME="jembatan_beton">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JEMBATAN_BETON=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JEMBATAN_BETON=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JEMBATAN_BETON=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JEMBATAN_BETON=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Kayu/Baja</td>
<td><SELECT NAME="jembatan_kayu">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JEMBATAN_KAYU=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JEMBATAN_KAYU=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JEMBATAN_KAYU=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JEMBATAN_KAYU=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Oprit</td>
<td><SELECT NAME="jembatan_oprit">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JEMBATAN_OPRIT=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JEMBATAN_OPRIT=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JEMBATAN_OPRIT=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JEMBATAN_OPRIT=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Pengecatan</td>
<td><SELECT NAME="jembatan_pengecatan">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JEMBATAN_PENGECATAN=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JEMBATAN_PENGECATAN=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JEMBATAN_PENGECATAN=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JEMBATAN_PENGECATAN=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
<tr>
<td><div align="right">&raquo;</div></td>
<td>Lainnya</td>
<td><SELECT NAME="jembatan_lainnya">
<OPTION VALUE="">[Pilih Kualitas]</OPTION>
<OPTION VALUE="Baik" <!--{if $JEMBATAN_LAINNYA=="Baik"}-->selected<!--{/if}-->>Baik</OPTION>
<OPTION VALUE="Sedang" <!--{if $JEMBATAN_LAINNYA=="Sedang"}-->selected<!--{/if}-->>Sedang</OPTION>
<OPTION VALUE="Buruk" <!--{if $JEMBATAN_LAINNYA=="Buruk"}-->selected<!--{/if}-->>Buruk</OPTION>
<OPTION VALUE="Sangat Buruk" <!--{if $JEMBATAN_LAINNYA=="Sangat Buruk"}-->selected<!--{/if}-->>Sangat Buruk</OPTION>
</SELECT></td>
</tr>
-->
<tr valign="top">
<td colspan="2">Keterangan</td>
<td><textarea name="keterangan" cols="35" rows="4" wrap="virtual" maxlength="65535"><!--{$KETERANGAN}--></textarea></td>
</tr>


				<TR>
					<TD COLSPAN="2"></TD><TD>
					<INPUT TYPE="hidden" name="xid_jl_08_main" value="<!--{$ID_JL_08_MAIN}-->">
					<INPUT TYPE="hidden" name="xid_form_jl_08_detail" value="<!--{$ID_FORM_JL_08_DETAIL}-->">		
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
				</SELECT></TD>
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
				<TD>Tahun Anggaran</TD>
				<TD>
				<!--{html_select_date prefix="Search_" display_days=false display_months=false start_year="2000" end_year="+10"}-->						
				</TD>
			</TR>
			<TR><TD COLSPAN="2" height="4"></TD>
			</TR>
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
									<tr><td width="100">Propinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
									<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
									<tr><td>Tahun Anggaran</td><td> : </td><td><!--{$SEARCH_YEAR}--></td></tr>
									</table>
									</TD>
								</TR>								
								<TR>
									<TD><TABLE  WIDTH="100%">										
										<TR>
											<th class="tdatahead"><!--{$TB_NO}--></TH>
											<th class="tdatahead"><!--{$TB_NAMA_PAKET}--></TH>
											<th class="tdatahead"><!--{$TB_LHR}--></TH>											
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										<!--{section name=x loop=$DATA_TB}-->
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_paket}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].lhr}--> </TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_fjl_08_main=<!--{$DATA_TB[x].id_fjl_08_main}-->&id_fjl_08_detail=<!--{$DATA_TB[x].id_fjl_08_detail}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_fjl_08_main=<!--{$DATA_TB[x].id_fjl_08_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<td class="tdatacontent" COLSPAN="5" align="center">Sorry, your query has not been successful, please try again</TD>
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
</BODY>
</HTML>