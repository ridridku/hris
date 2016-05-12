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
					
<td width="175">Tanggal</td>
<td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->
<!--{$smarty.now|date_format:"%Y-%m-%d"}-->
<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List"></td>
</tr>
<tr>
<td>Nama Propinsi </td>
<td>
					<SELECT name="no_propinsi" onChange="resetData(frmCreate);cari_kabupaten(this.value);showUsulan();">
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
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Kode Proyek </td>
<td>
<div id="ajax_kode_proyek"><input type="text" name="kode_proyek" maxlength="50" value="<!--{$KODE_PROYEK}-->"> <!--{if $TOTAL_USULAN_RENCANA>0}--><img src="<!--{$HREF_IMG_PATH}-->/icon/table.gif" border="0" title="Tampilkan Data Usulan Rencana" onclick="showUsulan();" class="imgLink" align="absmiddle"><!--{/if}--></div>
<div id="ajax_usulan" style="display:none;">
<select id="no_usulan_results" multiple size="10" onclick="frmCreate.kode_proyek.value=this.value; get_data_usulan(<!--{$NO_PROPINSI|default:0}-->,frmCreate.kode_proyek.value);showUsulan();">";
<!--{section name=x loop=$USULAN_RENCANA}-->
<!--{if $USULAN_RENCANA[x].kode_proyek == $KODE_PROYEK}-->
<option value="<!--{$USULAN_RENCANA[x].kode_proyek}-->" selected > <!--{$USULAN_RENCANA[x].kode_proyek}--> - <!--{$USULAN_RENCANA[x].nama_proyek}--></option>
<!--{else}-->
<option value="<!--{$USULAN_RENCANA[x].kode_proyek}-->"  > <!--{$USULAN_RENCANA[x].kode_proyek}--> - <!--{$USULAN_RENCANA[x].nama_proyek}--></option>
<!--{/if}-->
<!--{/section}-->								
</SELECT>&nbsp;&nbsp;<font color="red">[Klik <b>2x</b> untuk memilih item]</font>
</div>
</td>
</tr>
<tr>
<td>Nama Proyek </td>
<td><div id="ajax_nama_proyek"><input name="nama_proyek" type="text" value="<!--{$NAMA_PROYEK}-->" size="35" maxlength="200"></div></td>
</tr>
<tr>
<td>No Ruas Jalan </td>
<td><div id="ajax_no_ruas"><input type="text" name="no_ruas" maxlength="50" value="<!--{$NO_RUAS}-->"></div></td>
</tr>
<tr>
<td>Nama Ruas Jalan </td>
<td><div id="ajax_nama_ruas"><input name="nama_ruas" type="text" value="<!--{$NAMA_RUAS}-->" size="35" maxlength="200"></div></td>
</tr>
<tr>
<td>Panjang Total Jalan (Km) </td>
<td><div id="ajax_panjang_jalan"><input type="text" name="panjang_jalan" value="<!--{$PANJANG_JALAN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Sasaran/Fungsi</td>
<td>
<div id="ajax_sasaran">
<SELECT name="sasaran">
<OPTION VALUE="">[Pilih Sasaran/Fungsi]</OPTION>
<!--{section name=x loop=$DATA_SASARAN}-->
<!--{if trim($DATA_SASARAN[x].id_prop_sasaran_fungsi) == trim($SASARAN)}-->
<option value="<!--{$DATA_SASARAN[x].id_prop_sasaran_fungsi}-->" selected > <!--{$DATA_SASARAN[x].nama_prop_sasaran_fungsi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_SASARAN[x].id_prop_sasaran_fungsi}-->"  > <!--{$DATA_SASARAN[x].nama_prop_sasaran_fungsi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT>
</div>
</td>
</tr>
<tr><td valign="top">Lokasi Kegiatan (Kabupaten) </td><td>
<div id="ajax_kabupaten">
<!--{if $NO_PROPINSI==''}--><input type="text" size="35" style="text-align:center" name="nama_kabupaten" value="[Pilih Data Propinsi]" readonly><!--{/if}-->
<table class="text-regular" cellspacing="0" cellpadding="0" width="400">
<!--{section name=x loop=$DATA_KABUPATEN}-->
<!--{if $smarty.section.x.index%2==0}-->
<tr>
<!--{/if}-->
<td width="15"><input type="checkbox" class="checkbox" name="kabupaten<!--{$smarty.section.x.index}-->" value="<!--{$DATA_KABUPATEN[x].nama_kabupaten}-->" 
<!--{foreach from=$KABUPATEN_KEGIATAN item=curr_id}-->
<!--{if trim(strtolower($DATA_KABUPATEN[x].nama_kabupaten))==trim(strtolower($curr_id))}--> checked <!--{/if}-->
<!--{/foreach}-->
 readonly>
</td>
<td><!--{$DATA_KABUPATEN[x].nama_kabupaten}--></td>
<!--{if $smarty.section.x.index%2==1}-->
</tr>
<!--{/if}-->

<!--{/section}-->	
</table>
<input type="hidden" name="jml_kabupaten" value="<!--{$JML_KABUPATEN}-->">
</div></td></tr>
<tr>
<td>Panjang Proyek Jalan (Km) </td>
<td><div id="ajax_panjang_proyek"><input type="text" name="panjang_proyek" value="<!--{$PANJANG_PROYEK}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Status Awal Jalan </td>
<td><div id="ajax_status_awal_jalan"><input name="status_awal_jalan" type="text" value="<!--{$STATUS_AWAL_JALAN}-->" size="35" maxlength="150" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Status Akhir Jalan </td>
<td><div id="ajax_status_akhir_jalan"><input name="status_akhir_jalan" type="text" value="<!--{$STATUS_AKHIR_JALAN}-->" size="35" maxlength="150" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Jenis Penanganan Jalan </td>
<td>
<div id="ajax_jenis_penanganan"><SELECT name="jenis_penanganan">
<OPTION VALUE="">[Pilih Jenis Penanganan Jalan]</OPTION>
<!--{section name=x loop=$DATA_JENIS_PENANGANAN}-->
<!--{if trim($DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan) == trim($JENIS_PENANGANAN)}-->
<option value="<!--{$DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan}-->" selected > <!--{$DATA_JENIS_PENANGANAN[x].nama_prop_jenis_penanganan}--> </option>
<!--{else}-->
<option value="<!--{$DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan}-->"  > <!--{$DATA_JENIS_PENANGANAN[x].nama_prop_jenis_penanganan}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></div></td>
</tr>
<tr>
<td>Tipe PKRSN Jalan (m) </td>
<td>
<div id="ajax_tipe_pkrsn"><SELECT name="tipe_pkrsn">
<OPTION VALUE="">[Pilih Tipe PKRSN Jalan]</OPTION>
<!--{section name=x loop=$DATA_PKRSN_JALAN}-->
<!--{if trim($DATA_PKRSN_JALAN[x].id_prop_tipe_pkrsn) == trim($TIPE_PKRSN)}-->
<option value="<!--{$DATA_PKRSN_JALAN[x].id_prop_tipe_pkrsn}-->" selected > <!--{$DATA_PKRSN_JALAN[x].nama_prop_tipe_pkrsn}--> </option>
<!--{else}-->
<option value="<!--{$DATA_PKRSN_JALAN[x].id_prop_tipe_pkrsn}-->"  > <!--{$DATA_PKRSN_JALAN[x].nama_prop_tipe_pkrsn}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></div></td>
</tr>
<tr>
<td>Lebar PKRSN (m) </td>
<td><div id="ajax_lebar_pkrsn"><input type="text" name="lebar_pkrsn" value="<!--{$LEBAR_PKRSN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Biaya Jalan (Rp) </td>
<td><div id="ajax_biaya_jalan"><input type="text" name="biaya_jalan" value="<!--{$BIAYA_JALAN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Jumlah Jembatan (bh) </td>
<td><div id="ajax_jumlah_jembatan"><input type="text" name="jumlah_jembatan" value="<!--{$JUMLAH_JEMBATAN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Total Panjang Jembatan (m) </td>
<td><div id="ajax_panjang_jembatan"><input type="text" name="panjang_jembatan" value="<!--{$PANJANG_JEMBATAN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Biaya Jembatan (Rp) </td>
<td><div id="ajax_biaya_jembatan"><input type="text" name="biaya_jembatan" value="<!--{$BIAYA_JEMBATAN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Total Biaya (Rp) </td>
<td><div id="ajax_total_biaya"><input type="text" name="total_biaya" value="<!--{$TOTAL_BIAYA}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>PAD 1 (Rp) </td>
<td><div id="ajax_pad1"><input type="text" name="pad1" value="<!--{$PAD1}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Dana Umum Propinsi (Rp) </td>
<td><div id="ajax_du_prop"><input type="text" name="du_prop" value="<!--{$DU_PROP}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>PJP Propinsi (Rp) </td>
<td><div id="ajax_pjp_prop"><input type="text" name="pjp_prop" value="<!--{$PJP_PROP}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Nomor Loan PHLN </td>
<td>
<div id="ajax_jenis_loan_phln"><SELECT name="jenis_loan_phln">
<OPTION VALUE="">[Pilih Nomor Loan PHLN]</OPTION>
<!--{section name=x loop=$DATA_LOAN_PHLN}-->
<!--{if trim($DATA_LOAN_PHLN[x].id_prop_loan_phln) == trim($JENIS_LOAN_PHLN)}-->
<option value="<!--{$DATA_LOAN_PHLN[x].id_prop_loan_phln}-->" selected > <!--{$DATA_LOAN_PHLN[x].nama_prop_loan_phln}--> </option>
<!--{else}-->
<option value="<!--{$DATA_LOAN_PHLN[x].id_prop_loan_phln}-->"  > <!--{$DATA_LOAN_PHLN[x].nama_prop_loan_phln}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></div></td>
</tr>
<tr>
<td>Jumlah PHLN (Rp) </td>
<td><div id="ajax_jumlah_loan_phln"><input type="text" name="jumlah_loan_phln" value="<!--{$JUMLAH_LOAN_PHLN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Kode Sumber Lainnya </td>
<td>
<div id="ajax_jenis_sumber_dana_lain"><SELECT name="jenis_sumber_dana_lain">
<OPTION VALUE="">[Pilih Sumber Dana Lain]</OPTION>
<!--{section name=x loop=$DATA_SUMBER_DANA_LAIN}-->
<!--{if trim($DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain) == trim($JENIS_SUMBER_DANA_LAIN)}-->
<option value="<!--{$DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain}-->" selected > <!--{$DATA_SUMBER_DANA_LAIN[x].nama_prop_sumber_dana_lain}--> </option>
<!--{else}-->
<option value="<!--{$DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain}-->"  > <!--{$DATA_SUMBER_DANA_LAIN[x].nama_prop_sumber_dana_lain}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></div></td>
</tr>
<tr>
<td>Jumlah Sumber Lainnya </td>
<td><div id="ajax_jumlah_sumber_dana_lain"><input type="text" name="jumlah_sumber_dana_lain" value="<!--{$JUMLAH_SUMBER_DANA_LAIN}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>UR 1 JP Konsistensi dengan Perencanaan </td>
<td><input name="ur_01_jp_konsistensi" type="text" value="<!--{$UR_01_JP_KONSISTENSI}-->" size="35" maxlength="150"></td>
</tr>
<tr>
<td>Biaya/Km Konsistensi dengan Perencanaan (Rp) </td>
<td><div id="ajax_biaya_per_km_konsistensi"><input type="text" name="biaya_per_km_konsistensi" value="<!--{$BIAYA_PER_KM_KONSISTENSI}-->" OnKeyUp="validateNum(this)"></div></td>
</tr>
<tr>
<td>Kode Kelayakan Konsistensi dengan Perencanaan </td>
<td>
<div id="ajax_kelayakan_konsistensi">
<SELECT name="kelayakan_konsistensi">
<OPTION VALUE="">[Pilih Kelayakan Konsistensi]</OPTION>
<!--{section name=x loop=$DATA_KELAYAKAN_KONSISTENSI}-->
<!--{if trim($DATA_KELAYAKAN_KONSISTENSI[x].id_prop_kelayakan_konsistensi) == trim($KELAYAKAN_KONSISTENSI)}-->
<option value="<!--{$DATA_KELAYAKAN_KONSISTENSI[x].id_prop_kelayakan_konsistensi}-->" selected > <!--{$DATA_KELAYAKAN_KONSISTENSI[x].nama_prop_kelayakan_konsistensi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_KELAYAKAN_KONSISTENSI[x].id_prop_kelayakan_konsistensi}-->"  > <!--{$DATA_KELAYAKAN_KONSISTENSI[x].nama_prop_kelayakan_konsistensi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></div></td>
</tr>
<tr>
<td>Catatan Konsistensi dengan Perencanaan </td>
<td>
<SELECT name="catatan_konsistensi">
<OPTION VALUE="">[Pilih Catatan Konsistensi]</OPTION>
<!--{section name=x loop=$DATA_CATATAN_KONSISTENSI}-->
<!--{if trim($DATA_CATATAN_KONSISTENSI[x].id_prop_catatan_konsistensi) == trim($CATATAN_KONSISTENSI)}-->
<option value="<!--{$DATA_CATATAN_KONSISTENSI[x].id_prop_catatan_konsistensi}-->" selected > <!--{$DATA_CATATAN_KONSISTENSI[x].nama_prop_catatan_konsistensi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_CATATAN_KONSISTENSI[x].id_prop_catatan_konsistensi}-->"  > <!--{$DATA_CATATAN_KONSISTENSI[x].nama_prop_catatan_konsistensi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td>
</tr>
<tr valign="top">
<td>Keterangan</td>
<td><textarea name="keterangan" cols="75" rows="4" wrap="virtual" maxlength="65535"><!--{$KETERANGAN}--></textarea></td>
</tr>
<TR>
<TD></TD>
<TD>
<INPUT TYPE="hidden" name="xid_form_rd_01_jp_main" value="<!--{$ID_FORM_RD_01_JP_MAIN}-->">
<INPUT TYPE="hidden" name="xid_form_rd_01_jp_detail" value="<!--{$ID_FORM_RD_01_JP_DETAIL}-->">
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
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
				<SELECT name="no_propinsi">
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
				<TD>Tahun</TD>
				<TD>
				<!--{html_select_date display_days=false display_months=false start_year="2000" end_year="+10"}-->
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
		<!--{if $NO_PROPINSI<>""}-->	
		<table width="100%"><tr><td>
			<TR>
				<TD COLSPAN="2">
				<table class="tbheader">
				<tr>
					<td width="100">Propinsi </td>
					<td width="10"> : </td>
					<td><!--{$NAMA_PROPINSI}--></td>
				</tr>
				<tr>
					<td width="100">Tahun </td>
					<td width="10"> : </td>
					<td><!--{$TAHUN}--></td>
				</tr>										
									</table>
									</TD>
								</TR>								
								<TR>
									<TD><TABLE  WIDTH="100%">										
										<TR>
											<th class="tdatahead" ><!--{$TB_NO}--></TH>
											<th class="tdatahead"><!--{$TB_KODE_PROYEK}--></TH>
											<th class="tdatahead"><!--{$TB_NAMA_PROYEK}--></TH>
											<th class="tdatahead"><!--{$TB_NO_RUAS}--></TH>
											<th class="tdatahead"><!--{$TB_NAMA_RUAS}--></TH>
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										<!--{section name=x loop=$DATA_TB}-->
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].kode_proyek}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_proyek}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].no_ruas}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_ruas}--> </TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_form_rd_01_jp_main=<!--{$DATA_TB[x].id_form_rd_01_jp_main}-->&id_form_rd_01_jp_detail=<!--{$DATA_TB[x].id_form_rd_01_jp_detail}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_form_rd_01_jp_main=<!--{$DATA_TB[x].id_form_rd_01_jp_main}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
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

	</DIV></BODY></HTML>