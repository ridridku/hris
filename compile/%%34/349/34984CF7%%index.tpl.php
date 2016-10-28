<?php /* Smarty version 2.6.18, created on 2016-10-20 04:34:33
         compiled from defaults/modules/administrasi_sistem/daftar_user/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'defaults/modules/administrasi_sistem/daftar_user/index.tpl', 106, false),array('function', 'cycle', 'defaults/modules/administrasi_sistem/daftar_user/index.tpl', 264, false),)), $this); ?>
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
<div id="add-search-box" style="right:-105px;">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <?php if ($this->_tpl_vars['OPT'] == 1): ?> DISABLED <?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/details.gif" align="absmiddle"> <?php echo $this->_tpl_vars['BTN_NEW']; ?>
</span></a>
</div>

		<DIV ID="_menuEntry1_1" style="display:none;margin-top:12px;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <?php echo $this->_tpl_vars['TABLE_CAPTION']; ?>
</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0"> <?php echo $this->_tpl_vars['FORM_NAME']; ?>
</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		
					<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
                                            
                                            
                <TABLE id="table-add-box" width="100%" >	
                     
				<TR>
					<TD width="100"><?php echo $this->_tpl_vars['TB_CODE']; ?>
</TD>
					<TD><?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
					<INPUT TYPE="text" NAME="user_id" size="27">
					<?php else: ?>
					<INPUT TYPE="text" NAME="user_id" value="<?php echo $this->_tpl_vars['EDIT_USER_ID']; ?>
" size="27" readOnly class="text_disabled">
					<?php endif; ?>
					</TD>			
				</TR>
				<TR>
					<TD>Sandi</TD>
					<TD><INPUT TYPE="password" NAME="user_password" value="<?php echo $this->_tpl_vars['EDIT_USER_PASSWORD']; ?>
" size="27" maxlength="10"></TD>
				</TR>
                                <TR>
                                        <TD>Level</TD>
                                        <TD><select name="jns_user"  onChange="cari(this.value);">
                                        <option value="">[Pilih Level Pengguna]</option>
                                        <option value="1" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == '1'): ?> selected <?php endif; ?>>Pusat</option>
                                        <option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == '2'): ?> selected <?php endif; ?>>Cabang</option> 
                                        </select>
                                            
                                         
                                        </TD>
                                </TR>

                                <TR><TD class="login_txt" align="left"> Cabang</TD>
                                <TD> 
                                 <div id="ajax_instansi"> 
                                         <select name="kode_cabang"> 
                                         <option value="">[Pilih Cabang]</option> 
                                         <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_CABANG']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                

									<?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_KODE_CABANG']): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id']; ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
									<?php endif; ?>
                                                                        <?php endfor; endif; ?>
								</SELECT>
                                         
                                 </div>
                                 </TD>
                                 </TR>
                                     <TR>
                                <TD>Cari Pegawai<font color="#ff0000">*</font> </TD> 
                                <TD><INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goPemberikerja()" value=" ... " /></TD>
                        </TR> 
                                <TR>
                                        <TD>Nama <font color="#ff0000">*</font> </TD>
                                         <TD>
                                         <INPUT TYPE="text" NAME="user_first_name" readonly  id="r_pegawai__nama"  size="35" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['EDIT_USER_FIRST_NAME'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" size="27" maxlength="50">
                                         <INPUT TYPE="hidden" NAME="user_last_name" readonly  id="r_pegawai__nama2"  size="35" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['EDIT_USER_LAST_NAME'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" size="27" maxlength="50">
                                        </TD> 
                               </TR>
                        
                                <TR>
                                        <TD>NIP <font color="#ff0000">*</font> </TD>
                                        <TD><INPUT TYPE="text" NAME="id_pegawai" readonly id="r_pnpt__nip" size="35" value="<?php echo $this->_tpl_vars['EDIT_ID_PEGAWAI']; ?>
" ></TD>
                                         <TD>
				<TR>
					<TD>Status Pengguna</TD>
					<TD><SELECT name="user_status">
							<OPTION value="">[PILIH]</OPTION>
							<OPTION value="1" <?php if ($this->_tpl_vars['EDIT_USER_STATUS'] == 1): ?>selected<?php endif; ?>>Aktif</OPTION>
							<OPTION value="0" <?php if ($this->_tpl_vars['EDIT_USER_STATUS'] == 0): ?>selected<?php endif; ?>>Tidak Aktif</OPTION>
						</SELECT>
					</TD>
				</TR>
 
				
				
                                
                                <tr>
				<td>Group</td>
				<td>
					<select name="group_user" >
					<option value="">[Pilih Group Pengguna]</option>
					<option value="1"  <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 1): ?> selected <?php endif; ?>>HR STAFF</option>
					<option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 2): ?> selected <?php endif; ?>>HR SVP CABANG</option>
                                        <option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 3): ?> selected <?php endif; ?>>BOM</option>
                                        <option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 4): ?> selected <?php endif; ?>>HR STAFF PUSAT</option>
                                        <option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 5): ?> selected <?php endif; ?>>HR SPV PUSAT</option>
                                        <option value="2" <?php if ($this->_tpl_vars['EDIT_LEVEL'] == 6): ?> selected <?php endif; ?>>HR MGR PUSAT</option>
					</select>
				</TD>
				</TR>

			

				<TR>
					<TD>Alamat</TD>
                                        <TD><textarea rows="5" cols="20" NAME="user_address" id="r_pegawai__nama_jalan" value="<?php echo $this->_tpl_vars['EDIT_USER_ADDRESS']; ?>
">
                                                
                                        </textarea>
                                        </TD>
				</TR>
				<TR>
					<TD>Telepon</TD>
					<TD><INPUT TYPE="text" NAME="user_telp" id="r_pegawai__tlp_kantor" value="<?php echo $this->_tpl_vars['EDIT_USER_TELP']; ?>
" size="27"></TD>
				</TR>
	
				<TR>
					<TD>Jenis Kelamin</TD>
					<TD>
                                            <INPUT TYPE="text" NAME="user_gender" id="r_pegawai__jk" value="<?php echo $this->_tpl_vars['EDIT_USER_GENDER']; ?>
" size="27">
					</TD>
				</TR>
				<TR>
					<TD>Email</TD>
					<TD><INPUT TYPE="text" NAME="user_email" id="r_pegawai__tlp_rumah" value="<?php echo $this->_tpl_vars['EDIT_USER_EMAIL']; ?>
" size="27"></TD>
				</TR>
                             
				
			</TABLE>
			<TABLE id="table-add-box" width="100%" >
                        
				 
                        
                        
                        
                         </TR>
                         
                        
                       
                            
                                
                        </TR>
				
				
                                <TR>
					<TD COLSPAN="2" ALIGN="left">
					<INPUT TYPE="hidden" name="user_id_foo" value="<?php echo $this->_tpl_vars['EDIT_USER_ID']; ?>
">
					<INPUT TYPE="hidden" name="limit" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
">
					<INPUT TYPE="hidden" name="SORT" value="<?php echo $this->_tpl_vars['SORT']; ?>
">
					<INPUT TYPE="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['SUBMIT']; ?>
</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
					</TD>
				</TR>
                                        </table>
                                
				<hr size="1" style="color:#FFF;" width="100%">
				
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
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">	
							<TR>
								<TD WIDTH="170"><?php echo $this->_tpl_vars['TB_CODE']; ?>
</TD>
								<TD><INPUT TYPE="text" NAME="user_id" size="25"></TD>
							</TR>
							<TR>
								<TD><?php echo $this->_tpl_vars['TB_NAME']; ?>
</TD>
								<TD><INPUT TYPE="text" NAME="user_first_name" size="25"></TD>
							</TR>
							<TR><TD COLSPAN="2"></TD></TR>
							<TR>
								<TD></TD><TD>
								<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['PATH']; ?>
">
								<INPUT TYPE="hidden" name="limit" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
">
								<INPUT TYPE="hidden" name="SORT" value="<?php echo $this->_tpl_vars['SORT']; ?>
">
								<INPUT TYPE="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
								<INPUT TYPE="hidden" name="op" value="0">
				<CENTER>
				<a class="button" href="#" onclick="this.blur(); document.frmList1.submit(); document.frmCreate.page.value='1';" onSubmit="frmCreate.page.value='1'; return false;"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle">Cari</span></a>
				<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); document.frmList1.nama_propinsi.focus();"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/blank.gif" align="absmiddle"><?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
				</CENTER>
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></div>	
		</DIV>
		
		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> <?php echo $this->_tpl_vars['TABLE_CAPTION']; ?>
</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> <?php echo $this->_tpl_vars['TABLE_NAME']; ?>
</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
		<th class="tdatahead">No Urut</th>
										<TH class="tdatahead" align="left" ><?php echo $this->_tpl_vars['TB_CODE']; ?>
</TH>
										<TH class="tdatahead" align="left"><?php echo $this->_tpl_vars['TB_NAME']; ?>
</TH>
										<TH class="tdatahead" align="left">Status</TH>
										<TH COLSPAN="3" class="tdatahead" align="left"><?php echo $this->_tpl_vars['ACTION']; ?>
</TH>
									</TR>
									<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_TB']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<td width="40" class="tdatacontent-first-col"><?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
</td>
										<TD class="tdatacontent" nowrap>&nbsp; <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['user_id'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</TD>
										<TD class="tdatacontent" nowrap>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['full_name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 </TD>
										<TD class="tdatacontent" nowrap>&nbsp;<?php if ($this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['user_active_status'] == 1): ?>Aktif<?php else: ?>Tidak Aktif&nbsp;&nbsp;<?php endif; ?> </TD>
										<TD width="20" class="tdatacontent" ALIGN="CENTER"><?php if ($this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['user_active_status'] == 1): ?><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/green_light.png" WIDTH="16" HEIGHT="16" BORDER=0><?php else: ?><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/red_light.png" WIDTH="16" HEIGHT="16" BORDER=0><?php endif; ?> </TD>
										<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onClick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&user_id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['user_id']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
										<td width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER="0" ALT="<?php echo $this->_tpl_vars['DELETE']; ?>
" onClick="return checkDelete('engine.php?op=2&user_id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['user_id']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>										
									</TR>
									<?php endfor; else: ?>
									<TR>
										<TD COLSPAN="5" align="center" class="tdatacontent">Maaf, Data masih kosong</TD>
									</TR>
									<?php endif; ?>
		</table>
		
<div id="panel-footer">
<table width="100%">
<tr class="text-regular">
<td width="20">Tampilkan</td>
<td width="35"><INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
		<SELECT NAME="limit" onchange="this.form.page.value='1'; this.form.submit();" class="text-paging">
		<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['LISTVAL']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<OPTION VALUE = "<?php echo $this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']]; ?>
" <?php if ($this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']] == $this->_tpl_vars['LIMIT']): ?> SELECTED <?php endif; ?>> <?php echo $this->_tpl_vars['LISTVAL'][$this->_sections['x']['index']]; ?>
 </OPTION>
		<?php endfor; endif; ?>
		</SELECT></td>
<td>Baris : <?php echo $this->_tpl_vars['COUNT_VIEW']; ?>
 - <?php echo $this->_tpl_vars['COUNT_ALL']; ?>
 dari <?php echo $this->_tpl_vars['COUNT']; ?>
</td>
<td align="right"><?php echo $this->_tpl_vars['NEXT_PREV']; ?>
</td>
</tr>
</table>
</div>				
		</td></tr>
		</table>
		
		</form>

	<div id="div-bg-note-trans"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>