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
<tr><td colspan="5" align="center" class="judul"><strong>DATA BHI UNTUK  <?=$nm_perwakilan?> </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>

<FORM NAME="frmCreate" METHOD="POST" ACTION="bhi/engine.php">
		 <TABLE id="table-add-box">
<TR>
					<TD>Kode BHI</TD>
					<TD> 
					<INPUT TYPE="text" NAME="kode_bhi" value="(OTOMATIS OLEH SISTEM)" size="35" readOnly class="text_disabled">
 
					</TD>
				</TR>
                

               	<TR>
					<TD>Tanggal Input</TD>
					<TD>
					  
							  <input type="text" name="tgl_input" >
							 <img src="<?=$HREF_THEME?>/defaults/images/icon/calendar.png" onclick="displayCalendar(document.frmCreate.tgl_input,'yyyy-mm-dd',this)" class="imgLink" align="absmiddle" title="Show Calendar List"> 


				 
					</TD>
				</TR>
				<TR>
					<TD>BHI</TD>
					<TD>
					 
					<INPUT TYPE="text" NAME="bhi"   size="35">
				 
					</TD>
				</TR>
                <TR>
					<TD>Alamat </TD>
					<TD><textarea cols="50" rows="3" name="alamat_ln"></textarea> </TD>
				</TR>

                <TR>
					<TD>Pemilik</TD>
					<TD><INPUT TYPE="text" NAME="pemilik"   size="35"></TD>
				</TR>

                <TR>
					<TD>No Telepon</TD>
					<TD><INPUT TYPE="text" NAME="no_tlp"   size="35"></TD>
				</TR>

                <TR>
					<TD>Tahun Pendirian</TD>
                    
					<TD>
                    
					<INPUT TYPE="text" NAME="tahun" size="35">
					 
                    
                    </TD>
				</TR>

             <TR>
					<TD>Jumlah Karjaya</TD>
					<TD><INPUT TYPE="text" NAME="jml_karjaya" size="35"></TD>
				</TR>

                 <TR>
					<TD>Jenis Badan Hukum</TD>
                    <TD>
                    <select name="jenis_bh"  > 
						<option value="">[Pilih Jenis Badan Hukum]</option>
						 
						<option value="1" > Badan Hukum Milik Swasta </option>
						<option value="2" > Badan Hukum Milik Negara </option>
						 
						</select>	
                    
                    </TD>
				</TR>
				
				<TR>
					<TD>Kategori Usaha</TD>
					<TD><select name="kode_kat_usaha" >
						<option value="">[ Pilih Kategori Usaha ]</option> 

						<? 
									$sql_kat_usaha = "SELECT  *  FROM tbl_mast_kat_usaha  order by nama_usaha asc ";

									$rs_prop=$db->Execute($sql_kat_usaha);
									while(!$rs_prop->EOF):   ?>
									     <option value="<?=$rs_prop->fields['kode_kat_usaha'];?>"><?=$rs_prop->fields['nama_usaha'];?></option> 
									 <? $rs_prop->MoveNext();
									endwhile;
									?>



						</select> </TD>
				</TR>

				 
 
 
				
				 <TR><td height="40"></td>
					<TD>			 
					 
					<INPUT TYPE="hidden" name="kode_perwakilan" value="<?=$kode_perwakilan?>" >	
					<input type="button" value="SIMPAN" name="SIMPAN" onclick="return checkFrm(frmCreate);" > 
					<input type="button" value="BATAL" name="BATAL" onclick="window.location='list_bhi2.php?kode_perwakilan=<?=$kode_perwakilan?>';"> 
					</TD>
				</TR>
 
			</TABLE>


		</FORM>