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
					 
								<SELECT name="kode_kawasan" style="width:200px"  style="width:200px" onchange="cari_negara(this.value);" > 				  
								<OPTION VALUE="" selected>[Pilih Kawasan]</OPTION>
								<!--{section name=u loop=$DATA_INSTANSI2}-->						 
									<!--{if ($DATA_INSTANSI2[u].kode_kawasan) == $SES_PERWAKILAN}-->
									<option value="<!--{$DATA_INSTANSI2[u].kode_kawasan}-->" selected  > <!--{$DATA_INSTANSI2[u].nama_kawasan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_INSTANSI2[u].kode_kawasan}-->"  > <!--{$DATA_INSTANSI2[u].nama_kawasan}--> </option>
									<!--{/if}-->
									<!--{/section}-->
								</SELECT>
	
							</TD>
							</TR>

							<TR>
							<TD>Negara</TD>
							<TD>	
							<div id="ajax_negara">
								<SELECT name="kode_negara"  > 				  
								<OPTION VALUE="" selected>[Pilih Negara]</OPTION>
								</SELECT>
							</div>
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
							<TD>Jenis Kasus</TD>
							<TD>							
								<SELECT name="kode_kasus"  style="width:200px" > 				  
								<OPTION VALUE="" selected>[Pilih Jenis Kasus]</OPTION>
								<!--{section name=x loop=$DATA_INSTANSI}-->						 
									<!--{if ($DATA_INSTANSI[x].kode_kasus) == $SES_PERWAKILAN}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_kasus}-->" selected  > <!--{$DATA_INSTANSI[x].nama_kasus}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_kasus}-->"  > <!--{$DATA_INSTANSI[x].nama_kasus}--> </option>
									<!--{/if}-->
									<!--{/section}-->
								</SELECT>
	


							 

							</TR>

							<TR>
							<TD>Klasifikasi WNI</TD>
							<TD>
					 
								<select name="kode_klasifikasi_wni"  onchange="cari_jenis(this.value);" > 
								 <option value="">[Pilih Klasifikasi WNI]</option>
								 <option value="1" <!--{if ($DINA==1)}--> selected  <!--{/if}--> >WNI NON TKI</option>
								  <option value="3" <!--{if ($DINA==3)}--> selected  <!--{/if}--> >TKI FORMAL</option>
								   <option value="4" <!--{if ($DINA==4)}--> selected  <!--{/if}-->>TKI INFORMAL</option>
								    <option value="6" <!--{if ($DINA==6)}--> selected  <!--{/if}-->>TKI ABK</option>
								 </select>	 
	
							</TD>
							</TR>


							<TR>
							<TD>Sektor Pekerjaan</TD>
							<TD>
					 <div id="ajax_sektor">
					 
						<select name="kode_sektor" disabled > 
						<option value="">[Pilih Sektor Pekerjaan]</option>
						</select>				 
 
					</div>
								 
	
							</TD>
							</TR>

							<TR>
							<TD>Jenis WNI</TD>
							<TD>
					 
								 <div id="ajax_jenis_wni">
								 <select name="kode_jenis" > 
								 <option value="">[Pilih Jenis WNI]</option> 
								</select>
								</div>
							</TD>
							</TR>

							<TR>
							<TD>Usia</TD>
							<TD>
					 
								<SELECT name="usia"  style="width:200px" > 				  
								<OPTION VALUE="" selected>[Pilih Usia]</OPTION>
								<OPTION VALUE="1"  >0 - 20 Tahun</OPTION>
								<OPTION VALUE="2"  >21 - 40 Tahun</OPTION>
								<OPTION VALUE="3"  >41 - 60 Tahun</OPTION>
								<OPTION VALUE="4"  >61 Tahun Keatas</OPTION>								 
								</SELECT>
	
							</TD>
							</TR>

							 <TR>
							<TD>Jenis Kelamin</TD>
							<TD>
					 
								<SELECT name="jk"  style="width:200px" > 				  
								<OPTION VALUE="" selected>[Pilih Jenis Kelamin]</OPTION>
								<OPTION VALUE="1"  >Perempuan</OPTION>
								<OPTION VALUE="2"  >Laki - laki</OPTION>
								 						 
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
		<tr><td class="tcat">REKAP KASUS</td></tr>
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

				 <!--{if ($NAMA_NEGARA !='') }-->
											<tr><td class="tdatacontent"  width="100" >NEGARA</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_NEGARA}--> &nbsp;</td></tr>
				<!--{/if}-->


				<!--{if ( $TAHUN !='' ) }-->


											<tr><td class="tdatacontent"  >TAHUN </td><td> : </td><td>
											 								
											<!--{$TAHUN}--> &nbsp;</td></tr>
				<!--{/if}-->
				<!--{if ( $BULAN!='' ) }-->
											<TR>
											<Td class="tdatahead" ><b>BULAN </td><td> : </td><td>								
										 
										    <!--{if ($BULAN==01)}--> JANUARI <!--{/if}--> 
											<!--{if ($BULAN==02)}--> FEBRUARI <!--{/if}--> 
											<!--{if ($BULAN==03)}--> MARET <!--{/if}--> 
											<!--{if ($BULAN==04)}--> APRIL <!--{/if}--> 
											<!--{if ($BULAN==05)}--> MEI <!--{/if}--> 
											<!--{if ($BULAN==06)}--> JUNI <!--{/if}--> 
											<!--{if ($BULAN==07)}--> JULI <!--{/if}--> 
											<!--{if ($BULAN==08)}--> AGUSTUS <!--{/if}--> 
											<!--{if ($BULAN==09)}--> SEPTEMBER <!--{/if}--> 
											<!--{if ($BULAN==10)}--> OKTOBER <!--{/if}--> 
											<!--{if ($BULAN==11)}--> NOVEMBER <!--{/if}--> 
											<!--{if ($BULAN==12)}--> DESEMBER <!--{/if}--> 	
											
											</b> </Td>											 
										</TR>	
				 <!--{/if}-->


				 <!--{if ( $NAMA_KASUS !='' ) }-->


											<tr><td class="tdatacontent"  >JENIS KASUS </td><td> : </td><td>
											 								
											<!--{$NAMA_KASUS}--> &nbsp;</td></tr>
				<!--{/if}-->

				<!--{if ($NAMA_KLASIFIKASI !='') }-->
											<tr><td class="tdatacontent"  width="100" >KLASIFIKASI WNI</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_KLASIFIKASI}--> &nbsp;</td></tr>
				<!--{/if}-->
				<!--{if ($NAMA_JENIS !='') }-->
											<tr><td class="tdatacontent"  width="100" >JENIS WNI</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_JENIS}--> &nbsp;</td></tr>
				<!--{/if}-->
				<!--{if ($NAMA_JK !='') }-->
											<tr><td class="tdatacontent"  width="100" >JENIS KELAMIN</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_JK}--> &nbsp;</td></tr>
				<!--{/if}-->


				<!--{if ($NAMA_USIA !='') }-->
											<tr><td class="tdatacontent"  width="100" >USIA</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_USIA}-->    &nbsp;</td></tr>
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
											<TH class="tdatahead" >PERWAKILAN</TH>
											<TH class="tdatahead" >JUMLAH KASUS</TH>
											<TH class="tdatahead" >JUMLAH KASUS DALAM PROSES</TH>
											<TH class="tdatahead" >JUMLAH KASUS SELESAI</TH>																					 
										</TR>			
 
										
												<!--{section name=y loop=$DATA_TB2}-->
														
													<TR>
															
							 <TD class="tdatacontent" ><!--{$DATA_TB2[y].nm_perwakilan}--></TD>
							 <TD class="tdatacontent" > 
 

							 <input name="Button" type="button" class="button" style="cursor: hand;" onclick="goDetailBaik('<!--{$DATA_TB2[y].kode_perwakilan}-->','<!--{$TAHUN}-->','<!--{$BULAN}-->','<!--{$KODE_KASUS}-->','<!--{$KODE_NEGARA}-->','<!--{$KODE_KLASIFIKASI_WNI}-->','<!--{$KODE_SEKTOR}-->','<!--{$KODE_JENIS}-->','<!--{$JK}-->','<!--{$USIA}-->')" value=" <!--{$DATA_TB2[y].orang}--> " /> 
															
															
							 </TD>
															<TD class="tdatacontent"    ><!--{$DATA_TB2[y].jml_selisih}--></TD>
															<TD class="tdatacontent"    ><!--{$DATA_TB2[y].jml_status_selesai}--></TD>
															 
													</TR> 
													<!--{/section}-->

										  
											<TR>
											<Th class="tdatahead" align="right" ><b>TOTAL : </b></th>	
											<Th class="tdatahead" align="left" > <!--{$TOT_JM_KASUS}--> </th>
											<Th class="tdatahead" align="left" > <!--{$JML_KASUS_PROSES}--> </th>	
											<Th class="tdatahead" align="left" > <!--{$JML_STATUS_SELESAI}--> </th>	

										</TR>
										
									</tbody>
									</TABLE>
								<br>
								<br>
									
										<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">						 
										 	
										<TR>
									 
											
											<TH class="tdatahead"   width="50%"  >KAWASAN</TH>
											<TH class="tdatahead" >JUMLAH ORANG</TH>
																					 
										</TR>			
 
										
												<!--{section name=y loop=$DATA_TB3}-->
														
													<TR>
															
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB3[y].nama_kawasan}--></TD>
															<TD class="tdatacontent"   nowrap>
															 
															
															 <input name="Button" type="button" class="button" style="cursor: hand;" onclick="goDetailKawasan('<!--{$DATA_TB3[y].kode_kawasan}-->','<!--{$TAHUN}-->','<!--{$BULAN}-->','<!--{$KODE_KASUS}-->','<!--{$KODE_NEGARA}-->','<!--{$KODE_KLASIFIKASI_WNI}-->','<!--{$KODE_SEKTOR}-->','<!--{$KODE_JENIS}-->','<!--{$JK}-->','<!--{$USIA}-->')" value=" <!--{$DATA_TB3[y].orang}--> " /> 
															
															
															
															
															</TD>
															

													</TR>
															 
														
													<!--{/section}-->
										 
										 

										<TR>
											<Th class="tdatahead" align="right" ><b>TOTAL   </b></th>	
											<Th class="tdatahead" align="left" ><!--{$TOT_JM_KAWASAN}--> </th>	
									  
										</TR>


								 
										
									</tbody>
									</TABLE>	




									<br>
								<br>
									
										<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">						 
										 	
										<TR>
									 
											
											<TH class="tdatahead" width="50%">NEGARA</TH>
											<TH class="tdatahead" >JUMLAH ORANG</TH>
																					 
										</TR>			
 
										
												<!--{section name=k loop=$DATA_TB4}-->
													 
													<TR>
															
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB4[k].nama_negara}--></TD>
															<TD class="tdatacontent"   nowrap>
															 
															
															 <input name="Button" type="button" class="button" style="cursor: hand;" onclick="goDetailNegara('<!--{$DATA_TB4[k].kode_negara}-->','<!--{$TAHUN}-->','<!--{$BULAN}-->','<!--{$KODE_KASUS}-->','<!--{$KODE_NEGARA}-->','<!--{$KODE_KLASIFIKASI_WNI}-->','<!--{$KODE_SEKTOR}-->','<!--{$KODE_JENIS}-->','<!--{$JK}-->','<!--{$USIA}-->')" value=" <!--{$DATA_TB4[k].orang}--> " /> 
															 
															
															</TD>
															

													</TR>
												 
															 
														
													<!--{/section}-->
										 
										 

										<TR>
											<Th class="tdatahead" align="right" ><b>TOTAL </b></th>	
											<Th class="tdatahead" align="left" ><!--{$TOTAL_JML_NEGARA}--> </th>	
									  
										</TR>


								 
										
									</tbody>
									</TABLE>	



	 
										</TD> 
										

								</TR>									
							</TABLE></TD>	
								</TR>	
							</TABLE>


									<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/grafik.jpg"  width="55"  height="55" style="cursor:pointer" align="absmiddle"  onMouseOver="document.frmList.print_desc.value='Grafik';"  onclick="window.open('../../../libchart/grafik/rekap_kasus_pilihan.php?<!--{$VAR_CARI}-->',null,'height=600,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')" >
									&nbsp;&nbsp;
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';"   
									onClick = "window.open('<!--{$FILES}-->');">							
									</div>
					</FORM>


					<!--{/if}-->

	</DIV>

</BODY>
</HTML>