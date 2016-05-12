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
																														
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jenis Penanganan</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah Proyek/Paket (Km)</TD>											
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah Kabupaten (Bh)</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Total Ruas Jalan (Km)</TD>
											<TD COLSPAN="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Target Fisik dan Pembiayaan</TD>
											<TD COLSPAN="7" align="center" valign="middle" BGCOLOR="#FFFFFF">Rincian Sumber Pembiayaan</TD>
											<TD ROWSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Keterangan</TD>	
										</TR>
										<TR valign="middle">
																		
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Jalan</TD>
											<TD COLSPAN="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Jembatan</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya Umum(Rp)</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Total Biaya (Rp)</TD>
											<TD ROWSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PAD 1 (Rp)</TD>
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Pembangunan Propinsi</TD>		
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PHLN</TD>		
											<TD COLSPAN="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Lainnya</TD>									
										</TR>
										<TR>											
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Panjang Proyek (Km)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Bh)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Total Panjang (m)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Umum (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">PJP (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Nomor Loan</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah (Rp)</TD>
											<TD align="center" align="center" valign="middle" BGCOLOR="#FFFFFF">Kode</TD>
										</TR>	
																		
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jenis_penanganan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jumlah_proyek_per_paket}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jumlah_kabupaten}--> </TD>											
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].total_panjang_ruas}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].panjang_proyek_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].biaya_jalan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jumlah_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].panjang_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].biaya_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].biaya_umum}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].total_biaya}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].pad1}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].du_prop}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].pjp_prop}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jumlah_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jenis_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jumlah_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF" <!--{$DATA_TB[x].keterangan}--> </TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="20" align="center">Sorry, your query has not been successful, please try again</TD>
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