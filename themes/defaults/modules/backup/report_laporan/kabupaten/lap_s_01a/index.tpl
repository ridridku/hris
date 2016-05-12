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
								<TD>Tanggal</TD>
								<TD>
								<div id="ajax_tanggal">
								<select name="tanggal" onChange="get_no_ruas(document.frmList1.no_propinsi.value,document.frmList1.no_kabupaten.value,this.value,document.frmList1.jns_jln.value)">
								<option value="">Pilih Tanggal</option
								</select>
								</div>							
								</TD>
							</TR>
							<TR>
								<TD>No Ruas Jalan</TD>
								<TD>
								<div id="ajax_no_ruas2">
								<select name="no_ruas">
								<option value="">Pilih No Ruas</option
								</select>
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
														
					<!--{if $NO_PROPINSI<>"" AND $NO_KABUPATEN<>""}-->

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
									<tr><td width="100">Propinsi </td><td width="10"> : </td><td><!--{$NAMA_PROPINSI}--></td></tr>
									<tr><td>Kabupaten/Kota </td><td> : </td><td><!--{$NAMA_KABUPATEN}--></td></tr>
									<tr><td>Kategori Jalan </td><td> : </td><td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td></tr>
									<tr><td width="100">Tanggal </td><td width="10"> : </td><td><!--{$TANGGAL}--></td></tr>
									<tr><td>No Ruas </td><td> : </td><td><!--{$NO_RUAS}--></td></tr>
									<tr><td>Nama Ruas</td><td> : </td><td><!--{$NAMA_RUAS_PANGKAL}--> - <!--{$NAMA_RUAS_UJUNG}--></td></tr>
									<tr><td>Awal KM Ruas</td><td> : </td><td><!--{$AWAL_KM_RUAS}--></td></tr>
									<tr><td>Akhir KM Ruas </td><td> : </td><td><!--{$AKHIR_KM_RUAS}--></td></tr>
									</table>
									</TD>
								</TR>														
								<TR>
									<TD COLSPAN="2"><TABLE ALIGN="CENTER" WIDTH="100%"  cellspacing="1" cellpadding="2">										
										<thead>
										<TR>
											<TH class="tdatahead" ROWSPAN="2" width="17">No</TH>
											<TH class="tdatahead" ROWSPAN="2">No Segmen</TH>
											<TH class="tdatahead" ROWSPAN="2" width="75">Nilai Kerusakan <br>(%)</TH>
											<TH class="tdatahead" COLSPAN="3">Program Penanganan</TH>
											<TH class="tdatahead" ROWSPAN="2" width="75">Keterangan</TH>
										</TR>
										<TR>
											<TH class="tdatahead" width="75">PR</TH>
											<TH class="tdatahead" width="75">PM</TH>
											<TH class="tdatahead" width="75">PK</TH>										
										</TR>
										<TR>
											<TH class="tdatahead" align="center">1</TD>
											<TH class="tdatahead" align="center">2</TD>
											<TH class="tdatahead" align="center">3</TD>
											<TH class="tdatahead" align="center">4</TD>
											<TH class="tdatahead" align="center">5</TD>
											<TH class="tdatahead" align="center">6</TD>
											<TH class="tdatahead" align="center">7</TD>
										</TR>
										</thead>	
										<tbody>										
										<!--{section name=x loop=$DATA_DETAIL}-->
										<TR>
											<TD class="tdatacontent-first-col"> <!--{$smarty.section.x.index+1}-->.</TD>
											<TD class="tdatacontent" align="center"> <!--{$smarty.section.x.index+1}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_DETAIL[x].penilaian}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_DETAIL[x].pr}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_DETAIL[x].pm}--> </TD>
											<TD class="tdatacontent" align="center" nowrap> <!--{$DATA_DETAIL[x].pk}--> </TD>
											<TD class="tdatacontent" align="center"> <!--{$DATA_DETAIL[x].keterangan}--> </TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" BGCOLOR="red" COLSPAN="7" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
										<!--{/section}-->										
										</tbody>
										<tfooter>
										<tr>
										<td class="tdatacontentsum" colspan="2">Jumlah Nilai Kerusakan (%)</td>
										<td class="tdatacontentsum">&nbsp;</td>
										<td class="tdatacontentsum" align="right"><!--{$JNK_PR}--></td>
										<td class="tdatacontentsum" align="right"><!--{$JNK_PM}--></td>
										<td class="tdatacontentsum" align="right"><!--{$JNK_PK}--></td>
										<td class="tdatacontentsum">&nbsp;</td>
										</tr>
										<tr>
										<td class="tdatacontentsum" colspan="2">Jumlah Segmen yang ditangani</td>
										<td class="tdatacontentsum">&nbsp;</td>
										<td class="tdatacontentsum" align="right"><!--{$JS_PR}--></td>
										<td class="tdatacontentsum" align="right"><!--{$JS_PM}--></td>
										<td class="tdatacontentsum" align="right"><!--{$JS_PK}--></td>
										<td class="tdatacontentsum">&nbsp;</td>
										</tr>
										<tr>
										<td class="tdatacontentsum" colspan="2">Panjang Segmen tiap penanganan (m)</td>
										<td class="tdatacontentsum">&nbsp;</td>
										<td class="tdatacontentsum" align="right"><!--{$PS_PR}--></td>
										<td class="tdatacontentsum" align="right"><!--{$PS_PM}--></td>
										<td class="tdatacontentsum" align="right"><!--{$PS_PK}--></td>
										<td class="tdatacontentsum">&nbsp;</td>
										</tr>
										<tr>
										<td class="tdatacontentsum" colspan="2">Rata-rata Nilai Kerusakan per Segmen (%)</td>
										<td class="tdatacontentsum">&nbsp;</td>
										<td class="tdatacontentsum" align="right"><!--{$RRNKS_PR}--></td>
										<td class="tdatacontentsum" align="right"><!--{$RRNKS_PM}--></td>
										<td class="tdatacontentsum" align="right"><!--{$RRNKS_PK}--></td>
										<td class="tdatacontentsum">&nbsp;</td>
										</tr>
										</tfooter>
									</TABLE>									
									</TD>	
								</TR>	
							</TABLE>
							
							</TD>	
								</TR>	
							</TABLE>
							<table cellpadding="0" cellspacing="1" width="75%" style="margin-top:5px;background:#F7F7F7;border=2 solid #CCC;font:12px/24px;" align="center">
									<tr><td width="110" style="padding-left:5px;">Program Kegiatan </td><td style="padding-left:5px;background:#FFF">
									<!--{if $JS_PR>$JS_PM AND $JS_PR>$JS_PK}-->PR
									<!--{elseif $JS_PM>$JS_PR AND $JS_PM>$JS_PK}-->PM
									<!--{elseif $JS_PK>$JS_PR AND $JS_PK>$JS_PM}-->PK
									<!--{else}-->-
									<!--{/if}-->
									</td></tr>
									<tr><td style="padding-left:5px;">Target Efektif</td><td style="padding-left:5px;background:#FFF">
									<!--{if $JS_PR>$JS_PM AND $JS_PR>$JS_PK}-->
									<!--{$RRNKS_PR}-->%  dari jumlah panjang segmen yang ditangani<br>
									<!--{$RRNKS_PR}-->% x <!--{$PS_PR}--> m<br>
									<!--{$JNK_PR}--> m
									<!--{elseif $JS_PM>$JS_PR AND $JS_PM>$JS_PK}-->
									<!--{$RRNKS_PM}-->%  dari jumlah panjang segmen yang ditangani<br>
									<!--{$RRNKS_PM}-->% x <!--{$PS_PM}--> m<br>
									<!--{$JNK_PM}--> m
									<!--{elseif $JS_PK>$JS_PR AND $JS_PK>$JS_PM}-->
									<!--{$RRNKS_PK}-->%  dari jumlah panjang segmen yang ditangani<br>
									<!--{$RRNKS_PK}-->% x <!--{$PS_PK}--> m<br>
									<!--{$JNK_PK}--> m
									<!--{else}-->-
									<!--{/if}-->
									</td></tr>
									</table>
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