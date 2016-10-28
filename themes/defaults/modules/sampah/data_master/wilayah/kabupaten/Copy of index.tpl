<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->

<title><!--{$TITLE}--></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/preload.css" type="text/css">
<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/default.css" type="text/css">
<script src="<!--{$HREF_JS_PATH}-->/jquery.js" type="text/javascript"></script>
<script src="<!--{$HREF_JS_PATH}-->/common.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="<!--{$HREF_JS_PATH}-->/global.js"></SCRIPT>

<script src="<!--{$HREF_JS_PATH}-->/jquery.imghover.js" type="text/javascript"></script>

<style type="text/css">
	img.pngfix, img.link, img.EditLink { behavior: url("<!--{$HREF_CSS_PATH}-->/iepngfix.htc") }
	img.link, img.EditLink { cursor:pointer; }
</style>

<div id="divLoadCont">
	<table width="100%" height="95%" align="center" valign="middle">
		<tr><td width="100%" height="100%" align="center" valign="middle">
			<img src="<!--{$HREF_IMG_PATH}-->/common/ajax-lob.gif" align="absmiddle"> Loading Page....
		</td></tr>
	</table>
</div>

<!-- #EndEditable -->

</HEAD>

<body>

<!-- ### START SEARCH BOX ### -->

<table id="searchBox" width="400px" border="0" cellspacing="0" cellpadding="0" class="tdatacontent">
  <tr>
    <td class="theadSearchBox"><b>Pencarian Data</b></td>
    <td class="theadSearchBox" align="right"><a href="#" id="closeSearchBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" border="0" align="absmiddle" class="imgLink" title="Close"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentSearchBox">
    
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="tbl_search_box">							
			<TR>
								<TD><!--{$TB_NAME}--></TD>
								<TD><INPUT TYPE="text" NAME="nama_propinsi" size="35"></TD>
							</TR>
							
							<TR>
								<TD><!--{$TB_KABUPATEN_NAMA}--></TD>
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

				<a href="#" class="button" onClick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
				<a href="#" class="button" onClick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>				

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
    <td class="theadFormBox" align="right"><a href="#" id="closeFormBox"><img src="<!--{$HREF_IMG_PATH}-->/icon/close.gif" border="0" align="absmiddle" class="imgLink" title="Close"></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="tcontentFormBox">
    		
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="tbl_form_box">
				<TR>
					<TD><!--{$TB_NO_KAB}--></TD>
					<TD><INPUT TYPE="text" NAME="no_kabupaten" value="<!--{$EDIT_NO_KAB}-->" size="35"></TD>
				</TR>
				<TR>
					<TD><!--{$TB_NAME}--></TD>
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
					<TD><!--{$TB_KABUPATEN_NAMA}--></TD>
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
					
					<a href="#" class="button" onClick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a href="#" class="button" onClick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>				
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
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
									
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr><td class="thead">
		<div style="float:left;"><img src="<!--{$HREF_IMG_PATH}-->/icon/columns.gif" align="absmiddle" border="0" class="pngfix" style="margin-right:5px;"> <!--{$TABLE_NAME}--></div>
		<div style="float:right;">		
		<a href="#" id="openFormBox" class="button"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/details.gif" align="absmiddle">Data Baru</span></a> 		
		<a href="#" id="openSearchBox" class="button"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/search.png" align="absmiddle"> Search By</span></a>&nbsp;
		</div>


		</td></tr>
		<tr><td class="alt2" style="padding:0px;">
				
		<DIV id="ID_MAINPAGE">
		
		<table width="100%" cellspacing="1" cellpadding="1">
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
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" BORDER=0 title="<!--{$EDIT}-->" onClick="getEditData(<!--{$DATA_TB[x].no_propinsi}-->,<!--{$DATA_TB[x].id_kabupaten}-->);" class="EditLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/delete.gif" BORDER=0 title="<!--{$DELETE}-->" onClick="return checkDelete('engine.php?op=2&no_propinsi=<!--{$DATA_TB[x].no_propinsi}-->&id_kabupaten=<!--{$DATA_TB[x].id_kabupaten}-->&mod_id=<!--{$MOD_ID}-->&<!--{$STR_COMPLETER_}-->');" class="link"></TD>
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
		<SELECT NAME="limit" onChange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<!--{section name=x loop=$LISTVAL}-->
		<OPTION VALUE = "<!--{$LISTVAL[x]}-->" <!--{if $LISTVAL[x]==$LIMIT}--> SELECTED <!--{/if}-->> <!--{$LISTVAL[x]}--> </OPTION>
		<!--{/section}-->
		</SELECT></td>
<td>Record : <!--{$COUNT_VIEW}--> - <!--{$COUNT_ALL}--> of <!--{$COUNT}--></td>
<td align="right"><!--{$NEXT_PREV}--></td>
</tr>
</table>
</div>

</DIV>
					
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<!--{$HREF_IMG_PATH}-->/layout/note.png"></div>

	</DIV>

<!-- ### END MAINPAGE ### -->		
						
</BODY>
</HTML>