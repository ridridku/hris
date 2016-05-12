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
							</TR> -->

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
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
				<TR>
				<td width="150">Tanggal</td><td><input type="text" name="tanggal" value="
<!--{if $TANGGAL==''}-->

<!--{else}-->
<!--{$TANGGAL}-->
<!--{/if}-->"> <img src="<!--{$HREF_IMG_PATH}-->/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'dd-mm-yyyy',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
</td></tr>
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
<tr><td>Nama Kabupaten</td><td>
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
</td></tr>
<tr>
<td>Kategori Jalan</td>
<td><!--{if $NO_JENIS_JALAN=="1"}-->Provinsi<!--{else}-->Kabupaten/ Kota<!--{/if}--></td>
</tr>
</table>			

<div id="title-box2">Data Ruas Jalan</div>

<table id="table-add-box">
<tr><td width="150">Nomor Ruas</td><td width="200">: <!--{$NO_RUAS}--></td>
<td>Disurvai Oleh</td><td>: <!--{$DISURVAI}--></td></tr>
<tr><td>Nama Pangkal Ruas</td><td>: <!--{$NAMA_PANGKAL_RUAS}--></td>
<td>Tipe Kendaraan</td><td>: <!--{$TIPE_KENDARAAN}--></td></tr>
<tr><td>Nama Ujung Ruas</td><td>: <!--{$NAMA_UJUNG_RUAS}--></td>
<td>Fakt. Penyesuaian Odometer</td><td>: <!--{$FAKT_PENYESUAIAN_ODOMETER}--></td></tr>
<tr><td>Titik Pengenal Pangkal</td><td>: <!--{$TITIK_PENGENAL_PANGKAL}--></td>
<td>KM Odometer</td><td>: <!--{$KM_ODOMETER}--></td></tr>
<tr><td>Titik Pengenal Ujung</td><td>: <!--{$TITIK_PENGENAL_UJUNG}--></td>
<td>KM YSD</td><td>: <!--{$KM_YSD}--></td></tr>
</table>

<div id="title-box2">Data Detail Survai Kondisi Jalan
</div>

<table style="margin-top:-0;" width="980">
<thead>
<tr>
<th rowspan="2" class="tdatahead" width="250">Angka KM Odo</th>
<th rowspan="2" class="tdatahead" width="100">KM YSD</th>
<th colspan="3" class="tdatahead">Permukaan Jalan</th>
<th rowspan="2" class="tdatahead" width="100">Drainase</th>
<th class="tdatahead" width="100">Lubang (B)</th>
<th class="tdatahead" width="100">Lenggok (C)</th>
<th class="tdatahead" width="100">Retak (D)</th>
<th class="tdatahead" width="100">Alur (E)</th>
<th class="tdatahead" width="100">Bahu (L)</th>
<th class="tdatahead" width="100">Kmrg (K)</th>
<th rowspan="2" class="tdatahead" width="100">Penilaian</th>
</tr>
<tr>
<th class="tdatahead" width="100">Tipe</th>
<th class="tdatahead" width="145">Kondisi (A)</th>
<th class="tdatahead" width="100">Lebar (m)</th>
<th class="tdatahead">Lubang (F)</th>
<th class="tdatahead">Lembek (G)</th>
<th class="tdatahead">Erosi (H)</th>
<th class="tdatahead">Alur (I)</th>
<th class="tdatahead">Gelombang (J)</th>
<th class="tdatahead">Kmrg (K)</th>
</tr>
</thead>

<!--{section name=x loop=$DATA_DETAIL}-->
<tr>
<!-- Disabled on 14-09-2010
<td class="tdatacontent"><!--{$DATA_DETAIL[x].km_odometer}--></td>
<td class="tdatacontent"><!--{$DATA_DETAIL[x].km_ysd}--></td>
-->
<td class="tdatacontent"><!--{$DATA_KM_ODOMETER[x]}--></td>
<td class="tdatacontent"><!--{$DATA_KM_YSD[x]}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].nama_tipe_jalan}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].nama_kondisi_jalan}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].lebar_permukaan_jalan}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].drainase}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom1}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom2}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom3}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom4}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom5}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].kolom6}--></td>

<td class="tdatacontent"><!--{$DATA_DETAIL[x].penilaian}--></td>

<!--{/section}-->
</table>			
					</TD>
				</TR>
			</TABLE>
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