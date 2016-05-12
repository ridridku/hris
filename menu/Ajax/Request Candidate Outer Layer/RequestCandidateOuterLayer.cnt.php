<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateOuterLayerContent extends ContentInterface
{
  public function RequestCandidateOuterLayerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			*, 
			( 
				SELECT sys_menu.object 
				FROM sys_menu
				WHERE sys_menu.id = lyr_outer_layer.id_sys_menu_req_child 
			) AS serializedMenuGetChild, 
			(
				SELECT COUNT(*)
				FROM lyr_outer_layer lol 
				WHERE lol.id_parent = lyr_outer_layer.id 
			) AS childCount 
		FROM lyr_outer_layer 
		WHERE 
			IF('". $p->IdParent ."' = '', lyr_outer_layer.id_parent IS NULL, lyr_outer_layer.id_parent = '". $p->IdParent ."') 
			
		ORDER BY lyr_outer_layer.order_to_bottom  
	");	
	
	$aLayer = 0;
	$d->data = array();
	while($R = $db->FetchObject($rsl)){
		$d->data[$aLayer]->id = $R->id;
		$d->data[$aLayer]->visibility = $R->visibility;
		$d->data[$aLayer]->nama = $R->name;
		$d->data[$aLayer]->description = $R->description;
		$d->data[$aLayer]->statusSeverity = (is_null($R->style) ? '' : $R->style);
		$d->data[$aLayer]->isLeaf = 0;
		$d->data[$aLayer]->isSymbology = 0;

		if($R->serializedMenuGetChild){
			$d->data[$aLayer]->hasChildMap = 1;
			$m = unserialize($R->serializedMenuGetChild);
			$d->data[$aLayer]->requestChildsMenu = $m->Ref();
		}elseif($R->childCount > 0){
			$d->data[$aLayer]->hasChildMap = 1;
			$m = new RequestCandidateOuterLayerMenu();
			$m->IdParent = $R->id;
		 	$d->data[$aLayer]->requestChildsMenu = $m->Ref();
		}else{
			$d->data[$aLayer]->hasChildMap = 0;
			$m = new RequestOuterSymbologyMenu();
			$m->IdOuterLayer = $R->id;
			$d->data[$aLayer]->requestChildsMenu = $m->Ref();
		}	

		$aLayer++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>