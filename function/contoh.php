 <?php
 require_once('../includes/db.conf.php');
 require_once('../adodb/adodb.inc.php');
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_perwakilan'])
{ $kode_perwakilan = $_POST['kode_perwakilan'];
}else{ $kode_perwakilan = $_GET['kode_perwakilan'];}
 
?>

<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT> 
 
<br><br><br><br><br>
<FORM NAME="frmCreate" METHOD="POST" ACTION="engine.php">
		<TABLE id="table-add-box">

				<TR>
					<TD>Id</TD>
					<TD> 
					<INPUT TYPE="text" NAME="id" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
				 
					</TD>			
				</TR>
  
				
				<TR>
					<TD>No.KTP</TD>
					<TD><INPUT TYPE="text" NAME="no_paspor"   size="35"></TD>
				</TR>

				<TR>
					<TD>No.Paspor <font color="#ff0000">*</font></TD>
					<TD><div id="ajax_cek_id"><INPUT TYPE="text" NAME="kode_wni"   size="35" OnChange="JavaScript:Ajax('ajax_cek_id','cek.php?kode_wni='+frmCreate.kode_wni.value+'&id='+frmCreate.id.value)"> 					
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
						<select name="kode_agama"  > 
						<option value=""> Pilih Agama </option>
						 
						</select>				
					</TD>	
				</TR>
					<TR>
					<TD>Tempat Lahir</TD>
					<TD><INPUT TYPE="text" NAME="tempat_lahir"   size="35"></TD>
				</TR>

				<TR>
					<TD>Tanggal Lahir</TD>
					<TD>
	 

							 <input type="text" name="tanggal"   >
							 <img src="icon/calendar.png"  onclick="displayCalendar(document.frmCreate.tanggal,'yyyy-mm-dd',this)"  class="imgLink" align="absmiddle" title="Show Calendar List">  	
					 
					</TD>	
				</TR>

<TR>
					<TD>Jenis Kelamin <font color="#ff0000">*</font></TD>
					<TD>
					 
					<select name="jk"  > 
						<option value="">[Pilih Jenis Kelamin]</option>
						 
						<option value="1"   > Perempuan </option>
						<option value="2"    > Laki-Laki </option>
						 
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
						<option value=""> Pilih Provinsi </option>
						 
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
					<TD><INPUT TYPE="text" NAME="alamat"   size="35"></TD>
				</TR>	

			<TR>
					<TD>No.Telp di Dalam Negeri</TD>
					<TD><INPUT TYPE="text" NAME="tlp"   size="35"></TD>
				</TR>	
				<TR>
					<TD>Alamat di Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="alamat_ln"   size="35"></TD>
				</TR>	
	
			<TR>
					<TD>No.Telp di Luar Negeri</TD>
					<TD><INPUT TYPE="text" NAME="tlp_ln"   size="35"></TD>
				</TR>
				<TR>
					<TD>Lama Tinggal di Luar Negeri </TD>
					<TD><INPUT TYPE="text" NAME="lama_tinggal"   size="35"></TD>
				</TR>				
				 
				 <TR>
					<TD>Klasifikasi WNI <font color="#ff0000">*</font></TD>
					<TD>
				 
					<select name="kode_klasifikasi_wni"  onchange="cari_jenis(this.value);" > 
					 <option value="">[Pilih Klasifikasi WNI]</option>
					 <option value="1"   >WNI NON TKI</option>
					  <option value="3"   >TKI FORMAL</option>
					   <option value="4"  >TKI INFORMAL</option>
					    <option value="6"  >TKI ABK</option>
					 </select>										
				 </TD>
				</TR>	
 

				<TR>
					<TD>Jenis WNI <font color="#ff0000">*</font></TD>
					<TD>   
					 <div id="ajax_jenis_wni">
					 <select name="kode_jenis" > 
						<option value="">[Pilih Jenis WNI]</option> 
					  </select>	
					 </div>
				 </TD>
				</TR>	

				<TR><td height="40"></td>
					<TD>
			 
					<INPUT TYPE="hidden" name="op" value="0">
					<a class="button" href="#" onclick="this.blur();return checkFrm(frmCreate);"><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">SIMPAN</span></a>
					<a class="button" href="#" onclick="this.blur();document.frmCreate.reset(); resetFrm(frmCreate); "><span><img src="<!--{$HREF_IMG_PATH}-->/icon/blank.gif" align="absmiddle">BATAL</span></a>					
					</TD>
				</TR>
				 
					<TR><td  colspan="2"> <font color="#ff0000"> Keterangan * Wajib Diisi</font></td>
					 
					</tr>
			</TABLE>



		</FORM>