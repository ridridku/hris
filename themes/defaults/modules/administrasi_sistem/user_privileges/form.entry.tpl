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
		
					
					<TABLE id="table-add-box">
					<TR>
						<TD width="100">ID Pengguna</TD>			
						<TD > : <!--{$USER_ID}--></TD>							
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
		
		</td></tr>
		</table>

		<!--{if $CHECK_LIST_MENU == '0'}-->
		
					<!--{if $CHILD != '2'}-->
					<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;Sub Menu</h5>		
					<!--{else}-->
					<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;<!--{$MENU_LABEL_SUB}-->&nbsp;-->&nbsp;<!--{$MENU_LABEL}--></h5>		
					<!--{/if}-->

		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
					<TR>
					<th class="tdatahead">No Urut</th>
					<TH class="tdatahead">Menu Utama/Sub Menu</TH>
					<TH class="tdatahead" width="40">Lihat</TH>
					<TH class="tdatahead" width="40">Tambah</TH>
					<TH class="tdatahead" width="40">Ubah</TH>
					<TH class="tdatahead" width="40">Hapus</TH>
					<TH class="tdatahead" width="40">Cari</TH>
					<TH class="tdatahead" width="40">Laporan</TH>
					<TH class="tdatahead" width="40">Cetak</TH>
					</TR>
					<input type="hidden" name="menu_id_cek" value="<!--{$DAFTAR_MENU_ID}-->">
					<input type="hidden" name="count_child" id="count_child" value="<!--{$COUNT_CHILD}-->">
					<!--{section name=x loop=$MENU_PARENT}-->
					 <input type="hidden" name="jum_child" id="jum_child" value="<!--{$LIST_JUM_PARENT[x].jumlah}-->">
					 <input type="hidden" name="parent_<!--{$smarty.section.x.index}-->" id="parent_<!--{$smarty.section.x.index}-->" value="<!--{$MENU_INSERT}-->">
					<tr class='<!--{cycle values="alt,alt3"}-->'>
					<td width="40" class="tdatacontent-first-col"><!--{$smarty.section.x.index+1}--></td>
					<TD class="tdatacontent"><B>
						<!--{$MENU_PARENT[x].menu_label}--></B>
					</TD>

					<!-- view -->
					<TD align="center">   
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childview_<!--{$smarty.section.x.index}-->" 
						<!--{section name=pv loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pv].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pv].priv_view == '1' }--> checked <!--{/if}--> 						
						<!--{/section}-->
						id="ck_childview_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_View(this.form,'<!--{$smarty.section.x.index}-->');">
					</TD>
					<!-- end view -->

					<TD align="center"> 
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childinsert_<!--{$smarty.section.x.index}-->" 
						<!--{section name=pi loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pi].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pi].priv_insert == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->
						id="ck_childinsert_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Insert(this.form,'<!--{$smarty.section.x.index}-->');">
					</TD>

					<TD align="center"> 
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childedit_<!--{$smarty.section.x.index}-->"
						<!--{section name=pe loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pe].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pe].priv_edit == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->
						id="ck_childedit_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Edit(this.form,'<!--{$smarty.section.x.index}-->');" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}-->>
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childdelete_<!--{$smarty.section.x.index}-->"  
						<!--{section name=pd loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pd].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pd].priv_delete == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->						
						id="ck_childdelete_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Delete(this.form,'<!--{$smarty.section.x.index}-->');">
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childsearch_<!--{$smarty.section.x.index}-->"
						<!--{section name=ps loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[ps].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[ps].priv_search == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->
						id="ck_childsearch_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Search(this.form,'<!--{$smarty.section.x.index}-->');" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}-->>
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childreport_<!--{$smarty.section.x.index}-->"
						<!--{section name=pr loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pr].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pr].priv_report == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->
						id="ck_childreport_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Report(this.form,'<!--{$smarty.section.x.index}-->');" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}-->>
					</TD>
					<TD align="center">
						<INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}--> NAME="ck_childprint_<!--{$smarty.section.x.index}-->"
						<!--{section name=pp loop=$CEK_LIST_PRIV_ORTU}-->
						<!--{if $CEK_LIST_PRIV_ORTU[pp].menu_id == $MENU_PARENT[x].menu_id && $CEK_LIST_PRIV_ORTU[pp].priv_print == '1' }--> checked<!--{/if}--> 						
						<!--{/section}-->
						id="ck_childprint_<!--{$smarty.section.x.index}-->" class="checkbox" onClick="cekChild_Print(this.form,'<!--{$smarty.section.x.index}-->');" <!--{ if $COUNT_CHILD == 0}--> disabled <!--{/if}-->>
					</TD>
					</TR>
					<!--{section name=y loop=$MENU_CHILD}-->
					<!--{if $MENU_CHILD[y].menu_parent == $MENU_PARENT[x].menu_id}-->
					<tr class='<!--{cycle values="alt,alt3"}-->'>
					<td width="40" class="tdatacontent-first-col"><!--{$smarty.section.x.index+1}-->.<!--{$smarty.section.y.index+1}--></td>
					<TD class="tdatacontent">
						<!--{$MENU_CHILD[y].menu_label}-->
					</TD>


					<!-- view child -->
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox"  NAME="ck_childview_<!--{$smarty.section.y.index+1}-->" 
						<!--{section name=v loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[v].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[v].priv_view == '1' }--> checked <!--{/if}--> 
						<!--{/section}--> 
						id="ck_childview_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->  class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->" >
					</TD>



					<!-- end view child -->

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox"  NAME="ck_childinsert_<!--{$smarty.section.y.index+1}-->" 
						<!--{section name=i loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[i].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[i].priv_insert == '1' }--> checked <!--{/if}--> 
						<!--{/section}--> 
						id="ck_childinsert_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->  class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->" >
					</TD>

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childedit_<!--{$smarty.section.y.index+1}-->" 
						<!--{section name=e loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[e].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[e].priv_edit == '1' }--> checked <!--{/if}--> 
						<!--{/section}--> 						
						id="ck_childedit_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}--> class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->">
					</TD>

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childdelete_<!--{$smarty.section.y.index+1}-->"
						<!--{section name=d loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[d].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[d].priv_delete == '1' }--> checked <!--{/if}--> <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->
						<!--{/section}--> 	
						id="ck_childdelete_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}--> class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childsearch_<!--{$smarty.section.y.index+1}-->"
						<!--{section name=s loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[s].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[s].priv_search == '1' }--> checked <!--{/if}-->  <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->
						<!--{/section}--> 	
						id="ck_childsearch_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}--> class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childreport_<!--{$smarty.section.y.index+1}-->"
						<!--{section name=r loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[r].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[r].priv_report == '1' }--> checked <!--{/if}-->  <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->
						<!--{/section}--> 	
						id="ck_childreport_<!--{$smarty.section.y.index+1}-->" <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}--> class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childprint_<!--{$smarty.section.y.index+1}-->" 
						<!--{section name=p loop=$CEK_LIST_PRIV_ANAK}-->
							<!--{if $CEK_LIST_PRIV_ANAK[p].priv_menu_id == $MENU_CHILD[y].menu_id && $CEK_LIST_PRIV_ANAK[p].priv_print == '1' }--> checked <!--{/if}--> <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}-->
						<!--{/section}--> 	
						id="ck_childprint_<!--{$smarty.section.y.index+1}-->"  <!--{if $SET_DISABLED_ANAK == '0'}--> disabled<!--{/if}--> class="checkbox" value="<!--{$MENU_CHILD[y].menu_id}-->">
					</TD>
					</TR>
					<!--{/if}-->
					<!--{/section}-->

				<!--{/section}-->

					<TR><TD></td><TD></td><TD colspan="7" width="280">
					<INPUT TYPE="hidden" name="user_id" value="<!--{$USER_ID}-->">
					<INPUT TYPE="hidden" name="menu_ortu" value="<!--{$MENU_INSERT}-->">
					<INPUT TYPE="hidden" name="super_parent" value="3">
					<a class="button" href="#" onclick="this.blur(); document.frmCreate.submit(); return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); doNavigateContentOver('index.php','mainFrame');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</TR>
					</FORM>
					</TABLE>
		</td></tr>
		</table>
				<!--END 2ND CONTENT BLOCK-->



				<!--{else}-->


				<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;<!--{$MENU_LABEL}--></h5>		


				<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
				<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
				<tr><td class="alt2" style="padding:0px;">

				<table width="100%"> 
				<FORM METHOD="POST" ACTION="engine.php" NAME="frmList1">
					<TR><th class="tdatahead">No Urut</th>
					<TH class="tdatahead">Menu Utama</TH>
					<TH class="tdatahead">Lihat</TH>
					<TH class="tdatahead">Sub Menu</TH>
					</TR>
					<!--{section name=x loop=$MENU_PARENT}-->
					<tr class='<!--{cycle values="alt,alt3"}-->'>
					<td width="40" class="tdatacontent-first-col"><!--{$smarty.section.x.index+1}--></td>
					<TD class="tdatacontent"><!--{$MENU_PARENT[x].menu_label}--></TD>

					<TD width="70" class="tdatacontent" align="center"><INPUT TYPE="checkbox" value="<!--{$MENU_PARENT[x].menu_id}-->" NAME="ck_sub_parent_<!--{$smarty.section.x.index}-->" 
					<!--{section name=y loop=$ARR_CEK_LIST_SUB_PARENT}-->
					<!--{if $ARR_CEK_LIST_SUB_PARENT[y].menu_id == $MENU_PARENT[x].menu_id}--> checked <!--{/if}-->
					<!--{/section}-->
					
					id="ck_parent_<!--{$smarty.section.x.index}-->" class="checkbox"></TD>


<!--{if ($LEVEL=='')}-->

					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('form.entry.php?global_parent_menu=<!--{$GLOBAL_PARENT_MENU}-->&menu_ortu=<!--{$MENU_ORTU}-->&child=2&user_id=<!--{$USER_ID}-->&menu_parent=<!--{$MENU_PARENT[x].menu_id}-->');" class="imgLink"></TD>
<!--{else}-->

					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<!--{$HREF_IMG_PATH}-->/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<!--{$EDIT}-->" onClick="return checkEdit('form.entry.php?global_parent_menu=<!--{$GLOBAL_PARENT_MENU}-->&menu_ortu=<!--{$MENU_ORTU}-->&child=3&user_id=<!--{$USER_ID}-->&menu_parent=<!--{$MENU_PARENT[x].menu_id}-->');" class="imgLink"></TD>

<!--{/if}-->
					</TR>
					<!--{/section}-->
					<TR><TD></td><TD></td><TD colspan="2" width="140">
					<INPUT TYPE="hidden" name="super_parent" value="2">
					<INPUT TYPE="hidden" name="user_id" value="<!--{$USER_ID}-->">
					<INPUT TYPE="hidden" name="implode_daftar_menu_id" value="<!--{$IMPLODE_DAFTAR_SUB_PARENT_ID}-->">
					<INPUT TYPE="hidden" name="jum_super_parent" value="<!--{$JUM_SUPER_SUB_PARENT}-->">
					<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); return false;"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$SUBMIT}--></span></a>
					<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); doNavigateContentOver('index.php','mainFrame');"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle"><!--{$RESET}--></span></a>					
				</TR>
					</FORM>
					</TABLE>
		</td></tr>
		</table>
<!--{/if}-->

</BODY>
</HTML>
<script language="Javascript">
function cekChild_View(ini, ke) {
 
 var ck_parentview = document.getElementById('ck_childview_'+ke);
 
 //insert
if (ck_parentview.checked == true) 
{     
			 var jum_childview = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childview;i++) {
				 document.getElementById('ck_childview_'+i).disabled = false;
				 document.getElementById('ck_childview_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childview = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childview;i++) {
				 document.getElementById('ck_childview_'+i).disabled = true;
				 document.getElementById('ck_childview_'+i).checked = false;
			 }
 
 }
 //end insert
}


function cekChild_Insert(ini, ke) {
 
 var ck_parentinsert = document.getElementById('ck_childinsert_'+ke);
 
 //insert
if (ck_parentinsert.checked == true) 
{     
			 var jum_childinsert = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childinsert;i++) {
				 document.getElementById('ck_childinsert_'+i).disabled = false;
				 document.getElementById('ck_childinsert_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childinsert = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childinsert;i++) {
				 document.getElementById('ck_childinsert_'+i).disabled = true;
				 document.getElementById('ck_childinsert_'+i).checked = false;
			 }
 
 }
 //end insert
}


function cekChild_Edit(ini, ke) {
 
 var ck_parentedit = document.getElementById('ck_childedit_'+ke);
 

 //edit
if (ck_parentedit.checked == true) 
{     
			 var jum_childedit = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childedit;i++) {
				 document.getElementById('ck_childedit_'+i).disabled = false;
				 document.getElementById('ck_childedit_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childedit = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childedit;i++) {
				 document.getElementById('ck_childedit_'+i).disabled = true;
				 document.getElementById('ck_childedit_'+i).checked = false;
			 }
 
 }
 //end edit

}


function cekChild_Delete(ini, ke) {
 
 var ck_parentdelete = document.getElementById('ck_childdelete_'+ke);
 

 //delete
if (ck_parentdelete.checked == true) 
{     
			 var jum_childdelete = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childdelete;i++) {
				 document.getElementById('ck_childdelete_'+i).disabled = false;
				 document.getElementById('ck_childdelete_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childdelete = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childdelete;i++) {
				 document.getElementById('ck_childdelete_'+i).disabled = true;
				 document.getElementById('ck_childdelete_'+i).checked = false;
			 }
 
 }
 //end delete
}


function cekChild_Search(ini, ke) {
 
 var ck_parentsearch = document.getElementById('ck_childsearch_'+ke);
 

 //search
if (ck_parentsearch.checked == true) 
{     
			 var jum_childsearch = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childsearch;i++) {
				 document.getElementById('ck_childsearch_'+i).disabled = false;
				 document.getElementById('ck_childsearch_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childsearch = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childsearch;i++) {
				 document.getElementById('ck_childsearch_'+i).disabled = true;
				 document.getElementById('ck_childsearch_'+i).checked = false;
			 }
 
 }
 //end search
}

function cekChild_Report(ini, ke) {
 
 var ck_parentreport = document.getElementById('ck_childreport_'+ke);
 

 //report
if (ck_parentreport.checked == true) 
{     
			 var jum_childreport = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childreport;i++) {
				 document.getElementById('ck_childreport_'+i).disabled = false;
				 document.getElementById('ck_childreport_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childreport = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childreport;i++) {
				 document.getElementById('ck_childreport_'+i).disabled = true;
				 document.getElementById('ck_childreport_'+i).checked = false;
			 }
 
 }
 //end report
}


function cekChild_Print(ini, ke) {
 
 var ck_parentprint = document.getElementById('ck_childprint_'+ke);
 

 //print
if (ck_parentprint.checked == true) 
{     
			 var jum_childprint = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childprint;i++) {
				 document.getElementById('ck_childprint_'+i).disabled = false;
				 document.getElementById('ck_childprint_'+i).checked = true;
			 }

 } else 
 {

			 var jum_childprint = document.getElementById('jum_child').value;
			 for (var i=1;i<=jum_childprint;i++) {
				 document.getElementById('ck_childprint_'+i).disabled = true;
				 document.getElementById('ck_childprint_'+i).checked = false;
			 }
 
 }
 //end print
}

</script>
