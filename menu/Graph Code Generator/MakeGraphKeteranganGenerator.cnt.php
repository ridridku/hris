<?
//require FW_DIR .'/lib/barcode/jalan.php';
require 'lib/Jalan.php';

class MakeGraphKeteranganGeneratorContent extends ContentInterface
{
  public function MakeGraphKeteranganGeneratorContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  
	$p= $this->Parent();
	$db = $p->MakeDatabase();
	$Waktu = $p->Waktu;
	
	if($p->Keterangan == 1){//kondisi_tepi
		
				Jalan::gambar_keterangan_kondisi_tepi(
						$db, 
						$p->IdRuasJalan, 
						$Waktu,
						1,
						900
				);
	}elseif($p->Keterangan == 2){// kondisi_jalan
	
				Jalan::gambar_keterangan_kondisi_jalan(
						$db, 
						$p->IdRuasJalan, 
						$Waktu,
						1,
						900
				);
		
	}else{
			Jalan::gambar_keterangan_perkerasan_jalan(
						$db, 
						$p->IdRuasJalan, 
						$Waktu,
						1,
						900
				);
	}
	
 }
  public function Path(){return __FILE__;}
  
}
	
?>