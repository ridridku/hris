<?php

class UpdateMasterJembatanHandlerContent extends ContentInterface{
	public function UpdateMasterJembatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$Conn->Execute("
			UPDATE mst_bridge 
			SET 
				id = '". $_POST['IDJembatan'] ."',
				nama = '". $_POST['NamaJembatan'] ."',
				dari_lokasi = NULLIF('". $_POST['DariLokasi'] ."','-1'),
				km_pos = NULLIF('".$_POST['km_pos']."',''),
				id__mst_ruas_jalan = '". $Par->Kode ."',
				sffx = '". $_POST['SFFX'] ."',
				id__mst_bridge_tipe_lintasan = NULLIF('". $_POST['TipeLintasan'] ."','-1'),
				bentang = NULLIF('". $_POST['Bentang'] ."', ''),
				panjang = NULLIF('". $_POST['Panjang'] ."', ''),
				lebar = NULLIF('". $_POST['Lebar'] ."', ''),
				tahun_bangun = NULLIF('". $_POST['TahunBangunan'] ."', ''),
				tipe_ba = NULLIF('". $_POST['TipeBA'] ."', ''),
				tipe_bb = NULLIF('". $_POST['TipeBB'] ."', ''),
				status = NULLIF('". $_POST['Status'] ."', ''),
				start_gps_lat = NULLIF('". $_POST['AwalGPSLat'] ."', ''),
				start_gps_lon = NULLIF('". $_POST['AwalGPSLong'] ."', ''),
				start_gps_alt = NULLIF('". $_POST['AwalGPSAlt'] ."', ''),
				start_gps_elev = NULLIF('". $_POST['AwalGPSElev'] ."', ''),
				end_gps_lat = NULLIF('". $_POST['AkhirGPSLat'] ."', ''),
				end_gps_lon = NULLIF('". $_POST['AkhirGPSLong'] ."', ''),
				end_gps_alt = NULLIF('". $_POST['AkhirGPSAlt'] ."', ''),
				end_gps_elev = NULLIF('". $_POST['AkhirGPSElev'] ."', ''),
				keterangan = NULLIF('". $_POST['keterangan'] ."', ''),
				id_mst_kabupaten_or_kodya = NULLIF('". $_POST['id_mst_kabupaten_or_kodya'] ."','-1'),
				id_mst_type_bridge = NULLIF('". $_POST['id_mst_type_bridge'] ."','-1'),
				clearance = NULLIF('". $_POST['clearance'] ."','')
			WHERE id = '" . $Par->IDJembatan ."' 
		");		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['IDJembatan'])	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>