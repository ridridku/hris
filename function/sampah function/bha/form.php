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
<tr><td colspan="5" align="center" class="judul"><strong>DATA BADAN USAHA ASING </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>

<FORM NAME="frmCreate" METHOD="POST" ACTION="bha/engine.php">
		 <TABLE id="table-add-box">
	<TR>
				<TD width="200">KODE BADAN USAHA ASING</TD>
					<TD> 
					<INPUT TYPE="text" NAME="kode_bha" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">

					 
					</TD>
				</TR>

 

				  <TR>
					<TD width="100">NAMA BADAN USAHA ASING</TD>
					<TD><INPUT TYPE="text" NAME="nama_bha"   size="35">
					</TD>			
				</TR>
                 <TR>
					<TD width="100">NEGARA</TD>	
					<TD>
                                    
					
						<select name="kode_negara"  > 
						<option value=""> [Pilih Negara] </option>
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
					<TD width="100">ALAMAT</TD>	
					<TD><INPUT TYPE="text" NAME="alamat"   size="35">
					</TD>			
				</TR>
                
               <TR>
					<TD width="100">TELEPON</TD>	
					<TD><INPUT TYPE="text" NAME="tlp"   size="35">
					</TD>			
				</TR>

				 <TR>
					<TD width="100">FAX</TD>	
					<TD><INPUT TYPE="text" NAME="fax"   size="35">
					</TD>			
				</TR>

				 <TR>
					<TD width="100">EMAIL</TD>	
					<TD><INPUT TYPE="text" NAME="email"  size="35">
					</TD>			
				</TR>
				 
 
 
				
				 <TR><td height="40"></td>
					<TD>			 
					 
					 
					<input type="button" value="SIMPAN" name="SIMPAN" onclick="return checkFrm(frmCreate);" > 
					<input type="button" value="BATAL" name="BATAL" onclick="window.location='list_bha.php?kode_perwakilan=<?=$kode_perwakilan?>';"> 
					</TD>
				</TR>
 
			</TABLE>


		</FORM>