<?
//require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphGeneratorContent extends ContentInterface
{
  public function MakeGraphGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	$Waktu = $p->Waktu;
	Jalan::gambar_diagram_lebar_ruas_jalan(
			$db, 
			$p->IdRuasJalan, 
			$Waktu,
			1,
			900
	);
 }
  public function Path(){return __FILE__;}
  
}
	
?>