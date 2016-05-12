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
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></td>
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" BGCOLOR="#000000" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<TR valign="middle">
											<td rowspan="6" align="center" valign="middle" BGCOLOR="#FFFFFF">NO</td>
									    		<td rowspan="6" align="center" valign="middle" BGCOLOR="#FFFFFF">Jenis Penanganan </td>
									    		<td rowspan="6" align="center" valign="middle" BGCOLOR="#FFFFFF">Jumlah Proyek/Paket </td>
									    		<td colspan="3" rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Target Total FisikBiaya (Rp) </td>
									    		<td colspan="27" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Pembiayaan Pengelolaan Jalan Propinsi </td>
									    		<td rowspan="6" align="center" valign="middle" BGCOLOR="#FFFFFF">Keterangan</td>																					
										</TR>
										<TR valign="middle">
											<td colspan="5" rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PAD 1 </td>
									    		<td colspan="10" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Pembangunan Propinsi </td>
									    		<td colspan="6" rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">PHLN</td>
									    		<td colspan="6" rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Sumber Lainnya </td>											
										</TR>
										<TR>
											<td colspan="5" align="center" valign="middle" BGCOLOR="#FFFFFF">Dana Umum </td>
									    		<td colspan="5" align="center" valign="middle" BGCOLOR="#FFFFFF">PJP</td>
										</TR>	
										<TR>
											<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
									    		<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Realisasi Bulan Ini </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
									    		<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Realisasi Bulan Ini </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp)</td>
									    		<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Realisasi Bulan Ini </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Nomor Loan </td>
									    		<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Realisasi Bulan Ini </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Biaya (Rp) </td>
									    		<td rowspan="3" align="center" valign="middle" BGCOLOR="#FFFFFF">Kode</td>
									    		<td colspan="4" align="center" valign="middle" BGCOLOR="#FFFFFF">Realisasi Bulan Ini </td>
										</TR>	
										<TR>
											<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Jalan (Km) </td>
									    		<td rowspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Jembatan (m) </td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Keuangan</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Keuangan</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Keuangan</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Keuangan</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Fisik</td>
									    		<td colspan="2" align="center" valign="middle" BGCOLOR="#FFFFFF">Keuangan</td>
										</TR>
										<TR>
											<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										   	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(%)</td>
										    	<td align="center" valign="middle" BGCOLOR="#FFFFFF">(Rp)</td>	
										</TR>								
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_penanganan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jumlah_proyek}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].total_fisik_jalan}--> </TD>											
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].total_fisik_jembatan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].total_biaya}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_pad1}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_fisik_pad1_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_fisik_pad1_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_keuangan_pad1_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_keuangan_pad1_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_du_dpp}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_fisik_du_dpp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_fisik_du_dpp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_keuangan_du_dpp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_keuangan_du_dpp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_pjp}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_fisik_pjp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_fisik_pjp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_keuangan_pjp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_keuangan_pjp_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_loan_phln}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_fisik_loan_phln_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_fisik_loan_phln_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_keuangan_loan_phln_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_keuangan_loan_phln_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].jenis_sumber_dana_lain}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_fisik_sumber_dana_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_fisik_sumber_dana_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].persen_keuangan_sumber_dana_bulan_ini}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nilai_keuangan_sumber_dana_bulan_ini}--> </TD>
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