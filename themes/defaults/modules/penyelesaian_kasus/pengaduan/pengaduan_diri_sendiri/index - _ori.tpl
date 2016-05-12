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
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>
		
		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> DATA PENGADUAN</td></tr> 
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Form Add/Edit Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
		<TR>
				<TD>Kode Pengaduan</TD>
					<TD><INPUT TYPE="text" NAME="kode_form_pengaduan" value="<!--{$EDIT_NO_PASPOR}-->" size="35"></TD>
				</TR>
				<TR>
					<TD>Jenis Pelapor</TD>
					<TD><select name="kode_jenis_pelapor" > 
						<option value=""> Pilih Pelapor </option>
						<!--{section name=x loop=$DATA_JENIS_PELAPOR}-->
						<!--{if trim($DATA_JENIS_PELAPOR[x].kode_perwakilan) == _KODE_PERWAKILAN}-->
						<option value="<!--{$DATA_JENIS_PELAPOR[x].jenis_pelapor}-->" selected > <!--{$DATA_JENIS_PELAPOR[x].nm_perwakilan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_JENIS_PELAPOR[x].id}-->"  > <!--{$DATA_JENIS_PELAPOR[x].jenis_pelapor}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>		 </TD>
				</TR>
				
				<TR>
					<TD>Laporan Melalui</TD>
					<TD><select name="kode_via" > 
						<option value=""> Pilih Media Laporan</option>
						<!--{section name=x loop=$DATA_MEDIA_PELAPOR}-->
						<!--{if trim($DATA_MEDIA_PELAPOR[x].kode_perwakilan) == DATA_MEDIA_PELAPOR}-->
						<option value="<!--{$DATA_MEDIA_PELAPOR[x].id}-->" selected > <!--{$DATA_MEDIA_PELAPOR[x].media_laporan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_MEDIA_PELAPOR[x].id}-->"  > <!--{$DATA_MEDIA_PELAPOR[x].media_laporan}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>		 </TD>
				</TR>
				<TR>
					<TD>Nama TKI/WNI</TD>
					<TD>
						<select name="kode_wni" onChange="cari_wni(this.value);"> 
						<option value=""> Pilih Nama WNI/TKI </option>
						<!--{section name=x loop=$DATA_WNI_TKI}-->
						<!--{if trim($DATA_WNI_TKI[x].kode_wni) == $EDIT_NO_PROP}-->
						<option value="<!--{$DATA_WNI_TKI[x].kode_wni}-->" selected > <!--{$DATA_WNI_TKI[x].nama}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_WNI_TKI[x].kode_wni}-->"  > <!--{$DATA_WNI_TKI[x].nama}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>				
					</TD>	
				</TR>
				<tr><td>Pemberi Kerja</td><td><div id="ajax_nama_wni"><input name="nama" type="text" size="35" maxlength="200" readonly></td></tr>
				<tr><td>Pemberi Kerja</td><td><div id="ajax_nama_wni"><input name="nama" type="text" size="35" maxlength="200" readonly></td></tr>
				<TR>
					<TD>Perwakilan</TD>
					<TD><select name="kode_perwakilan" > 
						<option value=""> Pilih Perwakilan </option>
						<!--{section name=x loop=$DATA_PWK}-->
						<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
						<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->" selected > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"  > <!--{$DATA_PWK[x].nm_perwakilan}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>		 </TD>
				</TR>
				<TR>
					<TD>Alamat Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="alamat_ln" value="<!--{$EDIT_NO_PASPOR}-->" size="35"></TD>
					<TD></TD>
					<TD>Telepon Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="telepon_ln" value="<!--{$EDIT_NO_PASPOR}-->" size="35"></TD>
				</TR>
 
				<TR>
					<TD>Jenis Pengaduan</TD>
					<TD><select name="jenis_pengaduan" > 
						<option value=""> Pilih Jenis Pengaduan</option>
						<!--{section name=x loop=$DATA_MAST_PENGADUAN}-->
						<!--{if trim($DATA_MAST_PENGADUAN[x].kode_pengaduan) == DATA_MAST_PENGADUAN}-->
						<option value="<!--{$DATA_MAST_PENGADUAN[x].kode_pengaduan}-->" selected > <!--{$DATA_MAST_PENGADUAN[x].nama_pengaduan}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_MAST_PENGADUAN[x].kode_pengaduan}-->"  > <!--{$DATA_MAST_PENGADUAN[x].nama_pengaduan}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>		 </TD>
				</TR>

			<TR>
					<TD>Jenis Kasus</TD>
					<TD>
						<select name="jenis_kasus"  > 
						<option value=""> Pilih Kasus </option>
						<!--{section name=x loop=$DATA_MAST_KASUS}-->
						<!--{if trim($DATA_AGAMA[x].kode_kasus) == $DATA_MAST_KASUS}-->
						<option value="<!--{$DATA_MAST_KASUS[x].kode_kasus}-->" selected > <!--{$DATA_MAST_KASUS[x].nama_kasus}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_MAST_KASUS[x].kode_kasus}-->"  > <!--{$DATA_MAST_KASUS[x].nama_kasus}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>				
					</TD>	
				</TR>
			 <TR>
				<TD>Kronologi Permasalahan</TD>
				<TD><textarea cols="50" rows="3" name="kronologis_permasalahan"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			<TD></TD>
					
			</TR>
				 <TR>
				<TD>Permohonan Bantuan</TD>
				<TD><textarea cols="50" rows="3" name="bantuan"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
			
					 <TR>
				<TD>Kode kerja TKI</TD>
				<TD><input type="text" size="20" name="kode_kerja_tki"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
			 <TR>
				<TD>No Identitas Pelapor</TD>
				<TD><input type="text" size="20" name="no_identitas_pelapor"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
			 <TR>
				<TD>Nama Pelapor</TD>
				<TD><input type="text" size="20" name="nama_pelapor"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
			 <TR>
				<TD>Alamat Pelapor</TD>
				<TD><input type="text" size="20" name="alamat_pelapor_ind"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
			 <TR>
				<TD>Telepon Pelapor Indonesia</TD>
				<TD><input type="text" size="20" name="tlp_pelapor_ind"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
					 <TR>
				<TD>telepon pelapor Luar Negeri</TD>
				<TD><input type="text" size="20" name="tlp_pelapor_ln"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
					 <TR>
				<TD>Nama Kontak Keluarga</TD>
				<TD><input type="text" size="20" name="nama_kontak_kel"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
					 <TR>
				<TD>Alamat keluarga</TD>
				<TD><textarea cols="50" rows="3" name="alamat_kel"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			<TD></TD></TR>
				<TR>
				<TD>Telepon Keluarga</TD>
				<TD><input type="text" size="20" name="tlp_kel"><!--{$EDIT_ALAMAT}--></textarea> </TD>
			</TR>
				
				<TR><td height="40"></td>
					<TD>
					 
				 
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
					</TD>
				</TR>
			</TABLE>
		</FORM>
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
			<TR>
								<TD>Kode Pengaduan</TD>
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
							
							<TR>
								<TD>No. KTP WNI</TD>
								<TD><INPUT TYPE="text" NAME="kode_wni_cari" size="30"></TD>
							</TR>
							<TR>
								<TD>Nama WNI </TD>
								<TD><INPUT TYPE="text" NAME="nama_wni_cari" size="30"></TD>
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
		<tr><td class="tcat"> Data Pengaduan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar WNI</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead">No</TH>
											<th class="tdatahead">No. Ktp</TH>
											<th class="tdatahead">No. Paspor</TH>
											<th class="tdatahead">Nama WNI</TH>
											<th class="tdatahead">Daerah Asal</TH>
											<th class="tdatahead">Perwakilan</TH>
											<th class="tdatahead">Jenis WNI</TH>
											 <th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].kode_wni}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].no_paspor}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_kabupaten}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nm_perwakilan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_jenis}--> </TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="7" align="center">Sorry, your query has not been successful, please try again</TD>
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