<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
<script language="JavaScript" type="text/javascript">

n=document.layers
ie=document.all

//Hides the layer onload
function hideIt(){
	if(ie || n){
		if(n) document.divLoadCont.display="none"
		else divLoadCont.style.display="none"
	} else {
		document.getElementById('divLoadCont').style.display='none';
	}
}

</script>
<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
<!--{if $SEARCH_YEAR<>""}-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>
<!--{/if}-->
</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">
	 
                           <TR>
							<TD>Kawasan</TD>
							<TD>

								<SELECT name="kode_kawasan"  style="width:200px" >
								<OPTION VALUE="" selected>[Pilih Kawasan]</OPTION>
								<!--{section name=x loop=$DATA_INSTANSI}-->
									<!--{if ($DATA_INSTANSI[x].kode_kawasan) == $SES_PERWAKILAN}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_kawasan}-->" selected  > <!--{$DATA_INSTANSI[x].nama_kawasan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_kawasan}-->"  > <!--{$DATA_INSTANSI[x].nama_kawasan}--> </option>
									<!--{/if}-->
									<!--{/section}-->
								</SELECT>

							</TD>
							</TR>
						 
							<TR>
							<TD>Periode</TD>
							<TD>
							<SELECT name="bulan"   > 
								<OPTION VALUE="" selected>[Pilih Bulan]</OPTION>
								<OPTION VALUE="1"  >Januari</OPTION>
								<OPTION VALUE="2"  >Februari</OPTION>
								<OPTION VALUE="3"  >Maret</OPTION>
								<OPTION VALUE="4"  >April</OPTION>
								<OPTION VALUE="5"  >Mei</OPTION>
								<OPTION VALUE="6"  >Juni</OPTION>
								<OPTION VALUE="7"  >Juli</OPTION>
								<OPTION VALUE="8"  >Agustus</OPTION>
								<OPTION VALUE="9"  >September</OPTION>
								<OPTION VALUE="10"  >Oktober</OPTION>
								<OPTION VALUE="11"  >November</OPTION>
								<OPTION VALUE="12"  >Desember</OPTION>				 
						</SELECT> 


							<SELECT name="tahun" > 
						<OPTION VALUE="" selected>[Pilih Tahun]</OPTION>
								<!--{section name=foo start=2010 loop=2021 step=1}-->
									  <!--{if ($smarty.section.foo.index) == $SES_TAHUN}-->
										 <option value="<!--{$smarty.section.foo.index}-->"  selected><!--{$smarty.section.foo.index}--></option>
									  <!--{else}-->
											 <option value="<!--{$smarty.section.foo.index}-->"   ><!--{$smarty.section.foo.index}--></option>
									 <!--{/if}--> 
								<!--{/section}-->
						</SELECT> 
						 </TD>



							</TR>

 
 
							<TR>
								<TD></TD>
								<TD>
								<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
								<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
								<INPUT TYPE="hidden" name="search" value="1">
								<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
								<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
								<INPUT TYPE="hidden" name="op" value="0">
								<a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> Cari</span></a>
								<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
								</TD>
							</TR>	
						</TABLE>
			</FORM>
			</div></div>	
		</DIV>
														
		<!--{if $SEARCH<>""}--><br>
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">REKAP MELEPAS KEWARGANEGARAAN</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%" >

				
									<TR>
									<TD COLSPAN="2">
											<table width="100%" class="tbheader" border=0>	
				 <!--{if ($NM_KAWASAN !='') }-->
											<tr><td class="tdatacontent"  width="100" >KAWASAN</td><td width="5"> : </td><td colspan="2"><!--{$NM_KAWASAN}--> &nbsp;</td></tr>
				<!--{/if}-->

<!--{if ( $BULAN!='' ) }-->
											<TR>
											<Td class="tdatahead" ><b>BULAN </td><td> : </td><td>								
										 
										    <!--{if ($BULAN==1)}--> JANUARI <!--{/if}--> 
											<!--{if ($BULAN==2)}--> FEBRUARI <!--{/if}--> 
											<!--{if ($BULAN==3)}--> MARET <!--{/if}--> 
											<!--{if ($BULAN==4)}--> APRIL <!--{/if}--> 
											<!--{if ($BULAN==5)}--> MEI <!--{/if}--> 
											<!--{if ($BULAN==6)}--> JUNI <!--{/if}--> 
											<!--{if ($BULAN==7)}--> JULI <!--{/if}--> 
											<!--{if ($BULAN==8)}--> AGUSTUS <!--{/if}--> 
											<!--{if ($BULAN==9)}--> SEPTEMBER <!--{/if}--> 
											<!--{if ($BULAN==10)}--> OKTOBER <!--{/if}--> 
											<!--{if ($BULAN==11)}--> NOVEMBER <!--{/if}--> 
											<!--{if ($BULAN==12)}--> DESEMBER <!--{/if}--> 	
											
											</b> </Td>											 
										</TR>	
				 <!--{/if}-->

				 
				<!--{if ( $TAHUN !='' ) }-->


											<tr><td class="tdatacontent"  >TAHUN </td><td> : </td><td>
											 								
											<!--{$TAHUN}--> &nbsp;</td></tr>
				<!--{/if}-->


				 
											</table>
										   </TD>
											</TR>
			


								<TR>
									<TD COLSPAN="2">
											
										
										 <TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">
										
										 </TABLE>

										 <TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">						 
										 	
										<TR>
									 <TH class="tdatahead"   >PERWAKILAN</TH>
											<TH class="tdatahead" >JUMLAH ORANG</TH>											 
										</TR>			
 
										
												<!--{section name=y loop=$DATA_TB2}-->
														
													<TR>
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB2[y].nm_perwakilan}--></TD>
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB2[y].orang}--></TD>

													</TR>
															 
													
													<!--{/section}-->
										<!--{section name=y loop=$DATA_TB4}-->
										<TR>
											<Td class="tdatahead" align="right" ><b>TOTAL ORANG: </b></td>	
											<Td class="tdatahead"   align="left" > <!--{$DATA_TB4[y].total_orang}--> </td>	
										</TR>
											<!--{/section}-->
									</tbody>
									</TABLE>
										<br>
								<br>
									
										<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">						 
										 	
										<TR>
									 
											
											<TH class="tdatahead"   >KAWASAN</TH>
											<TH class="tdatahead" >JUMLAH ORANG</TH>
																					 
										</TR>			
 
										
												<!--{section name=y loop=$DATA_TB3}-->
														
													<TR>
															
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB3[y].nama_kawasan}--></TD>
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB3[y].orang}--></TD>
															

													</TR>
															 
														
													<!--{/section}-->

											<!--{section name=y loop=$DATA_TB4}-->
											<TR>
											<Td class="tdatahead" align="right" ><b>TOTAL ORANG: </b></td>	
											<Td class="tdatahead"   align="left" > <!--{$DATA_TB4[y].total_orang}--> </td>	

										</TR>
										<!--{/section}-->
									
										</tbody>
									</TABLE>	
									 

										 
										</TD> 
										

								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>


									<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
                                    <IMG SRC="<!--{$HREF_IMG_PATH}-->/grafik.jpg"  width="55"  height="55" style="cursor:pointer" align="absmiddle"   onMouseOver="document.frmList.print_desc.value='Grafik';"  onclick="window.open('../../../libchart/grafik/rekap_melepas_wn.php?<!--{$VAR_CARI}-->',null,'height=600,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')" >
&nbsp;&nbsp;
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';"  
									onClick = "window.open('<!--{$FILES}-->');">							
									</div>
					</FORM>


					<!--{/if}-->

	</DIV>

</BODY>
</HTML>