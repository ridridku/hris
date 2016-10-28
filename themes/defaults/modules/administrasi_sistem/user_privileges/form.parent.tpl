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

<body class="contentPage" onLoad="hideIt(); <!--{if $OPT==1}-->showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<!--{else}-->hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<!--{/if}-->">
		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/form.gif" align="absmiddle" border="0"> Profil Pengguna</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
					<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
					<TABLE id="table-add-box">
					<TR>
						<TD width="100">ID Pengguna</TD>			
						<TD > : <!--{$USER_ID}--></TD>	
						<INPUT TYPE="hidden" name="user_id" value="<!--{$USER_ID}-->">
					</TR>
					<TR>
						<TD>Nama Pengguna</TD>		
						<TD> : <!--{$USER_FULL_NAME|upper}--></TD>			
					</TR>
					<TR>
						<TD>Tanggal daftar</TD>			
						<TD> : <!--{$USER_DATE_JOIN}--></TD>			
					</TR>
					<TR>
						<TD>Alamat</TD>		
						<TD> : <!--{$USER_ADDRESS}--></TD>			
					</TR>
					<TR>
						<TD>Jenis kelamin</TD>		
						<TD> : <!--{if $USER_GENDER|upper == 'L'}-->Laki-laki<!--{else}-->Perempuan<!--{/if}--></TD>			
					</TR>
					<TR>
						<TD>Telp/handphone</TD>		
						<TD> : <!--{$USER_TELP}--></TD>			
					</TR>
					<TR>
						<TD>Email</TD>		
						<TD> : <!--{$USER_EMAIL}--></TD>			
					</TR>
			</TABLE>
		</FORM>
		
		</td></tr>
		</table>
		
		<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;Menu Utama</h5>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <!--{$TABLE_CAPTION}--></td></tr>
		</table>
		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
					<FORM METHOD="POST" ACTION="engine.php" NAME="frmList1">
					<TR>
					<th class="tdatahead">No Urut</th>
					<TH class="tdatahead">Menu Utama</TH>
					<TH class="tdatahead">Lihat</TH>
					<TH class="tdatahead">Sub Menu</TH>
					</TR>
					<!--{section name=x loop=$MENU_PARENT}-->
					<tr class='<!--{cycle values="alt,alt3"}-->'>
					<td width="40" class="tdatacontent-first-col"><!--{$smarty.section.x.index+1}--></td>
					<TD class="tdatacontent"><!--{$MENU_PARENT[x].menu_label}--></TD>
					<TD width="70" class="tdatacontent" align="center"><INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" NAME="ck_parent_<!--{$smarty.section.x.index}-->" 
					<!--{section name=y loop=$ARR_CEK_LIST}-->
					<!--{if $ARR_CEK_LIST[y].menu_id == $MENU_PARENT[x].menu_id}--> checked <!--{/if}-->
					<!--{/section}-->					
					id="ck_parent_<!--{$smarty.section.x.index}-->" class="checkbox"></TD>
					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('form.entry.php?user_id=<!--{$USER_ID}-->&menu_parent=<!--{$MENU_PARENT[x].menu_id}-->');" class="imgLink"></TD>
					</TR>
					<!--{/section}-->
					<TR><TD></td><TD></td><TD colspan="2" width="140">
                                        <INPUT TYPE="hidden" name="super_parent" value="1">
					<INPUT TYPE="hidden" name="user_id" value="<!--{$USER_ID}-->">
					<INPUT TYPE="hidden" name="implode_daftar_menu_id" value="<!--{$IMPLODE_DAFTAR_PARENT_ID}-->">
					<INPUT TYPE="hidden" name="jum_super_parent" value="<!--{$JUM_SUPER_PARENT}-->">
					<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); doNavigateContentOver('index.php','mainFrame');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</TR>
					</FORM>
					</TABLE>
		</td></tr>
		</table>
</BODY>
</HTML>
<script language="Javascript">
function cekChild(ini,ke) {
 var ck_parentinsert = document.getElementById('ck_parentinsert_'+ke);
 var ck_parentedit = document.getElementById('ck_parentedit_'+ke);
 
 //insert
if (ck_parentinsert.checked == true) 
{     
			 var jum_childinsert = document.getElementById('jum_child_'+ke).value;
			 for (var i=0;i<jum_childinsert;i++) {
				 document.getElementById('ck_childinsert_'+ke+'_'+i).disabled = false;
				 document.getElementById('ck_childinsert_'+ke+'_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childinsert = document.getElementById('jum_child_'+ke).value;
			 for (var i=0;i<jum_childinsert;i++) {
				 document.getElementById('ck_childinsert_'+ke+'_'+i).disabled = true;
				 document.getElementById('ck_childinsert_'+ke+'_'+i).checked = false;
			 }
 
 }
 //end insert


  //edit
if (ck_parentedit.checked == true) 
{     
			 var jum_childedit = document.getElementById('jum_child_'+ke).value;
			 for (var i=0;i<jum_childinsert;i++) {
				 document.getElementById('ck_childedit_'+ke+'_'+i).disabled = false;
				 document.getElementById('ck_childedit_'+ke+'_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childedit = document.getElementById('jum_child_'+ke).value;
			 for (var i=0;i<jum_childinsert;i++) {
				 document.getElementById('ck_childedit_'+ke+'_'+i).disabled = true;
				 document.getElementById('ck_childedit_'+ke+'_'+i).checked = false;
			 }
 
 }
 //end edit

}

</script>
