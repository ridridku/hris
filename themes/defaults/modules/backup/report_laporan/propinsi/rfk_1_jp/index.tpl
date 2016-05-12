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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
<!--{if $NO_PROPINSI<>"" AND $TAHUN<>""}-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Print</span></a>
<!--{/if}-->
</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">

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
						<FORM METHOD=GET ACTION="" NAME="frmList1">
							<TR>
								<TD WIDTH="40%"><!--{$TB_PROPINSI}--></TD>
								<TD>:</TD>
								<TD WIDTH="58%">
								<SELECT name="no_propinsi" onChange="cari_tahun_proyek(this.value);">
								<OPTION VALUE="">[Pilih Propinsi]</OPTION>
								<!--{section name=x loop=$DATA_PROPINSI}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{/section}-->
								</SELECT>
								</TD>
							</TR>
							<TR>
								<TD><!--{$TB_TAHUN}--></TD>
								<TD>:</TD>
								<TD>
								<div id="ajax_tahun_proyek">
								<SELECT name="tahun"  onChange="cari_kode_proyek(this.value)">
								<OPTION VALUE="">[Pilih Tahun Anggaran]</OPTION>							
								</SELECT>	
								</div>						
								</TD>
							</TR>
							<!--<TR>
								<TD>Kode Proyek</TD>
								<TD>:</TD>
								<TD>
								<div id="ajax_kode_proyek">
								<SELECT name="kode_proyek">
								<OPTION VALUE="">[Pilih Kode Proyek]</OPTION>
								<!--{section name=x loop=$DATA_KODE_PROYEK}-->
								<!--{if trim($DATA_KODE_PROYEK[x].kode_proyek) == trim($KODE_PROYEK)}-->
								<option value="<!--{$DATA_KODE_PROYEK[x].kode_proyek}-->" selected > <!--{$DATA_KODE_PROYEK[x].kode_proyek}--> </option>
								<!--{else}-->
								<option value="<!--{$DATA_KODE_PROYEK[x].kode_proyek}-->"  > <!--{$DATA_KODE_PROYEK[x].kode_proyek}--> </option>
								<!--{/if}-->
								<!--{/section}-->
								</SELECT>		
								</div>	
								</TD>
							</TR>		-->					
							<TR><TD COLSPAN="3" height="4"></TD></TR>
							<TR>
								<TD COLSPAN="2"></TD>
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
							</FORM>						
						</TABLE>
						
						</DIV>
						
						</TD>
					</TR>									
					<!--{if $NO_PROPINSI<>"" AND $TAHUN<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
						<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
						<tr><td class="tcat"> <!--{$LIST_ME}--></td></tr>
					</table>
						<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
						<tr><td class="alt2" style="padding:0px;">
						<table width="100%">
						
						<FONT SIZE="2"><!--{$TB_TAHUN}--> : <!--{$TAHUN}--></FONT></B></TD>
						
					</TR>									
	
								<TR>
									<TD COLSPAN="2">
									<table width="100%" class="tbheader">
									<tr><td width="60">Sektor</td><td width="5"> : </td><td colspan="2"><!--{$SEKTOR}--></td></tr>
									<tr><td>Sub Sektor</td><td> : </td><td colspan="2"><!--{$SUB_SEKTOR}--></td></tr>
									<tr><td>Program</td><td> : </td><td colspan="2"><!--{$NAMA_PROGRAM}--></td></tr>
									<!--<tr><td>Kode Proyek</td><td> : </td><td colspan="2"><!--{$KODE_PROYEK}--></td></tr>-->
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td><td align="right"><b>Realisasi Fisik dan Keuangan</b></td></tr>									
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
									  <tr>
									    <th rowspan="6" class="tdatahead">No Ruas Jalan </th>
									    <th rowspan="6" class="tdatahead">Nama Program/ Paket proyek/ Kegiatan Lain </th>
									    <th colspan="3" class="tdatahead">Target Total </th>
									    <th colspan="27" class="tdatahead">Sumber Pembiayaan Pengelolaan Jalan Propinsi </th>
									    <th rowspan="6" class="tdatahead">Klarifikasi Masalah </th>
									  </tr>
									  <tr>
									    <th colspan="2" rowspan="2" class="tdatahead">Fisik</th>
									    <th rowspan="5" class="tdatahead">Biaya (Rp) </th>
									    <th colspan="5" rowspan="2" class="tdatahead">PAD 1 </th>
									    <th colspan="10" class="tdatahead">Dana Pembangunan Propinsi </th>
									    <th colspan="6" rowspan="2" class="tdatahead">PHLN</th>
									    <th colspan="6" rowspan="2" class="tdatahead">Sumber Lain </th>
									  </tr>
									  <tr>
									    <th colspan="5" class="tdatahead">Dana Umum</th>
									    <th colspan="5" class="tdatahead">PJP</th>
									  </tr>
									  <tr>
									    <th rowspan="3" class="tdatahead">Jalan (Km) </th>
									    <th rowspan="3" class="tdatahead">Jembatan (m) </th>
									    <th rowspan="3" class="tdatahead">Biaya (Rp) </th>
									    <th colspan="4" class="tdatahead">Realisasi Bulan Ini </th>
									    <th rowspan="3" class="tdatahead">Biaya (Rp) </th>
									    <th colspan="4" class="tdatahead">Realisasi Bulan Ini </th>
									    <th rowspan="3" class="tdatahead">Biaya (Rp)</th>
									    <th colspan="4" class="tdatahead">Realisasi Bulan Ini</th>
									    <th rowspan="3" class="tdatahead">Biaya (Rp)</th>
									    <th rowspan="3" class="tdatahead">Nomor Loan </th>
									    <th colspan="4" class="tdatahead">Realiasasi Bulan Ini </th>
									    <th rowspan="3" class="tdatahead">Biaya (Rp)</th>
									    <th rowspan="3" class="tdatahead">Kode</th>
									    <th colspan="4" class="tdatahead">Realiasasi Bulan Ini</th>
									  </tr>
									  <tr>
									    <th colspan="2" class="tdatahead">Fisik</th>
									    <th colspan="2" class="tdatahead">Keuangan</th>
									    <th colspan="2" class="tdatahead">Fisik</th>
									    <th colspan="2" class="tdatahead">Keuangan</th>
									    <th colspan="2" class="tdatahead">Fisik</th>
									    <th colspan="2" class="tdatahead">Keuangan</th>
									    <th colspan="2" class="tdatahead">Fisik</th>
									    <th colspan="2" class="tdatahead">Keuangan</th>
									    <th colspan="2" class="tdatahead">Fisik</th>
									    <th colspan="2" class="tdatahead">Keuangan</th>
									  </tr>
									  <tr>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									    <th class="tdatahead">(%)</th>
									    <th class="tdatahead">(Rp)</th>
									  </tr>		
									  	<tbody>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].no_ruas}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nama_program}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].target_total_fisik_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].target_total_fisik_jembatan}--> </B></TD>											
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].target_total_biaya}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_pad1}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_fisik_pad1_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_fisik_pad1_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_keuangan_pad1_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_keuangan_pad1_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_du_dpp}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_fisik_du_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_fisik_du_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_keuangan_du_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_keuangan_du_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_pjp_dpp}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_fisik_pjp_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_fisik_pjp_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_keuangan_pjp_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_keuangan_pjp_dpp_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jumlah_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jenis_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_fisik_phln_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_fisik_phln_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_keuangan_phln_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_keuangan_phln_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_fisik_sumber_lain_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_fisik_sumber_lain_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].persen_keuangan_sumber_lain_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nilai_keuangan_sumber_lain_bulan_ini}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].klarsifikasi_masalah}--> </B></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="33" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
										<!--{/section}-->
										</tbody>
									</TABLE></TD>	
								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>
<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									&nbsp;&nbsp;
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';" onMouseOut="document.frmList.print_desc.value='';" 
									onClick = "window.open('<!--{$FILES}-->');">	
									</div>
					</FORM>
					<!--{/if}-->

	</DIV>

</BODY>
</HTML>