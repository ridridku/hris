<?php /* Smarty version 2.6.18, created on 2016-05-17 11:41:44
         compiled from defaults/modules/administrasi_sistem/user_privileges/form.parent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'defaults/modules/administrasi_sistem/user_privileges/form.parent.tpl', 54, false),array('function', 'cycle', 'defaults/modules/administrasi_sistem/user_privileges/form.parent.tpl', 99, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/preload.css" type="text/css">
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
			<img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/ajax-lob.gif" align="absmiddle"> Sedang Memuat....
		</td></tr>
	</table>
</div>

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/global.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->
</HEAD>

<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <?php echo $this->_tpl_vars['TABLE_CAPTION']; ?>
</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0"> Profil Pengguna</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
					<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
					<TABLE id="table-add-box">
					<TR>
						<TD width="100">ID Pengguna</TD>			
						<TD > : <?php echo $this->_tpl_vars['USER_ID']; ?>
</TD>	
						<INPUT TYPE="hidden" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
">
					</TR>
					<TR>
						<TD>Nama Pengguna</TD>		
						<TD> : <?php echo ((is_array($_tmp=$this->_tpl_vars['USER_FULL_NAME'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</TD>			
					</TR>
					<TR>
						<TD>Tanggal daftar</TD>			
						<TD> : <?php echo $this->_tpl_vars['USER_DATE_JOIN']; ?>
</TD>			
					</TR>
					<TR>
						<TD>Alamat</TD>		
						<TD> : <?php echo $this->_tpl_vars['USER_ADDRESS']; ?>
</TD>			
					</TR>
					<TR>
						<TD>Jenis kelamin</TD>		
						<TD> : <?php if (((is_array($_tmp=$this->_tpl_vars['USER_GENDER'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)) == 'L'): ?>Laki-laki<?php else: ?>Perempuan<?php endif; ?></TD>			
					</TR>
					<TR>
						<TD>Telp/handphone</TD>		
						<TD> : <?php echo $this->_tpl_vars['USER_TELP']; ?>
</TD>			
					</TR>
					<TR>
						<TD>Email</TD>		
						<TD> : <?php echo $this->_tpl_vars['USER_EMAIL']; ?>
</TD>			
					</TR>
			</TABLE>
		</FORM>
		
		</td></tr>
		</table>
		
		<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;Menu Utama</h5>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <?php echo $this->_tpl_vars['TABLE_CAPTION']; ?>
</td></tr>
		</table>
		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
					<FORM METHOD="POST" ACTION="engine.php" NAME="frmList1">
					<TR>
					<th class="tdatahead">No Urut</th>
					<TH class="tdatahead">Menu Utama</TH>
					<TH class="tdatahead">Lihat</TH>
					<TH class="tdatahead">Sub Menu</TH>
					</TR>
					<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['MENU_PARENT']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
					<tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
					<td width="40" class="tdatacontent-first-col"><?php echo $this->_sections['x']['index']+1; ?>
</td>
					<TD class="tdatacontent"><?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>
</TD>
					<TD width="70" class="tdatacontent" align="center"><INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" NAME="ck_parent_<?php echo $this->_sections['x']['index']; ?>
" 
					<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['ARR_CEK_LIST']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['y']['show'] = true;
$this->_sections['y']['max'] = $this->_sections['y']['loop'];
$this->_sections['y']['step'] = 1;
$this->_sections['y']['start'] = $this->_sections['y']['step'] > 0 ? 0 : $this->_sections['y']['loop']-1;
if ($this->_sections['y']['show']) {
    $this->_sections['y']['total'] = $this->_sections['y']['loop'];
    if ($this->_sections['y']['total'] == 0)
        $this->_sections['y']['show'] = false;
} else
    $this->_sections['y']['total'] = 0;
if ($this->_sections['y']['show']):

            for ($this->_sections['y']['index'] = $this->_sections['y']['start'], $this->_sections['y']['iteration'] = 1;
                 $this->_sections['y']['iteration'] <= $this->_sections['y']['total'];
                 $this->_sections['y']['index'] += $this->_sections['y']['step'], $this->_sections['y']['iteration']++):
$this->_sections['y']['rownum'] = $this->_sections['y']['iteration'];
$this->_sections['y']['index_prev'] = $this->_sections['y']['index'] - $this->_sections['y']['step'];
$this->_sections['y']['index_next'] = $this->_sections['y']['index'] + $this->_sections['y']['step'];
$this->_sections['y']['first']      = ($this->_sections['y']['iteration'] == 1);
$this->_sections['y']['last']       = ($this->_sections['y']['iteration'] == $this->_sections['y']['total']);
?>
					<?php if ($this->_tpl_vars['ARR_CEK_LIST'][$this->_sections['y']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']): ?> checked <?php endif; ?>
					<?php endfor; endif; ?>					
					id="ck_parent_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox"></TD>
					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onClick="return checkEdit('form.entry.php?user_id=<?php echo $this->_tpl_vars['USER_ID']; ?>
&menu_parent=<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
');" class="imgLink"></TD>
					</TR>
					<?php endfor; endif; ?>
					<TR><TD></td><TD></td><TD colspan="2" width="140">
					<INPUT TYPE="hidden" name="super_parent" value="1">
					<INPUT TYPE="hidden" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
">
					<INPUT TYPE="hidden" name="implode_daftar_menu_id" value="<?php echo $this->_tpl_vars['IMPLODE_DAFTAR_PARENT_ID']; ?>
">
					<INPUT TYPE="hidden" name="jum_super_parent" value="<?php echo $this->_tpl_vars['JUM_SUPER_PARENT']; ?>
">
					<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); return false;"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['SUBMIT']; ?>
</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); doNavigateContentOver('index.php','mainFrame');"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
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