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
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Loading Page....
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
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
<!--{if $SEARCH_YEAR<>""}-->
<a class="button" href="#" onClick = "window.open('<!--{$FILES}-->');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/print.gif" align="absmiddle"> &nbsp;Print</span></a>
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
							<TD>Satker</TD>
							<TD>
						<!--{if ($SES_JENIS_USER==1)}-->

						 
								<SELECT name="kode_instansi"  style="width:200px"   onChange="cari_proyek(frmList1.tahun_anggaran.value,frmList1.kode_instansi.value);" > 				  
								<OPTION VALUE="" selected>[Pilih Instansi]</OPTION>
								<!--{section name=x loop=$DATA_INSTANSI}-->						 
									<!--{if ($DATA_INSTANSI[x].kode_instansi) == $SES_INSTANSI}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_instansi}-->" selected  > <!--{$DATA_INSTANSI[x].nama_instansi}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_INSTANSI[x].kode_instansi}-->"  > <!--{$DATA_INSTANSI[x].nama_instansi}--> </option>
									<!--{/if}-->
									<!--{/section}-->
								</SELECT>

					<!--{else}-->


						<SELECT name="kode_instansi"  style="width:200px"  > 				  
						<OPTION VALUE="" selected>[Pilih Instansi]</OPTION>
						<!--{section name=x loop=$DATA_INSTANSI}-->						 
							<!--{if ($DATA_INSTANSI[x].kode_instansi) == $SES_INSTANSI}-->
							<option value="<!--{$DATA_INSTANSI[x].kode_instansi}-->" selected  > <!--{$DATA_INSTANSI[x].nama_instansi}--> </option>
							<!--{else}-->
							<option value="<!--{$DATA_INSTANSI[x].kode_instansi}-->"  disabled > <!--{$DATA_INSTANSI[x].nama_instansi}--> </option>
							<!--{/if}-->
							<!--{/section}-->
						</SELECT>

					<!--{/if}-->

	
							</TD>
							</TR>


							<TR>
							<TD>Tahun Anggaran</TD>
							<TD><SELECT name="tahun_anggaran"  onChange="cari_proyek(this.value,frmList1.kode_instansi.value);"> 
						<OPTION VALUE="" selected>[Pilih Tahun Anggaran]</OPTION>
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
							<TD>Kegiatan</TD>
							<TD> 
							 <DIV id="ajax_proyek">
						 

									 <SELECT name="kode_proyek" onChange="cari_ruas(this.value);"  style="width:200px" >
									<OPTION VALUE="">[Pilih Kegiatan]</OPTION>
									<!--{section name=x loop=$DATA_PROYEK}-->
										<!--{if ($DATA_PROYEK[x].kode_proyek==$EDIT_KODE_PROYEK)}-->
											<option value="<!--{$DATA_PROYEK[x].kode_proyek}-->" selected> <!--{$DATA_PROYEK[x].nama_proyek}--></option>
										<!--{else}-->
											<option value="<!--{$DATA_PROYEK[x].kode_proyek}-->"> <!--{$DATA_PROYEK[x].nama_proyek}--></option>
										<!--{/if}-->
									<!--{/section}-->
									</SELECT>



							</DIV>
					
						</TD>
							</TR>

							<TR>

							<TD>Paket</TD>
							<TD> 
								 <div id="ajax_ruas">
									<SELECT name="kode_paket" id="kode_paket"> 
										<OPTION VALUE="">[Pilih Paket]</OPTION>
										 
									</SELECT> 
								</div>						
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
								<a class="button" href="#" onclick="this.blur();document.frmList1.submit(); document.frmList1.page.value='1';"  onSubmit="frmList1.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$SUBMIT}--></span></a>
								<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>					
								</TD>
							</TR>	
						</TABLE>
			</FORM>
			</div></div>	
		</DIV>
														
					<!--{if $SEARCH_YEAR<>""}--><br>
					<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat">LAPORAN PENGGUNAAN ALAT BERAT</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
								<TR>
									<TD COLSPAN="2">
									<table width="100%" class="tbheader">									
									<tr><td width="50">Instansi</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_INSTANSI}--></td></tr>
									 <tr><td>Tahun </td><td> : </td><td><!--{$SEARCH_YEAR}--></td></tr>
									<tr><td width="50">Kegiatan</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_PROYEK}--></td></tr>
									<tr><td width="50">Paket</td><td width="5"> : </td><td colspan="2"><!--{$NAMA_PAKET}--> </td></tr>
									<tr><td width="50">Lokasi</td><td width="5"> : </td><td colspan="2"> <!--{$NAMA_KABUPATEN}--></td></tr>	
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2">
									<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<thead>
									 
										<TR>
											<TH class="tdatahead">Jenis Alat</TH>
											<TH class="tdatahead">Detail Alat</TH>
											<TH class="tdatahead" width="6%">Jumlah</TH>
											<TH class="tdatahead" width="6%">Kebutuhan</TH>
											<TH class="tdatahead">Sumber</TH>		
											<TH class="tdatahead">Keterangan</TH>	
										</TR>
										 
										</thead>
										
										<tbody>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
										 
											<TD class="tdatacontent"   nowrap> <b><!--{$DATA_TB[x].nama_alat_berat}--></b></TD>
											<TD class="tdatacontent" align="right" nowrap>&nbsp;</TD>
											<TD class="tdatacontent" align="right" nowrap>&nbsp;</TD>
											<TD class="tdatacontent" nowrap> <b><!--{$DATA_TB[x].jumlah_kebutuhan}-->  Buah</b></TD>
											<TD class="tdatacontent" nowrap>&nbsp; </TD>
											<TD class="tdatacontent" nowrap>  
														<b>											
														<!--{if ($DATA_TB[x].status >  0) }--> Alat Kurang <!--{$DATA_TB[x].status}-->  <!--{/if}--> 
														<!--{if ($DATA_TB[x].status <  0) }--> Alat Lebih <!--{$DATA_TB[x].status_}-->  <!--{/if}--> 
														<!--{if ($DATA_TB[x].status ==  0) }-->    <!--{/if}--> 
														</b>														
											</TD>
										</TR>

											<!--{section name=y loop=$DATA_TB2}-->
											 
												<!--{if ($DATA_TB2[y].kode_detail_jadwal==$DATA_TB[x].kode_detail_jadwal)}-->
												<TR>										 
													<TD class="tdatacontent" nowrap>&nbsp; </TD>
													<TD class="tdatacontent"   nowrap> <!--{$DATA_TB2[y].nama_alat_detail}--> </TD>
													<TD class="tdatacontent" align="center" nowrap>1</TD>
													<TD class="tdatacontent" > &nbsp; </TD>
													<TD class="tdatacontent" > Jadwal</TD>
													<TD class="tdatacontent" nowrap> &nbsp; </TD>
												</TR>
												<!--{/if}-->

											<!--{/section}-->

												
												<!--{section name=z loop=$DATA_TB3}-->
											 
												<!--{if ($DATA_TB3[z].kode_alat_berat==$DATA_TB[x].kode_alat_berat)}-->
												<TR>										 
													<TD class="tdatacontent" nowrap>&nbsp; </TD>
													<TD class="tdatacontent"   nowrap> <!--{$DATA_TB3[z].nama_alat_detail}--> </TD>
													<TD class="tdatacontent" align="center" nowrap>1</TD>
													<TD class="tdatacontent" > &nbsp; </TD>
													<TD class="tdatacontent" > pinjam ke <!--{$DATA_TB3[z].instansi_dipinjam}-->  </TD>
													<TD class="tdatacontent" nowrap> &nbsp; </TD>
												</TR>
												<!--{/if}-->
 
											<!--{/section}-->


											<!--{section name=yy loop=$DATA_TB5}-->
											 
												<!--{if ($DATA_TB4[yy].kode_alat_berat==$DATA_TB[x].kode_alat_berat)}-->

												<TR>										 
													<TD class="tdatacontent" nowrap>&nbsp; </TD>
													<TD class="tdatacontent"   nowrap> <!--{$DATA_TB[yy].nama_alat_berat}--> </TD>
													<TD class="tdatacontent" align="center" nowrap><!--{$DATA_TB5[yy].jumlah}--></TD>
													<TD class="tdatacontent" > &nbsp; </TD>
													<TD class="tdatacontent" > Sewa dari <!--{$DATA_TB5[yy].nama}--> </TD>
													<TD class="tdatacontent" nowrap> &nbsp; </TD>
												</TR>
												<!--{/if}-->
											<!--{/section}-->

											
											<TR>
										 
											<TD class="tdatacontent"   nowrap> &nbsp;</TD>
											<TD class="tdatacontent" align="right" nowrap><b>Sub Jumlah</b></TD>
											<TD class="tdatacontent" align="center" nowrap><b><!--{$DATA_TB[x].total}-->  </b> </TD>
											<TD class="tdatacontent" nowrap>  &nbsp;</TD>
											<TD class="tdatacontent" nowrap>&nbsp; </TD>
											<TD class="tdatacontent" nowrap> &nbsp; </TD>
										</TR>




										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="16" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
										<!--{/section}-->
										</tbody>
									</TABLE></TD> 
										  <!--{section name=xx loop=$DATA_TB4}-->
										  
												<!--{if ($DATA_TB4[xx].kode_alat_berat==$DATA_TB[x].kode_alat_berat)}-->

												<TR>										 
													<TD class="tdatacontent" nowrap>&nbsp; </TD>
													<TD class="tdatacontent"   nowrap> <!--{$DATA_TB4[xx].nama_alat_detail}--> </TD>
													<TD class="tdatacontent" align="center" nowrap>1</TD>
													<TD class="tdatacontent" > &nbsp; </TD>
													<TD class="tdatacontent" > Pengadaan Alat Berat </TD>
													<TD class="tdatacontent" nowrap> &nbsp; </TD>
												</TR>

												<!--{/if}-->
											<!--{/section}-->


								</TR>	
							</TABLE></TD>	
								</TR>	
							</TABLE>


									<div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
									&nbsp;&nbsp;
									<IMG SRC="<!--{$HREF_IMG_PATH}-->/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Print';" onMouseOut="document.frmList.print_desc.value='';" 
									onClick = "window.open('<!--{$FILES}-->');">							
									</div>
					</FORM>


					<!--{/if}-->

	</DIV>

</BODY>
</HTML>