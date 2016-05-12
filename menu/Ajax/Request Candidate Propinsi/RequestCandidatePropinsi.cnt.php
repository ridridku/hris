<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidatePropinsiContent extends ContentInterface
{
  public function RequestCandidatePropinsiContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);
	$rsl = $db->Execute("
		SELECT 
			mst_propinsi.id	AS id, 
			mst_propinsi.nama AS name, 
			mst_propinsi.id__mst_balaibesar
		FROM 
			mst_propinsi
		WHERE 
			mst_propinsi.id__mst_balaibesar = '". $p->Kode ."'
	");	
	
	$aPropinsi = 0;
	while($R = $db->FetchObject($rsl)){
		$d->single_id[$aPropinsi] = $R->id;
		$d->nama[$aPropinsi] = $R->name;
		$aPropinsi++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>