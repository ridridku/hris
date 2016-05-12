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
<!--{if $NO_PROPINSI<>"" AND $NO_JENIS_JALAN<>""}-->
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
							</TR>
							-->
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
								<TD>TAHUN</TD>
								<TD><!--{html_select_date display_days=false display_months=false start_year="2000" end_year="2100"}-->
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
														
					<!--{if $NO_PROPINSI<>"" AND $NO_JENIS_JALAN<>""}-->
					<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$LIST_ME}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">		
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">								
	
								<TR>
									<TD COLSPAN="2">
									<table width="100%" class="tbheader">	
									<tr><td width="100">Tahun </td><td width="7"> : </td><td><!--{$TAHUN}--></td></tr>
									<tr><td width="100">Propinsi </td><td width="7"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>									
									<tr><td>Kategori Jalan</td><td> : </td><td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td></tr>
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<thead>
										<TR>
											<TH class="tdatahead">No</TH>
											<TH class="tdatahead">Nama Kabupaten/Kota</TH>
											<TH class="tdatahead" width="65">A</TH>
											<TH class="tdatahead" width="65">B</TH>
											<TH class="tdatahead" width="65">C</TH>
											<TH class="tdatahead" width="65">D</TH>
											<TH class="tdatahead" width="65">E</TH>
											<TH class="tdatahead" width="65">F</TH>
											<TH class="tdatahead" width="65">G</TH>
											<TH class="tdatahead" width="65">H</TH>									
											</TH>
										</TR>
										<TR>
											<TH class="tdatahead" align="center">1</TD>
											<TH class="tdatahead" align="center">2</TD>
											<TH class="tdatahead" align="center">3</TD>
											<TH class="tdatahead" align="center">4</TD>
											<TH class="tdatahead" align="center">5</TD>
											<TH class="tdatahead" align="center">6</TD>
											<TH class="tdatahead" align="center">7</TD>
											<TH class="tdatahead" align="center">8</TD>
											<TH class="tdatahead" align="center">9</TD>
											<TH class="tdatahead" align="center">10</TD>
										</TR>
										</thead>	
										<tbody>										
										<!--{section name=x loop=$DATA_WILAYAH}-->
										<TR>
											<TD width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+1}-->.</TD>
											<TD class="tdatacontent" nowrap><!--{$DATA_WILAYAH[x].nama_kabupaten}--></TD>
											<TD class="tdatacontent" align="right" nowrap><!--{$DATA_WILAYAH[x].kemantapan|string_format:"%d"}--></TD>
											<TD class="tdatacontent" align="right" nowrap><!--{$DATA_WILAYAH[x].rd_dak|string_format:"%d"}--></TD>
											<TD class="tdatacontent" align="right" nowrap><!--{$DATA_WILAYAH[x].rd|string_format:"%d"}--></TD>
											<TD class="tdatacontent" align="right" nowrap><!--{$DATA_WILAYAH[x].deviasi|string_format:"%d"}--></TD>
											<TD class="tdatacontent" align="right" nowrap></TD>
											<TD class="tdatacontent" align="right" nowrap></TD>
											<TD class="tdatacontent" align="right" nowrap></TD>
											<TD class="tdatacontent" align="right" nowrap></TD>
										</TR>
									
			
										
										
										<!--{sectionelse}-->
										
										
										<TR>
		<TD class="tdatacontent" BGCOLOR="red" COLSPAN="10" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>

										
										<!--{/section}-->
																		
										</tbody>
										
										
										
										
										
									</TABLE></TD>								
								</TR>	
							</TABLE>
							
							</TD>	
								</TR>								
							</TABLE>
							
<div class="tdatacontent">
<br /><br />
Keterangan:<br />
A:Peningkatan kinerja jalan Kabupaten/Kota<br />
B:Kesesuaian Rencana Kegiatan dalam RAD dengan arahan pemanfaatan DAK<br />
C:Kesesuaian pelaksanaan dengan RD<br />
D:Kesesuaian pelaksanaan fisik dengan Speksifikasi Teknis/Dokumen Kontrak<br />
E:Pencapaian sasaran kegiatan<br />
F:Dampak dan Manfaat<br />
G:Kepatuhan dan Ketertiban Pelaporan (empat triwulan)<br />
H:Total Nilai<br />
</div>
							
							
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