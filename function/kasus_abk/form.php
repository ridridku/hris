 <?php
  require_once('../../includes/config.conf.php');
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_perwakilan'])
{ $kode_perwakilan = $_POST['kode_perwakilan'];
}else{ $kode_perwakilan = $_GET['kode_perwakilan'];}
 
$sql_pw="select upper(nm_perwakilan) as nm_perwakilan  from tbl_mast_perwakilan where kode_perwakilan='$kode_perwakilan'";
$rs_pw	= $db->execute($sql_pw);
$nm_perwakilan=$rs_pw->fields['nm_perwakilan'];

?>
 
<br><br> 
<table width="500" border="0" cellpadding="0" cellspacing="0">
 <tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>
<tr><td colspan="5" align="center" class="judul"><strong>DATA  WNI UNTUK PERWAKILAN <?=$nm_perwakilan?> </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>

<FORM NAME="frmCreate" METHOD="POST" ACTION="kasus_abk/engine.php">
		<TABLE id="table-add-box">

				<TR>
					<TD>Id</TD>
					<TD> 
					<INPUT TYPE="text" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">				 
					</TD>			
				</TR>
  
				
				<TR>
					<TD>No.KTP</TD>
					<TD><INPUT TYPE="text" NAME="no_paspor" size="35"></TD>
				</TR>

				<TR>
					<TD>No.Paspor <font color="#ff0000">*</font></TD>
					<TD>
					<div id="ajax_cek_id"><INPUT TYPE="text" NAME="kode_wni" size="35" OnChange="JavaScript:Ajax('ajax_cek_id','kasus_wni/cek.php?kode_wni='+frmCreate.kode_wni.value+'&id='+frmCreate.id.value)"> 					
					</div>			
					
					</TD>
				</TR>
 
				<TR>
					<TD>Nama WNI <font color="#ff0000">*</font> </TD>
					<TD><INPUT TYPE="text" NAME="nama"  size="35"></TD>
				</TR>

			    <TR>
					<TD>Agama</TD>
					<TD> 
									<select name="kode_agama" id="kode_agama"   >
									<option value=""> [Pilih Agama] </option>
									<? 
									$sql_prop="select * from tbl_mast_agama ";
									$rs_prop=$db->Execute($sql_prop);
									while(!$rs_prop->EOF):   ?>
									     <option value="<?=$rs_prop->fields['kode_agama'];?>"><?=$rs_prop->fields['nama_agama'];?></option> 
									 <? $rs_prop->MoveNext();
									endwhile;
									?>

									</select>


					</TD>	
				</TR>
					<TR>
					<TD>Tempat Lahir</TD>
					<TD><INPUT TYPE="text" NAME="tempat_lahir" size="35"></TD>
				</TR>

				<TR>
					<TD>Tanggal Lahir</TD>
					<TD>
	 

							 <input type="text" name="tanggal" >
							 <img src="<?=$HREF_THEME?>/defaults/images/icon/calendar.png" onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)" class="imgLink" align="absmiddle" title="Show Calendar List">  	
					 
					</TD>	
				</TR>

				<TR>
					<TD>Jenis Kelamin <font color="#ff0000">*</font></TD>
					<TD>
					 
					<select name="jk" > 
						<option value="">[Pilih Jenis Kelamin]</option>						 
						<option value="1" > Perempuan </option>
						<option value="2" > Laki-Laki </option>						 
						</select>										
					 </TD>
				</TR>	

					<TR>
					<TD colspan="2"><u>Daerah Asal</u></TD>
				</TR>
 
				<TR>
					<TD>Propinsi</TD>
					<TD> 

									<select name="no_propinsi" onchange="cari_kab(this.value);"> 
									<option value=""> [Pilih Provinsi] </option>
						 
									<? 
									$sql_propinsi = "SELECT id_propinsi,no_propinsi,nama_propinsi FROM tbl_mast_wil_propinsi ";
									$rs_propinsi=$db->Execute($sql_propinsi);
									while(!$rs_propinsi->EOF):   ?>
									     <option value="<?=$rs_propinsi->fields['no_propinsi'];?>"><?=$rs_propinsi->fields['nama_propinsi'];?></option> 
									 <? 
									$rs_propinsi->MoveNext();
									endwhile;
									?>

									</select>



					</TD>	
				</TR>

				<TR>
					<TD>Kabupaten</TD>
					<TD>
					<div id="ajax_kabupaten">
					<select name="id_kab" > 
						<option value="">[Pilih Kabupaten]</option>
						 
						</select>										
					</div></TD>
				</TR>	
				 	

				<TR>
					<TD>Alamat di Dalam Negeri</TD>
					<TD><INPUT TYPE="text" NAME="alamat" size="35"></TD>
				</TR>	

			<TR>
					<TD>No.Telp di Dalam Negeri</TD>
					<TD><INPUT TYPE="text" NAME="tlp" size="35"></TD>
				</TR>	
				<TR>
					<TD>Alamat di Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="alamat_ln" size="35"></TD>
				</TR>	
	
				<TR>
					<TD>No.Telp di Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="tlp_ln" size="35"></TD>
				</TR>
				<TR>
					<TD>Lama Tinggal di Luar Negeri </TD>
					<TD><INPUT TYPE="text" NAME="lama_tinggal" size="35"></TD>
				</TR>				

				<TR>
					<TD>Jenis WNI <font color="#ff0000">*</font></TD>
					<TD>   
					 <div id="ajax_jenis_wni">
					 <select name="kode_jenis" > 
									<option value="">[Pilih Jenis WNI]</option> 

									<? 
									$sql_kecamatan = "SELECT * from tbl_mast_jenis_abk ORDER BY nama_abk ASC";
									$rs_kec=$db->Execute($sql_kecamatan);
									while(!$rs_kec->EOF):   ?>
										 <option value="<?=$rs_kec->fields['kode_jenis_abk'];?>"> <?=$rs_kec->fields['nama_abk'];?></option> 
									 <? 
									$rs_kec->MoveNext();
									endwhile;
									?>


					  </select>	
					 </div>
				 </TD>
				</TR>	

				<TR><td height="40"></td>
					<TD>
			 
					<INPUT TYPE="hidden" name="kode_perwakilan" value="<?=$kode_perwakilan?>" >	 
					 
					<input type="button" value="SIMPAN" name="SIMPAN" onclick="return checkFrm(frmCreate);" > 
					<input type="button" value="BATAL" name="BATAL" onclick="window.location='list_abk.php?kode_perwakilan=<?=$kode_perwakilan?>';"> 
					</TD>
				</TR>
				 
					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>
					 <input type="hidden" name="kode_klasifikasi_wni" value="6"> 
					</tr>
			</TABLE>
 
		</FORM>