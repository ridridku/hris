<?php
require_once 'Zend/Json/Encoder.php';

class RequestDataTransaksiContent extends ContentInterface
{
  public function RequestDataTransaksiContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	
	$rsl = $db->Execute("
		SELECT 
			lyr_type.id AS id, 	
			lyr_type.name AS name 
		FROM lyr_type   
	");	
	
	$aCity = 0;
			while($R = $db->FetchObject($rsl)){
				$d->id[$aCity] =  $R->id;
				$d->nama[$aCity] = $R->name;
			
			//tab view 
				$rsl_tab_view = $db->Execute(" 
					SELECT lyr_type_tab_view.o_menu_serialized  
					FROM lyr_type_tab_view 
					WHERE 
						lyr_type_tab_view.id_lyr_type = '". $R->id ."'  
					ORDER BY order_to_right 	
				");	
				$aTab = 0;
				while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
					$m = unserialize($rec_tab_view->o_menu_serialized);
					$m->OnSetKey(array('lyr_type.id' => $R->id));
					$d->tabViewMenus[$aCity][$aTab]->Name = $m->Name();
					$d->tabViewMenus[$aCity][$aTab]->Ref = $m->Ref();
					$aTab++;
				}
		$aCity++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>