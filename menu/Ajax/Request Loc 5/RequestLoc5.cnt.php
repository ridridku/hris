<?php
require_once 'Zend/Json/Encoder.php';

class RequestLoc5Content extends ContentInterface
{
  public function RequestLoc5Content(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			`loc_5`.`id` AS id, 	
			`loc_5`.`name` AS name 
		FROM loc_5   
		WHERE id_loc_4 = '". $p->IdLoc4 ."' 
	");	
	
	$aCity = 0;
	while($R = $db->FetchObject($rsl)){
		$d->single_id[$aCity] = $R->id;
		$d->id[$aCity] = $p->IdState . '-' . $R->id;
		$d->nama[$aCity] = $R->name;
		
		$d->statusSeverity[$aCity] = 'gedung-putus';

		//tab view
		$rsl_tab_view = $db->Execute(" 
			SELECT loc_5_tab.o_menu_serialized  
			FROM loc_5_tab 
			WHERE 
				loc_5_tab.id_loc_5 = '". $R->id ."'  
			ORDER BY order_to_right 	
		");	
		$aTab = 0;
		while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
			$m = unserialize($rec_tab_view->o_menu_serialized);
			$m->OnSetKey(array('loc_5.id' => $R->id));
			$d->tabViewMenus[$aCity][$aTab]->Name = $m->Name();
			$d->tabViewMenus[$aCity][$aTab]->Ref = $m->Ref();
			$aTab++;
		}


		$m = new RequestStatusLocationMenu();
		$m->IdLocType = LocTypeConstant::City;
		$m->ParamToCek = array('loc_5.id' => $R->id);
		$d->requestStatusMenu[$aCity] = $m->Ref();

		$aCity++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>