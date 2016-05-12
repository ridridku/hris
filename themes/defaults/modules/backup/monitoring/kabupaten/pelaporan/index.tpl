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

<!--{if $SEARCH_BOX==1}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{else}-->
<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
<!--{/if}-->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>
		
		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">

<!-- Tambahan 28-06-2010 -->
<tr>
<td>Kategori Jalan</td>
<td><select name="jns_jln" onChange="cari_kategori(this.value)">
<option value="">[Pilih Kategori Jalan]</option>
	<!--{section name=x loop=$DATA_JENIS_JLN}-->
	<!--{if $DATA_JENIS_JLN[x].id == $PID_JENIS_JLN}-->
	<option value="<!--{$DATA_JENIS_JLN[x].id}-->" selected > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_JENIS_JLN[x].id}-->"  > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
	<!--{/if}-->
	<!--{/section}-->
</select>
</td>
</tr>
<!-- End 0f Tambahan 28-06-2010 -->

<tr><td>Nama Propinsi</td><td>
<SELECT name="no_propinsi" onChange="cari_kabupaten2(this.value)">
<OPTION VALUE="">[Pilih Propinsi]</OPTION>
<!--{section name=x loop=$DATA_PROPINSI}-->
<!--{if trim($DATA_PROPINSI[x].no_propinsi) == trim($NO_PROPINSI)}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td></tr>
<TR>
<td width="150">Tahun</td><td><input type="text" name="tahun" value="
<!--{if $TAHUN==''}-->
<!--{$smarty.now|date_format:"%Y"}-->
<!--{else}-->
<!--{$TAHUN}-->
<!--{/if}-->" maxlength="4" size="6" OnKeyUp="validateNum(this)">
</td></tr>
<tr><td>Monitoring Oleh</td><td><input type="text" name="monitoring" value="<!--{$NAMA_MONITORING}-->" size="35">	
</td></tr>
</table>			

<div id="title-box2">Data Monitoring Pelaporan <!--{$AMBIL_ID_JNS_JLN}--></div>
<table>
<tr>
<th rowspan="2" class="tdatahead" width="25">No</th>
<th rowspan="2" class="tdatahead" width="304">Nama Kabupaten</th>
<th colspan="10" class="tdatahead">Triwulan</th>
</tr>
<tr>
<th class="tdatahead" width="34">JL-01</th>
<th class="tdatahead" width="33">JL-02</th>
<th class="tdatahead" width="32">JL-03</th>
<th class="tdatahead" width="31">JL-04</th>
<th class="tdatahead" width="120">JL-05</th>
<th class="tdatahead" width="120">JL-06</th>
<th class="tdatahead" width="120">JL-07</th>
<th class="tdatahead" width="31">JL-08</th>
<th class="tdatahead" width="33">JL-09</th>
<th class="tdatahead" width="35">JL-10</th>
</tr>
</table>
<div id="ajax_kabupaten_list">
<table width="980">
<tbody>
<!--{section name=x loop=$DATA_KABUPATEN}-->
<tr>
<td class="tdatacontent-first-col" width="25"><!--{$smarty.section.x.index+$COUNT_VIEW}-->.</td>
<td class="tdatacontent" width="300"><!--{$DATA_KABUPATEN[x].nama_kabupaten}-->
<input type="hidden" name="no_kab_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->">
</td>
<td class="tdatacontent" style="background:#FFFAF2;"><input value="1" type="checkbox" name="kol_1_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1</td>
<td class="tdatacontent"><input value="1" type="checkbox" name="kol_2_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1</td>
<td class="tdatacontent" style="background:#FFFAF2;"><input value="1" type="checkbox" name="kol_3_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1</td>
<td class="tdatacontent"><input value="1" type="checkbox" name="kol_4_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1</td>
<td class="tdatacontent" style="background:#FFFAF2;"><input value="1" type="checkbox" name="kol_5a_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1
<input value="1" type="checkbox" name="kol_5b_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">2 
<input value="1" type="checkbox" name="kol_5c_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">3 
<input value="1" type="checkbox" name="kol_5d_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4 </td>
<td class="tdatacontent"><input value="1" type="checkbox" name="kol_6a_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1
<input value="1" type="checkbox" name="kol_6b_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">2 
<input value="1" type="checkbox" name="kol_6c_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">3 
<input value="1" type="checkbox" name="kol_6d_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4 </td>
<td class="tdatacontent" style="background:#FFFAF2;"><input value="1" type="checkbox" name="kol_7a_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">1
<input value="1" type="checkbox" name="kol_7b_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">2 
<input value="1" type="checkbox" name="kol_7c_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">3 
<input value="1" type="checkbox" name="kol_7d_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4 </td>
<td class="tdatacontent"><input value="1" type="checkbox" name="kol_8_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4</td>
<td class="tdatacontent" style="background:#FFFAF2;"><input value="1" type="checkbox" name="kol_9_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4</td>
<td class="tdatacontent"><input value="1" type="checkbox" name="kol_10_<!--{$smarty.section.x.index+$COUNT_VIEW}-->" class="checkbox">4</td>
</tr>
<!--{/section}-->
</tbody>
</table>
</div>

<table width="100%">
<tr><td width="40%"></td><td>
<INPUT TYPE="hidden" name="jml_kab" value="<!--{$JML_KAB}-->">
<INPUT TYPE="hidden" name="xid_main" value="<!--{$XID_MAIN}-->">	
<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
</td></tr>
</table>					
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
				<TD><!--{$TB_JENIS_JALAN}--></TD>
				<TD>
				<select name="jns_jln">
				<option value="">[Pilih Kategori Jalan]</option>
					<!--{section name=x loop=$DATA_JENIS_JLN}-->
					<!--{if $DATA_JENIS_JLN[x].id == $PID_JENIS_JLN}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->" selected > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{else}-->
					<option value="<!--{$DATA_JENIS_JLN[x].id}-->"  > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
					<!--{/if}-->
					<!--{/section}-->
				</select>
				</TD>
			</TR>				
			<!--
			<TR>
								<TD><!--{$TB_PROPINSI}--></TD>
								<TD>
								<SELECT name="no_propinsi">
								<OPTION VALUE="">[Pilih Propinsi]</OPTION>
								<!--{section name=x loop=$DATA_PROPINSI}-->
								<!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{else}-->
								<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
								<!--{/if}-->
								<!--{/section}-->
								</SELECT>
								</TD>
							</TR> -->
			<TR>
				<TD><!--{$TB_PROPINSI}--></TD>
				<TD>
				<SELECT name="no_propinsi">
				<OPTION VALUE="">[Pilih Provinsi]</OPTION>
				<!--{section name=x loop=$DATA_PROPINSI}-->
				<!--{if $DATA_PROPINSI[x].no_propinsi == $NO_PROPINSI}-->
				<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>				
				<!--{else}-->
					<!--{if $DATA_PROPINSI[x].no_propinsi == $ID_PROPINSI AND $NO_PROPINSI=="" }-->
					<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>		
					<!--{else}-->
					<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
					<!--{/if}-->
				<!--{/if}-->
				<!--{/section}-->
				</SELECT>
				</TD>
			</TR>
<TR>
								<TD>Tahun</TD>
								<TD>
								<!--{html_select_date display_days=false display_months=false start_year="2000" end_year="2100"}-->
								</TD>
							</TR>							
							<TR><TD COLSPAN="2" height="4"></TD></TR>
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

		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> <!--{$TABLE_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<!--{if $NO_PROPINSI<>""}-->	
<div style="position:absolute;z-index:100;right:338;top:45">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);getAllData('<!--{$NO_PROPINSI}-->','<!--{$TAHUN}-->','<!--{$NO_JENIS_JALAN}-->');frmCreate.op.value=1;this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> Edit Data</span></a>
</div>				
		<table width="100%">
			<TR>
			<TD>
			<table class="tbheader">			
			<tr><td width="100">Propinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>	
			<tr><td width="100">Tahun </td><td width="10"> : </td><td><!--{$TAHUN}--></td></tr>
			<tr><td width="100">Monitoring Oleh </td><td width="10"> : </td><td><!--{$NAMA_MONITORING}--></td></tr>								
			</table>
<table width="100%">
				<thead>
				<TR>
					<th class="tdatahead" rowspan="3">No</TH>
					<th class="tdatahead" rowspan="3">Nama Kabupaten</TH>
					<th class="tdatahead" colspan="19">Persentase Pelaporan Triwulan</TH>
				</TR>
				<TR>
				<th class="tdatahead">A</th>
				<th class="tdatahead">B</th>
				<th class="tdatahead">C</th>
				<th class="tdatahead">D</th>
				<th class="tdatahead" colspan="4">E</th>
				<th class="tdatahead" colspan="4">F</th>
				<th class="tdatahead" colspan="4">G</th>
				<th class="tdatahead">H</th>
				<th class="tdatahead">I</th>
				<th class="tdatahead">J</th>
				</TR>
				<TR>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#EAF8FF;">2</th>
				<th class="tdatahead" width="35" style="background:#DFF4FF;">3</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#EAF8FF;">2</th>
				<th class="tdatahead" width="35" style="background:#DFF4FF;">3</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				<th class="tdatahead" width="35" style="background:#F4FBFF;">1</th>
				<th class="tdatahead" width="35" style="background:#EAF8FF;">2</th>
				<th class="tdatahead" width="35" style="background:#DFF4FF;">3</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				<th class="tdatahead" width="35" style="background:#D9F2FF;">4</th>
				</TR>
				</thead>
				<tbody>
				<!--{section name=x loop=$DATA_MONITORING}-->
				<tr class='<!--{cycle values="alt,alt3"}-->'>
					<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW+1}-->.&nbsp;&nbsp;</TD>
					<td class="tdatacontent" nowrap> <!--{$DATA_MONITORING[x].nama_kabupaten}--> </TD>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_01==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_02==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_03==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_04==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_05a==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_05b==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_05c==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_05d==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_06a==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_06b==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_06c==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_06d==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_07a==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_07b==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_07c==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_07d==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_08==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_09==1}-->x<!--{/if}--></td>
					<td class="tdatacontent" align="center" nowrap><!--{if $DATA_MONITORING[x].jl_10==1}-->x<!--{/if}--></td>
				</TR>
			<!--{sectionelse}-->
			<tr>
				<td class="tdatacontent" COLSPAN="21" align="center">Sorry, your query has not been successful, please try again</td>
			</tr>					
			<!--{/section}-->			
			</tbody>
			
			
			
			
		</table></td></tr></table>
		
		<div class="tdatahead">
	<p>	<br />
A :Data Dasar Prasarana Jalan Propinsi, Kabupaten/Kota<br />
B :Data Kondisi Prasarana Jalan Propinsi, Kabupaten/Kota<br />
C :Pemantauan Kesesuaian Program<br />
D :Data Pendanaan Pengelolaan jalan propinsi, Kabupaten/Kota<br />
E :Pemantauan Pelaksanaan Pekerjaan<br />
F :Pemantauan Kemajuan Pelaksanaan pekerjaan<br />
G :Masalah dan Upaya Pemecahan<br />
H :Pemantauan Kualitas Hasil Pekerjaan<br />
I :Tujuan, Sasaran dan Manfaat<br />
J :Peningkatan Kinerja Jalan Propinsi, Kabupaten/Kota<br />
</p>
</div>
		
<div id="panel-footer"></div>
<!--{/if}-->
				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>	


</BODY>
</HTML>