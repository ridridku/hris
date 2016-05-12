<?php
class InsertMasterJembatanHandlerContent extends ContentInterface{
	public function InsertMasterJembatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");	
		$CekQuery = $Conn->Execute("
			SELECT * FROM mst_bridge
			WHERE id ='" . $_POST['IDJembatan'] ."' 
		");				
		if ($Conn->RowCount($CekQuery) == 0) {		  
			$Conn->Execute("
				INSERT INTO mst_bridge (
					id,
					nama,
					dari_lokasi,
					km_pos,
					id__mst_ruas_jalan,
					sffx,
					id__mst_bridge_tipe_lintasan,
					bentang,
					panjang,
					lebar,
					tahun_bangun,
					tipe_ba,
					tipe_bb,
					status,
					start_gps_lat,
					start_gps_lon,
					start_gps_alt,
					start_gps_elev,
					end_gps_lat,
					end_gps_lon,
					end_gps_alt,
					end_gps_elev,
					
					`jml_pier`,
					`jarak_pier_abutmen`,
					`jarak_pier_pier`,
					`lebar_median`,
					`lebar_trotoir`,
					`lebar_perkerasan`,
					`bahu_jalan`,
					`keterangan`,
					`id_mst_kabupaten_or_kodya`,
					`id_mst_type_bridge`
					`clearance`
					
					
									
				)VALUES( 
					'". $_POST['IDJembatan'] ."',
					'". $_POST['NamaJembatan'] ."',
					NULLIF('". $_POST['DariLokasi'] ."','-1'),
					NULLIF('". $_POST['km_pos'] ."',''),
					'". $Par->Kode ."',
					'". $_POST['SFFX'] ."',
					NULLIF('". $_POST['TipeLintasan'] ."','-1'),
					NULLIF('". $_POST['Bentang'] ."', ''),
					NULLIF('". $_POST['Panjang'] ."', ''),
					NULLIF('". $_POST['Lebar'] ."', ''),
					NULLIF('". $_POST['TahunBangunan'] ."', ''),
					NULLIF('". $_POST['TipeBA'] ."', ''),
					NULLIF('". $_POST['TipeBB'] ."', ''),
					NULLIF('". $_POST['Status'] ."', ''),
					NULLIF('". $_POST['AwalGPSLat'] ."', ''),
					NULLIF('". $_POST['AwalGPSLong'] ."', ''),
					NULLIF('". $_POST['AwalGPSAlt'] ."', ''),
					NULLIF('". $_POST['AwalGPSElev'] ."', ''),
					NULLIF('". $_POST['AkhirGPSLat'] ."', ''),
					NULLIF('". $_POST['AkhirGPSLong'] ."', ''),
					NULLIF('". $_POST['AkhirGPSAlt'] ."', ''),
					NULLIF('". $_POST['AkhirGPSElev'] ."', ''),
					NULLIF('". $_POST['jml_pier'] ."', ''),
					NULLIF('". $_POST['jarak_pier_abutmen'] ."', ''),
					NULLIF('". $_POST['jarak_pier_pier'] ."', ''),
					NULLIF('". $_POST['lebar_median'] ."', ''),
					NULLIF('". $_POST['lebar_trotoir'] ."', ''),
					NULLIF('". $_POST['lebar_perkerasan'] ."', ''),
					NULLIF('". $_POST['bahu_jalan'] ."', ''),
					NULLIF('". $_POST['keterangan'] ."', ''),
					NULLIF('". $_POST['id_mst_kabupaten_or_kodya'] ."', '-1'),
					NULLIF('". $_POST['id_mst_type_bridge'] ."', '-1'),
					NULLIF('". $_POST['clearance'] ."','')
					
				)"
			);
		}		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(array(
			'id'=>$_POST['IDJembatan'])
		);
		$Par->Next->IDJembatan = $_POST['IDJembatan'];	
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
}
?>