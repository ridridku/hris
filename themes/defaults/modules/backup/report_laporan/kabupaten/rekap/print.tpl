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
																	
										<!--{section name=x loop=$DATA_TB}-->
										<TR>
											<TD BGCOLOR="#FFFFFF" align="right"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].kecamatan_yg_dilalui}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_PANJANG_RUAS[x]}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].baik}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].sedang}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].rusak_ringan}--></TD>
											<TD BGCOLOR="#FFFFFF"><!--{$DATA_TB[x].rusak_berat}--></TD>
											
																					
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