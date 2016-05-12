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
<tr><td colspan="5" align="center" class="judul"><strong>DATA WARGA NEGARA ASING </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>

<FORM NAME="frmCreate" METHOD="POST" ACTION="wna/engine.php">
		 <TABLE id="table-add-box">
	<TR>
					<TD>KODE WNA</TD>
					<TD> 
					<INPUT TYPE="text" NAME="kode_wna" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">

					 
					</TD>
				</TR>
 
				<TR>
					<TD>NEGARA</TD>
					<TD><select name="kode_negara"  > 
						<option value=""> [Pilih Negara WNA] </option>
						 <? 
									$sql_prop="select * from tbl_mast_negara ";
									$rs_prop=$db->Execute($sql_prop);
									while(!$rs_prop->EOF):   ?>
									     <option value="<?=$rs_prop->fields['kode_negara'];?>"><?=$rs_prop->fields['nama_negara'];?></option> 
									 <? $rs_prop->MoveNext();
									endwhile;
									?>
						</select>	
					</TD>
				</TR>
				<TR>
					<TD>NAMA WNA </TD>
					<TD> 
					<INPUT TYPE="text" NAME="nama_wna" size="35">
				 
					</TD>
				</TR>
				<TR>
					<TD>ALAMAT WNA di Dalam Negeri</TD>
					<TD> 
					<INPUT TYPE="text" NAME="alamat_ind" size="35">
				 
					</TD>
				</TR>
				<TR>
					<TD>TELP WNA di Dalam Negeri</TD>
					<TD> 
					<INPUT TYPE="text" NAME="tlp_ind" size="35">
					 
					</TD>
				</TR>
				<TR>
					<TD>ALAMAT WNA di Luar Negeri</TD>
					<TD> 
					<INPUT TYPE="text" NAME="alamat_ln" size="35">
					 
					</TD>
				</TR>
				<TR>
					<TD>TELP WNA di Luar Negeri</TD>
					<TD> 
					<INPUT TYPE="text" NAME="tlp_ln" size="35">
					 
					</TD>
				</TR>
				<TR>
					<TD>KETERANGAN </TD>
					<TD> 

					<textarea cols="60" rows="5" name="keterangan"> </textarea>


					</TD>
				</TR>

				 
 
 
				
				 <TR><td height="40"></td>
					<TD>			 
					 
					<INPUT TYPE="hidden" name="kode_perwakilan" value="<?=$kode_perwakilan?>" >	
					<input type="button" value="SIMPAN" name="SIMPAN" onclick="return checkFrm(frmCreate);" > 
					<input type="button" value="BATAL" name="BATAL" onclick="window.location='list_wna.php?kode_perwakilan=<?=$kode_perwakilan?>';"> 
					</TD>
				</TR>
 
			</TABLE>


		</FORM>