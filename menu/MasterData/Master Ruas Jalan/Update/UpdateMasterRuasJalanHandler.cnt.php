<?php

class UpdateMasterRuasJalanHandlerContent extends ContentInterface{
	public function UpdateMasterRuasJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");		
		$Conn->Execute("
			UPDATE mst_ruas_jalan 
			SET
				id = '". $_POST['Kode'] ."',
				ruas = '". $_POST['Ruas'] ."',
				sffx = '". $_POST['SSFX'] ."',
				kota = '". $_POST['Kota'] ."',
				nama_ruas = '". $_POST['NamaRuas'] ."', 
				lokasi = '". $_POST['Lokasi'] ."',
				kp_from = '". $_POST['KMFrom'] ."',
				kp_to = '". $_POST['KMTo'] ."',
				panjang = NULLIF('". $_POST['PanjangRuas'] ."', ''),
				lebar = NULLIF('". $_POST['LebarRuas'] ."', ''),
				panjang_kepmen = NULLIF('". $_POST['kepmen'] ."', ''),
				aadt = NULLIF('". $_POST['AADT'] ."', ''),
				awal_ruas = NULLIF('". $_POST['AwalJalan'] ."', ''),
				akhir_ruas = NULLIF('". $_POST['AkhirJalan'] ."', ''),
				mst = NULLIF('". $_POST['MST'] ."', ''),
				id__mst_propinsi = NULLIF('". $_POST['Propinsi'] ."', '-1'),
				id__mst_status_jalan = NULLIF('". $_POST['Status'] ."', '-1'),
				id__mst_fungsi = NULLIF('". $_POST['Fungsi'] ."', '-1'),
				id__mst_lintas = NULLIF('". $_POST['Lintas'] ."', '-1'),
				id__mst_tipe_jalan = NULLIF('". $_POST['TipeJalan'] ."', '-1'),
				pos_start_bt = NULLIF('". $_POST['AwalBT'] ."', ''),
				pos_start_ls = NULLIF('". $_POST['AwalLS'] ."', ''),
				pos_start_h = NULLIF('". $_POST['Akhirtinggi'] ."', ''),
				pos_end_bt = NULLIF('". $_POST['AkhirBT'] ."', ''),
				pos_end_ls = NULLIF('". $_POST['AkhirLS'] ."', ''),
				pos_end_h = NULLIF('". $_POST['AwalTinggi'] ."', ''),
				keterangan = NULLIF('". $_POST['Keterangan'] ."', '')
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