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

<body>

<!-- ### START SEARCH BOX ### -->

<table id="searchBox" width="400px" border="0" cellspacing="0" cellpadding="0" class="tdatacontent">
  <tr>
    <td class="theadSearchBox"><b>Pencarian Data</b></td>
    <td class="theadSearchBox" align="right"><a href="#" id="closeSearchBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" border="0" class="buttonStyle"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentSearchBox">
    
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="tbl_search_box">							
			<TR>
								<TD width="100" align="right"><!--{$TB_NAME}--></TD>
								<TD><INPUT TYPE="text" NAME="nama_propinsi" size="35"></TD>
							</TR>
							
							<TR>
								<TD align="right"><!--{$TB_KABUPATEN_NAMA}--></TD>
								<TD><INPUT TYPE="text" NAME="nama_kabupaten" size="35"></TD>
			</TR>
			<TR><TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
				<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
				<INPUT TYPE="hidden" name="search" value="1">
				<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
				<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
				<INPUT TYPE="hidden" name="op" value="0">

				<a href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><img src="<!--{$HREF_IMG_PATH}-->/icon/btn_submit.png" border="0" class="buttonStyle"></a>
				<a href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><img src="<!--{$HREF_IMG_PATH}-->/icon/btn_reset.png" border="0" class="buttonStyle"></a>				

				</TD>
			</TR>
			</TABLE>
			</FORM>
			    
    </td>
  </tr>
</table>

<!-- ### END SEARCH BOX ### -->

<!-- ### START FORM BOX ### -->

<table id="formBox" width="400px" border="0" cellspacing="0" cellpadding="0" class="tdatacontent">
  <tr>
    <td class="theadFormBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/form.gif" align="absmiddle" border="0"> <!--{$FORM_NAME}--></td>
    <td class="theadFormBox" align="right"><a href="#" id="closeFormBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" border="0" class="buttonStyle"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentFormBox">
    		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="tbl_form_box">
				<TR>
					<TD width="100"><!--{$TB_CODE}--></TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="kab_id_foo" value="(AUTONUMBER BY SYSTEM)" size="35" readOnly class="text_disabled">
					<INPUT TYPE="hidden" NAME="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->">
					<!--{else}-->
					<INPUT TYPE="text" NAME="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
					</TD>			
				</TR>
				<TR>
					<TD width="100"><!--{$TB_NO_KAB}--></TD>
					<TD><INPUT TYPE="text" NAME="no_kabupaten" value="<!--{$EDIT_NO_KAB}-->" size="35"></TD>
				</TR>
				<TR>
					<TD width="100"><!--{$TB_NAME}--></TD>
					<TD> 
						<select name="no_prop"> 
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI}-->
						<!--{if $DATA_PROPINSI[x].no_propinsi == $EDIT_PROV_ID}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>				
					</TD>	
				</TR>
				<TR>
					<TD width="100"><!--{$TB_KABUPATEN_NAMA}--></TD>
					<TD><INPUT TYPE="text" NAME="nama_kabupaten" value="<!--{$EDIT_KABUPATEN_NAMA}-->" size="35"></TD>
				</TR>				
				<TR><td height="40"></td>
					<TD>
					<INPUT TYPE="hidden" name="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->">
					<INPUT TYPE="hidden" name="no_propinsi" value="<!--{$EDIT_PROV_ID}-->">
					<INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="0">
					
					<a href="#" onclick="this.blur();return checkFrm(frmCreate);"><img src="<!--{$HREF_IMG_PATH}-->/icon/btn_submit.png" border="0" class="buttonStyle"></a>
					<a href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><img src="<!--{$HREF_IMG_PATH}-->/icon/btn_reset.png" border="0" class="buttonStyle"></a>				
					</TD>
				</TR>
			</TABLE>
		</FORM>

    </td>
  </tr>
</table>
		
<!-- ### END FROM BOX ### -->		

<!-- ### START MAINPAGE ### -->

<DIV style="top:10px; width:100%;">
					
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
					<TD width="100"><!--{$TB_CODE}--></TD>
					<TD><!--{if $EDIT_VAL==0}-->
					<INPUT TYPE="text" NAME="kab_id_foo" value="(AUTONUMBER BY SYSTEM)" size="35" readOnly class="text_disabled">
					<INPUT TYPE="hidden" NAME="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->">
					<!--{else}-->
					<INPUT TYPE="text" NAME="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->" size="35" readOnly class="text_disabled">
					<!--{/if}-->
					</TD>			
				</TR>
				<TR>
					<TD width="100"><!--{$TB_NO_KAB}--></TD>
					<TD><INPUT TYPE="text" NAME="no_kabupaten" value="<!--{$EDIT_NO_KAB}-->" size="35"></TD>
				</TR>
				<TR>
					<TD width="100"><!--{$TB_NAME}--></TD>
					<TD> 
						<select name="no_prop"> 
						<option value=""> Pilih Provinsi </option>
						<!--{section name=x loop=$DATA_PROPINSI}-->
						<!--{if $DATA_PROPINSI[x].no_propinsi == $EDIT_PROV_ID}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->" selected > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{else}-->
						<option value="<!--{$DATA_PROPINSI[x].no_propinsi}-->"  > <!--{$DATA_PROPINSI[x].nama_propinsi}--> </option>
						<!--{/if}-->
						<!--{/section}-->
						</select>				
					</TD>	
				</TR>
				<TR>
					<TD width="100"><!--{$TB_KABUPATEN_NAMA}--></TD>
					<TD><INPUT TYPE="text" NAME="nama_kabupaten" value="<!--{$EDIT_KABUPATEN_NAMA}-->" size="35"></TD>
				</TR>				
				<TR><td height="40"></td>
					<TD>
					<INPUT TYPE="hidden" name="id_kabupaten" value="<!--{$EDIT_KAB_ID}-->">
					<INPUT TYPE="hidden" name="no_propinsi" value="<!--{$EDIT_PROV_ID}-->">
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
		
	<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="link" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">							
			<TR>
								<TD width="75" align="right"><!--{$TB_NAME}--></TD>
								<TD><INPUT TYPE="text" NAME="nama_propinsi" size="35"></TD>
							</TR>
							
							<TR>
								<TD width="75" align="right"><!--{$TB_KABUPATEN_NAMA}--></TD>
								<TD><INPUT TYPE="text" NAME="nama_kabupaten" size="35"></TD>
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
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
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
											<th class="tdatahead"><!--{$TB_NO_KAB}--></TH>
											<th class="tdatahead"><!--{$TB_NAME}--></TH>
											<th class="tdatahead"><!--{$TB_KABUPATEN_NAMA}--></TH>
											
				<th class="tdatahead" COLSPAN="2"><!--{$ACTION}--></th>
			</tr>
			</thead>
			<tbody>
			<!--{section name=x loop=$DATA_TB}-->										
			<tr class='<!--{cycle values="alt,alt3"}-->'>											
			<td width="17" class="tdatacontent-first-col"> <!--{$smarty.section.x.index+$COUNT_VIEW}-->.</TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_propinsi}--> </TD>
											<TD class="tdatacontent" nowrap> <!--{$DATA_TB[x].nama_kabupaten}--> </TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onclick="return checkEdit('<!--{$SELF}-->?opt=1&no_propinsi=<!--{$DATA_TB[x].no_propinsi}-->&id_kabupaten=<!--{$DATA_TB[x].id_kabupaten}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="link"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$DELETE}-->" onclick="return checkDelete('engine.php?op=2&no_propinsi=<!--{$DATA_TB[x].no_propinsi}-->&id_kabupaten=<!--{$DATA_TB[x].id_kabupaten}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="link"></TD>
										</TR>
										<!--{sectionelse}-->
										<TR>
											<TD class="tdatacontent" COLSPAN="5" align="center">Sorry, your query has not been successful, please try again</TD>
										</TR>
			<!--{/section}-->
			</tbody>
		</table>
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Show</td>
<td width="35"><INPUT TYPE="hidden" name="mod_id" value="<!--{$MOD_ID}-->">
		<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Record : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> of <!--{$COUNT}--></td>
<td align="right"><!--{$NEXT_PREV}--></td>
</tr>
</table>
</div>				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>
<!-- ### END MAINPAGE ### -->		
						
</BODY>
</HTML>