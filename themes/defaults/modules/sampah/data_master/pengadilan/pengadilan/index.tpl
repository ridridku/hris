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
			<img src="<!--{$HREF_IMG_PATH}-->/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">

<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <!--{if $OPT==1}--> DISABLED <!--{/if}-->><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle"> <!--{$BTN_NEW}--></span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>

		<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Master Pengadilan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Formn Add/Edit Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">
				
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
				<TR>
					<TD width="100">KODE PENGADILAN</TD>	
					<TD><!--{if $EDIT_VAL==0}-->					
					<INPUT TYPE="text" NAME="kode_pn" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
					<INPUT TYPE="text" NAME="kode_pn" value="<!--{$EDIT_KODE_PN}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
					</TD>			
				</TR>
				
				<TR>
					<TD>ASAL PENGADILAN</TD>
					<TD>
					
					<!--{if $EDIT_VAL==0}-->
						<select name="kode_asal">
						<option value=""> Pilih nama asal </option>
						<option value=1>Pengadilan Negeri</option>
						<option value=2>Pengadilan Tinggi</option>
						<option value=3>Pengadilan Agama</option>
							</select> 					
					<!--{else}-->					
							<select name="kode_asal">
							<option value=""> Pilih nama Perwakilan </option>
								<option value=1 <!--{if $EDIT_KODE_ASAL==1}--> selected>Pengadilan Negeri <!--{/if}--></option>
								<option value=2 <!--{if $EDIT_KODE_ASAL==2}--> selected>Pengadilan Tinggi <!--{/if}--></option>
								<option value=3 <!--{if $EDIT_KODE_ASAL==3}--> selected>Pengadilan Agama <!--{/if}--></option>											
							</select> 
					
					<!--{/if}-->
					</TD>
				</TR>			
				
				<TR>
					<TD>NAMA PENGADILAN </TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="nama_pn" size="35">
					<!--{else}-->
					<INPUT TYPE="text" NAME="nama_pn" value="<!--{$EDIT_NAMA_PN}-->" size="35">
					<!--{/if}-->
					</TD>
				</TR>

				<TR>
					<TD>PROPINSI</TD>
					<TD>
						<select name="no_propinsi"  > 
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI}-->
						<!--{if trim($DATA_PROPINSI[x].no_propinsi) == $EDIT_NO_PROPINSI}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>				
					</TD>	
				</TR>


				<TR>
					<TD>ALAMAT </TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="alamat" size="35">
					<!--{else}-->
					<INPUT TYPE="text" NAME="alamat" value="<!--{$EDIT_ALAMAT}-->" size="35">
					<!--{/if}-->
					</TD>
				</TR>	
				
				<TR>
					<TD>TELEPON - FAX </TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="tlp" size="35">
					<!--{else}-->
					<INPUT TYPE="text" NAME="tlp" value="<!--{$EDIT_TLP}-->" size="35">
					<!--{/if}-->
					</TD>
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
		
	<DIV ID="_menuEntry2_1" style="top:10;width:100%;position:absolute;">
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
				<TD width="75">KODE PENGADILAN</TD>
				<TD><INPUT TYPE="text" NAME="kode_pn" size="25"></TD>
			</TR>
			<TR>
				<TD>ASAL</TD>
				<TD>
					<select name="kode_asal">
						<option value=""> Pilih nama asal </option>
						<option value=1>Pengadilan Negeri</option>
						<option value=2>Pengadilan Tinggi</option>
						<option value=3>Pengadilan Agama</option>
							</select> 					
				</TD>
			</TR>
			<TR>
				<TD>NAMA PENGADILAN</TD>
				<TD><INPUT TYPE="text" NAME="nama_pn" id="nama_pn" size="25">				
				</TD>
			</TR>
			<TR>
				<TD>ALAMAT</TD>
				<TD><INPUT TYPE="text" NAME="alamat" id="alamat" size="25">				
				</TD>
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
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">Cari</span></a>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.reset(); frmList1.nama_pjtka.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</CENTER>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></div>	
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Master Pengadilan</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Daftar Tabel Pengadilan</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
		<th class="tdatahead" align="left">No.</th>
 
		<th class="tdatahead" align="left">Asal</th>
		<th class="tdatahead" align="left">Propinsi</th>
		<th class="tdatahead" align="left">Nama Pengadilan</th>

		<th class="tdatahead" align="left">Alamat</th>
		<th class="tdatahead" colspan="2"><!--{$ACTION}--></th>
		</tr>
		
<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td width="17" class="tdatacontent-first-col"><!--{$smarty.section.x.index+$COUNT_VIEW}--></td>
			 
				
				
				<!--{if ($DATA_TB[x].kode_asal == 1) }-->
				<td class="tdatacontent" nowrap>Pengadilan Negeri</td>
				<!--{elseif ($DATA_TB[x].kode_asal == 2) }-->
				<td class="tdatacontent" nowrap>Pengadilan Tinggi</td>
				<!--{else}-->
				<td class="tdatacontent" nowrap>Pengadilan Agama</td>
				<!--{/if}-->
				
				
				<td class="tdatacontent" nowrap><!--{$DATA_TB[x].nama_propinsi}--></td>
				<td class="tdatacontent" nowrap><!--{$DATA_TB[x].nama_pn}--></td>
				<td class="tdatacontent" nowrap><!--{$DATA_TB[x].alamat}--></td>
				<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&kode_pn=<!--{$DATA_TB[x].kode_pn}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></td>
				<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&kode_pn=<!--{$DATA_TB[x].kode_pn}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></td>
			</tr>
			<!--{sectionelse}-->
			<tr>
				<td class="tdatacontent" COLSPAN="5" align="center">Maaf, Data masih kosong</td>
			</tr>
			<!--{/section}-->	

		</table>
		
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Tampilkan</td>
<td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">

<INPUT TYPE="hidden" name="kode_asal" value="<!--{$kode_asal}-->">
<INPUT TYPE="hidden" name="alamat" value="<!--{$alamat}-->">
<INPUT TYPE="hidden" name="nama_pn" value="<!--{$nama_pn}-->">
<INPUT TYPE="hidden" name="kode_pn" value="<!--{$kode_pn}-->">


		<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Baris : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> dari <!--{$COUNT}--></td>
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