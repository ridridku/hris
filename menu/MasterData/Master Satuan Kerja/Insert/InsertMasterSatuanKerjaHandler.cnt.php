<?php
class InsertMasterSatuanKerjaHandlerContent extends ContentInterface{
	public function InsertMasterSatuanKerjaHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_satker
			WHERE `id`='" . $_POST['Kode'] ."' 
		");				
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
			  INSERT INTO `mst_satker` (
				id,
				nama,
				alamat,
				id__mst_propinsi,
				email,
				telp,
				fax,
				id__mst_tahun_anggaran,
				nama_ketua,
				nip_ketua,
				nama_bendahara,
				nip_bendahara,
				nama_atasan,
				nip_atasan
			)VALUES( 
				'". $_POST['Kode'] ."', 
				'". $_POST['Nama'] ."', 
				'". $_POST['Alamat'] ."',
				'". $_POST['Propinsi'] ."',
				'". $_POST['Email'] ."',
				'". $_POST['Telp'] ."', 
				'". $_POST['Fax'] ."',
				NULLIF('". $_POST['TahunAnggaran'] ."','-1'),
				'". $_POST['Ketua'] ."',
				'". $_POST['NIPKetua'] ."',
				'". $_POST['Bendahara'] ."',
				'". $_POST['NIPBendahara'] ."',
				'". $_POST['Atasan'] ."',
				'". $_POST['NIPAtasan'] ."'
			   )");
		}		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['Kode'])	
		);
		$Par->Next->Kode = $_POST['Kode'];	
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>