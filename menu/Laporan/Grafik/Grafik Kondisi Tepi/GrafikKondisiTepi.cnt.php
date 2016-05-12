<?
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'menu/Graph Code Generator/MakeBarCode.mnu.php';
 require_once 'constant/Bahu.cst.php';
class GrafikKondisiTepiContent extends ContentInterface
{
  public function GrafikKondisiTepiContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();

	$Ket = 1;
	$GraphKeterangan = new MakeGraphKeteranganGeneratorMenu($p->IdRuasJalan, $p->Waktu, $Ket );
	ContentInterface::Assign('ImgGraphKeterangan', $GraphKeterangan->Ref());


	/*$GraphKM = new MakeGraphKMGeneratorMenu($p->IdRuasJalan, $p->Waktu, $Ket );
	ContentInterface::Assign('ImgGraphKM', $GraphKM->Ref());*/

	$GraphJalan = new MakeGraphKondisiTepiGeneratorMenu($p->IdRuasJalan, $p->Waktu);
	ContentInterface::Assign('ImgGraphJalan', $GraphJalan->Ref());
	ContentInterface::Assign("Cetak",$p->Cetak);
	ContentInterface::Assign("Data",$this->DataPenjelasan($db, $p->IdRuasJalan, $p->Waktu ));    
	
	#pewarnaan
	//pewarnaan
	ContentInterface::Assign("Bahu",self::GetMasterBahu());  
	ContentInterface::Assign("Drainase",self::GetMasterDrainase());  
	ContentInterface::Assign("Tebing",self::GetMasterTebing());  
	
	#Keterangan
	//keterangan
	ContentInterface::Assign("Lajur",self::GetKeteranganLajur());  
	ContentInterface::Assign("NonPerkerasan",self::GetKeteranganNonPerkerasan()); 
	

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
				
				DT_IndonesiaDateTime(svy_kondisi_tepi_jalan.timestamp)'Waktu'
		FROM 
				svy_kondisi_tepi_jalan,
				mst_ruas_jalan
		WHERE 
			svy_kondisi_tepi_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id AND
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."'
			
		GROUP BY mst_ruas_jalan.id";
	$rsl = $db->Execute($sql);
	return $Field = $db->FetchArray($rsl);
  }
  
  
  private function GetMasterBahu(){
  	$sql = "
		SELECT 
			id AS id,
			nama AS nama,
			warna AS warna
		FROM 
			mst_jenis_bahu
		WHERE
			id__mst_bahu_group = '".BahuConstant::Bahu."'
		ORDER BY id ";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }
  private function GetMasterDrainase(){
  	$sql = "
		SELECT 
			id AS id,
			nama AS nama,
			warna AS warna
		FROM 
			mst_jenis_bahu
		WHERE
			id__mst_bahu_group ='".BahuConstant::Drainase."'
		ORDER BY id ";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }
  private function GetMasterTebing(){
  	$sql = "
		SELECT 
			id AS id,
			nama AS nama,
			warna AS warna
		FROM 
			mst_jenis_bahu
		WHERE
			id__mst_bahu_group = '".BahuConstant::Tebing."'
		ORDER BY id ";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  }  
  
   private function GetKeteranganLajur (){
  
  	$sql = "
		SELECT 
			nama AS nama,
			deskripsi AS deskripsi
		FROM 
			mst_lajur
		WHERE
			id IN (1,2,3,4)
		ORDER BY id  DESC";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  
  }
  private function GetKeteranganNonPerkerasan (){
  
  	$sql = "
		SELECT 
			nama AS nama,
			deskripsi AS deskripsi
		FROM 
			mst_lajur
		WHERE
			id NOT IN (1,2,3,4)
		ORDER BY id DESC";
	$res = $this->dbs->Execute($sql);
	return $res->GetRows();  
  
  }
 

}
?>