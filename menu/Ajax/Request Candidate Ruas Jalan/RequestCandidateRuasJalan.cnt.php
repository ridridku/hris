<?php
require_once 'Zend/Json/Encoder.php';

class RequestCandidateRuasJalanContent extends ContentInterface
{
  public function RequestCandidateRuasJalanContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT 
			`svy_route`.`id` AS id, 	
			`svy_route`.`name` AS name 
		FROM svy_route  
		WHERE `svy_route`.`id_loc_city` =  '". $p->IdCity ."'
			
	");	
	
	$aRuasJalan = 0;
	while($R = $db->FetchObject($rsl)){
		$d->single_id[$aRuasJalan] = $R->id;
		$d->id[$aRuasJalan] = $p->IdCity . '-' . $R->id;
		$d->nama[$aRuasJalan] = $R->name;		
		$d->statusSeverity[$aRuasJalan] = 'jalan-putus';

		//tab view
		$rsl_tab_view = $db->Execute(" 
			SELECT sys_menu.object AS o_menu_serialized  
			FROM 
				loc_type_tab_view, 
				sys_menu 
			WHERE 
				loc_type_tab_view.id_loc_type = '". LocTypeConstant::RuasJalan ."' AND 
				loc_type_tab_view.id_menu_tab = sys_menu.id 
			ORDER BY loc_type_tab_view.order_to_right  
		");	
		$aTab = 0;
		while($rec_tab_view = $db->FetchObject($rsl_tab_view)){
			$m = unserialize($rec_tab_view->o_menu_serialized);
			$m->OnSetKey(array('svy_route.id' => $R->id));
			$d->tabViewMenus[$aRuasJalan][$aTab]->Name = $m->Name();
			$d->tabViewMenus[$aRuasJalan][$aTab]->Ref = $m->Ref();
			$aTab++;
		}


		$m = new RequestStatusLocationMenu();
		$m->IdLocType = LocTypeConstant::RuasJalan;
		$m->ParamToCek = array('svy_route.id' => $R->id);
		$d->requestStatusMenu[$aRuasJalan] = $m->Ref();

		$aRuasJalan++;
	}
	echo Zend_Json_Encoder::encode($d);	
	$db->Execute("COMMIT;");
	
  }
  public function Path(){return __FILE__;}
}
?>