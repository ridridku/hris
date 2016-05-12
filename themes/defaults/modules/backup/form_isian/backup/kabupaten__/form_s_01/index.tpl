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
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry3_',1);hideAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/databases.png" align="absmiddle">Export Data</span></a>
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
				<td width="150">Tanggal</td><td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->

<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'dd-mm-yyyy',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
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
<tr><td width="150">Nomor Ruas</td><td colspan="3"><div id="ajax_no_ruas"><input type="text" name="no_ruas" maxlength="25" onBlur="get_data_ruas(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value,this.value)" value="<!--{$NO_RUAS}-->"></td></tr>

<!-- Tambahan 17-06-2010 -->
<tr><td>Kategori Jalan</td><td>
<!-- <div id="ajax_hidden_jns_jln"><INPUT TYPE="hidden" name="txt_hidden_jns_jln" value="<!--{$ID_HIDDEN_JSN_JLN}-->"></div> -->
<div id="ajax_hidden_jns_jln"><INPUT TYPE="hidden" name="txt_hidden_jns_jln" value="<!--{$ID_HIDDEN_JSN_JLN}-->"></div>
<div id="ajax_jns_jln"><input name="txt_jns_jln" type="text" value="<!--{$PID_JENIS_JLN2}-->" size="35" maxlength="200" readonly></div>
</td>
<!-- End 0f Tambahan 17-06-2010 -->

<td>Disurvai Oleh</td><td><input type="text" name="disurvai" value="<!--{$DISURVAI}-->" size="35"></td></tr>
<tr><td>Nama Pangkal Ruas</td><td><div id="ajax_nama_pangkal_ruas"><input name="nama_pangkal_ruas" type="text" value="<!--{$NAMA_PANGKAL_RUAS}-->" size="35" maxlength="200" readonly></td>
<td>Tipe Kendaraan</td><td><input type="text" name="tipe_kendaraan" value="<!--{$TIPE_KENDARAAN}-->" size="35"></td></tr>
<tr><td>Nama Ujung Ruas</td><td><div id="ajax_nama_ujung_ruas"><input name="nama_ujung_ruas" type="text" value="<!--{$NAMA_UJUNG_RUAS}-->" size="35" maxlength="200" readonly></td>
<td>Fakt. Penyesuaian Odometer</td><td><input type="text" name="fakt_penyesuaian_odometer" value="<!--{$FAKT_PENYESUAIAN_ODOMETER}-->"></td></tr>
<tr><td>Titik Pengenal Pangkal</td><td><div id="ajax_titik_pangkal"><input name="titik_pengenal_pangkal" type="text" value="<!--{$TITIK_PENGENAL_PANGKAL}-->" size="35" maxlength="200" readonly></td>
<td>KM Odometer</td><td><input type="text" name="km_odometer" value="<!--{$KM_ODOMETER}-->"></td></tr>
<tr><td>Titik Pengenal Ujung</td><td><div id="ajax_titik_ujung"><input name="titik_pengenal_ujung" type="text" value="<!--{$TITIK_PENGENAL_UJUNG}-->" size="35" maxlength="200" readonly></td>
<td>KM YSD</td><td><input type="text" name="km_ysd" value="<!--{$KM_YSD}-->"></td></tr>
</table>

<div id="title-box2">Data Detail Survai Kondisi Jalan</div>
<div id="add_item_data">
<a class="button" href="#" title="Add Baris Data" onclick="this.blur();addRowToTable();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">+</span></a>
<a class="button" href="#" title="Hapus Baris Data Terakhir" onclick="this.blur();removeRowFromTable();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">-</span></a>

</div>
<table style="margin-top:-25;" width="1130" border="0">
<thead>
<tr>
<th rowspan="2" class="tdatahead" width="280">Angka KM Odo</th>
<th rowspan="2" class="tdatahead" width="120">KM YSD</th>
<th colspan="3" class="tdatahead">Permukaan Jalan</th>
<th rowspan="2" class="tdatahead" width="110">Drainase</th>
<th class="tdatahead" width="130">Lubang (B)</th>
<th class="tdatahead" width="130">Lenggok (C)</th>
<th class="tdatahead" width="130">Retak (D)</th>
<th class="tdatahead" width="130">Alur (E)</th>
<th class="tdatahead" width="130">Bahu (L)</th>
<th class="tdatahead" width="130">Kmrg (K)</th>
<th rowspan="2" class="tdatahead" width="130">Penilaian</th>
</tr>
<tr>
<th class="tdatahead" width="440">Tipe</th>
<th class="tdatahead" width="180">Kondisi (A)</th>
<th class="tdatahead" width="135">Lebar (m)</th>
<th class="tdatahead">Lubang (F)</th>
<th class="tdatahead">Lembek (G)</th>
<th class="tdatahead">Erosi (H)</th>
<th class="tdatahead">Alur (I)</th>
<th class="tdatahead">Gelombang (J)</th>
<th class="tdatahead">Kmrg (K)</th>
</tr>
</thead>
</table>
<table id="tblItem">
<!--{if $EDIT_VAL==1}-->
<!--{section name=x loop=$DATA_DETAIL}-->
<tr>
<td><DIV ID="ajax_km_odometer_<!--{$smarty.section.x.index}-->"> <input type="text" name="km_odometer_<!--{$smarty.section.x.index}-->" id="km_odometer_<!--{$smarty.section.x.index}-->" size="20" value="<!--{$DATA_DETAIL[x].km_odometer}-->"></DIV></td>

<td><DIV ID="ajax_km_ysd_<!--{$smarty.section.x.index}-->"> <input type="text" ID="km_ysd_<!--{$smarty.section.x.index}-->"  name="km_ysd_<!--{$smarty.section.x.index}-->" size="8" value="<!--{$DATA_DETAIL[x].km_ysd}-->"> </DIV></td>
	
<td><DIV ID="ajax_tipe_<!--{$smarty.section.x.index}-->"> 
<select ID="tipe_permukaan_jalan_<!--{$smarty.section.x.index}-->"  name="tipe_permukaan_jalan_<!--{$smarty.section.x.index}-->">
<!--{section name=b loop=$DATA_TIPE_RUAS}-->
<option value="<!--{$DATA_TIPE_RUAS[b].kode_tipe_jalan}-->" <!--{if $DATA_DETAIL[x].tipe_permukaan_jalan==$DATA_TIPE_RUAS[b].kode_tipe_jalan}--> selected<!--{/if}-->><!--{$DATA_TIPE_RUAS[b].nama_tipe_jalan}--></option>
<!--{/section}-->
</select></DIV></td>

<td><DIV ID="ajax_kondisi_<!--{$smarty.section.x.index}-->"> 
<select ID="kondisi_permukaan_jalan_<!--{$smarty.section.x.index}-->"  name="kondisi_permukaan_jalan_<!--{$smarty.section.x.index}-->">
<!--{section name=c loop=$DATA_KONDISI_RUAS}-->
<option value="<!--{$DATA_KONDISI_RUAS[c].kode_kondisi_jalan}-->" <!--{if $DATA_DETAIL[x].kondisi_permukaan_jalan==$DATA_KONDISI_RUAS[c].kode_kondisi_jalan}--> selected<!--{/if}-->><!--{$DATA_KONDISI_RUAS[c].nama_kondisi_jalan}--></option>
<!--{/section}-->
</select> </DIV></td>

<td><DIV ID="ajax_lebar_<!--{$smarty.section.x.index}-->"> <input type="text" ID="lebar_permukaan_jalan_<!--{$smarty.section.x.index}-->"  name="lebar_permukaan_jalan_<!--{$smarty.section.x.index}-->" size="9" value="<!--{$DATA_DETAIL[x].lebar_permukaan_jalan}-->"> </DIV></td>

<td><DIV ID="ajax_drainase_<!--{$smarty.section.x.index}-->"> <input type="text" ID="drainase_<!--{$smarty.section.x.index}-->"  name="drainase_<!--{$smarty.section.x.index}-->" size="12" value="<!--{$DATA_DETAIL[x].drainase}-->"> </DIV></td>

<td><DIV ID="ajax_kolom1_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom1_<!--{$smarty.section.x.index}-->"  name="kolom1_<!--{$smarty.section.x.index}-->" size="10" value="<!--{$DATA_DETAIL[x].kolom1}-->"> </DIV></td>

<td><DIV ID="ajax_kolom2_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom2_<!--{$smarty.section.x.index}-->"  name="kolom2_<!--{$smarty.section.x.index}-->" size="12" value="<!--{$DATA_DETAIL[x].kolom2}-->"> </DIV></td>

<td><DIV ID="ajax_kolom3_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom3_<!--{$smarty.section.x.index}-->"  name="kolom3_<!--{$smarty.section.x.index}-->" size="10" value="<!--{$DATA_DETAIL[x].kolom3}-->"> </DIV></td>

<td><DIV ID="ajax_kolom4_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom4_<!--{$smarty.section.x.index}-->"  name="kolom4_<!--{$smarty.section.x.index}-->" size="10" value="<!--{$DATA_DETAIL[x].kolom4}-->"> </DIV></td>

<td><DIV ID="ajax_kolom5_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom5_<!--{$smarty.section.x.index}-->"  name="kolom5_<!--{$smarty.section.x.index}-->" size="13" value="<!--{$DATA_DETAIL[x].kolom5}-->"> </DIV></td>

<td><DIV ID="ajax_kolom6_<!--{$smarty.section.x.index}-->"> <input type="text" ID="kolom6_<!--{$smarty.section.x.index}-->"  name="kolom6_<!--{$smarty.section.x.index}-->" size="10" value="<!--{$DATA_DETAIL[x].kolom6}-->"> </DIV></td>

<td><DIV ID="ajax_penilaian_<!--{$smarty.section.x.index}-->"> <input type="text" ID="penilaian_<!--{$smarty.section.x.index}-->"  name="penilaian_<!--{$smarty.section.x.index}-->" size="12" value="<!--{$DATA_DETAIL[x].penilaian}-->" > </DIV></td>

<!--{/section}-->
<!--{/if}-->
</table>
<table>
<tr><td width="165"></td><td width="150">
<input type="hidden" name="jum_rows" id="jum_rows" value="<!--{$JUM}-->">
<INPUT TYPE="hidden" name="xid_s_01_main" value="<!--{$ID_S_01_MAIN}-->">	
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
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
											<th class="tdatahead"><!--{$TB_NO}--></TH>
											<th class="tdatahead"><!--{$TB_NO_RUAS}--></TH>
											<th class="tdatahead"><!--{$TB_NAMA_RUAS}--></TH>
											<th class="tdatahead"><!--{$TB_TITIK_PENGENAL_PANGKAL}--></TH>
											<th class="tdatahead"><!--{$TB_TITIK_PENGENAL_UJUNG}--></TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										</thead>
										<tbody>
										<!--{section name=x loop=$DATA_TB}-->
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].no_ruas}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_ruas_pangkal}--> - <!--{$DATA_TB[x].nama_ruas_ujung}--></TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].titik_pengenal_pangkal}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].titik_pengenal_ujung}--> </TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_fs_01_main=<!--{$DATA_TB[x].id_fs_01_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&jns_jln2=<!--{$DATA_TB[x].id_jns_jln}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_fs_01_main=<!--{$DATA_TB[x].id_fs_01_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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