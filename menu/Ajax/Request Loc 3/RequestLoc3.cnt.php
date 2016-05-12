<?php
require_once 'Zend/Json/Encoder.php';

class RequestLoc3Content extends ContentInterface
{
  public function RequestLoc3Content(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			`loc_3`.`id` AS id, 	
			`loc_3`.`name` AS name 
		FROM loc_3   
		WHERE id_loc_2 = '". $p->IdLoc2 ."'
			
	");	
	
	$aCity = 0;
	while($R = $db->FetchObject($rsl)){
		$d->single_id[$aCity] = $R->id;
		$d->id[$aCity] = $p->IdState . '-' . $R->id;
		$d->nama[$aCity] = $R->name;
		
		$m = new RequestLoc4Menu();
		$m->OnSetKey(array('loc_3.id' => $R->id));
		$d->requestChildsMenu[$aCity] = $m->Ref();
		$d->statusSeverity[$aCity] = 'gedung-putus';

		//tab view
		$rsl_tab_view = $db->Execute(" 
			SELECT loc_3_tab.o_menu_serialized  
			FROM loc_3_tab 
			WHERE 
				loc_3_tab.id_loc_3 = '". $R->id ."'  
			ORDER BY loc_3_tab.order_to_right 
		");	
		$aTab = 0;
		while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
			$m = unserialize($rec_tab_view->o_menu_serialized);
			$m->OnSetKey(array('loc_3.id' => $R->id));
			$d->tabViewMenus[$aCity][$aTab]->Name = $m->Name();
			$d->tabViewMenus[$aCity][$aTab]->Ref = $m->Ref();
			$aTab++;
		}


		$m = new RequestStatusLocationMenu();
		$m->IdLocType = LocTypeConstant::City;
		$m->ParamToCek = array('loc_3.id' => $R->id);
		$d->requestStatusMenu[$aCity] = $m->Ref();

		$aCity++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>