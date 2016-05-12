<?php

class UpdateMasterSatuanKerjaHandlerContent extends ContentInterface{
	public function UpdateMasterSatuanKerjaHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		
		$Conn->Execute("
			UPDATE mst_satker 
			SET
				id = '". $_POST['Kode'] ."',
				nama = '". $_POST['Nama'] ."',
				alamat = '". $_POST['Alamat'] ."',
				id__mst_propinsi = '". $_POST['Propinsi'] ."',
				email = '". $_POST['Email'] ."',
				telp = '". $_POST['Telp'] ."',
				fax = '". $_POST['Fax'] ."',
				id__mst_tahun_anggaran = NULLIF('". $_POST['TahunAnggaran'] ."','-1'),
				nama_ketua = '". $_POST['Ketua'] ."',
				nip_ketua = '". $_POST['NIPKetua'] ."',
				nama_bendahara = '". $_POST['Bendahara'] ."',
				nip_bendahara = '". $_POST['NIPBendahara'] ."',
				nama_atasan = '". $_POST['Atasan'] ."',
				nip_atasan = '". $_POST['NIPAtasan'] ."'

			WHERE id = '" . $Par->Kode ."' 
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['Kode'])	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>