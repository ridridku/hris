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
					<!--{if $NO_PROPINSI<>"" AND $TAHUN<>"" AND $KODE_PROYEK<>""}-->
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
									<tr><td width="60">Sektor</td><td> : </td><td colspan="2"><!--{$SEKTOR}--></td></tr>
									<tr><td>Sub Sektor</td><td> : </td><td colspan="2"><!--{$SUB_SEKTOR}--></td></tr>
									<tr><td>Program</td><td> : </td><td colspan="2"><!--{$NAMA_PROGRAM}--></td></tr>
									<tr><td>Kode Proyek</td><td> : </td><td colspan="2"><!--{$KODE_PROYEK}--></td></tr>
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>									
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" BGCOLOR="#000000" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<TR valign="middle">
											<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">No Ruas Jalan </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Proyek </td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Ruas Jalan</td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Total Jalan (Km) </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Sasaran/Fungsi</td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Lokasi Kegiatan (Kabupaten) </td>
										    	<td colspan="11" align="center" valign="middle" BGCOLOR="#FFFFFF">Target Fisik dan Biaya </td>
										    	<td colspan="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Rincian Sumber Pembiayaan </td>
										    	<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Proses Perencanaan </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Kode Kelayakan </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Keterangan</td>																			
										</TR>
										<TR valign="middle">
											<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Pangkal </td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Nama Ujung </td>								    
										    	<td colspan="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Jalan</td>
										    	<td colspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jembatan</td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Total Biaya (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">PAD 1 (Rp)</td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Pembangunan Propinsi </td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PHLN</td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Lainnya </td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya/Km (Rp) </td>
										    	<td colspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Status Evaluasi </td>											
										</TR>
										<TR>
											<td align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Proyek (Km) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Status Awal </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Status Akhir </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jenis Penanganan </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Tipe PKRSN </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Lebar PKRSN </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya Jalan (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Bh) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Total Panjang (m) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">&nbsp;</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Umum (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">PJP (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah PHLN (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Nomor Loan </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Kode</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">NPV/Km (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">INPV/Km (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">IRR (%) </td>
										</TR>										
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].no_ruas}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].nama_proyek}--> </TD>
											<TD colspan="2" BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].nama_ruas}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang_jalan}--> </TD>											
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].sasaran}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].no_kabupaten}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang_proyek}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].status_awal_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].status_akhir_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jenis_penanganan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tipe_pkrsn}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].lebar_pkrsn}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].biaya_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jumlah_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].biaya_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].total_biaya}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].pad1}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].du_dpp}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].pjp_dpp}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jumlah_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jenis_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].biaya_per_km}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].npv_per_km}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].inpv_per_km}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].irr}--> </TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].kelayakan}--> </TD>											
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].keterangan}--> </TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="34" align="center">Sorry, your query has not been successful, please try again</TD>
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