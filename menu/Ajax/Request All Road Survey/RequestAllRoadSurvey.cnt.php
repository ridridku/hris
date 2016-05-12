<?php
require_once 'Zend/Json/Encoder.php';

class RequestAllRoadSurveyContent extends ContentInterface
{
  public function RequestAllRoadSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			`loc_city`.`id` AS id, 	
			`loc_city`.`name` AS name 
		FROM loc_city  
		WHERE `loc_city`.`id_loc_province` =  '". $p->IdState ."'	
			
	");	
	
	$aCity = 0;
	while($R = $db->FetchObject($rsl)){
		$d->single_id[$aCity] = $R->id;
		$d->id[$aCity] = $p->IdState . '-' . $R->id;
		$d->nama[$aCity] = $R->name;
		
		$m = new RequestCandidateRuasJalanMenu();
		$m->IdCity = $R->id; 
		$d->requestChildsMenu[$aCity] = $m->Ref();
		$d->statusSeverity[$aCity] = 'gedung-putus';

		//tab view
		$rsl_tab_view = $db->Execute(" 
			SELECT sys_menu.object AS o_menu_serialized  
			FROM 
				loc_type_tab_view, 
				sys_menu 
			WHERE 
				loc_type_tab_view.id_loc_type = '". LocTypeConstant::City ."' AND 
				loc_type_tab_view.id_menu_tab = sys_menu.id 
			ORDER BY loc_type_tab_view.order_to_right  
		");	
		$aTab = 0;
		while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
			$m = unserialize($rec_tab_view->o_menu_serialized);
			$m->OnSetKey(array('loc_city.id' => $R->id));
			$d->tabViewMenus[$aCity][$aTab]->Name = $m->Name();
			$d->tabViewMenus[$aCity][$aTab]->Ref = $m->Ref();
			$aTab++;
		}


		$m = new RequestStatusLocationMenu();
		$m->IdLocType = LocTypeConstant::City;
		$m->ParamToCek = array('loc_city.id' => $R->id);
		$d->requestStatusMenu[$aCity] = $m->Ref();

		$aCity++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>