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
				<TR valign="top">
					
<td width="210">Tanggal</td>
<td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->
<!--{$smarty.now|date_format:"%Y-%m-%d"}-->
<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List"></td>
</tr>
<tr valign="top">
<td>Nama Propinsi </td>
<td>
					<SELECT name="no_propinsi" onChange="cari_kabupaten(this.value)">
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
<tr valign="top">
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr valign="top">
<td>Kode Proyek </td>
<td>
<div id="ajax_kode_proyek">
<SELECT name="kode_proyek" onChange="cari_proyek();">
<OPTION VALUE="">[Pilih Kode Proyek]</OPTION>
<!--{section name=x loop=$DATA_RFK}-->
<!--{if trim($DATA_RFK[x].kode_proyek) == trim($KODE_PROYEK)}-->
<option value="<!--{$DATA_RFK[x].kode_proyek}-->" selected > <!--{$DATA_RFK[x].kode_proyek}--> </option>
<!--{else}-->
<option value="<!--{$DATA_RFK[x].kode_proyek}-->"  > <!--{$DATA_RFK[x].kode_proyek}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT>
</div>
</td>
</tr>
<tr valign="top">
<td>Jenis Penanganan </td>
<td><SELECT name="jenis_penanganan">
<OPTION VALUE="">[Pilih Jenis Penanganan Jalan]</OPTION>
<!--{section name=x loop=$DATA_JENIS_PENANGANAN}-->
<!--{if trim($DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan) == trim($JENIS_PENANGANAN)}-->
<option value="<!--{$DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan}-->" selected > <!--{$DATA_JENIS_PENANGANAN[x].nama_prop_jenis_penanganan}--> </option>
<!--{else}-->
<option value="<!--{$DATA_JENIS_PENANGANAN[x].id_prop_jenis_penanganan}-->"  > <!--{$DATA_JENIS_PENANGANAN[x].nama_prop_jenis_penanganan}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td>
</tr>
<tr valign="top">
<td>Jumlah Proyek/Paket </td>
<td><input type="text" name="jumlah_proyek" value="<!--{$JUMLAH_PROYEK}-->"></td>
</tr>
<tr valign="top">
<td>Total Fisik Jalan </td>
<td><input type="text" name="total_fisik_jalan" value="<!--{$TOTAL_FISIK_JALAN}-->"></td>
</tr>
<tr valign="top">
<td>Total Fisik Jembatan </td>
<td><input type="text" name="total_fisik_jembatan" value="<!--{$TOTAL_FISIK_JEMBATAN}-->"></td>
</tr>
<tr valign="top">
<td>Total Biaya </td>
<td><input type="text" name="total_biaya" value="<!--{$TOTAL_BIAYA}-->"></td>
</tr>
<tr valign="top">
<td>Biaya PAD1 </td>
<td><input type="text" name="biaya_pad1" value="<!--{$BIAYA_PAD1}-->"></td>
</tr>
<tr valign="top">
<td>Persen Fisik Realisasi Bulan Ini PAD1 (%) </td>
<td><input type="text" name="persen_fisik_pad1_bulan_ini" value="<!--{$PERSEN_FISIK_PAD1_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Fisik Realisasi Bulan Ini PAD1 (%) </td>
<td><input type="text" name="nilai_fisik_pad1_bulan_ini" value="<!--{$NILAI_FISIK_PAD1_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Persen Keuangan Realisasi Bulan Ini PAD1 (%) </td>
<td><input type="text" name="persen_keuangan_pad1_bulan_ini" value="<!--{$PERSEN_KEUANGAN_PAD1_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Keuangan Realisasi Bulan Ini PAD1 (Rp) </td>
<td><input type="text" name="nilai_keuangan_pad1_bulan_ini" value="<!--{$NILAI_KEUANGAN_PAD1_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Biaya Dana Umum DPP (Rp) </td>
<td><input type="text" name="biaya_du_dpp" value="<!--{$BIAYA_DU_DPP}-->"></td>
</tr>
<tr valign="top">
<td>Persen Fisik Realisasi Bulan Ini Dana Umum DPP (%) </td>
<td><input type="text" name="persen_fisik_du_dpp_bulan_ini" value="<!--{$PERSEN_FISIK_DU_DPP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Fisik Realisasi Bulan Ini Dana Umum DPP (Rp) </td>
<td><input type="text" name="nilai_fisik_du_dpp_bulan_ini" value="<!--{$NILAI_FISIK_DU_DPP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Persen Keuangan Realisasi Bulan Ini Dana Umum DPP (%) </td>
<td><input type="text" name="persen_keuangan_du_dpp_bulan_ini" value="<!--{$PERSEN_KEUANGAN_DU_DPP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Keuangan Realisasi Bulan Ini Dana Umum DPP (Rp) </td>
<td><input type="text" name="nilai_keuangan_du_dpp_bulan_ini" value="<!--{$NILAI_KEUANGAN_DU_DPP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Biaya PJP (Rp) </td>
<td><input type="text" name="biaya_pjp" value="<!--{$BIAYA_PJP}-->"></td>
</tr>
<tr valign="top">
<td>Persen Fisik Realisasi Bulan Ini PJP (%) </td>
<td><input type="text" name="persen_fisik_pjp_bulan_ini" value="<!--{$PERSEN_FISIK_PJP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Fisik Realisasi Bulan Ini PJP (Rp) </td>
<td><input type="text" name="nilai_fisik_pjp_bulan_ini" value="<!--{$NILAI_FISIK_PJP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Persen Keuangan Realisasi Bulan Ini PJP (%) </td>
<td><input type="text" name="persen_keuangan_pjp_bulan_ini" value="<!--{$PERSEN_KEUANGAN_PJP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Keuangan Realisasi Bulan Ini PJP (Rp) </td>
<td><input type="text" name="nilai_keuangan_pjp_bulan_ini" value="<!--{$NILAI_KEUANGAN_PJP_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nomor Loan PHLN </td>
<td>
<SELECT name="jenis_loan_phln">
<OPTION VALUE="">[Pilih Nomor Loan PHLN]</OPTION>
<!--{section name=x loop=$DATA_LOAN_PHLN}-->
<!--{if trim($DATA_LOAN_PHLN[x].id_prop_loan_phln) == trim($JENIS_LOAN_PHLN)}-->
<option value="<!--{$DATA_LOAN_PHLN[x].id_prop_loan_phln}-->" selected > <!--{$DATA_LOAN_PHLN[x].nama_prop_loan_phln}--> </option>
<!--{else}-->
<option value="<!--{$DATA_LOAN_PHLN[x].id_prop_loan_phln}-->"  > <!--{$DATA_LOAN_PHLN[x].nama_prop_loan_phln}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td>
</tr>
<tr valign="top">
<td>Biaya Loan PHLN (Rp) </td>
<td><input type="text" name="biaya_loan_phln" value="<!--{$BIAYA_LOAN_PHLN}-->"></td>
</tr>
<tr valign="top">
<td>Persen Fisik Realisasi Bulan Ini Loan PHLN (%) </td>
<td><input type="text" name="persen_fisik_loan_phln_bulan_ini" value="<!--{$PERSEN_FISIK_LOAN_PHLN_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Fisik Realisasi Bulan Ini Loan PHLN (Rp) </td>
<td><input type="text" name="nilai_fisik_loan_phln_bulan_ini" value="<!--{$NILAI_FISIK_LOAN_PHLN_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Persen Keuangan Bulan Ini Loan PHLN (%) </td>
<td><input type="text" name="persen_keuangan_loan_phln_bulan_ini" value="<!--{$PERSEN_KEUANGAN_LOAN_PHLN_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Keuangan Bulan Ini Loan PHLN (Rp) </td>
<td><input type="text" name="nilai_keuangan_loan_phln_bulan_ini" value="<!--{$NILAI_KEUANGAN_LOAN_PHLN_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Kode Sumber Dana Lainnya </td>
<td>
<SELECT name="jenis_sumber_dana_lain">
<OPTION VALUE="">[Pilih Sumber Dana Lain]</OPTION>
<!--{section name=x loop=$DATA_SUMBER_DANA_LAIN}-->
<!--{if trim($DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain) == trim($JENIS_SUMBER_DANA_LAIN)}-->
<option value="<!--{$DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain}-->" selected > <!--{$DATA_SUMBER_DANA_LAIN[x].nama_prop_sumber_dana_lain}--> </option>
<!--{else}-->
<option value="<!--{$DATA_SUMBER_DANA_LAIN[x].id_prop_sumber_dana_lain}-->"  > <!--{$DATA_SUMBER_DANA_LAIN[x].nama_prop_sumber_dana_lain}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td>
</tr>
<tr valign="top">
<td>Biaya Sumber Dana Lainnya </td>
<td><input type="text" name="biaya_sumber_dana_lain" value="<!--{$BIAYA_SUMBER_DANA_LAIN}-->"></td>
</tr> 
<tr valign="top">
<td>Persen Fisik Realisasi Bulan Ini Sumber Dana Lainnya (%) </td>
<td><input type="text" name="persen_fisik_sumber_dana_bulan_ini" value="<!--{$PERSEN_FISIK_SUMBER_DANA_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Fisik Realisasi Bulan Ini Sumber Dana Lainnya (Rp) </td>
<td><input type="text" name="nilai_fisik_sumber_dana_bulan_ini" value="<!--{$NILAI_FISIK_SUMBER_DANA_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Persen Keuangan Realisasi Bulan Ini Sumber Dana Lainnya (%) </td>
<td><input type="text" name="persen_keuangan_sumber_dana_bulan_ini" value="<!--{$PERSEN_KEUANGAN_SUMBER_DANA_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Nilai Keuangan Realisasi Bulan Ini Sumber Dana Lainnya </td>
<td><input type="text" name="nilai_keuangan_sumber_dana_bulan_ini" value="<!--{$NILAI_KEUANGAN_SUMBER_DANA_BULAN_INI}-->"></td>
</tr>
<tr valign="top">
<td>Keterangan</td>
<td><textarea name="keterangan" cols="35" rows="4" wrap="virtual" maxlength="65535"><!--{$KETERANGAN}--></textarea></td>
</tr>
<TR><TD></TD><TD><INPUT TYPE="hidden" name="xid_form_rfk_02_jp_main" value="<!--{$ID_FORM_RFK_02_JP_MAIN}-->">
					<INPUT TYPE="hidden" name="xid_form_rfk_02_jp_detail" value="<!--{$ID_FORM_RFK_02_JP_DETAIL}-->">		
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
				<TD><SELECT name="no_propinsi">
					<OPTION VALUE="">[Pilih Propinsi]</OPTION>
					<!--{section name=x loop=$DATA_PROPINSI}--><!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
					<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
					<!--{else}-->
					<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
					<!--{/if}--><!--{/section}--></SELECT>	
				</TD></TR>
				<TR>
				<TD>Tahun</TD>
				<TD>
				<!--{html_select_date display_days=false display_months=false start_year="2000" end_year="+10"}-->
				</TD>
			</TR>
			<TR>
				<TD COLSPAN="2" height="4"></TD></TR>
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
						<td width="100">Propinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
					<tr>
						<td width="100">Tahun </td><td width="10"> : </td><td><!--{$TAHUN}--></td></tr></table></TD></TR><TR><TD>
						<TABLE  WIDTH="100%">
							<TR>
								<th class="tdatahead"><!--{$TB_NO}--></TH>
								<th class="tdatahead"><!--{$TB_KODE_PROYEK}--></TH>
								<th class="tdatahead"><!--{$TB_JENIS_PENANGANAN}--></TH>
								<th class="tdatahead"><!--{$TB_JUMLAH_PROYEK}--></TH>
								<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH></TR>
							<!--{section name=x loop=$DATA_TB}-->
							<tr class='<!--{cycle values="alt,alt3"}-->'>
								<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
								<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].kode_proyek}--> </TD>
								<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_prop_jenis_penanganan}--> </TD>
								<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].jumlah_proyek}--> </TD>
								<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_form_rfk_02_jp_main=<!--{$DATA_TB[x].id_form_rfk_02_jp_main}-->&id_form_rfk_02_jp_detail=<!--{$DATA_TB[x].id_form_rfk_02_jp_detail}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
								<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_form_rfk_02_jp_main=<!--{$DATA_TB[x].id_form_rfk_02_jp_main}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
							</TR>
							<!--{sectionelse}-->
							<TR>
								<td class="tdatacontent" COLSPAN="6" align="center">Sorry, your query has not been successful, please try again</TD>
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