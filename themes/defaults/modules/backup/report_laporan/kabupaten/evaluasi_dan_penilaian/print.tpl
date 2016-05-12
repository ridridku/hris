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
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_NO}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_NO_KABUPATEN}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_NO_RUAS}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_NAMA_RUAS}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_TITIK_PENGENAL_PANGKAL}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_TITIK_PENGENAL_UJUNG}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_NAMA_KECAMATAN}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_PANJANG_RUAS}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_LEBAR_RATA_RATA}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" COLSPAN="5"><!--{$TB_PANJANG_PERMUKAAN}--></TD>	
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF" ROWSPAN="2"><!--{$TB_KETERANGAN}--></TD>																					
										</TR>
										<TR valign="middle">
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF"><!--{$TB_ASPAL}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF"><!--{$TB_PM}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF"><!--{$TB_TELFORD}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF"><!--{$TB_TANAH}--></TD>
											<TD align="center" valign="middle" BGCOLOR="#FFFFFF"><!--{$TB_BLM_TEMBUS}--></TD>											
										</TR>
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
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].titik_pengenal_pangkal}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].titik_pengenal_ujung}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].kecamatan_yg_dilalui}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].panjang}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].lebar}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].aspal}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].penetrasi_macadam}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].telford}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].tanah}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].belum_tembus}--></TD>
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