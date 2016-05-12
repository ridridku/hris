<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/global.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body>
						
				<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">																	
					<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->
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
									<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
									<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" BGCOLOR="#000000" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<TR valign="middle">
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="3">No</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="3">No. Kab./Kota</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="3">No Ruas</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="3">Nama Ruas / Jembatan</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2">Panjang</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="4">Awal <!--{$TB_TAHUN1}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="4">Akhir <!--{$TB_TAHUN2}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="3">Keterangan</TD>
										</TR>
										<TR valign="middle">
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" colspan="4">Panjang Tiap Kondisi (Km)</TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" colspan="4">Panjang Tiap Kondisi (Km)</TD>											
										</TR>
										  <tr>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">(Km)</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">(m)</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Baik</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Sedang</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Rusak</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Rusak Berat</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Baik</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Sedang</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Rusak</th>
										    <TD align="center" valign="middle" BGCOLOR="#FFFFFF">Rusak Berat</th>
										  </tr>
										<TR>
											<TD BGCOLOR="#FFFFFF" align="center">1</TD>
											<TD BGCOLOR="#FFFFFF" align="center">2</TD>
											<TD BGCOLOR="#FFFFFF" align="center">3</TD>
											<TD BGCOLOR="#FFFFFF" align="center">4</TD>
											<TD BGCOLOR="#FFFFFF" align="center">5</TD>
											<TD BGCOLOR="#FFFFFF" align="center">6</TD>
											<TD BGCOLOR="#FFFFFF" align="center">7</TD>
											<TD BGCOLOR="#FFFFFF" align="center">8</TD>
											<TD BGCOLOR="#FFFFFF" align="center">9</TD>
											<TD BGCOLOR="#FFFFFF" align="center">10</TD>
											<TD BGCOLOR="#FFFFFF" align="center">11</TD>
											<TD BGCOLOR="#FFFFFF" align="center">12</TD>
											<TD BGCOLOR="#FFFFFF" align="center">13</TD>
											<TD BGCOLOR="#FFFFFF" align="center">14</TD>
											<TD BGCOLOR="#FFFFFF" align="center">15</TD>
										</TR>										
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].no_kabupaten}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].no_ruas}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].nama_ruas}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang_km}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang_m}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun1_baik}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun1_sedang}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun1_rusak}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun1_rusak_berat}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun2_baik}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun2_sedang}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun2_rusak}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tahun2_rusak_berat}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].keterangan}--></TD>

										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD BGCOLOR="red" COLSPAN="15" align="center">Sorry, your query has not been successful, please try again</TD>
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