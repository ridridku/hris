<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/global.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body>
						
				<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">																	
					<!--{if $NO_PROPINSI<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
						<TR>
							<TD><TABLE WIDTH="100%">
							<TR>
									<TD COLSPAN="2">&nbsp;</TD>
								</TR>							
					<TR>
						<TD COLSPAN="2" ALIGN="CENTER"><H2><!--{$LIST_ME}--></H2></TD>
						
					</TR>									
	
								<TR>
									<TD COLSPAN="2">
									<table>
									<tr><td width="60">Sektor</td><td width="5"> : </td><td colspan="2"><!--{$SEKTOR}--></td></tr>
									<tr><td>Sub Sektor</td><td> : </td><td colspan="2"><!--{$SUB_SEKTOR}--></td></tr>
									<tr><td>Program</td><td> : </td><td colspan="2"><!--{$NAMA_PROGRAM}--></td></tr>
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>									
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" BGCOLOR="#33023" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<TR valign="middle">
																			
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Kode Proyek</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Proyek</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">No Ruas Jalan</TD>											
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Ruas Jalan</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Total Jalan (Km)</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Sasaran/Fungsi</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Lokasi Kegiatan (Kabupaten)</TD>
											<TD COLSPAN="11" align="center" valign="middle" BGCOLOR="#FFFFFF">Target Fisik dan Pembiayaan</TD>
											<TD COLSPAN="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Rincian Sumber Pembiayaan</TD>
											<TD COLSPAN="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Konsistensi dengan Perencanaan</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Keterangan</TD>																						
										</TR>
										<TR valign="middle">
														
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Pangkal</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Ujung</TD>
											<TD COLSPAN="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Jalan</TD>
											<TD COLSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jembatan</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Total Biaya (Rp)</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PAD 1 (Rp)</TD>
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Pembangunan Propinsi</TD>
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PHLN</TD>		
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Lainnya</TD>										
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">UR-1 JP (Ya/Tidak)</TD>	
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya/Km (Rp)</TD>	
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Kode Kelayakan</TD>	
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Catatan</TD>											
										</TR>
										<TR>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Proyek (Km)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Status Awal</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Status Akhir</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Jenis Penanganan</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Tipe PKRSN</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Lebar PKRSN</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (m)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Total Panjang (m)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Umum (Rp)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">PJP (Rp)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Nomor Loan</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF">Kode</TD>
										</TR>
																			
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].kode_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].nama_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].no_ruas}--> </B></TD>
											<TD COLSPAN="2" bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].nama_ruas}--> </B></TD>											
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].panjang_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].sasaran}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].no_kabupaten}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].panjang_proyek}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].status_awal_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].status_akhir_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jenis_penanganan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].tipe_pkrsn}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].lebar_pkrsn}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].biaya_jalan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jumlah_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].panjang_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].biaya_jembatan}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].total_biaya}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].pad1}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].du_prop}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].pjp_prop}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jumlah_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jenis_loan_phln}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].ur_01_jp_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].biaya_per_km_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].kelayakan_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].catatan_konsistensi}--> </B></TD>
											<TD bgcolor="<!--{$ROW_CLASSNAME[x]}-->" class="tdatacontent"><B> <!--{$DATA_TB[x].keterangan}--> </B></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="31" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
										<!--{/section}-->
										
									</TABLE></TD>	
								</TR>	
							</TABLE></TD>
						</TR>
					</FORM>
					<!--{/if}-->
				</TABLE>										

</BODY>
</HTML>