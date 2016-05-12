<?
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'menu/Graph Code Generator/MakeBarCode.mnu.php';
class GrafikJembatanPosisiContent extends ContentInterface
{
  public function GrafikJembatanPosisiContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();
	
	$GraphJalan = new MakeGraphJembatanGeneratorMenu($p->IdRuasJalan, $p->Time);
	ContentInterface::Assign('ImgGraphJalan', $GraphJalan->Ref());	
	ContentInterface::Assign("Data",$this->DataPenjelasan($db, $p->IdRuasJalan, $p->Time));    
	ContentInterface::Assign("Cetak",$p->Cetak);
	
	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  
  public function Path(){return __FILE__;}  
  private function DataPenjelasan(DatabaseInterface $db, $IdRuasJalan, $Waktu){
  	$sql = "
		SELECT 
				CONCAT(mst_ruas_jalan.id,' / ',mst_ruas_jalan.nama_ruas)'NamaRuas',
				(  SELECT 
						nama
					FROM
						mst_propinsi
					WHERE
					mst_ruas_jalan.id__mst_propinsi = mst_propinsi.id
				)'Propinsi',
				
				DT_IndonesiaDateTime(svy_posisi_jembatan.timestamp)'Waktu'
		FROM 
				svy_posisi_jembatan,
				mst_ruas_jalan
		WHERE 
			svy_posisi_jembatan.id__mst_ruas_jalan = mst_ruas_jalan.id AND
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."'
			
		GROUP BY mst_ruas_jalan.id";
	$rsl = $db->Execute($sql);
	return $Field = $db->FetchArray($rsl);
  }
 

}
?>