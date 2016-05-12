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
									<tr><td width="60">Sektor</td><td width="5"> : </td><td colspan="2"><!--{$SEKTOR}--></td></tr>
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
											<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">No</td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jenis Penanganan </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah Proyek/ Paket (Bh) </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah Kabupaten (Bh) </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Total Ruas Jalan (Km) </td>
										    	<td colspan="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Target Fisik dan Pembiayaan </td>
										    	<td colspan="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Rincian Sumber Biaya </td>
										    	<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Keterangan</td>																					
										</TR>
										<TR valign="middle">
											<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Jalan</td>
										    	<td colspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jembatan</td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya Umum (Rp)</td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Total Biaya (Rp)</td>
										    	<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PAD 1 (Rp) </td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Pembangunan Propinsi </td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PHLN</td>
										    	<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Lainnya </td>											
										</TR>
										<TR>
											<td align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Proyek (Km) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya Jalan (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Bh) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Total Panjang (m) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Umum (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">PJP DPP </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Nomor Loan </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp) </td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">Kode</td>
										</TR>										
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_penanganan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_proyek}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_kabupaten}--> </TD>											
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].panjang_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].panjang_proyek}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].panjang_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_umum}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].total_biaya}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].pad1}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].du_dpp}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].pjp_dpp}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].keterangan}--> </TD>
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