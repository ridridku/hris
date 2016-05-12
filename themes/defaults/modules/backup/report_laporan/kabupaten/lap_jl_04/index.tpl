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
<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>"" AND $NO_JENIS_JALAN<>""}-->
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
							</TR>-->

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
														
					<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>"" AND $NO_JENIS_JALAN<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$LIST_ME}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">								
	
								<TR>
									<TD COLSPAN="2">
		<table class="tbheader">
		<tr><td width="130">Tanggal </td><td width="10"> : </td><td><!--{$TANGGAL}--></td></tr>
		<tr><td>Propinsi </td><td> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
		<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
		<tr><td>Kategori Jalan</td><td> : </td><td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td></tr>
		<tr><td>Realisasi APBD</td><td> : </td><td><!--{$APBD}--> %</td></tr>
		<tr><td>Alokasi Tahun Anggaran</td><td> : </td><td><!--{$THN_ANGGARAN}--></td></tr>
		</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
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
											<!--{section name=y loop=$DATA_TB}-->
											<!--{if trim($DATA_PROGRAM_PENANGANAN[x].id_program_penanganan)==trim($DATA_TB[y].id_program_penanganan)}-->
											<!-- <!--{$DATA_TB[y].apbd_target}--> -->
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
										<!-- Disabled on 17-09-2010
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
							
									</TD>	
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