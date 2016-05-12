<?
//require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphKondisiPerkerasanKmKeGeneratorContent extends ContentInterface
{
  public function MakeGraphKondisiPerkerasanKmKeGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	if($p->Km_Ke == NULL)$p->Km_Ke =1;
	if($p->IdLajur == NULL)$p->IdLajur = 1;
	Jalan::gambar_kondisi_perkerasan_jalan_per_10km(
			$db, $p->IdRuasJalan, $p->Waktu, $p->Km_Ke, $p->IdLajur, 1, 900
	);
 }
  public function Path(){return __FILE__;}
  
}
	
?>