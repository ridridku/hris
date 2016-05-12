<?php
require_once 'Zend/Json/Encoder.php';

class RequestOuterSymbologyContent extends ContentInterface
{
  public function RequestOuterSymbologyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT * 
		FROM lyr_symbology   
		WHERE id_lyr_outer_layer = '". $p->IdOuterLayer ."'
		ORDER BY code    
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$d->data[$aLayer]->id = $R->id;
		$d->data[$aLayer]->nama = $R->description;
		$d->data[$aLayer]->description = $R->description;
		$d->data[$aLayer]->statusSeverity = $R->style;
		$d->data[$aLayer]->isLeaf = 1;
		$d->data[$aLayer]->isSymbology = 1;
		$d->data[$aLayer]->hasChildMap = 0;
		$d->data[$aLayer]->requestChildsMenu = '';

		$aLayer++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>