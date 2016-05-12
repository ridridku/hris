<?
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'constant/Kondisi.cst.php';
 require_once 'constant/Lajur.cst.php';
class CetakGrafikPerkerasanJalanContent extends ContentInterface
{
  public function CetakGrafikPerkerasanJalanContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();

	$rs = $db->Execute("
		SELECT 
			panjang AS panjang,
			kp_from AS KmAwal
		FROM 
			mst_ruas_jalan
		WHERE
			id = '".$p->IdRuasJalan."'
		
	");
	$Field = $db->FetchArray($rs);
	ContentInterface::Assign('jumlah',ceil(($Field['panjang']+1)/10));
	$m  = new CetakGrafikPerkerasanJalanHandlerMenu();
	$m->IdPropinsi = $p->IdPropinsi;
	$m->IdRuasJalan = $p->IdRuasJalan;
	$m->Waktu =  $p->Waktu;
	$m->IdLajur = $p->IdLajur;
	
	$m->Next = new CetakGrafikPerkerasanJalanMenu();
	
	
	ContentInterface::Assign('Action',$m->Ref());
	
	$GraphKeterangan = new MakeGraphKeteranganGeneratorMenu($p->IdRuasJalan, $p->Waktu, $Ket );
	ContentInterface::Assign('ImgGraphKeterangan', $GraphKeterangan->Ref());	
	
	
	$GraphJalan = new MakeGraphPerkerasanJalanGeneratorMenu($p->IdRuasJalan, $p->Waktu, $p->IdLajur);
	ContentInterface::Assign('ImgGraphJalan', $GraphJalan->Ref());
		
	$GraphKmPer10 = new MakeGraphPerkerasanJalanKmKe10GeneratorMenu($p->IdRuasJalan, $p->Km_Ke);
	ContentInterface::Assign('ImgGraphKmPer10', $GraphKmPer10->Ref());

	$GraphPerkerasanKe = new MakeGraphKondisiPerkerasanKmKeGeneratorMenu($p->IdRuasJalan, $p->Waktu, $p->Km_Ke, $p->IdLajur);
	ContentInterface::Assign('ImgGraphJalanKe', $GraphPerkerasanKe->Ref());
	if($p->Km_Ke == NULL)	$p->Km_Ke =1;
	ContentInterface::Assign('Km_Ke',$p->Km_Ke);
	
	
	
	ContentInterface::Assign("Cetak",$p->Cetak);
	ContentInterface::Assign("Data",$this->DataPenjelasan($db, $p->IdRuasJalan, $p->Waktu ));    
	
	
	$sql = "
		SELECT nama AS nama
		FROM	mst_lajur
		WHERE id = '".$p->IdLajur."'
	";
	$rs = $db->Execute($sql);
	$R = $db->FetchArray($rs);
	
	ContentInterface::Assign('lajur', $R['nama']);
	ContentInterface::Assign('tahun', (integer) date("Y"));
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
				
				DT_IndonesiaDateTime(svy_kondisi_ruas_jalan.timestamp)'Waktu'
		FROM 
				svy_kondisi_ruas_jalan,
				mst_ruas_jalan
		WHERE 
			svy_kondisi_ruas_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id AND
			id__mst_ruas_jalan = '".$IdRuasJalan."' AND 
			timestamp = '".$Waktu."' 
			
		GROUP BY mst_ruas_jalan.id";
	$rsl = $db->Execute($sql);
	return $Field = $db->FetchArray($rsl);
  }

 
}
?>