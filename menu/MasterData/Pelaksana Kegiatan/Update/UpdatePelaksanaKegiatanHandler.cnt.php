<?php

class UpdatePelaksanaKegiatanHandlerContent extends ContentInterface{
	public function UpdatePelaksanaKegiatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE mst_pelaksana_kegiatan 
			SET 
				id_pelaksana = '". $_POST['IDPelaksanaKegiatan'] ."',
				nama = '". $_POST['NamaPelaksanakegiatan'] ."'
			WHERE
				id__mst_satker = '" . $Par->IdSatker ."' AND
				id__mst_tahun_anggaran = '" . $Par->IdTahun ."'
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_satker' => $Par->Kode,
				'id__mst_tahun_anggaran' => $Par->IdTahun
			)
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>