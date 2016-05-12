<?
class PrintedDataRuasJalanContent extends ContentInterface
{
  public function PrintedDataRuasJalanContent(){
	ContentInterface::ContentInterface();
  }
  private function GetDataRuasJalan($Conn, $Bidang){  
	  $sql ="
		SELECT
			mst_ruas_jalan.kota,
			mst_ruas_jalan.nama_ruas,
			CONCAT(mst_ruas_jalan.panjang)'panjang',
			CONCAT(mst_ruas_jalan.lebar)'lebar',
			CONCAT(svy_drp_ruas_jalan.post)'post',
			CONCAT(svy_drp_ruas_jalan.offset)'offset'			
		FROM
			svy_drp_ruas_jalan, mst_ruas_jalan
		WHERE
			mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."'
			) AND
			svy_drp_ruas_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id
	";
	  $resUraian = $Conn->Execute($sql);
	  return $resUraian->GetRows();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$adodb = $db->MakeAdoDb();
	$odf = new odf("Printed odt/data_ruas_jalan.odt");
	#surat 
	$syarat = array();	
	$DataRuasJalan = $this->GetDataRuasJalan($adodb, $p->IdBidang);
	$JumlahData = count($DataRuasJalan);
	for($a=0;$a<$JumlahData;$a++){	
	$syarat[] = array(
					'no' => $a + 1, 
					'kota' => $DataRuasJalan[$a]['kota'],
					'nama_ruas' => $DataRuasJalan[$a]['nama_ruas'],
					'panjang' => is_null($DataRuasJalan[$a]['panjang'])? '': $DataRuasJalan[$a]['panjang'],
					'lebar' => is_null($DataRuasJalan[$a]['lebar']) ?' ': $DataRuasJalan[$a]['lebar'],
					'post' => $DataRuasJalan[$a]['post'],
					'offset' => $DataRuasJalan[$a]['offset']										
				);
	}
	$dft_syarat = $odf->setSegment('daftar_ruas');
	foreach($syarat as $element){
		$dft_syarat->no($element['no']);
		$dft_syarat->kota($element['kota']);
		$dft_syarat->nama_ruas($element['nama_ruas']);
		$dft_syarat->panjang($element['panjang']);
		$dft_syarat->lebar($element['lebar']);
		$dft_syarat->post($element['post']);
		$dft_syarat->offset($element['offset']);
		$dft_syarat->merge();
	}
	$odf->mergeSegment($dft_syarat);
	
	$odf->exportAsAttachedFile();
  }
  public function Path(){return __FILE__;}
}
?>