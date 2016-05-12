<?
class PrintedMasterJembatanOdtContent extends ContentInterface
{
  public function PrintedMasterJembatanOdtContent(){
	ContentInterface::ContentInterface();
  }
  private function GetDataDetailJembatan($db){  
	  $sql ="
				SELECT SQL_CALC_FOUND_ROWS mst_bridge.*, 
						(
							SELECT 	mst_propinsi.nama 
							FROM mst_propinsi 
							WHERE mst_propinsi.id IN(				
								SELECT mst_ruas_jalan.id__mst_propinsi
								FROM mst_ruas_jalan
								WHERE
									mst_bridge.id__mst_ruas_jalan = mst_ruas_jalan.id)
						)'propinsi',
						( 
							SELECT mst_kota.nama 
							FROM mst_kota 
							WHERE mst_bridge.dari_lokasi = mst_kota.id 
						)'dari_sta' , 
						( 
							SELECT mst_ruas_jalan.nama_ruas 
							FROM mst_ruas_jalan 
							WHERE mst_bridge.id__mst_ruas_jalan = mst_ruas_jalan.id 
						) 'nama_ruas', 
						( 
							SELECT mst_bridge_tipe_lintasan.nama 
							FROM mst_bridge_tipe_lintasan 
							WHERE mst_bridge.id__mst_bridge_tipe_lintasan = mst_bridge_tipe_lintasan.id 
						) 'lintasan'
				FROM 
						mst_bridge,mst_ruas_jalan
				WHERE 
						`mst_bridge`.`id__mst_ruas_jalan` = mst_ruas_jalan.id AND
						mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."')
				";
#	  echo $sql;
	  $resUraian = $db->Execute($sql);
	  return $resUraian->GetRows();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$adodb = $db->MakeAdoDb();
	$odf = new odf("Printed odt/master_jembatan.odt");
	#surat 
	$syarat = array();	
	$DataJembatan = $this->GetDataDetailJembatan($adodb);
	$JumlahData = count($DataJembatan);
	for($a=0;$a<$JumlahData;$a++){	
	$syarat[] = array(
					'no' => $a + 1, 
					'id' => $DataJembatan[$a]['id'],
					'nama' => $DataJembatan[$a]['nama'],
					'bentang' => $DataJembatan[$a]['bentang'],
					'panjang' => $DataJembatan[$a]['panjang'],
					'lebar' => $DataJembatan[$a]['lebar'],
					'tahun_bangun' => $DataJembatan[$a]['tahun_bangun'],
					
					'tipe_ba' => $DataJembatan[$a]['tipe_ba'],
					'tipe_bb' => $DataJembatan[$a]['tipe_bb'],
					'status' => $DataJembatan[$a]['status'],
					'jml_pier' => $DataJembatan[$a]['jml_pier'],
					'jarak_pier_abutmen' => $DataJembatan[$a]['jarak_pier_abutmen'],
					'lebar_median' => $DataJembatan[$a]['lebar_median'],
					'lebar_perkerasan' => $DataJembatan[$a]['lebar_perkerasan'],
					'bahu_jalan' => $DataJembatan[$a]['bahu_jalan'],
					
					
					'start_gps_lat' => $DataJembatan[$a]['start_gps_lat'],
					'start_gps_lon' => $DataJembatan[$a]['start_gps_lon'],
					'end_gps_lat' => $DataJembatan[$a]['end_gps_lat'],
					'end_gps_lon' => $DataJembatan[$a]['end_gps_lon'],
					
					
					
					'dari_sta' => $DataJembatan[$a]['dari_sta'],
					'lintasan' => is_null($DataJembatan[$a]['lintasan'])? '': $DataJembatan[$a]['lintasan'],
					'km_post' => is_null($DataJembatan[$a]['km_post']) ?' ': $DataJembatan[$a]['km_post'],
					'nama_ruas' => $DataJembatan[$a]['nama_ruas'],
					'sffx' => $DataJembatan[$a]['sffx']										
				);
	}
	$dft_syarat = $odf->setSegment('daftar_ruas');
	foreach($syarat as $element){
		$dft_syarat->no($element['no']);
		$dft_syarat->id($element['id']);
		$dft_syarat->nama($element['nama']);
		$dft_syarat->bentang($element['bentang']);				
		$dft_syarat->panjang($element['panjang']);				
		$dft_syarat->lebar($element['lebar']);				
		$dft_syarat->tahun_bangun($element['tahun_bangun']);
		
		$dft_syarat->tipe_ba($element['tipe_ba']);
		$dft_syarat->tipe_bb($element['tipe_bb']);
		$dft_syarat->status($element['status']);
		$dft_syarat->jml_pier($element['jml_pier']);				
		$dft_syarat->jarak_pier_abutmen($element['jarak_pier_abutmen']);				
		$dft_syarat->lebar_median($element['lebar_median']);				
		$dft_syarat->lebar_perkerasan($element['lebar_perkerasan']);	
		$dft_syarat->bahu_jalan($element['bahu_jalan']);	
		
		$dft_syarat->start_gps_lat($element['start_gps_lat']);				
		$dft_syarat->start_gps_lon($element['start_gps_lon']);				
		$dft_syarat->end_gps_lat($element['end_gps_lat']);	
		$dft_syarat->end_gps_lon($element['end_gps_lon']);		
		
					
		$dft_syarat->dari_sta($element['dari_sta']);
		$dft_syarat->lintasan($element['lintasan']);
		$dft_syarat->km_post($element['km_post']);
		$dft_syarat->nama_ruas($element['nama_ruas']);
		$dft_syarat->sffx($element['sffx']);
		$dft_syarat->merge();
	}
	$odf->mergeSegment($dft_syarat);
	$odf->setVars('propinsi',strtoupper($DataJembatan[0]['propinsi']));
	$odf->exportAsAttachedFile();
  }
  public function Path(){return __FILE__;}
}
?>