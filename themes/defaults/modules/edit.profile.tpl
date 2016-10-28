<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><!--{$TITLE}--></title>

<style type="text/css">
img.pngfix { behavior: url("<!--{$HREF_CSS_PATH}-->/iepngfix.htc") }
</style>

<link rel="stylesheet" href="<!--{$HREF_CSS_PATH}-->/common.css" type="text/css">
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

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body id="contentPage"  onload="hideIt()">
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"><img src="<!--{$HREF_IMG_PATH}-->/icon/tbl_master.png" align="absmiddle" border="0" class="pngfix" style="margin-left:4px;">  Master Profil Pengguna</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<!--{$HREF_IMG_PATH}-->/icon/form.gif" align="absmiddle" border="0"> Ubah Profil</td></tr>
		<tr><td class="alt2" style="padding:0px;">
				
		<FORM NAME="frmCreate" METHOD="POST" ACTION="edit.engine.php">
		<img src="<!--{$HREF_IMG_PATH}-->/icon/profile.png" class="pngfix" style="float:left;margin-top:25px;margin-left:10px;">
		<TABLE id="table-search-box">
				<TR>
					<TD width="200">Nama Depan</TD>
					<TD><INPUT TYPE="text" NAME="user_first_name" readonly=""  value="<!--{$EDIT_USER_FIRST_NAME|upper}-->" size="35" maxlength="50"></TD>
				</TR>
				<TR>
					<TD>Nama Belakang</TD>
					<TD><INPUT TYPE="text" NAME="user_last_name" readonly="" value="<!--{$EDIT_USER_LAST_NAME|upper}-->" size="35" maxlength="50"></TD>
				</TR>
				<TR>
					<TD>Alamat</TD>
					<TD><INPUT TYPE="text" NAME="user_address" readonly="" value="<!--{$EDIT_USER_ADDRESS}-->" size="35"></TD>
				</TR>
				<TR>
					<TD>Telepon</TD>
					<TD><INPUT TYPE="text" NAME="user_telp" readonly="" value="<!--{$EDIT_USER_TELP}-->" size="35"></TD>
				</TR>
			<!--	<TR>
					<TD>Jenis Kelamin</TD>
					<TD>
					<SELECT name="user_gender">
					<OPTION value="">[PILIH]</OPTION>
					<OPTION value="L"  $EDIT_USER_GENDER == 'L'} selected /if>Laki-laki</OPTION>
					<OPTION value="P"  $EDIT_USER_GENDER == 'P'} selected >Perempuan</OPTION>
					</TD>
				</TR>-->
				<TR>
					<TD>Email</TD>
                                        <TD><INPUT TYPE="text" readonly="" NAME="user_email" value="<!--{$EDIT_USER_EMAIL}-->" size="35"></TD>
				</TR>

				<TR>
					<TD>Sandi</TD>
                                        <TD><INPUT TYPE="password" NAME="password" value="<!--{$EDIT_USER_PASSWORD}-->" size="35"></TD>
				</TR>

				<TR>
					<td></td>
					<TD ALIGN="left" valign="bottom" height="35">
					<INPUT TYPE="hidden" name="user_id" value="<!--{$EDIT_USER_ID}-->">
					<INPUT TYPE="hidden" name="limit" value="<!--{$LIMIT}-->">
					<INPUT TYPE="hidden" name="SORT" value="<!--{$SORT}-->">
					<INPUT TYPE="hidden" name="page" value="<!--{$page}-->">
					<INPUT TYPE="hidden" name="op" value="1">
					<input name="submit" type="submit" value="Simpan" class="button" onclick="document.frmCreate.submit()"> 
					<input name="reset" type="reset" value="Batal" class="button"  onclick="document.frmCreate.reset(); doNavigateContentOver('main.frame.php', 'mainFrame');">		
					</TD>
				</TR>
			</TABLE>
		</FORM>
		
		</td></tr>
		</table>
</BODY>
</HTML>
