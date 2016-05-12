<?
#require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphKondisiTepiGeneratorContent extends ContentInterface
{
  public function MakeGraphKondisiTepiGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	Jalan::gambar_diagram_kondisi_tepi(
			$db, 
			$p->IdRuasJalan, 
			$p->Waktu,
			1,
			900
	);
 }
  public function Path(){return __FILE__;}
}
	
?>