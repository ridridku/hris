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
<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->
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
							<TD>Tahun</TD>
							<TD><!--{html_select_date prefix="Search_" start_year="2000" end_year="+10" display_days=false display_months=false}--></TD>
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
														
					<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$LIST_ME}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">	
																		
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
									<thead>
										<TR>
    <TH class="tdatahead" colspan="4">K - 10 - JP</th>
    <TH class="tdatahead" colspan="15" rowspan="2">Ikhtisar Inventaris Jembatan</th>
    <TH class="tdatahead" colspan="5">Program Pemeliharaan<br />
    Tahun/Tahun</th>
  </tr>
  <tr>
    <TH class="tdatahead" colspan="4">&nbsp;</th>
    <TH class="tdatahead" colspan="5">Tanggal Disiapkan</th>
  </tr>
  <tr>
    <TH class="tdatahead" colspan="4">Rural Road<br />
      Development Project</th>
    <td colspan="15"><table width="100%" border="0">
      <tr>
        <TH class="tdatahead" width="40%">&nbsp;</th>
        <TH class="tdatahead" width="10%">Kode</th>
        <TH class="tdatahead" width="40%">&nbsp;</th>
        <TH class="tdatahead" width="10%">Kode</th>
      </tr>
      <tr>
        <TH class="tdatahead">Propinsi : <!--{$NAMA_PROPINSI}--></th>
        <TH class="tdatahead"><!--{$NO_PROPINSI}--></th>
        <TH class="tdatahead">Kabupaten : <!--{$NAMA_KABUPATEN}--></th>
        <TH class="tdatahead"><!--{$NO_KABUPATEN}--></th>
      </tr>
    </table></td>
    <TH class="tdatahead" colspan="5">Oleh : <!--{$TB_DISIAPKAN_OLEH}--></th>
  </tr>
  <tr>
    <TH class="tdatahead" rowspan="3">No Ruas</th>
    <TH class="tdatahead" colspan="3">Jembatan</th>
    <TH class="tdatahead" rowspan="3">Tipe Penyebrangan</th>
    <TH class="tdatahead" colspan="3">Ukuran</th>
    <TH class="tdatahead" colspan="16">Tipe / Kondisi</th>
  </tr>
  <tr>
    <TH class="tdatahead" rowspan="2">No Urut</th>
    <TH class="tdatahead" rowspan="2">Nama Jembatan / Sungai</th>
    <TH class="tdatahead" rowspan="2">Pal KM</th>
    <TH class="tdatahead" rowspan="2">Panjang (m)</th>
    <TH class="tdatahead" rowspan="2">Lebar (m)</th>
    <TH class="tdatahead" rowspan="2">Jumlah Bentang</th>
    <TH class="tdatahead" colspan="4">Bangunan Atas</th>
    <TH class="tdatahead" colspan="3">Lantai</th>
    <TH class="tdatahead" colspan="3">Sandaran</th>
    <TH class="tdatahead" colspan="4">Pondasi</th>
    <TH class="tdatahead" colspan="2">Kepala Jembatan</th>
  </tr>
  <tr>
    <TH class="tdatahead">Tipe</th>
    <TH class="tdatahead">Bahan</th>
    <TH class="tdatahead">Asal</th>
    <TH class="tdatahead">Kondisi</th>
    <TH class="tdatahead" colspan="2">Tipe</th>
    <TH class="tdatahead">Kondisi</th>
    <TH class="tdatahead" colspan="2">Tipe</th>
    <TH class="tdatahead">Kondisi</th>
    <TH class="tdatahead">Tipe</th>
    <TH class="tdatahead" colspan="2">Bahan</th>
    <TH class="tdatahead">Kondisi</th>
    <TH class="tdatahead">Tipe</th>
    <TH class="tdatahead">Bahan</th>
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
    <TH class="tdatahead" colspan="3">9</th>
    <TH class="tdatahead">10</th>
    <TH class="tdatahead" colspan="2">11</th>
    <TH class="tdatahead">12</th>
    <TH class="tdatahead" colspan="2">13</th>
    <TH class="tdatahead">14</th>
    <TH class="tdatahead">15</th>
    <TH class="tdatahead" colspan="2">16</th>
    <TH class="tdatahead">17</th>
    <TH class="tdatahead">18</th>
    <TH class="tdatahead">19</th>
</TR>
										</thead>	
										<tbody>									
										<!--{section name=x loop=$DATA_TB}-->
										<TR onmouseover="setPointer(this, <!--{$INITSET[x]}-->, 'over', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, <!--{$INITSET[x]}-->, 'out', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, <!--{$INITSET[x]}-->, 'click', '<!--{$ROW_CLASSNAME[x]}-->', '#CCFFCC', '#FFCC99');">
											<TD width="17" class="tdatacontent-first-col"> <!--{$DATA_TB[x].no_ruas}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$smarty.section.x.index+1}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_jembatan_sungai}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].pal_km}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].tipe_penyebrangan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].panjang}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].lebar}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].jumlah_bentang}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].bangunan_atas_tipe}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].bangunan_atas_bahan}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].bangunan_atas_asal}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].bangunan_atas_kondisi}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].lantai_tipe1}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].lantai_tipe2}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].lantai_kondisi}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].sandaran_tipe1}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].sandaran_tipe2}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].sandaran_kondisi}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].pondasi_tipe}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].pondasi_bahan1}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].pondasi_bahan2}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].pondasi_kondisi}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].kep_jembatan_tipe}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].kep_jembatan_bahan1}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].kep_jembatan_bahan2}--> </TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" BGCOLOR="red" COLSPAN="25" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
										<!--{/section}-->
										</tbody>
									</TABLE></TD>	
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