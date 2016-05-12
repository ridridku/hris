<?
#require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphKMGeneratorContent extends ContentInterface
{
  public function MakeGraphKMGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	Jalan::gambar_km_meter(
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