<?php /* Smarty version 2.6.18, created on 2016-05-17 10:53:26
         compiled from defaults/modules/data_pegawai/pegawai//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'defaults/modules/data_pegawai/pegawai//index.tpl', 654, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<STYLE>
    {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


ul, ol {
    list-style-type: none;
}
p, label {
   background: #c3daf9 url("../images/layout/bg000000.gif") repeat-x scroll 0 0;
    color: #083772;
    font-size: 11px;

}
.container-wrapper {
    margin: 7% auto;
    overflow: hidden;
    position: relative;
    width: 100%;
}
input.tab-menu-radio {
    display: none;
}
label.tab-menu {
    cursor: pointer;
    display: inline-block;
    float: left;
    padding: 10px 30px;

}
.tab-content {
    background-color: #eef2f8 none repeat scroll 0 0;
    border-top: #eef2f8 none repeat scroll 0 0;
    clear: both;
  //  padding: 20px;
   // position: relative;
  //  top: -3px;
    width: 100%;
}
.tab-menu-radio:checked + label {
    background-color: #eef2f8 none repeat scroll 0 0;
    color: #000000;
    transition: all 1s ease 0s;
}
.tab-content .tab {
    height: 0;
    opacity: 0;
}
#tab-menu1:checked ~ .tab-content .tab-1, #tab-menu2:checked ~ .tab-content .tab-2, #tab-menu3:checked ~ .tab-content .tab-3 {
    height: auto;
    opacity: 1;
    transition: opacity 1s ease 0s;
}
    </STYLE>
    

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
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/dhtmlgoodies_calendar.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/calendar/dhtmlgoodies_calendar.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?php echo $this->_tpl_vars['HREF_JS_PATH']; ?>
/tw-sack.js"></SCRIPT>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- #EndEditable -->

</HEAD>

<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
    <!--tombol_tambah  -->
<div id="add-search-box">
<a class="button" href="#" onclick="this.blur();showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);this.disabled=true;" <?php if ($this->_tpl_vars['OPT'] == 1): ?> DISABLED <?php endif; ?>><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/details.gif" align="absmiddle"> <?php echo $this->_tpl_vars['BTN_NEW']; ?>
</span></a>
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>
</div>
<!--tombol_tambah  -->

<!--form_tambah -->
<DIV ID="_menuEntry1_1" style="top:10px;width:100%;display:none;position:absolute;">

		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Data Pegawai</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/form.gif" align="absmiddle" border="0"> Form Tambah/Ubah Data</td></tr>
		<tr><td class="alt2" style="padding:0px;">

		<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">


					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>
                                            <INPUT TYPE="hidden" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
					<?php else: ?>
                                        <INPUT TYPE="hidden" NAME="id" value="<?php echo $this->_tpl_vars['EDIT_ID']; ?>
" size="35" readOnly class="text_disabled">
					<?php endif; ?>



				<TR>
					<TD>Cabang <font color="#ff0000">*</font></TD>
					<TD>



					<?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

								<select name="kode_cabang" >
								<option value=""> Pilih Cabang </option>
								<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_PWK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

								<?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

									<?php if (trim ( $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['EDIT_KODE_CABANG']): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
"  > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php endif; ?>

								<?php else: ?>

									<?php if (( $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['KODE_PW_SES']): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
"  > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php endif; ?>
								<?php endif; ?>

								<?php endfor; endif; ?>
								</SELECT>

						<?php else: ?>

					<select name="kode_cabang" >
						<option value=""> Pilih Cabang </option>
								<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_PWK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

								<?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

									<?php if (trim ( $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['EDIT_KODE_CABANG']): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php endif; ?>

								<?php else: ?>

									<?php if (trim ( $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang'] ) == trim ( $this->_tpl_vars['KODE_PW_SES'] )): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php endif; ?>

								<?php endif; ?>

								<?php endfor; endif; ?>
								</SELECT>

						<?php endif; ?>


					</TD>
				</TR>


                               <TR>
					<TD>Departemen</TD>
					<TD>
						<select name="kode_departemen">
						<option value=""> Pilih Departemen </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_DEP']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_DEP'][$this->_sections['x']['index']]['kode_departemen'] ) == $this->_tpl_vars['EDIT_KODE_DEPARTEMEN']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_DEP'][$this->_sections['x']['index']]['kode_departemen']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_DEP'][$this->_sections['x']['index']]['departemen']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_DEP'][$this->_sections['x']['index']]['kode_departemen']; ?>
"  > <?php echo $this->_tpl_vars['DATA_DEP'][$this->_sections['x']['index']]['departemen']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>

					</TD>
				</TR>
                                <TR>
					<TD>Jabatan</TD>
					<TD>
						<select name="kode_jabatan"  >
						<option value=""> Pilih Jabatan </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_JABATAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan'] ) == $this->_tpl_vars['EDIT_KODE_JABATAN']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['jabatan']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['jabatan']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>

                                <TR>
					<TD>Level Jabatan</TD>
					<TD>
						<select name="kode_level"  >
						<option value=""> Pilih Level </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_LEVEL']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['kode_level'] ) == $this->_tpl_vars['EDIT_KODE_LEVEL']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['kode_level']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['nama_level']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['kode_level']; ?>
"  > <?php echo $this->_tpl_vars['DATA_LEVEL'][$this->_sections['x']['index']]['nama_level']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>

                                <TR>
					<TD>Kode Absensi</TD>
					<TD><INPUT TYPE="text" NAME="kode_absensi" value="<?php echo $this->_tpl_vars['EDIT_KODE_ABSENSI']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>Nama Lengkap</TD>
					<TD><INPUT TYPE="text" NAME="nama" value="<?php echo $this->_tpl_vars['EDIT_NAMA']; ?>
" size="35"></TD>
				</TR>

                                 <TR>
					<TD>Pendidikan Terakhir</TD>
					<TD><INPUT TYPE="text" NAME="pendidikan_akhir" value="<?php echo $this->_tpl_vars['EDIT_NAMA']; ?>
" size="35"></TD>
				</TR>

				<TR>
					<TD>Tempat Lahir</TD>
					<TD><INPUT TYPE="text" NAME="tempat_lahir" value="<?php echo $this->_tpl_vars['EDIT_TEMPAT_LAHIR']; ?>
" size="35"></TD>
				</TR>

				<TR>
					<TD>Tanggal Lahir</TD>
					<TD>
					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>

							 <input type="text" NAME="tgl_lahir"   >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php else: ?>
								 <input type="text" name="tgl_lahir" value="<?php echo $this->_tpl_vars['EDIT_TGL_LAHIR']; ?>
" >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_lahir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>
					</TD>
				</TR>

<TR>
					<TD>Jenis Kelamin <font color="#ff0000">*</font></TD>
					<TD>

					<select name="jk"  >
						<option value="">[Pilih Jenis Kelamin]</option>

						<option value="1"   <?php if (( $this->_tpl_vars['EDIT_JK'] == 1 )): ?> selected <?php endif; ?> > Perempuan </option>
						<option value="2"   <?php if (( $this->_tpl_vars['EDIT_JK'] == 2 )): ?> selected <?php endif; ?>   > Laki-Laki </option>

						</select>
					 </TD>
				</TR>
                                <TR>
					<TD>Agama</TD>
					<TD>
						<select Name="kode_agama"  >
						<option value=""> Pilih Agama </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_AGAMA']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_AGAMA'][$this->_sections['x']['index']]['kode_agama'] ) == $this->_tpl_vars['EDIT_KODE_AGAMA']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_AGAMA'][$this->_sections['x']['index']]['kode_agama']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_AGAMA'][$this->_sections['x']['index']]['nama_agama']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_AGAMA'][$this->_sections['x']['index']]['kode_agama']; ?>
"  > <?php echo $this->_tpl_vars['DATA_AGAMA'][$this->_sections['x']['index']]['nama_agama']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>


					<TR>
					<TD colspan="2"><u>Alamat KTP</u></TD>
				</TR>





                                  <TR>
					<TD>No KTP /SIM</TD>
					<TD><INPUT TYPE="text" NAME="no_ktp_sim" value="<?php echo $this->_tpl_vars['EDIT_TLP']; ?>
" size="35"></TD>
				</TR>
				<TR>
					<TD>Alamat KTP</TD>
					<TD><INPUT TYPE="text" NAME="alamat_ktp" value="<?php echo $this->_tpl_vars['EDIT_ALAMAT']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kode Pos KTP</TD>
					<TD><INPUT TYPE="text" NAME="kode_pos_ktp" value="<?php echo $this->_tpl_vars['EDIT_ALAMAT']; ?>
" size="35"></TD>
				</TR>

                                 <TR>
					<TD>RT/RW KTP</TD>
					<TD><INPUT TYPE="text" NAME="alamat" value="<?php echo $this->_tpl_vars['EDIT_ALAMAT']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>Propinsi</TD>
					<TD>
						<select name="no_propinsi" onchange="cari_kab(this.value);">
						<option value=""> Pilih Provinsi </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_PROPINSI']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_PROPINSI'][$this->_sections['x']['index']]['no_propinsi'] ) == $this->_tpl_vars['EDIT_NO_PROP']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_PROPINSI'][$this->_sections['x']['index']]['no_propinsi']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PROPINSI'][$this->_sections['x']['index']]['nama_propinsi']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_PROPINSI'][$this->_sections['x']['index']]['no_propinsi']; ?>
"  > <?php echo $this->_tpl_vars['DATA_PROPINSI'][$this->_sections['x']['index']]['nama_propinsi']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>
                                <TR>
					<TD>kota / Kabupaten </TD>
					<TD>
					<div id="ajax_kabupaten">
					<select name="id_kab" >
						<option value="">[Pilih Kabupaten]</option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_KABUPATEN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_KABUPATEN'][$this->_sections['x']['index']]['id_kabupaten'] ) == $this->_tpl_vars['EDIT_ID_KAB']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_KABUPATEN'][$this->_sections['x']['index']]['id_kabupaten']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_KABUPATEN'][$this->_sections['x']['index']]['nama_kabupaten']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_KABUPATEN'][$this->_sections['x']['index']]['id_kabupaten']; ?>
"  > <?php echo $this->_tpl_vars['DATA_KABUPATEN'][$this->_sections['x']['index']]['nama_kabupaten']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</div></TD>
				</TR>
                                <TR>
					<TD colspan="2"><u>Alamat Domisili</u></TD>
				</TR>
                                <TR>
					<TD>Alamat Domisili</TD>
					<TD><INPUT TYPE="text" NAME="alamat_domisil" value="<?php echo $this->_tpl_vars['EDIT_ALAMAT']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kode Pos Domisili</TD>
					<TD><INPUT TYPE="text" NAME="kode_pos_domisil" value="<?php echo $this->_tpl_vars['EDIT_KODEPOS_DOM']; ?>
" size="35"></TD>
				</TR>

                                 <TR>
					<TD>RT/RW Domisili</TD>
					<TD><INPUT TYPE="text" NAME="rt_rw_domisil" value="<?php echo $this->_tpl_vars['EDIT_RTRW_DOM']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kota/Kabupaten</TD>
					<TD><INPUT TYPE="text" NAME="kota_domisil" value="<?php echo $this->_tpl_vars['EDIT_RTRW_DOM']; ?>
" size="35"></TD>
				</TR>
                                 <TR>
					<TD>Golongan Darah</TD>
					<TD><INPUT TYPE="text" NAME="kode_gol_darah" value="<?php echo $this->_tpl_vars['EDIT_GOL_DARAH']; ?>
" size="35"></TD>
				</TR>

			<TR>
					<TD>No Telp</TD>
					<TD><INPUT TYPE="text" NAME="telp_rmh" value="<?php echo $this->_tpl_vars['EDIT_TLP']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>No Hp</TD>
					<TD><INPUT TYPE="text" NAME="hp" value="<?php echo $this->_tpl_vars['EDIT_HP']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>No Hp Inventaris</TD>
					<TD><INPUT TYPE="text" NAME="telp_inventaris" value="<?php echo $this->_tpl_vars['EDIT_HP_INVENTARIS']; ?>
" size="35"></TD>
				</TR>

                               <TR>
					<TD>Tanggal Masuk</TD>
					<TD>
					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>

							 <input type="text" name="tgl_masuk"   >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php else: ?>
								 <input type="text" name="tgl_masuk" value="<?php echo $this->_tpl_vars['EDIT_TGL_LAHIR']; ?>
" >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_masuk,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>
					</TD>
				</TR>



                                 <TR>
					<TD>Tanggal Kontrak Awal</TD>
					<TD>
					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>

							 <input type="text" name="tgl_kontrak_awal"   >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php else: ?>
								 <input type="text" name="tgl_kontrak_awal" value="<?php echo $this->_tpl_vars['EDIT_TGL_LAHIR']; ?>
" >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_awal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>
					</TD>
				</TR>

                                <TR>
					<TD>Tanggal Kontrak Akhir</TD>
					<TD>
					<?php if ($this->_tpl_vars['EDIT_VAL'] == 0): ?>

							 <input type="text" name="tgl_kontrak_akhir"   >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php else: ?>
								 <input type="text" name="tgl_kontrak_akhir" value="<?php echo $this->_tpl_vars['EDIT_TGL_LAHIR']; ?>
" >
							 <img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tgl_kontrak_akhir,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">
					<?php endif; ?>
					</TD>
				</TR>
                                 <TR>
					<TD>Kontrak Ke</TD>
					<TD><INPUT TYPE="text" NAME="kontrak_ke" value="<?php echo $this->_tpl_vars['EDIT_KONTRAK_KE']; ?>
" size="35"></TD>
				</TR>
                                 <TR>
					<TD>Status karyawan</TD>
					<TD>
						<select name="kode_status"  >
						<option value=""> Pilih  </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_STATUS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['kode_status'] ) == $this->_tpl_vars['EDIT_KODE_STATUS']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['kode_status']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['nama_status']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['kode_status']; ?>
"  > <?php echo $this->_tpl_vars['DATA_STATUS'][$this->_sections['x']['index']]['nama_status']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>
                                <TR>
					<TD>NO NPWP</TD>
					<TD><INPUT TYPE="text" NAME="no_npwp" value="<?php echo $this->_tpl_vars['EDIT_NO_NPWP']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>No BPJS Ketenagakerjaan</TD>
					<TD><INPUT TYPE="text" NAME="no_bpjs_kt" value="<?php echo $this->_tpl_vars['EDIT_NO_BPJS_KT']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>No BPJS Kesehatan</TD>
					<TD><INPUT TYPE="text" NAME="no_bpjs_kt" value="<?php echo $this->_tpl_vars['EDIT_NO_BPJS_KES']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>No Inhealth</TD>
					<TD><INPUT TYPE="text" NAME="no_inhealth" value="<?php echo $this->_tpl_vars['EDIT_INHEALTH']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>Kode Bank</TD>
					<TD>
						<select name="kode_bank"  >
						<option value=""> Pilih Nama Bank </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_BANK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_BANK'][$this->_sections['x']['index']]['kode_bank'] ) == $this->_tpl_vars['EDIT_KODE_BANK']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_BANK'][$this->_sections['x']['index']]['kode_bank']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_BANK'][$this->_sections['x']['index']]['nama_bank']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_BANK'][$this->_sections['x']['index']]['kode_bank']; ?>
"  > <?php echo $this->_tpl_vars['DATA_BANK'][$this->_sections['x']['index']]['nama_bank']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>
				<TR>
					<TD>Alamat Buka Bank</TD>
					<TD><INPUT TYPE="text" NAME="alamat_buka_bank" value="<?php echo $this->_tpl_vars['EDIT_ALAMAT_BK_BANK']; ?>
" size="35"></TD>
				</TR>
                                <TR>
					<TD>No Rek Bank</TD>
					<TD><INPUT TYPE="text" NAME="rek_bank_baru" value="<?php echo $this->_tpl_vars['EDIT_NO_REK_BANK']; ?>
" size="35"></TD>
				</TR>

                                 <TR>
					<TD>Nama Pemilik Rekening Bank</TD>
					<TD><INPUT TYPE="text" NAME="nama_rek_bank" value="<?php echo $this->_tpl_vars['EDIT_NO_REK_BANK']; ?>
" size="35"></TD>
				</TR>

                                <TR>
					<TD>Kota Bank</TD>
					<TD><INPUT TYPE="text" NAME="kota_bank" value="<?php echo $this->_tpl_vars['EDIT_NO_REK_BANK']; ?>
" size="35"></TD>
				</TR>




				<TR><td height="40"></td>
					<TD>


					<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
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


					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>

					</tr>

			</TABLE>
		</FORM>
		</td></tr>
		</table>
		</DIV>

<!--form_tambah-->


<DIV ID="_menuEntry2_1" style="top:10px;width:100%;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
		<DIV ID="_menuEdit_1">
<!--form_cari-->
<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">

		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">

					<?php if (( $this->_tpl_vars['JENIS_USER_SES'] == '1' )): ?>
							<TR>
								<TD>Pilih Cabang</TD>
								<TD><select name="kode_perwakilan_cari" >
									<option value=""> [Pilih Perwakilan] </option>
									<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_PWK']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<?php if (trim ( $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['EDIT_KODE_CABANG']): ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['kode_cabang']; ?>
"  > <?php echo $this->_tpl_vars['DATA_PWK'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </option>
									<?php endif; ?>
									<?php endfor; endif; ?>
									</select>		</TD>
							</TR>
					<?php endif; ?>

							<TR>
								<TD>Nama Karyawan </TD>
								<TD><INPUT TYPE="text" NAME="nama_pegawai_cari" size="30"></TD>
							</TR>
                                                        <TR>
					<TD>Jabatan</TD>
					<TD>
						<select name="jabatan_pegawai_cari"  >
						<option value=""> Pilih Jabatan </option>
						<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['DATA_JABATAN']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if (trim ( $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan'] ) == $this->_tpl_vars['EDIT_KODE_JABATAN']): ?>
						<option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan']; ?>
" selected > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['jabatan']; ?>
 </option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['kode_jabatan']; ?>
"  > <?php echo $this->_tpl_vars['DATA_JABATAN'][$this->_sections['x']['index']]['jabatan']; ?>
 </option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
					</TD>
				</TR>





			<TR><TD></TD>
				<TD>
				<INPUT TYPE="hidden" name="mod_id" value="<?php echo $this->_tpl_vars['MOD_ID']; ?>
">
				<INPUT TYPE="hidden" name="limit" value="<?php echo $this->_tpl_vars['LIMIT']; ?>
">
				<INPUT TYPE="hidden" name="search" value="1">
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



<!--form_cari-->
		</DIV>

		<FORM METHOD=GET ACTION="" NAME="frmList">
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center" style="border-bottom-width:0px">
		<tr><td class="tcat"> Daftar Pegawai</td></tr>
		</table>
		<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
		<tr><td class="thead"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/columns.gif" align="absmiddle" border="0"> Daftar Pegawai</td></tr>
		<tr><td class="alt2" style="padding:0px;">
		<table width="100%">
		<tr>
											<th class="tdatahead" align="left">NO</TH>
											<th class="tdatahead" align="left" width="10%">NAMA</TH>
											<th class="tdatahead" align="left">DEPARTEMEN</TH>
											<th class="tdatahead" align="left" >JABATAN</TH>
                                                                                        <th class="tdatahead" align="left" >CABANG</TH>
											<th class="tdatahead" align="left">STATUS KARYAWAN</TH>
                                                                                        <th class="tdatahead" align="left">MULAI MASUK</TH>
											<th class="tdatahead" align="left" >AWAL KONTRAK</TH>
											<th class="tdatahead" align="left">AKHIR KONTRAK</TH>
											<th class="tdatahead" COLSPAN="2"><?php echo $this->_tpl_vars['ACTION']; ?>
</th>
			</tr>
			</thead>
			<tbody>
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
											<td width="17" class="tdatacontent-first-col"> <?php echo $this->_sections['x']['index']+$this->_tpl_vars['COUNT_VIEW']; ?>
.</TD>
											<TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['nama']; ?>
 </TD>
											<TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['departemen']; ?>
  </TD>
                                                                                        <TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['jabatan']; ?>
 </TD>
                                                                                        <TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['nama_cabang']; ?>
 </TD>
											<TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['nama_status']; ?>
 </TD>
											<TD class="tdatacontent"  >  <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['tgl_masuk']; ?>
</TD>
											<TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['tgl_kontrak_awal']; ?>
 </TD>
                                                                                        <TD class="tdatacontent"  > <?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['tgl_kontrak_akhir']; ?>
 </TD>

											<TD class="tdatacontent"  >




											</TD>




											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/edit.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['EDIT']; ?>
" onclick="return checkEdit('<?php echo $this->_tpl_vars['SELF']; ?>
?opt=1&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['id']; ?>
&mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
											<TD width="20" class="tdatacontent" ALIGN="CENTER"><IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/delete.gif" WIDTH="12" HEIGHT="13" BORDER=0 ALT="<?php echo $this->_tpl_vars['DELETE']; ?>
" onclick="return checkDelete('engine.php?op=2&id=<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['id']; ?>
 &mod_id=<?php echo $this->_tpl_vars['MOD_ID']; ?>
&<?php echo $this->_tpl_vars['STR_COMPLETER_']; ?>
');" class="imgLink"></TD>
										</TR>
										<?php endfor; else: ?>
										<TR>
											<TD class="tdatacontent" COLSPAN="10" align="center">Maaf, Data masih kosong</TD>
										</TR>
			<?php endif; ?>
			</tbody>
		</table>
<div id="panel-footer">
    <!--halaman -->

    <!--halaman -->
</div>
		</td></tr>
		</table>

		</form>

	<div id="div-bg-note-trans"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/layout/note.png"></div>

	</DIV>
</BODY>
</HTML>