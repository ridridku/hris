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
					<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>"" AND $NO_JENIS_JALAN<>""}-->
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
										<TR align="center">
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NO}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NAMA_PAKET}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NAMA_KECAMATAN}--></TD>
											<TD BGCOLOR="#FFFFFF"  COLSPAN="2"><!--{$TB_TARGET}--></TD>
											<TD BGCOLOR="#FFFFFF"  COLSPAN="3"><!--{$TB_BIAYA}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_METODA_PELAKSANAAN}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_TANGGAL_SPMK}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_RENCANA_PHO}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_WAKTU_PELAKSANAAN}--></TD>
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_PIMPRO}--></TD>	
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_KONTRAKTOR}--></TD>	
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_PENGAWAS_LAPANGAN}--></TD>	
											<TD BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_KETERANGAN}--></TD>										
											</TD>
										</TR>
										<TR>
											<TD BGCOLOR="#FFFFFF" ><!--{$TB_TARGET_M}--></TD>
											<TD BGCOLOR="#FFFFFF" ><!--{$TB_TARGET_UNIT}--></TD>
											<TD BGCOLOR="#FFFFFF" ><!--{$TB_BIAYA_DAK}--></TD>
											<TD BGCOLOR="#FFFFFF" ><!--{$TB_BIAYA_PENDAMPING}--></TD>
											<TD BGCOLOR="#FFFFFF" ><!--{$TB_BIAYA_TOTAL}--></TD>											
										</TR>
										<TR>
											<TD BGCOLOR="#FFFFFF"  align="center">1</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">2</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">3</TD>
											<TD BGCOLOR="#FFFFFF"  COLSPAN="2" align="center">4</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">5</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">6</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">7</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">8</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">9</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">10</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">11</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">12</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">13</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">14</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">15</TD>
										</TR>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nama_paket}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kecamatan_yg_dilalui}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].target_m}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].target_unit}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_dak}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_pendamping}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].biaya_total}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].metoda_pelaksanaan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].tanggal_spmk}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].rencana_pho}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].waktu_pelaksanaan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].pimpro}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kontraktor}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].pengawas}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].keterangan}--> </TD>
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