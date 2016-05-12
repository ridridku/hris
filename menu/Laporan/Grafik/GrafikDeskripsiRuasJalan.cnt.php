<?
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'menu/Graph Code Generator/MakeBarCode.mnu.php';
class GrafikDeskripsiRuasJalanContent extends ContentInterface
{
  public function GrafikDeskripsiRuasJalanContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();
	
	$GraphJalan = new MakeGraphGeneratorMenu($p->IdRuasJalan, $p->Waktu);
	$BarCode = new MakeBarCodeMenu($p->IdRuasJalan);
	ContentInterface::Assign('ImgGraphJalan', $GraphJalan->Ref());
	ContentInterface::Assign('ImgBarCode', $BarCode->Ref());	
	
	ContentInterface::Assign("Cetak",$p->Cetak);
	ContentInterface::Assign("Data",$this->DataPenjelasan($db, $p->IdRuasJalan, $p->Waktu ));    
	
	
	
	
	ContentInterface::Assign("postoffset",self::GetDataDeskripsiKA($p->IdRuasJalan, $p->Waktu));    
	ContentInterface::Assign("2KI",self::GetData2KI($p->IdRuasJalan, $p->Waktu));    
	ContentInterface::Assign("2KA",self::GetData2KA($p->IdRuasJalan, $p->Waktu)); 
	
	
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
				
				DT_IndonesiaDateTime(svy_deskripsi_ruas_jalan.timestamp)'Waktu'
		FROM 
				svy_deskripsi_ruas_jalan,
				mst_ruas_jalan
		WHERE 
			svy_deskripsi_ruas_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id AND
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' AND
			id__mst_lajur IN('1','3','2','4')
			
		GROUP BY mst_ruas_jalan.id";
	$rsl = $db->Execute($sql);
	return $Field = $db->FetchArray($rsl);
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  private function GetDataDeskripsiKA($IdRuasJalan, $Waktu){
  	$sql = "
		SELECT 
			CONCAT(post,'.',offset) AS 'Jarak' 
		FROM 
			svy_deskripsi_ruas_jalan
		
		WHERE
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' AND
			id__mst_lajur IN('1','3','2','4')
			
		GROUP BY post , offset";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }
  private function GetData2KI($IdRuasJalan, $Waktu){
  	$sql = "
		SELECT 
			lebar AS 'lebar' ,
			(lebar * 1.5) AS height
		FROM 
			svy_deskripsi_ruas_jalan
		
		WHERE
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' AND
			id__mst_lajur IN('2','4')
		GROUP BY post , offset";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }
  private function GetData2KA($IdRuasJalan, $Waktu){
  	$sql = "
		SELECT 
			lebar AS 'lebar' ,
			(lebar * 1.5) AS height
		FROM 
			svy_deskripsi_ruas_jalan
		
		WHERE
			
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' AND
			id__mst_lajur IN('1','3') 
			
		GROUP BY post , offset"; 
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }

}
?>