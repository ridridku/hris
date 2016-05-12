<?php /* Smarty version 2.6.18, created on 2016-05-17 11:41:46
         compiled from defaults/modules/administrasi_sistem/user_privileges/form.entry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'defaults/modules/administrasi_sistem/user_privileges/form.entry.tpl', 52, false),array('function', 'cycle', 'defaults/modules/administrasi_sistem/user_privileges/form.entry.tpl', 109, false),)), $this); ?>
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
		
					
					<TABLE id="table-add-box">
					<TR>
						<TD width="100">ID Pengguna</TD>			
						<TD > : <?php echo $this->_tpl_vars['USER_ID']; ?>
</TD>							
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
		
		</td></tr>
		</table>

		<?php if ($this->_tpl_vars['CHECK_LIST_MENU'] == '0'): ?>
		
					<?php if ($this->_tpl_vars['CHILD'] != '2'): ?>
					<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;Sub Menu</h5>		
					<?php else: ?>
					<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;<?php echo $this->_tpl_vars['MENU_LABEL_SUB']; ?>
&nbsp;-->&nbsp;<?php echo $this->_tpl_vars['MENU_LABEL']; ?>
</h5>		
					<?php endif; ?>

		
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
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
					<input type="hidden" name="menu_id_cek" value="<?php echo $this->_tpl_vars['DAFTAR_MENU_ID']; ?>
">
					<input type="hidden" name="count_child" id="count_child" value="<?php echo $this->_tpl_vars['COUNT_CHILD']; ?>
">
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
					 <input type="hidden" name="jum_child" id="jum_child" value="<?php echo $this->_tpl_vars['LIST_JUM_PARENT'][$this->_sections['x']['index']]['jumlah']; ?>
">
					 <input type="hidden" name="parent_<?php echo $this->_sections['x']['index']; ?>
" id="parent_<?php echo $this->_sections['x']['index']; ?>
" value="<?php echo $this->_tpl_vars['MENU_INSERT']; ?>
">
					<tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
					<td width="40" class="tdatacontent-first-col"><?php echo $this->_sections['x']['index']+1; ?>
</td>
					<TD class="tdatacontent"><B>
						<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_label']; ?>
</B>
					</TD>

					<!-- view -->
					<TD align="center">   
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childview_<?php echo $this->_sections['x']['index']; ?>
" 
						<?php unset($this->_sections['pv']);
$this->_sections['pv']['name'] = 'pv';
$this->_sections['pv']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pv']['show'] = true;
$this->_sections['pv']['max'] = $this->_sections['pv']['loop'];
$this->_sections['pv']['step'] = 1;
$this->_sections['pv']['start'] = $this->_sections['pv']['step'] > 0 ? 0 : $this->_sections['pv']['loop']-1;
if ($this->_sections['pv']['show']) {
    $this->_sections['pv']['total'] = $this->_sections['pv']['loop'];
    if ($this->_sections['pv']['total'] == 0)
        $this->_sections['pv']['show'] = false;
} else
    $this->_sections['pv']['total'] = 0;
if ($this->_sections['pv']['show']):

            for ($this->_sections['pv']['index'] = $this->_sections['pv']['start'], $this->_sections['pv']['iteration'] = 1;
                 $this->_sections['pv']['iteration'] <= $this->_sections['pv']['total'];
                 $this->_sections['pv']['index'] += $this->_sections['pv']['step'], $this->_sections['pv']['iteration']++):
$this->_sections['pv']['rownum'] = $this->_sections['pv']['iteration'];
$this->_sections['pv']['index_prev'] = $this->_sections['pv']['index'] - $this->_sections['pv']['step'];
$this->_sections['pv']['index_next'] = $this->_sections['pv']['index'] + $this->_sections['pv']['step'];
$this->_sections['pv']['first']      = ($this->_sections['pv']['iteration'] == 1);
$this->_sections['pv']['last']       = ($this->_sections['pv']['iteration'] == $this->_sections['pv']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pv']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pv']['index']]['priv_view'] == '1'): ?> checked <?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childview_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_View(this.form,'<?php echo $this->_sections['x']['index']; ?>
');">
					</TD>
					<!-- end view -->

					<TD align="center"> 
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childinsert_<?php echo $this->_sections['x']['index']; ?>
" 
						<?php unset($this->_sections['pi']);
$this->_sections['pi']['name'] = 'pi';
$this->_sections['pi']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pi']['show'] = true;
$this->_sections['pi']['max'] = $this->_sections['pi']['loop'];
$this->_sections['pi']['step'] = 1;
$this->_sections['pi']['start'] = $this->_sections['pi']['step'] > 0 ? 0 : $this->_sections['pi']['loop']-1;
if ($this->_sections['pi']['show']) {
    $this->_sections['pi']['total'] = $this->_sections['pi']['loop'];
    if ($this->_sections['pi']['total'] == 0)
        $this->_sections['pi']['show'] = false;
} else
    $this->_sections['pi']['total'] = 0;
if ($this->_sections['pi']['show']):

            for ($this->_sections['pi']['index'] = $this->_sections['pi']['start'], $this->_sections['pi']['iteration'] = 1;
                 $this->_sections['pi']['iteration'] <= $this->_sections['pi']['total'];
                 $this->_sections['pi']['index'] += $this->_sections['pi']['step'], $this->_sections['pi']['iteration']++):
$this->_sections['pi']['rownum'] = $this->_sections['pi']['iteration'];
$this->_sections['pi']['index_prev'] = $this->_sections['pi']['index'] - $this->_sections['pi']['step'];
$this->_sections['pi']['index_next'] = $this->_sections['pi']['index'] + $this->_sections['pi']['step'];
$this->_sections['pi']['first']      = ($this->_sections['pi']['iteration'] == 1);
$this->_sections['pi']['last']       = ($this->_sections['pi']['iteration'] == $this->_sections['pi']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pi']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pi']['index']]['priv_insert'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childinsert_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Insert(this.form,'<?php echo $this->_sections['x']['index']; ?>
');">
					</TD>

					<TD align="center"> 
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childedit_<?php echo $this->_sections['x']['index']; ?>
"
						<?php unset($this->_sections['pe']);
$this->_sections['pe']['name'] = 'pe';
$this->_sections['pe']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pe']['show'] = true;
$this->_sections['pe']['max'] = $this->_sections['pe']['loop'];
$this->_sections['pe']['step'] = 1;
$this->_sections['pe']['start'] = $this->_sections['pe']['step'] > 0 ? 0 : $this->_sections['pe']['loop']-1;
if ($this->_sections['pe']['show']) {
    $this->_sections['pe']['total'] = $this->_sections['pe']['loop'];
    if ($this->_sections['pe']['total'] == 0)
        $this->_sections['pe']['show'] = false;
} else
    $this->_sections['pe']['total'] = 0;
if ($this->_sections['pe']['show']):

            for ($this->_sections['pe']['index'] = $this->_sections['pe']['start'], $this->_sections['pe']['iteration'] = 1;
                 $this->_sections['pe']['iteration'] <= $this->_sections['pe']['total'];
                 $this->_sections['pe']['index'] += $this->_sections['pe']['step'], $this->_sections['pe']['iteration']++):
$this->_sections['pe']['rownum'] = $this->_sections['pe']['iteration'];
$this->_sections['pe']['index_prev'] = $this->_sections['pe']['index'] - $this->_sections['pe']['step'];
$this->_sections['pe']['index_next'] = $this->_sections['pe']['index'] + $this->_sections['pe']['step'];
$this->_sections['pe']['first']      = ($this->_sections['pe']['iteration'] == 1);
$this->_sections['pe']['last']       = ($this->_sections['pe']['iteration'] == $this->_sections['pe']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pe']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pe']['index']]['priv_edit'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childedit_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Edit(this.form,'<?php echo $this->_sections['x']['index']; ?>
');" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?>>
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childdelete_<?php echo $this->_sections['x']['index']; ?>
"  
						<?php unset($this->_sections['pd']);
$this->_sections['pd']['name'] = 'pd';
$this->_sections['pd']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pd']['show'] = true;
$this->_sections['pd']['max'] = $this->_sections['pd']['loop'];
$this->_sections['pd']['step'] = 1;
$this->_sections['pd']['start'] = $this->_sections['pd']['step'] > 0 ? 0 : $this->_sections['pd']['loop']-1;
if ($this->_sections['pd']['show']) {
    $this->_sections['pd']['total'] = $this->_sections['pd']['loop'];
    if ($this->_sections['pd']['total'] == 0)
        $this->_sections['pd']['show'] = false;
} else
    $this->_sections['pd']['total'] = 0;
if ($this->_sections['pd']['show']):

            for ($this->_sections['pd']['index'] = $this->_sections['pd']['start'], $this->_sections['pd']['iteration'] = 1;
                 $this->_sections['pd']['iteration'] <= $this->_sections['pd']['total'];
                 $this->_sections['pd']['index'] += $this->_sections['pd']['step'], $this->_sections['pd']['iteration']++):
$this->_sections['pd']['rownum'] = $this->_sections['pd']['iteration'];
$this->_sections['pd']['index_prev'] = $this->_sections['pd']['index'] - $this->_sections['pd']['step'];
$this->_sections['pd']['index_next'] = $this->_sections['pd']['index'] + $this->_sections['pd']['step'];
$this->_sections['pd']['first']      = ($this->_sections['pd']['iteration'] == 1);
$this->_sections['pd']['last']       = ($this->_sections['pd']['iteration'] == $this->_sections['pd']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pd']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pd']['index']]['priv_delete'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>						
						id="ck_childdelete_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Delete(this.form,'<?php echo $this->_sections['x']['index']; ?>
');">
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childsearch_<?php echo $this->_sections['x']['index']; ?>
"
						<?php unset($this->_sections['ps']);
$this->_sections['ps']['name'] = 'ps';
$this->_sections['ps']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ps']['show'] = true;
$this->_sections['ps']['max'] = $this->_sections['ps']['loop'];
$this->_sections['ps']['step'] = 1;
$this->_sections['ps']['start'] = $this->_sections['ps']['step'] > 0 ? 0 : $this->_sections['ps']['loop']-1;
if ($this->_sections['ps']['show']) {
    $this->_sections['ps']['total'] = $this->_sections['ps']['loop'];
    if ($this->_sections['ps']['total'] == 0)
        $this->_sections['ps']['show'] = false;
} else
    $this->_sections['ps']['total'] = 0;
if ($this->_sections['ps']['show']):

            for ($this->_sections['ps']['index'] = $this->_sections['ps']['start'], $this->_sections['ps']['iteration'] = 1;
                 $this->_sections['ps']['iteration'] <= $this->_sections['ps']['total'];
                 $this->_sections['ps']['index'] += $this->_sections['ps']['step'], $this->_sections['ps']['iteration']++):
$this->_sections['ps']['rownum'] = $this->_sections['ps']['iteration'];
$this->_sections['ps']['index_prev'] = $this->_sections['ps']['index'] - $this->_sections['ps']['step'];
$this->_sections['ps']['index_next'] = $this->_sections['ps']['index'] + $this->_sections['ps']['step'];
$this->_sections['ps']['first']      = ($this->_sections['ps']['iteration'] == 1);
$this->_sections['ps']['last']       = ($this->_sections['ps']['iteration'] == $this->_sections['ps']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['ps']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['ps']['index']]['priv_search'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childsearch_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Search(this.form,'<?php echo $this->_sections['x']['index']; ?>
');" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?>>
					</TD>

					<TD align="center">
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childreport_<?php echo $this->_sections['x']['index']; ?>
"
						<?php unset($this->_sections['pr']);
$this->_sections['pr']['name'] = 'pr';
$this->_sections['pr']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pr']['show'] = true;
$this->_sections['pr']['max'] = $this->_sections['pr']['loop'];
$this->_sections['pr']['step'] = 1;
$this->_sections['pr']['start'] = $this->_sections['pr']['step'] > 0 ? 0 : $this->_sections['pr']['loop']-1;
if ($this->_sections['pr']['show']) {
    $this->_sections['pr']['total'] = $this->_sections['pr']['loop'];
    if ($this->_sections['pr']['total'] == 0)
        $this->_sections['pr']['show'] = false;
} else
    $this->_sections['pr']['total'] = 0;
if ($this->_sections['pr']['show']):

            for ($this->_sections['pr']['index'] = $this->_sections['pr']['start'], $this->_sections['pr']['iteration'] = 1;
                 $this->_sections['pr']['iteration'] <= $this->_sections['pr']['total'];
                 $this->_sections['pr']['index'] += $this->_sections['pr']['step'], $this->_sections['pr']['iteration']++):
$this->_sections['pr']['rownum'] = $this->_sections['pr']['iteration'];
$this->_sections['pr']['index_prev'] = $this->_sections['pr']['index'] - $this->_sections['pr']['step'];
$this->_sections['pr']['index_next'] = $this->_sections['pr']['index'] + $this->_sections['pr']['step'];
$this->_sections['pr']['first']      = ($this->_sections['pr']['iteration'] == 1);
$this->_sections['pr']['last']       = ($this->_sections['pr']['iteration'] == $this->_sections['pr']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pr']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pr']['index']]['priv_report'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childreport_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Report(this.form,'<?php echo $this->_sections['x']['index']; ?>
');" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?>>
					</TD>
					<TD align="center">
						<INPUT TYPE="checkbox" value="<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?> NAME="ck_childprint_<?php echo $this->_sections['x']['index']; ?>
"
						<?php unset($this->_sections['pp']);
$this->_sections['pp']['name'] = 'pp';
$this->_sections['pp']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ORTU']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pp']['show'] = true;
$this->_sections['pp']['max'] = $this->_sections['pp']['loop'];
$this->_sections['pp']['step'] = 1;
$this->_sections['pp']['start'] = $this->_sections['pp']['step'] > 0 ? 0 : $this->_sections['pp']['loop']-1;
if ($this->_sections['pp']['show']) {
    $this->_sections['pp']['total'] = $this->_sections['pp']['loop'];
    if ($this->_sections['pp']['total'] == 0)
        $this->_sections['pp']['show'] = false;
} else
    $this->_sections['pp']['total'] = 0;
if ($this->_sections['pp']['show']):

            for ($this->_sections['pp']['index'] = $this->_sections['pp']['start'], $this->_sections['pp']['iteration'] = 1;
                 $this->_sections['pp']['iteration'] <= $this->_sections['pp']['total'];
                 $this->_sections['pp']['index'] += $this->_sections['pp']['step'], $this->_sections['pp']['iteration']++):
$this->_sections['pp']['rownum'] = $this->_sections['pp']['iteration'];
$this->_sections['pp']['index_prev'] = $this->_sections['pp']['index'] - $this->_sections['pp']['step'];
$this->_sections['pp']['index_next'] = $this->_sections['pp']['index'] + $this->_sections['pp']['step'];
$this->_sections['pp']['first']      = ($this->_sections['pp']['iteration'] == 1);
$this->_sections['pp']['last']       = ($this->_sections['pp']['iteration'] == $this->_sections['pp']['total']);
?>
						<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pp']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ORTU'][$this->_sections['pp']['index']]['priv_print'] == '1'): ?> checked<?php endif; ?> 						
						<?php endfor; endif; ?>
						id="ck_childprint_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox" onClick="cekChild_Print(this.form,'<?php echo $this->_sections['x']['index']; ?>
');" <?php if ($this->_tpl_vars['COUNT_CHILD'] == 0): ?> disabled <?php endif; ?>>
					</TD>
					</TR>
					<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['MENU_CHILD']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php if ($this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_parent'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']): ?>
					<tr class='<?php echo smarty_function_cycle(array('values' => "alt,alt3"), $this);?>
'>
					<td width="40" class="tdatacontent-first-col"><?php echo $this->_sections['x']['index']+1; ?>
.<?php echo $this->_sections['y']['index']+1; ?>
</td>
					<TD class="tdatacontent">
						<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_label']; ?>

					</TD>


					<!-- view child -->
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox"  NAME="ck_childview_<?php echo $this->_sections['y']['index']+1; ?>
" 
						<?php unset($this->_sections['v']);
$this->_sections['v']['name'] = 'v';
$this->_sections['v']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['v']['show'] = true;
$this->_sections['v']['max'] = $this->_sections['v']['loop'];
$this->_sections['v']['step'] = 1;
$this->_sections['v']['start'] = $this->_sections['v']['step'] > 0 ? 0 : $this->_sections['v']['loop']-1;
if ($this->_sections['v']['show']) {
    $this->_sections['v']['total'] = $this->_sections['v']['loop'];
    if ($this->_sections['v']['total'] == 0)
        $this->_sections['v']['show'] = false;
} else
    $this->_sections['v']['total'] = 0;
if ($this->_sections['v']['show']):

            for ($this->_sections['v']['index'] = $this->_sections['v']['start'], $this->_sections['v']['iteration'] = 1;
                 $this->_sections['v']['iteration'] <= $this->_sections['v']['total'];
                 $this->_sections['v']['index'] += $this->_sections['v']['step'], $this->_sections['v']['iteration']++):
$this->_sections['v']['rownum'] = $this->_sections['v']['iteration'];
$this->_sections['v']['index_prev'] = $this->_sections['v']['index'] - $this->_sections['v']['step'];
$this->_sections['v']['index_next'] = $this->_sections['v']['index'] + $this->_sections['v']['step'];
$this->_sections['v']['first']      = ($this->_sections['v']['iteration'] == 1);
$this->_sections['v']['last']       = ($this->_sections['v']['iteration'] == $this->_sections['v']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['v']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['v']['index']]['priv_view'] == '1'): ?> checked <?php endif; ?> 
						<?php endfor; endif; ?> 
						id="ck_childview_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>  class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
" >
					</TD>



					<!-- end view child -->

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox"  NAME="ck_childinsert_<?php echo $this->_sections['y']['index']+1; ?>
" 
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['i']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['i']['index']]['priv_insert'] == '1'): ?> checked <?php endif; ?> 
						<?php endfor; endif; ?> 
						id="ck_childinsert_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>  class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
" >
					</TD>

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childedit_<?php echo $this->_sections['y']['index']+1; ?>
" 
						<?php unset($this->_sections['e']);
$this->_sections['e']['name'] = 'e';
$this->_sections['e']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['e']['show'] = true;
$this->_sections['e']['max'] = $this->_sections['e']['loop'];
$this->_sections['e']['step'] = 1;
$this->_sections['e']['start'] = $this->_sections['e']['step'] > 0 ? 0 : $this->_sections['e']['loop']-1;
if ($this->_sections['e']['show']) {
    $this->_sections['e']['total'] = $this->_sections['e']['loop'];
    if ($this->_sections['e']['total'] == 0)
        $this->_sections['e']['show'] = false;
} else
    $this->_sections['e']['total'] = 0;
if ($this->_sections['e']['show']):

            for ($this->_sections['e']['index'] = $this->_sections['e']['start'], $this->_sections['e']['iteration'] = 1;
                 $this->_sections['e']['iteration'] <= $this->_sections['e']['total'];
                 $this->_sections['e']['index'] += $this->_sections['e']['step'], $this->_sections['e']['iteration']++):
$this->_sections['e']['rownum'] = $this->_sections['e']['iteration'];
$this->_sections['e']['index_prev'] = $this->_sections['e']['index'] - $this->_sections['e']['step'];
$this->_sections['e']['index_next'] = $this->_sections['e']['index'] + $this->_sections['e']['step'];
$this->_sections['e']['first']      = ($this->_sections['e']['iteration'] == 1);
$this->_sections['e']['last']       = ($this->_sections['e']['iteration'] == $this->_sections['e']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['e']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['e']['index']]['priv_edit'] == '1'): ?> checked <?php endif; ?> 
						<?php endfor; endif; ?> 						
						id="ck_childedit_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
					</TD>

					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childdelete_<?php echo $this->_sections['y']['index']+1; ?>
"
						<?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['d']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['d']['index']]['priv_delete'] == '1'): ?> checked <?php endif; ?> <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>
						<?php endfor; endif; ?> 	
						id="ck_childdelete_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childsearch_<?php echo $this->_sections['y']['index']+1; ?>
"
						<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['s']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['s']['index']]['priv_search'] == '1'): ?> checked <?php endif; ?>  <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>
						<?php endfor; endif; ?> 	
						id="ck_childsearch_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childreport_<?php echo $this->_sections['y']['index']+1; ?>
"
						<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['r']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['r']['index']]['priv_report'] == '1'): ?> checked <?php endif; ?>  <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>
						<?php endfor; endif; ?> 	
						id="ck_childreport_<?php echo $this->_sections['y']['index']+1; ?>
" <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
					</TD>
					<TD class="tdatacontent" align="center">
						<INPUT TYPE="checkbox" NAME="ck_childprint_<?php echo $this->_sections['y']['index']+1; ?>
" 
						<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['CEK_LIST_PRIV_ANAK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
							<?php if ($this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['p']['index']]['priv_menu_id'] == $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id'] && $this->_tpl_vars['CEK_LIST_PRIV_ANAK'][$this->_sections['p']['index']]['priv_print'] == '1'): ?> checked <?php endif; ?> <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?>
						<?php endfor; endif; ?> 	
						id="ck_childprint_<?php echo $this->_sections['y']['index']+1; ?>
"  <?php if ($this->_tpl_vars['SET_DISABLED_ANAK'] == '0'): ?> disabled<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['MENU_CHILD'][$this->_sections['y']['index']]['menu_id']; ?>
">
					</TD>
					</TR>
					<?php endif; ?>
					<?php endfor; endif; ?>

				<?php endfor; endif; ?>

					<TR><TD></td><TD></td><TD colspan="7" width="280">
					<INPUT TYPE="hidden" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
">
					<INPUT TYPE="hidden" name="menu_ortu" value="<?php echo $this->_tpl_vars['MENU_INSERT']; ?>
">
					<INPUT TYPE="hidden" name="super_parent" value="3">
					<a class="button" href="#" onclick="this.blur(); document.frmCreate.submit(); return false;"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['SUBMIT']; ?>
</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); doNavigateContentOver('index.php','mainFrame');"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
				</TR>
					</FORM>
					</TABLE>
		</td></tr>
		</table>
				<!--END 2ND CONTENT BLOCK-->



				<?php else: ?>


				<h5 style="margin-bottom:5px;"><a href="index.php" style="text-decoration:none;color:#000;">Daftar Pengguna</a>&nbsp;-->&nbsp;<a style="text-decoration:none;color:#000;" href="javascript:history.back(1);">Menu Utama</a>&nbsp;-->&nbsp;<?php echo $this->_tpl_vars['MENU_LABEL']; ?>
</h5>		


				<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
				<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Hak Akses</td></tr>
				<tr><td class="alt2" style="padding:0px;">

				<table width="100%"> 
				<FORM METHOD="POST" ACTION="engine.php" NAME="frmList1">
					<TR><th class="tdatahead">No Urut</th>
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
" NAME="ck_sub_parent_<?php echo $this->_sections['x']['index']; ?>
" 
					<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['ARR_CEK_LIST_SUB_PARENT']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php if ($this->_tpl_vars['ARR_CEK_LIST_SUB_PARENT'][$this->_sections['y']['index']]['menu_id'] == $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']): ?> checked <?php endif; ?>
					<?php endfor; endif; ?>
					
					id="ck_parent_<?php echo $this->_sections['x']['index']; ?>
" class="checkbox"></TD>


<?php if (( $this->_tpl_vars['LEVEL'] == '' )): ?>

					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onClick="return checkEdit('form.entry.php?global_parent_menu=<?php echo $this->_tpl_vars['GLOBAL_PARENT_MENU']; ?>
&menu_ortu=<?php echo $this->_tpl_vars['MENU_ORTU']; ?>
&child=2&user_id=<?php echo $this->_tpl_vars['USER_ID']; ?>
&menu_parent=<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
');" class="imgLink"></TD>
<?php else: ?>

					<TD width="70" class="tdatacontent" align="center"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onClick="return checkEdit('form.entry.php?global_parent_menu=<?php echo $this->_tpl_vars['GLOBAL_PARENT_MENU']; ?>
&menu_ortu=<?php echo $this->_tpl_vars['MENU_ORTU']; ?>
&child=3&user_id=<?php echo $this->_tpl_vars['USER_ID']; ?>
&menu_parent=<?php echo $this->_tpl_vars['MENU_PARENT'][$this->_sections['x']['index']]['menu_id']; ?>
');" class="imgLink"></TD>

<?php endif; ?>
					</TR>
					<?php endfor; endif; ?>
					<TR><TD></td><TD></td><TD colspan="2" width="140">
					<INPUT TYPE="hidden" name="super_parent" value="2">
					<INPUT TYPE="hidden" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
">
					<INPUT TYPE="hidden" name="implode_daftar_menu_id" value="<?php echo $this->_tpl_vars['IMPLODE_DAFTAR_SUB_PARENT_ID']; ?>
">
					<INPUT TYPE="hidden" name="jum_super_parent" value="<?php echo $this->_tpl_vars['JUM_SUPER_SUB_PARENT']; ?>
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
<?php endif; ?>

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