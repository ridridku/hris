<?php
class InsertPelaksanaKegiatanHandlerContent extends ContentInterface{
	public function InsertPelaksanaKegiatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_pelaksana_kegiatan
			WHERE 
				id__mst_satker = '" . $Par->Kode ."' AND
				id__mst_tahun_anggaran = '". $_POST['TahunAnggaran'] ."'
		");
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
				INSERT INTO mst_pelaksana_kegiatan (
					id__mst_satker,	id__mst_tahun_anggaran, id_pelaksana, nama
				)VALUES(
					'" . $Par->Kode ."',
					'". $_POST['TahunAnggaran'] ."',
					'". $_POST['IDPelaksanaKegiatan'] ."',
					'". $_POST['NamaPelaksanakegiatan'] ."'
				)"
			);
		}		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_satker'=>$Par->Kode,
				'id__mst_tahun_anggaran'=>$_POST['TahunAnggaran']
			)
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>