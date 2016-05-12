<?
#require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphPerkerasanJalanGeneratorContent extends ContentInterface
{
  public function MakeGraphPerkerasanJalanGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	Jalan::gambar_diagram_perkerasan_jalan(
			$db, 
			$p->IdRuasJalan, 
			$p->Waktu,
			$p->IdLajur,
			1,
			900
	);
 }
  public function Path(){return __FILE__;}
}
	
?>