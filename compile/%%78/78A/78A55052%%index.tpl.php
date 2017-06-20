<?php /* Smarty version 2.6.18, created on 2017-06-07 13:24:46
         compiled from defaults/modules/pelaporan/lap_kepegawaian/data_surat_peringatan/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'base64_encode', 'defaults/modules/pelaporan/lap_kepegawaian/data_surat_peringatan/index.tpl', 81, false),array('modifier', 'date_format', 'defaults/modules/pelaporan/lap_kepegawaian/data_surat_peringatan/index.tpl', 378, false),)), $this); ?>
<HTML>
<HEAD>
<!-- #BeginEditable "TITLE" -->
<title><?php echo $this->_tpl_vars['TITLE']; ?>
</title>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/preload.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['HREF_CSS_PATH']; ?>
/
      " type="text/css">
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
var err = 0;
var err_ = 0;


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

<?php if ($this->_tpl_vars['SEARCH_BOX'] == 1): ?>
<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>showAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
<?php else: ?>
<body class="contentPage" onLoad="hideIt(); <?php if ($this->_tpl_vars['OPT'] == 1): ?>showAll('_menuEntry1_',1);hideAll('_menuEntry2_',1);<?php else: ?>hideAll('_menuEdit_',1);hideAll('_menuEntry1_',1);showAll('_menuEntry2_',1);<?php endif; ?>">
<?php endif; ?>

<div style="left:10;top:10;float:left;position:absolute;">
<a class="button" href="#" onclick="this.blur();showLevel('_menuEdit_',1,1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/search.png" align="absmiddle"> Pencarian Data</span></a>

<a class="button" href="#" onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/print.gif" align="absmiddle"> &nbsp;Cetak</span></a>

</div>

	<DIV ID="_menuEntry2_1" style="width:100%;top:25px;position:absolute;">
	<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="2">
		<!--DIVIDER HERE-->
		<TR>
			<TD>
                  <!--PENCARIAN_DATA -->      
		<DIV ID="_menuEdit_1">

		<div id="panel-box">
		<div id="title-box2">Pencarian Data</div>
		<div id="title-box-close"><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/icon/close.gif" onClick="document.getElementById('_menuEdit_1').style.display='none';" align="absmiddle" class="imgLink" title="Close"></div>
		<div id="panel-content">
		<FORM METHOD=GET ACTION="" NAME="frmList1">
		<TABLE id="table-search-box">
                <TR>
                    <TD>Cabang <font color="#ff0000">*</font>
                            </TD> 
                                                           <TD><?php if (( $this->_tpl_vars['JENIS_USER_SES'] == 1 )): ?>

                                                                                           <select name="kode_cabang_cari" > 
                                                                                           <option value=""> Pilih Cabang </option>
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

                                                                                           <?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_R_CABANG__ID']): ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
"  > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php else: ?>

                                                                                                   <?php if (( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['kode_cabang'] ) == $this->_tpl_vars['KODE_PW_SES']): ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
"  > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>
                                                                                           <?php endif; ?>

                                                                                           <?php endfor; endif; ?>
                                                                                           </SELECT>

                                                                           <?php else: ?>

                                                                   <select name="kode_cabang_cari" >
                                                                           <option value=""> Pilih Cabang </option>
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

                                                                                           <?php if (( $this->_tpl_vars['OPT'] == 1 )): ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == $this->_tpl_vars['EDIT_R_CABANG__ID']): ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php else: ?>

                                                                                                   <?php if (trim ( $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'] ) == trim ( $this->_tpl_vars['KODE_PW_SES'] )): ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
" selected > <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php else: ?>
                                                                                                   <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__id'])) ? $this->_run_mod_handler('base64_encode', true, $_tmp) : base64_encode($_tmp)); ?>
"  disabled> <?php echo $this->_tpl_vars['DATA_CABANG'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
 </option>
                                                                                                   <?php endif; ?>

                                                                                           <?php endif; ?>

                                                                                           <?php endfor; endif; ?>
                                                                                           </SELECT>

                                                                           <?php endif; ?>
                                                           </TD>
                                                   </TR>
                                                  
                                    
                                    
                                    
                                    <TR>
                            <TD>Nama Karyawan<font color="#ff0000">*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nama_karyawan_cari" readonly  id="r_pegawai__nama"  size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__PEGAWAI_NAMA']; ?>
">
                                                                 
                                </TD>

                    </TR>
                     <TR>
                         <TD >NIP<font color="#ff0000" >*</font> </TD>
                            <TD><INPUT TYPE="text" NAME="nip_karyawan_cari" readonly id="r_pnpt__nip" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__NIP']; ?>
" >
                              
                                
                               
                            </TD>

                    </TR>
                    <TR>
                         <TD >Jenis Surat Peringatan<font color="#ff0000" >*</font> </TD>
                            <TD>
                                 <INPUT TYPE="hidden" NAME="t_sp__no_cari" readonly id="sp_no" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__NIP']; ?>
" >
                                <INPUT TYPE="text" NAME="jenis_cari" readonly id="jenis_sp" size="35" value="<?php echo $this->_tpl_vars['EDIT_T_LEMBUR__NIP']; ?>
" >
                                 <INPUT name="ButtonDepartemen" type="button" class="button" style="cursor: hand;" onclick="goCarikaryawan()" value=" ... " />
                               
                            </TD>

                    </TR>
                   
                 

                                                                        
                                                                   

                                                                       
                                                      
                                                                                             
                                                        <TR>
								<TD></TD>
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
                                                               
<a class="button" href="#"  onclick="return checkFrm(frmList1);"><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/button/blank.gif" align="absmiddle"> Cari</span></a>
<a class="button" href="#" onclick="this.blur();document.frmList1.reset(); resetFrm(frmList1); "><span><img src="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/button/blank.gif" align="absmiddle"> <?php echo $this->_tpl_vars['RESET']; ?>
</span></a>					
								</TD>
							</TR>	
                   
						
                </TABLE>
                                  

                                                                
			</FORM>
			</div></div>	 <!--TUTUP_PENCARIAN_DATA -->  
		</DIV>
       
														
		<?php if ($this->_tpl_vars['SEARCH'] <> ""): ?><br>
                <!--VIEW_INDEX-->
		<FORM METHOD=GET ACTION="" NAME="frmList">
                    <center>
                   <style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>
<table width='73%' border="0">
  <tr>
    <td>&nbsp;</td>
    <td rowspan="3"><img src="http://hris.tmw.co.id/hris/images/logo_tmw.jpg" width=125 height=110 border=0 alt=""></td>
    <td>&nbsp;</td>
    <td colspan="4"><div align="center">
      <h2>PT.TRITUNGGAL MULIA WISESA </h2>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center"><span class="style3">Jl.Kopo Jaya I No.8 Telp (022) 5416678 Fax.(022) 5415888 </span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5" class="style3"><div align="center">Kompleks Perkantoran Kopo Cirangrang - Bandung 40224 </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7"><hr></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;<?php unset($this->_sections['x']);
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
?></td>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center">SURAT KEPUTUSAN </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
    <td>&nbsp;</td>
    <td colspan="5"><div align="center">No.<?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__no']; ?>
/TMW/HRD/<?php echo $this->_tpl_vars['BLN_ROMAWI']; ?>
/2016</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="4">&nbsp;</td>
    <td colspan="4"><STRONG>MENIMBANG : </STRONG></td>
    <td width="113">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="47">&nbsp;</td>
  </tr>
  <tr>
    <td height="29">&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">Bahwa perusahaan Memandang perlu menegakkan peraturan dan tata tertib kerja, serta </div>      <div align="justify">ketentuan-ketentuan lain yang berlaku bagi karyawan PT.TRITUNGGAL MULIA WISESA </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7"><STRONG>MENGINGAT : </STRONG></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="3"><div align="justify"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__pelanggaran']; ?>
</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7">Maka dengan ini <STRONG>MEMUTUSKAN</STRONG> : </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7">Memberikan sanksi <strong>SURAT PERINGATAN</strong> <strong>
        
             <?php if (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 1): ?>
            <font color="#000000">KE-1 </font>              
                   <?php elseif (( $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__jenis'] ) == 2): ?>  
                            <font color="#000000">KE-2</font>     
                    <?php else: ?>  
                              <font color="#000000">KE-3</font>     
                   <?php endif; ?> 
            
            
        </strong> Kepada karyawan dibawah ini </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="113">Nama</td>
    <td width="33">:</td>
    <td colspan="3" ><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</td>
    <td colspan="2"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Posisi</td>
    <td>:</td>
    <td colspan="3"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Cabang</td>
    <td>:</td>
    <td colspan="3"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_cabang__nama']; ?>
</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">karena telah melakukan kelalaian dan pelanggaran SOP yang telah diarahkan secara tertulis, terkait eksekusi sub D dan P3B . </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="3"><div align="justify">Apabila dalam waktu <?php echo $this->_tpl_vars['LAMA_SP']; ?>
  bulan sejak tanggal dibuatnya surat keputusan ini karyawan Melakukan kesalahan yang sama atau lain maka perusahaan akan memberikan sanksi lebih lanjut. </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7" rowspan="2"><div align="justify">Demikian keputusan ini dibuat dan diberikan kepada Bapak / Ibu / Saudara agar dikemudian hari dapat lebih hati-hati dan tidak melakukan kesalahan lagi. </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Dibuat di </td>
    <td width="57">:</td>
    <td colspan="2">Bandung</td>
    <td width="175">&nbsp;</td>
    <td width="84">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Tanggal Dibuat </td>
    <td>:</td>
    <td colspan="2"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">Tanggal Berakhir </td>
    <td>:</td>
    <td colspan="2"><?php echo ((is_array($_tmp=$this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__tgl_expired'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%B-%Y") : smarty_modifier_date_format($_tmp, "%d-%B-%Y")); ?>
</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="133">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Yang Membuat </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Penerima Sanksi </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><em><strong><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__hglm']; ?>
</strong></em></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><em><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_pegawai__nama']; ?>
</em></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__hglm_mutasi']; ?>
</font></strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['r_jabatan__ket']; ?>
</font></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center">Mengetahui</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><em><strong><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__atasan']; ?>
 </strong></em></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="center"><strong><font size="1"><?php echo $this->_tpl_vars['DATA_TB'][$this->_sections['x']['index']]['t_sp__atasan_jabatan']; ?>
</font> </strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <!--tutup_data-->
    <?php endfor; else: ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td colspan="8">Maaf, Data yang dicari tidak ditemukan</td>
  </tr>
    <?php endif; ?>
</table>

                    </center>		





<div align=right>
<hr width=300><font size="1"><i><?php echo $this->_tpl_vars['SHOW_NAMA_KARYAWAN']; ?>
 - <?php echo $this->_tpl_vars['SHOW_NPK']; ?>
</i></font>&nbsp;&nbsp;</div>

                    
                <div style="position:relative;float:right;margin-top:20;"><INPUT TYPE="text" NAME="print_desc" class="text_transparent" style="background:transparant;border:0;">
                <IMG SRC="<?php echo $this->_tpl_vars['HREF_IMG_PATH']; ?>
/print.png" style="cursor:pointer" align="absmiddle" onMouseOver="document.frmList.print_desc.value='Download';" onMouseOut="document.frmList.print_desc.value='';" 
                onClick = "window.open('<?php echo $this->_tpl_vars['FILES']; ?>
');">							
                </div>
                </FORM>
           <!--CLOSE_VIEW_INDEX-->

            <?php endif; ?>

	</DIV>

</BODY>
</HTML>