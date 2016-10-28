<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title>
	<!--{$TITLE}--></title>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css"
	type="text/css">
<script language="JavaScript" type="text/javascript">

n=document.layers
ie=document.all

//Hides the layer onload
function hideIt()
{
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
		<tr>
			<td width="100%" height="100%" align="center" valign="middle"><img
				src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle">
				Loading Page....</td>
		</tr>
	</table>
</div>
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css"
	type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<link rel="stylesheet"
	href="<!--{$HREF_CSS_PATH}-->/dhtmlgoodies_calendar.css"
	type="text/css">
<SCRIPT LANGUAGE="JavaScript"
	SRC="<!--{$HREF_JS_PATH}-->/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/tw-sack.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage"
	onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

	<div id="add-search-box">
		<a class="button" href="#"
			onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;"
			<!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img
				src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}-->
		
		</a></span> <a class="button" href="#"
			onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img
				src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle">
				Search By</span> </a>
	</div>

	<DIV ID="_menuEntry1_1"
		style="top: 10px; width: 100%; display: none; position: absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0"
			width="100%" align="center" style="border-bottom-width: 0px">
			<tr>
				<td class="tcat">DATA PENGADUAN</td>
			</tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0"
			width="100%" align="center">
			<tr>
				<td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif"
					align="absmiddle" border="0"> Form Add/Edit Data</td>
			</tr>
			<tr>
				<td class="alt2" style="padding: 0px;">

					<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
						<TABLE id="table-add-box">
							<TR>
								<TD>Jenis Pelapor</TD>
								<TD><select name="jenis_pelapor"
									OnChange="JavaScript:Ajax('ajax_input1','<!--{$HREF_HOME_PATH_AJAX}-->/jenis_pelapor.php?jenis_pelapor='+this.value+'&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->')">
										<option>Diri Sendiri</option>
										<option value="2">Orang Lain</option>
								</select>
								</TD>
							</TR>
							<TR>
							
							
							<TR>
								<TD>Kategori Kasus</TD>
								<TD><select name="wni_non_tki"
									OnChange="JavaScript:Ajax('ajax_input3','<!--{$HREF_HOME_PATH_AJAX}-->/wni_non_tki.php?wni_non_tki='+this.value+'&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->')">
										<OPTION value="">[Pilih Kasus]</OPTION>
										<option value="1">WNI NON TKI</option>
										<option value="2">TKI</option>
										<option value="3">ABK</option>
										<option value="4">LOCAL STAFF</option>
										<option value="5">BHI</option>
								</select>
								</TD>
							</TR>
							<TR>
								<TD>Nama TKI/WNI</TD>
								<TD><select name="kode_wni" onChange="cari_wni(this.value);">
										<option value="">Pilih Nama WNI/TKI</option>
										<!--{section name=x loop=$DATA_WNI_TKI}-->
										<!--{if trim($DATA_WNI_TKI[x].kode_wni) == $EDIT_NO_PROP}-->
										<option value="<!--{$DATA_WNI_TKI[x].kode_wni}-->" selected>
											<!--{$DATA_WNI_TKI[x].nama}-->
										</option>
										<!--{else}-->
										<option value="<!--{$DATA_WNI_TKI[x].kode_wni}-->">
											<!--{$DATA_WNI_TKI[x].nama}-->
										</option>
										<!--{/if}-->
										<!--{/section}-->
								</select></TD>
							</TR>
							<TR>
								<TD colspan="2">
									<div id="ajax_input3"></div>
								</TD>
							</TR>
							<TR>
								<TD colspan="2">
									<div id="ajax_input1"></div>
								</TD>
							</TR>
							<TR>
								<td height="40"></td>
								<TD><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
									<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->"> <INPUT
									TYPE="hidden" name="SORT" value="<!--{$SORT}-->"> <INPUT
									TYPE="hidden" name="page" value="<!--{$page}-->"> <INPUT
									TYPE="hidden" name="op" value="0"> <a class="button" href="#"
									onclick="this.blur();return checkFrm(frmCreate);"><span><img
											src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif"
											align="absmiddle"> <!--{$SUBMIT}--> </span> </a> <a
									class="button" href="#"
									onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img
											src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif"
											align="absmiddle"> <!--{$RESET}--> </span> </a></TD>
							</TR>
						</TABLE>
					</FORM></td>
			</tr>
		</table>
	</DIV>
	<DIV ID="_menuEntry2_1"
		style="top: 10px; width: 100%; position: absolute;">
		<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
			<!--DIVIDER HERE-->
			<TR>
				<TD>
					<DIV ID="_menuEdit_1">

						<div id="panel-box">
							<div id="title-box2">Pencarian Data</div>
							<div id="title-box-close">
								<img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif"
									onClick="document.getElementById('_menuEdit_1').style.display='none';"
									align="absmiddle" class="imgLink" title="Close">
							</div>
							<div id="panel-content">

								<FORM METHOD=GET ACTION="" NAME="frmList1">
									<TABLE id="table-search-box">
										<TR>
											<TD>Kode Pengaduan</TD>
											<TD><select name="kode_perwakilan_cari">
													<option value="">Pilih Perwakilan</option>
													<!--{section name=x loop=$DATA_PWK}-->
													<!--{if trim($DATA_PWK[x].kode_perwakilan) == $EDIT_KODE_PERWAKILAN}-->
													<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->"
														selected>
														<!--{$DATA_PWK[x].nm_perwakilan}-->
													</option>
													<!--{else}-->
													<option value="<!--{$DATA_PWK[x].kode_perwakilan}-->">
														<!--{$DATA_PWK[x].nm_perwakilan}-->
													</option>
													<!--{/if}-->
													<!--{/section}-->
											</select>
											</TD>
										</TR>

										<TR>
											<TD>No. KTP WNI</TD>
											<TD><INPUT TYPE="text" NAME="kode_wni_cari" size="30"></TD>
										</TR>
										<TR>
											<TD>Nama WNI</TD>
											<TD><INPUT TYPE="text" NAME="nama_wni_cari" size="30"></TD>
										</TR>

										<TR>
											<TD></TD>
											<TD><INPUT TYPE="hidden" name="mod_id"
												value="<!--{$MOD_ID}-->"> <INPUT TYPE="hidden" name="limit"
												value="<!--{$LIMIT}-->"> <INPUT TYPE="hidden" name="search"
												value="1"> <INPUT TYPE="hidden" name="SORT"
												value="<!--{$SORT}-->"> <INPUT TYPE="hidden" name="page"
												value="<!--{$page}-->"> <INPUT TYPE="hidden" name="op"
												value="0">
												<CENTER>
													<a class="button" href="#"
														onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';"
														onSubmit="frmCreate.page.value='1'; return false;"><span><img
															src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif"
															align="absmiddle"> <!--{$SUBMIT}--> </span> </a> <a
														class="button" href="#"
														onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img
															src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif"
															align="absmiddle"> <!--{$RESET}--> </span> </a>
												</CENTER>
											</TD>
										</TR>
									</TABLE>
								</FORM>
							</div>
						</div>
					</DIV>

					<FORM METHOD=GET ACTION="" NAME="frmList">
						<table class="tborder" cellpadding="6" cellspacing="1" border="0"
							width="100%" align="center" style="border-bottom-width: 0px">
							<tr>
								<td class="tcat">Data Pengaduan</td>
							</tr>
						</table>
						<table class="tborder" cellpadding="6" cellspacing="1" border="0"
							width="100%" align="center">
							<tr>
								<td class="thead"><img
									src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif"
									align="absmiddle" border="0"> Daftar WNI</td>
							</tr>
							<tr>
								<td class="alt2" style="padding: 0px;">
									<table width="100%">
										<tr>
											<th class="tdatahead">No</TH>
											<th class="tdatahead">No. Ktp</TH>
											<th class="tdatahead">No. Paspor</TH>
											<th class="tdatahead">Nama WNI</TH>
											<th class="tdatahead">Daerah Asal</TH>
											<th class="tdatahead">Perwakilan</TH>
											<th class="tdatahead">Jenis WNI</TH>
											<th class="tdatahead" COLSPAN="2">
												<!--{$ACTION}--></th>
										</tr>
										</thead>
										<tbody>
											<!--{section name=x loop=$DATA_TB}-->
											<tr class='<!--{cycle values="alt,alt3"}-->'>
												<td width="17" class="tdatacontent-first-col">
													<!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].kode_wni}-->
												</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].no_paspor}-->
												</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].nama}-->
												</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].nama_kabupaten}-->
												</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].nm_perwakilan}-->
												</TD>
												<TD class="tdatacontent" nowrap>
													<!--{$DATA_TB[x].nama_jenis}-->
												</TD>
												<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG
													SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12"
													HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->"
													onclick="return checkEdit('<!--{$SELF}-->?opt=1&id=<!--{$DATA_TB[x].id}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');"
													class="imgLink"></TD>
												<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG
													SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12"
													HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->"
													onclick="return checkDelete('engine.php?op=2&id=<!--{$DATA_TB[x].id}--> &mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');"
													class="imgLink"></TD>
											</TR>
											<!--{sectionelse}-->
											<TR>
												<TD class="tdatacontent" COLSPAN="7" align="center">Maaf, Data masih kosong</TD>
											</TR>
											<!--{/section}-->
										</tbody>
									</table>
									<div id="panel-footer">
										<table width="100%">
											<tr class="text-regular">
												<td width="20">Show</td>
												<td width="35"><INPUT TYPE="hidden" name="mod_id"
													value="<!--{$MOD_ID}-->"> <SELECT NAME="limit"
													onchange="this.form.page.value='1'; this.form.submit();"
													class="text-paging">
														<!--{section name=x loop=$LISTVAL}-->
														<OPTION VALUE="<!--{$LISTVAL[x]}-->"
															<!--{if $LISTVAL[x]==$LIMIT}-->
															SELECTED
															<!--{/if}-->
															>
															<!--{$LISTVAL[x]}-->
														</OPTION>
														<!--{/section}-->
												</SELECT></td>
												<td>Record : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> of <!--{$COUNT}-->
												</td>
												<td align="right">
													<!--{$NEXT_PREV}--></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>

					</form>

					<div id="div-bg-note-trans">
						<img src="<!--{$HREF_IMG_PATH}-->/layout/note.png">
					</div>

					</DIV>

</BODY>
</HTML>
