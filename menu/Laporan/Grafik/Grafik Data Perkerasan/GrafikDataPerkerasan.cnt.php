<?
/**
 * @package Content
 */
 require_once 'menu/Graph Code Generator/MakeGraphGenerator.mnu.php';
 require_once 'menu/Graph Code Generator/MakeBarCode.mnu.php';
 require_once 'constant/Bahu.cst.php';
class GrafikDataPerkerasanContent extends ContentInterface
{
  public function GrafikDataPerkerasanContent(){
	ContentInterface::ContentInterface();
  }
 
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$this->dbs = $db->MakeAdoDb();
	

	$m  = new GrafikDataPerkerasanHandlerMenu();
	$m->IdPropinsi = $p->IdPropinsi;
	$m->IdRuasJalan = $p->IdRuasJalan;
	$m->Waktu =  $p->Waktu;
	$m->IdLajur = $p->IdLajur;
	$m->Next = clone($p);
	
	
	ContentInterface::Assign('Action',$m->Ref());
	
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
	

	$Ket = 3;
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
}
?>