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
							<TD>Propinsi</TD>
							<TD>
					 
								<select name="no_propinsi" onchange="cari_kab(this.value);"> 
						<option value="">[Pilih Provinsi]</option>
						<!--{section name=x loop=$DATA_PROPINSI}-->
						<!--{if trim($DATA_PROPINSI[x].no_propinsi) == $EDIT_NO_PROP}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>	
	
							</TD></TR>
						<TR><TD>Kabupaten/Kota</TD> <TD>
					 
						 <div id="ajax_kabupaten">
						<select name="id_kab" > 
						<option value="">[Pilih Kabupaten]</option>
						<!--{section name=x loop=$DATA_KABUPATEN}-->
						<!--{if trim($DATA_KABUPATEN[x].id_kabupaten) == $SES_ID_KAB}-->
						<option value="<!--{$DATA_KABUPATEN[x].id_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_KABUPATEN[x].id_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
						<!--{/if}-->
						<!--{/section}-->
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
		<tr><td class="tcat">LAPORAN REKAP TKI/WNI </td></tr>
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

				<!--{if ($NAMA_KLASIFIKASI !='') }-->
											<tr><td class="tdatacontent"  width="100" >KLASIFIKASI WNI</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_KLASIFIKASI}--> &nbsp;</td></tr>
				<!--{/if}-->

				<!--{if ($NAMA_JENIS !='') }-->
											<tr><td class="tdatacontent"  width="100" >JENIS WNI</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_JENIS}--> &nbsp;</td></tr>
				<!--{/if}-->




				<!--{if ($NAMA_PROPINSI !='') }-->
											<tr><td class="tdatacontent"  width="100" >PROPINSI</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_PROPINSI}--> &nbsp;</td></tr>
				<!--{/if}-->

				<!--{if ($NAMA_KABUPATEN !='') }-->
											<tr><td class="tdatacontent"  width="100" >KABUPATEN</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_KABUPATEN}--> &nbsp;</td></tr>
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
										<TR>
											<TH  class="tdatahead">PERWAKILAN</TH>
											<TH   class="tdatahead">JML WNI </TH>
											 

										</TR> 	
										 		 
												<!--{section name=x loop=$DATA_TB}-->
														
													<TR>
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB[x].nm_perwakilan}--></TD>
															<TD class="tdatacontent"   nowrap><!--{$DATA_TB[x].jml_wni}--></TD>
															 
													</TR>
															 
														
												 <!--{/section}-->
													

											 <TR>
											<TD class="tdatacontent" > TOTAL   </TD>
											<TD class="tdatacontent" ><!--{$TOTAL_WNI}--> </TD>
											 </TR>

										</TR> 		 

										
									</tbody>
									</TABLE>
									 <br>
							 
										 
										</TD> 
										  

								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>

											
							 

 <div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" onMouseOver="document.frmList.print_desc.value='Grafik';" style="background:transparant;border:0;">
 <IMG SRC="<!--{$HREF_IMG_PATH}-->/grafik.jpg"  width="55"  height="55" style="cursor:pointer" align="absmiddle"   onMouseOver="document.frmList.print_desc.value='Grafik';"  onclick="window.open('../../../libchart/grafik/rekap_wni.php?<!--{$VAR_CARI}-->',null,'height=600,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes,left=0,top=0,screenX=0,screenY=0')" >
 &nbsp;&nbsp;
 <IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';"  
 onClick = "window.open('<!--{$FILES}-->');">							
 </div>
 </FORM>


 <!--{/if}-->

	</DIV>

</BODY>
</HTML>