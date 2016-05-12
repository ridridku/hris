<?
#require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphPerkerasanJalanKmKe10GeneratorContent extends ContentInterface
{
  public function MakeGraphPerkerasanJalanKmKe10GeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase(); 
	if($p->Km_Ke == NULL)$p->Km_Ke = 1;
	Jalan::gambar_meter_perkerasan_jalan_per_10km(
			$db, 
			$p->IdRuasJalan, 
			$p->Km_Ke,
			1,
			900
	);
 }
  public function Path(){return __FILE__;}
}
	
?>