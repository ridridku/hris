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

<div id="add-search-box" style="width:430px;">

<!-- <div>------debug : <!--{$NO_JENIS_JALAN}--></div> -->
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry3_',1);hideAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/databases.png" align="absmiddle">Import Data</span></a>
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);getAllData('<!--{$NO_PROPINSI}-->','<!--{$NO_KABUPATEN}-->','<!--{$SEARCH_YEAR}-->','<!--{$NO_JENIS_JALAN}-->');frmCreate.op.value=1;this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> Edit Data</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>
</div>

		<DIV ID="_menuEntry3_1" style="top:10px;width:100%;display:none;position:absolute;">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME2}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate2" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
			  <tr>
			    <td width="25%">MySQL Host Address </td>
			    <td width="75%"><input name="hostname1" type="text" id="hostname1" size="30" maxlength="30" value="localhost"></td>
			  </tr>
			  <tr>
			    <td>User Name </td>
			    <td><input name="username1" type="text" id="username1" size="20" maxlength="18" value="root"></td>
			  </tr>
			  <tr>
			    <td>Password</td>
			    <td><input name="password1" type="text" id="password1" size="20" maxlength="18"></td>
			  </tr>
			<TR>
				<TD COLSPAN="2" height="4"></TD></TR>
			<TR>
				<TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="import" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="3">
				<a class="button" href="#" onclick="this.blur();document.frmCreate2.submit(); document.frmCreate2.page.value='1';"  onSubmit="frmCreate2.page.value='1';"><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$SUBMIT}--></span></a>
				<a class="button" href="#" onclick="this.blur();document.frmCreate2.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/button/blank.gif" align="absmiddle"> <!--{$RESET}--></span></a>
				</TD>
			</TR>									
			</TABLE>	
		</FORM>
		</td></tr>
		</table>
		</DIV>
		

		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE class="tbheader">
<!--
<tr>
<td colspan="2">JENIS JALAN:<!--{$NO_JENIS_JALAN}--></td>
</tr> -->
				<TR>
					
<td width="150">Tanggal</td>
<td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->

<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'dd-mm-yyyy',this)"  class="imgLink" align="absmiddle" title="Show Calendar List"></td>
</tr>

<!-- Tambahan 21-06-2010 -->
<tr>
<td>Kategori Jalan</td>
<td><select name="jns_jln">
<option value="">[Pilih Kategori Jalan]</option>
	<!--{section name=x loop=$DATA_JENIS_JLN}-->
	<!--{if $DATA_JENIS_JLN[x].id == $NO_JENIS_JALAN}-->
	<option value="<!--{$DATA_JENIS_JLN[x].id}-->" selected > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
	<!--{else}-->
	<option value="<!--{$DATA_JENIS_JLN[x].id}-->"  > <!--{$DATA_JENIS_JLN[x].nm}--> </option>
	<!--{/if}-->
	<!--{/section}-->
</select>
</td>
</tr>
<!-- End 0f Tambahan 21-06-2010 -->

<tr>
<td>Nama Propinsi </td>
<td>
<SELECT name="no_propinsi" onChange="cari_kabupaten2(this.value)">
<OPTION VALUE="">[Pilih Propinsi]</OPTION>
<!--{section name=x loop=$DATA_PROPINSI}-->
<!--{if trim($DATA_PROPINSI[x].no_propinsi) == trim($NO_PROPINSI)}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{else}-->
<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
<!--{/if}-->
<!--{/section}-->
</SELECT></td>
</tr>
<tr>
<td>Nama Kabupaten </td>
<td>
<div id="ajax_kabupaten2">
<SELECT name="no_kabupaten">
<OPTION VALUE="">[Pilih Kabupaten]</OPTION>
<!--{section name=x loop=$DATA_KABUPATEN}-->
<!--{if $DATA_KABUPATEN[x].no_kabupaten == $NO_KABUPATEN}-->
<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
<!--{else}-->
<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
<!--{/if}-->
<!--{/section}-->								
</SELECT>	
</div>	
</td>
</tr>
<tr>
<td>Realisasi APBD</td>
<td>
<!--<input type="text" name="apbd" value="<!--{$APBD}-->" size="8" maxlength="100" onBlur="set_tahun(1,this.value)" OnKeyUp="validateNum(this)">-->
<input type="text" name="apbd" value="<!--{$APBD}-->" size="8" maxlength="100" OnKeyUp="validateNum(this)" onBlur="set_apbd(this.value)"> %
</td></tr>
<tr><td>Alokasi Tahun Anggaran</td><td><input type="text" name="thn_anggaran" value="<!--{$THN_ANGGARAN}-->" size="8" maxlength="4" onBlur="set_tahun(2,this.value)" OnKeyUp="validateNum(this)"> YYYY</td></tr>
</table>

<div id="ajax_detail">

<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="0">										
	<tr>
	    <th class="tdatahead" rowspan="3">No</th>
	    <th class="tdatahead" style="padding:1px" rowspan="3" nowrap>Program Penanganan</th>
	    <th class="tdatahead" style="padding:1px" colspan="2"><div id="ajax_tahun_1">Realisasi APBD [....]</div></th>
	    <th class="tdatahead" style="padding:1px" colspan="10"><div id="ajax_tahun_2">Alokasi Tahun Anggaran [....]</div></th>
	  </tr>
	  <tr>
	    <th class="tdatahead" style="padding:1px" rowspan="2">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px" rowspan="2">Biaya (Juta Rp)</th>
	    <th class="tdatahead" style="padding:1px" colspan="2">APBD untuk Bidang Jalan</th>
	    <th class="tdatahead" style="padding:1px" colspan="2">DAK untuk Bidang Jalan</th>
	    <th class="tdatahead" style="padding:1px" colspan="2">Sektor (Pusat)</th>
	    <th class="tdatahead" style="padding:1px" colspan="2">Pinjaman / Hibah</th>
	    <th class="tdatahead" style="padding:1px" colspan="2">Total</th>
	  </tr>
	  <tr>
	    <th class="tdatahead" style="padding:1px">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px">Biaya (Juta Rp)</th>
	    <th class="tdatahead" style="padding:1px">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px">Biaya (Juta Rp)</th>
	    <th class="tdatahead" style="padding:1px">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px">Biaya (Juta Rp)</th>
	    <th class="tdatahead" style="padding:1px">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px">Biaya (Juta Rp)</th>
	    <th class="tdatahead" style="padding:1px">Target (Km/m)</th>
	    <th class="tdatahead" style="padding:1px">Biaya (Juta Rp)</th>
	  </tr>
	  <tr>
	    <th class="tdatahead">1</th>
	    <th class="tdatahead">2</th>
	    <th class="tdatahead">3</th>
	    <th class="tdatahead">4</th>
	    <th class="tdatahead">5</th>
	    <th class="tdatahead">6</th>
	    <th class="tdatahead">7</th>
	    <th class="tdatahead">8</th>
	    <th class="tdatahead">9</th>
	    <th class="tdatahead">10</th>
	    <th class="tdatahead">11</th>
	    <th class="tdatahead">12</th>
	    <th class="tdatahead">13</th>
	    <th class="tdatahead">14</th>
	  </tr>									
<TR><td width="17" class="tdatacontent-first-col">1</td><td class="tdatacontent" COLSPAN="13">JALAN</td></TR>
	<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
	<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==1)}-->
	
	<script language="JavaScript" type="text/javascript">
	
	function CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->() {
		frmCreate.th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	function CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->(){
		frmCreate.th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	
	</script>
	
	<tr class='<!--{cycle values="alt,alt3"}-->'>
		<TD class="tdatacontent-first-col" align="right"></TD>
		<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th1_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onChange="CalcTh1_apbd_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th1_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onChange="CalcTh1_apbd_biaya()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onChange="CalcTh2_apbd_target(); CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_apbd_biaya(); Calcth2_apbd_biaya2(); CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_dak_target(); CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_dak_biaya(); CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_sektor_target(); CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_sektor_biaya(); CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_pinjaman_target(); CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onChange="Calcth2_pinjaman_biaya(); CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="background-color:#CCCCCC; font-weight:bold; color:red; text-align:right" onChange="Calcth2_total_target()" OnFocus="CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="background-color:#CCCCCC; font-weight:bold; color:red; text-align:right" onChange="Calcth2_total_biaya()" OnFocus="CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>																					
	</TR>										
	<!--{/if}-->
	<!--{/section}-->
	
	<!--{section name=w loop=$DATA_COUNT}-->
	
	<tr class='<!--{cycle values="alt,alt3"}-->'>
	
	<script language="JavaScript" type="text/javascript">
	
	function CalcTh1_apbd_target() {
		frmCreate.sub_total_jalan_th1_apbd_target.value=(frmCreate.th1_apbd_target_3.value*1)+(frmCreate.th1_apbd_target_4.value*1)+(frmCreate.th1_apbd_target_5.value*1)+(frmCreate.th1_apbd_target_6.value*1)+(frmCreate.th1_apbd_target_7.value*1)+(frmCreate.th1_apbd_target_8.value*1);
	}
	
	function CalcTh1_apbd_biaya() {
		frmCreate.sub_total_jalan_th1_apbd_biaya.value=(frmCreate.th1_apbd_biaya_3.value*1)+(frmCreate.th1_apbd_biaya_4.value*1)+(frmCreate.th1_apbd_biaya_5.value*1)+(frmCreate.th1_apbd_biaya_6.value*1)+(frmCreate.th1_apbd_biaya_7.value*1)+(frmCreate.th1_apbd_biaya_8.value*1);
	}
	
	function CalcTh2_apbd_target() {
		frmCreate.sub_total_jalan_th2_apbd_target.value=(frmCreate.th2_apbd_target_3.value*1)+(frmCreate.th2_apbd_target_4.value*1)+(frmCreate.th2_apbd_target_5.value*1)+(frmCreate.th2_apbd_target_6.value*1)+(frmCreate.th2_apbd_target_7.value*1)+(frmCreate.th2_apbd_target_8.value*1);
	}
	
	function Calcth2_apbd_biaya() {
		frmCreate.sub_total_jalan_th2_apbd_biaya.value=(frmCreate.th2_apbd_biaya_3.value*1)+(frmCreate.th2_apbd_biaya_4.value*1)+(frmCreate.th2_apbd_biaya_5.value*1)+(frmCreate.th2_apbd_biaya_6.value*1)+(frmCreate.th2_apbd_biaya_7.value*1)+(frmCreate.th2_apbd_biaya_8.value*1);
	}

	function Calcth2_apbd_biaya2() {
		frmCreate.th1_apbd_target_14.value=(frmCreate.th2_apbd_biaya_3.value*1)+(frmCreate.th2_apbd_biaya_4.value*1)+(frmCreate.th2_apbd_biaya_5.value*1)+(frmCreate.th2_apbd_biaya_6.value*1)+(frmCreate.th2_apbd_biaya_7.value*1)+(frmCreate.th2_apbd_biaya_8.value*1);
	}

	function Calcth2_dak_target() {
		frmCreate.sub_total_jalan_th2_dak_target.value=(frmCreate.th2_dak_target_3.value*1)+(frmCreate.th2_dak_target_4.value*1)+(frmCreate.th2_dak_target_5.value*1)+(frmCreate.th2_dak_target_6.value*1)+(frmCreate.th2_dak_target_7.value*1)+(frmCreate.th2_dak_target_8.value*1);
	}
	
	function Calcth2_dak_biaya() {
		frmCreate.sub_total_jalan_th2_dak_biaya.value=(frmCreate.th2_dak_biaya_3.value*1)+(frmCreate.th2_dak_biaya_4.value*1)+(frmCreate.th2_dak_biaya_5.value*1)+(frmCreate.th2_dak_biaya_6.value*1)+(frmCreate.th2_dak_biaya_7.value*1)+(frmCreate.th2_dak_biaya_8.value*1);
	}
	
	function Calcth2_sektor_target() {
		frmCreate.sub_total_jalan_th2_sektor_target.value=(frmCreate.th2_sektor_target_3.value*1)+(frmCreate.th2_sektor_target_4.value*1)+(frmCreate.th2_sektor_target_5.value*1)+(frmCreate.th2_sektor_target_6.value*1)+(frmCreate.th2_sektor_target_7.value*1)+(frmCreate.th2_sektor_target_8.value*1);
	}
	
	function Calcth2_sektor_biaya() {
		frmCreate.sub_total_jalan_th2_sektor_biaya.value=(frmCreate.th2_sektor_biaya_3.value*1)+(frmCreate.th2_sektor_biaya_4.value*1)+(frmCreate.th2_sektor_biaya_5.value*1)+(frmCreate.th2_sektor_biaya_6.value*1)+(frmCreate.th2_sektor_biaya_7.value*1)+(frmCreate.th2_sektor_biaya_8.value*1);
	}
	
	function Calcth2_pinjaman_target() {
		frmCreate.sub_total_jalan_th2_pinjaman_target.value=(frmCreate.th2_pinjaman_target_3.value*1)+(frmCreate.th2_pinjaman_target_4.value*1)+(frmCreate.th2_pinjaman_target_5.value*1)+(frmCreate.th2_pinjaman_target_6.value*1)+(frmCreate.th2_pinjaman_target_7.value*1)+(frmCreate.th2_pinjaman_target_8.value*1);
	}
	
	function Calcth2_pinjaman_biaya() {
		frmCreate.sub_total_jalan_th2_pinjaman_biaya.value=(frmCreate.th2_pinjaman_biaya_3.value*1)+(frmCreate.th2_pinjaman_biaya_4.value*1)+(frmCreate.th2_pinjaman_biaya_5.value*1)+(frmCreate.th2_pinjaman_biaya_6.value*1)+(frmCreate.th2_pinjaman_biaya_7.value*1)+(frmCreate.th2_pinjaman_biaya_8.value*1);
	}
	
	function Calcth2_total_target() {
		frmCreate.sub_total_jalan_th2_total_target.value=(frmCreate.th2_total_target_3.value*1)+(frmCreate.th2_total_target_4.value*1)+(frmCreate.th2_total_target_5.value*1)+(frmCreate.th2_total_target_6.value*1)+(frmCreate.th2_total_target_7.value*1)+(frmCreate.th2_total_target_8.value*1);
	}
	
	function Calcth2_total_biaya() {
		frmCreate.sub_total_jalan_th2_total_biaya.value=(frmCreate.th2_total_biaya_3.value*1)+(frmCreate.th2_total_biaya_4.value*1)+(frmCreate.th2_total_biaya_5.value*1)+(frmCreate.th2_total_biaya_6.value*1)+(frmCreate.th2_total_biaya_7.value*1)+(frmCreate.th2_total_biaya_8.value*1);
	}
	
	function Calcth2_th1_apbd_target_14(){
		frmCreate.th1_apbd_target_14.value=frmCreate.sub_total_jalan_th2_apbd_biaya.value;
	}
	</script>
	
	<TD class="tdatacontent-first-col"></TD>
	<TD class="tdatacontent" nowrap>Sub Total Jalan</TD>
	<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th1_apbd_target" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcTh1_apbd_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th1_apbd_biaya" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcTh1_apbd_biaya()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_apbd_target" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcTh2_apbd_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_apbd_biaya" size="14" style="text-align:right" OnKeyUp="validateNum(this);" onKeyPress="Calcth2_apbd_biaya();Calcth2_th1_apbd_target_14();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_dak_target" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_dak_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_dak_biaya" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_dak_biaya()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_sektor_target" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_sektor_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_sektor_biaya" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_sektor_biaya()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_pinjaman_target" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_pinjaman_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_pinjaman_biaya" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_pinjaman_biaya()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_total_target" size="8" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_total_target()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="sub_total_jalan_th2_total_biaya" size="14" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_total_biaya()"></TD>											
		</TR>
	<TR><TD class="tdatacontent-first-col"></TD><TD class="tdatacontent" COLSPAN="13">&nbsp;</TD></TR>
	<!--{/section}-->		
	
	<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
	<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==13)}-->
	
	<script language="JavaScript" type="text/javascript">
	
	function CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->() {
		frmCreate.th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	function CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->(){
		frmCreate.th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}

	<!--
	function Calcth1_apbd_target_14() {
		frmCreate.th1_apbd_target_14.value=(frmCreate.sub_total_jalan_th1_apbd_target.value*1);
	}
	-->
	function Calcth1_apbd_target_14() {
		frmCreate.th1_apbd_target_14.value=frmCreate.sub_total_jalan_th2_apbd_biaya.value;
	}
	function Calcth1_apbd_biaya_14() {
		frmCreate.th1_apbd_biaya_14.value=(frmCreate.sub_total_jalan_th1_apbd_biaya.value*1);
	}
	function Calcth2_apbd_target_14() {
		frmCreate.th2_apbd_target_14.value=(frmCreate.sub_total_jalan_th2_apbd_target.value*1);
	}
	function Calcth2_apbd_biaya_14() {
		frmCreate.th2_apbd_biaya_14.value=(frmCreate.sub_total_jalan_th2_apbd_biaya.value*1);
	}
	function Calcth2_dak_target_14() {
		frmCreate.th2_dak_target_14.value=(frmCreate.sub_total_jalan_th2_dak_target.value*1);
	}
	function Calcth2_dak_biaya_14() {
		frmCreate.th2_dak_biaya_14.value=(frmCreate.sub_total_jalan_th2_dak_biaya.value*1);
	}
	function Calcth2_sektor_target_14() {
		frmCreate.th2_sektor_target_14.value=(frmCreate.sub_total_jalan_th2_sektor_target.value*1);
	}
	function Calcth2_sektor_biaya_14() {
		frmCreate.th2_sektor_biaya_14.value=(frmCreate.sub_total_jalan_th2_sektor_biaya.value*1);
	}
	function Calcth2_pinjaman_target_14() {
		frmCreate.th2_pinjaman_target_14.value=(frmCreate.sub_total_jalan_th2_pinjaman_target.value*1);
	}
	function Calcth2_pinjaman_biaya_14() {
		frmCreate.th2_pinjaman_biaya_14.value=(frmCreate.sub_total_jalan_th2_pinjaman_biaya.value*1);
	}
	function Calcth2_total_target_14() {
		frmCreate.th2_total_target_14.value=(frmCreate.sub_total_jalan_th2_total_target.value*1);
	}
	function Calcth2_total_biaya_14() {
		frmCreate.th2_total_biaya_14.value=(frmCreate.sub_total_jalan_th2_total_biaya.value*1);
	}
	
	
	</script>
		
	<TR>
		<TD class="tdatacontent-first-col" width="17" class="tdatacontent-first-col">2</TD>
		<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
		<TD class="tdatacontent"  style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th1_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onKeyPress="Calcth1_apbd_target_14();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>											
		<!-- Disabled on 16-09-2010
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th1_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth1_apbd_biaya_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_apbd_target_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_apbd_biaya_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_dak_target_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_dak_biaya_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_sektor_target_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_sektor_biaya_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_pinjaman_target_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_pinjaman_biaya_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_total_target_14()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)" onClick="Calcth2_total_biaya_14()"></TD>
		-->
	</TR>
	<!--{/if}-->
	<!--{/section}-->
	</TR>
		<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
	<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==15)}-->
	
	<script language="JavaScript" type="text/javascript">
	
	function CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->() {
		frmCreate.th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	function CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->(){
		frmCreate.th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	
	function CalpAPBD<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->(){
		var apbd;
		apbd = ((frmCreate.th1_apbd_target_14.value)/(frmCreate.th1_apbd_target_16.value))*100;
		frmCreate.th1_apbd_target_18.value=apbd.toFixed(2);
	}

	</script>
		
	<TR>
		<TD class="tdatacontent-first-col" width="17" class="tdatacontent-first-col">3</TD>
		<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
		<TD class="tdatacontent"  style="margin:0;padding:0;" nowrap><input type="text" name="th1_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this);" onKeyPress="CalpAPBD<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->();"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>											
		<!-- Disabled on 16-09-2010
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th1_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" name="th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)"></TD>
		-->
	</TR>
	<!--{/if}-->
	<!--{/section}-->

		<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
	<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==17)}-->

	<script language="JavaScript" type="text/javascript">
	

	function CalcBiaya<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->() {
		frmCreate.th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	function CalcTarget<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->(){
		frmCreate.th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value=(frmCreate.th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1)+(frmCreate.th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->.value*1);
	}
	
	
	function CalcPersenth1_apbd_biaya_18(){
		frmCreate.th1_apbd_biaya_18.value=parseFloat(((frmCreate.th1_apbd_biaya_14.value*1)/(frmCreate.th1_apbd_biaya_16.value*1))*100);
	}
	function CalcPersenth2_apbd_biaya_18(){
		frmCreate.th2_apbd_biaya_18.value=((frmCreate.th2_apbd_biaya_14.value*1)/(frmCreate.th2_apbd_biaya_16.value*1))*100;
	}
	function CalcPersenth2_dak_biaya_18(){
		frmCreate.th2_dak_biaya_18.value=((frmCreate.th2_dak_biaya_14.value*1)/(frmCreate.th2_dak_biaya_16.value*1))*100;
	}
	function CalcPersenth2_sektor_biaya_18(){
		frmCreate.th2_sektor_biaya_18.value=((frmCreate.th2_sektor_biaya_14.value*1)/(frmCreate.th2_sektor_biaya_16.value*1))*100;
	}
	function CalcPersenth2_pinjaman_biaya_18(){
		frmCreate.th2_pinjaman_biaya_18.value=((frmCreate.th2_pinjaman_biaya_14.value*1)/(frmCreate.th2_pinjaman_biaya_16.value*1))*100;
	}
	function CalcPersenth2_total_biaya_18(){
		frmCreate.th2_total_biaya_18.value=((frmCreate.th2_total_biaya_14.value*1)/(frmCreate.th2_total_biaya_16.value*1))*100;
	}
	
	</script>
		
	<TR>
		<TD class="tdatacontent-first-col" width="17" class="tdatacontent-first-col">4</TD>
		<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
		<TD class="tdatacontent"  style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th1_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap>&nbsp;</TD>
		<!-- Disabled on 16-09-2010
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th1_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth1_apbd_biaya_18()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_apbd_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_apbd_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth2_apbd_biaya_18()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_dak_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_dak_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth2_dak_biaya_18()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_sektor_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_sektor_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth2_sektor_biaya_18()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_pinjaman_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_pinjaman_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="12" style="text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth2_pinjaman_biaya_18()"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_target_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="8" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)"></TD>
		<TD class="tdatacontent" style="margin:0;padding:0;" nowrap><input type="text" class="input2" name="th2_total_biaya_<!--{$DATA_PROGRAM_PENANGANAN[x].id_program_penanganan}-->" size="14" style="background-color:#CCCCCC; text-align:right" OnKeyUp="validateNum(this)" onClick="CalcPersenth2_total_biaya_18()"></TD>
		-->
	</TR>
	<!--{/if}-->
	<!--{/section}-->
	</TR>
	</TABLE>
	</div>
	<TABLE width="100%">
<TR><TD COLSPAN="6" height="40"></TD><TD COLSPAN="5">
<INPUT TYPE="hidden" name="xid_fjl_04_main" value="<!--{$ID_JL_04_MAIN}-->">
					<INPUT TYPE="hidden" name="xid_fjl_04_detail" value="<!--{$ID_JL_04_DETAIL}-->">
					<INPUT TYPE="hidden" name="xid_program_penanganan" value="<!--{$ID_PROGRAM_PENANGANAN}-->">		
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="Search_Year" value="<!--{$SEARCH_YEAR}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
					
</TD></TR>										
</TABLE>
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
					<!--{if $DATA_JENIS_JLN[x].id == $PID_JENIS_JLN2}-->
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
								<SELECT name="no_propinsi" onChange="cari_kabupaten(this.value)">
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
							</TR>
							-->
							<TR>
								<TD><!--{$TB_PROPINSI}--></TD>
								<TD>
								<SELECT name="no_propinsi" onChange="cari_kabupaten(this.value)">
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
								<TD><!--{$TB_KABUPATEN}--></TD>
								<TD>
								<div id="ajax_kabupaten">
								<SELECT name="no_kabupaten">
								<OPTION VALUE="">[Pilih Kabupaten]</OPTION>
								<!--{section name=x loop=$DATA_KABUPATEN}-->
								<!--{if $DATA_KABUPATEN[x].no_kabupaten == $NO_KABUPATEN}-->
								<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->" selected > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
								<!--{else}-->
								<option value="<!--{$DATA_KABUPATEN[x].no_kabupaten}-->"  > <!--{$DATA_KABUPATEN[x].nama_kabupaten}--> </option>
								<!--{/if}-->
								<!--{/section}-->								
								</SELECT>	
								</div>							
								</TD>
							</TR>
							<TR>
								<TD>Tahun Anggaran</TD>
								<TD>
								<!--{html_select_date prefix="Search_" display_days=false display_months=false start_year="2000" end_year="+10"}-->						
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
		<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->	
		<table width="100%"><tr><td>
		<table class="tbheader">
		<tr><td width="150">Tanggal </td><td width="10"> : </td><td><!--{$TANGGAL}--></td></tr>
		<tr><td width="150">Kategori Jalan</td><td width="10"> : </td><td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td></tr>
		<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
		<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
		<tr><td>Realisasi APBD</td><td> : </td><td><!--{$APBD}--> %</td></tr>
		<tr><td>Alokasi Tahun Anggaran</td><td> : </td><td><!--{$THN_ANGGARAN}--></td></tr>
		</table>
									</TD>
								</TR>								
								<TR>
									<TD>
									<!-- <TABLE WIDTH="100%">										
										<TR>
											<th class="tdatahead"><!--{$TB_NO}--></TH>
											<th class="tdatahead" style="padding:1px"><!--{$TB_APBD}--></TH>
											<th class="tdatahead" style="padding:1px"><!--{$TB_TAHUN_ANGGARAN}--></TH>
											<th class="tdatahead" style="padding:1px"><!--{$TB_JENIS_PROGRAM}--></TH>
											<th class="tdatahead" style="padding:1px"><!--{$TB_TARGET_APBD}--></TH>
											
											<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></TH>
										</TR>
										<!--{section name=x loop=$DATA_TB}-->
										<tr class='<!--{cycle values="alt,alt3"}-->'>
											<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.&nbsp;&nbsp;</TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].apbd}--></TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].thn_anggaran}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].jenis_program}--> </TD>
											<td class="tdatacontent" nowrap> <!--{$DATA_TB[x].apbd_target}--> </TD>
											
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('<!--{$SELF}-->?opt=1&id_fjl_04_main=<!--{$DATA_TB[x].id_fjl_04_main}-->&id_fjl_04_detail=<!--{$DATA_TB[x].id_fjl_04_detail}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
											<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&id_fjl_04_main=<!--{$DATA_TB[x].id_fjl_04_main}-->&Search_Year=<!--{$SEARCH_YEAR}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<td class="tdatacontent" COLSPAN="7" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>-->
		
<TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<thead>
										<TR>
										    <TH class="tdatahead" rowspan="3">No</th>
										    <TH class="tdatahead" rowspan="3">Program Penanganan</th>
										    <TH class="tdatahead" colspan="2">Realisasi APBD <!--{$APBD}--> %</th>
										    <TH class="tdatahead" colspan="10">Alokasi Tahun Anggaran <!--{$THN_ANGGARAN}--></th>
										  </tr>
										  <tr>
										    <TH class="tdatahead" rowspan="2">Target (Km/m)</th>
										    <TH class="tdatahead" rowspan="2">Biaya (Juta Rp)</th>
										    <TH class="tdatahead" colspan="2">APBD untuk Bidang Jalan</th>
										    <TH class="tdatahead" colspan="2">DAK untuk Bidang Jalan</th>
										    <TH class="tdatahead" colspan="2">Sektor (Pusat)</th>
										    <TH class="tdatahead" colspan="2">Pinjaman / Hibah</th>
										    <TH class="tdatahead" colspan="2">Total</th>
										  </tr>
										  <tr>
										    <TH class="tdatahead">Target (Km/m)</th>
										    <TH class="tdatahead">Biaya (Juta Rp)</th>
										    <TH class="tdatahead">Target (Km/m)</th>
										    <TH class="tdatahead">Biaya (Juta Rp)</th>
										    <TH class="tdatahead">Target (Km/m)</th>
										    <TH class="tdatahead">Biaya (Juta Rp)</th>
										    <TH class="tdatahead">Target (Km/m)</th>
										    <TH class="tdatahead">Biaya (Juta Rp)</th>
										    <TH class="tdatahead">Target (Km/m)</th>
										    <TH class="tdatahead">Biaya (Juta Rp)</th>
										  </tr>
										  <tr>
										    <TH class="tdatahead">1</th>
										    <TH class="tdatahead">2</th>
										    <TH class="tdatahead">3</th>
										    <TH class="tdatahead">4</th>
										    <TH class="tdatahead">5</th>
										    <TH class="tdatahead">6</th>
										    <TH class="tdatahead">7</th>
										    <TH class="tdatahead">8</th>
										    <TH class="tdatahead">9</th>
										    <TH class="tdatahead">10</th>
										    <TH class="tdatahead">11</th>
										    <TH class="tdatahead">12</th>
										    <TH class="tdatahead">13</th>
										    <TH class="tdatahead">14</th>
										 </TR>
										</thead>	
										<tbody>									
										<TR>
										<TD width="17" class="tdatacontent-first-col">1</td>
										<TD class="tdatacontent">JALAN</td><TD class="tdatacontent" COLSPAN="12"></TD></TR>
										<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
										<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==1)}-->
										<TR>
											<TD width="17" class="tdatacontent-first-col"></TD>
											<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
											<TD class="tdatacontent" align="right" nowrap> 
											<!-- 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_target}-->
											<!--{/if}-->
											<!--{/section}-->
											-->
											<!--{section name=y loop=$DATA_APBD_TARGET}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_APBD_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_APBD_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_APBD_JALAN_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_APBD_JALAN_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_DAK_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_DAK_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_SEKTOR_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_SEKTOR_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_PINJAMAN_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_PINJAMAN_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontentsum" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TOTAL_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontentsum" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TOTAL_BIAYA[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>											
											
										</TR>										
										<!--{/if}-->
										<!--{/section}-->
										<!--{section name=w loop=$DATA_COUNT}-->
										<TR>
										<TD width="17" class="tdatacontent-first-col"></TD>
										<TD class="tdatacontent" nowrap>Sub Total Jalan</TD>
										<!-- Disabled 17-09-2010
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].apbd_target}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].apbd_biaya}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].apbd_jalan_target}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].apbd_jalan_biaya}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].dak_target}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].dak_biaya}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].sektor_target}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].sektor_biaya}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].pinjaman_target}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].pinjaman_biaya}--></TD>
										<TD class="tdatacontentsum2" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].total_target}--></TD>
										<TD class="tdatacontentsum2" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_COUNT[w].total_biaya}--></TD>
										-->
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_APBD_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_APBD_BIAYA2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_APBD_JALAN_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_APBD_JALAN_BIAYA2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_DAK_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_DAK_BIAYA2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_SEKTOR_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_SEKTOR_BIAYA2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_PINJAMAN_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_PINJAMAN_BIAYA2[w]}--></TD>
										<TD class="tdatacontentsum2" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_TOTAL_TARGET2[w]}--></TD>
										<TD class="tdatacontentsum2" BGCOLOR="#CCCCCC" align="right" nowrap><!--{$DATA_TOTAL_BIAYA2[w]}--></TD>
										</TR>
										<TR><TD  width="17" class="tdatacontent-first-col"></TD><TD class="tdatacontent" COLSPAN="13">&nbsp;</TD></TR>
										<!--{/section}-->

										
											<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
										<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==13)}-->
										<TR BGCOLOR="#CCCCCC">
											<TD width="17" class="tdatacontent-first-col">2</TD>
											<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!-- <!--{$DATA_TB[y].apbd_target}--> -->
											<!--{$DATA_APBD_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>											
											
										</TR>
										<!--{/if}-->
										<!--{/section}-->
										</TR>
											<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
										<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==15)}-->
										<TR BGCOLOR="#CCCCCC">
											<TD width="17" class="tdatacontent-first-col">3</TD>
											<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!-- <!--{$DATA_TB[y].apbd_target}--> -->
											<!--{$DATA_APBD_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>											
											
										</TR>
										<!--{/if}-->
										<!--{/section}-->

											<!--{section name=x loop=$DATA_PROGRAM_PENANGANAN}-->
										<!--{if ($DATA_PROGRAM_PENANGANAN[x].sub_kategori==17)}-->
										<TR BGCOLOR="#CCCCCC">
											<TD width="17" class="tdatacontent-first-col">4</TD>
											<TD class="tdatacontent" nowrap><!--{$DATA_PROGRAM_PENANGANAN[x].jenis_program}--> </TD>											
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!-- <!--{$DATA_TB[y].apbd_target}--> -->
											<!--{$DATA_APBD_TARGET[y]}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].apbd_jalan_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> 
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].dak_biaya}-->
											<!--{/if}-->
											<!--{/section}--></TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].sektor_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].pinjaman_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_target}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>
											<TD class="tdatacontent" align="right" nowrap> <!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!--{$DATA_TB[y].total_biaya}-->
											<!--{/if}-->
											<!--{/section}-->
											</TD>											
											
										</TR>
										<!--{/if}-->
										<!--{/section}-->
										</tbody>
									</TABLE>	

							<table cellpadding="0" cellspacing="0" width="100" style="margin-top:10px;background:#fcfcfc; border-top:2 solid #ccc;border-left:2 solid #ccc; border-right:2 solid #ccc;">
							<tr><td class="tdatacontent">Keterangan</td></tr>
							</table>
							<table cellpadding="0" cellspacing="0" class="table_note" width="70%">
							<tr>
							<td class="tdatahead">A</td><td class="tdatacontent" nowrap>Kolom 14 "Biaya Juta(Rp)" = (kolom 6 x 1) + (kolom 8 x 1) + (kolom 10 x 1) + (kolom 12 x 1)</td>
							</tr>
							<tr>
							<td class="tdatahead">B</td><td class="tdatacontent" nowrap>Kolom 13 "Target(Km/m)" = (kolom 5 x 1) + (kolom 7 x 1) + (kolom 9 x 1) + (kolom 11 x 1)</td>
							</tr>
							<tr>
							<td class="tdatahead">C</td><td class="tdatacontent" nowrap>Baris 2 "APBD BIDANG JALAN" = Nilainya sama dengan Baris 1 "Sub Total Jalan"</td>
							</tr>
							<tr>
							<td class="tdatahead">D</td><td class="tdatacontent" nowrap>Baris 4 "% PENANGANAN APBD BIDANG JALAN" = Baris 2 (APBD BIDANG JALAN) / Baris 3 (TOTAL APBD)</td>
							</tr>
							</table>


		</td></tr></table>


<div id="panel-footer" style="height:5px;">

</div>	
<!--{/if}-->			
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>	
</BODY>
</HTML>