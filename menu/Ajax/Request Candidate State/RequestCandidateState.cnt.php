<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateStateContent extends ContentInterface
{
  public function RequestCandidateStateContent(){
	ContentInterface::ContentInterface();
  }

  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			loc_state.id AS id, 
			loc_state.name AS name 
		FROM loc_state 
		ORDER BY loc_state.name 
	");	
	
	$aState = 0;
	while($R = $db->FetchObject($rsl)){
		$d->id[$aState] = $R->id;
		$d->nama[$aState] = $R->name;
		$d->statusSeverity[$aState] = 'site-putus';

		//get tab view
		$rsl_tab_view = $db->Execute(" 
			SELECT `sys_menu`.`object` AS o_menu_serialized  
			FROM 
				loc_type_tab_view,  
				sys_menu 
			WHERE 
				loc_type_tab_view.id_loc_type = '". LocTypeConstant::State ."' AND 
				loc_type_tab_view.id_menu_tab = sys_menu.id  
			ORDER BY loc_type_tab_view.order_to_right  
		");	
		$aTab = 0;
		while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
			$m = unserialize($rec_tab_view->o_menu_serialized);
			
			$m->OnSetKey(array('loc_state.id' => $R->id));
			$d->tabViewMenus[$aState][$aTab]->Name = $m->Name();
			$d->tabViewMenus[$aState][$aTab]->Ref = $m->Ref();
			$aTab++;
		}


		$m = new RequestCandidateCityMenu();
		$m->IdState = $R->id;
		$d->requestChildsMenu[$aState] = $m->Ref();
		$d->requestStatusMsInterval[$aState] = 30000;
		
		$m = new RequestStatusLocationMenu();
		$m->IdLocType = LocTypeConstant::State;
		$m->ParamToCek = array('loc_state.id' => $R->id);
		$d->requestStatusMenu[$aState] = $m->Ref();
	

		$aState++;
	}

	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}
?>