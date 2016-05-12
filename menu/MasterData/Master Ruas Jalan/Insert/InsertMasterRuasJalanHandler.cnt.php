<?php
class InsertMasterRuasJalanHandlerContent extends ContentInterface{
	public function InsertMasterRuasJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_ruas_jalan
			WHERE `id`='" . $_POST['Kode'] ."' 
		");				
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
				INSERT INTO mst_ruas_jalan (
					id, ruas, sffx, kota, nama_ruas, lokasi, kp_from, kp_to, panjang, lebar, panjang_kepmen, aadt,
					awal_ruas, akhir_ruas, mst, id__mst_propinsi, id__mst_status_jalan, id__mst_fungsi,
					id__mst_lintas, id__mst_tipe_jalan, pos_start_bt, pos_start_ls, pos_start_h,
					pos_end_bt, pos_end_ls, pos_end_h, keterangan
				)VALUES( 
					'". $_POST['Kode'] ."', 
					'". $_POST['Ruas'] ."',
					'". $_POST['SSFX'] ."',
					'". $_POST['Kota'] ."',
					'". $_POST['NamaRuas'] ."', 
					'". $_POST['Lokasi'] ."',
					'". $_POST['KMFrom'] ."',
					'". $_POST['KMTo'] ."',
					NULLIF('". $_POST['PanjangRuas'] ."', ''),
					NULLIF('". $_POST['LebarRuas'] ."', ''),
					NULLIF('". $_POST['kepmen'] ."', ''),
					NULLIF('". $_POST['AADT'] ."', ''),
					NULLIF('". $_POST['AwalJalan'] ."', ''),
					NULLIF('". $_POST['AkhirJalan'] ."', ''),
					NULLIF('". $_POST['MST'] ."', ''),
					NULLIF('". $_POST['Propinsi'] ."', '-1'),
					NULLIF('". $_POST['Status'] ."', '-1'),
					NULLIF('". $_POST['Fungsi'] ."', '-1'),
					NULLIF('". $_POST['Lintas'] ."', '-1'),
					NULLIF('". $_POST['TipeJalan'] ."', '-1'),
					NULLIF('". $_POST['AwalBT'] ."', ''),
					NULLIF('". $_POST['AwalLS'] ."', ''),
					NULLIF('". $_POST['Akhirtinggi'] ."', ''),
					NULLIF('". $_POST['AkhirBT'] ."', ''),
					NULLIF('". $_POST['AkhirLS'] ."', ''),
					NULLIF('". $_POST['AwalTinggi'] ."', ''),
					NULLIF('". $_POST['Keterangan'] ."', '')
				 )"
			);
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