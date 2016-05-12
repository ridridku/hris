<?
//require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphKondisiRuasJalanGeneratorContent extends ContentInterface
{
  public function MakeGraphKondisiRuasJalanGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	Jalan::gambar_diagram_kondisi_ruas_jalan(
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