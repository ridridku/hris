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
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

<div id="add-search-box">
 
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>
		
		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Tindak Lanjut PWNI</td></tr> 
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Add/Edit Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
				<TABLE id="table-add-box">
				<TR>
					<TD width="150"> No Pengaduan</TD>
					<TD>:</TD>
					<TD><!--{$KODE_FORM_PENGADUAN}--></TD>	
				</TR>

				<TR>
					<TD>Tanggal Pengaduan</TD>
					<TD>:</TD>
					<TD><!--{$TGL_PENGADUAN}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Perwakilan</TD>
					<TD>:</TD>
					<TD><!--{$NM_PERWAKILAN}-->&nbsp;</TD>	
				</TR>
 
				<TR>
					<TD>  Kasus</TD>
					<TD>:</TD>
					<TD>	 <!--{section name=y loop=$DATA_TB4}-->
											 												
								  - <!--{$DATA_TB4[y].nama_kasus}--> <BR>
										 
							 <!--{/section}--> </TD>	
				</TR>

				<TR>
					<TD>Via Pengaduan</TD>
					<TD>:</TD>
					<TD><!--{if ($KODE_VIA==1)}--> Datang Langsung <!--{/if}--> 
					<!--{if ($KODE_VIA==2)}--> Telepon <!--{/if}-->
					<!--{if ($KODE_VIA==3)}--> Web Online <!--{/if}-->
					&nbsp;</TD>	
				</TR>


				<TR>
					<TD>Kronologis</TD>
					<TD>:</TD>
					<TD><!--{$KRONOLOGIS_PERMASALAHAN}-->&nbsp;</TD>	
				</TR>


				<TR>
					<TD>Permohonan Bantuan</TD>
					<TD>:</TD>
					<TD><!--{$BANTUAN}-->&nbsp;</TD>	
				</TR>


				<TR>
					<TD colspan="3">&nbsp;</TD>	
				</TR>
				

<!--{if ($KODE_KAT_KASUS==1 OR $KODE_KAT_KASUS==2 OR $KODE_KAT_KASUS==3  ) }-->

				<TR>
					<TD colspan="3"><b>DATA WNI/TKI/ABK </b></TD>	
				</TR>

				<TR>
					<TD>No Pasport </TD>
					<TD>:</TD>
					<TD><!--{$KODE_WNI}-->&nbsp;</TD>	
				</TR>
				
				<TR>
					<TD>No KTP</TD>
					<TD>:</TD>
					<TD><!--{$NO_PASPOR}-->&nbsp;</TD>	
				</TR>
<!--{/if}-->

 

<!--{if ($KODE_KAT_KASUS==1 OR $KODE_KAT_KASUS==2 OR $KODE_KAT_KASUS==3  ) }-->

				<TR>
					<TD>Nama</TD>
					<TD>:</TD>
					<TD><!--{$NAMA}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD>Alamat di Indonesia</TD>
					<TD>:</TD>
					<TD><!--{$ALAMAT}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD>Tlp di Indonesia</TD>
					<TD>:</TD>
					<TD><!--{$TLP}-->&nbsp;</TD>	
				</TR>
 
<!--{/if}-->

<!--{if ($KODE_KAT_KASUS==3 ) }-->


				<TR>
					<TD>Nama Kapal</TD>
					<TD>:</TD>
					<TD><!--{$NAMA_KAPAL}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD>Bendera</TD>
					<TD>:</TD>
					<TD><!--{$BENDERA}-->&nbsp;</TD>	
				</TR>
<!--{/if}-->


<!--{if ($KODE_KAT_KASUS==5 ) }-->


<TR>
					<TD colspan="3"><b>DATA BHI</b></TD>	
				</TR>

<TR>

					<TD>Nama BHI</TD>
					<TD>:</TD>
					<TD><!--{$NAMA}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD>Alamat BHI</TD>
					<TD>:</TD>
					<TD><!--{$ALAMAT}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD>Tlp BHI</TD>
					<TD>:</TD>
					<TD><!--{$TLP}-->&nbsp;</TD>	
				</TR>
<!--{/if}-->

<!--{if ($KODE_JENIS_PELAPOR==2)}-->
	<TR>
					<TD colspan="3">&nbsp;</TD>	
				</TR>
				<TR>
					<TD colspan="3">DATA PELAPOR</TD>	
				</TR>

				<TR>
					<TD>No Identitas</TD>
					<TD>:</TD>
					<TD><!--{$NO_IDENTITAS_PELAPOR}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Nama</TD>
					<TD>:</TD>
					<TD><!--{$NAMA_PELAPOR}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Alamat di Indonesia</TD>
					<TD>:</TD>
					<TD><!--{$ALAMAT_PELAPOR_IND}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Tlp di Indonesia</TD>
					<TD>:</TD>
					<TD><!--{$TLP_PELAPOR_IND}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Alamat di Luar Negeri</TD>
					<TD>:</TD>
					<TD><!--{$ALAMAT_PELAPOR_LN}-->&nbsp;</TD>	
				</TR>
				<TR>
					<TD>Tlp di Luar Negeri</TD>
					<TD>:</TD>
					<TD><!--{$TLP_PELAPOR_LN}-->&nbsp;</TD>	
				</TR>
<!--{/if}--> 
 
<!--{if ($KODE_KAT_KASUS==11 OR $KODE_KAT_KASUS==21   ) }-->

<!--{if ($KODE_KERJA_TKI!="" OR $KODE_KERJA_TKI!=0)}-->

				<TR>
					<TD colspan="3">&nbsp;</TD>	
				</TR>
				 <TR>
					<TD colspan="3"> <b>PEMBERI KERJA YANG DILAPORKAN</b></TD>	
				</TR>
				<TR>
					<TD> Pemberi Kerja </TD>
					<TD>:</TD>
					<TD><!--{$NAMA_MAJIKAN}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD> Alamat Pemberi Kerja </TD>
					<TD>:</TD>
					<TD><!--{$ALAMAT_MAJIKAN}-->&nbsp;</TD>	
				</TR>
  
				<TR>
					<TD> PPTKIS</TD>
					<TD>:</TD>
					<TD><!--{$NAMA_PJTKI}-->&nbsp;</TD>	
				</TR>

				<TR>
					<TD> PJTKA</TD>
					<TD>:</TD>
					<TD><!--{$NAMA_PJTKA}-->&nbsp;</TD>	
				</TR>


<!--{/if}--> 
<!--{/if}--> 
  
 
			</TABLE>
  	</FORM>
	<div id="ajax_input2">
 
  	<TABLE id="table-add-box" width="90%"  >
						<TR>
							<td  colspan="3" align="left"> 
							<input type="button"  class=btn3 value="&nbsp;&nbsp;&nbsp;Tambah&nbsp;&nbsp;&nbsp;"   OnClick="JavaScript:Ajax('ajax_input2','<!--{$HREF_HOME_PATH_AJAX}-->/form.php?op=0&kode_form_pengaduan=<!--{$KODE_FORM_PENGADUAN}-->&kode_kat_kasus=<!--{$KODE_KAT_KASUS}-->&mod_id=<!--{$MOD_ID}-->')"> 

							<input type="button"  class=btn3 value="&nbsp;&nbsp;&nbsp;Kembali >> &nbsp;&nbsp;&nbsp;"   onclick="resetFrm('<!--{$MOD_ID}-->','<!--{$STR_COMPLETER_}-->'); " > 


							</td>
						</tr>
						<TR>
							<td  colspan="3" align="center"> DAFTAR TINDAK TANJUT PENGADUAN KASUS OLEH PWNI
							
							</td>
						</tr>
						<TR>
							<td  colspan="3" align="center">
													<table width="100%">
													<tr>
													<th class="thead"    >No Berita</TH>

													<th class="thead" width="20%" >Tanggal</TH>
													<th class="thead" width="20%">Jenis Tindak Lanjut</TH>													 
													<th class="thead" width="25%">Tindak Lanjut yang dilakukan</TH>												
													<th class="thead" >Keterangan</TH>													 
													<th class="thead" width="5%" colspan=2>Aksi</TH>													
													</tr>
													 
													<!--{section name=x loop=$DATA_TB2}-->	
													 
 

													<tr class='<!--{cycle values="alt,alt3"}-->'>
													<td class="tdatacontent"  ><!--{$DATA_TB2[x].no_berita}--></td>

														<td class="tdatacontent" nowrap> 
														 <!--{$DATA_TB2[x].tanggal_tl}-->
														<!--{if ($DATA_TB2[x].bulan_tl==1)}--> Januari <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==2)}--> Februari <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==3)}--> Maret <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==4)}--> April <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==5)}--> Mei <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==6)}--> Juni <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==7)}--> Juli <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==8)}--> Agustus <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==9)}--> September <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==10)}--> Oktober <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==11)}--> November <!--{/if}-->
														<!--{if ($DATA_TB2[x].bulan_tl==12)}--> Desember <!--{/if}-->
														<!--{$DATA_TB2[x].tahun_tl}-->
													   </td>
												 												 
														<td class="tdatacontent" nowrap>
														<!--{if ($DATA_TB2[x].kode_jenis_tl ==  1) }--> Direspons Secara Internal <!--{/if}--> 
														<!--{if ($DATA_TB2[x].kode_jenis_tl ==  2) }--> Didisposisi Kepada Pihak Terkait<!--{/if}--> 
														
														 </td>
														
														<td class="tdatacontent"  ><!--{$DATA_TB2[x].tindak_lanjut}--></td>
														<td class="tdatacontent"  ><!--{$DATA_TB2[x].perkembangan}--></td>
														 

														<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$EDIT}-->"OnClick="JavaScript:Ajax('ajax_input2','<!--{$HREF_HOME_PATH_AJAX}-->/form.php?op=2&kode_tl=<!--{$DATA_TB2[x].kode_tl}-->&kode_form_pengaduan=<!--{$DATA_TB2[x].kode_form_pengaduan}-->&kode_kat_kasus=<!--{$KODE_KAT_KASUS}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->')"> </td>
														
 

														<td width="20" class="tdatacontent" ALIGN="CENTER">									  
													 
															<IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=3&kode_tl=<!--{$DATA_TB2[x].kode_tl}-->&kode_kat_kasus=<!--{$KODE_KAT_KASUS}-->&kode_form_pengaduan=<!--{$DATA_TB2[x].kode_form_pengaduan}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink">
 
														</td>
 

													</tr>

													<!--{sectionelse}-->
													<tr>
														<td class="tdatacontent" COLSPAN="8" align="center">Data Tindak Lanjut Belum Ada</td>
													</tr>
													<!--{/section}-->







													 
						<TR>
							<td  colspan="5" align="center">
							 <br>

						

							</td>
						</tr>
						</table>
							</td>
						</tr>

	</TABLE>
	</DIV>

	
		</td></tr>
		</table>
		</DIV>	
		
	<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
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
								<TD>Kategori Kasus</TD>
								<TD>	
								<select name="pil_kategori"> 
								<option value=""> </option>
								<option value="1">WNI/TKI/ABK</option>
								 
								 
								<option value="5">BHI</option></TD>
							</TR>

<!--{if ($JENIS_USER_SES=='1')}-->

			<TR>
								<TD>Perwakilan</TD>
								<TD><select name="kode_perwakilan_cari" > 
									<option value=""> Pilih Perwakilan </option>
									<!--{section name=x loop=$DATA_PWK}-->
									<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{else}-->
									<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
									<!--{/if}-->
									<!--{/section}-->
									</select>		</TD>
							</TR>
			<!--{/if}-->					
							<TR>
								<TD>No. Paspor </TD>
								<TD>
								 
								<INPUT TYPE="text" NAME="kode_wni_cari" size="30"></TD>
							</TR>
							<TR>
								<TD>Nama</TD>
								<TD>
								 
								
								<INPUT TYPE="text" NAME="nama_wni_cari" size="30"></TD>
							</TR>
							<TR>
								<TD>Tahun</TD>
								<TD><INPUT TYPE="text" NAME="tahun_cari" size="30"></TD>
							</TR>

							 
			<TR><TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="search" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="0">
				<CENTER>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</CENTER>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></div>	
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Tindak Lanjut Kasus Oleh PWNI</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0">Daftar Tindak Lanjut Kasus</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead">No</TH>
											<th class="tdatahead">Kode Pengaduan</TH>
											<th class="tdatahead">Kategori</TH>
											<th class="tdatahead">Nama WNI/TKI/ABK/BHI</TH>											 
										 
											<th class="tdatahead">Jenis Kasus</TH>
											<th class="tdatahead">Perwakilan</TH>
											<th class="tdatahead">Pelaporan Via</TH>
											<th class="tdatahead">Tanggal lapor</TH>
											 <th class="tdatahead"  ><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
				<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].kode_form_pengaduan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{if ($DATA_TB[x].kode_kat_kasus==1)}-->WNI<!--{/if}-->
											<!--{if ($DATA_TB[x].kode_kat_kasus==2)}-->TKI<!--{/if}-->
											<!--{if ($DATA_TB[x].kode_kat_kasus==3)}-->ABK<!--{/if}-->			 
											<!--{if ($DATA_TB[x].kode_kat_kasus==5)}-->BHI<!--{/if}-->
											</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama}-->  </TD>
							 
											<TD class="tdatacontent" nowrap> 

											<!--{section name=y loop=$DATA_TB3}-->
												<!--{if ($DATA_TB3[y].kode_form_pengaduan==$DATA_TB[x].kode_form_pengaduan)}-->													
													 - <!--{$DATA_TB3[y].nama_kasus}--> <BR>
												<!--{/if}-->
											<!--{/section}--> 
											
											
											</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nm_perwakilan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{if ($DATA_TB[x].kode_via==1)}--> Datang Langsung <!--{/if}--> 
											<!--{if ($DATA_TB[x].kode_via==2)}--> Telepon <!--{/if}--> 
											<!--{if ($DATA_TB[x].kode_via==3)}--> Web Online <!--{/if}--> 

											</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].tanggal_a}-->
											<!--{if ($DATA_TB[x].bulan_a==1)}--> Januari <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==2)}--> Februari <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==3)}--> Maret <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==4)}--> April <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==5)}--> Mei <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==6)}--> Juni <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==7)}--> Juli <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==8)}--> Agustus <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==9)}--> September <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==10)}--> Oktober <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==11)}--> November <!--{/if}-->
											<!--{if ($DATA_TB[x].bulan_a==12)}--> Desember <!--{/if}-->
											<!--{$DATA_TB[x].tahun_a}-->
											</TD>
											 
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&kode_kat_kasus=<!--{$DATA_TB[x].kode_kat_kasus}-->&kode_form_pengaduan=<!--{$DATA_TB[x].kode_form_pengaduan}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											 
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="10" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Show</td>
<td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
		<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Record : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> of <!--{$COUNT}--></td>
<td align="right"><!--{$NEXT_PREV}--></td>
</tr>
</table>
</div>				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>