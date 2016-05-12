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



function display(obj,id1,id2) {
txt = obj.options[obj.selectedIndex].value;
document.getElementById(id1).style.display = 'none';
document.getElementById(id2).style.display = 'none';


if ( txt.match(id1) ) {
document.getElementById(id1).style.display = 'block';
}
if ( txt.match(id2) )
{
document.getElementById(id2).style.display = 'block';
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
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td></tr>
		<tr><td class="alt2" style="padding:0px;">
				
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">
				<TR>
					<TD width="100">Kode Jenis Kasus</TD>	
					<TD><!--{if $EDIT_VAL==0}-->					
					<INPUT TYPE="text" NAME="kode_kasus" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<!--{else}-->
					<INPUT TYPE="text" NAME="kode_kasus" value="<!--{$EDIT_KODE_KASUS}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
					</TD>			
				</TR>

				<TR>
					<TD>Nama Jenis Kasus </TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="nama_kasus" size="35">
					<!--{else}-->
					<INPUT TYPE="text" NAME="nama_kasus" value="<!--{$EDIT_NAMA_KASUS}-->" size="35">
					<!--{/if}-->
					</TD>
				</TR>			
							<tr>
								<td>Kategori kasus</td>
								<td><select name="jenis_kasus" onchange="cari_kab(this.value);">
										<option value="">[Pilih Kasus]</option>
										<option value="1" <!--{if $EDIT_JENIS_KASUS==1}--> selected <!--{/if}--> >Hukum </option>
										<option value="2" <!--{if $EDIT_JENIS_KASUS==2}--> selected <!--{/if}--> >Non Hukum </option>
								</select>
								</td>
							</tr>

							<tr>
								<td>Kategori Hukum</td>
								<td><select name="pil_kasus" <!--{$STAT}--> >
									<option value="">[Pilih Kategori Hukum]</option>
									 <option value="1"  <!--{if $EDIT_PIL_KASUS==1}--> selected <!--{/if}--> >Perdata</option>
									 <option value="2"  <!--{if $EDIT_PIL_KASUS==2}--> selected <!--{/if}--> >Pidana</option>
								</select>
								</td>
							</tr>
				<TR>
					<TD>Keterangan </TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="keterangan" size="40">
					<!--{else}-->
					<INPUT TYPE="text" NAME="keterangan" value="<!--{$EDIT_KETERANGAN}-->" size="35">
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
				<TD width="75">KODE JENIS KASUS</TD>
				<TD><INPUT TYPE="text" NAME="kode_kasus" size="25"></TD>
			</TR>
			<TR>
				<TD>NAMA JENIS KASUS</TD>
				<TD><INPUT TYPE="text" NAME="nama_kasus" id="nama_kasus" size="25">				
				</TD>
			</TR>
			<TR>
				<TD>KETERANGAN</TD>
				<TD><INPUT TYPE="text" NAME="keterangan" id="keterangan" size="25">				
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
				<a class="button" href="#" onclick="this.blur(); document.frmList1.reset(); frmList1.nama_kasus.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</CENTER>
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
		<table width="100%">
		<tr>
		<th class="tdatahead">No.</th>
	
		<th class="tdatahead" align="left">Nama Jenis Kasus</th>
		<th class="tdatahead" align="left">Kategori Kasus</th>
		<th class="tdatahead" align="left">Kategori Hukum</th>
 
		<th class="tdatahead" colspan="2"><!--{$ACTION}--></th>
		</tr>
		
<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>
				<td width="17" class="tdatacontent-first-col"><!--{$smarty.section.x.index+$COUNT_VIEW}--></td>
				
				<td class="tdatacontent" nowrap><!--{$DATA_TB[x].nama_kasus}--></td>
				<td class="tdatacontent" nowrap><!--{if ($DATA_TB[x].jenis_kasus)==1}--> Hukum <!--{/if}--><!--{if ($DATA_TB[x].jenis_kasus)==2}--> Non Hukum <!--{/if}--></td>
				<td class="tdatacontent" nowrap> 
				<!--{if ($DATA_TB[x].pil_kasus)==1}--> Perdata <!--{/if}--><!--{if ($DATA_TB[x].pil_kasus)==2}--> Pidana

			  <!--{/if}-->
				<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&kode_kasus=<!--{$DATA_TB[x].kode_kasus}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></td>
				<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&kode_kasus=<!--{$DATA_TB[x].kode_kasus}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="imgLink"></td>
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

<INPUT TYPE="hidden" name="kode_kasus" value="<!--{$KODE_KASUS}-->">
<INPUT TYPE="hidden" name="nama_kasus" value="<!--{$NAMA_KASUS}-->">
<INPUT TYPE="hidden" name="keterangan" value="<!--{$KETERANGAN}-->">

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