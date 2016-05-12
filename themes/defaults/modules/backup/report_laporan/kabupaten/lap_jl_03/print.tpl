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
										<TR>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NO}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NAMA_PAKET}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_NAMA_KECAMATAN}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_KESESUAIAN_RD_DAK}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_KESESUAIAN_RD}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_ALASAN}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  COLSPAN="3"><!--{$TB_KELENGKAPAN_DOKUMEN}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF"  ROWSPAN="2"><!--{$TB_KETERANGAN}--></TD>										
											</TD>
										</TR>
										<TR>
											<TD align="center" BGCOLOR="#FFFFFF" ><!--{$TB_GAMBAR}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF" ><!--{$TB_SPESIFIKASI}--></TD>
											<TD align="center" BGCOLOR="#FFFFFF" ><!--{$TB_RAB}--></TD>											
										</TR>
										<TR>
											<TD BGCOLOR="#FFFFFF"  align="center">1</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">2</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">3</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">4</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">5</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">6</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">7</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">8</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">9</TD>
											<TD BGCOLOR="#FFFFFF"  align="center">10</TD>
										</TR>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF"  align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].nama_ruas}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kecamatan_yg_dilalui}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].rd_dak}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].rd}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].alasan}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kelengkapan_gambar}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kelengkapan_spesifik}--> </TD>
											<TD BGCOLOR="#FFFFFF"> <!--{$DATA_TB[x].kelengkapan_rab}--> </TD>
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