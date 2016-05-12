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
							<TR>
								<TD WIDTH="75%"><!--{$TB_PROPINSI}--></TD>
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
								<TR>
									<TD COLSPAN="2">
									<table width="100%" class="tbheader">
									<tr><td width="100">Sektor</td><td width="5"> : </td><td colspan="2"><!--{$SEKTOR}--></td></tr>
									<tr><td>Sub Sektor</td><td> : </td><td colspan="2"><!--{$SUB_SEKTOR}--></td></tr>
									<tr><td>Program</td><td> : </td><td colspan="2"><!--{$NAMA_PROGRAM}--></td></tr>
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td><td align="right"><b>Dokumen Pelaksana Anggaran</b></td></tr>									
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<TR>
											<TH ROWSPAN="3" class="tdatahead">Kode Proyek</TH>
											<TH ROWSPAN="3" class="tdatahead">Nama Proyek</TH>
											<TH ROWSPAN="3" class="tdatahead">No Ruas Jalan</TH>											
											<TH COLSPAN="2" class="tdatahead">Nama Ruas Jalan</TH>
											<TH ROWSPAN="3" class="tdatahead">Panjang Total Jalan (Km)</TH>
											<TH ROWSPAN="3" class="tdatahead">Sasaran/Fungsi</TH>
											<TH ROWSPAN="3" class="tdatahead">Lokasi Kegiatan (Kabupaten)</TH>
											<TH COLSPAN="11" class="tdatahead">Target Fisik dan Pembiayaan</TH>
											<TH COLSPAN="7" class="tdatahead">Rincian Sumber Pembiayaan</TH>
											<TH COLSPAN="4" class="tdatahead">Konsistensi dengan Perencanaan</TH>
											<TH ROWSPAN="3" class="tdatahead">Keterangan</TH>										
											
										</TR>
										<TR>
											<TH ROWSPAN="2" class="tdatahead">Nama Pangkal</TH>
											<TH ROWSPAN="2" class="tdatahead" class="tdatahead">Nama Ujung</TH>
											<TH COLSPAN="7" class="tdatahead">Jalan</TH>
											<TH COLSPAN="3" class="tdatahead">Jembatan</TH>
											<TH ROWSPAN="2" class="tdatahead">Total Biaya (Rp)</TH>
											<TH ROWSPAN="2" class="tdatahead">PAD 1 (Rp)</TH>
											<TH COLSPAN="2" class="tdatahead">Dana Pembangunan Propinsi</TH>
											<TH COLSPAN="2" class="tdatahead">PHLN</TH>		
											<TH COLSPAN="2" class="tdatahead">Sumber Lainnya</TH>										
											<TH ROWSPAN="2" class="tdatahead">UR-1 JP (Ya/Tidak)</TH>	
											<TH ROWSPAN="2" class="tdatahead">Biaya/Km (Rp)</TH>	
											<TH ROWSPAN="2" class="tdatahead">Kode Kelayakan</TH>	
											<TH ROWSPAN="2" class="tdatahead">Catatan</TH>	
										</TR>
										<TR>											
											<TH align="center" class="tdatahead">Panjang Proyek (Km)</TH>
											<TH align="center" class="tdatahead">Status Awal</TH>
											<TH align="center" class="tdatahead">Status Akhir</TH>
											<TH align="center" class="tdatahead">Jenis Penanganan</TH>
											<TH align="center" class="tdatahead">Tipe PKRSN</TH>
											<TH align="center" class="tdatahead">Lebar PKRSN</TH>
											<TH align="center" class="tdatahead">Biaya (Rp)</TH>
											<TH align="center" class="tdatahead">Jumlah (m)</TH>
											<TH align="center" class="tdatahead">Total Panjang (m)</TH>
											<TH align="center" class="tdatahead">Biaya</TH>
											<TH align="center" class="tdatahead">Dana Umum (Rp)</TH>
											<TH align="center" class="tdatahead">PJP (Rp)</TH>
											<TH align="center" class="tdatahead">Jumlah (Rp)</TH>
											<TH align="center" class="tdatahead">Nomor Loan</TH>
											<TH align="center" class="tdatahead">Jumlah (Rp)</TH>
											<TH align="center" class="tdatahead">Kode</TH>
										</TR>	
										<tbody>										
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].kode_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nama_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].no_ruas}--> </B></TD>
											<TD COLSPAN="2" bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].nama_ruas}--> </B></TD>											
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].panjang_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].sasaran}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].no_kabupaten}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].panjang_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].status_awal_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].status_akhir_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jenis_penanganan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].tipe_pkrsn}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].lebar_pkrsn}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jumlah_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].panjang_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].total_biaya}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].pad1}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].du_prop}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].pjp_prop}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jumlah_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jenis_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].ur_01_jp_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].biaya_per_km_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].kelayakan_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].catatan_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent" nowrap><B> <!--{$DATA_TB[x].keterangan}--> </B></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="15" align="center" class="tdatacontent">Sorry, your query has not been successful, please try again</TD>
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