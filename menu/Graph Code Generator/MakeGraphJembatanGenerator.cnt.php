<?
//require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphJembatanGeneratorContent extends ContentInterface
{
  public function MakeGraphJembatanGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	Jalan::Posisi_Jembatan(
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